const mongoose = require('mongoose');

const qrCodeTokenSchema = new mongoose.Schema({
  token: {
    type: String,
    required: true,
    unique: true,
    index: true
  },
  subevento: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'Subevento',
    required: true
  },
  createdBy: {
    type: mongoose.Schema.Types.ObjectId,
    ref: 'User',
    required: true
  },
  expiresAt: {
    type: Date,
    required: true,
    index: true
  },
  used: {
    type: Boolean,
    default: false
  },
  usageCount: {
    type: Number,
    default: 0
  },
  maxUsage: {
    type: Number,
    default: null // null = ilimitado
  }
}, {
  timestamps: true
});

// Índice TTL para remover tokens expirados automaticamente
qrCodeTokenSchema.index({ expiresAt: 1 }, { expireAfterSeconds: 0 });

// Método para validar token
qrCodeTokenSchema.methods.isValid = function() {
  if (this.expiresAt < new Date()) {
    return false;
  }
  if (this.maxUsage && this.usageCount >= this.maxUsage) {
    return false;
  }
  return true;
};

// Método para incrementar uso
qrCodeTokenSchema.methods.incrementUsage = async function() {
  this.usageCount += 1;
  if (this.maxUsage && this.usageCount >= this.maxUsage) {
    this.used = true;
  }
  await this.save();
};

module.exports = mongoose.model('QRCodeToken', qrCodeTokenSchema);
