require('dotenv').config();
const mongoose = require('mongoose');
const Acervo = require('../models/Acervo');
const Simposio = require('../models/Simposio');

const acervosExemplo = [
  {
    titulo: 'Inteligência Artificial e Machine Learning na Educação',
    anoEvento: 2024,
    autores: ['Dr. João Silva', 'Dra. Maria Santos', 'Prof. Carlos Oliveira'],
    palavras_chave: ['inteligência artificial', 'machine learning', 'educação', 'tecnologia educacional'],
    tipo: 'ARTIGO',
    resumo: 'Este trabalho apresenta uma análise sobre o uso de IA e ML em ambientes educacionais.'
  },
  {
    titulo: 'Desenvolvimento Sustentável e Tecnologias Verdes',
    anoEvento: 2024,
    autores: ['Profa. Ana Costa', 'Dr. Paulo Mendes'],
    palavras_chave: ['sustentabilidade', 'tecnologias verdes', 'meio ambiente', 'inovação'],
    tipo: 'ARTIGO',
    resumo: 'Análise das principais tecnologias verdes aplicadas ao desenvolvimento sustentável.'
  },
  {
    titulo: 'Blockchain e Criptomoedas: Perspectivas Futuras',
    anoEvento: 2024,
    autores: ['Dr. Roberto Alves', 'Dra. Fernanda Lima'],
    palavras_chave: ['blockchain', 'criptomoedas', 'tecnologia', 'finanças'],
    tipo: 'ARTIGO',
    resumo: 'Estudo sobre as aplicações e perspectivas futuras da tecnologia blockchain.'
  },
  {
    titulo: 'Computação em Nuvem e Big Data',
    anoEvento: 2023,
    autores: ['Prof. Ricardo Souza', 'Dra. Juliana Rocha', 'Dr. Marcos Pereira'],
    palavras_chave: ['cloud computing', 'big data', 'análise de dados', 'infraestrutura'],
    tipo: 'ARTIGO',
    resumo: 'Análise das tendências em computação em nuvem e processamento de big data.'
  },
  {
    titulo: 'Internet das Coisas (IoT) em Smart Cities',
    anoEvento: 2023,
    autores: ['Dra. Carla Martins', 'Prof. Eduardo Ribeiro'],
    palavras_chave: ['IoT', 'smart cities', 'cidades inteligentes', 'sensores'],
    tipo: 'ARTIGO',
    resumo: 'Estudo sobre a implementação de IoT em projetos de cidades inteligentes.'
  },
  {
    titulo: 'Segurança Cibernética e Proteção de Dados',
    anoEvento: 2023,
    autores: ['Dr. Felipe Barbosa', 'Dra. Beatriz Araújo'],
    palavras_chave: ['segurança', 'cibersegurança', 'privacidade', 'LGPD'],
    tipo: 'ARTIGO',
    resumo: 'Discussão sobre as melhores práticas em segurança cibernética e conformidade com LGPD.'
  },
  {
    titulo: 'Realidade Virtual e Aumentada na Medicina',
    anoEvento: 2022,
    autores: ['Dra. Patrícia Gomes', 'Dr. Rodrigo Fernandes', 'Profa. Sandra Reis'],
    palavras_chave: ['realidade virtual', 'realidade aumentada', 'medicina', 'saúde'],
    tipo: 'ARTIGO',
    resumo: 'Aplicações de RV e RA em procedimentos médicos e treinamento de profissionais.'
  },
  {
    titulo: 'Desenvolvimento de Aplicativos Mobile Híbridos',
    anoEvento: 2022,
    autores: ['Prof. André Pinto', 'Dra. Camila Nunes'],
    palavras_chave: ['mobile', 'aplicativos', 'híbridos', 'desenvolvimento'],
    tipo: 'ARTIGO',
    resumo: 'Comparativo entre frameworks para desenvolvimento de aplicativos mobile híbridos.'
  },
  {
    titulo: 'Impressão 3D e Manufatura Aditiva',
    anoEvento: 2022,
    autores: ['Dr. Gabriel Costa', 'Profa. Luciana Dias'],
    palavras_chave: ['impressão 3D', 'manufatura aditiva', 'prototipagem', 'indústria 4.0'],
    tipo: 'ARTIGO',
    resumo: 'Avanços em tecnologias de impressão 3D e suas aplicações industriais.'
  },
  {
    titulo: 'Metodologias Ágeis no Desenvolvimento de Software',
    anoEvento: 2021,
    autores: ['Prof. Thiago Amaral', 'Dra. Vanessa Cardoso'],
    palavras_chave: ['ágil', 'scrum', 'desenvolvimento', 'metodologias'],
    tipo: 'ARTIGO',
    resumo: 'Estudo comparativo de metodologias ágeis aplicadas em projetos de software.'
  }
];

async function seedAcervo() {
  try {
    await mongoose.connect(process.env.MONGO_URI);
    console.log('✅ Conectado ao MongoDB');

    // Criar simpósios dos anos anteriores se não existirem
    const anos = [2021, 2022, 2023, 2024];
    for (const ano of anos) {
      const simposioExists = await Simposio.findOne({ ano });
      if (!simposioExists) {
        await Simposio.create({
          ano,
          nome: `${ano}º Simpósio de Pesquisa e Pós-Graduação`,
          descricao: `Simpósio realizado em ${ano}`,
          local: 'Campus Universitário',
          status: 'FINALIZADO',
          datasConfig: {
            inscricaoParticipante: {
              inicio: new Date(`${ano}-01-15`),
              fim: new Date(`${ano}-03-31`)
            },
            submissaoTrabalhos: {
              inicio: new Date(`${ano}-02-01`),
              fim: new Date(`${ano}-04-30`)
            },
            prazoAvaliacao: {
              inicio: new Date(`${ano}-05-01`),
              fim: new Date(`${ano}-05-10`)
            },
            notasAvaliacaoExterna: {
              inicio: new Date(`${ano}-05-01`),
              fim: new Date(`${ano}-05-14`)
            }
          }
        });
        console.log(`✅ Simpósio ${ano} criado`);
      }
    }

    // Limpar acervo existente (opcional)
    // await Acervo.deleteMany({});
    // console.log('🗑️ Acervo limpo');

    // Inserir itens do acervo
    for (const item of acervosExemplo) {
      const exists = await Acervo.findOne({ titulo: item.titulo });
      if (!exists) {
        await Acervo.create(item);
        console.log(`✅ Item adicionado: ${item.titulo}`);
      } else {
        console.log(`⏭️ Item já existe: ${item.titulo}`);
      }
    }

    console.log('\n✅ Seed de acervo concluído com sucesso!');
    process.exit(0);
  } catch (error) {
    console.error('❌ Erro no seed:', error);
    process.exit(1);
  }
}

seedAcervo();
