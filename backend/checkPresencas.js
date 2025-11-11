const mongoose = require('mongoose');

// Conectar ao banco
mongoose.connect('mongodb://localhost:27017/simposio')
  .then(async () => {
    console.log('✅ Conectado ao MongoDB\n');
    
    // Buscar todas as presenças
    const presencas = await mongoose.connection.db.collection('presencas').find({}).toArray();
    
    console.log(`📊 Total de presenças registradas: ${presencas.length}\n`);
    
    for (const presenca of presencas) {
      // Buscar participante
      const participant = await mongoose.connection.db.collection('participants').findOne({ _id: presenca.participant });
      const user = await mongoose.connection.db.collection('users').findOne({ _id: participant.user });
      
      // Buscar subevento
      const subevento = await mongoose.connection.db.collection('subeventos').findOne({ _id: presenca.subevento });
      
      console.log('📌 Presença:');
      console.log(`   Participante: ${user.email}`);
      console.log(`   Subevento: ${subevento.titulo}`);
      console.log(`   Check-in: ${new Date(presenca.checkin).toLocaleString('pt-BR')}`);
      console.log('');
    }
    
    await mongoose.disconnect();
    console.log('✅ Verificação concluída');
  })
  .catch(err => {
    console.error('❌ Erro:', err);
    process.exit(1);
  });
