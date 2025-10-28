const mongoose = require('mongoose');
const crypto = require('crypto');

const passwordResetSchema = new mongoose.Schema({
  user: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'User',
    required: true,
  },
  token: {
    type: String,
    required: true,
    unique: true,
  },
  expiresAt: {
    type: Date,
    required: true,
  },
  used: {
    type: Boolean,
    default: false,
  },
}, {
  timestamps: true,
});

// Índice para expiração automática
passwordResetSchema.index({ expiresAt: 1 }, { expireAfterSeconds: 0 });

// Método estático para criar token
passwordResetSchema.statics.createToken = function(userId) {
  const token = crypto.randomBytes(32).toString('hex');
  const expiresAt = new Date(Date.now() + 3600000); // 1 hora
  
  return this.create({
    user: userId,
    token,
    expiresAt,
  });
};

const PasswordReset = mongoose.model('PasswordReset', passwordResetSchema);

module.exports = PasswordReset;
