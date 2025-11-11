const express = require('express');
const router = express.Router();
const auth = require('../middlewares/auth');
const requireRoles = require('../middlewares/requireRoles');
const crypto = require('crypto');

const mesarioController = {
  getSubeventos: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      const Simposio = require('../models/Simposio');
      
      const ano = req.query.ano || process.env.DEFAULT_SIMPOSIO_ANO;
      const simposio = await Simposio.findOne({ ano: parseInt(ano) });
      
      if (!simposio) {
        return res.status(404).json({ success: false, message: 'Simpósio não encontrado' });
      }
      
      const subeventos = await Subevento.find({
        simposio: simposio._id,
        responsaveisMesarios: req.user.id,
      });
      
      res.json({ success: true, data: subeventos });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },

  getSubevento: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      const subeventoId = req.params.id;
      
      const subevento = await Subevento.findById(subeventoId);
      if (!subevento) {
        return res.status(404).json({ success: false, message: 'Subevento não encontrado' });
      }
      
      // Verifica se é responsável
      if (!subevento.responsaveisMesarios.some(r => r.toString() === req.user.id)) {
        return res.status(403).json({ success: false, message: 'Você não é responsável por este subevento' });
      }
      
      res.json({ success: true, data: subevento });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  gerarQRCode: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      const QRCodeToken = require('../models/QRCodeToken');
      const subeventoId = req.params.id;
      
      const subevento = await Subevento.findById(subeventoId);
      if (!subevento) {
        return res.status(404).json({ success: false, message: 'Subevento não encontrado' });
      }
      
      // Verifica se é responsável
      if (!subevento.responsaveisMesarios.some(r => r.toString() === req.user.id)) {
        return res.status(403).json({ success: false, message: 'Você não é responsável por este subevento' });
      }
      
      // Invalida tokens antigos deste subevento (opcional - manter apenas 1 QR ativo)
      await QRCodeToken.updateMany(
        { subevento: subeventoId, used: false },
        { $set: { used: true } }
      );
      
      // Gera token seguro usando hash
      const tokenRaw = crypto.randomBytes(32).toString('hex');
      const tokenHash = crypto.createHash('sha256').update(tokenRaw).digest('hex');
      
      // Define expiração (30 minutos)
      const expiresAt = new Date(Date.now() + (30 * 60 * 1000));
      
      // Salva token no banco
      const qrToken = await QRCodeToken.create({
        token: tokenHash,
        subevento: subeventoId,
        createdBy: req.user.id,
        expiresAt,
        maxUsage: null // Ilimitado para múltiplos participantes
      });
      
      // Gera URL do checkin apontando para o frontend
      const checkinUrl = `${process.env.FRONTEND_URL}/checkin?token=${tokenRaw}`;
      
      const QRCode = require('qrcode');
      const qrcode = await QRCode.toDataURL(checkinUrl);
      
      res.json({ 
        success: true, 
        data: { 
          qrcode, 
          expiresAt: expiresAt.toISOString(),
          validFor: '30 minutos',
          checkinUrl // Para debug - remover em produção
        } 
      });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  checkin: async (req, res) => {
    try {
      const { token } = req.query;
      const Presenca = require('../models/Presenca');
      const Participant = require('../models/Participant');
      const QRCodeToken = require('../models/QRCodeToken');
      const Subevento = require('../models/Subevento');
      
      if (!token) {
        return res.status(400).json({ success: false, message: 'Token não fornecido' });
      }
      
      // Hash do token recebido para comparar com o banco
      const tokenHash = crypto.createHash('sha256').update(token).digest('hex');
      
      // Busca token no banco
      const qrToken = await QRCodeToken.findOne({ token: tokenHash });
      
      if (!qrToken) {
        return res.status(404).json({ success: false, message: 'QR Code inválido ou expirado' });
      }
      
      // Valida se o token ainda é válido
      if (!qrToken.isValid()) {
        return res.status(410).json({ 
          success: false, 
          message: 'QR Code expirado ou limite de uso atingido',
          expiresAt: qrToken.expiresAt
        });
      }
      
      // Verifica se o subevento existe e está ativo
      const subevento = await Subevento.findById(qrToken.subevento);
      if (!subevento) {
        return res.status(404).json({ success: false, message: 'Subevento não encontrado' });
      }
      
      // Busca participante pelo usuário logado
      const participant = await Participant.findOne({ user: req.user.id });
      if (!participant) {
        return res.status(404).json({ success: false, message: 'Participante não encontrado' });
      }
      
      // Verifica se o participante está inscrito no simpósio
      const InscricaoSimposio = require('../models/InscricaoSimposio');
      const inscricao = await InscricaoSimposio.findOne({
        participant: participant._id,
        simposio: subevento.simposio,
        status: 'ATIVA'
      });
      
      if (!inscricao) {
        return res.status(403).json({ 
          success: false, 
          message: `Você não está inscrito no Simpósio. Faça sua inscrição antes de realizar o check-in em subeventos.`
        });
      }
      
      // Verifica se o participante está inscrito no subevento específico
      if (!subevento.isParticipantInscrito(participant._id)) {
        return res.status(403).json({ 
          success: false, 
          message: `Você não está inscrito no subevento "${subevento.titulo || subevento.evento}". Faça sua inscrição no subevento antes de realizar o check-in.`
        });
      }
      
      // Verifica se já fez check-in
      let presenca = await Presenca.findOne({ 
        participant: participant._id, 
        subevento: qrToken.subevento 
      });
      
      if (presenca) {
        return res.status(409).json({ 
          success: false, 
          message: 'Check-in já realizado anteriormente',
          data: presenca
        });
      }
      
      // Registra a presença
      presenca = await Presenca.create({
        participant: participant._id,
        subevento: qrToken.subevento,
        checkins: [{ 
          origem: 'QRCODE',
          timestamp: new Date(),
          ip: req.ip || req.connection.remoteAddress
        }],
      });
      
      // Incrementa contador de uso do token
      await qrToken.incrementUsage();
      
      // Log de auditoria
      const { logAudit } = require('../utils/auditLogger');
      logAudit('CHECKIN_QRCODE', req.user.id, { 
        subeventoId: qrToken.subevento, 
        participantId: participant._id,
        tokenId: qrToken._id
      });
      
      res.json({ 
        success: true, 
        message: 'Check-in realizado com sucesso!',
        data: {
          presenca,
          subevento: {
            titulo: subevento.titulo,
            evento: subevento.evento
          }
        }
      });
    } catch (error) {
      console.error('Erro no checkin:', error);
      res.status(500).json({ success: false, message: 'Erro ao processar check-in' });
    }
  },
  
  getPresencas: async (req, res) => {
    try {
      const Presenca = require('../models/Presenca');
      const presencas = await Presenca.find({ subevento: req.params.id }).populate('participant');
      res.json({ success: true, data: presencas });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },

  confirmarPresencaManual: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      const Presenca = require('../models/Presenca');
      const Participant = require('../models/Participant');
      const { participantId } = req.body;
      const subeventoId = req.params.id;

      // Verifica se o subevento existe
      const subevento = await Subevento.findById(subeventoId);
      if (!subevento) {
        return res.status(404).json({ success: false, message: 'Subevento não encontrado' });
      }

      // Verifica se é responsável
      if (!subevento.responsaveisMesarios.some(r => r.toString() === req.user.id)) {
        return res.status(403).json({ success: false, message: 'Você não é responsável por este subevento' });
      }

      // Verifica se o participante existe
      const participant = await Participant.findById(participantId);
      if (!participant) {
        return res.status(404).json({ success: false, message: 'Participante não encontrado' });
      }

      // Verifica se já tem presença
      let presenca = await Presenca.findOne({ participant: participantId, subevento: subeventoId });

      if (presenca) {
        return res.status(409).json({ success: false, message: 'Presença já confirmada para este participante' });
      }

      // Cria a presença
      presenca = await Presenca.create({
        participant: participantId,
        subevento: subeventoId,
        checkins: [{ origem: 'MANUAL' }],
      });

      const { logAudit } = require('../utils/auditLogger');
      logAudit('PRESENCA_MANUAL', req.user.id, { subeventoId, participantId, mesarioId: req.user.id });

      res.json({ success: true, data: presenca, message: 'Presença confirmada com sucesso' });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
};

router.get('/subeventos', auth, requireRoles(['MESARIO']), mesarioController.getSubeventos);
router.get('/subeventos/:id', auth, requireRoles(['MESARIO']), mesarioController.getSubevento);
router.post('/subeventos/:id/qrcode', auth, requireRoles(['MESARIO']), mesarioController.gerarQRCode);
router.post('/subeventos/:id/presenca-manual', auth, requireRoles(['MESARIO']), mesarioController.confirmarPresencaManual);
router.post('/checkin', auth, mesarioController.checkin);
router.get('/subeventos/:id/presencas', auth, requireRoles(['MESARIO']), mesarioController.getPresencas);

module.exports = router;
