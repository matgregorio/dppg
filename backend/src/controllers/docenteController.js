const Docente = require('../models/Docente');
const User = require('../models/User');
const { logAudit } = require('../utils/auditLogger');

/**
 * Listar todos os docentes
 */
exports.listarDocentes = async (req, res) => {
  try {
    const docentes = await Docente.find()
      .populate('instituicao', 'nome sigla')
      .populate('areaAtuacao', 'nome')
      .populate('subarea', 'nome')
      .populate('user', 'nome email')
      .sort({ nome: 1 });

    res.json({
      success: true,
      data: docentes,
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao listar docentes',
      error: error.message,
    });
  }
};

/**
 * Buscar docente por ID
 */
exports.buscarDocente = async (req, res) => {
  try {
    const docente = await Docente.findById(req.params.id)
      .populate('instituicao')
      .populate('areaAtuacao')
      .populate('subarea')
      .populate('user', 'nome email');

    if (!docente) {
      return res.status(404).json({
        success: false,
        message: 'Docente não encontrado',
      });
    }

    res.json({
      success: true,
      data: docente,
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao buscar docente',
      error: error.message,
    });
  }
};

/**
 * Criar novo docente
 */
exports.criarDocente = async (req, res) => {
  try {
    const { nome, cpf, email, telefone, instituicao, areaAtuacao, subarea, visitante, userId } = req.body;

    // Verifica se já existe docente com este CPF
    const docenteExistente = await Docente.findOne({ cpf });
    if (docenteExistente) {
      return res.status(400).json({
        success: false,
        message: 'Já existe um docente cadastrado com este CPF',
      });
    }

    let userIdFinal = userId;

    // Se não foi informado userId, cria um automaticamente
    if (!userIdFinal) {
      // Verifica se já existe usuário com este email
      const usuarioExistente = await User.findOne({ email });
      
      if (usuarioExistente) {
        // Se existe, adiciona role DOCENTE se ainda não tiver
        if (!usuarioExistente.roles.includes('DOCENTE')) {
          usuarioExistente.roles.push('DOCENTE');
          await usuarioExistente.save();
        }
        userIdFinal = usuarioExistente._id;
      } else {
        // Cria novo usuário com senha temporária
        const senhaTemporaria = Math.random().toString(36).slice(-8);
        const novoUsuario = await User.create({
          nome,
          email,
          cpf,
          telefone,
          senha: senhaTemporaria,
          roles: ['DOCENTE'],
        });
        userIdFinal = novoUsuario._id;
        
        // TODO: Enviar email com senha temporária
        console.log(`Usuário criado para docente ${nome} com senha temporária: ${senhaTemporaria}`);
      }
    } else {
      // Se informado userId, verifica se o user existe e adiciona role DOCENTE
      const user = await User.findById(userId);
      if (!user) {
        return res.status(404).json({
          success: false,
          message: 'Usuário não encontrado',
        });
      }
      if (!user.roles.includes('DOCENTE')) {
        user.roles.push('DOCENTE');
        await user.save();
      }
    }

    const docente = await Docente.create({
      nome,
      cpf,
      email,
      telefone,
      instituicao,
      areaAtuacao,
      subarea,
      visitante: visitante || false,
      user: userIdFinal,
    });

    const docentePopulado = await Docente.findById(docente._id)
      .populate('instituicao', 'nome sigla')
      .populate('areaAtuacao', 'nome')
      .populate('subarea', 'nome');

    logAudit('DOCENTE_CREATED', req.user?.id || 'SYSTEM', {
      docenteId: docente._id,
      nome,
      cpf,
    });

    res.status(201).json({
      success: true,
      message: 'Docente cadastrado com sucesso',
      data: docentePopulado,
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao criar docente',
      error: error.message,
    });
  }
};

/**
 * Atualizar docente
 */
exports.atualizarDocente = async (req, res) => {
  try {
    const { nome, email, telefone, instituicao, areaAtuacao, subarea, visitante } = req.body;

    const docente = await Docente.findById(req.params.id);
    
    if (!docente) {
      return res.status(404).json({
        success: false,
        message: 'Docente não encontrado',
      });
    }

    // Atualiza os campos
    if (nome) docente.nome = nome;
    if (email) docente.email = email;
    if (telefone) docente.telefone = telefone;
    if (instituicao) docente.instituicao = instituicao;
    if (areaAtuacao) docente.areaAtuacao = areaAtuacao;
    if (subarea) docente.subarea = subarea;
    if (visitante !== undefined) docente.visitante = visitante;

    await docente.save();

    const docenteAtualizado = await Docente.findById(docente._id)
      .populate('instituicao', 'nome sigla')
      .populate('areaAtuacao', 'nome')
      .populate('subarea', 'nome');

    logAudit('DOCENTE_UPDATED', req.user?.id || 'SYSTEM', {
      docenteId: docente._id,
      changes: req.body,
    });

    res.json({
      success: true,
      message: 'Docente atualizado com sucesso',
      data: docenteAtualizado,
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao atualizar docente',
      error: error.message,
    });
  }
};

/**
 * Excluir docente (soft delete)
 */
exports.excluirDocente = async (req, res) => {
  try {
    const docente = await Docente.findById(req.params.id);

    if (!docente) {
      return res.status(404).json({
        success: false,
        message: 'Docente não encontrado',
      });
    }

    await docente.softDelete();

    logAudit('DOCENTE_DELETED', req.user?.id || 'SYSTEM', {
      docenteId: docente._id,
      nome: docente.nome,
    });

    res.json({
      success: true,
      message: 'Docente excluído com sucesso',
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao excluir docente',
      error: error.message,
    });
  }
};
