const mongoose = require('mongoose');
require('dotenv').config();

// Conectar ao MongoDB
mongoose.connect(process.env.MONGODB_URI || 'mongodb://localhost:27017/simposio', {
  useNewUrlParser: true,
  useUnifiedTopology: true,
});

const Trabalho = require('../models/Trabalho');
const User = require('../models/User');

async function adicionarAvaliacaoTeste() {
  try {
    console.log('Buscando trabalhos...\n');
    
    // Buscar um trabalho que tenha autor
    const trabalho = await Trabalho.findOne({ autor: { $exists: true, $ne: null } });
    
    if (!trabalho) {
      console.log('Nenhum trabalho encontrado!');
      process.exit(1);
    }
    
    console.log(`Trabalho encontrado: "${trabalho.titulo}"`);
    console.log(`ID: ${trabalho._id}\n`);
    
    // Buscar um avaliador
    let avaliador = await User.findOne({ 
      $or: [
        { papel: 'AVALIADOR' },
        { email: { $regex: 'avaliador', $options: 'i' } }
      ]
    });
    
    // Se não encontrou, pega qualquer usuário admin
    if (!avaliador) {
      avaliador = await User.findOne({ email: 'admin@gov.br' });
    }
    
    if (!avaliador) {
      console.log('Nenhum usuário encontrado!');
      process.exit(1);
    }
    
    console.log(`Avaliador: ${avaliador.nome} (${avaliador.email})\n`);
    
    // Criar uma avaliação de teste
    const novaAvaliacao = {
      avaliador: avaliador._id,
      competencias: {
        relevancia: 8.5,
        metodologia: 7.0,
        clareza: 9.0,
        fundamentacao: 8.0,
        contribuicao: 7.5
      },
      notaFinal: 8.0,
      parecer: 'Trabalho bem estruturado e com boa fundamentação teórica. A metodologia é adequada, porém poderia ser melhor detalhada. A clareza na apresentação é excelente. Recomendo para publicação.',
      data: new Date()
    };
    
    // Adicionar a avaliação
    trabalho.avaliacoes.push(novaAvaliacao);
    
    // Calcular média das avaliações
    const mediaAvaliacoes = trabalho.avaliacoes.reduce((acc, av) => acc + av.notaFinal, 0) / trabalho.avaliacoes.length;
    trabalho.media = mediaAvaliacoes;
    trabalho.qtd_avaliados = trabalho.avaliacoes.length;
    
    await trabalho.save();
    
    console.log('✓ Avaliação de teste adicionada com sucesso!\n');
    console.log('Detalhes da avaliação:');
    console.log('  - Relevância do Tema: 8.5');
    console.log('  - Metodologia Adequada: 7.0');
    console.log('  - Clareza na Apresentação: 9.0');
    console.log('  - Fundamentação Teórica: 8.0');
    console.log('  - Contribuição Científica: 7.5');
    console.log('  - Média das Competências: 8.0');
    console.log('  - Nota Final: 8.0');
    console.log(`\nTotal de avaliações: ${trabalho.avaliacoes.length}`);
    console.log(`Média geral do trabalho: ${trabalho.media.toFixed(2)}`);
    
    process.exit(0);
    
  } catch (error) {
    console.error('Erro:', error);
    process.exit(1);
  }
}

// Executar
adicionarAvaliacaoTeste();
