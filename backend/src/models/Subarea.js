const mongoose = require('mongoose');

/**
 * @swagger
 * components:
 *   schemas:
 *     Subarea:
 *       type: object
 *       required:
 *         - nome
 *         - grandeArea
 *       properties:
 *         nome:
 *           type: string
 *         grandeArea:
 *           type: string
 */
const subareaSchema = new mongoose.Schema({
  nome: {
    type: String,
    required: true,
    trim: true,
  },
  grandeArea: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'GrandeArea',
    required: true,
  },
  deleted_at: {
    type: Date,
    default: null,
  },
}, {
  timestamps: true,
});

// Índice único composto (nome + grandeArea)
subareaSchema.index(
  { nome: 1, grandeArea: 1, deleted_at: 1 },
  { unique: true }
);

// Escopo padrão: não incluir deletados
subareaSchema.pre(/^find/, function(next) {
  if (!this.getQuery().deleted_at) {
    this.where({ deleted_at: null });
  }
  next();
});

// Método para soft delete
subareaSchema.methods.softDelete = function() {
  this.deleted_at = new Date();
  return this.save();
};

const Subarea = mongoose.model('Subarea', subareaSchema);

module.exports = Subarea;
