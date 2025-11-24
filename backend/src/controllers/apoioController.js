const Apoio = require('../models/Apoio');
const { logAudit } = require('../utils/auditLogger');

/**
 * Listar todos os apoios
 */
exports.listarApoios = async (req, res) => {
  try {
    const apoios = await Apoio.find().sort({ nome: 1 });

    res.json({
      success: true,
      data: apoios,
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao listar apoios',
      error: error.message,
    });
  }
};

/**
 * Buscar apoio por ID
 */
exports.buscarApoio = async (req, res) => {
  try {
    const apoio = await Apoio.findById(req.params.id);

    if (!apoio) {
      return res.status(404).json({
        success: false,
        message: 'Apoio não encontrado',
      });
    }

    res.json({
      success: true,
      data: apoio,
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao buscar apoio',
      error: error.message,
    });
  }
};

/**
 * Criar novo apoio
 */
exports.criarApoio = async (req, res) => {
  try {
    const { nome, sigla, tipo } = req.body;

    const apoio = await Apoio.create({
      nome,
      sigla,
      tipo: tipo || 'FINANCEIRO',
    });

    logAudit('APOIO_CREATED', req.user?.id || 'SYSTEM', {
      apoioId: apoio._id,
      nome,
    });

    res.status(201).json({
      success: true,
      message: 'Apoio cadastrado com sucesso',
      data: apoio,
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao criar apoio',
      error: error.message,
    });
  }
};

/**
 * Atualizar apoio
 */
exports.atualizarApoio = async (req, res) => {
  try {
    const { nome, sigla, tipo } = req.body;

    const apoio = await Apoio.findById(req.params.id);
    
    if (!apoio) {
      return res.status(404).json({
        success: false,
        message: 'Apoio não encontrado',
      });
    }

    if (nome) apoio.nome = nome;
    if (sigla) apoio.sigla = sigla;
    if (tipo) apoio.tipo = tipo;

    await apoio.save();

    logAudit('APOIO_UPDATED', req.user?.id || 'SYSTEM', {
      apoioId: apoio._id,
      changes: req.body,
    });

    res.json({
      success: true,
      message: 'Apoio atualizado com sucesso',
      data: apoio,
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao atualizar apoio',
      error: error.message,
    });
  }
};

/**
 * Excluir apoio (soft delete)
 */
exports.excluirApoio = async (req, res) => {
  try {
    const apoio = await Apoio.findById(req.params.id);

    if (!apoio) {
      return res.status(404).json({
        success: false,
        message: 'Apoio não encontrado',
      });
    }

    await apoio.softDelete();

    logAudit('APOIO_DELETED', req.user?.id || 'SYSTEM', {
      apoioId: apoio._id,
      nome: apoio.nome,
    });

    res.json({
      success: true,
      message: 'Apoio excluído com sucesso',
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao excluir apoio',
      error: error.message,
    });
  }
};
