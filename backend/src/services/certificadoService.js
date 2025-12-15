const PDFDocument = require('pdfkit');
const QRCode = require('qrcode');
const fs = require('fs');
const path = require('path');
const { v4: uuidv4 } = require('uuid');

/**
 * Serviço para geração de certificados em PDF com QR Code e design personalizado
 */
class CertificadoService {
  constructor() {
    this.uploadsPath = path.join(__dirname, '../../uploads/certificados');
    this.imagensPath = path.join(__dirname, '../../uploads/certificados/imagens');
    this.ensureDirectoryExists();
  }

  ensureDirectoryExists() {
    if (!fs.existsSync(this.uploadsPath)) {
      fs.mkdirSync(this.uploadsPath, { recursive: true });
    }
    if (!fs.existsSync(this.imagensPath)) {
      fs.mkdirSync(this.imagensPath, { recursive: true });
    }
  }

  /**
   * Verifica se arquivo de imagem existe
   */
  getImagePath(filename) {
    if (!filename) return null;
    const fullPath = path.join(this.imagensPath, filename);
    return fs.existsSync(fullPath) ? fullPath : null;
  }

  /**
   * Gera certificado em PDF com design customizado
   */
  async gerarCertificadoPDF(data) {
    const { 
      tipo, 
      participante, 
      simposio, 
      trabalho, 
      subevento, 
      hashValidacao,
      configuracoes = {}
    } = data;
    
    const fileName = `${uuidv4()}.pdf`;
    const filePath = path.join(this.uploadsPath, fileName);
    
    // Cria documento PDF em paisagem (A4)
    const doc = new PDFDocument({
      size: 'A4',
      layout: 'landscape',
      margins: { top: 40, bottom: 40, left: 50, right: 50 }
    });

    const stream = fs.createWriteStream(filePath);
    doc.pipe(stream);

    const pageWidth = doc.page.width;
    const pageHeight = doc.page.height;

    // ==================== BORDAS DECORATIVAS ====================
    this.desenharBordas(doc, pageWidth, pageHeight);

    // ==================== CABEÇALHO COM LOGOS ====================
    await this.desenharCabecalho(doc, pageWidth, configuracoes, simposio);

    // ==================== TÍTULO DO EVENTO ====================
    this.desenharTituloEvento(doc, pageWidth, simposio, subevento);

    // ==================== PALAVRA "CERTIFICADO" ====================
    doc.fontSize(36)
       .font('Helvetica-Bold')
       .fillColor('#000000')
       .text('Certificado', 0, 220, { 
         align: 'center',
         characterSpacing: 2
       });

    // ==================== TEXTO DE CERTIFICAÇÃO ====================
    const textoConteudo = this.gerarTextoConteudo(tipo, participante, simposio, trabalho, subevento);
    
    doc.fontSize(13)
       .font('Helvetica')
       .fillColor('#000000')
       .text(textoConteudo, 100, 280, {
         align: 'justify',
         width: pageWidth - 200,
         lineGap: 5
       });

    // ==================== DATA E LOCAL ====================
    const dataEvento = subevento?.data 
      ? new Date(subevento.data).toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric' })
      : new Date(simposio.dataInicio).toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric' });
    
    const local = simposio.local || 'Rio Pomba';
    
    doc.fontSize(12)
       .font('Helvetica')
       .text(`${local}, ${dataEvento}`, 0, pageHeight - 280, {
         align: 'center'
       });

    // ==================== ASSINATURAS ====================
    await this.desenharAssinaturas(doc, pageWidth, pageHeight, configuracoes);

    // ==================== QR CODE ====================
    await this.desenharQRCode(doc, pageWidth, pageHeight, hashValidacao);

    // Finaliza o documento
    doc.end();

    // Aguarda a escrita do arquivo
    await new Promise((resolve, reject) => {
      stream.on('finish', resolve);
      stream.on('error', reject);
    });

    return `certificados/${fileName}`;
  }

  /**
   * Desenha bordas decorativas
   */
  desenharBordas(doc, width, height) {
    // Borda externa
    doc.strokeColor('#000000').lineWidth(2);
    doc.rect(25, 25, width - 50, height - 50).stroke();

    // Borda interna
    doc.strokeColor('#000000').lineWidth(1);
    doc.rect(30, 30, width - 60, height - 60).stroke();

    // Ornamentos nos cantos
    const ornamentSize = 15;
    const margin = 20;

    doc.fontSize(ornamentSize).font('Helvetica').fillColor('#000000');
    doc.text('❦', margin, margin);
    doc.text('❦', width - margin - 15, margin);
    doc.text('❦', margin, height - margin - 15);
    doc.text('❦', width - margin - 15, height - margin - 15);

    // Linhas decorativas horizontais
    doc.strokeColor('#000000').lineWidth(1);
    const lineY = 85;
    doc.moveTo(150, lineY).lineTo(280, lineY).stroke();
    doc.moveTo(440, lineY).lineTo(570, lineY).stroke();
    doc.moveTo(660, lineY).lineTo(790, lineY).stroke();
    doc.moveTo(width - 280, lineY).lineTo(width - 150, lineY).stroke();
  }

