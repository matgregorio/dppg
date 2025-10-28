const mongoose = require('mongoose');

/**
 * @swagger
 * components:
 *   schemas:
 *     GrandeArea:
 *       type: object
 *       required:
 *         - nome
 *       properties:
 *         nome:
 *           type: string
 */
const grandeAreaSchema = new mongoose.Schema({
  nome: {
    type: String,
    required: true,
    unique: true,
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
grandeAreaSchema.index({ nome: 1, deleted_at: 1 });

// Escopo padrão: não incluir deletados
grandeAreaSchema.pre(/^find/, function(next) {
  if (!this.getQuery().deleted_at) {
    this.where({ deleted_at: null });
  }
  next();
});

// Método para soft delete
grandeAreaSchema.methods.softDelete = function() {
  this.deleted_at = new Date();
  return this.save();
};

const GrandeArea = mongoose.model('GrandeArea', grandeAreaSchema);

module.exports = GrandeArea;
