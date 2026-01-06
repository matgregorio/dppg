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
      
      console.log('=== BUSCAR TRABALHO PARA AVALIAR ===');
      console.log('ID do trabalho:', req.params.id);
      console.log('ID do avaliador:', req.user.id);
      
      // Buscar trabalho ignorando o filtro de deleted_at
      const trabalho = await Trabalho.findOne({ 
        _id: req.params.id,
        deleted_at: null 
      });
      
      console.log('Trabalho encontrado:', trabalho ? 'SIM' : 'NÃO');
      
      if (!trabalho) {
        console.log('Trabalho não encontrado - ID:', req.params.id);
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
      
      // Enviar email ao autor informando sobre a avaliação recebida
      const emailService = require('../services/emailService');
      const Participant = require('../models/Participant');
      const User = require('../models/User');
      
      const autor = await Participant.findById(trabalho.autor).populate('user');
      if (autor && autor.user) {
        const statusAvaliacao = nota >= 7 ? 'Aprovado' : nota >= 5 ? 'Em análise' : 'Reprovado';
        emailService.enviarEmail('AVALIACAO_RECEBIDA', autor.user.email, {
          usuario_nome: autor.user.nome,
          trabalho_titulo: trabalho.titulo,
          avaliacao_status: statusAvaliacao,
          avaliacao_nota: nota.toString(),
          avaliacao_comentarios: parecer || 'Sem comentários',
          url_trabalhos: `${process.env.FRONTEND_URL || 'http://localhost:5173'}/trabalhos`,
        }).catch(err => console.error('Erro ao enviar email de avaliação recebida:', err));
      }
      
      res.json({ success: true, data: trabalho });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  getTrabalho: async (req, res) => {
    try {
      const Trabalho = require('../models/Trabalho');
      const Participant = require('../models/Participant');
      const Docente = require('../models/Docente');
      const Subarea = require('../models/Subarea');
      const AreaAtuacao = require('../models/AreaAtuacao');
      const Simposio = require('../models/Simposio');
      
      console.log('=== BUSCAR TRABALHO ESPECÍFICO ===');
      console.log('ID do trabalho:', req.params.id);
      console.log('ID do avaliador:', req.user.id);
      
      // Buscar trabalho sem populate
      const trabalho = await Trabalho.findOne({
        _id: req.params.id,
        deleted_at: null
      }).lean();
      
      console.log('Trabalho encontrado:', trabalho ? 'SIM' : 'NÃO');
      
      if (!trabalho) {
        console.log('Trabalho não encontrado - ID:', req.params.id);
        return res.status(404).json({ success: false, message: 'Trabalho não encontrado' });
      }
      
      // Verifica se está atribuído ao avaliador
      const atribuicao = trabalho.atribuicoes?.find(
        a => a.avaliador.toString() === req.user.id && !a.revogado_em
      );
      
      if (!atribuicao) {
        console.log('Trabalho não atribuído ao avaliador');
        return res.status(403).json({ success: false, message: 'Trabalho não atribuído a você' });
      }
      
      // Populate manual
      if (trabalho.autor) {
        try {
          const autor = await Participant.findById(trabalho.autor).select('nome email cpf telefone').lean();
          trabalho.autor = autor;
        } catch (err) {
          console.error('Erro ao popular autor:', err);
        }
      }
      
      if (trabalho.orientador) {
        try {
          const orientador = await Docente.findById(trabalho.orientador).select('nome email').lean();
          trabalho.orientador = orientador;
        } catch (err) {
          console.error('Erro ao popular orientador:', err);
        }
      }
      
      if (trabalho.subarea) {
        try {
          const subarea = await Subarea.findById(trabalho.subarea).select('nome').lean();
          trabalho.subarea = subarea;
        } catch (err) {
          console.error('Erro ao popular subarea:', err);
        }
      }
      
      if (trabalho.areaAtuacao) {
        try {
          const areaAtuacao = await AreaAtuacao.findById(trabalho.areaAtuacao).select('nome').lean();
          trabalho.areaAtuacao = areaAtuacao;
        } catch (err) {
          console.error('Erro ao popular areaAtuacao:', err);
        }
      }
      
      if (trabalho.simposio) {
        try {
          const simposio = await Simposio.findById(trabalho.simposio).select('ano nome status').lean();
          trabalho.simposio = simposio;
        } catch (err) {
          console.error('Erro ao popular simposio:', err);
        }
      }
      
      console.log('Trabalho retornado com sucesso');
      res.json({ success: true, data: trabalho });
    } catch (error) {
      console.error('Erro ao buscar trabalho:', error);
      res.status(500).json({ success: false, message: error.message });
    }
  },
};

router.get('/trabalhos', auth, requireRoles(['AVALIADOR']), avaliadorController.getTrabalhos);
router.get('/trabalhos/:id', auth, requireRoles(['AVALIADOR']), avaliadorController.getTrabalho);
router.post('/trabalhos/:id/avaliar', auth, requireRoles(['AVALIADOR']), enforceWindow('prazoAvaliacao'), avaliadorController.avaliarTrabalho);

module.exports = router;
