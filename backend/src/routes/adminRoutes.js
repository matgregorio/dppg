const express = require('express');
const router = express.Router();
const auth = require('../middlewares/auth');
const requireRoles = require('../middlewares/requireRoles');
const acervoController = require('../controllers/acervoController');
const paginasController = require('../controllers/paginasController');
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
      const { ano, datasConfig } = req.body;
      
      const exists = await Simposio.findOne({ ano });
      if (exists) {
        return res.status(400).json({ success: false, message: 'Simpósio já existe para este ano' });
      }
      
      const simposio = await Simposio.create({ ano, status: 'INICIALIZADO', datasConfig });
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('SIMPOSIO_INICIALIZADO', req.user.id, { ano });
      
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
      
      const avaliadores = await User.find({
        papel: 'AVALIADOR',
        deleted_at: null,
      }).select('nome email');
      
      res.json({
        success: true,
        data: avaliadores,
      });
    } catch (error) {
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
router.get('/simposios/:ano', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.getSimposio);
router.post('/simposio/inicializar', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.inicializarSimposio);
router.post('/simposio/finalizar', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.finalizarSimposio);
router.put('/simposios/:ano/datas', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.atualizarDatasSimposio);

// Trabalhos
router.get('/trabalhos', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.listarTrabalhos);
router.get('/trabalhos/:id', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.buscarTrabalho);

// Participantes
router.get('/participantes', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.listarParticipantes);

// Avaliadores
router.get('/avaliadores', auth, requireRoles(['ADMIN', 'SUBADMIN']), adminController.listarAvaliadores);

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

module.exports = router;
