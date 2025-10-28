const mongoose = require('mongoose');

/**
 * @swagger
 * components:
 *   schemas:
 *     InscricaoSimposio:
 *       type: object
 *       required:
 *         - participant
 *         - simposio
 *       properties:
 *         participant:
 *           type: string
 *         simposio:
 *           type: string
 *         status:
 *           type: string
 *           enum: [ATIVA, CANCELADA]
 *         dataInscricao:
 *           type: string
 *           format: date-time
 */
const inscricaoSimposioSchema = new mongoose.Schema({
  participant: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'Participant',
    required: true,
  },
  simposio: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'Simposio',
    required: true,
  },
  status: {
    type: String,
    enum: ['ATIVA', 'CANCELADA'],
    default: 'ATIVA',
  },
  dataInscricao: {
    type: Date,
    default: Date.now,
  },
  deleted_at: {
    type: Date,
    default: null,
  },
}, {
  timestamps: true,
});

// Índice único composto para evitar duplicatas
inscricaoSimposioSchema.index(
  { participant: 1, simposio: 1, deleted_at: 1 },
  { unique: true }
);

// Escopo padrão: não incluir deletados
inscricaoSimposioSchema.pre(/^find/, function(next) {
  if (!this.getQuery().deleted_at) {
    this.where({ deleted_at: null });
  }
  next();
});

// Método para soft delete
inscricaoSimposioSchema.methods.softDelete = function() {
  this.deleted_at = new Date();
  return this.save();
};

const InscricaoSimposio = mongoose.model('InscricaoSimposio', inscricaoSimposioSchema);

module.exports = InscricaoSimposio;