  /**
   * Desenha cabeçalho com logos
   */
  async desenharCabecalho(doc, width, configuracoes, simposio) {
    const headerY = 50;
    const logoSize = 60;

    // Logo do IF (esquerda)
    const logoIF = this.getImagePath(configuracoes.logoIF);
    if (logoIF) {
      doc.image(logoIF, 100, headerY, { height: logoSize, fit: [logoSize * 1.5, logoSize] });
    }

    // Logo do Evento/DPPG (centro-direita)
    const logoEvento = this.getImagePath(configuracoes.logoEvento);
    if (logoEvento) {
      doc.image(logoEvento, width - 250, headerY, { height: logoSize, fit: [logoSize * 2.5, logoSize] });
    }

    // Texto do cabeçalho (centro)
    doc.fontSize(9)
       .font('Helvetica')
       .fillColor('#000000')
       .text(
         'Instituto Federal de Educação, Ciência e Tecnologia do Sudeste de Minas Gerais Campus Rio Pomba',
         0,
         headerY + 20,
         { align: 'center', width: width }
       );
  }

  /**
   * Desenha título do evento
   */
  desenharTituloEvento(doc, width, simposio, subevento) {
    const titulo = subevento?.titulo || simposio.nome || `Simpósio ${simposio.ano}`;
    
    doc.fontSize(16)
       .font('Helvetica-Bold')
       .fillColor('#000000')
       .text(titulo, 0, 150, { 
         align: 'center',
         width: width
       });
  }

  /**
   * Desenha assinaturas
   */
  async desenharAssinaturas(doc, width, height, configuracoes) {
    const assinaturaY = height - 220;
    const assinaturaWidth = 180;

    // Assinatura 1 (Instrutora/Coordenadora)
    const assinatura1 = this.getImagePath(configuracoes.assinatura1);
    if (assinatura1) {
      doc.image(assinatura1, 100, assinaturaY - 40, { 
        width: assinaturaWidth, 
        height: 30,
        fit: [assinaturaWidth, 30]
      });
    }
    
    doc.moveTo(80, assinaturaY).lineTo(80 + assinaturaWidth, assinaturaY).stroke();
    doc.fontSize(10).font('Helvetica-Bold').fillColor('#000000');
    doc.text(configuracoes.nome1 || 'Instrutora', 80, assinaturaY + 5, { 
      width: assinaturaWidth, 
      align: 'center' 
    });
    doc.fontSize(9).font('Helvetica');
    doc.text(configuracoes.cargo1 || 'Instrutora', 80, assinaturaY + 20, { 
      width: assinaturaWidth, 
      align: 'center' 
    });

    // Assinatura 2 (Orientadora)
    const assinatura2 = this.getImagePath(configuracoes.assinatura2);
    const x2 = (width / 2) - (assinaturaWidth / 2);
    if (assinatura2) {
      doc.image(assinatura2, x2, assinaturaY - 40, { 
        width: assinaturaWidth, 
        height: 30,
        fit: [assinaturaWidth, 30]
      });
    }
    
    doc.moveTo(x2, assinaturaY).lineTo(x2 + assinaturaWidth, assinaturaY).stroke();
    doc.fontSize(10).font('Helvetica-Bold');
    doc.text(configuracoes.nome2 || 'Orientadora', x2, assinaturaY + 5, { 
      width: assinaturaWidth, 
      align: 'center' 
    });
    doc.fontSize(9).font('Helvetica');
    doc.text(configuracoes.cargo2 || 'Orientadora', x2, assinaturaY + 20, { 
      width: assinaturaWidth, 
      align: 'center' 
    });

    // Assinatura 3 (Presidente)
    const assinatura3 = this.getImagePath(configuracoes.assinatura3);
    const x3 = width - 100 - assinaturaWidth;
    if (assinatura3) {
      doc.image(assinatura3, x3, assinaturaY - 40, { 
        width: assinaturaWidth, 
        height: 30,
        fit: [assinaturaWidth, 30]
      });
    }
    
    doc.moveTo(x3, assinaturaY).lineTo(x3 + assinaturaWidth, assinaturaY).stroke();
    doc.fontSize(10).font('Helvetica-Bold');
    doc.text(configuracoes.nome3 || 'Presidente', x3, assinaturaY + 5, { 
      width: assinaturaWidth, 
      align: 'center' 
    });
    doc.fontSize(9).font('Helvetica');
    doc.text(configuracoes.cargo3 || 'Presidente do CACTA', x3, assinaturaY + 20, { 
      width: assinaturaWidth, 
      align: 'center' 
    });

    // Ornamento decorativo central
    doc.fontSize(20).fillColor('#000000');
    doc.text('❧', 0, height - 90, { align: 'center', width: width });
  }

