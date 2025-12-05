const EmailTemplate = require('../models/EmailTemplate');

// Listar todos os templates
exports.listarTemplates = async (req, res) => {
  try {
    const templates = await EmailTemplate.find().sort({ chave: 1 });
    
    res.json({
      success: true,
      data: templates,
    });
  } catch (err) {
    console.error('Erro ao listar templates:', err);
    res.status(500).json({
      success: false,
      message: 'Erro ao listar templates de email',
    });
  }
};

// Obter um template específico
exports.obterTemplate = async (req, res) => {
  try {
    const { id } = req.params;
    const template = await EmailTemplate.findById(id);
    
    if (!template) {
      return res.status(404).json({
        success: false,
        message: 'Template não encontrado',
      });
    }
    
    res.json({
      success: true,
      data: template,
    });
  } catch (err) {
    console.error('Erro ao obter template:', err);
    res.status(500).json({
      success: false,
      message: 'Erro ao obter template',
    });
  }
};

// Atualizar um template
exports.atualizarTemplate = async (req, res) => {
  try {
    const { id } = req.params;
    const { assunto, corpo, ativo } = req.body;
    
    const template = await EmailTemplate.findById(id);
    
    if (!template) {
      return res.status(404).json({
        success: false,
        message: 'Template não encontrado',
      });
    }
    
    // Atualizar apenas campos editáveis
    if (assunto !== undefined) template.assunto = assunto;
    if (corpo !== undefined) template.corpo = corpo;
    if (ativo !== undefined) template.ativo = ativo;
    
    await template.save();
    
    res.json({
      success: true,
      message: 'Template atualizado com sucesso',
      data: template,
    });
  } catch (err) {
    console.error('Erro ao atualizar template:', err);
    res.status(500).json({
      success: false,
      message: 'Erro ao atualizar template',
    });
  }
};

// Restaurar template para padrão
exports.restaurarTemplatePadrao = async (req, res) => {
  try {
    const { id } = req.params;
    
    const template = await EmailTemplate.findById(id);
    
    if (!template) {
      return res.status(404).json({
        success: false,
        message: 'Template não encontrado',
      });
    }
    
    // Buscar template padrão
    const defaults = EmailTemplate.getDefaults();
    const defaultTemplate = defaults.find(t => t.chave === template.chave);
    
    if (!defaultTemplate) {
      return res.status(404).json({
        success: false,
        message: 'Template padrão não encontrado',
      });
    }
    
    template.assunto = defaultTemplate.assunto;
    template.corpo = defaultTemplate.corpo;
    template.ativo = true;
    
    await template.save();
    
    res.json({
      success: true,
      message: 'Template restaurado para o padrão',
      data: template,
    });
  } catch (err) {
    console.error('Erro ao restaurar template:', err);
    res.status(500).json({
      success: false,
      message: 'Erro ao restaurar template',
    });
  }
};

// Inicializar templates padrão (seed)
exports.inicializarTemplates = async (req, res) => {
  try {
    const defaults = EmailTemplate.getDefaults();
    
    for (const templateData of defaults) {
      const exists = await EmailTemplate.findOne({ chave: templateData.chave });
      
      if (!exists) {
        await EmailTemplate.create(templateData);
      }
    }
    
    res.json({
      success: true,
      message: 'Templates inicializados com sucesso',
    });
  } catch (err) {
    console.error('Erro ao inicializar templates:', err);
    res.status(500).json({
      success: false,
      message: 'Erro ao inicializar templates',
    });
  }
};

// Testar envio de email com template
exports.testarTemplate = async (req, res) => {
  try {
    const { id } = req.params;
    const { emailDestino } = req.body;
    
    if (!emailDestino) {
      return res.status(400).json({
        success: false,
        message: 'Email de destino é obrigatório',
      });
    }
    
    const template = await EmailTemplate.findById(id);
    
    if (!template) {
      return res.status(404).json({
        success: false,
        message: 'Template não encontrado',
      });
    }
    
    const emailService = require('../services/emailService');
    
    // Dados de exemplo para teste
    const dadosExemplo = {
      usuario_nome: 'Nome de Exemplo',
      usuario_email: emailDestino,
      usuario_cpf: '000.000.000-00',
      simposio_nome: 'Simpósio de Exemplo 2025',
      data_inscricao: new Date().toLocaleDateString('pt-BR'),
      url_sistema: process.env.FRONTEND_URL || 'http://localhost:5173',
      trabalho_titulo: 'Título do Trabalho de Exemplo',
      orientador_nome: 'Prof. Orientador Exemplo',
      trabalho_tipo: 'PESQUISA',
      data_submissao: new Date().toLocaleDateString('pt-BR'),
      url_trabalhos: `${process.env.FRONTEND_URL || 'http://localhost:5173'}/trabalhos`,
    };
    
    await emailService.enviarEmail(template.chave, emailDestino, dadosExemplo);
    
    res.json({
      success: true,
      message: `Email de teste enviado para ${emailDestino}`,
    });
  } catch (err) {
    console.error('Erro ao testar template:', err);
    res.status(500).json({
      success: false,
      message: 'Erro ao enviar email de teste',
    });
  }
};
