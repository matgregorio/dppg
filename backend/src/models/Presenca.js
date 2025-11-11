const mongoose = require('mongoose');

/**
 * @swagger
 * components:
 *   schemas:
 *     Presenca:
 *       type: object
 *       required:
 *         - participant
 *         - subevento
 *       properties:
 *         participant:
 *           type: string
 *         subevento:
 *           type: string
 *         checkins:
 *           type: array
 *           items:
 *             type: object
 */
const presencaSchema = new mongoose.Schema({
  participant: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'Participant',
    required: true,
  },
  subevento: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'Subevento',
    required: true,
  },
  checkins: [{
    data: {
      type: Date,
      default: Date.now,
    },
    origem: {
      type: String,
      enum: ['QRCODE', 'MANUAL'],
      default: 'QRCODE',
    },
    confirmadoPor: {
      type: mongoose.Schema.Types.ObjectId,
      ref: 'User',
    },
  }],
  deleted_at: {
    type: Date,
    default: null,
  },
}, {
  timestamps: true,
});

// Índices
presencaSchema.index({ participant: 1, subevento: 1, deleted_at: 1 }, { unique: true });
presencaSchema.index({ subevento: 1 });

// Escopo padrão: não incluir deletados
presencaSchema.pre(/^find/, function(next) {
  if (!this.getQuery().deleted_at) {
    this.where({ deleted_at: null });
  }
  next();
});

// Método para soft delete
presencaSchema.methods.softDelete = function() {
  this.deleted_at = new Date();
  return this.save();
};

const Presenca = mongoose.model('Presenca', presencaSchema);

module.exports = Presenca;
