const Instituicao = require('../models/Instituicao');
const { logAudit } = require('../utils/auditLogger');

/**
 * Listar todas as instituições
 */
exports.listarInstituicoes = async (req, res) => {
  try {
    const instituicoes = await Instituicao.find().sort({ nome: 1 });

    res.json({
      success: true,
      data: instituicoes,
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao listar instituições',
      error: error.message,
    });
  }
};

/**
 * Buscar instituição por ID
 */
exports.buscarInstituicao = async (req, res) => {
  try {
    const instituicao = await Instituicao.findById(req.params.id);

    if (!instituicao) {
      return res.status(404).json({
        success: false,
        message: 'Instituição não encontrada',
      });
    }

    res.json({
      success: true,
      data: instituicao,
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao buscar instituição',
      error: error.message,
    });
  }
};

/**
 * Criar nova instituição
 */
exports.criarInstituicao = async (req, res) => {
  try {
    const { nome, sigla, cidade, estado } = req.body;

    const instituicao = await Instituicao.create({
      nome,
      sigla,
      cidade,
      estado,
    });

    logAudit('INSTITUICAO_CREATED', req.user?.id || 'SYSTEM', {
      instituicaoId: instituicao._id,
      nome,
    });

    res.status(201).json({
      success: true,
      message: 'Instituição cadastrada com sucesso',
      data: instituicao,
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao criar instituição',
      error: error.message,
    });
  }
};

/**
 * Atualizar instituição
 */
exports.atualizarInstituicao = async (req, res) => {
  try {
    const { nome, sigla, cidade, estado } = req.body;

    const instituicao = await Instituicao.findById(req.params.id);
    
    if (!instituicao) {
      return res.status(404).json({
        success: false,
        message: 'Instituição não encontrada',
      });
    }

    if (nome) instituicao.nome = nome;
    if (sigla) instituicao.sigla = sigla;
    if (cidade) instituicao.cidade = cidade;
    if (estado) instituicao.estado = estado;

    await instituicao.save();

    logAudit('INSTITUICAO_UPDATED', req.user?.id || 'SYSTEM', {
      instituicaoId: instituicao._id,
      changes: req.body,
    });

    res.json({
      success: true,
      message: 'Instituição atualizada com sucesso',
      data: instituicao,
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao atualizar instituição',
      error: error.message,
    });
  }
};

/**
 * Excluir instituição (soft delete)
 */
exports.excluirInstituicao = async (req, res) => {
  try {
    const instituicao = await Instituicao.findById(req.params.id);

    if (!instituicao) {
      return res.status(404).json({
        success: false,
        message: 'Instituição não encontrada',
      });
    }

    await instituicao.softDelete();

    logAudit('INSTITUICAO_DELETED', req.user?.id || 'SYSTEM', {
      instituicaoId: instituicao._id,
      nome: instituicao.nome,
    });

    res.json({
      success: true,
      message: 'Instituição excluída com sucesso',
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao excluir instituição',
      error: error.message,
    });
  }
};
