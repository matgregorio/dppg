const mongoose = require('mongoose');
require('dotenv').config();

async function verificarColecoes() {
  try {
    await mongoose.connect(process.env.MONGO_URI);
    console.log('✓ Conectado ao MongoDB');

    const collections = await mongoose.connection.db.listCollections().toArray();
    console.log('\nColeções disponíveis:');
    collections.forEach(col => console.log(' -', col.name));

    // Verificar AreaAtuacao
    const areaAtuacao = await mongoose.connection.db.collection('areaatuacaos').findOne({});
    console.log('\n--- Exemplo de AreaAtuacao (areaatuacaos):');
    console.log(areaAtuacao);

    const areaAtuacao2 = await mongoose.connection.db.collection('areaAtuacaos').findOne({});
    console.log('\n--- Exemplo de AreaAtuacao (areaAtuacaos):');
    console.log(areaAtuacao2);

    process.exit(0);
  } catch (error) {
    console.error('Erro:', error);
    process.exit(1);
  }
}

verificarColecoes();
