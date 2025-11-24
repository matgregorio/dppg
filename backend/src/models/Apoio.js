const mongoose = require('mongoose');

/**
 * @swagger
 * components:
 *   schemas:
 *     Apoio:
 *       type: object
 *       required:
 *         - nome
 *       properties:
 *         _id:
 *           type: string
 *         nome:
 *           type: string
 *         sigla:
 *           type: string
 *         tipo:
 *           type: string
 *           enum: [FINANCEIRO, INSTITUCIONAL, LOGISTICO, OUTRO]
 */
const apoioSchema = new mongoose.Schema({
  nome: {
    type: String,
    required: true,
    trim: true,
  },
  sigla: {
    type: String,
    trim: true,
    uppercase: true,
  },
  tipo: {
    type: String,
    enum: ['FINANCEIRO', 'INSTITUCIONAL', 'LOGISTICO', 'OUTRO'],
    default: 'FINANCEIRO',
  },
  deleted_at: {
    type: Date,
    default: null,
  },
}, {
  timestamps: true,
});

// Índices
apoioSchema.index({ nome: 1, deleted_at: 1 });

// Escopo padrão: não incluir deletados
apoioSchema.pre(/^find/, function(next) {
  if (!this.getQuery().deleted_at) {
    this.where({ deleted_at: null });
  }
  next();
});

// Método para soft delete
apoioSchema.methods.softDelete = function() {
  this.deleted_at = new Date();
  return this.save();
};

const Apoio = mongoose.model('Apoio', apoioSchema);

module.exports = Apoio;
