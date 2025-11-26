const mongoose = require('mongoose');
const User = require('../models/User');
const Docente = require('../models/Docente');
const AreaAtuacao = require('../models/AreaAtuacao');
const Subarea = require('../models/Subarea');
const Instituicao = require('../models/Instituicao');
require('dotenv').config();

async function criarOrientadorTeste() {
  try {
    // Conecta ao banco
    await mongoose.connect(process.env.MONGODB_URI || 'mongodb://localhost:27017/dppg', {
      useNewUrlParser: true,
      useUnifiedTopology: true,
    });
    
    console.log('Conectado ao MongoDB');

    // Busca uma área de atuação existente
    let areaAtuacao = await AreaAtuacao.findOne();
    if (!areaAtuacao) {
      console.log('Criando Área de Atuação de teste...');
      areaAtuacao = await AreaAtuacao.create({
        nome: 'Ciências Exatas e da Terra',
      });
    }
    console.log(`Área de Atuação: ${areaAtuacao.nome}`);

    // Busca uma subárea existente dessa área
    let subarea = await Subarea.findOne({ areaAtuacao: areaAtuacao._id });
    if (!subarea) {
      console.log('Criando Subárea de teste...');
      subarea = await Subarea.create({
        nome: 'Ciência da Computação',
        areaAtuacao: areaAtuacao._id,
      });
    }
    console.log(`Subárea: ${subarea.nome}`);

    // Busca uma instituição existente
    let instituicao = await Instituicao.findOne();
    if (!instituicao) {
      console.log('Criando Instituição de teste...');
      instituicao = await Instituicao.create({
        nome: 'Instituto Federal de Educação, Ciência e Tecnologia',
        sigla: 'IFSP',
        tipo: 'PUBLICA',
      });
    }
    console.log(`Instituição: ${instituicao.nome}`);

    // Verifica se já existe usuário orientador de teste
    const emailOrientador = 'orientador@teste.com';
    let userOrientador = await User.findOne({ email: emailOrientador });

    if (userOrientador) {
      console.log('Usuário orientador já existe!');
      console.log(`Email: ${userOrientador.email}`);
      
      // Adiciona role DOCENTE se não tiver
      if (!userOrientador.roles.includes('DOCENTE')) {
        userOrientador.roles.push('DOCENTE');
        await userOrientador.save();
        console.log('Role DOCENTE adicionada ao usuário');
      }
    } else {
      console.log('Criando usuário orientador...');
      userOrientador = await User.create({
        nome: 'Prof. Dr. João Silva',
        email: emailOrientador,
        cpf: '12345678901',
        telefone: '(16) 99999-9999',
        senha: '123456', // Será criptografada automaticamente pelo middleware
        roles: ['USER', 'DOCENTE'],
        ativo: true,
      });
      console.log('Usuário orientador criado!');
    }

    // Verifica se já existe docente
    let docente = await Docente.findOne({ cpf: '12345678901' });

    if (docente) {
      console.log('Docente já existe!');
      console.log(`Nome: ${docente.nome}`);
      console.log(`Email: ${docente.email}`);
    } else {
      console.log('Criando registro de docente...');
      docente = await Docente.create({
        user: userOrientador._id,
        nome: 'Prof. Dr. João Silva',
        cpf: '12345678901',
        email: emailOrientador,
        telefone: '(16) 99999-9999',
        instituicao: instituicao._id,
        areaAtuacao: areaAtuacao._id,
        subarea: subarea._id,
        visitante: false,
      });
      console.log('Docente criado!');
    }

    console.log('\n===========================================');
    console.log('✅ ORIENTADOR DE TESTE CRIADO COM SUCESSO!');
    console.log('===========================================');
    console.log('\nCredenciais para login:');
    console.log(`Email: ${emailOrientador}`);
    console.log('Senha: 123456');
    console.log('\nAcesse o sistema e vá em /orientador/trabalhos');
    console.log('===========================================\n');

    await mongoose.connection.close();
    console.log('Conexão com MongoDB fechada');
    process.exit(0);
  } catch (error) {
    console.error('Erro ao criar orientador de teste:', error);
    await mongoose.connection.close();
    process.exit(1);
  }
}

criarOrientadorTeste();
