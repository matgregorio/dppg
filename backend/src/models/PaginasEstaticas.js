const mongoose = require('mongoose');

/**
 * @swagger
 * components:
 *   schemas:
 *     PaginasEstaticas:
 *       type: object
 *       required:
 *         - slug
 *       properties:
 *         slug:
 *           type: string
 *           enum: [home, apresentacao, regulamento, corpo-editorial, expediente, normas-publicacao, programacao, modelo-poster, anais, dppg]
 *         conteudo:
 *           type: string
 *         pdf:
 *           type: string
 *         linkExterno:
 *           type: string
 */
const paginasEstaticasSchema = new mongoose.Schema({
  slug: {
    type: String,
    required: true,
    unique: true,
    enum: [
      'home',
      'apresentacao',
      'regulamento',
      'corpo-editorial',
      'expediente',
      'normas-publicacao',
      'programacao',
      'modelo-poster',
      'anais',
      'dppg',
    ],
  },
  conteudo: {
    type: String, // HTML ou markdown
  },
  pdf: {
    type: String, // path do arquivo PDF
  },
  linkExterno: {
    type: String, // URL externa
  },
  deleted_at: {
    type: Date,
    default: null,
  },
}, {
  timestamps: true,
});

// Índices
paginasEstaticasSchema.index({ slug: 1, deleted_at: 1 });

// Escopo padrão: não incluir deletados
paginasEstaticasSchema.pre(/^find/, function(next) {
  if (!this.getQuery().deleted_at) {
    this.where({ deleted_at: null });
  }
  next();
});

// Método para soft delete
paginasEstaticasSchema.methods.softDelete = function() {
  this.deleted_at = new Date();
  return this.save();
};

const PaginasEstaticas = mongoose.model('PaginasEstaticas', paginasEstaticasSchema);

module.exports = PaginasEstaticas;
