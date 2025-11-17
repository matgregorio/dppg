require('dotenv').config();
const mongoose = require('mongoose');

const listarSubeventos = async () => {
  try {
    await mongoose.connect(process.env.MONGO_URI);
    console.log('Conectado ao MongoDB\n');
    
    const Subevento = require('./src/models/Subevento');
    
    const subeventos = await Subevento.find().sort({ data: 1, horarioInicio: 1 });
    
    console.log('=== TODOS OS SUBEVENTOS ===\n');
    
    for (let subevento of subeventos) {
      console.log(`📅 ${subevento.titulo}`);
      console.log(`   Data: ${subevento.data.toLocaleDateString('pt-BR')}`);
      console.log(`   Horário: ${subevento.horarioInicio}`);
      console.log(`   👥 Inscritos: ${subevento.inscritos.length}`);
      
      if (subevento.inscritos.length > 0) {
        console.log(`   ✅ Tem participantes inscritos!`);
      } else {
        console.log(`   ⚠️  Nenhum participante inscrito`);
      }
      console.log('');
    }
    
    process.exit(0);
  } catch (error) {
    console.error('Erro:', error);
    process.exit(1);
  }
};

listarSubeventos();
