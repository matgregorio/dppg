const Trabalho = require('../models/Trabalho');
const Docente = require('../models/Docente');
const Participant = require('../models/Participant');
const Simposio = require('../models/Simposio');
const User = require('../models/User');
const emailService = require('../services/emailService');
const { logAudit } = require('../utils/auditLogger');

/**
 * Submeter novo trabalho
 */
exports.submeterTrabalho = async (req, res) => {
  try {
    const { 
      titulo, 
      orientadorId, 
      outrosAutores, 
      tipoProjeto, 
      apoios, 
      resumo, 
      palavras_chave, 
      subareaId, 
      simposioId,
      concordanciaNormas 
    } = req.body;
    
    // Validações
    if (!titulo || !orientadorId || !tipoProjeto || !resumo || !subareaId || !simposioId) {
      return res.status(400).json({
        success: false,
        message: 'Título, orientador, tipo de projeto, resumo, subárea e simpósio são obrigatórios',
      });
    }
    
    if (!concordanciaNormas) {
      return res.status(400).json({
        success: false,
        message: 'É necessário concordar com as normas de publicação',
      });
    }
    
    // Validação do resumo (250-400 palavras)
    const palavrasResumo = resumo.trim().split(/\s+/).length;
    if (palavrasResumo < 250 || palavrasResumo > 400) {
      return res.status(400).json({
        success: false,
        message: `O resumo deve conter entre 250 e 400 palavras. Atual: ${palavrasResumo} palavras`,
      });
    }
    
    // Verifica se o orientador existe
    const orientador = await Docente.findById(orientadorId);
    if (!orientador) {
      return res.status(404).json({
        success: false,
        message: 'Orientador não encontrado',
      });
    }
    
    // Verifica se o simpósio existe e está ativo
    const simposio = await Simposio.findById(simposioId);
    if (!simposio) {
      return res.status(404).json({
        success: false,
        message: 'Simpósio não encontrado',
      });
    }
    
    // Verifica se está dentro do prazo de submissão
    const agora = new Date();
    const inicioSubmissao = new Date(simposio.datasConfig.submissaoTrabalhos.inicio);
    const fimSubmissao = new Date(simposio.datasConfig.submissaoTrabalhos.fim);
    
    if (agora < inicioSubmissao || agora > fimSubmissao) {
      return res.status(403).json({
        success: false,
        message: 'Fora do prazo para submissão de trabalhos',
        prazo: {
          inicio: inicioSubmissao.toISOString(),
          fim: fimSubmissao.toISOString(),
        },
      });
    }
    
    // Busca o participante do autor
    const participant = await Participant.findOne({ user: req.user.id });
    if (!participant) {
      return res.status(404).json({
        success: false,
        message: 'Participante não encontrado',
      });
    }
    
    // Validar número de autores (máximo 6, incluindo orientador)
    const totalAutores = 1 + (outrosAutores ? outrosAutores.length : 0) + 1; // autor + outros + orientador
    if (totalAutores > 6) {
      return res.status(400).json({
        success: false,
        message: 'O trabalho pode ter no máximo 6 autores (incluindo orientador)',
      });
    }
    
    // Cria o trabalho
    const trabalho = await Trabalho.create({
      titulo,
      autor: participant._id,
      autores: [{
        nome: participant.nome,
        cpf: participant.cpf,
        email: participant.email,
      }],
      orientador: orientadorId,
      outrosAutores: outrosAutores || [],
      tipoProjeto,
      apoios: apoios || [],
      resumo,
      palavras_chave: palavras_chave || [],
      subarea: subareaId,
      simposio: simposioId,
      concordanciaNormas,
      status: 'AGUARDANDO_ORIENTADOR',
    });
    
    logAudit('TRABALHO_SUBMETIDO', req.user.id, {
      trabalhoId: trabalho._id,
      titulo,
      orientadorId,
    });
    
    // Envia email para o estudante
    const user = await User.findById(req.user.id);
    if (user && user.email) {
      await emailService.enviarConfirmacaoSubmissao(
        user.email,
        user.nome,
        titulo,
        trabalho._id.toString()
      );
    }
    
    // Envia email para o orientador
    if (orientador.email) {
      await emailService.enviarNotificacaoOrientador(
        orientador.email,
        orientador.nome,
        user.nome,
        titulo,
        trabalho._id.toString()
      );
    }
    
    res.status(201).json({
      success: true,
      message: 'Trabalho submetido com sucesso! Aguarde a avaliação do orientador.',
      data: trabalho,
    });
  } catch (error) {
    console.error('Erro ao submeter trabalho:', error);
    res.status(500).json({
      success: false,
      message: 'Erro ao submeter trabalho',
      error: error.message,
    });
  }
};

