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

async function migrarParaPrimeiroParticipante() {
  try {
    console.log('Iniciando migração de autores...\n');
    
    // Buscar o primeiro participante cadastrado
    const primeiroParticipante = await Participant.findOne({}).populate('user', 'email');
    
    if (!primeiroParticipante) {
      console.log('Nenhum participante encontrado no banco!');
      process.exit(1);
    }
    
    console.log(`Usando participante: ${primeiroParticipante.nome}`);
    console.log(`Email: ${primeiroParticipante.user?.email || primeiroParticipante.email}`);
    console.log(`CPF: ${primeiroParticipante.cpf}\n`);
    
    // Buscar todos os trabalhos sem campo autor
    const trabalhos = await Trabalho.find({ 
      $or: [
        { autor: { $exists: false } },
        { autor: null }
      ]
    });
    
    console.log(`Encontrados ${trabalhos.length} trabalhos para migrar\n`);
    
    let sucesso = 0;
    
    for (const trabalho of trabalhos) {
      try {
        // Atualizar o trabalho com o campo autor
        trabalho.autor = primeiroParticipante._id;
        await trabalho.save();
        
        console.log(`✓ "${trabalho.titulo}" → ${primeiroParticipante.nome}`);
        sucesso++;
        
      } catch (err) {
        console.error(`✗ Erro ao migrar trabalho ${trabalho._id}:`, err.message);
      }
    }
    
    console.log('\n=== Migração Concluída ===');
    console.log(`Trabalhos migrados: ${sucesso}/${trabalhos.length}`);
    console.log(`\nTodos os trabalhos agora pertencem a: ${primeiroParticipante.nome}`);
    console.log(`Para ver os trabalhos, faça login com: ${primeiroParticipante.user?.email || primeiroParticipante.email}`);
    
    process.exit(0);
    
  } catch (error) {
    console.error('Erro na migração:', error);
    process.exit(1);
  }
}

// Executar migração
migrarParaPrimeiroParticipante();
