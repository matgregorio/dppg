const { verifyAccessToken } = require('../utils/jwt');

/**
 * Middleware de autenticação opcional
 * Tenta autenticar o usuário, mas permite que a requisição continue mesmo sem token
 */
const optionalAuth = (req, res, next) => {
  try {
    const authHeader = req.headers.authorization;
    
    if (!authHeader || !authHeader.startsWith('Bearer ')) {
      // Sem token, continua sem usuário
      return next();
    }
    
    const token = authHeader.substring(7);
    
    try {
      const decoded = verifyAccessToken(token);
      req.user = decoded; // { id, roles }
    } catch (err) {
      // Token inválido/expirado, continua sem usuário
      console.log('Token inválido em rota pública:', err.message);
    }
    
    next();
  } catch (error) {
    // Erro inesperado, continua sem usuário
    next();
  }
};

module.exports = optionalAuth;
