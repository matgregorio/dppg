const express = require('express');
const router = express.Router();
const auth = require('../middlewares/auth');
const orientadorController = require('../controllers/orientadorController');

/**
 * Rotas para orientadores avaliarem trabalhos
 */

// Listar trabalhos do orientador
router.get('/trabalhos', auth, orientadorController.listarTrabalhosOrientador);

// Buscar trabalho específico
router.get('/trabalhos/:id', auth, orientadorController.buscarTrabalhoOrientador);

// Avaliar trabalho (aprovar/reprovar)
router.post('/trabalhos/:id/avaliar', auth, orientadorController.avaliarTrabalho);

// Estatísticas do orientador
router.get('/estatisticas', auth, orientadorController.estatisticasOrientador);

module.exports = router;
