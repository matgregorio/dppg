const Trabalho = require('../models/Trabalho');
const Docente = require('../models/Docente');
const User = require('../models/User');
const Participant = require('../models/Participant');
const emailService = require('../services/emailService');
const { logAudit } = require('../utils/auditLogger');

/**
 * Listar trabalhos atribuídos ao orientador
 */
exports.listarTrabalhosOrientador = async (req, res) => {
  try {
    // Busca o docente associado ao usuário logado
    const docente = await Docente.findOne({ user: req.user.id });
    
    if (!docente) {
      return res.status(404).json({
        success: false,
        message: 'Cadastro de docente não encontrado',
      });
    }
    
    const { status, page = 1, limit = 20 } = req.query;
    
    const query = { 
      orientador: docente._id
    };
    
    if (status) {
      query.status = status;
    }
    
    const skip = (page - 1) * limit;
    
    console.log('Query trabalhos:', JSON.stringify(query));
    
    const total = await Trabalho.countDocuments(query);
    console.log('Total trabalhos:', total);
    
    // Buscar trabalhos sem populate primeiro para debug
    const trabalhos = await Trabalho.find(query)
      .sort({ createdAt: -1 })
      .skip(skip)
      .limit(parseInt(limit))
      .lean();
    
    console.log('Trabalhos encontrados (sem populate):', trabalhos.length);
    
    // Fazer populate manual para cada trabalho
    const trabalhosList = [];
    for (const trabalho of trabalhos) {
      try {
        // Populate autor se existir
        if (trabalho.autor) {
          const autor = await Participant.findById(trabalho.autor).select('nome email cpf').lean();
          trabalho.autor = autor;
        }
        
        // Populate subarea se existir
        if (trabalho.subarea) {
          const Subarea = require('../models/Subarea');
          const subarea = await Subarea.findById(trabalho.subarea).select('nome').lean();
          trabalho.subarea = subarea;
        }
        
        // Populate simposio se existir
        if (trabalho.simposio) {
          const Simposio = require('../models/Simposio');
          const simposio = await Simposio.findById(trabalho.simposio).select('ano nome status').lean();
          trabalho.simposio = simposio;
        }
        
        trabalhosList.push(trabalho);
      } catch (populateError) {
        console.error('Erro ao popular trabalho:', trabalho._id, populateError.message);
        // Adiciona o trabalho mesmo com erro no populate
        trabalhosList.push(trabalho);
      }
    }
    
    console.log('Trabalhos com populate:', trabalhosList.length);
    
    res.json({
      success: true,
      data: trabalhosList,
      pagination: {
        total,
        page: parseInt(page),
        limit: parseInt(limit),
        totalPages: Math.ceil(total / limit),
      },
    });
  } catch (error) {
    console.error('Erro ao listar trabalhos do orientador:', error);
    console.error('Stack trace:', error.stack);
    res.status(500).json({
      success: false,
      message: 'Erro ao listar trabalhos',
      error: error.message,
    });
  }
};

/**
 * Buscar trabalho específico para avaliação
 */
exports.buscarTrabalhoOrientador = async (req, res) => {
  try {
    const docente = await Docente.findOne({ user: req.user.id });
    
    if (!docente) {
      return res.status(404).json({
        success: false,
        message: 'Cadastro de docente não encontrado',
      });
    }
    
    const trabalho = await Trabalho.findById(req.params.id)
      .populate('autor', 'nome email cpf telefone')
      .populate('orientador')
      .populate('subarea', 'nome')
      .populate('simposio', 'ano nome status');
    
    if (!trabalho) {
      return res.status(404).json({
        success: false,
        message: 'Trabalho não encontrado',
      });
    }
    
    // Verifica se o usuário é o orientador deste trabalho
    if (trabalho.orientador._id.toString() !== docente._id.toString()) {
      return res.status(403).json({
        success: false,
        message: 'Você não é o orientador deste trabalho',
      });
    }
    
    res.json({
      success: true,
      data: trabalho,
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao buscar trabalho',
      error: error.message,
    });
  }
};

/**
 * Avaliar trabalho (aprovar ou reprovar)
 */
