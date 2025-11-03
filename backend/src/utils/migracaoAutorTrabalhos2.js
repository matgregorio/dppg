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
const Simposio = require('../models/Simposio');

async function migrarTodosAutores() {
  try {
    console.log('Iniciando migração de autores...');
    
    // Buscar todos os trabalhos sem campo autor
    const trabalhos = await Trabalho.find({ 
      $or: [
        { autor: { $exists: false } },
        { autor: null }
      ]
    });
    
    console.log(`Encontrados ${trabalhos.length} trabalhos para migrar`);
    
    let sucesso = 0;
    let erro = 0;
    
    for (const trabalho of trabalhos) {
      try {
        console.log(`\nProcessando trabalho: "${trabalho.titulo}"`);
        console.log(`Autores cadastrados:`, trabalho.autores);
        
        // Tentar encontrar participante de várias formas
        let participant = null;
        
        // 1. Tentar pelo email do primeiro autor
        if (trabalho.autores && trabalho.autores[0] && trabalho.autores[0].email) {
          const email = trabalho.autores[0].email;
          console.log(`Buscando usuário pelo email: ${email}`);
          
          const user = await User.findOne({ email: email });
          if (user) {
            participant = await Participant.findOne({ user: user._id });
            if (participant) {
              console.log(`✓ Participante encontrado pelo email`);
            }
          }
        }
        
        // 2. Tentar pelo CPF do primeiro autor
        if (!participant && trabalho.autores && trabalho.autores[0] && trabalho.autores[0].cpf) {
          const cpf = trabalho.autores[0].cpf;
          console.log(`Buscando participante pelo CPF: ${cpf}`);
          
          participant = await Participant.findOne({ cpf: cpf });
          if (participant) {
            console.log(`✓ Participante encontrado pelo CPF`);
          }
        }
        
        // 3. Tentar pelo nome do primeiro autor
        if (!participant && trabalho.autores && trabalho.autores[0] && trabalho.autores[0].nome) {
          const nome = trabalho.autores[0].nome;
          console.log(`Buscando participante pelo nome: ${nome}`);
          
          participant = await Participant.findOne({ nome: nome });
          if (participant) {
            console.log(`✓ Participante encontrado pelo nome`);
          }
        }
        
        // 4. Se ainda não encontrou, pegar qualquer participante do tipo PARTICIPANTE
        if (!participant) {
          console.log(`Não encontrou participante específico, buscando um participante genérico...`);
          participant = await Participant.findOne({ tipo: 'PARTICIPANTE' });
          if (participant) {
            console.log(`⚠ Usando participante genérico: ${participant.nome}`);
          }
        }
        
        if (!participant) {
          console.log(`✗ Nenhum participante encontrado, pulando...`);
          erro++;
          continue;
        }
        
        // Atualizar o trabalho com o campo autor
        trabalho.autor = participant._id;
        await trabalho.save();
        
        console.log(`✓ Trabalho migrado com sucesso para participante: ${participant.nome}`);
        sucesso++;
        
      } catch (err) {
        console.error(`✗ Erro ao migrar trabalho ${trabalho._id}:`, err.message);
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
migrarTodosAutores();
