require('dotenv').config();
const mongoose = require('mongoose');
const EmailTemplate = require('../models/EmailTemplate');

const initEmailTemplates = async () => {
  try {
    console.log('\n📧 Inicializando templates de email...\n');
    
    // Conectar ao MongoDB
    await mongoose.connect(process.env.MONGO_URI || 'mongodb://localhost:27017/simposio');
    console.log('✅ Conectado ao MongoDB\n');
    
    const defaults = EmailTemplate.getDefaults();
    
    let criados = 0;
    let existentes = 0;
    
    for (const templateData of defaults) {
      const exists = await EmailTemplate.findOne({ chave: templateData.chave });
      
      if (!exists) {
        await EmailTemplate.create(templateData);
        console.log(`✓ Template criado: ${templateData.nome}`);
        criados++;
      } else {
        console.log(`→ Template já existe: ${templateData.nome}`);
        existentes++;
      }
    }
    
    console.log(`\n✅ Processo concluído!`);
    console.log(`   ${criados} templates criados`);
    console.log(`   ${existentes} templates já existiam\n`);
    
    await mongoose.disconnect();
    process.exit(0);
  } catch (error) {
    console.error('❌ Erro:', error);
    await mongoose.disconnect();
    process.exit(1);
  }
};

initEmailTemplates();
