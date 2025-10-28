const User = require('../models/User');
const Participant = require('../models/Participant');
const PasswordReset = require('../models/PasswordReset');
const { generateAccessToken, generateRefreshToken, verifyRefreshToken } = require('../utils/jwt');
const { logAudit } = require('../utils/auditLogger');
const dayjs = require('dayjs');

/**
 * Registrar novo usuário
 */
exports.register = async (req, res) => {
  try {
    const { email, senha, nome, cpf, telefone, tipoParticipante } = req.body;
    
    // Verifica se o usuário já existe
    const existingUser = await User.findOne({ $or: [{ email }, { cpf }] });
    if (existingUser) {
      return res.status(400).json({
        success: false,
        message: 'Email ou CPF já cadastrado',
      });
    }
    
    // Cria o usuário
    const user = await User.create({
      email,
      senha,
      nome,
      cpf,
      telefone,
      roles: ['USER'],
    });
    
    // Cria o participante associado
    const participant = await Participant.create({
      user: user._id,
      cpf,
      nome,
      telefone,
      email,
      tipoParticipante: tipoParticipante || 'DISCENTE',
    });
    
    logAudit('USER_REGISTER', user._id.toString(), { email, nome });
    
    // Gera tokens
    const accessToken = generateAccessToken(user._id, user.roles);
    const refreshToken = generateRefreshToken(user._id);
    
    // Define o refresh token em cookie
    res.cookie('refreshToken', refreshToken, {
      httpOnly: true,
      secure: process.env.NODE_ENV === 'production',
      sameSite: 'lax',
      maxAge: 7 * 24 * 60 * 60 * 1000, // 7 dias
    });
    
    res.status(201).json({
      success: true,
      message: 'Usuário registrado com sucesso',
      data: {
        user: {
          id: user._id,
          email: user.email,
          nome: user.nome,
          roles: user.roles,
        },
        accessToken,
      },
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao registrar usuário',
      error: error.message,
    });
  }
};

/**
 * Login
 */
exports.login = async (req, res) => {
  try {
    const { email, senha } = req.body;
    
    // Busca o usuário (incluindo senha)
    const user = await User.findOne({ email }).select('+senha');
    
    if (!user) {
      logAudit('LOGIN_FAILED', 'UNKNOWN', { email, reason: 'USER_NOT_FOUND' });
      return res.status(401).json({
        success: false,
        message: 'Credenciais inválidas',
      });
    }
    
    // Verifica se o usuário está bloqueado
    if (user.bloqueado_ate && dayjs().isBefore(dayjs(user.bloqueado_ate))) {
      return res.status(403).json({
        success: false,
        message: `Conta bloqueada até ${dayjs(user.bloqueado_ate).format('DD/MM/YYYY HH:mm')}`,
      });
    }
    
    // Verifica a senha
    const senhaCorreta = await user.comparePassword(senha);
    
    if (!senhaCorreta) {
      // Incrementa tentativas de login
      user.tentativas_login += 1;
      
      // Bloqueia após 10 tentativas por 15 minutos
      if (user.tentativas_login >= 10) {
        user.bloqueado_ate = dayjs().add(15, 'minute').toDate();
        await user.save();
        
        logAudit('LOGIN_BLOCKED', user._id.toString(), { email, tentativas: user.tentativas_login });
        
        return res.status(403).json({
          success: false,
          message: 'Conta bloqueada por 15 minutos devido a múltiplas tentativas falhas',
        });
      }
      
      await user.save();
      
      logAudit('LOGIN_FAILED', user._id.toString(), { email, reason: 'WRONG_PASSWORD', tentativas: user.tentativas_login });
      
      return res.status(401).json({
        success: false,
        message: 'Credenciais inválidas',
        tentativasRestantes: 10 - user.tentativas_login,
      });
    }
    
    // Login bem-sucedido
    user.tentativas_login = 0;
    user.bloqueado_ate = null;
    user.ultimo_login = new Date();
    await user.save();
    
    logAudit('LOGIN_SUCCESS', user._id.toString(), { email });
    
    // Gera tokens
    const accessToken = generateAccessToken(user._id, user.roles);
    const refreshToken = generateRefreshToken(user._id);
    
    // Define o refresh token em cookie
    res.cookie('refreshToken', refreshToken, {
      httpOnly: true,
      secure: process.env.NODE_ENV === 'production',
      sameSite: 'lax',
      maxAge: 7 * 24 * 60 * 60 * 1000,
    });
    
    res.json({
      success: true,
      message: 'Login realizado com sucesso',
      data: {
        user: {
          id: user._id,
          email: user.email,
          nome: user.nome,
          roles: user.roles,
        },
        accessToken,
      },
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao fazer login',
      error: error.message,
    });
  }
};

