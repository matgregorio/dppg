require('dotenv').config();
const mongoose = require('mongoose');
const Trabalho = require('../models/Trabalho');
const Simposio = require('../models/Simposio');

const seedAvaliacoesExternas = async () => {
  try {
    console.log('\n🌱 Iniciando seed de avaliações externas...\n');
    
    // Conectar ao banco
    await mongoose.connect(process.env.MONGO_URI);
    console.log('✅ Conectado ao MongoDB\n');
    
    // Buscar o simpósio atual
    const simposio = await Simposio.findOne().sort({ ano: -1 });
    if (!simposio) {
      console.log('❌ Nenhum simpósio encontrado.');
      console.log('   Crie um simpósio pela interface do sistema primeiro.\n');
      process.exit(1);
    }
    
    console.log(`📝 Buscando trabalhos do simpósio ${simposio.ano}...\n`);
    
    // Buscar TODOS os trabalhos do simpósio
    const trabalhos = await Trabalho.find({ 
      simposio: simposio._id
    }).select('titulo');
    
    if (trabalhos.length === 0) {
      console.log('⚠️  Nenhum trabalho encontrado no sistema.');
      console.log('   Submeta alguns trabalhos pela interface do sistema primeiro.\n');
      process.exit(0);
    }
    
    console.log(`   Encontrados ${trabalhos.length} trabalhos. Adicionando notas externas...\n`);
    
    // Atualizar trabalhos com notas externas usando updateMany para evitar validação
    for (const trabalho of trabalhos) {
      // Gerar nota aleatória entre 7.0 e 10.0
      const nota = parseFloat((Math.random() * 3 + 7).toFixed(1));
      
      await Trabalho.updateOne(
        { _id: trabalho._id },
        { $set: { notaExterna: nota } },
        { runValidators: false } // Desabilita validação
      );
      
      console.log(`   ✅ "${trabalho.titulo}" - Nota Externa: ${nota}`);
    }
    
    console.log(`\n✅ ${trabalhos.length} trabalhos atualizados com notas externas!\n`);
    console.log('🎉 Seed de avaliações externas concluído com sucesso!\n');
    console.log('   Acesse a página de Avaliações Externas para visualizar os dados.\n');
    process.exit(0);
    
  } catch (error) {
    console.error('❌ Erro ao executar seed:', error);
    process.exit(1);
  }
};

seedAvaliacoesExternas();
