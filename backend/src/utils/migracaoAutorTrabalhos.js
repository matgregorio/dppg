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

async function migrarAutores() {
  try {
    console.log('Iniciando migração de autores...');
    
    // Buscar todos os trabalhos sem campo autor
    const trabalhos = await Trabalho.find({ autor: { $exists: false } });
    
    console.log(`Encontrados ${trabalhos.length} trabalhos para migrar`);
    
    let sucesso = 0;
    let erro = 0;
    
    for (const trabalho of trabalhos) {
      try {
        // Pegar o email do primeiro autor
        const primeiroAutor = trabalho.autores && trabalho.autores[0];
        
        if (!primeiroAutor || !primeiroAutor.email) {
          console.log(`Trabalho ${trabalho._id} não tem email de autor, pulando...`);
          erro++;
          continue;
        }
        
        // Buscar o usuário pelo email
        const user = await User.findOne({ email: primeiroAutor.email });
        
        if (!user) {
          console.log(`Usuário não encontrado para email ${primeiroAutor.email}, pulando...`);
          erro++;
          continue;
        }
        
        // Buscar o participante associado ao usuário
        const participant = await Participant.findOne({ user: user._id });
        
        if (!participant) {
          console.log(`Participante não encontrado para usuário ${user.email}, pulando...`);
          erro++;
          continue;
        }
        
        // Atualizar o trabalho com o campo autor
        trabalho.autor = participant._id;
        await trabalho.save();
        
        console.log(`✓ Trabalho "${trabalho.titulo}" migrado com sucesso`);
        sucesso++;
        
      } catch (err) {
        console.error(`Erro ao migrar trabalho ${trabalho._id}:`, err.message);
        erro++;
      }
    }
    
    console.log('\n=== Migração Concluída ===');
    console.log(`Sucesso: ${sucesso}`);
    console.log(`Erros: ${erro}`);
    console.log(`Total: ${trabalhos.length}`);
    
    process.exit(0);
    
  } catch (error) {
    console.error('Erro na migração:', error);
    process.exit(1);
  }
}

// Executar migração
migrarAutores();
