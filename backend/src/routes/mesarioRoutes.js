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
  
  gerarQRCode: async (req, res) => {
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
      
      // Gera token curto (válido por 30min)
      const token = crypto.randomBytes(16).toString('hex');
      const expiration = Date.now() + (30 * 60 * 1000);
      
      // Em produção, armazenar em cache/Redis
      const checkinUrl = `${process.env.PUBLIC_BASE_URL}/api/v1/mesario/checkin?token=${token}&subevento=${subeventoId}`;
      
      const QRCode = require('qrcode');
      const qrcode = await QRCode.toDataURL(checkinUrl);
      
      res.json({ success: true, data: { qrcode, token, expiration, checkinUrl } });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },
  
  checkin: async (req, res) => {
    try {
      const { token, subevento: subeventoId } = req.query;
      const Presenca = require('../models/Presenca');
      const Participant = require('../models/Participant');
      
      // Verifica token (simplificado - em produção usar cache)
      // ...
      
      // Busca participante pelo usuário logado
      const participant = await Participant.findOne({ user: req.user.id });
      if (!participant) {
        return res.status(404).json({ success: false, message: 'Participante não encontrado' });
      }
      
      // Verifica se já fez check-in
      let presenca = await Presenca.findOne({ participant: participant._id, subevento: subeventoId });
      
      if (presenca) {
        return res.status(409).json({ success: false, message: 'Check-in já realizado' });
      }
      
      presenca = await Presenca.create({
        participant: participant._id,
        subevento: subeventoId,
        checkins: [{ origem: 'QRCODE' }],
      });
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('CHECKIN_REALIZADO', req.user.id, { subeventoId, participantId: participant._id });
      
      res.json({ success: true, data: presenca });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
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
};

router.get('/subeventos', auth, requireRoles(['MESARIO']), mesarioController.getSubeventos);
router.post('/subeventos/:id/qrcode', auth, requireRoles(['MESARIO']), mesarioController.gerarQRCode);
router.post('/checkin', auth, mesarioController.checkin);
router.get('/subeventos/:id/presencas', auth, requireRoles(['MESARIO']), mesarioController.getPresencas);

module.exports = router;
