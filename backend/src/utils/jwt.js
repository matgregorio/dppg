const jwt = require('jsonwebtoken');

/**
 * Gera um token de acesso JWT
 */
const generateAccessToken = (userId, roles) => {
  return jwt.sign(
    { userId, roles },
    process.env.JWT_ACCESS_SECRET,
    { expiresIn: `${process.env.ACCESS_TOKEN_TTL_MIN || 15}m` }
  );
};

/**
 * Gera um token de refresh JWT
 */
const generateRefreshToken = (userId) => {
  return jwt.sign(
    { userId },
    process.env.JWT_REFRESH_SECRET,
    { expiresIn: `${process.env.REFRESH_TOKEN_TTL_DAYS || 7}d` }
  );
};

/**
 * Verifica um token de acesso
 */
const verifyAccessToken = (token) => {
  try {
    return jwt.verify(token, process.env.JWT_ACCESS_SECRET);
  } catch (error) {
    return null;
  }
};

/**
 * Verifica um token de refresh
 */
const verifyRefreshToken = (token) => {
  try {
    return jwt.verify(token, process.env.JWT_REFRESH_SECRET);
  } catch (error) {
    return null;
  }
};

module.exports = {
  generateAccessToken,
  generateRefreshToken,
  verifyAccessToken,
  verifyRefreshToken,
};
