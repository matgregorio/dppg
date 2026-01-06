const Simposio = require('../models/Simposio');
const dayjs = require('dayjs');

/**
 * Middleware para verificar se a ação está dentro da janela de tempo permitida
 * @param {string} windowKey - Chave da janela no datasConfig (ex: 'submissaoTrabalhos')
 */
const enforceWindow = (windowKey) => {
  return async (req, res, next) => {
    try {
      // Obtém o ano do simpósio do body ou query (aceita 'ano' ou 'simposioAno')
      const ano = req.body.ano || req.body.simposioAno || req.query.ano || req.query.simposioAno;
      
      console.log('enforceWindow - windowKey:', windowKey);
      console.log('enforceWindow - ano recebido:', ano);
      console.log('enforceWindow - req.body:', req.body);
      
      let simposio;
      
      if (ano) {
        // Se o ano foi fornecido, busca o simpósio específico
        simposio = await Simposio.findOne({ ano: parseInt(ano) });
      } else {
        // Se não foi fornecido, busca o simpósio mais recente
        const simposios = await Simposio.find().sort({ ano: -1 }).limit(1);
        simposio = simposios[0];
      }
      
      console.log('enforceWindow - simposio encontrado:', simposio ? `${simposio.ano} - ${simposio.nome}` : 'null');
      
      if (!simposio) {
        return res.status(404).json({
          success: false,
          message: ano ? `Simpósio ${ano} não encontrado` : 'Nenhum simpósio encontrado',
        });
      }
      
      if (simposio.status === 'FINALIZADO') {
        return res.status(400).json({
          success: false,
          message: `Simpósio ${simposio.ano} já foi finalizado`,
        });
      }
      
      const window = simposio.datasConfig[windowKey];
      
      console.log('enforceWindow - window encontrada:', window);
      console.log('enforceWindow - datasConfig completo:', simposio.datasConfig);
      
      if (!window || !window.inicio || !window.fim) {
        return res.status(400).json({
          success: false,
          message: `Janela de tempo '${windowKey}' não configurada para o simpósio ${simposio.ano}`,
        });
      }
      
      const now = dayjs();
      const inicio = dayjs(window.inicio);
      const fim = dayjs(window.fim);
      
      console.log('enforceWindow - now:', now.format('DD/MM/YYYY HH:mm'));
      console.log('enforceWindow - inicio:', inicio.format('DD/MM/YYYY HH:mm'));
      console.log('enforceWindow - fim:', fim.format('DD/MM/YYYY HH:mm'));
      console.log('enforceWindow - isBefore:', now.isBefore(inicio));
      console.log('enforceWindow - isAfter:', now.isAfter(fim));
      
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
