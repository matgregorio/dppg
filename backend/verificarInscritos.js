require('dotenv').config();
const mongoose = require('mongoose');

const verificarInscritos = async () => {
  try {
    await mongoose.connect(process.env.MONGO_URI);
    console.log('Conectado ao MongoDB');
    
    const Subevento = require('./src/models/Subevento');
    const Participant = require('./src/models/Participant');
    const User = require('./src/models/User');
    
    const subevento = await Subevento.findOne({ 
      titulo: /abertura/i 
    }).populate('inscritos.participant');
    
    if (!subevento) {
      console.log('Subevento Abertura não encontrado');
      process.exit(0);
    }
    
    console.log('\n=== SUBEVENTO:', subevento.titulo, '===');
    console.log('Data:', subevento.data);
    console.log('Horário:', subevento.horarioInicio);
    console.log('Total de inscritos:', subevento.inscritos.length);
    console.log('\n--- Participantes inscritos ---\n');
    
    for (let i = 0; i < subevento.inscritos.length; i++) {
      const inscrito = subevento.inscritos[i];
      if (inscrito.participant) {
        const user = await User.findById(inscrito.participant.user);
        console.log(`${i + 1}. ${inscrito.participant.nome}`);
        console.log(`   CPF: ${inscrito.participant.cpf}`);
        console.log(`   Email: ${user?.email || 'N/A'}`);
        console.log(`   Status: ${inscrito.status}`);
        console.log('');
      }
    }
    
    process.exit(0);
  } catch (error) {
    console.error('Erro:', error);
    process.exit(1);
  }
};

verificarInscritos();
