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
  inscritos: [{
    participant: {
      type: mongoose.Schema.Types.ObjectId,
      ref: 'Participant',
      required: true,
    },
    status: {
      type: String,
      enum: ['CONFIRMADO', 'CANCELADO', 'LISTA_ESPERA'],
      default: 'CONFIRMADO',
    },
    dataInscricao: {
      type: Date,
      default: Date.now,
    }
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

// Método para verificar se participante está inscrito
subeventoSchema.methods.isParticipantInscrito = function(participantId) {
  return this.inscritos.some(
    inscrito => inscrito.participant.toString() === participantId.toString() && 
                inscrito.status === 'CONFIRMADO'
  );
};

// Método estático para verificar conflito de horários
subeventoSchema.statics.verificarConflitoHorario = async function(participantId, data, horarioInicio, duracao, excludeSubeventoId = null) {
  const [horaInicio, minutoInicio] = horarioInicio.split(':').map(Number);
  const [horaDuracao, minutoDuracao] = duracao.split(':').map(Number);
  
  const inicioMinutos = horaInicio * 60 + minutoInicio;
  const fimMinutos = inicioMinutos + (horaDuracao * 60 + minutoDuracao);
  
  // Busca subeventos na mesma data onde o participante está inscrito
  const query = {
    data: data,
    deleted_at: null,
    'inscritos.participant': participantId,
    'inscritos.status': 'CONFIRMADO'
  };
  
  if (excludeSubeventoId) {
    query._id = { $ne: excludeSubeventoId };
  }
  
  const subeventosNoMesmoDia = await this.find(query);
  
  // Verifica se há conflito
  for (const subevento of subeventosNoMesmoDia) {
    const [horaOutro, minutoOutro] = subevento.horarioInicio.split(':').map(Number);
    const [horaDuracaoOutro, minutoDuracaoOutro] = subevento.duracao.split(':').map(Number);
    
    const inicioOutro = horaOutro * 60 + minutoOutro;
    const fimOutro = inicioOutro + (horaDuracaoOutro * 60 + minutoDuracaoOutro);
    
    // Verifica sobreposição de horários
    if ((inicioMinutos < fimOutro && fimMinutos > inicioOutro)) {
      return {
        conflito: true,
        subevento: subevento
      };
    }
  }
  
  return { conflito: false };
};

const Subevento = mongoose.model('Subevento', subeventoSchema);

module.exports = Subevento;
