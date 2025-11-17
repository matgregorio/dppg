require('dotenv').config();
const mongoose = require('mongoose');

const inscreverParticipante = async () => {
  try {
    await mongoose.connect(process.env.MONGO_URI);
    console.log('Conectado ao MongoDB\n');
    
    const Subevento = require('./src/models/Subevento');
    const Participant = require('./src/models/Participant');
    
    // Busca o subevento Abertura
    const subevento = await Subevento.findOne({ titulo: /abertura/i });
    
    if (!subevento) {
      console.log('❌ Subevento Abertura não encontrado');
      process.exit(1);
    }
    
    // Busca o Participante 1 (tenta por nome exato ou similar)
    let participante = await Participant.findOne({ nome: 'participante1' });
    
    if (!participante) {
      // Tenta buscar o primeiro participante cadastrado
      participante = await Participant.findOne().sort({ createdAt: 1 });
    }
    
    if (!participante) {
      console.log('❌ Nenhum participante encontrado no banco de dados');
      process.exit(1);
    }
    
    console.log(`📅 Subevento: ${subevento.titulo}`);
    console.log(`👤 Participante: ${participante.nome} (CPF: ${participante.cpf})\n`);
    
    // Verifica se já está inscrito
    const jaInscrito = subevento.inscritos.some(
      inscrito => inscrito.participant.toString() === participante._id.toString()
    );
    
    if (jaInscrito) {
      console.log('ℹ️  Participante já está inscrito neste subevento');
      process.exit(0);
    }
    
    // Adiciona o participante à lista de inscritos
    subevento.inscritos.push({
      participant: participante._id,
      status: 'CONFIRMADO',
      dataInscricao: new Date()
    });
    
    await subevento.save();
    
    console.log('✅ Participante 1 inscrito com sucesso no subevento Abertura!');
    console.log(`📊 Total de inscritos agora: ${subevento.inscritos.length}\n`);
    
    process.exit(0);
  } catch (error) {
    console.error('❌ Erro:', error);
    process.exit(1);
  }
};

inscreverParticipante();
