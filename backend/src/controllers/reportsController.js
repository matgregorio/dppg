const XLSX = require('xlsx');
const PDFDocument = require('pdfkit');

/**
 * Controller para geração de relatórios
 */

// Gerar relatório de trabalhos em Excel
const gerarRelatorioTrabalhosExcel = async (req, res) => {
  try {
    const Trabalho = require('../models/Trabalho');
    const { simposio, status } = req.query;
    
    const filter = {};
    if (simposio) filter.simposio = simposio;
    if (status) filter.status = status;
    
    const trabalhos = await Trabalho.find(filter)
      .populate('autor', 'nome email cpf')
      .populate('grandeArea', 'nome')
      .populate('areaAtuacao', 'nome')
      .populate('simposio', 'ano')
      .sort({ createdAt: -1 })
      .lean();
    
    // Preparar dados para Excel
    const dadosExcel = trabalhos.map(t => ({
      'ID': t._id.toString(),
      'Título': t.titulo,
      'Autor': t.autor?.nome || 'N/A',
      'Email': t.autor?.email || 'N/A',
      'CPF': t.autor?.cpf || 'N/A',
      'Grande Área': t.grandeArea?.nome || 'N/A',
      'Área de Atuação': t.areaAtuacao?.nome || 'N/A',
      'Tipo': t.tipo || 'N/A',
      'Status': t.status,
      'Nº Avaliações': t.qtd_avaliados || 0,
      'Média': t.media ? t.media.toFixed(2) : 'N/A',
      'Nota Externa': t.notaExterna ? t.notaExterna.toFixed(2) : 'N/A',
      'Simpósio': t.simposio?.ano || 'N/A',
      'Data Submissão': t.createdAt ? new Date(t.createdAt).toLocaleDateString('pt-BR') : 'N/A',
    }));
    
    // Criar workbook
    const wb = XLSX.utils.book_new();
    const ws = XLSX.utils.json_to_sheet(dadosExcel);
    
    // Ajustar largura das colunas
    const colWidths = [
      { wch: 25 }, // ID
      { wch: 50 }, // Título
      { wch: 30 }, // Autor
      { wch: 30 }, // Email
      { wch: 15 }, // CPF
      { wch: 30 }, // Grande Área
      { wch: 30 }, // Área Atuação
      { wch: 15 }, // Tipo
      { wch: 20 }, // Status
      { wch: 12 }, // Nº Avaliações
      { wch: 10 }, // Média
      { wch: 12 }, // Nota Externa
      { wch: 10 }, // Simpósio
      { wch: 15 }, // Data
    ];
    ws['!cols'] = colWidths;
    
    XLSX.utils.book_append_sheet(wb, ws, 'Trabalhos');
    
    // Gerar buffer
    const excelBuffer = XLSX.write(wb, { type: 'buffer', bookType: 'xlsx' });
    
    res.setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    res.setHeader('Content-Disposition', `attachment; filename=trabalhos_${Date.now()}.xlsx`);
    res.send(excelBuffer);
  } catch (error) {
    console.error('Erro ao gerar relatório Excel:', error);
    res.status(500).json({ success: false, message: error.message });
  }
};