exports.avaliarTrabalho = async (req, res) => {
  try {
    const { aprovado, comentarios } = req.body;
    
    if (aprovado === undefined || aprovado === null) {
      return res.status(400).json({
        success: false,
        message: 'É necessário informar se o trabalho foi aprovado ou reprovado',
      });
    }
    
    const docente = await Docente.findOne({ user: req.user.id });
    
    if (!docente) {
      return res.status(404).json({
        success: false,
        message: 'Cadastro de docente não encontrado',
      });
    }
    
    const trabalho = await Trabalho.findById(req.params.id)
      .populate('autor')
      .populate('orientador');
    
    if (!trabalho) {
      return res.status(404).json({
        success: false,
        message: 'Trabalho não encontrado',
      });
    }
    
    // Verifica se o usuário é o orientador
    if (trabalho.orientador._id.toString() !== docente._id.toString()) {
      return res.status(403).json({
        success: false,
        message: 'Você não é o orientador deste trabalho',
      });
    }
    
    // Permite reavaliação - não bloqueia se já foi avaliado
    // Salva o parecer anterior no histórico se existir
    if (trabalho.parecerOrientador && trabalho.parecerOrientador.data) {
      if (!trabalho.historicoPareceres) {
        trabalho.historicoPareceres = [];
      }
      trabalho.historicoPareceres.push({
        ...trabalho.parecerOrientador.toObject ? trabalho.parecerOrientador.toObject() : trabalho.parecerOrientador,
        dataModificacao: new Date()
      });
    }
    
    // Atualiza o parecer e status
    trabalho.parecerOrientador = {
      aprovado,
      comentarios: comentarios || '',
      data: new Date(),
    };
    
    trabalho.status = aprovado ? 'APROVADO_ORIENTADOR' : 'REPROVADO_ORIENTADOR';
    
    // Se aprovado, muda para EM_AVALIACAO para a comissão
    if (aprovado) {
      trabalho.status = 'EM_AVALIACAO';
    }
    
    await trabalho.save();
    
    logAudit('TRABALHO_AVALIADO_ORIENTADOR', req.user.id, {
      trabalhoId: trabalho._id,
      aprovado,
      orientadorId: docente._id,
    });
    
    // Envia email para o aluno
    const autor = await Participant.findById(trabalho.autor).populate('user');
    if (autor && autor.user && autor.user.email) {
      await emailService.enviarParecerOrientador(
        autor.user.email,
        autor.nome,
        trabalho.titulo,
        aprovado,
        comentarios
      );
    }
    
    res.json({
      success: true,
      message: `Trabalho ${aprovado ? 'aprovado' : 'reprovado'} com sucesso`,
      data: trabalho,
    });
  } catch (error) {
    console.error('Erro ao avaliar trabalho:', error);
    res.status(500).json({
      success: false,
      message: 'Erro ao avaliar trabalho',
      error: error.message,
    });
  }
};

/**
 * Obter estatísticas do orientador
 */
exports.estatisticasOrientador = async (req, res) => {
  try {
    const docente = await Docente.findOne({ user: req.user.id });
    
    if (!docente) {
      return res.status(404).json({
        success: false,
        message: 'Cadastro de docente não encontrado',
      });
    }
    
    const query = { orientador: docente._id, deleted_at: null };
    
    const [
      aguardando,
      aprovados,
      reprovados,
      emAvaliacao,
      total
    ] = await Promise.all([
      Trabalho.countDocuments({ ...query, status: 'AGUARDANDO_ORIENTADOR' }),
      Trabalho.countDocuments({ ...query, status: { $in: ['APROVADO_ORIENTADOR', 'EM_AVALIACAO', 'ACEITO', 'PUBLICADO'] } }),
      Trabalho.countDocuments({ ...query, status: 'REPROVADO_ORIENTADOR' }),
      Trabalho.countDocuments({ ...query, status: 'EM_AVALIACAO' }),
      Trabalho.countDocuments(query),
    ]);
    
    res.json({
      success: true,
      data: {
        aguardandoAvaliacao: aguardando,
        aprovados,
        reprovados,
        emAvaliacaoComissao: emAvaliacao,
        total,
      },
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao buscar estatísticas',
      error: error.message,
    });
  }
};
