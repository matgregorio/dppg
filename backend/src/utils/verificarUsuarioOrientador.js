const mongoose = require('mongoose');
const User = require('../models/User');
const bcrypt = require('bcrypt');
require('dotenv').config();

async function verificarUsuario() {
  try {
    await mongoose.connect(process.env.MONGODB_URI || 'mongodb://localhost:27017/dppg', {
      useNewUrlParser: true,
      useUnifiedTopology: true,
    });
    
    console.log('Conectado ao MongoDB\n');

    const emailOrientador = 'orientador@teste.com';
    const senhaParaTestar = '123456';

    // Busca o usuário COM a senha
    const user = await User.findOne({ email: emailOrientador }).select('+senha');

    if (!user) {
      console.error('❌ Usuário não encontrado!');
      await mongoose.connection.close();
      process.exit(1);
    }

    console.log('📋 INFORMAÇÕES DO USUÁRIO:');
    console.log('================================');
    console.log(`ID: ${user._id}`);
    console.log(`Nome: ${user.nome}`);
    console.log(`Email: ${user.email}`);
    console.log(`CPF: ${user.cpf}`);
    console.log(`Telefone: ${user.telefone || 'N/A'}`);
    console.log(`Roles: ${user.roles.join(', ')}`);
    console.log(`Ativo: ${user.ativo}`);
    console.log(`Bloqueado até: ${user.bloqueado_ate || 'N/A'}`);
    console.log(`Tentativas de login: ${user.tentativas_login}`);
    console.log(`Deleted_at: ${user.deleted_at || 'N/A'}`);
    console.log(`Senha hash: ${user.senha.substring(0, 20)}...`);
    console.log('================================\n');

    // Testa a comparação da senha
    console.log('🔐 TESTANDO SENHA:');
    console.log('================================');
    const senhaCorreta = await bcrypt.compare(senhaParaTestar, user.senha);
    console.log(`Senha testada: ${senhaParaTestar}`);
    console.log(`Resultado: ${senhaCorreta ? '✅ CORRETA' : '❌ INCORRETA'}`);
    console.log('================================\n');

    if (!senhaCorreta) {
      console.log('⚠️  A senha não está correta. Resetando...\n');
      
      // Gera novo hash
      const salt = await bcrypt.genSalt(10);
      const novoHash = await bcrypt.hash(senhaParaTestar, salt);
      
      // Atualiza diretamente no banco
      await mongoose.connection.collection('users').updateOne(
        { _id: user._id },
        {
          $set: {
            senha: novoHash,
            ativo: true,
            bloqueado_ate: null,
            tentativas_login: 0,
            deleted_at: null,
          }
        }
      );
      
      console.log('✅ Senha atualizada!\n');
      
      // Verifica novamente
      const userAtualizado = await User.findOne({ email: emailOrientador }).select('+senha');
      const senhaAgoraCorreta = await bcrypt.compare(senhaParaTestar, userAtualizado.senha);
      console.log(`Verificação pós-atualização: ${senhaAgoraCorreta ? '✅ CORRETA' : '❌ AINDA INCORRETA'}`);
    }

    console.log('\n📝 CREDENCIAIS PARA LOGIN:');
    console.log('================================');
    console.log(`Email: ${emailOrientador}`);
    console.log(`Senha: ${senhaParaTestar}`);
    console.log('================================\n');

    await mongoose.connection.close();
    console.log('Conexão fechada');
    process.exit(0);
  } catch (error) {
    console.error('Erro:', error);
    await mongoose.connection.close();
    process.exit(1);
  }
}

verificarUsuario();
