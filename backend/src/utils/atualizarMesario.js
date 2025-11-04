require('dotenv').config();
const mongoose = require('mongoose');
const User = require('../models/User');

const atualizarMesario = async () => {
  try {
    console.log('\n🔧 Atualizando usuário mesário...\n');
    
    // Conectar ao banco
    await mongoose.connect(process.env.MONGO_URI);
    console.log('✅ Conectado ao MongoDB\n');
    
    // Buscar usuário mesário
    const mesario = await User.findOne({ email: 'mesario@gov.br' });
    
    if (!mesario) {
      console.log('❌ Usuário mesário não encontrado');
      process.exit(1);
    }
    
    console.log('📋 Roles atuais:', mesario.roles);
    
    // Atualizar roles
    mesario.roles = ['USER', 'MESARIO'];
    await mesario.save();
    
    console.log('✅ Roles atualizadas:', mesario.roles);
    console.log('\n✨ Mesário atualizado com sucesso!\n');
    
    process.exit(0);
  } catch (error) {
    console.error('❌ Erro:', error.message);
    process.exit(1);
  }
};

atualizarMesario();
