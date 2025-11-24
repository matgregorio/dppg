/**
 * Utilitário para garantir que todos os mesários tenham registros de Participant
 * REGRA DE NEGÓCIO: Todo mesário é um participante, mas nem todo participante é mesário
 */

const mongoose = require('mongoose');
const User = require('../models/User');
const Participant = require('../models/Participant');
const { logAudit } = require('./auditLogger');

const garantirParticipantsMesarios = async () => {
  try {
    console.log('\n🔍 Verificando mesários sem registro de Participant...\n');
    
    // Busca todos os usuários com role MESARIO
    const mesarios = await User.find({ 
      roles: 'MESARIO',
      deleted_at: null 
    });
    
    if (mesarios.length === 0) {
      console.log('✅ Nenhum mesário encontrado no sistema.\n');
      return { success: true, total: 0, criados: 0 };
    }
    
    console.log(`📋 Encontrados ${mesarios.length} mesários no sistema.`);
    
    let criadosCount = 0;
    
    for (const mesario of mesarios) {
      // Verifica se já existe Participant
      const participantExists = await Participant.findOne({ user: mesario._id });
      
      if (!participantExists) {
        // Cria Participant automaticamente
        await Participant.create({
          user: mesario._id,
          cpf: mesario.cpf,
          nome: mesario.nome,
          email: mesario.email,
          telefone: mesario.telefone || '',
          tipoParticipante: 'DOCENTE'
        });
        
        logAudit('PARTICIPANT_AUTO_CREATED', mesario._id, { 
          userId: mesario._id,
          reason: 'GARANTIR_MESARIOS_MIGRATION'
        });
        
        console.log(`   ✅ Participant criado para mesário: ${mesario.nome} (${mesario.email})`);
        criadosCount++;
      }
    }
    
    if (criadosCount === 0) {
      console.log('✅ Todos os mesários já possuem registro de Participant.\n');
    } else {
      console.log(`\n✅ ${criadosCount} registro(s) de Participant criado(s) para mesários.\n`);
    }
    
    return { 
      success: true, 
      total: mesarios.length, 
      criados: criadosCount 
    };
    
  } catch (error) {
    console.error('❌ Erro ao garantir Participants para mesários:', error);
    return { 
      success: false, 
      error: error.message 
    };
  }
};

// Permite executar diretamente via node
if (require.main === module) {
  require('dotenv').config();
  
  mongoose.connect(process.env.MONGO_URI)
    .then(async () => {
      console.log('✅ Conectado ao MongoDB\n');
      const result = await garantirParticipantsMesarios();
      console.log('Resultado:', result);
      await mongoose.disconnect();
      process.exit(0);
    })
    .catch(error => {
      console.error('❌ Erro ao conectar ao MongoDB:', error);
      process.exit(1);
    });
}

module.exports = garantirParticipantsMesarios;