// Gerar relatório de trabalhos em PDF
const gerarRelatorioTrabalhosPDF = async (req, res) => {
  try {
    const Trabalho = require('../models/Trabalho');
    const { simposio, status } = req.query;
    
    const filter = {};
    if (simposio) filter.simposio = simposio;
    if (status) filter.status = status;
    
    const trabalhos = await Trabalho.find(filter)
      .populate('autor', 'nome email')
      .populate('grandeArea', 'nome')
      .populate('simposio', 'ano')
      .sort({ createdAt: -1 })
      .limit(100) // Limitar para não sobrecarregar PDF
      .lean();
    
    // Criar documento PDF
    const doc = new PDFDocument({ margin: 50, size: 'A4' });
    
    res.setHeader('Content-Type', 'application/pdf');
    res.setHeader('Content-Disposition', `attachment; filename=trabalhos_${Date.now()}.pdf`);
    
    doc.pipe(res);
    
    // Cabeçalho
    doc.fontSize(18).text('Relatório de Trabalhos', { align: 'center' });
    doc.moveDown();
    doc.fontSize(10).text(`Gerado em: ${new Date().toLocaleDateString('pt-BR')} às ${new Date().toLocaleTimeString('pt-BR')}`, { align: 'center' });
    doc.text(`Total de registros: ${trabalhos.length}`, { align: 'center' });
    doc.moveDown(2);
    
    // Listar trabalhos
    trabalhos.forEach((t, index) => {
      if (index > 0) {
        doc.moveDown(1.5);
        doc.moveTo(50, doc.y).lineTo(550, doc.y).stroke();
        doc.moveDown(1);
      }
      
      doc.fontSize(12).text(`${index + 1}. ${t.titulo}`, { bold: true });
      doc.fontSize(10);
      doc.text(`Autor: ${t.autor?.nome || 'N/A'}`);
      doc.text(`Email: ${t.autor?.email || 'N/A'}`);
      doc.text(`Grande Área: ${t.grandeArea?.nome || 'N/A'}`);
      doc.text(`Status: ${t.status}`);
      doc.text(`Avaliações: ${t.qtd_avaliados || 0} | Média: ${t.media ? t.media.toFixed(2) : 'N/A'}`);
      doc.text(`Data: ${t.createdAt ? new Date(t.createdAt).toLocaleDateString('pt-BR') : 'N/A'}`);
      
      // Verificar se precisa de nova página
      if (doc.y > 700) {
        doc.addPage();
      }
    });
    
    // Finalizar
    doc.end();
  } catch (error) {
    console.error('Erro ao gerar relatório PDF:', error);
    if (!res.headersSent) {
      res.status(500).json({ success: false, message: error.message });
    }
  }
};

// Gerar relatório de participantes em Excel
const gerarRelatorioParticipantesExcel = async (req, res) => {
  try {
    const Participant = require('../models/Participant');
    const { simposio, tipo } = req.query;
    
    const filter = {};
    if (simposio) filter.simposio = simposio;
    if (tipo) filter.tipo = tipo;
    
    const participantes = await Participant.find(filter)
      .populate('user', 'nome email cpf')
      .populate('simposio', 'ano')
      .sort({ createdAt: -1 })
      .lean();
    
    const dadosExcel = participantes.map(p => ({
      'ID': p._id.toString(),
      'Nome': p.user?.nome || 'N/A',
      'Email': p.user?.email || 'N/A',
      'CPF': p.user?.cpf || 'N/A',
      'Tipo': p.tipo,
      'Instituição': p.instituicao || 'N/A',
      'Curso': p.curso || 'N/A',
      'Telefone': p.telefone || 'N/A',
      'Simpósio': p.simposio?.ano || 'N/A',
      'Data Cadastro': p.createdAt ? new Date(p.createdAt).toLocaleDateString('pt-BR') : 'N/A',
    }));
    
    const wb = XLSX.utils.book_new();
    const ws = XLSX.utils.json_to_sheet(dadosExcel);
    
    ws['!cols'] = [
      { wch: 25 }, { wch: 30 }, { wch: 30 }, { wch: 15 },
      { wch: 15 }, { wch: 40 }, { wch: 30 }, { wch: 15 },
      { wch: 10 }, { wch: 15 }
    ];
    
    XLSX.utils.book_append_sheet(wb, ws, 'Participantes');
    
    const excelBuffer = XLSX.write(wb, { type: 'buffer', bookType: 'xlsx' });
    
    res.setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    res.setHeader('Content-Disposition', `attachment; filename=participantes_${Date.now()}.xlsx`);
    res.send(excelBuffer);
  } catch (error) {
    console.error('Erro ao gerar relatório Excel:', error);
    res.status(500).json({ success: false, message: error.message });
  }
};

