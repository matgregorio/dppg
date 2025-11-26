const mongoose = require('mongoose');
const bcrypt = require('bcrypt');
require('dotenv').config();

async function atualizarSenhaOrientador() {
  try {
    await mongoose.connect(process.env.MONGODB_URI || 'mongodb://localhost:27017/dppg', {
      useNewUrlParser: true,
      useUnifiedTopology: true,
    });
    
    console.log('Conectado ao MongoDB\n');

    const emailOrientador = 'orientador@teste.com';
    const novaSenha = 'Orientador!234';

    // Gera o hash da nova senha
    const salt = await bcrypt.genSalt(10);
    const senhaHash = await bcrypt.hash(novaSenha, salt);

    // Atualiza diretamente na collection users
    const resultado = await mongoose.connection.collection('users').updateOne(
      { email: emailOrientador },
      {
        $set: {
          senha: senhaHash,
          ativo: true,
          bloqueado_ate: null,
          tentativas_login: 0,
          deleted_at: null,
        }
      }
    );

    if (resultado.matchedCount === 0) {
      console.error('❌ Usuário não encontrado!');
      await mongoose.connection.close();
      process.exit(1);
    }

    console.log('✅ Senha atualizada com sucesso!\n');

    // Verifica se a senha está correta
    const user = await mongoose.connection.collection('users').findOne({ email: emailOrientador });
    const senhaCorreta = await bcrypt.compare(novaSenha, user.senha);

    console.log('🔐 VERIFICAÇÃO:');
    console.log('================================');
    console.log(`Senha testada: ${novaSenha}`);
    console.log(`Resultado: ${senhaCorreta ? '✅ CORRETA' : '❌ INCORRETA'}`);
    console.log('================================\n');

    console.log('📝 CREDENCIAIS ATUALIZADAS:');
    console.log('================================');
    console.log(`Email: ${emailOrientador}`);
    console.log(`Senha: ${novaSenha}`);
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

atualizarSenhaOrientador();
