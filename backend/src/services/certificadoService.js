const PDFDocument = require('pdfkit');
const QRCode = require('qrcode');
const fs = require('fs');
const path = require('path');
const { v4: uuidv4 } = require('uuid');

/**
 * Serviço para geração de certificados em PDF com QR Code
 */
class CertificadoService {
  constructor() {
    this.uploadsPath = path.join(__dirname, '../../uploads/certificados');
    this.ensureDirectoryExists();
  }

  ensureDirectoryExists() {
    if (!fs.existsSync(this.uploadsPath)) {
      fs.mkdirSync(this.uploadsPath, { recursive: true });
    }
  }

  /**
   * Gera certificado em PDF
   * @param {Object} data - Dados do certificado
   * @returns {Promise<string>} - Caminho relativo do arquivo gerado
   */
  async gerarCertificadoPDF(data) {
    const { tipo, participante, simposio, trabalho, subevento, hashValidacao } = data;
    
    // Gera nome único para o arquivo
    const fileName = `${uuidv4()}.pdf`;
    const filePath = path.join(this.uploadsPath, fileName);
    
    // Cria o documento PDF
    const doc = new PDFDocument({
      size: 'A4',
      layout: 'landscape',
      margins: { top: 50, bottom: 50, left: 50, right: 50 }
    });

    // Stream para arquivo
    const stream = fs.createWriteStream(filePath);
    doc.pipe(stream);

    // Adiciona borda decorativa
    doc.rect(30, 30, doc.page.width - 60, doc.page.height - 60).stroke();
    doc.rect(35, 35, doc.page.width - 70, doc.page.height - 70).stroke();

    // Logo/Cabeçalho
    doc.fontSize(24).font('Helvetica-Bold').fillColor('#1351b4');
    doc.text('CERTIFICADO', 0, 80, { align: 'center' });

    // Tipo de certificado
    doc.fontSize(14).font('Helvetica').fillColor('#000000');
    doc.moveDown(1.5);
    doc.text(this.getTipoTexto(tipo), { align: 'center' });

    // Nome do participante
    doc.moveDown(2);
    doc.fontSize(20).font('Helvetica-Bold');
    doc.text(participante.nome.toUpperCase(), { align: 'center', underline: true });

    // Texto principal
    doc.moveDown(1.5);
    doc.fontSize(12).font('Helvetica');
    
    const textoConteudo = this.gerarTextoConteudo(tipo, simposio, trabalho, subevento);
    doc.text(textoConteudo, 100, doc.y, {
      align: 'justify',
      width: doc.page.width - 200
    });

    // Data de emissão
    doc.moveDown(2);
    const dataEmissao = new Date().toLocaleDateString('pt-BR', {
      day: '2-digit',
      month: 'long',
      year: 'numeric'
    });
    doc.text(`Emitido em: ${dataEmissao}`, { align: 'center' });

    // Assinatura (placeholder)
    doc.moveDown(3);
    doc.moveTo(doc.page.width / 2 - 150, doc.y).lineTo(doc.page.width / 2 + 150, doc.y).stroke();
    doc.moveDown(0.5);
    doc.fontSize(10);
    doc.text('Coordenação do Evento', { align: 'center' });

    // QR Code no rodapé
    const qrCodeDataUrl = await QRCode.toDataURL(
      `${process.env.PUBLIC_BASE_URL}/validar-certificado?hash=${hashValidacao}`,
      { width: 100 }
    );
    
    const qrBuffer = Buffer.from(qrCodeDataUrl.split(',')[1], 'base64');
    doc.image(qrBuffer, doc.page.width - 150, doc.page.height - 150, { width: 100 });

    // Hash de validação
    doc.fontSize(8).fillColor('#666666');
    doc.text(`Código de validação: ${hashValidacao}`, 50, doc.page.height - 70, {
      width: doc.page.width - 200,
      align: 'center'
    });

    doc.fontSize(7);
    doc.text(
      `Valide este certificado em: ${process.env.PUBLIC_BASE_URL}/validar-certificado`,
      50, doc.page.height - 55,
      { width: doc.page.width - 200, align: 'center' }
    );

    // Finaliza o PDF
    doc.end();

    // Aguarda o stream terminar
    await new Promise((resolve, reject) => {
      stream.on('finish', resolve);
      stream.on('error', reject);
    });

    // Retorna caminho relativo
    return `certificados/${fileName}`;
  }

  getTipoTexto(tipo) {
    const tipos = {
      PARTICIPACAO: 'Certificado de Participação',
      APRESENTACAO_TRABALHO: 'Certificado de Apresentação de Trabalho',
      AVALIADOR: 'Certificado de Avaliador',
      PALESTRANTE: 'Certificado de Palestrante',
      ORGANIZACAO: 'Certificado de Organização',
    };
    return tipos[tipo] || 'Certificado';
  }

  gerarTextoConteudo(tipo, simposio, trabalho, subevento) {
    const anoSimposio = simposio?.ano || new Date().getFullYear();
    
    switch (tipo) {
      case 'PARTICIPACAO':
        return `Certificamos que participou do Simpósio Anual ${anoSimposio}, realizado pela Diretoria de Pesquisa e Pós-Graduação, contribuindo para o desenvolvimento científico e tecnológico.`;
      
      case 'APRESENTACAO_TRABALHO':
        const tituloTrabalho = trabalho?.titulo || 'trabalho científico';
        return `Certificamos que apresentou o trabalho intitulado "${tituloTrabalho}" no Simpósio Anual ${anoSimposio}, demonstrando compromisso com a produção científica e a disseminação do conhecimento.`;
      
      case 'AVALIADOR':
        return `Certificamos que atuou como avaliador(a) no Simpósio Anual ${anoSimposio}, contribuindo com expertise técnica e científica para a avaliação dos trabalhos submetidos, garantindo a qualidade e rigor acadêmico do evento.`;
      
      case 'PALESTRANTE':
        const nomeSubevento = subevento?.nome || 'palestra';
        return `Certificamos que ministrou a palestra "${nomeSubevento}" no Simpósio Anual ${anoSimposio}, compartilhando conhecimentos e experiências com a comunidade acadêmica.`;
      
      case 'ORGANIZACAO':
        return `Certificamos que integrou a comissão organizadora do Simpósio Anual ${anoSimposio}, contribuindo significativamente para o sucesso do evento através de sua dedicação e trabalho.`;
      
      default:
        return `Certificamos a participação no Simpósio Anual ${anoSimposio}.`;
    }
  }

  /**
   * Remove um certificado (arquivo físico)
   * @param {string} pdfPath - Caminho relativo do PDF
   */
  async removerCertificadoPDF(pdfPath) {
    if (!pdfPath) return;
    
    const fullPath = path.join(__dirname, '../../uploads', pdfPath);
    
    if (fs.existsSync(fullPath)) {
      fs.unlinkSync(fullPath);
    }
  }
}

module.exports = new CertificadoService();
