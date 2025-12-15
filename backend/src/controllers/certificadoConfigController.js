const ConfiguracaoCertificado = require('../models/ConfiguracaoCertificado');
const Certificado = require('../models/Certificado');
const Participant = require('../models/Participant');
const Simposio = require('../models/Simposio');
const Trabalho = require('../models/Trabalho');
const Subevento = require('../models/Subevento');
const certificadoService = require('../services/certificadoService');
const fs = require('fs');
const path = require('path');

/**
 * Obtém configuração de certificados para um simpósio
 */
exports.getConfiguracoes = async (req, res) => {
  try {
    const { simposioId } = req.params;

    let config = await ConfiguracaoCertificado.findOne({ simposio: simposioId });

    if (!config) {
      // Cria configuração padrão se não existir
      config = await ConfiguracaoCertificado.create({ simposio: simposioId });
    }

    res.json({
      success: true,
      data: config,
    });
  } catch (err) {
    console.error('Erro ao buscar configurações:', err);
    res.status(500).json({
      success: false,
      message: 'Erro ao buscar configurações',
      error: err.message,
    });
  }
};

/**
 * Atualiza configurações de certificado
 */
exports.atualizarConfiguracoes = async (req, res) => {
  try {
    const { simposioId } = req.params;
    const updates = req.body;

    let config = await ConfiguracaoCertificado.findOne({ simposio: simposioId });

    if (!config) {
      config = await ConfiguracaoCertificado.create({
        simposio: simposioId,
        ...updates,
      });
    } else {
      Object.assign(config, updates);
      await config.save();
    }

    res.json({
      success: true,
      message: 'Configurações atualizadas com sucesso',
      data: config,
    });
  } catch (err) {
    console.error('Erro ao atualizar configurações:', err);
    res.status(500).json({
      success: false,
      message: 'Erro ao atualizar configurações',
      error: err.message,
    });
  }
};

/**
 * Upload de imagem (logo ou assinatura)
 */
exports.uploadImagem = async (req, res) => {
  try {
    const { simposioId } = req.params;
    const { tipo } = req.body; // logoIF, logoEvento, assinatura1, assinatura2, assinatura3

    if (!req.file) {
      return res.status(400).json({
        success: false,
        message: 'Nenhum arquivo enviado',
      });
    }

    const filename = req.file.filename;

    // Atualiza configuração
    const updateData = { [tipo]: filename };
    
    let config = await ConfiguracaoCertificado.findOne({ simposio: simposioId });
    
    if (!config) {
      config = await ConfiguracaoCertificado.create({
        simposio: simposioId,
        ...updateData,
      });
    } else {
      // Remove arquivo antigo se existir
      const campoAntigo = config[tipo];
      if (campoAntigo) {
        const caminhoAntigo = path.join(__dirname, '../../uploads/certificados/imagens', campoAntigo);
        if (fs.existsSync(caminhoAntigo)) {
          fs.unlinkSync(caminhoAntigo);
        }
      }

      Object.assign(config, updateData);
      await config.save();
    }

    res.json({
      success: true,
      message: 'Imagem enviada com sucesso',
      data: {
        filename,
        tipo,
      },
    });
  } catch (err) {
    console.error('Erro ao fazer upload de imagem:', err);
    res.status(500).json({
      success: false,
      message: 'Erro ao fazer upload de imagem',
      error: err.message,
    });
  }
};

/**
 * Regenera todos os certificados de um simpósio
 */
exports.regenerarCertificados = async (req, res) => {
  try {
    const { simposioId } = req.params;

    const config = await ConfiguracaoCertificado.findOne({ simposio: simposioId });
    const simposio = await Simposio.findById(simposioId);

    if (!simposio) {
      return res.status(404).json({
        success: false,
        message: 'Simpósio não encontrado',
      });
    }

    // Busca todos os certificados deste simpósio
    const certificados = await Certificado.find({ simposio: simposioId })
      .populate('participante')
      .populate('trabalho')
      .populate('subevento');

    let regenerados = 0;
    const erros = [];

    for (const cert of certificados) {
      try {
        // Remove PDF antigo
        if (cert.pdfPath) {
          await certificadoService.removerCertificado(cert.pdfPath);
        }

        // Gera novo PDF
        const pdfPath = await certificadoService.gerarCertificadoPDF({
          tipo: cert.tipo,
          participante: cert.participante,
          simposio,
          trabalho: cert.trabalho,
          subevento: cert.subevento,
          hashValidacao: cert.hashValidacao,
          configuracoes: config?.toObject() || {},
        });

        cert.pdfPath = pdfPath;
        await cert.save();
        regenerados++;
      } catch (error) {
        console.error(`Erro ao regenerar certificado ${cert._id}:`, error);
        erros.push({
          certificadoId: cert._id,
          erro: error.message,
        });
      }
    }

    res.json({
      success: true,
      message: `${regenerados} certificados regenerados com sucesso`,
      data: {
        total: certificados.length,
        regenerados,
        erros: erros.length,
        detalhesErros: erros,
      },
    });
  } catch (err) {
    console.error('Erro ao regenerar certificados:', err);
    res.status(500).json({
      success: false,
      message: 'Erro ao regenerar certificados',
      error: err.message,
    });
  }
};

/**
 * Validação pública de certificado (rota pública)
 */
exports.validarCertificado = async (req, res) => {
  try {
    const { hash } = req.params;

    const certificado = await Certificado.findOne({ hashValidacao: hash })
      .populate('participante')
      .populate('simposio')
      .populate('trabalho')
      .populate('subevento');

    if (!certificado) {
      return res.status(404).json({
        success: false,
        message: 'Certificado não encontrado ou inválido',
      });
    }

    // Retorna informações básicas do certificado
    res.json({
      success: true,
      data: {
        valido: true,
        tipo: certificado.tipo,
        participante: {
          nome: certificado.participante?.nome || certificado.participante?.nomeCompleto,
        },
        simposio: {
          ano: certificado.simposio?.ano,
          nome: certificado.simposio?.nome,
        },
        trabalho: certificado.trabalho ? {
          titulo: certificado.trabalho.titulo,
        } : null,
        subevento: certificado.subevento ? {
          titulo: certificado.subevento.titulo,
        } : null,
        geradoEm: certificado.gerado_em || certificado.createdAt,
        hashValidacao: certificado.hashValidacao,
      },
    });
  } catch (err) {
    console.error('Erro ao validar certificado:', err);
    res.status(500).json({
      success: false,
      message: 'Erro ao validar certificado',
      error: err.message,
    });
  }
};

/**
 * Remove uma imagem de configuração
 */
exports.removerImagem = async (req, res) => {
  try {
    const { simposioId } = req.params;
    const { tipo } = req.body;

    const config = await ConfiguracaoCertificado.findOne({ simposio: simposioId });

    if (!config) {
      return res.status(404).json({
        success: false,
        message: 'Configuração não encontrada',
      });
    }

    const filename = config[tipo];
    if (filename) {
      const filePath = path.join(__dirname, '../../uploads/certificados/imagens', filename);
      if (fs.existsSync(filePath)) {
        fs.unlinkSync(filePath);
      }

      config[tipo] = null;
      await config.save();
    }

    res.json({
      success: true,
      message: 'Imagem removida com sucesso',
    });
  } catch (err) {
    console.error('Erro ao remover imagem:', err);
    res.status(500).json({
      success: false,
      message: 'Erro ao remover imagem',
      error: err.message,
    });
  }
};
