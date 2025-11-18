const PDFDocument = require('pdfkit');
const QRCode = require('qrcode');
const fs = require('fs');
const path = require('path');

async function testar() {
  // Gerar QR Code
  const qrCodeDataURL = await QRCode.toDataURL('http://teste.com', {
    errorCorrectionLevel: 'H',
    type: 'image/png',
    quality: 0.92,
    margin: 1,
    width: 150
  });

  const doc = new PDFDocument({
    size: 'A4',
    layout: 'landscape',
    margins: { top: 0, bottom: 0, left: 0, right: 0 },
    bufferPages: true,
    autoFirstPage: false
  });

  const filePath = path.join(__dirname, '../certificados/teste_minimo.pdf');
  const stream = fs.createWriteStream(filePath);
  doc.pipe(stream);

  let pageCount = 0;

  doc.on('pageAdded', () => {
    pageCount++;
    console.log(`📄 Página ${pageCount} adicionada`);
  });

  // Adiciona apenas UMA página
  doc.addPage();

  // Bordas
  doc.lineWidth(3);
  doc.rect(30, 30, 781, 535).stroke('#1351B4');

  // Texto
  doc.fontSize(20)
     .fillColor('#1351B4')
     .font('Helvetica-Bold')
     .text('TESTE COM QR CODE', 70, 80, { align: 'center', width: 701 });

  // QR Code
  const qrBuffer = Buffer.from(qrCodeDataURL.split(',')[1], 'base64');
  doc.image(qrBuffer, 80, 200, { width: 100, height: 100, fit: [100, 100] });

  doc.end();

  stream.on('finish', () => {
    console.log(`✅ PDF criado com ${pageCount} página(s)`);
    console.log(`📁 ${filePath}`);
  });
}

testar().catch(console.error);
