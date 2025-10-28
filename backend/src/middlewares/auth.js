const { verifyAccessToken } = require('../utils/jwt');
const User = require('../models/User');

/**
 * Middleware de autenticação
 * Verifica se há um token JWT válido no header Authorization
 */
const auth = async (req, res, next) => {
  try {
    const authHeader = req.headers.authorization;
    
    if (!authHeader || !authHeader.startsWith('Bearer ')) {
      return res.status(401).json({
        success: false,
        message: 'Token de autenticação não fornecido',
      });
    }
    
    const token = authHeader.substring(7);
    const decoded = verifyAccessToken(token);
    
    if (!decoded) {
      return res.status(401).json({
        success: false,
        message: 'Token inválido ou expirado',
      });
    }
    
    // Busca o usuário
    const user = await User.findById(decoded.userId);
    
    if (!user || !user.ativo) {
      return res.status(401).json({
        success: false,
        message: 'Usuário não encontrado ou inativo',
      });
    }
    
    // Adiciona o usuário ao request
    req.user = {
      id: user._id.toString(),
      email: user.email,
      roles: user.roles,
      nome: user.nome,
    };
    
    next();
  } catch (error) {
    return res.status(500).json({
      success: false,
      message: 'Erro ao autenticar',
      error: error.message,
    });
  }
};

module.exports = auth;
