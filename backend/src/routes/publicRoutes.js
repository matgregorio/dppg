const express = require('express');
const router = express.Router();
const acervoController = require('../controllers/acervoController');
const optionalAuth = require('../middlewares/optionalAuth');

// Placeholder controllers - serão implementados
const publicController = {
  getSimposios: async (req, res) => {
    try {
      const Simposio = require('../models/Simposio');
      const simposios = await Simposio.find({}).sort({ ano: -1 }).select('ano nome descricao local status datasConfig');
      res.json({ success: true, data: simposios });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  getSimposioPorAno: async (req, res) => {
    try {
      const Simposio = require('../models/Simposio');
      const ano = parseInt(req.params.ano);
      
      const simposio = await Simposio.findOne({ ano }).select('ano nome descricao local status datasConfig datas');
      
      if (!simposio) {
        return res.status(404).json({ success: false, message: 'Simpósio não encontrado' });
      }
      
      // Mapear datasConfig para datas (mantendo compatibilidade)
      const responseData = {
        ...simposio.toObject(),
        datas: simposio.datasConfig
      };
      
      res.json({ success: true, data: responseData });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  getPagina: async (req, res) => {
    try {
      const PaginasEstaticas = require('../models/PaginasEstaticas');
      const pagina = await PaginasEstaticas.findOne({ slug: req.params.slug });
      
      if (!pagina) {
        return res.status(404).json({ success: false, message: 'Página não encontrada' });
      }
      
      res.json({ success: true, data: pagina });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  getProgramacao: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      const Simposio = require('../models/Simposio');
      
      const ano = req.query.ano || process.env.DEFAULT_SIMPOSIO_ANO || new Date().getFullYear();
      const simposio = await Simposio.findOne({ ano: parseInt(ano) });
      
      if (!simposio) {
        return res.status(404).json({ success: false, message: 'Simpósio não encontrado' });
      }
      
      const subeventos = await Subevento.find({ simposio: simposio._id }).sort({ data: 1, horarioInicio: 1 });
      
      res.json({ success: true, data: { simposio, subeventos } });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  validarCertificado: async (req, res) => {
    try {
      const Certificado = require('../models/Certificado');
      const certificado = await Certificado.findOne({ hashValidacao: req.params.hash })
        .populate('participante')
        .populate('simposio')
        .populate('trabalho');
      
      if (!certificado || certificado.status !== 'ATIVO') {
        return res.status(404).json({ success: false, message: 'Certificado não encontrado ou revogado' });
      }
      
      res.json({ success: true, data: certificado });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  getModeloPoster: async (req, res) => {
    try {
      const PaginasEstaticas = require('../models/PaginasEstaticas');
      const pagina = await PaginasEstaticas.findOne({ slug: 'modelo-poster' });
      
      if (!pagina || !pagina.pdf) {
        return res.status(404).json({ success: false, message: 'Modelo não encontrado' });
      }
      
      res.json({ success: true, data: { pdfPath: `/uploads/${pagina.pdf}` } });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },

  getSubeventos: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      const Simposio = require('../models/Simposio');
      const simposioId = req.params.simposioId;
      
      const simposio = await Simposio.findById(simposioId);
      if (!simposio) {
        return res.status(404).json({ success: false, message: 'Simpósio não encontrado' });
      }
      
      const subeventos = await Subevento.find({ simposio: simposioId }).sort({ data: 1, horarioInicio: 1 });
      
      // Se houver usuário autenticado, buscar presenças dele
      if (req.user) {
        const Presenca = require('../models/Presenca');
        const Participant = require('../models/Participant');
        
        const participant = await Participant.findOne({ user: req.user.userId });
        if (participant) {
          const presencas = await Presenca.find({ 
            participant: participant._id,
            subevento: { $in: subeventos.map(s => s._id) }
          });
          
          console.log(`[DEBUG] Usuário ${req.user.userId} - Participant: ${participant._id} - Presenças encontradas: ${presencas.length}`);
          
          const presencasMap = {};
          presencas.forEach(p => {
            presencasMap[p.subevento.toString()] = true;
            console.log(`[DEBUG] Presença confirmada no subevento: ${p.subevento}`);
          });
          
          // Adiciona flag de presença em cada subevento
          subeventos.forEach(s => {
            s._doc.presenca = presencasMap[s._id.toString()] || false;
            console.log(`[DEBUG] Subevento ${s.titulo} - presenca: ${s._doc.presenca}`);
          });
        } else {
          console.log(`[DEBUG] Participante não encontrado para usuário ${req.user.userId}`);
        }
      } else {
        console.log(`[DEBUG] Requisição sem autenticação`);
      }
      
      res.json({ success: true, data: subeventos });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
};

router.get('/simposios', publicController.getSimposios);
router.get('/simposios/:ano', publicController.getSimposioPorAno);
router.get('/simposios/:simposioId/subeventos', optionalAuth, publicController.getSubeventos);
router.get('/paginas/:slug', publicController.getPagina);
router.get('/programacao', publicController.getProgramacao);
router.get('/certificados/validar/:hash', publicController.validarCertificado);
router.get('/modelo-poster', publicController.getModeloPoster);
router.get('/acervo', acervoController.listarPublico);

module.exports = router;
