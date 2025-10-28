const express = require('express');
const router = express.Router();
const acervoController = require('../controllers/acervoController');

// Placeholder controllers - serão implementados
const publicController = {
  getSimposios: async (req, res) => {
    try {
      const Simposio = require('../models/Simposio');
      const simposios = await Simposio.find({}).sort({ ano: -1 }).select('ano status datasConfig');
      res.json({ success: true, data: simposios });
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
};

router.get('/simposios', publicController.getSimposios);
router.get('/paginas/:slug', publicController.getPagina);
router.get('/programacao', publicController.getProgramacao);
router.get('/certificados/validar/:hash', publicController.validarCertificado);
router.get('/modelo-poster', publicController.getModeloPoster);
router.get('/acervo', acervoController.listarPublico);

module.exports = router;