/**
 * Listar trabalhos do usuário logado
 */
exports.meusTrabalhosTrabalhos = async (req, res) => {
  try {
    const participant = await Participant.findOne({ user: req.user.id });
    if (!participant) {
      return res.json({
        success: true,
        data: [],
      });
    }
    
    const trabalhos = await Trabalho.find({ autor: participant._id })
      .populate('orientador', 'nome email instituicao')
      .populate('subarea', 'nome')
      .populate('apoios', 'nome sigla')
      .populate('simposio', 'ano nome status')
      .sort({ createdAt: -1 });
    
    res.json({
      success: true,
      data: trabalhos,
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao buscar trabalhos',
      error: error.message,
    });
  }
};

/**
 * Buscar trabalho específico
 */
exports.buscarTrabalho = async (req, res) => {
  try {
    const trabalho = await Trabalho.findById(req.params.id)
      .populate('autor', 'nome email cpf')
      .populate('orientador')
      .populate('subarea')
      .populate('apoios')
      .populate('simposio', 'ano nome status');
    
    if (!trabalho) {
      return res.status(404).json({
        success: false,
        message: 'Trabalho não encontrado',
      });
    }
    
    // Verifica se o usuário tem permissão para ver este trabalho
    const participant = await Participant.findOne({ user: req.user.id });
    if (!participant || trabalho.autor.toString() !== participant._id.toString()) {
      return res.status(403).json({
        success: false,
        message: 'Acesso negado',
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
 * Atualizar trabalho (apenas se ainda não foi avaliado pelo orientador)
 */
exports.atualizarTrabalho = async (req, res) => {
  try {
    const trabalho = await Trabalho.findById(req.params.id);
    
    if (!trabalho) {
      return res.status(404).json({
        success: false,
        message: 'Trabalho não encontrado',
      });
    }
    
    // Verifica se o usuário é o autor
    const participant = await Participant.findOne({ user: req.user.id });
    if (!participant || trabalho.autor.toString() !== participant._id.toString()) {
      return res.status(403).json({
        success: false,
        message: 'Acesso negado',
      });
    }
    
    // Só permite edição se estiver aguardando orientador ou reprovado
    if (!['AGUARDANDO_ORIENTADOR', 'REPROVADO_ORIENTADOR'].includes(trabalho.status)) {
      return res.status(403).json({
        success: false,
        message: 'Não é possível editar trabalho após avaliação do orientador',
      });
    }
    
    const { 
      titulo, 
      outrosAutores, 
      tipoProjeto, 
      apoios, 
      resumo, 
      palavras_chave 
    } = req.body;
    
    // Validação do resumo se fornecido
    if (resumo) {
      const palavrasResumo = resumo.trim().split(/\s+/).length;
      if (palavrasResumo < 250 || palavrasResumo > 400) {
        return res.status(400).json({
          success: false,
          message: `O resumo deve conter entre 250 e 400 palavras. Atual: ${palavrasResumo} palavras`,
        });
      }
      trabalho.resumo = resumo;
    }
    
    if (titulo) trabalho.titulo = titulo;
    if (outrosAutores) trabalho.outrosAutores = outrosAutores;
    if (tipoProjeto) trabalho.tipoProjeto = tipoProjeto;
    if (apoios) trabalho.apoios = apoios;
    if (palavras_chave) trabalho.palavras_chave = palavras_chave;
    
    // Se estava reprovado, volta para aguardando orientador
    if (trabalho.status === 'REPROVADO_ORIENTADOR') {
      trabalho.status = 'AGUARDANDO_ORIENTADOR';
      trabalho.parecerOrientador = {};
    }
    
    await trabalho.save();
    
    logAudit('TRABALHO_ATUALIZADO', req.user.id, {
      trabalhoId: trabalho._id,
    });
    
    res.json({
      success: true,
      message: 'Trabalho atualizado com sucesso',
      data: trabalho,
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao atualizar trabalho',
      error: error.message,
    });
  }
};
