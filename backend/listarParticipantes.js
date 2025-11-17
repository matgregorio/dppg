require('dotenv').config();
const mongoose = require('mongoose');

const listarParticipantes = async () => {
  try {
    await mongoose.connect(process.env.MONGO_URI);
    
    const Participant = require('./src/models/Participant');
    const participants = await Participant.find().limit(10);
    
    console.log('\n=== PARTICIPANTES CADASTRADOS ===\n');
    participants.forEach((p, i) => {
      console.log(`${i + 1}. ${p.nome}`);
      console.log(`   CPF: ${p.cpf}`);
      console.log(`   Email: ${p.email}`);
      console.log('');
    });
    
    process.exit(0);
  } catch (error) {
    console.error('Erro:', error);
    process.exit(1);
  }
};

listarParticipantes();
