const mongoose = require('mongoose');

/**
 * @swagger
 * components:
 *   schemas:
 *     Avaliador:
 *       type: object
 *       properties:
 *         user:
 *           type: string
 *         externo:
 *           type: object
 *         areasPreferencia:
 *           type: array
 *           items:
 *             type: string
 *         ativo:
 *           type: boolean
 */
const avaliadorSchema = new mongoose.Schema({
  user: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'User',
  },
  externo: {
    nome: { type: String },
    email: { type: String },
  },
  areasPreferencia: [{
    type: mongoose.Schema.Types.ObjectId,
    ref: 'GrandeArea',
  }],
  ativo: {
    type: Boolean,
    default: true,
  },
  deleted_at: {
    type: Date,
    default: null,
  },
}, {
  timestamps: true,
});

// Índices
avaliadorSchema.index({ user: 1, deleted_at: 1 });
avaliadorSchema.index({ 'externo.email': 1, deleted_at: 1 });

// Escopo padrão: não incluir deletados
avaliadorSchema.pre(/^find/, function(next) {
  if (!this.getQuery().deleted_at) {
    this.where({ deleted_at: null });
  }
  next();
});

// Método para soft delete
avaliadorSchema.methods.softDelete = function() {
  this.deleted_at = new Date();
  return this.save();
};

const Avaliador = mongoose.model('Avaliador', avaliadorSchema);

module.exports = Avaliador;
