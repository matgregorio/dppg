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
      const ano = req.query.ano || process.env.DEFAULT_SIMPOSIO_ANO;
      const Simposio = require('../models/Simposio');
      const simposio = await Simposio.findOne({ ano: parseInt(ano) });
      
      if (!simposio) {
        return res.status(404).json({ success: false, message: 'Simpósio não encontrado' });
      }
      
      const trabalhos = await Trabalho.find({
        simposio: simposio._id,
        'autores.email': req.user.email,
      });
      
      res.json({ success: true, data: trabalhos });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  // Buscar trabalho específico (sem nome dos avaliadores para ética)
  getTrabalho: async (req, res) => {
    try {
      const Trabalho = require('../models/Trabalho');
      
      const trabalho = await Trabalho.findById(req.params.id)
        .populate('simposio', 'ano status')
        .populate('grandeArea', 'nome')
        .populate('areaAtuacao', 'nome')
        .populate('subarea', 'nome');
      
      if (!trabalho) {
        return res.status(404).json({ success: false, message: 'Trabalho não encontrado' });
      }
      
      // Verifica se o usuário é autor
      const isAutor = trabalho.autores.some(a => a.email === req.user.email);
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
      const { titulo, autores, palavras_chave, grandeArea, areaAtuacao, subarea } = req.body;
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
        autores: JSON.parse(autores),
        palavras_chave: JSON.parse(palavras_chave || '[]'),
        grandeArea,
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
      
      const participant = await Participant.findOne({ user: req.user.id });
      if (!participant) {
        return res.status(400).json({ success: false, message: 'Participante não encontrado' });
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
};

router.get('/certificados', auth, requireRoles(['USER', 'AVALIADOR', 'SUBADMIN', 'ADMIN']), userController.getCertificados);
router.get('/trabalhos', auth, requireRoles(['USER']), userController.getTrabalhos);
router.get('/trabalhos/:id', auth, requireRoles(['USER']), userController.getTrabalho);
router.post('/trabalhos', auth, requireRoles(['USER']), enforceWindow('submissaoTrabalhos'), upload.single('arquivo'), userController.submeterTrabalho);
router.post('/inscricoes/simposio', auth, requireRoles(['USER']), enforceWindow('inscricaoParticipante'), userController.inscreverSimposio);
router.get('/inscricoes', auth, requireRoles(['USER']), userController.getInscricoes);

module.exports = router;
