const express = require('express');
const router = express.Router();
const auth = require('../middlewares/auth');
const requireRoles = require('../middlewares/requireRoles');
const enforceWindow = require('../middlewares/enforceWindow');
const multer = require('multer');

const upload = multer({ storage: multer.memoryStorage(), limits: { fileSize: 20 * 1024 * 1024 } });

// Placeholder controllers
const userController = {
  getCertificados: async (req, res) => {
    try {
      const Certificado = require('../models/Certificado');
      const Participant = require('../models/Participant');
      
      const participant = await Participant.findOne({ user: req.user.id });
      if (!participant) {
        return res.status(404).json({ success: false, message: 'Participante não encontrado' });
      }
      
      const certificados = await Certificado.find({ participante: participant._id, status: 'ATIVO' })
        .populate('simposio');
      
      res.json({ success: true, data: certificados });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  getTrabalhos: async (req, res) => {
    try {
      const Trabalho = require('../models/Trabalho');
      const Participant = require('../models/Participant');
      const AreaAtuacao = require('../models/AreaAtuacao');
      const Subarea = require('../models/Subarea');
      const ano = req.query.ano || process.env.DEFAULT_SIMPOSIO_ANO;
      const Simposio = require('../models/Simposio');
      const simposio = await Simposio.findOne({ ano: parseInt(ano) });
      
      if (!simposio) {
        return res.status(404).json({ success: false, message: 'Simpósio não encontrado' });
      }
      
      // Busca o participante associado ao usuário
      const participant = await Participant.findOne({ user: req.user.id });
      if (!participant) {
        return res.status(404).json({ success: false, message: 'Participante não encontrado' });
      }
      
      const trabalhos = await Trabalho.find({
        simposio: simposio._id,
        autor: participant._id,
      })
        .populate('areaAtuacao', 'nome')
        .populate('subarea', 'nome')
        .sort({ createdAt: -1 });
      
      res.json({ success: true, data: trabalhos });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  // Buscar trabalho específico (sem nome dos avaliadores para ética)
  getTrabalho: async (req, res) => {
    try {
      const Trabalho = require('../models/Trabalho');
      const Participant = require('../models/Participant');
      const AreaAtuacao = require('../models/AreaAtuacao');
      const Subarea = require('../models/Subarea');
      const Simposio = require('../models/Simposio');
      
      const trabalho = await Trabalho.findById(req.params.id)
        .populate('simposio', 'ano status')
        .populate('areaAtuacao', 'nome')
        .populate('subarea', 'nome')
        .populate('autor');
      
      if (!trabalho) {
        return res.status(404).json({ success: false, message: 'Trabalho não encontrado' });
      }
      
      // Verifica se o usuário é autor (busca o participante pelo usuário logado)
      const participant = await Participant.findOne({ user: req.user.id });
      if (!participant) {
        return res.status(403).json({ success: false, message: 'Participante não encontrado' });
      }
      
      // Verifica se o participante é o autor do trabalho
      const isAutor = trabalho.autor && trabalho.autor._id.toString() === participant._id.toString();
      if (!isAutor) {
        return res.status(403).json({ success: false, message: 'Acesso negado' });
      }
      
      // Remove o nome dos avaliadores das avaliações (ética)
      const trabalhoObj = trabalho.toObject();
      if (trabalhoObj.avaliacoes) {
        trabalhoObj.avaliacoes = trabalhoObj.avaliacoes.map(av => ({
          competencias: av.competencias,
          notaFinal: av.notaFinal,
          parecer: av.parecer,
          data: av.data,
          _id: av._id
        }));
      }
      
      // Remove informações sensíveis das atribuições
      delete trabalhoObj.atribuicoes;
      
      res.json({ success: true, data: trabalhoObj });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  submeterTrabalho: async (req, res) => {
    try {
      const { titulo, autores, palavras_chave, areaAtuacao, subarea } = req.body;
      const Trabalho = require('../models/Trabalho');
      const InscricaoSimposio = require('../models/InscricaoSimposio');
      const Participant = require('../models/Participant');
      const { saveFile } = require('../utils/storageService');
      
      // Verifica inscrição ativa
      const participant = await Participant.findOne({ user: req.user.id });
      if (!participant) {
        return res.status(400).json({ success: false, message: 'Participante não encontrado' });
      }
      
      const inscricao = await InscricaoSimposio.findOne({
        participant: participant._id,
        simposio: req.simposio._id,
        status: 'ATIVA',
      });
      
      if (!inscricao) {
        return res.status(400).json({ success: false, message: 'Você precisa ter uma inscrição ativa no simpósio' });
      }
      
      // Salva arquivo se houver
      let arquivoPath;
      if (req.file) {
        arquivoPath = await saveFile(req.file.buffer, req.file.originalname, 'trabalhos');
      }
      
      const trabalho = await Trabalho.create({
        titulo,
        autor: participant._id,
        autores: JSON.parse(autores),
        palavras_chave: JSON.parse(palavras_chave || '[]'),
        areaAtuacao,
        subarea,
        arquivo: arquivoPath,
        simposio: req.simposio._id,
        status: 'SUBMETIDO',
      });
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('TRABALHO_SUBMETIDO', req.user.id, { trabalhoId: trabalho._id, titulo });
      
      res.status(201).json({ success: true, data: trabalho });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  inscreverSimposio: async (req, res) => {
    try {
      const InscricaoSimposio = require('../models/InscricaoSimposio');
      const Participant = require('../models/Participant');
      const User = require('../models/User');
      
      let participant = await Participant.findOne({ user: req.user.id });
      
      // Se não existir participant, cria automaticamente baseado nos dados do usuário
      if (!participant) {
        const user = await User.findById(req.user.id);
        if (!user) {
          return res.status(400).json({ success: false, message: 'Usuário não encontrado' });
        }
        
        // Cria o registro de participante
        participant = await Participant.create({
          user: user._id,
          cpf: user.cpf,
          nome: user.nome,
          email: user.email,
          telefone: user.telefone || '',
          tipoParticipante: 'DOCENTE', // Valor padrão, pode ser alterado depois
        });
        
        const { logAudit } = require('../utils/auditLogger');
        logAudit('PARTICIPANT_AUTO_CREATED', req.user.id, { participantId: participant._id });
      }
      
      // Verifica se já existe inscrição
      const existing = await InscricaoSimposio.findOne({
        participant: participant._id,
        simposio: req.simposio._id,
      });
      
      if (existing && existing.status === 'ATIVA') {
        return res.status(400).json({ success: false, message: 'Você já possui inscrição ativa neste simpósio' });
      }
      
      const inscricao = await InscricaoSimposio.create({
        participant: participant._id,
        simposio: req.simposio._id,
        status: 'ATIVA',
      });
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('INSCRICAO_CRIADA', req.user.id, { inscricaoId: inscricao._id, simposioAno: req.simposio.ano });
      
      res.status(201).json({ success: true, data: inscricao });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  getInscricoes: async (req, res) => {
    try {
      const InscricaoSimposio = require('../models/InscricaoSimposio');
      const Participant = require('../models/Participant');
      
      const participant = await Participant.findOne({ user: req.user.id });
      if (!participant) {
        return res.json({ success: true, data: [] });
      }
      
      const inscricoes = await InscricaoSimposio.find({ participant: participant._id })
        .populate('simposio');
      
      res.json({ success: true, data: inscricoes });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },

  inscreverSubevento: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      const Participant = require('../models/Participant');
      const InscricaoSimposio = require('../models/InscricaoSimposio');
      const User = require('../models/User');
      const subeventoId = req.params.id;
      
      const subevento = await Subevento.findById(subeventoId);
      if (!subevento) {
        return res.status(404).json({ success: false, message: 'Subevento não encontrado' });
      }
      
      // Busca ou cria participante
      let participant = await Participant.findOne({ user: req.user.id });
      if (!participant) {
        const user = await User.findById(req.user.id);
        if (!user) {
          return res.status(404).json({ success: false, message: 'Usuário não encontrado' });
        }
        
        participant = await Participant.create({
          user: user._id,
          cpf: user.cpf,
          nome: user.nome,
          email: user.email,
          telefone: user.telefone || '',
          tipoParticipante: 'DOCENTE'
        });
        
        const { logAudit } = require('../utils/auditLogger');
        logAudit('PARTICIPANT_AUTO_CREATED', req.user.id, { 
          participantId: participant._id,
          reason: 'INSCRICAO_SUBEVENTO'
        });
      }
      
      // Verifica se o usuário é mesário responsável por este subevento
      const isMesarioResponsavel = subevento.responsaveisMesarios.some(
        mesarioId => mesarioId.toString() === req.user.id
      );
      
      if (isMesarioResponsavel) {
        return res.status(403).json({ 
          success: false, 
          message: 'Você é mesário responsável por este subevento e não pode se inscrever como participante.'
        });
      }
      
      // Verifica se está inscrito no simpósio
      const inscricao = await InscricaoSimposio.findOne({
        participant: participant._id,
        simposio: subevento.simposio,
        status: 'ATIVA'
      });
      
      if (!inscricao) {
        return res.status(403).json({ 
          success: false, 
          message: 'Você precisa estar inscrito no Simpósio para se inscrever em subeventos.'
        });
      }
      
      // Verifica se já está inscrito
      if (subevento.isParticipantInscrito(participant._id)) {
        return res.status(409).json({ 
          success: false, 
          message: 'Você já está inscrito neste subevento.' 
        });
      }
      
      // Verifica se há vagas disponíveis
      if (subevento.vagas) {
        const inscritosConfirmados = subevento.inscritos.filter(i => i.status === 'CONFIRMADO').length;
        if (inscritosConfirmados >= subevento.vagas) {
          return res.status(400).json({ 
            success: false, 
            message: 'Este subevento não possui mais vagas disponíveis.' 
          });
        }
      }
      
      // Verifica conflito de horários
      const conflito = await Subevento.verificarConflitoHorario(
        participant._id,
        subevento.data,
        subevento.horarioInicio,
        subevento.duracao
      );
      
      if (conflito.conflito) {
        return res.status(409).json({
          success: false,
          message: `Você já está inscrito em outro subevento neste horário: ${conflito.subevento.titulo}`,
          conflito: conflito.subevento
        });
      }
      
      // Adiciona inscrição
      subevento.inscritos.push({
        participant: participant._id,
        status: 'CONFIRMADO',
        dataInscricao: new Date()
      });
      
      await subevento.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('INSCRICAO_SUBEVENTO', req.user.id, { 
        subeventoId: subevento._id, 
        participantId: participant._id 
      });
      
      res.json({ 
        success: true, 
        message: 'Inscrição realizada com sucesso!',
        data: subevento
      });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },

  cancelarInscricaoSubevento: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      const Participant = require('../models/Participant');
      const subeventoId = req.params.id;
      
      const subevento = await Subevento.findById(subeventoId);
      if (!subevento) {
        return res.status(404).json({ success: false, message: 'Subevento não encontrado' });
      }
      
      const participant = await Participant.findOne({ user: req.user.id });
      if (!participant) {
        return res.status(404).json({ success: false, message: 'Participante não encontrado' });
      }
      
      // Verifica se está inscrito
      const inscritoIndex = subevento.inscritos.findIndex(
        i => i.participant.toString() === participant._id.toString() && i.status === 'CONFIRMADO'
      );
      
      if (inscritoIndex === -1) {
        return res.status(404).json({ 
          success: false, 
          message: 'Você não está inscrito neste subevento.' 
        });
      }
      
      // Remove a inscrição
      subevento.inscritos.splice(inscritoIndex, 1);
      await subevento.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('CANCELAMENTO_INSCRICAO_SUBEVENTO', req.user.id, { 
        subeventoId: subevento._id, 
        participantId: participant._id 
      });
      
      res.json({ 
        success: true, 
        message: 'Inscrição cancelada com sucesso!' 
      });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
};

router.get('/certificados', auth, requireRoles(['USER', 'MESARIO', 'AVALIADOR', 'SUBADMIN', 'ADMIN']), userController.getCertificados);
router.get('/trabalhos', auth, requireRoles(['USER', 'MESARIO']), userController.getTrabalhos);
router.get('/trabalhos/:id', auth, requireRoles(['USER', 'MESARIO']), userController.getTrabalho);
router.post('/trabalhos', auth, requireRoles(['USER', 'MESARIO']), enforceWindow('submissaoTrabalhos'), upload.single('arquivo'), userController.submeterTrabalho);
router.post('/inscricoes/simposio', auth, requireRoles(['USER', 'MESARIO']), enforceWindow('inscricaoParticipante'), userController.inscreverSimposio);
router.get('/inscricoes', auth, requireRoles(['USER', 'MESARIO']), userController.getInscricoes);
router.post('/inscricoes/subevento/:id', auth, requireRoles(['USER', 'MESARIO']), userController.inscreverSubevento);
router.delete('/inscricoes/subevento/:id', auth, requireRoles(['USER', 'MESARIO']), userController.cancelarInscricaoSubevento);

module.exports = router;
