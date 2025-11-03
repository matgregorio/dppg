const mongoose = require('mongoose');
require('dotenv').config();

// Conectar ao MongoDB
mongoose.connect(process.env.MONGODB_URI || 'mongodb://localhost:27017/simposio', {
  useNewUrlParser: true,
  useUnifiedTopology: true,
});

const Trabalho = require('../models/Trabalho');
const Participant = require('../models/Participant');
const User = require('../models/User');

async function verificarDados() {
  try {
    console.log('\n=== Verificando dados no banco ===\n');
    
    // Verificar usuários
    const users = await User.find({}).select('nome email papel');
    console.log(`Total de usuários: ${users.length}`);
    users.forEach(u => console.log(`  - ${u.email} (${u.papel})`));
    
    // Verificar participantes
    console.log('\n');
    const participants = await Participant.find({}).select('nome email cpf tipo user').populate('user', 'email');
    console.log(`Total de participantes: ${participants.length}`);
    participants.forEach(p => console.log(`  - ${p.nome} (${p.email || p.user?.email}) - CPF: ${p.cpf}`));
    
    // Verificar trabalhos
    console.log('\n');
    const trabalhos = await Trabalho.find({}).select('titulo autor autores');
    console.log(`Total de trabalhos: ${trabalhos.length}`);
    trabalhos.forEach(t => {
      console.log(`\n  Trabalho: ${t.titulo}`);
      console.log(`    Autor (ObjectId): ${t.autor || 'NÃO DEFINIDO'}`);
      console.log(`    Autores (array):`, t.autores.map(a => `${a.nome} (${a.email})`));
    });
    
    process.exit(0);
    
  } catch (error) {
    console.error('Erro:', error);
    process.exit(1);
  }
}

// Executar verificação
verificarDados();
