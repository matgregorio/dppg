require('dotenv').config();
const mongoose = require('mongoose');
const Apoio = require('../models/Apoio');

const apoiosData = [
  {
    nome: 'Fundação de Amparo à Pesquisa do Estado de São Paulo',
    sigla: 'FAPESP',
    tipo: 'FINANCEIRO'
  },
  {
    nome: 'Conselho Nacional de Desenvolvimento Científico e Tecnológico',
    sigla: 'CNPq',
    tipo: 'FINANCEIRO'
  },
  {
    nome: 'Coordenação de Aperfeiçoamento de Pessoal de Nível Superior',
    sigla: 'CAPES',
    tipo: 'FINANCEIRO'
  },
  {
    nome: 'Financiadora de Estudos e Projetos',
    sigla: 'FINEP',
    tipo: 'FINANCEIRO'
  },
  {
    nome: 'Ministério da Ciência, Tecnologia e Inovações',
    sigla: 'MCTI',
    tipo: 'INSTITUCIONAL'
  },
  {
    nome: 'Secretaria de Educação Superior',
    sigla: 'SESU',
    tipo: 'INSTITUCIONAL'
  },
  {
    nome: 'Empresa Brasileira de Pesquisa Agropecuária',
    sigla: 'EMBRAPA',
    tipo: 'INSTITUCIONAL'
  },
  {
    nome: 'Instituto Nacional de Pesquisas Espaciais',
    sigla: 'INPE',
    tipo: 'INSTITUCIONAL'
  },
  {
    nome: 'Serviço Brasileiro de Apoio às Micro e Pequenas Empresas',
    sigla: 'SEBRAE',
    tipo: 'LOGISTICO'
  },
  {
    nome: 'Serviço Nacional de Aprendizagem Industrial',
    sigla: 'SENAI',
    tipo: 'LOGISTICO'
  }
];

const seedApoios = async () => {
  try {
    console.log('\n🌱 Iniciando seed de apoios...\n');
    
    // Conectar ao banco
    await mongoose.connect(process.env.MONGO_URI);
    console.log('✅ Conectado ao MongoDB\n');
    
    // Limpar apoios existentes
    await Apoio.deleteMany({});
    console.log('🗑️  Apoios anteriores removidos\n');
    
    // Inserir novos apoios
    console.log('📝 Inserindo apoios...\n');
    
    for (const apoio of apoiosData) {
      const novoApoio = await Apoio.create(apoio);
      console.log(`   ✅ ${apoio.nome} (${apoio.sigla}) - Tipo: ${apoio.tipo}`);
    }
    
    console.log(`\n✅ ${apoiosData.length} apoios cadastrados com sucesso!`);
    console.log('\n🎉 Seed de apoios concluído!\n');
    
  } catch (error) {
    console.error('❌ Erro ao executar seed:', error);
    process.exit(1);
  } finally {
    await mongoose.connection.close();
    console.log('🔌 Conexão com MongoDB encerrada\n');
  }
};

seedApoios();
