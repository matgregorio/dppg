const mongoose = require('mongoose');
require('dotenv').config();

async function migrarDados() {
  try {
    // Conectar ao banco
    await mongoose.connect(process.env.MONGO_URI);
    console.log('✓ Conectado ao MongoDB');

    // Remover campo grandeArea de AreaAtuacao (nome correto da coleção)
    const resultAA = await mongoose.connection.db.collection('areaatuacaos').updateMany(
      { grandeArea: { $exists: true } },
      { $unset: { grandeArea: '' } }
    );
    console.log(`✓ AreaAtuacao: ${resultAA.modifiedCount} documentos atualizados`);

    // Remover campo grandeArea de Subarea
    const resultSub = await mongoose.connection.db.collection('subareas').updateMany(
      { grandeArea: { $exists: true } },
      { $unset: { grandeArea: '' } }
    );
    console.log(`✓ Subarea: ${resultSub.modifiedCount} documentos atualizados`);

    // Remover campo grandeArea de Trabalho
    const resultTrab = await mongoose.connection.db.collection('trabalhos').updateMany(
      { grandeArea: { $exists: true } },
      { $unset: { grandeArea: '' } }
    );
    console.log(`✓ Trabalho: ${resultTrab.modifiedCount} documentos atualizados`);

    // Remover campo grandeArea de Participant
    const resultPart = await mongoose.connection.db.collection('participants').updateMany(
      { grandeArea: { $exists: true } },
      { $unset: { grandeArea: '' } }
    );
    console.log(`✓ Participant: ${resultPart.modifiedCount} documentos atualizados`);

    // Remover campo grandeArea de Docente
    const resultDoc = await mongoose.connection.db.collection('docentes').updateMany(
      { grandeArea: { $exists: true } },
      { $unset: { grandeArea: '' } }
    );
    console.log(`✓ Docente: ${resultDoc.modifiedCount} documentos atualizados`);

    // Remover a coleção GrandeArea completamente
    try {
      await mongoose.connection.db.collection('grandeareas').drop();
      console.log('✓ Coleção "grandeareas" removida');
    } catch (err) {
      console.log('  (Coleção "grandeareas" não existe ou já foi removida)');
    }

    console.log('\n✓ Migração concluída com sucesso!');
    process.exit(0);
  } catch (error) {
    console.error('✗ Erro na migração:', error);
    process.exit(1);
  }
}

migrarDados();
