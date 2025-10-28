const mongoose = require('mongoose');

/**
 * @swagger
 * components:
 *   schemas:
 *     Acervo:
 *       type: object
 *       required:
 *         - titulo
 *         - anoEvento
 *       properties:
 *         titulo:
 *           type: string
 *         anoEvento:
 *           type: number
 *         autores:
 *           type: array
 *           items:
 *             type: string
 *         arquivo:
 *           type: string
 *         palavras_chave:
 *           type: array
 *           items:
 *             type: string
 */
const acervoSchema = new mongoose.Schema({
  titulo: {
    type: String,
    required: true,
    trim: true,
  },
  anoEvento: {
    type: Number,
    required: true,
  },
  autores: [String],
  arquivo: {
    type: String, // path do arquivo
  },
  palavras_chave: [String],
  deleted_at: {
    type: Date,
    default: null,
  },
}, {
  timestamps: true,
});

// Índices
acervoSchema.index({ anoEvento: 1, deleted_at: 1 });
acervoSchema.index(
  { titulo: 1, anoEvento: 1, deleted_at: 1 },
  { unique: true }
);

// Escopo padrão: não incluir deletados
acervoSchema.pre(/^find/, function(next) {
  if (!this.getQuery().deleted_at) {
    this.where({ deleted_at: null });
  }
  next();
});

// Método para soft delete
acervoSchema.methods.softDelete = function() {
  this.deleted_at = new Date();
  return this.save();
};

const Acervo = mongoose.model('Acervo', acervoSchema);

module.exports = Acervo;
