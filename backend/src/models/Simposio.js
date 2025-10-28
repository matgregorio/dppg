const mongoose = require('mongoose');

/**
 * @swagger
 * components:
 *   schemas:
 *     Simposio:
 *       type: object
 *       required:
 *         - ano
 *       properties:
 *         ano:
 *           type: number
 *         status:
 *           type: string
 *           enum: [INICIALIZADO, FINALIZADO]
 *         datasConfig:
 *           type: object
 */
const simposioSchema = new mongoose.Schema({
  ano: {
    type: Number,
    required: true,
    unique: true,
  },
  status: {
    type: String,
    enum: ['INICIALIZADO', 'FINALIZADO'],
    default: 'INICIALIZADO',
  },
  datasConfig: {
    inscricaoParticipante: {
      inicio: { type: Date, required: true },
      fim: { type: Date, required: true },
    },
    submissaoTrabalhos: {
      inicio: { type: Date, required: true },
      fim: { type: Date, required: true },
    },
    prazoAvaliacao: {
      inicio: { type: Date, required: true },
      fim: { type: Date, required: true },
    },
    notasAvaliacaoExterna: {
      inicio: { type: Date, required: true },
      fim: { type: Date, required: true },
    },
  },
  deleted_at: {
    type: Date,
    default: null,
  },
}, {
  timestamps: true,
});

// Índices
simposioSchema.index({ ano: 1, deleted_at: 1 });

// Escopo padrão: não incluir deletados
simposioSchema.pre(/^find/, function(next) {
  if (!this.getQuery().deleted_at) {
    this.where({ deleted_at: null });
  }
  next();
});

// Método para soft delete
simposioSchema.methods.softDelete = function() {
  this.deleted_at = new Date();
  return this.save();
};

const Simposio = mongoose.model('Simposio', simposioSchema);

module.exports = Simposio;
