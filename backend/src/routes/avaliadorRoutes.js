const express = require('express');
const router = express.Router();
const auth = require('../middlewares/auth');
const requireRoles = require('../middlewares/requireRoles');
const enforceWindow = require('../middlewares/enforceWindow');

const avaliadorController = {
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
        'atribuicoes.avaliador': req.user.id,
        'atribuicoes.revogado_em': null,
      });
      
      res.json({ success: true, data: trabalhos });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  avaliarTrabalho: async (req, res) => {
    try {
      const { nota, parecer } = req.body;
      const Trabalho = require('../models/Trabalho');
      
      const trabalho = await Trabalho.findById(req.params.id);
      if (!trabalho) {
        return res.status(404).json({ success: false, message: 'Trabalho não encontrado' });
      }
      
      // Verifica se está atribuído
      const atribuicao = trabalho.atribuicoes.find(
        a => a.avaliador.toString() === req.user.id && !a.revogado_em
      );
      
      if (!atribuicao) {
        return res.status(403).json({ success: false, message: 'Trabalho não atribuído a você' });
      }
      
      // Verifica se já avaliou
      const jaAvaliou = trabalho.avaliacoes.find(
        a => a.avaliador.toString() === req.user.id
      );
      
      if (jaAvaliou) {
        return res.status(400).json({ success: false, message: 'Você já avaliou este trabalho' });
      }
      
      // Adiciona avaliação
      trabalho.avaliacoes.push({
        avaliador: req.user.id,
        nota,
        parecer,
      });
      
      // Atualiza contadores e média
      trabalho.qtd_avaliados = trabalho.avaliacoes.length;
      const somaNotas = trabalho.avaliacoes.reduce((sum, av) => sum + av.nota, 0);
      trabalho.media = somaNotas / trabalho.qtd_avaliados;
      
      if (trabalho.status === 'SUBMETIDO') {
        trabalho.status = 'EM_AVALIACAO';
      }
      
      await trabalho.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('AVALIACAO_REGISTRADA', req.user.id, { trabalhoId: trabalho._id, nota, media: trabalho.media });
      
      res.json({ success: true, data: trabalho });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
};

router.get('/trabalhos', auth, requireRoles(['AVALIADOR']), avaliadorController.getTrabalhos);
router.post('/trabalhos/:id/avaliar', auth, requireRoles(['AVALIADOR']), enforceWindow('prazoAvaliacao'), avaliadorController.avaliarTrabalho);

module.exports = router;
