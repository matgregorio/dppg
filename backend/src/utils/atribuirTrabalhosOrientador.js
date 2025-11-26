const mongoose = require('mongoose');
const Trabalho = require('../models/Trabalho');
const Docente = require('../models/Docente');
require('dotenv').config();

async function atribuirTrabalhosAoOrientador() {
  try {
    // Conecta ao banco
    await mongoose.connect(process.env.MONGODB_URI || 'mongodb://localhost:27017/dppg', {
      useNewUrlParser: true,
      useUnifiedTopology: true,
    });
    
    console.log('Conectado ao MongoDB');

    // Busca o orientador de teste
    const orientador = await Docente.findOne({ email: 'orientador@teste.com' });
    
    if (!orientador) {
      console.error('❌ Orientador de teste não encontrado!');
      console.log('Execute primeiro: node src/utils/criarOrientadorTeste.js');
      await mongoose.connection.close();
      process.exit(1);
    }

    console.log(`Orientador encontrado: ${orientador.nome}`);

    // Busca trabalhos que não têm orientador ou estão aguardando
    const trabalhosSemOrientador = await Trabalho.find({
      $or: [
        { orientador: { $exists: false } },
        { orientador: null }
      ],
      deleted_at: null,
    }).limit(5);

    if (trabalhosSemOrientador.length === 0) {
      console.log('Nenhum trabalho sem orientador encontrado.');
      console.log('Buscando trabalhos existentes para atualizar status...');
      
      // Atualiza status de trabalhos já atribuídos a este orientador
      const trabalhosDoOrientador = await Trabalho.find({
        orientador: orientador._id,
        deleted_at: null,
      });

      if (trabalhosDoOrientador.length === 0) {
        console.log('❌ Nenhum trabalho encontrado. Submeta um trabalho primeiro.');
      } else {
        let atualizados = 0;
        for (const trabalho of trabalhosDoOrientador) {
          if (trabalho.status !== 'AGUARDANDO_ORIENTADOR') {
            trabalho.status = 'AGUARDANDO_ORIENTADOR';
            trabalho.parecerOrientador = undefined;
            await trabalho.save();
            atualizados++;
          }
        }
        console.log(`✅ ${atualizados} trabalho(s) colocado(s) em status AGUARDANDO_ORIENTADOR`);
      }
    } else {
      console.log(`Encontrados ${trabalhosSemOrientador.length} trabalho(s) sem orientador`);
      
      for (const trabalho of trabalhosSemOrientador) {
        trabalho.orientador = orientador._id;
        trabalho.status = 'AGUARDANDO_ORIENTADOR';
        trabalho.parecerOrientador = undefined;
        await trabalho.save();
        console.log(`✅ Trabalho "${trabalho.titulo}" atribuído ao orientador`);
      }
    }

    console.log('\n===========================================');
    console.log('✅ TRABALHOS ATRIBUÍDOS COM SUCESSO!');
    console.log('===========================================');
    console.log('\nAgora você pode:');
    console.log('1. Fazer login com: orientador@teste.com / 123456');
    console.log('2. Acessar: /orientador/trabalhos');
    console.log('3. Avaliar os trabalhos atribuídos');
    console.log('===========================================\n');

    await mongoose.connection.close();
    console.log('Conexão com MongoDB fechada');
    process.exit(0);
  } catch (error) {
    console.error('Erro ao atribuir trabalhos:', error);
    await mongoose.connection.close();
    process.exit(1);
  }
}

atribuirTrabalhosAoOrientador();
