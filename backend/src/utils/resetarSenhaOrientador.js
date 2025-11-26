const mongoose = require('mongoose');
const User = require('../models/User');
const bcrypt = require('bcrypt');
require('dotenv').config();

async function resetarSenhaOrientador() {
  try {
    // Conecta ao banco
    await mongoose.connect(process.env.MONGODB_URI || 'mongodb://localhost:27017/dppg', {
      useNewUrlParser: true,
      useUnifiedTopology: true,
    });
    
    console.log('Conectado ao MongoDB');

    // Busca o usuário orientador
    const emailOrientador = 'orientador@teste.com';
    const user = await User.findOne({ email: emailOrientador }).select('+senha');

    if (!user) {
      console.error('❌ Usuário não encontrado!');
      await mongoose.connection.close();
      process.exit(1);
    }

    console.log(`Usuário encontrado: ${user.nome}`);
    console.log(`Email: ${user.email}`);
    console.log(`Roles: ${user.roles.join(', ')}`);
    console.log(`Ativo: ${user.ativo}`);

    // Hash da nova senha
    const novaSenha = '123456';
    const salt = await bcrypt.genSalt(10);
    const senhaHash = await bcrypt.hash(novaSenha, salt);

    // Atualiza a senha diretamente
    user.senha = senhaHash;
    
    // Garante que o usuário está ativo
    user.ativo = true;
    user.bloqueado_ate = null;
    user.tentativas_login = 0;
    
    // Adiciona role DOCENTE se não tiver
    if (!user.roles.includes('DOCENTE')) {
      user.roles.push('DOCENTE');
      console.log('Role DOCENTE adicionada');
    }
    
    // Salva sem executar o middleware de hash novamente
    await User.updateOne(
      { _id: user._id },
      {
        $set: {
          senha: senhaHash,
          ativo: true,
          bloqueado_ate: null,
          tentativas_login: 0,
          roles: user.roles,
        }
      }
    );

    console.log('\n===========================================');
    console.log('✅ SENHA RESETADA COM SUCESSO!');
    console.log('===========================================');
    console.log('\nCredenciais atualizadas:');
    console.log(`Email: ${emailOrientador}`);
    console.log('Senha: 123456');
    console.log('\nTente fazer login novamente!');
    console.log('===========================================\n');

    await mongoose.connection.close();
    console.log('Conexão com MongoDB fechada');
    process.exit(0);
  } catch (error) {
    console.error('Erro ao resetar senha:', error);
    await mongoose.connection.close();
    process.exit(1);
  }
}

resetarSenhaOrientador();
