const rateLimit = require('express-rate-limit');
const slowDown = require('express-slow-down');

/**
 * Rate limiter geral para toda a API
 */
const apiLimiter = rateLimit({
  windowMs: 15 * 60 * 1000, // 15 minutos
  max: 100, // 100 requisições por IP
  message: {
    success: false,
    message: 'Muitas requisições deste IP, tente novamente mais tarde',
  },
  standardHeaders: true,
  legacyHeaders: false,
});

/**
 * Rate limiter rigoroso para rotas de autenticação
 */
const authLimiter = rateLimit({
  windowMs: 15 * 60 * 1000, // 15 minutos
  max: 10, // 10 requisições
  skipSuccessfulRequests: false,
  message: {
    success: false,
    message: 'Muitas tentativas de login, tente novamente em 15 minutos',
  },
});

/**
 * Slow down para rotas de autenticação
 */
const authSlowDown = slowDown({
  windowMs: 15 * 60 * 1000,
  delayAfter: 3, // Após 3 requisições
  delayMs: () => 500, // Adiciona 500ms de delay por requisição
  validate: { delayMs: false }, // Desabilita warning
});

module.exports = {
  apiLimiter,
  authLimiter,
  authSlowDown,
};
