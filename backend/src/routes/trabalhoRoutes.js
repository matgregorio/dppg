const express = require('express');
const router = express.Router();
const auth = require('../middlewares/auth');
const trabalhoController = require('../controllers/trabalhoController');

/**
 * Rotas para submissão e gerenciamento de trabalhos pelo usuário
 */

// Submeter novo trabalho
router.post('/', auth, trabalhoController.submeterTrabalho);

// Listar meus trabalhos
router.get('/meus', auth, trabalhoController.meusTrabalhosTrabalhos);

// Buscar trabalho específico
router.get('/:id', auth, trabalhoController.buscarTrabalho);

// Atualizar trabalho
router.put('/:id', auth, trabalhoController.atualizarTrabalho);

module.exports = router;
