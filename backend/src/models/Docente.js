const mongoose = require('mongoose');

/**
 * @swagger
 * components:
 *   schemas:
 *     Docente:
 *       type: object
 *       required:
 *         - nome
 *         - cpf
 *         - email
 *       properties:
 *         _id:
 *           type: string
 *         user:
 *           type: string
 *           description: Referência ao User (se tiver conta no sistema)
 *         nome:
 *           type: string
 *         cpf:
 *           type: string
 *         email:
 *           type: string
 *         telefone:
 *           type: string
 *         instituicao:
 *           type: string
 *           description: Referência à Instituição
 *         areaAtuacao:
 *           type: string
 *           description: Referência à Área de Atuação
 *         subarea:
 *           type: string
 *           description: Referência à Subárea
 *         visitante:
 *           type: boolean
 *           description: Indica se é docente visitante
 */
const docenteSchema = new mongoose.Schema({
  user: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'User',
  },
  nome: {
    type: String,
    required: true,
    trim: true,
  },
  cpf: {
    type: String,
    required: true,
    unique: true,
    trim: true,
  },
  email: {
    type: String,
    required: true,
    lowercase: true,
    trim: true,
  },
  telefone: {
    type: String,
    trim: true,
  },
  instituicao: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'Instituicao',
    required: true,
  },
  areaAtuacao: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'AreaAtuacao',
    required: true,
  },
  subarea: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'Subarea',
    required: true,
  },
  visitante: {
    type: Boolean,
    default: false,
  },
  deleted_at: {
    type: Date,
    default: null,
  },
}, {
  timestamps: true,
});

// Índices
docenteSchema.index({ cpf: 1, deleted_at: 1 });
docenteSchema.index({ email: 1, deleted_at: 1 });
docenteSchema.index({ user: 1 });
docenteSchema.index({ instituicao: 1 });
docenteSchema.index({ subarea: 1 });

// Escopo padrão: não incluir deletados
docenteSchema.pre(/^find/, function(next) {
  if (!this.getQuery().deleted_at) {
    this.where({ deleted_at: null });
  }
  next();
});

// Método para soft delete
docenteSchema.methods.softDelete = function() {
  this.deleted_at = new Date();
  return this.save();
};

const Docente = mongoose.model('Docente', docenteSchema);

module.exports = Docente;
