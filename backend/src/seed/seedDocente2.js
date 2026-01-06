const mongoose = require('mongoose');
const bcrypt = require('bcrypt');
const Docente = require('../models/Docente');
const User = require('../models/User');
const Instituicao = require('../models/Instituicao');
const AreaAtuacao = require('../models/AreaAtuacao');
const Subarea = require('../models/Subarea');

// Conectar ao MongoDB
mongoose.connect('mongodb://127.0.0.1:27017/simposio', {
  useNewUrlParser: true,
  useUnifiedTopology: true,
}).then(() => {
  console.log('✅ Conectado ao MongoDB');
}).catch(err => {
  console.error('❌ Erro ao conectar ao MongoDB:', err);
  process.exit(1);
});

async function seedDocente2() {
  try {
    // Buscar uma instituição existente ou criar uma
    let instituicao = await Instituicao.findOne();
    if (!instituicao) {
      console.log('📝 Criando instituição de teste...');
      instituicao = await Instituicao.create({
        nome: 'Universidade Federal de Exemplo',
        sigla: 'UFE',
        tipo: 'FEDERAL',
        cidade: 'Cidade Exemplo',
        estado: 'EX'
      });
      console.log('✅ Instituição criada:', instituicao.nome);
    } else {
      console.log('✅ Usando instituição existente:', instituicao.nome);
    }

    // Buscar uma área de atuação existente ou criar uma
    let areaAtuacao = await AreaAtuacao.findOne();
    if (!areaAtuacao) {
      console.log('📝 Criando área de atuação de teste...');
      areaAtuacao = await AreaAtuacao.create({
        codigo: '1.00.00.00-0',
        nome: 'Ciências Exatas e da Terra',
        tipo: 'GRANDE_AREA'
      });
      console.log('✅ Área de atuação criada:', areaAtuacao.nome);
    } else {
      console.log('✅ Usando área de atuação existente:', areaAtuacao.nome);
    }

    // Buscar uma subárea existente ou criar uma
    let subarea = await Subarea.findOne({ areaAtuacao: areaAtuacao._id });
    if (!subarea) {
      console.log('📝 Criando subárea de teste...');
      subarea = await Subarea.create({
        codigo: '1.03.00.00-0',
        nome: 'Ciência da Computação',
        areaAtuacao: areaAtuacao._id
      });
      console.log('✅ Subárea criada:', subarea.nome);
    } else {
      console.log('✅ Usando subárea existente:', subarea.nome);
    }

    // Verificar se o docente já existe
    const docenteExistente = await Docente.findOne({ cpf: '987.654.321-00' });
    
    // Verificar se o usuário já existe (usando .select('+senha') para poder atualizar)
    let user = await User.findOne({ email: 'docente2@gov.br' }).select('+senha');
    
    if (docenteExistente && user) {
      console.log('⚠️  Docente 2 já existe no banco de dados');
      console.log('Nome:', docenteExistente.nome);
      console.log('Email:', docenteExistente.email);
      console.log('📝 Atualizando senha do usuário...');
      
      // Atualizar a senha - passar senha em texto plano, o middleware fará o hash
      user.senha = 'Docente!234';
      await user.save();
      
      console.log('✅ Senha atualizada com sucesso!');
      console.log('🔐 CREDENCIAIS DE ACESSO:');
      console.log('Email:', user.email);
      console.log('Senha: Docente!234');
      process.exit(0);
    }
    
    if (user) {
      console.log('⚠️  Usuário docente2@gov.br já existe');
      process.exit(1);
    }

    // Criar o usuário com email e senha
    console.log('📝 Criando usuário de acesso...');
    // NÃO fazer hash aqui - o middleware pre('save') do User fará o hash automaticamente
    user = await User.create({
      nome: 'Profa. Dra. Maria Santos',
      email: 'docente2@gov.br',
      cpf: '987.654.321-00',
      senha: 'Docente!234', // Senha em texto plano - o middleware fará o hash
      telefone: '(11) 91234-5678',
      roles: ['DOCENTE'],
      emailVerified: true,
      verified: true
    });

    console.log('✅ Usuário criado:', user.email);

    // Criar o docente
    console.log('📝 Criando docente de teste...');
    const docente = await Docente.create({
      user: user._id, // Vinculação com o User
      nome: 'Profa. Dra. Maria Santos',
      cpf: '987.654.321-00',
      email: 'maria.santos@example.com',
      telefone: '(11) 91234-5678',
      instituicao: instituicao._id,
      areaAtuacao: areaAtuacao._id,
      subarea: subarea._id,
      visitante: false
    });

    console.log('\n✅ Docente 2 cadastrado com sucesso!');
    console.log('===========================================');
    console.log('ID:', docente._id);
    console.log('Nome:', docente.nome);
    console.log('CPF:', docente.cpf);
    console.log('Email institucional:', docente.email);
    console.log('Telefone:', docente.telefone);
    console.log('Instituição:', instituicao.nome);
    console.log('Área de Atuação:', areaAtuacao.nome);
    console.log('Subárea:', subarea.nome);
    console.log('-------------------------------------------');
    console.log('🔐 CREDENCIAIS DE ACESSO:');
    console.log('Email:', user.email);
    console.log('Senha:', 'Docente!234');
    console.log('===========================================');

    process.exit(0);
  } catch (error) {
    console.error('❌ Erro ao cadastrar docente 2:', error);
    process.exit(1);
  }
}

seedDocente2();
