require('dotenv').config();
const mongoose = require('mongoose');

const atualizarSimposio = async () => {
  try {
    console.log('Conectando ao MongoDB...');
    await mongoose.connect(process.env.MONGO_URI);
    console.log('✅ Conectado!\n');
    
    const ano = parseInt(process.env.DEFAULT_SIMPOSIO_ANO) || new Date().getFullYear();
    
    // Atualizar diretamente sem usar o modelo primeiro
    const result = await mongoose.connection.db.collection('simposios').updateOne(
      { ano: ano },
      { 
        $set: {
          nome: `Simpósio de Pesquisa, Pós-Graduação e Inovação ${ano}`,
          descricao: 'Evento anual dedicado à divulgação científica e tecnológica, promovendo o intercâmbio de conhecimentos entre pesquisadores, docentes e discentes.',
          local: 'Campus Universitário - Auditório Central'
        }
      }
    );
    
    console.log(`✅ Resultado da atualização:`, result);
    
    // Buscar e exibir o simpósio atualizado
    const simposio = await mongoose.connection.db.collection('simposios').findOne({ ano: ano });
    
    console.log('\n✅ Simpósio atualizado:');
    console.log(JSON.stringify(simposio, null, 2));
    
    await mongoose.connection.close();
    console.log('\n✅ Concluído!');
    process.exit(0);
  } catch (error) {
    console.error('❌ Erro:', error);
    process.exit(1);
  }
};

atualizarSimposio();
