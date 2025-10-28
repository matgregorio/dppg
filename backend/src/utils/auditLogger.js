const fs = require('fs');
const path = require('path');
const dayjs = require('dayjs');

const logsDir = path.join(__dirname, '../../logs');

// Criar diretório de logs se não existir
if (!fs.existsSync(logsDir)) {
  fs.mkdirSync(logsDir, { recursive: true });
}

/**
 * Registra uma entrada de auditoria em arquivo TXT diário
 * @param {string} action - Ação realizada
 * @param {string} userId - ID do usuário
 * @param {object} details - Detalhes adicionais
 */
const logAudit = (action, userId = 'SYSTEM', details = {}) => {
  const today = dayjs().format('YYYY-MM-DD');
  const timestamp = dayjs().format('YYYY-MM-DD HH:mm:ss');
  const filename = `audit-${today}.txt`;
  const filepath = path.join(logsDir, filename);

  const logEntry = `[${timestamp}] USER:${userId} ACTION:${action} DETAILS:${JSON.stringify(details)}\n`;

  fs.appendFileSync(filepath, logEntry, 'utf8');
};

module.exports = { logAudit };
