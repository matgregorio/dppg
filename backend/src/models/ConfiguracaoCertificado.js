const mongoose = require('mongoose');

/**
 * Modelo para configurações de certificados
 * Armazena as imagens das assinaturas e logos para geração dos certificados
 */
const configuracaoCertificadoSchema = new mongoose.Schema({
  simposio: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'Simposio',
    required: true,
    unique: true,
  },
  
  // Logos
  logoIF: {
    type: String, // Nome do arquivo
    default: null,
  },
  logoEvento: {
    type: String, // Nome do arquivo
    default: null,
  },
  logoDPPG: {
    type: String, // Nome do arquivo (opcional, extra)
    default: null,
  },
  
  // Assinatura 1 (Ex: Instrutora/Coordenadora)
  assinatura1: {
    type: String, // Nome do arquivo da imagem da assinatura
    default: null,
  },
  nome1: {
    type: String,
    default: 'Instrutora',
  },
  cargo1: {
    type: String,
    default: 'Instrutora',
  },
  
  // Assinatura 2 (Ex: Orientadora)
  assinatura2: {
    type: String,
    default: null,
  },
  nome2: {
    type: String,
    default: 'Orientadora',
  },
  cargo2: {
    type: String,
    default: 'Orientadora',
  },
  
  // Assinatura 3 (Ex: Presidente)
  assinatura3: {
    type: String,
    default: null,
  },
  nome3: {
    type: String,
    default: 'Presidente',
  },
  cargo3: {
    type: String,
    default: 'Presidente do CACTA',
  },
}, {
  timestamps: true,
});

const ConfiguracaoCertificado = mongoose.model('ConfiguracaoCertificado', configuracaoCertificadoSchema);

module.exports = ConfiguracaoCertificado;
