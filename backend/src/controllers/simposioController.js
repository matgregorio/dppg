const Simposio = require('../models/Simposio');
const User = require('../models/User');
const Participant = require('../models/Participant');
const emailService = require('../services/emailService');

/**
 * @swagger
 * /admin/simposios:
 *   post:
 *     summary: Criar novo simpósio
 *     tags: [Admin - Simpósios]
 *     security:
 *       - bearerAuth: []
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             properties:
 *               ano:
 *                 type: number
 *               tema:
 *                 type: string
 *               dataInicio:
 *                 type: string
 *                 format: date
 *               dataFim:
 *                 type: string
 *                 format: date
 *               dataInicioSubmissoes:
 *                 type: string
 *                 format: date
 *               dataFimSubmissoes:
 *                 type: string
 *                 format: date
 *               dataInicioInscricoes:
 *                 type: string
 *                 format: date
 *               dataFimInscricoes:
 *                 type: string
 *                 format: date
 *               enviarEmail:
 *                 type: boolean
 *     responses:
 *       201:
 *         description: Simpósio criado com sucesso
 */
exports.criarSimposio = async (req, res) => {
  try {
    const {
      ano,
      tema,
      dataInicio,
      dataFim,
      dataInicioSubmissoes,
      dataFimSubmissoes,
      dataInicioInscricoes,
      dataFimInscricoes,
      enviarEmail,
    } = req.body;

    console.log('📝 Dados recebidos para criar simpósio:', { ano, tema, dataInicio, dataFim });

    // Validações básicas
    if (!ano || !tema || !dataInicio || !dataFim) {
      return res.status(400).json({
        success: false,
        message: 'Ano, tema, data de início e data de fim são obrigatórios',
      });
    }

    // Verifica se já existe simpósio para este ano (não deletado)
    const simposioExistente = await Simposio.findOne({ ano, deleted_at: null });
    if (simposioExistente) {
      return res.status(400).json({
        success: false,
        message: `Já existe um simpósio cadastrado para o ano ${ano}`,
      });
    }

    // Validação de datas
    const inicio = new Date(dataInicio);
    const fim = new Date(dataFim);
    
    if (fim <= inicio) {
      return res.status(400).json({
        success: false,
        message: 'A data de término deve ser posterior à data de início',
      });
    }

    // Prepara as datas para o formato datasConfig (compatibilidade com sistema antigo)
    const datasConfig = {
      inscricaoParticipante: {
        inicio: dataInicioInscricoes ? new Date(dataInicioInscricoes) : null,
        fim: dataFimInscricoes ? new Date(dataFimInscricoes) : null,
      },
      submissaoTrabalhos: {
        inicio: dataInicioSubmissoes ? new Date(dataInicioSubmissoes) : null,
        fim: dataFimSubmissoes ? new Date(dataFimSubmissoes) : null,
      },
      prazoAvaliacao: {
        inicio: inicio,
        fim: fim,
      },
      notasAvaliacaoExterna: {
        inicio: inicio,
        fim: fim,
      },
    };

    // Cria o novo simpósio com ambos os formatos para compatibilidade
    const novoSimposio = new Simposio({
      ano,
      nome: tema, // O campo 'nome' é obrigatório no modelo
      tema,
      dataInicio: inicio,
      dataFim: fim,
      dataInicioSubmissoes: dataInicioSubmissoes ? new Date(dataInicioSubmissoes) : null,
      dataFimSubmissoes: dataFimSubmissoes ? new Date(dataFimSubmissoes) : null,
      dataInicioInscricoes: dataInicioInscricoes ? new Date(dataInicioInscricoes) : null,
      dataFimInscricoes: dataFimInscricoes ? new Date(dataFimInscricoes) : null,
      datasConfig, // Adiciona o formato antigo para compatibilidade
      finalizado: false,
    });

    console.log('💾 Tentando salvar simpósio...');
    await novoSimposio.save();
    console.log('✅ Simpósio salvo com sucesso!');

    // Envia e-mails de notificação se solicitado
    if (enviarEmail) {
      try {
        // Busca todos os usuários com e-mail verificado
        const usuarios = await User.find({ emailVerified: true }).select('email nome');
        console.log(`📧 Enviando notificações para ${usuarios.length} usuários...`);
        
        const emailsEnviados = [];
        for (const usuario of usuarios) {
          try {
            await emailService.enviarNovoSimposio(usuario, {
              ano,
              tema,
              dataInicio: inicio,
              dataFim: fim,
              dataInicioSubmissoes: dataInicioSubmissoes ? new Date(dataInicioSubmissoes) : null,
              dataFimSubmissoes: dataFimSubmissoes ? new Date(dataFimSubmissoes) : null,
              dataInicioInscricoes: dataInicioInscricoes ? new Date(dataInicioInscricoes) : null,
              dataFimInscricoes: dataFimInscricoes ? new Date(dataFimInscricoes) : null,
            });
            emailsEnviados.push(usuario.email);
          } catch (emailErr) {
            console.error(`❌ Erro ao enviar e-mail para ${usuario.email}:`, emailErr);
          }
        }

        console.log(`✉️ Notificações enviadas para ${emailsEnviados.length} usuários sobre o novo simpósio ${ano}`);
      } catch (emailErr) {
        console.error('❌ Erro ao processar envio de e-mails:', emailErr);
        // Não retorna erro, pois o simpósio foi criado com sucesso
      }
    }

    res.status(201).json({
      success: true,
      message: 'Simpósio criado com sucesso',
      data: novoSimposio,
    });
  } catch (err) {
    console.error('❌ Erro ao criar simpósio:', err);
    console.error('Stack trace:', err.stack);
    res.status(500).json({
      success: false,
      message: 'Erro ao criar simpósio',
      error: err.message,
    });
  }
};

