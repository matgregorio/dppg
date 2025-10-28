const Simposio = require('../models/Simposio');
const dayjs = require('dayjs');

/**
 * Middleware para verificar se a ação está dentro da janela de tempo permitida
 * @param {string} windowKey - Chave da janela no datasConfig (ex: 'submissaoTrabalhos')
 */
const enforceWindow = (windowKey) => {
  return async (req, res, next) => {
    try {
      // Obtém o ano do simpósio do body ou query
      const ano = req.body.ano || req.query.ano || process.env.DEFAULT_SIMPOSIO_ANO || new Date().getFullYear();
      
      const simposio = await Simposio.findOne({ ano: parseInt(ano) });
      
      if (!simposio) {
        return res.status(404).json({
          success: false,
          message: `Simpósio ${ano} não encontrado`,
        });
      }
      
      if (simposio.status === 'FINALIZADO') {
        return res.status(400).json({
          success: false,
          message: `Simpósio ${ano} já foi finalizado`,
        });
      }
      
      const window = simposio.datasConfig[windowKey];
      
      if (!window || !window.inicio || !window.fim) {
        return res.status(400).json({
          success: false,
          message: `Janela de tempo '${windowKey}' não configurada para o simpósio ${ano}`,
        });
      }
      
      const now = dayjs();
      const inicio = dayjs(window.inicio);
      const fim = dayjs(window.fim);
      
      if (now.isBefore(inicio)) {
        return res.status(400).json({
          success: false,
          message: `Período de ${windowKey} ainda não iniciou. Inicia em ${inicio.format('DD/MM/YYYY HH:mm')}`,
          window: {
            inicio: inicio.toISOString(),
            fim: fim.toISOString(),
          },
        });
      }
      
      if (now.isAfter(fim)) {
        return res.status(400).json({
          success: false,
          message: `Período de ${windowKey} encerrado. Finalizou em ${fim.format('DD/MM/YYYY HH:mm')}`,
          window: {
            inicio: inicio.toISOString(),
            fim: fim.toISOString(),
          },
        });
      }
      
      // Adiciona o simpósio ao request para uso posterior
      req.simposio = simposio;
      
      next();
    } catch (error) {
      return res.status(500).json({
        success: false,
        message: 'Erro ao verificar janela de tempo',
        error: error.message,
      });
    }
  };
};

module.exports = enforceWindow;
