require('dotenv').config();
const mongoose = require('mongoose');
const PDFDocument = require('pdfkit');
const QRCode = require('qrcode');
const fs = require('fs');
const path = require('path');

async function gerarCertificadoExemplo() {
  try {
    await mongoose.connect(process.env.MONGO_URI);
    console.log('✅ Conectado ao MongoDB');

    const Simposio = require('./models/Simposio');
    const simposio = await Simposio.findOne({ ano: 2025 });

    if (!simposio) {
      console.log('❌ Simpósio 2025 não encontrado');
      process.exit(1);
    }

    const certificadosDir = path.join(__dirname, '../certificados');
    if (!fs.existsSync(certificadosDir)) {
      fs.mkdirSync(certificadosDir, { recursive: true });
    }

    const hash = 'CERT-EXEMPLO-' + Date.now();
    const qrUrl = `http://192.168.0.106:5173/validar-certificado/${hash}`;
    const qrCodeDataURL = await QRCode.toDataURL(qrUrl, {
      errorCorrectionLevel: 'H',
      type: 'image/png',
      quality: 0.92,
      margin: 1,
      width: 150
    });

    const fileName = `certificado_exemplo_${Date.now()}.pdf`;
    const filePath = path.join(certificadosDir, fileName);

    const doc = new PDFDocument({
      size: 'A4',
      layout: 'landscape',
      margins: { top: 0, bottom: 0, left: 0, right: 0 },
      bufferPages: true,
      autoFirstPage: false
    });

    const stream = fs.createWriteStream(filePath);
    doc.pipe(stream);

    let firstPageAdded = false;
    
    // BLOQUEAR criação de páginas adicionais
    doc.on('pageAdded', () => {
      if (firstPageAdded) {
        throw new Error('❌ BLOQUEADO: Tentativa de adicionar página extra!');
      }
      firstPageAdded = true;
    });

    // Adiciona uma única página
    doc.addPage();

    // Bordas decorativas com dimensões fixas
    doc.lineWidth(3);
    doc.rect(30, 30, 781, 535).stroke('#1351B4');  // 841-60 = 781, 595-60 = 535
    doc.lineWidth(1);
    doc.rect(35, 35, 771, 525).stroke('#1351B4');  // 841-70 = 771, 595-70 = 525

    // Cabeçalho com largura fixa
    doc.fontSize(20)
       .fillColor('#1351B4')
       .font('Helvetica-Bold')
       .text(simposio.nome || 'Simpósio de Pesquisa e Pós-Graduação', 70, 80, {
         align: 'center',
         width: 701
       });

    doc.fontSize(14)
       .fillColor('#333333')
       .font('Helvetica')
       .text(`${simposio.ano}ª Edição`, 70, 110, {
         align: 'center',
         width: 701
       });

    // Título com largura fixa
    doc.fontSize(28)
       .fillColor('#1351B4')
       .font('Helvetica-Bold')
       .text('CERTIFICADO', 70, 160, {
         align: 'center',
         width: 701
       });

    // Certificação com largura fixa
    doc.fontSize(14)
       .fillColor('#000000')
       .font('Helvetica')
       .text('Certificamos que', 70, 210, {
         align: 'center',
         width: 701
       });

    // Nome (dados fictícios)
    doc.fontSize(22)
       .fillColor('#1351B4')
       .font('Helvetica-Bold')
       .text('JOÃO DA SILVA EXEMPLO', 70, 235, {
         align: 'center',
         width: 701
       });

    // Conteúdo
    const conteudo = `Participou como APRESENTADOR(A) DE TRABALHO no ${simposio.nome}, realizado no ano de ${simposio.ano}, apresentando o trabalho científico "Aplicações de Inteligência Artificial na Educação", com carga horária de 20 horas.`;
    
    // Posição fixa para o conteúdo (centro da página)
    const conteudoY = 270;
    doc.fontSize(11)  // Reduzido de 12 para 11
       .fillColor('#000000')
       .font('Helvetica')
       .text(conteudo, 100, conteudoY, {
         align: 'justify',
         width: 641,
         lineGap: 3,
         continued: false
       });

    // QR Code à ESQUERDA (com espaço adequado após o conteúdo)
    const qrCodeY = 380;
    const qrBuffer = Buffer.from(qrCodeDataURL.split(',')[1], 'base64');
    doc.image(qrBuffer, 70, qrCodeY, { 
      width: 90, 
      height: 90,
      fit: [90, 90]
    });
    doc.fontSize(7)
       .fillColor('#666666')
       .text('Código de Validação', 70, qrCodeY + 95, { width: 90, align: 'center' });
    doc.fontSize(6)
       .text(hash, 70, qrCodeY + 105, { width: 90, align: 'center' });

    // Assinaturas LADO A LADO à DIREITA (mesma linha do QR Code)
    const assinaturaBaseY = 420;
    
    // Assinatura 1 (Coordenador) - CENTRO-ESQUERDA
    const ass1X = 280;
    doc.moveTo(ass1X, assinaturaBaseY)
       .lineTo(ass1X + 160, assinaturaBaseY)
       .stroke();
    
    doc.fontSize(9)
       .fillColor('#000000')
       .font('Helvetica-Bold')
       .text('Prof. Dr. Coordenador Exemplo', ass1X, assinaturaBaseY + 5, { width: 160, align: 'center' });
    
    doc.fontSize(8)
       .font('Helvetica')
       .text('Coordenador do Programa', ass1X, assinaturaBaseY + 18, { width: 160, align: 'center' });

    // Assinatura 2 (Diretor) - CENTRO-DIREITA
    const ass2X = 480;
    doc.moveTo(ass2X, assinaturaBaseY)
       .lineTo(ass2X + 160, assinaturaBaseY)
       .stroke();
    
    doc.fontSize(9)
       .fillColor('#000000')
       .font('Helvetica-Bold')
       .text('Prof. Dr. Diretor Exemplo', ass2X, assinaturaBaseY + 5, { width: 160, align: 'center' });
    
    doc.fontSize(8)
       .font('Helvetica')
       .text('Direção Geral', ass2X, assinaturaBaseY + 18, { width: 160, align: 'center' });

    // Rodapé com posição absoluta fixa
    const dataEmissao = new Date().toLocaleDateString('pt-BR', {
      day: '2-digit',
      month: 'long',
      year: 'numeric'
    });
    
    doc.fontSize(9)
       .fillColor('#666666')
       .font('Helvetica-Oblique')
       .text(`Emitido em ${dataEmissao}`, 50, 535, {  // POSIÇÃO ABSOLUTA FIXA
         align: 'center',
         width: 741  // LARGURA FIXA
       });

    doc.end();

    stream.on('finish', () => {
      console.log(`\n✅ Certificado de exemplo gerado com sucesso!`);
      console.log(`📁 Arquivo: ${filePath}`);
      console.log(`🔗 Código de validação: ${hash}`);
      console.log(`📱 QR Code aponta para: ${qrUrl}`);
      process.exit(0);
    });

    stream.on('error', (error) => {
      console.error('❌ Erro ao gerar PDF:', error);
      process.exit(1);
    });

  } catch (error) {
    console.error('❌ Erro:', error);
    process.exit(1);
  }
}

gerarCertificadoExemplo();