  /**
   * Desenha QR Code de validação
   */
  async desenharQRCode(doc, width, height, hashValidacao) {
    const qrCodeDataUrl = await QRCode.toDataURL(
      `${process.env.FRONTEND_URL || 'http://localhost:5173'}/validar-certificado/${hashValidacao}`,
      { 
        width: 200,
        margin: 1,
        color: {
          dark: '#000000',
          light: '#FFFFFF'
        }
      }
    );
    
    const qrBuffer = Buffer.from(qrCodeDataUrl.split(',')[1], 'base64');
    const qrSize = 80;
    doc.image(qrBuffer, 50, height - 120, { width: qrSize, height: qrSize });

    // Texto explicativo do QR Code
    doc.fontSize(7).font('Helvetica').fillColor('#000000');
    doc.text('Verifique o código de autenticidade', 45, height - 35, { 
      width: 90, 
      align: 'center' 
    });
    doc.text(`${hashValidacao.substring(0, 20)}...`, 40, height - 25, { 
      width: 100, 
      align: 'center',
      lineGap: 0
    });
    doc.fontSize(6);
    const baseUrl = (process.env.FRONTEND_URL || 'https://sistema.edu.br').replace('http://', '').replace('https://', '');
    doc.text(`em ${baseUrl}/validar-certificado`, 30, height - 15, { 
      width: 120, 
      align: 'center' 
    });
  }

  /**
   * Gera texto do conteúdo do certificado
   */
  gerarTextoConteudo(tipo, participante, simposio, trabalho, subevento) {
    const nome = participante.nome || participante.nomeCompleto;
    
    switch (tipo) {
      case 'PARTICIPACAO':
        return `Certificamos que ${nome}, participou com êxito do evento ${subevento?.titulo || simposio.nome} realizado em ${new Date(subevento?.data || simposio.dataInicio).toLocaleDateString('pt-BR')}, na cidade de Rio Pomba, contabilizando carga horária total de ${subevento?.cargaHoraria || 4} horas.`;
      
      case 'APRESENTACAO':
      case 'APRESENTACAO_TRABALHO':
        const tituloTrabalho = trabalho?.titulo || 'trabalho apresentado';
        return `Certificamos que ${nome} apresentou o trabalho intitulado "${tituloTrabalho}" no evento ${simposio.nome || `Simpósio ${simposio.ano}`}, realizado em ${new Date(simposio.dataInicio).toLocaleDateString('pt-BR')}, contabilizando carga horária total de ${trabalho?.cargaHoraria || subevento?.cargaHoraria || 4} horas.`;
      
      case 'AVALIADOR':
        return `Certificamos que ${nome} atuou como avaliador(a) no ${simposio.nome || `Simpósio ${simposio.ano}`}, realizado em ${new Date(simposio.dataInicio).toLocaleDateString('pt-BR')}, contabilizando carga horária total de ${subevento?.cargaHoraria || 8} horas.`;
      
      case 'PALESTRANTE':
        const nomeSubevento = subevento?.nome || subevento?.titulo || 'palestra';
        return `Certificamos que ${nome} ministrou a palestra "${nomeSubevento}" no ${simposio.nome || `Simpósio ${simposio.ano}`}, realizado em ${new Date(simposio.dataInicio).toLocaleDateString('pt-BR')}, contabilizando carga horária total de ${subevento?.cargaHoraria || 2} horas.`;
      
      case 'ORGANIZACAO':
        return `Certificamos que ${nome} participou da organização do ${simposio.nome || `Simpósio ${simposio.ano}`}, realizado em ${new Date(simposio.dataInicio).toLocaleDateString('pt-BR')}, contabilizando carga horária total de ${subevento?.cargaHoraria || 20} horas.`;
      
      default:
        return `Certificamos que ${nome} participou do ${simposio.nome || `Simpósio ${simposio.ano}`}, realizado em ${new Date(simposio.dataInicio).toLocaleDateString('pt-BR')}.`;
    }
  }

  /**
   * Remove certificado
   */
  async removerCertificado(caminhoArquivo) {
    try {
      const fullPath = path.join(__dirname, '../../uploads', caminhoArquivo);
      if (fs.existsSync(fullPath)) {
        fs.unlinkSync(fullPath);
        return true;
      }
      return false;
    } catch (error) {
      console.error('Erro ao remover certificado:', error);
      return false;
    }
  }
  
  async removerCertificadoPDF(pdfPath) {
    return this.removerCertificado(pdfPath);
  }
}

module.exports = new CertificadoService();
