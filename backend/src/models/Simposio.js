const mongoose = require('mongoose');

/**
 * @swagger
 * components:
 *   schemas:
 *     Simposio:
 *       type: object
 *       required:
 *         - ano
 *         - nome
 *       properties:
 *         ano:
 *           type: number
 *         nome:
 *           type: string
 *         tema:
 *           type: string
 *         descricao:
 *           type: string
 *         local:
 *           type: string
 *         status:
 *           type: string
 *           enum: [INICIALIZADO, FINALIZADO]
 *         finalizado:
 *           type: boolean
 *         dataInicio:
 *           type: string
 *           format: date
 *         dataFim:
 *           type: string
 *           format: date
 *         dataInicioSubmissoes:
 *           type: string
 *           format: date
 *         dataFimSubmissoes:
 *           type: string
 *           format: date
 *         dataInicioInscricoes:
 *           type: string
 *           format: date
 *         dataFimInscricoes:
 *           type: string
 *           format: date
 *         dataFinalizacao:
 *           type: string
 *           format: date-time
 *         datasConfig:
 *           type: object
 */
const simposioSchema = new mongoose.Schema({
  ano: {
    type: Number,
    required: true,
    unique: true,
  },
  nome: {
    type: String,
    required: [true, 'O nome do simpósio é obrigatório'],
    trim: true,
  },
  tema: {
    type: String,
    trim: true,
  },
  descricao: {
    type: String,
    trim: true,
  },
  local: {
    type: String,
    trim: true,
  },
  status: {
    type: String,
    enum: ['INICIALIZADO', 'FINALIZADO'],
    default: 'INICIALIZADO',
  },
  finalizado: {
    type: Boolean,
    default: false,
  },
  dataInicio: {
    type: Date,
  },
  dataFim: {
    type: Date,
  },
  dataInicioSubmissoes: {
    type: Date,
  },
  dataFimSubmissoes: {
    type: Date,
  },
  dataInicioInscricoes: {
    type: Date,
  },
  dataFimInscricoes: {
    type: Date,
  },
  dataFinalizacao: {
    type: Date,
  },
  datasConfig: {
    inscricaoParticipante: {
      inicio: { type: Date },
      fim: { type: Date },
    },
    submissaoTrabalhos: {
      inicio: { type: Date },
      fim: { type: Date },
    },
    prazoAvaliacao: {
      inicio: { type: Date },
      fim: { type: Date },
    },
    notasAvaliacaoExterna: {
      inicio: { type: Date },
      fim: { type: Date },
    },
  },
  deleted_at: {
    type: Date,
    default: null,
  },
}, {
  timestamps: true,
});

// Índices
simposioSchema.index({ ano: 1, deleted_at: 1 });

// Escopo padrão: não incluir deletados
simposioSchema.pre(/^find/, function(next) {
  if (!this.getQuery().deleted_at) {
    this.where({ deleted_at: null });
  }
  next();
});

// Método para soft delete
simposioSchema.methods.softDelete = function() {
  this.deleted_at = new Date();
  return this.save();
};

const Simposio = mongoose.model('Simposio', simposioSchema);

module.exports = Simposio;
