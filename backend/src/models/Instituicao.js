const mongoose = require('mongoose');

/**
 * @swagger
 * components:
 *   schemas:
 *     Instituicao:
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
 *         cidade:
 *           type: string
 *         estado:
 *           type: string
 */
const instituicaoSchema = new mongoose.Schema({
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
  cidade: {
    type: String,
    trim: true,
  },
  estado: {
    type: String,
    trim: true,
    uppercase: true,
  },
  deleted_at: {
    type: Date,
    default: null,
  },
}, {
  timestamps: true,
});

// Índices
instituicaoSchema.index({ nome: 1, deleted_at: 1 });

// Escopo padrão: não incluir deletados
instituicaoSchema.pre(/^find/, function(next) {
  if (!this.getQuery().deleted_at) {
    this.where({ deleted_at: null });
  }
  next();
});

// Método para soft delete
instituicaoSchema.methods.softDelete = function() {
  this.deleted_at = new Date();
  return this.save();
};

const Instituicao = mongoose.model('Instituicao', instituicaoSchema);

module.exports = Instituicao;
