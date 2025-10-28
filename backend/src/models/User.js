const mongoose = require('mongoose');
const bcrypt = require('bcrypt');

/**
 * @swagger
 * components:
 *   schemas:
 *     User:
 *       type: object
 *       required:
 *         - email
 *         - senha
 *         - nome
 *         - cpf
 *       properties:
 *         _id:
 *           type: string
 *         email:
 *           type: string
 *           format: email
 *         nome:
 *           type: string
 *         cpf:
 *           type: string
 *         telefone:
 *           type: string
 *         roles:
 *           type: array
 *           items:
 *             type: string
 *             enum: [USER, AVALIADOR, SUBADMIN, ADMIN, MESARIO]
 *         ativo:
 *           type: boolean
 */
const userSchema = new mongoose.Schema({
  email: {
    type: String,
    required: true,
    unique: true,
    lowercase: true,
    trim: true,
  },
  senha: {
    type: String,
    required: true,
    select: false,
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
  telefone: {
    type: String,
    trim: true,
  },
  roles: [{
    type: String,
    enum: ['USER', 'AVALIADOR', 'SUBADMIN', 'ADMIN', 'MESARIO'],
    default: 'USER',
  }],
  ativo: {
    type: Boolean,
    default: true,
  },
  ultimo_login: {
    type: Date,
  },
  tentativas_login: {
    type: Number,
    default: 0,
  },
  bloqueado_ate: {
    type: Date,
  },
  deleted_at: {
    type: Date,
    default: null,
  },
}, {
  timestamps: true,
});

// Índices
userSchema.index({ email: 1, deleted_at: 1 });
userSchema.index({ cpf: 1, deleted_at: 1 });

// Escopo padrão: não incluir deletados
userSchema.pre(/^find/, function(next) {
  if (!this.getQuery().deleted_at) {
    this.where({ deleted_at: null });
  }
  next();
});

// Hash da senha antes de salvar
userSchema.pre('save', async function(next) {
  if (!this.isModified('senha')) return next();
  this.senha = await bcrypt.hash(this.senha, 12);
  next();
});

// Método para comparar senha
userSchema.methods.comparePassword = async function(candidatePassword) {
  return await bcrypt.compare(candidatePassword, this.senha);
};

// Método para soft delete
userSchema.methods.softDelete = function() {
  this.deleted_at = new Date();
  return this.save();
};

const User = mongoose.model('User', userSchema);

module.exports = User;