// Gerar relatório de certificados em Excel
const gerarRelatorioCertificadosExcel = async (req, res) => {
  try {
    const Certificado = require('../models/Certificado');
    const { simposio } = req.query;
    
    const filter = {};
    if (simposio) filter.simposio = simposio;
    
    const certificados = await Certificado.find(filter)
      .populate('user', 'nome email cpf')
      .populate('simposio', 'ano')
      .sort({ createdAt: -1 })
      .lean();
    
    const dadosExcel = certificados.map(c => ({
      'ID': c._id.toString(),
      'Código': c.codigo,
      'Nome': c.user?.nome || 'N/A',
      'Email': c.user?.email || 'N/A',
      'CPF': c.user?.cpf || 'N/A',
      'Tipo': c.tipo,
      'Carga Horária': c.cargaHoraria || 'N/A',
      'Simpósio': c.simposio?.ano || 'N/A',
      'Data Emissão': c.createdAt ? new Date(c.createdAt).toLocaleDateString('pt-BR') : 'N/A',
    }));
    
    const wb = XLSX.utils.book_new();
    const ws = XLSX.utils.json_to_sheet(dadosExcel);
    
    ws['!cols'] = [
      { wch: 25 }, { wch: 20 }, { wch: 30 }, { wch: 30 },
      { wch: 15 }, { wch: 30 }, { wch: 12 }, { wch: 10 }, { wch: 15 }
    ];
    
    XLSX.utils.book_append_sheet(wb, ws, 'Certificados');
    
    const excelBuffer = XLSX.write(wb, { type: 'buffer', bookType: 'xlsx' });
    
    res.setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    res.setHeader('Content-Disposition', `attachment; filename=certificados_${Date.now()}.xlsx`);
    res.send(excelBuffer);
  } catch (error) {
    console.error('Erro ao gerar relatório Excel:', error);
    res.status(500).json({ success: false, message: error.message });
  }
};

// Gerar relatório de inscrições em Excel
const gerarRelatorioInscricoesExcel = async (req, res) => {
  try {
    const InscricaoSimposio = require('../models/InscricaoSimposio');
    const { simposio } = req.query;
    
    const filter = {};
    if (simposio) filter.simposio = simposio;
    
    const inscricoes = await InscricaoSimposio.find(filter)
      .populate('user', 'nome email cpf')
      .populate('simposio', 'ano')
      .sort({ createdAt: -1 })
      .lean();
    
    const dadosExcel = inscricoes.map(i => ({
      'ID': i._id.toString(),
      'Nome': i.user?.nome || 'N/A',
      'Email': i.user?.email || 'N/A',
      'CPF': i.user?.cpf || 'N/A',
      'Tipo Inscrição': i.tipoInscricao,
      'Status Pagamento': i.statusPagamento || 'N/A',
      'Valor': i.valorPago ? `R$ ${i.valorPago.toFixed(2)}` : 'N/A',
      'Simpósio': i.simposio?.ano || 'N/A',
      'Data Inscrição': i.createdAt ? new Date(i.createdAt).toLocaleDateString('pt-BR') : 'N/A',
    }));
    
    const wb = XLSX.utils.book_new();
    const ws = XLSX.utils.json_to_sheet(dadosExcel);
    
    ws['!cols'] = [
      { wch: 25 }, { wch: 30 }, { wch: 30 }, { wch: 15 },
      { wch: 20 }, { wch: 15 }, { wch: 12 }, { wch: 10 }, { wch: 15 }
    ];
    
    XLSX.utils.book_append_sheet(wb, ws, 'Inscrições');
    
    const excelBuffer = XLSX.write(wb, { type: 'buffer', bookType: 'xlsx' });
    
    res.setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    res.setHeader('Content-Disposition', `attachment; filename=inscricoes_${Date.now()}.xlsx`);
    res.send(excelBuffer);
  } catch (error) {
    console.error('Erro ao gerar relatório Excel:', error);
    res.status(500).json({ success: false, message: error.message });
  }
};

module.exports = {
  gerarRelatorioTrabalhosExcel,
  gerarRelatorioTrabalhosPDF,
  gerarRelatorioParticipantesExcel,
  gerarRelatorioCertificadosExcel,
  gerarRelatorioInscricoesExcel,
};
