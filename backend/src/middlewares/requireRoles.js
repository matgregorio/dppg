/**
 * Middleware para verificar se o usuário possui uma ou mais roles específicas
 * @param {Array<string>} allowedRoles - Roles permitidas
 */
const requireRoles = (allowedRoles) => {
  return (req, res, next) => {
    if (!req.user) {
      return res.status(401).json({
        success: false,
        message: 'Autenticação necessária',
      });
    }
    
    const userRoles = req.user.roles || [];
    const hasRole = allowedRoles.some(role => userRoles.includes(role));
    
    if (!hasRole) {
      return res.status(403).json({
        success: false,
        message: 'Acesso negado. Permissões insuficientes',
        requiredRoles: allowedRoles,
        userRoles,
      });
    }
    
    next();
  };
};

module.exports = requireRoles;
