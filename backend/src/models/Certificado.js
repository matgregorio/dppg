const mongoose = require('mongoose');

/**
 * @swagger
 * components:
 *   schemas:
 *     Certificado:
 *       type: object
 *       required:
 *         - tipo
 *         - participante
 *         - simposio
 *       properties:
 *         tipo:
 *           type: string
 *           enum: [PARTICIPACAO, APRESENTACAO_TRABALHO, AVALIADOR, PALESTRANTE, ORGANIZACAO]
 *         participante:
 *           type: string
 *         trabalho:
 *           type: string
 *         subevento:
 *           type: string
 *         simposio:
 *           type: string
 *         pdfPath:
 *           type: string
 *         hashValidacao:
 *           type: string
 *         status:
 *           type: string
 *           enum: [ATIVO, REVOGADO]
 */
const certificadoSchema = new mongoose.Schema({
  tipo: {
    type: String,
    enum: [
      'PARTICIPACAO',
      'APRESENTACAO_TRABALHO',
      'AVALIADOR',
      'PALESTRANTE',
      'ORGANIZACAO',
    ],
    required: true,
  },
  participante: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'Participant',
    required: true,
  },
  trabalho: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'Trabalho',
  },
  subevento: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'Subevento',
  },
  simposio: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'Simposio',
    required: true,
  },
  pdfPath: {
    type: String,
  },
  hashValidacao: {
    type: String,
    unique: true,
    required: true,
  },
  gerado_em: {
    type: Date,
    default: Date.now,
  },
  status: {
    type: String,
    enum: ['ATIVO', 'REVOGADO'],
    default: 'ATIVO',
  },
  deleted_at: {
    type: Date,
    default: null,
  },
}, {
  timestamps: true,
});

// Índices
certificadoSchema.index({ hashValidacao: 1 });
certificadoSchema.index({ participante: 1, simposio: 1 });
certificadoSchema.index({ status: 1, deleted_at: 1 });

// Escopo padrão: não incluir deletados
certificadoSchema.pre(/^find/, function(next) {
  if (!this.getQuery().deleted_at) {
    this.where({ deleted_at: null });
  }
  next();
});

// Método para soft delete
certificadoSchema.methods.softDelete = function() {
  this.deleted_at = new Date();
  return this.save();
};

const Certificado = mongoose.model('Certificado', certificadoSchema);

module.exports = Certificado;
