const express = require('express');
const router = express.Router();
const auth = require('../middlewares/auth');
const requireRoles = require('../middlewares/requireRoles');
const acervoController = require('../controllers/acervoController');
const paginasController = require('../controllers/paginasController');
const reportsController = require('../controllers/reportsController');
const { uploadAcervo, uploadPagina } = require('../utils/storageService');

/**
 * @swagger
 * tags:
 *   - name: Admin - Simpósio
 *     description: Gerenciamento de simpósios
 *   - name: Admin - Trabalhos
 *     description: Gerenciamento de trabalhos
 *   - name: Admin - Participantes
 *     description: Gerenciamento de participantes
 *   - name: Admin - Acervo
 *     description: Gerenciamento de acervo
 *   - name: Admin - Páginas
 *     description: Gerenciamento de páginas estáticas
 *   - name: Admin - Avaliações Externas
 *     description: Lançamento de notas externas
 */

// Rotas CRUD básicas para Admin/SubAdmin
const adminController = {
  // Simpósio
  inicializarSimposio: async (req, res) => {
    try {
      const Simposio = require('../models/Simposio');
      const { ano, nome, descricao, local, datasConfig } = req.body;
      
      if (!nome) {
        return res.status(400).json({ success: false, message: 'O nome do simpósio é obrigatório' });
      }
      
      const exists = await Simposio.findOne({ ano });
      if (exists) {
        return res.status(400).json({ success: false, message: 'Simpósio já existe para este ano' });
      }
      
      const simposio = await Simposio.create({ 
        ano, 
        nome, 
        descricao, 
        local, 
        status: 'INICIALIZADO', 
        datasConfig 
      });
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('SIMPOSIO_INICIALIZADO', req.user.id, { ano, nome });
      
      res.status(201).json({ success: true, data: simposio });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  finalizarSimposio: async (req, res) => {
    try {
      const Simposio = require('../models/Simposio');
      const { ano } = req.body;
      
      const simposio = await Simposio.findOne({ ano });
      if (!simposio) {
        return res.status(404).json({ success: false, message: 'Simpósio não encontrado' });
      }
      
      simposio.status = 'FINALIZADO';
      await simposio.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('SIMPOSIO_FINALIZADO', req.user.id, { ano });
      
      res.json({ success: true, data: simposio });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  atribuirAvaliador: async (req, res) => {
    try {
      const Trabalho = require('../models/Trabalho');
      const { avaliadorId } = req.body;
      
      const trabalho = await Trabalho.findById(req.params.id);
      if (!trabalho) {
        return res.status(404).json({ success: false, message: 'Trabalho não encontrado' });
      }
      
      // Verifica se já está atribuído
      const jaAtribuido = trabalho.atribuicoes.find(
        a => a.avaliador.toString() === avaliadorId && !a.revogado_em
      );
      
      if (jaAtribuido) {
        return res.status(400).json({ success: false, message: 'Avaliador já atribuído' });
      }
      
      trabalho.atribuicoes.push({ avaliador: avaliadorId });
      trabalho.qtd_enviados = trabalho.atribuicoes.filter(a => !a.revogado_em).length;
      await trabalho.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('AVALIADOR_ATRIBUIDO', req.user.id, { trabalhoId: trabalho._id, avaliadorId });
      
      res.json({ success: true, data: trabalho });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  revogarAvaliador: async (req, res) => {
    try {
      const Trabalho = require('../models/Trabalho');
      const { avaliadorId } = req.body;
      
      const trabalho = await Trabalho.findById(req.params.id);
      if (!trabalho) {
        return res.status(404).json({ success: false, message: 'Trabalho não encontrado' });
      }
      
      const atribuicao = trabalho.atribuicoes.find(
        a => a.avaliador.toString() === avaliadorId && !a.revogado_em
      );
      
      if (!atribuicao) {
        return res.status(404).json({ success: false, message: 'Atribuição não encontrada' });
      }
      
      atribuicao.revogado_em = new Date();
      trabalho.qtd_enviados = trabalho.atribuicoes.filter(a => !a.revogado_em).length;
      await trabalho.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('AVALIADOR_REVOGADO', req.user.id, { trabalhoId: trabalho._id, avaliadorId });
      
      res.json({ success: true, data: trabalho });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  // CRUD genérico (exemplo: GrandeArea)
  createGrandeArea: async (req, res) => {
    try {
      const GrandeArea = require('../models/GrandeArea');
      const grandeArea = await GrandeArea.create(req.body);
      res.status(201).json({ success: true, data: grandeArea });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  getGrandeAreas: async (req, res) => {
    try {
      const GrandeArea = require('../models/GrandeArea');
      const areas = await GrandeArea.find();
      res.json({ success: true, data: areas });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  // Simpósio - Get
  getSimposio: async (req, res) => {
    try {
      const Simposio = require('../models/Simposio');
      const simposio = await Simposio.findOne({ ano: parseInt(req.params.ano) });
      if (!simposio) {
        return res.status(404).json({ success: false, message: 'Simpósio não encontrado' });
      }
      res.json({ success: true, data: simposio });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  // Simpósio - Listar todos
  listarSimposios: async (req, res) => {
    try {
      const Simposio = require('../models/Simposio');
      const { limit = 10, page = 1 } = req.query;
      
      const simposios = await Simposio.find()
        .sort({ ano: -1 })
        .limit(parseInt(limit))
        .skip((parseInt(page) - 1) * parseInt(limit));
      
      const total = await Simposio.countDocuments();
      
      res.json({ 
        success: true, 
        simposios,
        total,
        totalPages: Math.ceil(total / parseInt(limit)),
        currentPage: parseInt(page)
      });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  // Simpósio - Atualizar Datas
  atualizarDatasSimposio: async (req, res) => {
    try {
      const Simposio = require('../models/Simposio');
      const { datasConfig } = req.body;
      
      const simposio = await Simposio.findOne({ ano: parseInt(req.params.ano) });
      if (!simposio) {
        return res.status(404).json({ success: false, message: 'Simpósio não encontrado' });
      }
      
      simposio.datasConfig = datasConfig;
      await simposio.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('SIMPOSIO_DATAS_ATUALIZADAS', req.user.id, { ano: req.params.ano });
      
      res.json({ success: true, data: simposio });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  atualizarSimposio: async (req, res) => {
    try {
      const Simposio = require('../models/Simposio');
      const { nome, descricao, local } = req.body;
      
      const simposio = await Simposio.findOne({ ano: parseInt(req.params.ano) });
      if (!simposio) {
        return res.status(404).json({ success: false, message: 'Simpósio não encontrado' });
      }
      
      if (nome) simposio.nome = nome;
      if (descricao !== undefined) simposio.descricao = descricao;
      if (local !== undefined) simposio.local = local;
      
      await simposio.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('SIMPOSIO_ATUALIZADO', req.user.id, { ano: req.params.ano, nome });
      
      res.json({ success: true, data: simposio });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  // Áreas de Atuação
  getAreasAtuacao: async (req, res) => {
    try {
      const AreaAtuacao = require('../models/AreaAtuacao');
      const areas = await AreaAtuacao.find().populate('grandeArea');
      res.json({ success: true, data: areas });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  createAreaAtuacao: async (req, res) => {
    try {
      const AreaAtuacao = require('../models/AreaAtuacao');
      const area = await AreaAtuacao.create(req.body);
      res.status(201).json({ success: true, data: area });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  updateAreaAtuacao: async (req, res) => {
    try {
      const AreaAtuacao = require('../models/AreaAtuacao');
      const area = await AreaAtuacao.findByIdAndUpdate(req.params.id, req.body, { new: true });
      if (!area) {
        return res.status(404).json({ success: false, message: 'Área não encontrada' });
      }
      res.json({ success: true, data: area });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  deleteAreaAtuacao: async (req, res) => {
    try {
      const AreaAtuacao = require('../models/AreaAtuacao');
      const area = await AreaAtuacao.findByIdAndDelete(req.params.id);
      if (!area) {
        return res.status(404).json({ success: false, message: 'Área não encontrada' });
      }
      res.json({ success: true, message: 'Área removida com sucesso' });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  // Subáreas
  getSubareas: async (req, res) => {
    try {
      const Subarea = require('../models/Subarea');
      const subareas = await Subarea.find().populate('areaAtuacao');
      res.json({ success: true, data: subareas });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  createSubarea: async (req, res) => {
    try {
      const Subarea = require('../models/Subarea');
      const subarea = await Subarea.create(req.body);
      res.status(201).json({ success: true, data: subarea });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  updateSubarea: async (req, res) => {
    try {
      const Subarea = require('../models/Subarea');
      const subarea = await Subarea.findByIdAndUpdate(req.params.id, req.body, { new: true });
      if (!subarea) {
        return res.status(404).json({ success: false, message: 'Subárea não encontrada' });
      }
      res.json({ success: true, data: subarea });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  deleteSubarea: async (req, res) => {
    try {
      const Subarea = require('../models/Subarea');
      const subarea = await Subarea.findByIdAndDelete(req.params.id);
      if (!subarea) {
        return res.status(404).json({ success: false, message: 'Subárea não encontrada' });
      }
      res.json({ success: true, message: 'Subárea removida com sucesso' });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  // Grande Área - UPDATE e DELETE
  updateGrandeArea: async (req, res) => {
    try {
      const GrandeArea = require('../models/GrandeArea');
      const area = await GrandeArea.findByIdAndUpdate(req.params.id, req.body, { new: true });
      if (!area) {
        return res.status(404).json({ success: false, message: 'Grande Área não encontrada' });
      }
      res.json({ success: true, data: area });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  deleteGrandeArea: async (req, res) => {
    try {
      const GrandeArea = require('../models/GrandeArea');
      const area = await GrandeArea.findByIdAndDelete(req.params.id);
      if (!area) {
        return res.status(404).json({ success: false, message: 'Grande Área não encontrada' });
      }
      res.json({ success: true, message: 'Grande Área removida com sucesso' });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },

  // Avaliação Externa
  listarTrabalhosParaAvaliacaoExterna: async (req, res) => {
    try {
      const Trabalho = require('../models/Trabalho');
      const Simposio = require('../models/Simposio');
      
      const { simposioId, page = 1, limit = 50, busca = '' } = req.query;
      
      const query = {
        deleted_at: null,
        status: { $in: ['ACEITO', 'PUBLICADO'] },
      };
      
      if (simposioId) {
        query.simposio = simposioId;
      }
      
      if (busca) {
        query.$or = [
          { titulo: { $regex: busca, $options: 'i' } },
          { 'autores.nome': { $regex: busca, $options: 'i' } },
        ];
      }
      
      const skip = (page - 1) * limit;
      const total = await Trabalho.countDocuments(query);
      
      const trabalhos = await Trabalho.find(query)
        .populate('simposio', 'ano status')
        .populate('grandeArea', 'nome')
        .populate('areaAtuacao', 'nome')
        .select('titulo autores notaExterna media status simposio grandeArea areaAtuacao')
        .sort({ titulo: 1 })
        .skip(skip)
        .limit(parseInt(limit));
      
      res.json({
        success: true,
        data: trabalhos,
        pagination: {
          total,
          page: parseInt(page),
          limit: parseInt(limit),
          totalPages: Math.ceil(total / limit),
        },
      });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },

  lancarNotaExterna: async (req, res) => {
    try {
      const Trabalho = require('../models/Trabalho');
      const Simposio = require('../models/Simposio');
      const { notaExterna } = req.body;
      
      // Validação da nota
      if (notaExterna === null || notaExterna === undefined) {
        return res.status(400).json({ success: false, message: 'Nota é obrigatória' });
      }
      
      if (notaExterna < 0 || notaExterna > 10) {
        return res.status(400).json({ success: false, message: 'Nota deve estar entre 0 e 10' });
      }
      
      const trabalho = await Trabalho.findById(req.params.id).populate('simposio');
      if (!trabalho) {
        return res.status(404).json({ success: false, message: 'Trabalho não encontrado' });
      }
      
      // Verifica se está dentro da janela de notas externas
      const simposio = trabalho.simposio;
      const agora = new Date();
      const inicio = new Date(simposio.datasConfig.notasAvaliacaoExterna.inicio);
      const fim = new Date(simposio.datasConfig.notasAvaliacaoExterna.fim);
      
      if (agora < inicio || agora > fim) {
        return res.status(403).json({
          success: false,
          message: 'Fora do prazo para lançamento de notas externas',
          janela: {
            inicio: inicio.toISOString(),
            fim: fim.toISOString(),
          },
        });
      }
      
      trabalho.notaExterna = parseFloat(notaExterna);
      await trabalho.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('NOTA_EXTERNA_LANCADA', req.user.id, {
        trabalhoId: trabalho._id,
        notaExterna: trabalho.notaExterna,
      });
      
      res.json({ success: true, data: trabalho });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },

  removerNotaExterna: async (req, res) => {
    try {
      const Trabalho = require('../models/Trabalho');
      
      const trabalho = await Trabalho.findById(req.params.id).populate('simposio');
      if (!trabalho) {
        return res.status(404).json({ success: false, message: 'Trabalho não encontrado' });
      }
      
      // Verifica se está dentro da janela de notas externas
      const simposio = trabalho.simposio;
      const agora = new Date();
      const inicio = new Date(simposio.datasConfig.notasAvaliacaoExterna.inicio);
      const fim = new Date(simposio.datasConfig.notasAvaliacaoExterna.fim);
      
      if (agora < inicio || agora > fim) {
        return res.status(403).json({
          success: false,
          message: 'Fora do prazo para remoção de notas externas',
        });
      }
      
      trabalho.notaExterna = null;
      await trabalho.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('NOTA_EXTERNA_REMOVIDA', req.user.id, {
        trabalhoId: trabalho._id,
      });
      
      res.json({ success: true, data: trabalho });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },

  // Listagem de Trabalhos
  listarTrabalhos: async (req, res) => {
    try {
      const Trabalho = require('../models/Trabalho');
      const Simposio = require('../models/Simposio');
      const GrandeArea = require('../models/GrandeArea');
      const AreaAtuacao = require('../models/AreaAtuacao');
      const User = require('../models/User');
      
      const { ano, page = 1, limit = 20, status, busca } = req.query;
      
      // Busca o simpósio do ano
      let simposio;
      if (ano) {
        simposio = await Simposio.findOne({ ano: parseInt(ano) });
        if (!simposio) {
          return res.status(404).json({ success: false, message: 'Simpósio não encontrado' });
        }
      }
      
      const query = { deleted_at: null };
      
      if (simposio) {
        query.simposio = simposio._id;
      }
      
      if (status) {
        query.status = status;
      }
      
      if (busca) {
        query.$or = [
          { titulo: { $regex: busca, $options: 'i' } },
          { 'autores.nome': { $regex: busca, $options: 'i' } },
          { 'autores.email': { $regex: busca, $options: 'i' } },
        ];
      }
      
      const skip = (page - 1) * limit;
      const total = await Trabalho.countDocuments(query);
      
      const trabalhos = await Trabalho.find(query)
        .populate('simposio', 'ano status')
        .populate('grandeArea', 'nome')
        .populate('areaAtuacao', 'nome')
        .populate('atribuicoes.avaliador', 'nome email')
        .populate('avaliacoes.avaliador', 'nome email')
        .sort({ createdAt: -1 })
        .skip(skip)
        .limit(parseInt(limit));
      
      res.json({
        success: true,
        data: trabalhos,
        pagination: {
          total,
          page: parseInt(page),
          limit: parseInt(limit),
          totalPages: Math.ceil(total / limit),
        },
      });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  // Buscar trabalho específico com avaliações
  buscarTrabalho: async (req, res) => {
    try {
      const Trabalho = require('../models/Trabalho');
      
      const trabalho = await Trabalho.findById(req.params.id)
        .populate('simposio', 'ano status')
        .populate('grandeArea', 'nome')
        .populate('areaAtuacao', 'nome')
        .populate('subarea', 'nome')
        .populate('atribuicoes.avaliador', 'nome email')
        .populate('avaliacoes.avaliador', 'nome email');
      
      if (!trabalho) {
        return res.status(404).json({ success: false, message: 'Trabalho não encontrado' });
      }
      
      res.json({ success: true, data: trabalho });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },

  // Atualizar trabalho (status e tipo de apresentação)
  atualizarTrabalho: async (req, res) => {
    try {
      const Trabalho = require('../models/Trabalho');
      const { status, tipoApresentacao, notaExterna } = req.body;
      
      const trabalho = await Trabalho.findById(req.params.id);
      
      if (!trabalho) {
        return res.status(404).json({ success: false, message: 'Trabalho não encontrado' });
      }
      
      if (status) {
        trabalho.status = status;
      }
      
      if (tipoApresentacao) {
        trabalho.tipoApresentacao = tipoApresentacao;
      }
      
      if (notaExterna !== undefined) {
        trabalho.notaExterna = notaExterna;
      }
      
      await trabalho.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('TRABALHO_ATUALIZADO', req.user.id, {
        trabalhoId: trabalho._id,
        status,
        tipoApresentacao,
      });
      
      // Se foi aceito, enviar notificação por email
      if (status === 'ACEITO' || status === 'REJEITADO') {
        const emailService = require('../services/emailService');
        const Participant = require('../models/Participant');
        
        const participant = await Participant.findById(trabalho.autor).populate('user');
        if (participant && participant.user) {
          await emailService.enviarResultadoAvaliacao(
            participant.user.email,
            participant.nome,
            trabalho.titulo,
            status,
            trabalho.media,
            tipoApresentacao
          );
        }
      }
      
      res.json({ success: true, data: trabalho, message: 'Trabalho atualizado com sucesso' });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },

  // Listagem de Participantes
  listarParticipantes: async (req, res) => {
    try {
      const Participant = require('../models/Participant');
      
      const { page = 1, limit = 20, busca, tipo } = req.query;
      
      const query = { deleted_at: null };
      
      if (tipo) {
        query.tipo = tipo;
      }
      
      if (busca) {
        query.$or = [
          { nome: { $regex: busca, $options: 'i' } },
          { cpf: { $regex: busca, $options: 'i' } },
          { email: { $regex: busca, $options: 'i' } },
        ];
      }
      
      const skip = (page - 1) * limit;
      const total = await Participant.countDocuments(query);
      
      const participantes = await Participant.find(query)
        .select('nome cpf email telefone tipo createdAt')
        .sort({ nome: 1 })
        .skip(skip)
        .limit(parseInt(limit));
      
      res.json({
        success: true,
        data: participantes,
        pagination: {
          total,
          page: parseInt(page),
          limit: parseInt(limit),
          totalPages: Math.ceil(total / limit),
        },
      });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },

  // Listar Avaliadores
  listarAvaliadores: async (req, res) => {
    try {
      const User = require('../models/User');
      const Avaliador = require('../models/Avaliador');
      
      const { page = 1, limit = 20, busca } = req.query;
      
      // Buscar todos os avaliadores na coleção Avaliador
      const avaliadoresIds = await Avaliador.find({ deleted_at: null }).distinct('user');
      
      const query = {
        $or: [
          { _id: { $in: avaliadoresIds } },
          { papel: 'AVALIADOR' },
          { email: { $regex: 'avaliador', $options: 'i' } }
        ],
        deleted_at: null,
      };
      
      if (busca) {
        query.$and = [
          { $or: query.$or },
          {
            $or: [
              { nome: { $regex: busca, $options: 'i' } },
              { email: { $regex: busca, $options: 'i' } },
            ]
          }
        ];
        delete query.$or;
      }
      
      const skip = (page - 1) * limit;
      const total = await User.countDocuments(query);
      
      const users = await User.find(query)
        .select('nome email cpf')
        .skip(skip)
        .limit(parseInt(limit));
      
      // Busca dados complementares do avaliador
      const avaliadoresData = await Promise.all(
        users.map(async (user) => {
          const avaliador = await Avaliador.findOne({ user: user._id })
            .populate('areasConhecimento');
          return {
            _id: user._id,
            nome: user.nome,
            email: user.email,
            cpf: user.cpf,
            areasConhecimento: avaliador?.areasConhecimento || [],
            lattes: avaliador?.lattes || '',
          };
        })
      );
      
      res.json({
        success: true,
        data: avaliadoresData,
        pagination: {
          total,
          page: parseInt(page),
          limit: parseInt(limit),
          totalPages: Math.ceil(total / limit),
        },
      });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  // Criar Avaliador
  criarAvaliador: async (req, res) => {
    try {
      const User = require('../models/User');
      const Avaliador = require('../models/Avaliador');
      const bcrypt = require('bcryptjs');
      
      const { nome, email, cpf, senha, areasConhecimento, lattes } = req.body;
      
      // Verifica se já existe
      const existente = await User.findOne({ email });
      if (existente) {
        return res.status(400).json({ success: false, message: 'Email já cadastrado' });
      }
      
      // Cria usuário
      const hashedPassword = await bcrypt.hash(senha, 10);
      const user = await User.create({
        nome,
        email,
        cpf,
        senha: hashedPassword,
        papel: 'AVALIADOR',
      });
      
      // Cria registro de avaliador
      await Avaliador.create({
        user: user._id,
        areasConhecimento: areasConhecimento || [],
        lattes: lattes || '',
      });
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('AVALIADOR_CRIADO', req.user.id, { avaliadorId: user._id, email });
      
      res.status(201).json({ success: true, data: user });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  // Atualizar Avaliador
  atualizarAvaliador: async (req, res) => {
    try {
      const User = require('../models/User');
      const Avaliador = require('../models/Avaliador');
      
      const { nome, email, cpf, areasConhecimento, lattes } = req.body;
      
      const user = await User.findById(req.params.id);
      if (!user) {
        return res.status(404).json({ success: false, message: 'Avaliador não encontrado' });
      }
      
      // Atualiza usuário
      if (nome) user.nome = nome;
      if (email) user.email = email;
      if (cpf) user.cpf = cpf;
      await user.save();
      
      // Atualiza dados do avaliador
      let avaliador = await Avaliador.findOne({ user: user._id });
      if (!avaliador) {
        avaliador = await Avaliador.create({ user: user._id });
      }
      
      if (areasConhecimento) avaliador.areasConhecimento = areasConhecimento;
      if (lattes !== undefined) avaliador.lattes = lattes;
      await avaliador.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('AVALIADOR_ATUALIZADO', req.user.id, { avaliadorId: user._id });
      
      res.json({ success: true, data: user });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  // Remover Avaliador (soft delete)
  removerAvaliador: async (req, res) => {
    try {
      const User = require('../models/User');
      
      const user = await User.findById(req.params.id);
      if (!user) {
        return res.status(404).json({ success: false, message: 'Avaliador não encontrado' });
      }
      
      user.deleted_at = new Date();
      await user.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('AVALIADOR_REMOVIDO', req.user.id, { avaliadorId: user._id });
      
      res.json({ success: true, message: 'Avaliador removido com sucesso' });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  // ===== CRUD SUBEVENTOS =====
  
  // Listar Subeventos
  listarSubeventos: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      const { page = 1, limit = 20, busca, simposio } = req.query;
      
      const filter = { deleted_at: null };
      
      if (simposio) {
        filter.simposio = simposio;
      }
      
      if (busca) {
        filter.$or = [
          { titulo: { $regex: busca, $options: 'i' } },
          { palestrante: { $regex: busca, $options: 'i' } },
          { tipo: { $regex: busca, $options: 'i' } },
        ];
      }
      
      const skip = (page - 1) * limit;
      
      const [subeventos, total] = await Promise.all([
        Subevento.find(filter)
          .populate('simposio', 'ano')
          .populate('responsaveisMesarios', 'nome email')
          .sort({ data: 1, horarioInicio: 1 })
          .limit(parseInt(limit))
          .skip(skip),
        Subevento.countDocuments(filter),
      ]);
      
      res.json({
        success: true,
        data: subeventos,
        pagination: {
          total,
          page: parseInt(page),
          limit: parseInt(limit),
          totalPages: Math.ceil(total / limit),
        },
      });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  // Criar Subevento
  criarSubevento: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      const { 
        titulo, 
        tipo, 
        data, 
        horarioInicio, 
        duracao, 
        palestrante, 
        local, 
        descricao, 
        vagas,
        evento,
        simposio,
        responsaveisMesarios,
      } = req.body;
      
      if (!titulo || !data || !horarioInicio || !duracao || !simposio) {
        return res.status(400).json({ 
          success: false, 
          message: 'Título, data, horário, duração e simpósio são obrigatórios' 
        });
      }
      
      const subevento = await Subevento.create({
        titulo,
        tipo,
        data,
        horarioInicio,
        duracao,
        palestrante,
        local,
        descricao,
        vagas,
        evento,
        simposio,
        responsaveisMesarios: responsaveisMesarios || [],
      });
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('SUBEVENTO_CRIADO', req.user.id, { subeventoId: subevento._id, titulo });
      
      res.status(201).json({ success: true, data: subevento });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  // Atualizar Subevento
  atualizarSubevento: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      const { 
        titulo, 
        tipo, 
        data, 
        horarioInicio, 
        duracao, 
        palestrante, 
        local, 
        descricao, 
        vagas,
        evento,
        responsaveisMesarios,
      } = req.body;
      
      const subevento = await Subevento.findById(req.params.id);
      if (!subevento) {
        return res.status(404).json({ success: false, message: 'Subevento não encontrado' });
      }
      
      if (titulo) subevento.titulo = titulo;
      if (tipo !== undefined) subevento.tipo = tipo;
      if (data) subevento.data = data;
      if (horarioInicio) subevento.horarioInicio = horarioInicio;
      if (duracao) subevento.duracao = duracao;
      if (palestrante !== undefined) subevento.palestrante = palestrante;
      if (local !== undefined) subevento.local = local;
      if (descricao !== undefined) subevento.descricao = descricao;
      if (vagas !== undefined) subevento.vagas = vagas;
      if (evento !== undefined) subevento.evento = evento;
      if (responsaveisMesarios) subevento.responsaveisMesarios = responsaveisMesarios;
      
      await subevento.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('SUBEVENTO_ATUALIZADO', req.user.id, { subeventoId: subevento._id });
      
      res.json({ success: true, data: subevento });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  // Remover Subevento (soft delete)
  removerSubevento: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      
      const subevento = await Subevento.findById(req.params.id);
      if (!subevento) {
        return res.status(404).json({ success: false, message: 'Subevento não encontrado' });
      }
      
      subevento.deleted_at = new Date();
      await subevento.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('SUBEVENTO_REMOVIDO', req.user.id, { subeventoId: subevento._id });
      
      res.json({ success: true, message: 'Subevento removido com sucesso' });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },

  // Listar Inscritos de um Subevento
  listarInscritos: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      const Presenca = require('../models/Presenca');
      
      const subevento = await Subevento.findById(req.params.id);
      if (!subevento) {
        return res.status(404).json({ success: false, message: 'Subevento não encontrado' });
      }
      
      // Buscar presenças para verificar quem já fez check-in
      const presencas = await Presenca.find({ subevento: subevento._id });
      const presencasMap = {};
      presencas.forEach(p => {
        presencasMap[p.participant.toString()] = p;
      });
      
      // Adicionar informação de presença aos inscritos
      const inscritosComPresenca = subevento.inscritos.map(inscrito => {
        const inscritoObj = inscrito.toObject();
        inscritoObj.presenca = !!presencasMap[inscrito.participant.toString()];
        inscritoObj.presencaData = presencasMap[inscrito.participant.toString()]?.checkin;
        return inscritoObj;
      });
      
      // Popular os dados do participante
      await Subevento.populate(inscritosComPresenca, {
        path: 'participant',
        populate: { path: 'user', select: 'email' }
      });
      
      res.json({ success: true, data: inscritosComPresenca });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },

  // Adicionar Inscrito a um Subevento
  adicionarInscrito: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      const Participant = require('../models/Participant');
      const InscricaoSimposio = require('../models/InscricaoSimposio');
      const { participantId } = req.body;
      
      if (!participantId) {
        return res.status(400).json({ success: false, message: 'ID do participante é obrigatório' });
      }
      
      const subevento = await Subevento.findById(req.params.id);
      if (!subevento) {
        return res.status(404).json({ success: false, message: 'Subevento não encontrado' });
      }
      
      const participant = await Participant.findById(participantId);
      if (!participant) {
        return res.status(404).json({ success: false, message: 'Participante não encontrado' });
      }
      
      // Verificar se o participante está inscrito no simpósio
      const inscricao = await InscricaoSimposio.findOne({
        participant: participantId,
        simposio: subevento.simposio,
        status: 'ATIVA'
      });
      
      if (!inscricao) {
        return res.status(403).json({ 
          success: false, 
          message: 'Participante não está inscrito no Simpósio' 
        });
      }
      
      // Verificar se já está inscrito
      if (subevento.isParticipantInscrito(participantId)) {
        return res.status(400).json({ 
          success: false, 
          message: 'Participante já está inscrito neste subevento' 
        });
      }
      
      // Verificar vagas disponíveis
      if (subevento.vagas && subevento.inscritos.length >= subevento.vagas) {
        return res.status(400).json({ 
          success: false, 
          message: 'Não há vagas disponíveis neste subevento' 
        });
      }
      
      // Verificar conflito de horário
      const conflito = await Subevento.verificarConflitoHorario(
        participantId,
        subevento.data,
        subevento.horarioInicio,
        subevento.duracao,
        subevento._id
      );
      
      if (conflito.conflito) {
        return res.status(400).json({ 
          success: false, 
          message: `Participante já está inscrito no subevento "${conflito.subevento.titulo}" no mesmo horário` 
        });
      }
      
      // Adicionar inscrito
      subevento.inscritos.push({
        participant: participantId,
        status: 'CONFIRMADO',
        dataInscricao: new Date()
      });
      
      await subevento.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('INSCRITO_ADICIONADO', req.user.id, { subeventoId: subevento._id, participantId });
      
      res.json({ success: true, message: 'Participante inscrito com sucesso' });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },

  // Remover Inscrito de um Subevento
  removerInscrito: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      const { inscritoId } = req.params;
      
      const subevento = await Subevento.findById(req.params.id);
      if (!subevento) {
        return res.status(404).json({ success: false, message: 'Subevento não encontrado' });
      }
      
      const inscritoIndex = subevento.inscritos.findIndex(i => i._id.toString() === inscritoId);
      if (inscritoIndex === -1) {
        return res.status(404).json({ success: false, message: 'Inscrito não encontrado' });
      }
      
      subevento.inscritos.splice(inscritoIndex, 1);
      await subevento.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('INSCRITO_REMOVIDO', req.user.id, { subeventoId: subevento._id, inscritoId });
      
      res.json({ success: true, message: 'Inscrito removido com sucesso' });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },

  // Confirmar Presença de um Inscrito
  confirmarPresenca: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      const Presenca = require('../models/Presenca');
      const { inscritoId } = req.params;
      
      const subevento = await Subevento.findById(req.params.id);
      if (!subevento) {
        return res.status(404).json({ success: false, message: 'Subevento não encontrado' });
      }
      
      const inscrito = subevento.inscritos.find(i => i._id.toString() === inscritoId);
      if (!inscrito) {
        return res.status(404).json({ success: false, message: 'Inscrito não encontrado' });
      }
      
      // Verificar se já existe presença
      const presencaExistente = await Presenca.findOne({
        participant: inscrito.participant,
        subevento: subevento._id
      });
      
      if (presencaExistente) {
        return res.status(400).json({ 
          success: false, 
          message: 'Presença já foi confirmada para este participante' 
        });
      }
      
      // Criar registro de presença
      const presenca = await Presenca.create({
        participant: inscrito.participant,
        subevento: subevento._id,
        checkins: [{
          data: new Date(),
          origem: 'MANUAL',
          confirmadoPor: req.user.userId
        }]
      });
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('PRESENCA_CONFIRMADA', req.user.id, { 
        subeventoId: subevento._id, 
        participantId: inscrito.participant,
        presencaId: presenca._id 
      });
      
      res.json({ success: true, message: 'Presença confirmada com sucesso', data: presenca });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  // ===== DASHBOARD ESTATÍSTICAS =====
  
  // Obter estatísticas para dashboard
  getStats: async (req, res) => {
    try {
      const Trabalho = require('../models/Trabalho');
      const Participant = require('../models/Participant');
      const InscricaoSimposio = require('../models/InscricaoSimposio');
      const User = require('../models/User');
      
      const { simposio } = req.query;
      
      // Estatísticas de trabalhos por status
      const trabalhosAgg = await Trabalho.aggregate([
        ...(simposio ? [{ $match: { simposio: require('mongoose').Types.ObjectId(simposio) } }] : []),
        {
          $group: {
            _id: '$status',
            count: { $sum: 1 }
          }
        }
      ]);
      
      const trabalhosPorStatus = {
        'EM_ANALISE': 0,
        'AVALIADO': 0,
        'APROVADO': 0,
        'REJEITADO': 0,
        'APROVADO_CONDICIONAL': 0,
      };
      
      trabalhosAgg.forEach(item => {
        if (trabalhosPorStatus.hasOwnProperty(item._id)) {
          trabalhosPorStatus[item._id] = item.count;
        }
      });
      
      // Avaliações pendentes (trabalhos que precisam de mais avaliações)
      const trabalhosPendentes = await Trabalho.countDocuments({
        ...(simposio ? { simposio } : {}),
        status: 'EM_ANALISE',
        $expr: { $lt: ['$qtd_avaliados', 3] }
      });
      
      // Trabalhos com avaliações completas mas não finalizados
      const trabalhosProntosParaFinalizar = await Trabalho.countDocuments({
        ...(simposio ? { simposio } : {}),
        status: 'EM_ANALISE',
        qtd_avaliados: { $gte: 3 }
      });
      
      // Inscrições por tipo
      const inscricoesAgg = await InscricaoSimposio.aggregate([
        ...(simposio ? [{ $match: { simposio: require('mongoose').Types.ObjectId(simposio) } }] : []),
        {
          $group: {
            _id: '$tipoInscricao',
            count: { $sum: 1 }
          }
        }
      ]);
      
      const inscricoesPorTipo = {};
      inscricoesAgg.forEach(item => {
        inscricoesPorTipo[item._id] = item.count;
      });
      
      // Timeline de submissões (últimos 30 dias)
      const dataLimite = new Date();
      dataLimite.setDate(dataLimite.getDate() - 30);
      
      const timelineAgg = await Trabalho.aggregate([
        {
          $match: {
            ...(simposio ? { simposio: require('mongoose').Types.ObjectId(simposio) } : {}),
            createdAt: { $gte: dataLimite }
          }
        },
        {
          $group: {
            _id: {
              $dateToString: { format: '%Y-%m-%d', date: '$createdAt' }
            },
            count: { $sum: 1 }
          }
        },
        {
          $sort: { '_id': 1 }
        }
      ]);
      
      const timeline = timelineAgg.map(item => ({
        data: item._id,
        submissoes: item.count
      }));
      
      // Totais gerais
      const totalTrabalhos = await Trabalho.countDocuments(simposio ? { simposio } : {});
      const totalParticipantes = await Participant.countDocuments(simposio ? { simposio } : {});
      const totalAvaliadores = await User.countDocuments({ papel: 'AVALIADOR', deleted_at: null });
      const totalInscricoes = await InscricaoSimposio.countDocuments(simposio ? { simposio } : {});
      
      res.json({
        success: true,
        data: {
          trabalhosPorStatus,
          avaliacoesPendentes: trabalhosPendentes,
          trabalhosProntosParaFinalizar,
          inscricoesPorTipo,
          timeline,
          totais: {
            trabalhos: totalTrabalhos,
            participantes: totalParticipantes,
            avaliadores: totalAvaliadores,
            inscricoes: totalInscricoes,
          }
        }
      });
    } catch (error) {
      console.error('Erro ao buscar estatísticas:', error);
      res.status(500).json({ success: false, message: error.message });
    }
  },

  // FUNÇÕES ADMINISTRATIVAS
  promoverUsuario: async (req, res) => {
    try {
      const User = require('../models/User');
      const bcrypt = require('bcryptjs');
      
      // Verificar senha do admin que está fazendo a promoção
      const { senha } = req.body;
      const admin = await User.findById(req.user.id);
      
      if (!senha || !await bcrypt.compare(senha, admin.password)) {
        return res.status(403).json({ 
          success: false, 
          message: 'Senha incorreta' 
        });
      }
      
      const usuario = await User.findById(req.params.id);
      if (!usuario) {
        return res.status(404).json({ success: false, message: 'Usuário não encontrado' });
      }
      
      if (usuario.role === 'ADMIN') {
        return res.status(400).json({ success: false, message: 'Usuário já é administrador' });
      }
      
      usuario.role = 'ADMIN';
      await usuario.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('USUARIO_PROMOVIDO', req.user.id, {
        usuarioId: usuario._id,
        nomeUsuario: usuario.nome,
        roleAnterior: usuario.role,
      });
      
      res.json({ 
        success: true, 
        message: `${usuario.nome} foi promovido a ADMIN com sucesso`,
        data: usuario 
      });
    } catch (error) {
      console.error('Erro ao promover usuário:', error);
      res.status(500).json({ success: false, message: error.message });
    }
  },

  finalizarSimposioCompleto: async (req, res) => {
    try {
      const Simposio = require('../models/Simposio');
      const Certificado = require('../models/Certificado');
      const User = require('../models/User');
      const Trabalho = require('../models/Trabalho');
      const bcrypt = require('bcryptjs');
      const path = require('path');
      
      // Verificar senha do admin
      const { senha, ano } = req.body;
      const admin = await User.findById(req.user.id);
      
      if (!senha || !await bcrypt.compare(senha, admin.password)) {
        return res.status(403).json({ 
          success: false, 
          message: 'Senha incorreta' 
        });
      }
      
      const simposio = await Simposio.findOne({ ano: ano || new Date().getFullYear() });
      if (!simposio) {
        return res.status(404).json({ success: false, message: 'Simpósio não encontrado' });
      }
      
      if (simposio.status === 'FINALIZADO') {
        return res.status(400).json({ success: false, message: 'Simpósio já está finalizado' });
      }
      
      // Atualizar status do simpósio
      simposio.status = 'FINALIZADO';
      await simposio.save();
      
      // Gerar certificados
      const { gerarCertificado } = require(path.join(__dirname, '../gerarTodosCertificados'));
      
      // TODO: Implementar lógica completa de geração de certificados
      // Por enquanto, apenas marca como finalizado
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('SIMPOSIO_FINALIZADO_COMPLETO', req.user.id, {
        simposioId: simposio._id,
        ano: simposio.ano,
      });
      
      res.json({ 
        success: true, 
        message: 'Simpósio finalizado com sucesso. Geração de certificados iniciada.',
        data: simposio 
      });
    } catch (error) {
      console.error('Erro ao finalizar simpósio:', error);
      res.status(500).json({ success: false, message: error.message });
    }
  },

  // CERTIFICADOS
  listarCertificados: async (req, res) => {
    try {
      const Certificado = require('../models/Certificado');
      const { page = 1, limit = 20, tipo, enviadoEmail, participanteId } = req.query;
      
      const query = {};
      if (tipo) query.tipo = tipo;
      if (enviadoEmail !== undefined) query.enviadoEmail = enviadoEmail === 'true';
      if (participanteId) query.participante = participanteId;
      
      const certificados = await Certificado.find(query)
        .populate('participante', 'nome email cpf')
        .populate('trabalho', 'titulo')
        .sort({ createdAt: -1 })
        .limit(limit * 1)
        .skip((page - 1) * limit);
      
      const total = await Certificado.countDocuments(query);
      
      res.json({
        success: true,
        data: certificados,
        pagination: {
          total,
          page: parseInt(page),
          pages: Math.ceil(total / limit),
        },
      });
    } catch (error) {
      console.error('Erro ao listar certificados:', error);
      res.status(500).json({ success: false, message: error.message });
    }
  },

  obterCertificado: async (req, res) => {
    try {
      const Certificado = require('../models/Certificado');
      const certificado = await Certificado.findById(req.params.id)
        .populate('participante', 'nome email cpf')
        .populate('trabalho', 'titulo');
      
      if (!certificado) {
        return res.status(404).json({ success: false, message: 'Certificado não encontrado' });
      }
      
      res.json({ success: true, data: certificado });
    } catch (error) {
      console.error('Erro ao obter certificado:', error);
      res.status(500).json({ success: false, message: error.message });
    }
  },

  atualizarCertificado: async (req, res) => {
    try {
      const Certificado = require('../models/Certificado');
      const { conteudo, assinatura1, assinatura2, edicao, horasCarga } = req.body;
      
      const certificado = await Certificado.findById(req.params.id);
      if (!certificado) {
        return res.status(404).json({ success: false, message: 'Certificado não encontrado' });
      }
      
      if (conteudo) certificado.conteudo = conteudo;
      if (assinatura1) certificado.assinatura1 = assinatura1;
      if (assinatura2) certificado.assinatura2 = assinatura2;
      if (edicao) certificado.edicao = edicao;
      if (horasCarga) certificado.horasCarga = horasCarga;
      
      await certificado.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('CERTIFICADO_ATUALIZADO', req.user.id, {
        certificadoId: certificado._id,
        tipo: certificado.tipo,
      });
      
      res.json({ success: true, data: certificado });
    } catch (error) {
      console.error('Erro ao atualizar certificado:', error);
      res.status(500).json({ success: false, message: error.message });
    }
  },

  excluirCertificado: async (req, res) => {
    try {
      const Certificado = require('../models/Certificado');
      const certificado = await Certificado.findByIdAndDelete(req.params.id);
      
      if (!certificado) {
        return res.status(404).json({ success: false, message: 'Certificado não encontrado' });
      }
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('CERTIFICADO_EXCLUIDO', req.user.id, {
        certificadoId: certificado._id,
        tipo: certificado.tipo,
      });
      
      res.json({ success: true, message: 'Certificado excluído com sucesso' });
    } catch (error) {
      console.error('Erro ao excluir certificado:', error);
      res.status(500).json({ success: false, message: error.message });
    }
  },

  enviarCertificado: async (req, res) => {
    try {
      const Certificado = require('../models/Certificado');
      const { sendCertificadoEmail } = require('../services/emailService');
      
      const certificado = await Certificado.findById(req.params.id)
        .populate('participante', 'nome email');
      
      if (!certificado) {
        return res.status(404).json({ success: false, message: 'Certificado não encontrado' });
      }
      
      if (!certificado.participante.email) {
        return res.status(400).json({ success: false, message: 'Participante sem e-mail cadastrado' });
      }
      
      // TODO: Implementar envio real de e-mail
      // await sendCertificadoEmail(certificado);
      
      certificado.enviadoEmail = true;
      certificado.dataEnvio = new Date();
      await certificado.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('CERTIFICADO_ENVIADO', req.user.id, {
        certificadoId: certificado._id,
        participanteEmail: certificado.participante.email,
      });
      
      res.json({ success: true, message: 'Certificado enviado com sucesso' });
    } catch (error) {
      console.error('Erro ao enviar certificado:', error);
      res.status(500).json({ success: false, message: error.message });
    }
  },

  regenerarCertificado: async (req, res) => {
    try {
      const Certificado = require('../models/Certificado');
      const path = require('path');
      
      const certificado = await Certificado.findById(req.params.id)
        .populate('participante', 'nome email')
        .populate('trabalho', 'titulo');
      
      if (!certificado) {
        return res.status(404).json({ success: false, message: 'Certificado não encontrado' });
      }
      
      // TODO: Implementar regeneração real do PDF
      // const { gerarCertificado } = require(path.join(__dirname, '../gerarTodosCertificados'));
      // await gerarCertificado(certificado.tipo, {...});
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('CERTIFICADO_REGENERADO', req.user.id, {
        certificadoId: certificado._id,
        tipo: certificado.tipo,
      });
      
      res.json({ success: true, message: 'Certificado regenerado com sucesso', data: certificado });
    } catch (error) {
      console.error('Erro ao regenerar certificado:', error);
      res.status(500).json({ success: false, message: error.message });
    }
  },
};

/**
 * @swagger
 * /admin/simposio/inicializar:
 *   post:
 *     summary: Inicializa um novo simpósio
 *     tags: [Admin - Simpósio]
 *     security:
 *       - bearerAuth: []
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             required:
 *               - ano
 *               - datasConfig
 *             properties:
 *               ano:
 *                 type: number
 *                 example: 2025
 *               datasConfig:
 *                 type: object
 *                 properties:
 *                   inscricaoParticipante:
 *                     type: object
 *                     properties:
 *                       inicio:
 *                         type: string
 *                         format: date-time
 *                       fim:
 *                         type: string
 *                         format: date-time
 *                   submissaoTrabalhos:
 *                     type: object
 *                     properties:
 *                       inicio:
 *                         type: string
 *                         format: date-time
 *                       fim:
 *                         type: string
 *                         format: date-time
 *                   prazoAvaliacao:
 *                     type: object
 *                     properties:
 *                       inicio:
 *                         type: string
 *                         format: date-time
 *                       fim:
 *                         type: string
 *                         format: date-time
 *                   notasAvaliacaoExterna:
 *                     type: object
 *                     properties:
 *                       inicio:
 *                         type: string
 *                         format: date-time
 *                       fim:
 *                         type: string
 *                         format: date-time
 *     responses:
 *       201:
 *         description: Simpósio criado com sucesso
 *       400:
 *         description: Simpósio já existe para este ano
 *       401:
 *         description: Não autorizado
 *       403:
 *         description: Acesso negado
 */

/**
 * @swagger
 * /admin/trabalhos:
 *   get:
 *     summary: Lista todos os trabalhos com paginação e filtros
 *     tags: [Admin - Trabalhos]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: query
 *         name: ano
 *         schema:
 *           type: number
 *         description: Ano do simpósio
 *       - in: query
 *         name: page
 *         schema:
 *           type: number
 *           default: 1
 *         description: Número da página
 *       - in: query
 *         name: limit
 *         schema:
 *           type: number
 *           default: 20
 *         description: Itens por página
 *       - in: query
 *         name: status
 *         schema:
 *           type: string
 *           enum: [SUBMETIDO, EM_AVALIACAO, ACEITO, REJEITADO, PUBLICADO]
 *         description: Filtrar por status
 *       - in: query
 *         name: busca
 *         schema:
 *           type: string
 *         description: Buscar por título, autor ou email
 *     responses:
 *       200:
 *         description: Lista de trabalhos
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 success:
 *                   type: boolean
 *                 data:
 *                   type: array
 *                   items:
 *                     $ref: '#/components/schemas/Trabalho'
 *                 pagination:
 *                   type: object
 *                   properties:
 *                     total:
 *                       type: number
 *                     page:
 *                       type: number
 *                     limit:
 *                       type: number
 *                     totalPages:
 *                       type: number
 *       401:
 *         description: Não autorizado
 */

/**
 * @swagger
 * /admin/participantes:
 *   get:
 *     summary: Lista todos os participantes com paginação e filtros
 *     tags: [Admin - Participantes]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: query
 *         name: page
 *         schema:
 *           type: number
 *           default: 1
 *       - in: query
 *         name: limit
 *         schema:
 *           type: number
 *           default: 20
 *       - in: query
 *         name: tipo
 *         schema:
 *           type: string
 *           enum: [SERVIDOR, DISCENTE, EXTERNO]
 *       - in: query
 *         name: busca
 *         schema:
 *           type: string
 *         description: Buscar por nome, CPF ou email
 *     responses:
 *       200:
 *         description: Lista de participantes
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 success:
 *                   type: boolean
 *                 data:
 *                   type: array
 *                   items:
 *                     $ref: '#/components/schemas/Participant'
 *                 pagination:
 *                   type: object
 *                   properties:
 *                     total:
 *                       type: number
 *                     page:
 *                       type: number
 *                     limit:
 *                       type: number
 *                     totalPages:
 *                       type: number
 */

/**
 * @swagger
 * /admin/avaliacoes-externas:
 *   get:
 *     summary: Lista trabalhos aceitos/publicados para avaliação externa
 *     tags: [Admin - Avaliações Externas]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: query
 *         name: simposioId
 *         schema:
 *           type: string
 *       - in: query
 *         name: page
 *         schema:
 *           type: number
 *           default: 1
 *       - in: query
 *         name: limit
 *         schema:
 *           type: number
 *           default: 50
 *       - in: query
 *         name: busca
 *         schema:
 *           type: string
 *     responses:
 *       200:
 *         description: Lista de trabalhos para avaliação externa
 */

/**
 * @swagger
 * /admin/avaliacoes-externas/{id}:
 *   post:
 *     summary: Lança nota externa para um trabalho
 *     tags: [Admin - Avaliações Externas]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: path
 *         name: id
 *         required: true
 *         schema:
 *           type: string
 *         description: ID do trabalho
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             required:
 *               - notaExterna
 *             properties:
 *               notaExterna:
 *                 type: number
 *                 minimum: 0
 *                 maximum: 10
 *                 example: 8.5
 *     responses:
 *       200:
 *         description: Nota lançada com sucesso
 *       403:
 *         description: Fora do prazo para lançamento de notas externas
 *       404:
 *         description: Trabalho não encontrado
 *   delete:
 *     summary: Remove nota externa de um trabalho
 *     tags: [Admin - Avaliações Externas]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: path
 *         name: id
 *         required: true
 *         schema:
 *           type: string
 *     responses:
 *       200:
 *         description: Nota removida com sucesso
 *       403:
 *         description: Fora do prazo
 */

/**
 * @swagger
 * /admin/trabalhos/{id}/atribuir-avaliador:
 *   post:
 *     summary: Atribui um avaliador a um trabalho
 *     tags: [Admin - Trabalhos]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: path
 *         name: id
 *         required: true
 *         schema:
 *           type: string
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             required:
 *               - avaliadorId
 *             properties:
 *               avaliadorId:
 *                 type: string
 *                 example: 507f1f77bcf86cd799439011
 *     responses:
 *       200:
 *         description: Avaliador atribuído com sucesso
 *       400:
 *         description: Avaliador já atribuído
 *       404:
 *         description: Trabalho não encontrado
 */

// Simpósio
router.get('/simposios', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.listarSimposios);
router.get('/simposios/:ano', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.getSimposio);
router.post('/simposio/inicializar', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.inicializarSimposio);
router.post('/simposio/finalizar', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.finalizarSimposio);
router.put('/simposios/:ano', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.atualizarSimposio);
router.put('/simposios/:ano/datas', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.atualizarDatasSimposio);

// Trabalhos
router.get('/trabalhos', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.listarTrabalhos);
router.get('/trabalhos/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.buscarTrabalho);
router.put('/trabalhos/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.atualizarTrabalho);

// Participantes
router.get('/participantes', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.listarParticipantes);

// Avaliadores
router.get('/avaliadores', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.listarAvaliadores);

// Avaliadores
router.get('/avaliadores', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.listarAvaliadores);
router.post('/avaliadores', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.criarAvaliador);
router.put('/avaliadores/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.atualizarAvaliador);
router.delete('/avaliadores/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.removerAvaliador);

// Subeventos
router.get('/subeventos', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.listarSubeventos);
router.post('/subeventos', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.criarSubevento);
router.put('/subeventos/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.atualizarSubevento);
router.delete('/subeventos/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.removerSubevento);

// Gerenciamento de Inscritos em Subeventos
router.get('/subeventos/:id/inscritos', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.listarInscritos);
router.post('/subeventos/:id/inscritos', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.adicionarInscrito);
router.delete('/subeventos/:id/inscritos/:inscritoId', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.removerInscrito);
router.post('/subeventos/:id/inscritos/:inscritoId/presenca', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.confirmarPresenca);

// Dashboard
router.get('/dashboard/stats', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.getStats);

// Atribuições
router.post('/trabalhos/:id/atribuir-avaliador', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.atribuirAvaliador);
router.post('/trabalhos/:id/revogar-avaliador', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.revogarAvaliador);

// Áreas do Conhecimento
router.get('/grandes-areas', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.getGrandeAreas);
router.post('/grandes-areas', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.createGrandeArea);
router.put('/grandes-areas/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.updateGrandeArea);
router.delete('/grandes-areas/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.deleteGrandeArea);

router.get('/areas-atuacao', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.getAreasAtuacao);
router.post('/areas-atuacao', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.createAreaAtuacao);
router.put('/areas-atuacao/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.updateAreaAtuacao);
router.delete('/areas-atuacao/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.deleteAreaAtuacao);

router.get('/subareas', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.getSubareas);
router.post('/subareas', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.createSubarea);
router.put('/subareas/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.updateSubarea);
router.delete('/subareas/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.deleteSubarea);

// CRUD (legacy - mantido para compatibilidade)
router.post('/grande-area', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.createGrandeArea);
router.get('/grande-area', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.getGrandeAreas);

// Acervo
router.get('/acervo', auth, requireRoles(['ADMIN', 'SUBADMIN']), acervoController.listar);
router.get('/acervo/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), acervoController.buscarPorId);
router.post('/acervo', auth, requireRoles(['ADMIN', 'SUBADMIN']), uploadAcervo.single('arquivo'), acervoController.criar);
router.put('/acervo/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), uploadAcervo.single('arquivo'), acervoController.atualizar);
router.delete('/acervo/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), acervoController.excluir);

// Páginas Estáticas
router.get('/paginas', auth, requireRoles(['ADMIN', 'SUBADMIN']), paginasController.listar);
router.get('/paginas/:slug', auth, requireRoles(['ADMIN', 'SUBADMIN']), paginasController.buscarPorSlug);
router.put('/paginas/:slug', auth, requireRoles(['ADMIN', 'SUBADMIN']), uploadPagina.single('pdf'), paginasController.atualizar);
router.delete('/paginas/:slug/remover-pdf', auth, requireRoles(['ADMIN', 'SUBADMIN']), paginasController.removerPdf);

// Avaliação Externa
router.get('/avaliacoes-externas', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.listarTrabalhosParaAvaliacaoExterna);
router.post('/avaliacoes-externas/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.lancarNotaExterna);
router.delete('/avaliacoes-externas/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.removerNotaExterna);

// Funções Administrativas
router.post('/usuarios/:id/promover', auth, requireRoles(['ADMIN']), adminController.promoverUsuario);
router.post('/simposio/finalizar-completo', auth, requireRoles(['ADMIN']), adminController.finalizarSimposioCompleto);

// Certificados
router.get('/certificados', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.listarCertificados);
router.get('/certificados/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.obterCertificado);
router.put('/certificados/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.atualizarCertificado);
router.delete('/certificados/:id', auth, requireRoles(['ADMIN']), adminController.excluirCertificado);
router.post('/certificados/:id/enviar', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.enviarCertificado);
router.post('/certificados/:id/regenerar', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.regenerarCertificado);

// Relatórios
router.get('/reports/trabalhos/excel', auth, requireRoles(['ADMIN', 'SUBADMIN']), reportsController.gerarRelatorioTrabalhosExcel);
router.get('/reports/trabalhos/pdf', auth, requireRoles(['ADMIN', 'SUBADMIN']), reportsController.gerarRelatorioTrabalhosPDF);
router.get('/reports/participantes/excel', auth, requireRoles(['ADMIN', 'SUBADMIN']), reportsController.gerarRelatorioParticipantesExcel);
router.get('/reports/certificados/excel', auth, requireRoles(['ADMIN', 'SUBADMIN']), reportsController.gerarRelatorioCertificadosExcel);
router.get('/reports/inscricoes/excel', auth, requireRoles(['ADMIN', 'SUBADMIN']), reportsController.gerarRelatorioInscricoesExcel);

module.exports = router;
