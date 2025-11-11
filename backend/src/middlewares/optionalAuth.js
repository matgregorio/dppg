const { verifyAccessToken } = require('../utils/jwt');

/**
 * Middleware de autenticação opcional
 * Tenta autenticar o usuário, mas permite que a requisição continue mesmo sem token
 */
const optionalAuth = (req, res, next) => {
  try {
    const authHeader = req.headers.authorization;
    
    console.log('[DEBUG optionalAuth] authHeader:', authHeader ? `Bearer ${authHeader.substring(0, 20)}...` : 'Não enviado');
    
    if (!authHeader || !authHeader.startsWith('Bearer ')) {
      // Sem token, continua sem usuário
      console.log('[DEBUG optionalAuth] Sem token, continuando sem autenticação');
      return next();
    }
    
    const token = authHeader.substring(7);
    
    try {
      const decoded = verifyAccessToken(token);
      req.user = decoded; // { userId, roles }
      console.log('[DEBUG optionalAuth] Token decodificado com sucesso. User ID:', decoded.userId);
    } catch (err) {
      // Token inválido/expirado, continua sem usuário
      console.log('[DEBUG optionalAuth] Token inválido em rota pública:', err.message);
    }
    
    next();
  } catch (error) {
    // Erro inesperado, continua sem usuário
    console.log('[DEBUG optionalAuth] Erro inesperado:', error.message);
    next();
  }
};

module.exports = optionalAuth;
