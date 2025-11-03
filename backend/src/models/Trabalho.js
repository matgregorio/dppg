const mongoose = require('mongoose');

/**
 * @swagger
 * components:
 *   schemas:
 *     Trabalho:
 *       type: object
 *       required:
 *         - titulo
 *         - simposio
 *       properties:
 *         titulo:
 *           type: string
 *         autores:
 *           type: array
 *           items:
 *             type: object
 *         palavras_chave:
 *           type: array
 *           items:
 *             type: string
 *         arquivo:
 *           type: string
 *         status:
 *           type: string
 *           enum: [SUBMETIDO, EM_AVALIACAO, ACEITO, REJEITADO, PUBLICADO]
 */
const trabalhoSchema = new mongoose.Schema({
  titulo: {
    type: String,
    required: true,
    trim: true,
  },
  autor: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'Participant',
  },
  autores: [{
    nome: { type: String, required: true },
    cpf: { type: String },
    email: { type: String },
  }],
  palavras_chave: [String],
  arquivo: {
    type: String, // path do arquivo
  },
  grandeArea: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'GrandeArea',
  },
  areaAtuacao: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'AreaAtuacao',
  },
  subarea: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'Subarea',
  },
  status: {
    type: String,
    enum: ['SUBMETIDO', 'EM_AVALIACAO', 'ACEITO', 'REJEITADO', 'PUBLICADO'],
    default: 'SUBMETIDO',
  },
  tipoApresentacao: {
    type: String,
    enum: ['POSTER', 'ORAL', 'NAO_DEFINIDO'],
    default: 'NAO_DEFINIDO',
  },
  atribuicoes: [{
    avaliador: {
      type: mongoose.Schema.Types.ObjectId,
      ref: 'User',
    },
    enviado_em: {
      type: Date,
      default: Date.now,
    },
    revogado_em: {
      type: Date,
    },
  }],
  avaliacoes: [{
    avaliador: {
      type: mongoose.Schema.Types.ObjectId,
      ref: 'User',
    },
    // Formato novo com competências
    competencias: {
      relevancia: { type: Number, min: 0, max: 10 }, // Relevância do tema
      metodologia: { type: Number, min: 0, max: 10 }, // Metodologia adequada
      clareza: { type: Number, min: 0, max: 10 }, // Clareza na apresentação
      fundamentacao: { type: Number, min: 0, max: 10 }, // Fundamentação teórica
      contribuicao: { type: Number, min: 0, max: 10 }, // Contribuição científica
    },
    notaFinal: {
      type: Number,
      min: 0,
      max: 10,
    },
    // Formato antigo (compatibilidade)
    nota: {
      type: Number,
      min: 0,
      max: 10,
    },
    parecer: {
      type: String,
    },
    data: {
      type: Date,
      default: Date.now,
    },
  }],
  media: {
    type: Number,
    default: null,
  },
  notaExterna: {
    type: Number,
    min: 0,
    max: 10,
    default: null,
  },
  qtd_enviados: {
    type: Number,
    default: 0,
  },
  qtd_avaliados: {
    type: Number,
    default: 0,
  },
  simposio: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'Simposio',
    required: true,
  },
  publicado_em: {
    type: Date,
  },
  certificadoPublicacaoId: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'Certificado',
  },
  deleted_at: {
    type: Date,
    default: null,
  },
}, {
  timestamps: true,
});

// Índices
trabalhoSchema.index({ simposio: 1, deleted_at: 1 });
trabalhoSchema.index({ status: 1 });
trabalhoSchema.index({ 'atribuicoes.avaliador': 1 });

// Escopo padrão: não incluir deletados
trabalhoSchema.pre(/^find/, function(next) {
  if (!this.getQuery().deleted_at) {
    this.where({ deleted_at: null });
  }
  next();
});

// Método para soft delete
trabalhoSchema.methods.softDelete = function() {
  this.deleted_at = new Date();
  return this.save();
};

const Trabalho = mongoose.model('Trabalho', trabalhoSchema);

module.exports = Trabalho;
