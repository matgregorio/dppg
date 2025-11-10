require('dotenv').config();
const mongoose = require('mongoose');
const dayjs = require('dayjs');
const path = require('path');

// Models
const User = require('../models/User');
const Participant = require('../models/Participant');
const Simposio = require('../models/Simposio');
const InscricaoSimposio = require('../models/InscricaoSimposio');
const GrandeArea = require('../models/GrandeArea');
const AreaAtuacao = require('../models/AreaAtuacao');
const Subarea = require('../models/Subarea');
const PaginasEstaticas = require('../models/PaginasEstaticas');
const Subevento = require('../models/Subevento');
const Trabalho = require('../models/Trabalho');
const Certificado = require('../models/Certificado');
const Presenca = require('../models/Presenca');
const Acervo = require('../models/Acervo');
const Avaliador = require('../models/Avaliador');

const { gerarCPF } = require('../utils/cpfValidator');
const logger = require('../config/logger');

const DEFAULT_PASSWORD = process.env.SEED_PASSWORD_DEFAULT || 'Teste!234';
const DEFAULT_ANO = parseInt(process.env.DEFAULT_SIMPOSIO_ANO) || new Date().getFullYear();

const runSeed = async () => {
  try {
    console.log('\n🌱 Iniciando seed do banco de dados...\n');
    
    // Conectar ao banco
    await mongoose.connect(process.env.MONGO_URI);
    console.log('✅ Conectado ao MongoDB\n');
    
    // 1. Usuários
    console.log('📝 Criando usuários...');
    const usuarios = [
      { email: 'admin@gov.br', senha: 'Admin!234', nome: 'Administrador', cpf: gerarCPF(), roles: ['ADMIN'] },
      { email: 'subadmin@gov.br', senha: 'SubAdmin!234', nome: 'Sub Administrador', cpf: gerarCPF(), roles: ['SUBADMIN'] },
      { email: 'avaliador1@gov.br', senha: 'Avaliador!234', nome: 'Avaliador Um', cpf: gerarCPF(), roles: ['AVALIADOR'] },
      { email: 'avaliador2@gov.br', senha: 'Avaliador!234', nome: 'Avaliador Dois', cpf: gerarCPF(), roles: ['AVALIADOR'] },
      { email: 'mesario@gov.br', senha: 'Mesario!234', nome: 'Mesário', cpf: gerarCPF(), roles: ['USER', 'MESARIO'] },
      { email: 'participante1@gov.br', senha: 'Participante!234', nome: 'Participante Um', cpf: gerarCPF(), roles: ['USER'] },
      { email: 'participante2@gov.br', senha: 'Participante!234', nome: 'Participante Dois', cpf: gerarCPF(), roles: ['USER'] },
    ];
    
    const usersCreated = [];
    for (const u of usuarios) {
      let user = await User.findOne({ email: u.email });
      if (!user) {
        user = await User.create(u);
      } else {
        // Atualiza as roles do usuário existente se necessário
        const rolesChanged = JSON.stringify(user.roles.sort()) !== JSON.stringify(u.roles.sort());
        if (rolesChanged) {
          user.roles = u.roles;
          await user.save();
          console.log(`   ✅ Roles atualizadas para ${user.email}: ${u.roles.join(', ')}`);
        }
      }
      usersCreated.push(user);
    }
    console.log(`✅ ${usersCreated.length} usuários criados/verificados\n`);
    
    // 2. Participants
    console.log('📝 Criando participantes...');
    const participants = [];
    // Incluindo mesário (índice 4) e participantes comuns (índices 5 e 6)
    for (let i = 4; i <= 6; i++) {
      const user = usersCreated[i];
      let participant = await Participant.findOne({ user: user._id });
      if (!participant) {
        participant = await Participant.create({
          user: user._id,
          cpf: user.cpf,
          nome: user.nome,
          email: user.email,
          tipoParticipante: i === 4 ? 'DOCENTE' : (i === 5 ? 'DISCENTE' : 'DOCENTE'),
        });
      }
      participants.push(participant);
    }
    console.log(`✅ ${participants.length} participantes criados\n`);
    
    // 3. Simpósio
    console.log('📝 Criando/atualizando simpósio...');
    let simposio = await Simposio.findOne({ ano: DEFAULT_ANO });
    if (!simposio) {
      simposio = await Simposio.create({
        ano: DEFAULT_ANO,
        nome: `Simpósio de Pesquisa, Pós-Graduação e Inovação ${DEFAULT_ANO}`,
        descricao: 'Evento anual dedicado à divulgação científica e tecnológica, promovendo o intercâmbio de conhecimentos entre pesquisadores, docentes e discentes.',
        local: 'Campus Universitário - Auditório Central',
        status: 'INICIALIZADO',
        datasConfig: {
          inscricaoParticipante: {
            inicio: dayjs().subtract(10, 'day').toDate(),
            fim: dayjs().add(60, 'day').toDate(),
          },
          submissaoTrabalhos: {
            inicio: dayjs().subtract(5, 'day').toDate(),
            fim: dayjs().add(15, 'day').toDate(),
          },
          prazoAvaliacao: {
            inicio: dayjs().add(16, 'day').toDate(),
            fim: dayjs().add(45, 'day').toDate(),
          },
          notasAvaliacaoExterna: {
            inicio: dayjs().add(46, 'day').toDate(),
            fim: dayjs().add(60, 'day').toDate(),
          },
        },
      });
      console.log(`✅ Simpósio ${DEFAULT_ANO} criado`);
    } else {
      // Atualiza campos se não existirem
      let updated = false;
      if (!simposio.nome) {
        simposio.nome = `Simpósio de Pesquisa, Pós-Graduação e Inovação ${DEFAULT_ANO}`;
        updated = true;
      }
      if (!simposio.descricao) {
        simposio.descricao = 'Evento anual dedicado à divulgação científica e tecnológica, promovendo o intercâmbio de conhecimentos entre pesquisadores, docentes e discentes.';
        updated = true;
      }
      if (!simposio.local) {
        simposio.local = 'Campus Universitário - Auditório Central';
        updated = true;
      }
      if (updated) {
        await simposio.save();
        console.log(`✅ Simpósio ${DEFAULT_ANO} atualizado com nome, descrição e local`);
      } else {
        console.log(`✅ Simpósio ${DEFAULT_ANO} já existe e está atualizado`);
      }
    }
    console.log(`   Nome: ${simposio.nome}\n`);
    
    // 4. GrandeArea
    console.log('📝 Criando grandes áreas...');
    const grandesAreas = ['Ciências Exatas e da Terra', 'Engenharias', 'Ciências da Saúde', 'Ciências Humanas'];
    const areasCreated = [];
    for (const nome of grandesAreas) {
      let area = await GrandeArea.findOne({ nome });
      if (!area) {
        area = await GrandeArea.create({ nome });
      }
      areasCreated.push(area);
    }
    console.log(`✅ ${areasCreated.length} grandes áreas criadas\n`);
    
    // 5. AreaAtuacao e Subarea (simplificado)
    console.log('📝 Criando áreas de atuação e subáreas...');
    let areaAtuacao = await AreaAtuacao.findOne({ nome: 'Ciência da Computação' });
    if (!areaAtuacao) {
      areaAtuacao = await AreaAtuacao.create({ nome: 'Ciência da Computação', grandeArea: areasCreated[0]._id });
    }
    
    let subarea = await Subarea.findOne({ nome: 'Algoritmos', grandeArea: areasCreated[0]._id });
    if (!subarea) {
      subarea = await Subarea.create({ nome: 'Algoritmos', grandeArea: areasCreated[0]._id });
    }
    console.log(`✅ Áreas de atuação e subáreas criadas\n`);
    
    // 6. PaginasEstaticas
    console.log('📝 Criando páginas estáticas...');
    const slugs = ['home', 'apresentacao', 'regulamento', 'corpo-editorial', 'expediente', 'normas-publicacao', 'programacao', 'modelo-poster', 'anais', 'dppg'];
    for (const slug of slugs) {
      await PaginasEstaticas.findOneAndUpdate(
        { slug },
        { slug, conteudo: `<h1>${slug.toUpperCase()}</h1><p>Conteúdo de ${slug}</p>` },
        { upsert: true, new: true }
      );
    }
    console.log(`✅ ${slugs.length} páginas estáticas criadas\n`);
    
    // 7. Inscrições
    console.log('📝 Criando inscrições...');
    for (const participant of participants) {
      const existe = await InscricaoSimposio.findOne({ participant: participant._id, simposio: simposio._id });
      if (!existe) {
        await InscricaoSimposio.create({
          participant: participant._id,
          simposio: simposio._id,
          status: 'ATIVA',
        });
      }
    }
    console.log(`✅ Inscrições criadas\n`);
    
    // 8. Subeventos
    console.log('📝 Criando subeventos...');
    const mesario = usersCreated[4];
    const subeventosData = [
      { titulo: 'Abertura', data: dayjs().add(1, 'day').toDate(), horarioInicio: '19:00', duracao: '02:00', local: 'Auditório', vagas: 300 },
      { titulo: 'Palestra Magna', data: dayjs().add(2, 'day').toDate(), horarioInicio: '10:00', duracao: '01:30', local: 'Auditório', vagas: 300 },
    ];
    
    for (const se of subeventosData) {
      const existe = await Subevento.findOne({ titulo: se.titulo, simposio: simposio._id });
      if (!existe) {
        await Subevento.create({
          ...se,
          simposio: simposio._id,
          responsaveisMesarios: [mesario._id],
        });
      }
    }
    console.log(`✅ Subeventos criados\n`);
    
    // 9. Trabalhos
    console.log('📝 Criando trabalhos...');
    const avaliador1 = usersCreated[2];
    const avaliador2 = usersCreated[3];
    
    const trabalho1 = await Trabalho.findOne({ titulo: 'Análise de Algoritmos para Simpósios', simposio: simposio._id });
    if (!trabalho1) {
      await Trabalho.create({
        titulo: 'Análise de Algoritmos para Simpósios',
        autores: [{ nome: 'Autor 1', email: 'autor1@test.com' }],
        palavras_chave: ['algoritmos', 'otimização'],
        grandeArea: areasCreated[0]._id,
        areaAtuacao: areaAtuacao._id,
        subarea: subarea._id,
        simposio: simposio._id,
        status: 'SUBMETIDO',
      });
    }
    
    const trabalho2 = await Trabalho.findOne({ titulo: 'Estudo de Densidades Informacionais', simposio: simposio._id });
    if (!trabalho2) {
      await Trabalho.create({
        titulo: 'Estudo de Densidades Informacionais',
        autores: [{ nome: 'Autor 2', email: 'autor2@test.com' }],
        palavras_chave: ['informação', 'densidade'],
        grandeArea: areasCreated[0]._id,
        simposio: simposio._id,
        status: 'EM_AVALIACAO',
        atribuicoes: [
          { avaliador: avaliador1._id },
          { avaliador: avaliador2._id },
        ],
        avaliacoes: [
          { avaliador: avaliador1._id, nota: 8.5, parecer: 'Bem estruturado' },
          { avaliador: avaliador2._id, nota: 7.0, parecer: 'Carece de testes' },
        ],
        qtd_enviados: 2,
        qtd_avaliados: 2,
        media: 7.75,
      });
    }
    console.log(`✅ Trabalhos criados\n`);
    
    // 10. Certificados com PDF
    console.log('📝 Criando certificados com PDF...');
    const crypto = require('crypto');
    const certificadoService = require('../services/certificadoService');
    
    // Certificado de Participação
    for (const participant of participants.slice(0, 1)) {
      const existe = await Certificado.findOne({ participante: participant._id, simposio: simposio._id, tipo: 'PARTICIPACAO' });
      if (!existe) {
        const hash = crypto.randomBytes(32).toString('hex');
        const pdfPath = await certificadoService.gerarCertificadoPDF({
          tipo: 'PARTICIPACAO',
          participante: { nome: participant.nome },
          simposio: { ano: simposio.ano },
          hashValidacao: hash,
        });
        
        await Certificado.create({
          tipo: 'PARTICIPACAO',
          participante: participant._id,
          simposio: simposio._id,
          pdfPath,
          hashValidacao: hash,
          status: 'ATIVO',
        });
        console.log(`   ✅ Certificado de Participação gerado: ${pdfPath}`);
      }
    }
    
    // Certificado de Avaliador
    const certAvaliadorExiste = await Certificado.findOne({ 
      participante: participants[0]._id, 
      simposio: simposio._id, 
      tipo: 'AVALIADOR' 
    });
    
    if (!certAvaliadorExiste) {
      const hash = crypto.randomBytes(32).toString('hex');
      const pdfPath = await certificadoService.gerarCertificadoPDF({
        tipo: 'AVALIADOR',
        participante: { nome: participants[0].nome },
        simposio: { ano: simposio.ano },
        hashValidacao: hash,
      });
      
      await Certificado.create({
        tipo: 'AVALIADOR',
        participante: participants[0]._id,
        simposio: simposio._id,
        pdfPath,
        hashValidacao: hash,
        status: 'ATIVO',
      });
      console.log(`   ✅ Certificado de Avaliador gerado: ${pdfPath}`);
    }
    
    console.log(`✅ Certificados criados com PDF\n`);
    
    // Resumo
    console.log('\n📊 RESUMO DO SEED:');
    console.log(`   Usuários: ${await User.countDocuments()}`);
    console.log(`   Participantes: ${await Participant.countDocuments()}`);
    console.log(`   Simpósios: ${await Simposio.countDocuments()}`);
    console.log(`   Inscrições: ${await InscricaoSimposio.countDocuments()}`);
    console.log(`   Grandes Áreas: ${await GrandeArea.countDocuments()}`);
    console.log(`   Subeventos: ${await Subevento.countDocuments()}`);
    console.log(`   Trabalhos: ${await Trabalho.countDocuments()}`);
    console.log(`   Certificados: ${await Certificado.countDocuments()}`);
    console.log('\n✅ Seed concluído com sucesso!\n');
    
    // Contas de teste
    console.log('🔑 CONTAS DE TESTE:');
    console.log('   Admin: admin@gov.br / Admin!234');
    console.log('   SubAdmin: subadmin@gov.br / SubAdmin!234');
    console.log('   Avaliador1: avaliador1@gov.br / Avaliador!234');
    console.log('   Mesário: mesario@gov.br / Mesario!234');
    console.log('   Participante1: participante1@gov.br / Participante!234\n');
    
    process.exit(0);
  } catch (error) {
    console.error('❌ Erro no seed:', error);
    process.exit(1);
  }
};

// Executar seed
runSeed();