/**
 * @swagger
 * /admin/simposios/{id}/finalizar:
 *   post:
 *     summary: Finalizar simpósio
 *     tags: [Admin - Simpósios]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: path
 *         name: id
 *         required: true
 *         schema:
 *           type: string
 *     responses:
 *       200:
 *         description: Simpósio finalizado com sucesso
 */
exports.finalizarSimposio = async (req, res) => {
  try {
    const { id } = req.params;

    const simposio = await Simposio.findById(id);
    
    if (!simposio) {
      return res.status(404).json({
        success: false,
        message: 'Simpósio não encontrado',
      });
    }

    if (simposio.finalizado) {
      return res.status(400).json({
        success: false,
        message: 'Este simpósio já foi finalizado',
      });
    }

    simposio.finalizado = true;
    simposio.dataFinalizacao = new Date();
    await simposio.save();

    res.json({
      success: true,
      message: 'Simpósio finalizado com sucesso',
      data: simposio,
    });
  } catch (err) {
    console.error('Erro ao finalizar simpósio:', err);
    res.status(500).json({
      success: false,
      message: 'Erro ao finalizar simpósio',
      error: err.message,
    });
  }
};

/**
 * @swagger
 * /admin/simposios/{ano}:
 *   get:
 *     summary: Buscar simpósio por ano
 *     tags: [Admin - Simpósios]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: path
 *         name: ano
 *         required: true
 *         schema:
 *           type: number
 *     responses:
 *       200:
 *         description: Simpósio encontrado
 */
exports.getSimposioPorAno = async (req, res) => {
  try {
    const { ano } = req.params;

    const simposio = await Simposio.findOne({ ano: parseInt(ano) });
    
    if (!simposio) {
      return res.status(404).json({
        success: false,
        message: 'Simpósio não encontrado',
      });
    }

    res.json({
      success: true,
      data: simposio,
    });
  } catch (err) {
    console.error('Erro ao buscar simpósio:', err);
    res.status(500).json({
      success: false,
      message: 'Erro ao buscar simpósio',
      error: err.message,
    });
  }
};

/**
 * @swagger
 * /admin/simposios/{ano}:
 *   put:
 *     summary: Atualizar simpósio
 *     tags: [Admin - Simpósios]
 *     security:
 *       - bearerAuth: []
 *     parameters:
 *       - in: path
 *         name: ano
 *         required: true
 *         schema:
 *           type: number
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *     responses:
 *       200:
 *         description: Simpósio atualizado
 */
exports.atualizarSimposio = async (req, res) => {
  try {
    const { ano } = req.params;
    const updates = req.body;

    const simposio = await Simposio.findOne({ ano: parseInt(ano) });
    
    if (!simposio) {
      return res.status(404).json({
        success: false,
        message: 'Simpósio não encontrado',
      });
    }

    if (simposio.finalizado) {
      return res.status(400).json({
        success: false,
        message: 'Não é possível editar um simpósio finalizado',
      });
    }

    // Atualiza apenas campos permitidos
    const camposPermitidos = [
      'tema',
      'dataInicio',
      'dataFim',
      'dataInicioSubmissoes',
      'dataFimSubmissoes',
      'dataInicioInscricoes',
      'dataFimInscricoes',
    ];

    camposPermitidos.forEach((campo) => {
      if (updates[campo] !== undefined) {
        simposio[campo] = updates[campo];
      }
    });

    await simposio.save();

    res.json({
      success: true,
      message: 'Simpósio atualizado com sucesso',
      data: simposio,
    });
  } catch (err) {
    console.error('Erro ao atualizar simpósio:', err);
    res.status(500).json({
      success: false,
      message: 'Erro ao atualizar simpósio',
      error: err.message,
    });
  }
};

/**
 * @swagger
 * /public/simposios:
 *   get:
 *     summary: Listar todos os simpósios (público)
 *     tags: [Público - Simpósios]
 *     responses:
 *       200:
 *         description: Lista de simpósios
 */
exports.listarSimposios = async (req, res) => {
  try {
    const simposios = await Simposio.find().sort({ ano: -1 });

    res.json({
      success: true,
      data: simposios,
    });
  } catch (err) {
    console.error('Erro ao listar simpósios:', err);
    res.status(500).json({
      success: false,
      message: 'Erro ao listar simpósios',
      error: err.message,
    });
  }
};
