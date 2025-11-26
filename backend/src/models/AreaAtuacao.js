const mongoose = require('mongoose');

/**
 * @swagger
 * components:
 *   schemas:
 *     AreaAtuacao:
 *       type: object
 *       required:
 *         - nome
 *       properties:
 *         nome:
 *           type: string
 */
const areaAtuacaoSchema = new mongoose.Schema({
  nome: {
    type: String,
    required: true,
    trim: true,
  },
  deleted_at: {
    type: Date,
    default: null,
  },
}, {
  timestamps: true,
});

// Índices
areaAtuacaoSchema.index({ nome: 1, deleted_at: 1 }, { unique: true });

// Escopo padrão: não incluir deletados
areaAtuacaoSchema.pre(/^find/, function(next) {
  if (!this.getQuery().deleted_at) {
    this.where({ deleted_at: null });
  }
  next();
});

// Método para soft delete
areaAtuacaoSchema.methods.softDelete = function() {
  this.deleted_at = new Date();
  return this.save();
};

const AreaAtuacao = mongoose.model('AreaAtuacao', areaAtuacaoSchema);

module.exports = AreaAtuacao;
