const mongoose = require('mongoose');

/**
 * @swagger
 * components:
 *   schemas:
 *     Participant:
 *       type: object
 *       required:
 *         - cpf
 *         - nome
 *         - email
 *       properties:
 *         _id:
 *           type: string
 *         user:
 *           type: string
 *           description: Referência ao User (opcional)
 *         cpf:
 *           type: string
 *         nome:
 *           type: string
 *         telefone:
 *           type: string
 *         email:
 *           type: string
 *         tipoParticipante:
 *           type: string
 *           enum: [DOCENTE, DISCENTE, AVALIADOR]
 */
const participantSchema = new mongoose.Schema({
  user: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'User',
  },
  cpf: {
    type: String,
    required: true,
    unique: true,
    trim: true,
  },
  nome: {
    type: String,
    required: true,
    trim: true,
  },
  telefone: {
    type: String,
    trim: true,
  },
  email: {
    type: String,
    required: true,
    lowercase: true,
    trim: true,
  },
  tipoParticipante: {
    type: String,
    enum: ['DOCENTE', 'DISCENTE', 'AVALIADOR'],
    required: true,
  },
  deleted_at: {
    type: Date,
    default: null,
  },
}, {
  timestamps: true,
});

// Índices
participantSchema.index({ cpf: 1, deleted_at: 1 });
participantSchema.index({ email: 1, deleted_at: 1 });
participantSchema.index({ user: 1 });

// Escopo padrão: não incluir deletados
participantSchema.pre(/^find/, function(next) {
  if (!this.getQuery().deleted_at) {
    this.where({ deleted_at: null });
  }
  next();
});

// Método para soft delete
participantSchema.methods.softDelete = function() {
  this.deleted_at = new Date();
  return this.save();
};

const Participant = mongoose.model('Participant', participantSchema);

module.exports = Participant;