/**
 * Refresh token
 */
exports.refresh = async (req, res) => {
  try {
    const refreshToken = req.cookies.refreshToken;
    
    if (!refreshToken) {
      return res.status(401).json({
        success: false,
        message: 'Refresh token não fornecido',
      });
    }
    
    const decoded = verifyRefreshToken(refreshToken);
    
    if (!decoded) {
      return res.status(401).json({
        success: false,
        message: 'Refresh token inválido ou expirado',
      });
    }
    
    const user = await User.findById(decoded.userId);
    
    if (!user || !user.ativo) {
      return res.status(401).json({
        success: false,
        message: 'Usuário não encontrado ou inativo',
      });
    }
    
    // Gera novo access token
    const accessToken = generateAccessToken(user._id, user.roles);
    
    res.json({
      success: true,
      data: {
        accessToken,
      },
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao renovar token',
      error: error.message,
    });
  }
};

/**
 * Logout
 */
exports.logout = async (req, res) => {
  try {
    res.clearCookie('refreshToken');
    
    logAudit('LOGOUT', req.user?.id || 'UNKNOWN', {});
    
    res.json({
      success: true,
      message: 'Logout realizado com sucesso',
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao fazer logout',
      error: error.message,
    });
  }
};

/**
 * Obter dados do usuário autenticado
 */
exports.me = async (req, res) => {
  try {
    const user = await User.findById(req.user.id);
    
    if (!user) {
      return res.status(404).json({
        success: false,
        message: 'Usuário não encontrado',
      });
    }
    
    res.json({
      success: true,
      data: {
        id: user._id,
        email: user.email,
        nome: user.nome,
        cpf: user.cpf,
        telefone: user.telefone,
        roles: user.roles,
        ativo: user.ativo,
        ultimo_login: user.ultimo_login,
      },
    });
  } catch (error) {
    res.status(500).json({
      success: false,
      message: 'Erro ao buscar dados do usuário',
      error: error.message,
    });
  }
};

/**
 * Esqueci minha senha (mock - gera token em log)
 */
exports.forgotPassword = async (req, res) => {
  try {
    const { email } = req.body;
    
    const user = await User.findOne({ email });
    
    if (!user) {
      // Por segurança, retorna sucesso mesmo se o usuário não existir
      logAudit('PASSWORD_RECOVERY_ATTEMPT', 'UNKNOWN', { email, found: false });
      return res.json({
        success: true,
        message: 'Se o email existir, você receberá instruções para recuperação de senha',
      });
    }
    
    // Cria token de recuperação
    const resetToken = await PasswordReset.createToken(user._id);
    
    logAudit('PASSWORD_RESET_REQUEST', user._id.toString(), { email });
    
    console.log(`\n=== TOKEN DE RESET DE SENHA ===`);
    console.log(`Email: ${email}`);
    console.log(`Token: ${resetToken.token}`);
    console.log(`Link: ${process.env.PUBLIC_BASE_URL || 'http://localhost:5173'}/reset-password?token=${resetToken.token}`);
    console.log(`===============================\n`);
    
    res.json({
      success: true,
      message: 'Se o email existir, um link de recuperação será enviado',
      ...(process.env.NODE_ENV !== 'production' && { 
        devToken: resetToken.token 
      }),
    });
  } catch (error) {
    console.error('Erro ao solicitar recuperação de senha:', error);
    res.status(500).json({
      success: false,
      message: 'Erro ao processar solicitação',
      error: error.message,
    });
  }
};

/**
 * Reset de senha
 */
exports.resetPassword = async (req, res) => {
  try {
    const { token, novaSenha } = req.body;
    
    // Busca o token
    const resetToken = await PasswordReset.findOne({
      token,
      used: false,
      expiresAt: { $gt: new Date() },
    }).populate('user');
    
    if (!resetToken) {
      return res.status(400).json({
        success: false,
        message: 'Token inválido ou expirado',
      });
    }
    
    // Atualiza a senha
    const user = resetToken.user;
    user.senha = novaSenha;
    await user.save();
    
    // Marca o token como usado
    resetToken.used = true;
    await resetToken.save();
    
    logAudit('PASSWORD_RESET', user._id.toString(), { email: user.email });
    
    res.json({
      success: true,
      message: 'Senha redefinida com sucesso',
    });
  } catch (error) {
    console.error('Erro ao redefinir senha:', error);
    res.status(500).json({
      success: false,
      message: 'Erro ao redefinir senha',
      error: error.message,
    });
  }
};
