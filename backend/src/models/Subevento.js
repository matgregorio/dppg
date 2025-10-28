const mongoose = require('mongoose');

/**
 * @swagger
 * components:
 *   schemas:
 *     Subevento:
 *       type: object
 *       required:
 *         - titulo
 *         - simposio
 *         - data
 *       properties:
 *         tipo:
 *           type: string
 *         data:
 *           type: string
 *           format: date
 *         horarioInicio:
 *           type: string
 *         duracao:
 *           type: string
 *         titulo:
 *           type: string
 */
const subeventoSchema = new mongoose.Schema({
  tipo: {
    type: String,
    trim: true,
  },
  data: {
    type: Date,
    required: true,
  },
  horarioInicio: {
    type: String, // formato HH:mm
    required: true,
  },
  duracao: {
    type: String, // formato HH:mm
    required: true,
  },
  palestrante: {
    type: String,
    trim: true,
  },
  vagas: {
    type: Number,
  },
  evento: {
    type: String,
    trim: true,
  },
  local: {
    type: String,
    trim: true,
  },
  titulo: {
    type: String,
    required: true,
    trim: true,
  },
  descricao: {
    type: String,
  },
  simposio: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'Simposio',
    required: true,
  },
  responsaveisMesarios: [{
    type: mongoose.Schema.Types.ObjectId,
    ref: 'User',
  }],
  deleted_at: {
    type: Date,
    default: null,
  },
}, {
  timestamps: true,
});

// Índices
subeventoSchema.index({ simposio: 1, deleted_at: 1 });
subeventoSchema.index({ data: 1 });
subeventoSchema.index(
  { simposio: 1, titulo: 1, data: 1, horarioInicio: 1, deleted_at: 1 },
  { unique: true }
);

// Escopo padrão: não incluir deletados
subeventoSchema.pre(/^find/, function(next) {
  if (!this.getQuery().deleted_at) {
    this.where({ deleted_at: null });
  }
  next();
});

// Método para soft delete
subeventoSchema.methods.softDelete = function() {
  this.deleted_at = new Date();
  return this.save();
};

const Subevento = mongoose.model('Subevento', subeventoSchema);

module.exports = Subevento;
