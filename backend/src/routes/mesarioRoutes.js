const express = require('express');
const router = express.Router();
const auth = require('../middlewares/auth');
const requireRoles = require('../middlewares/requireRoles');
const crypto = require('crypto');
const os = require('os');

// Função para obter o IP local da máquina
const getLocalIP = () => {
  const interfaces = os.networkInterfaces();
  for (const name of Object.keys(interfaces)) {
    for (const iface of interfaces[name]) {
      // Pula endereços internos (loopback) e não IPv4
      if (iface.family === 'IPv4' && !iface.internal) {
        return iface.address;
      }
    }
  }
  return '0.0.0.0'; // fallback
};

const mesarioController = {
  getSubeventos: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      const Simposio = require('../models/Simposio');
      const Participant = require('../models/Participant');
      
      const ano = req.query.ano || process.env.DEFAULT_SIMPOSIO_ANO;
      const simposio = await Simposio.findOne({ ano: parseInt(ano) });
      
      if (!simposio) {
        return res.status(404).json({ success: false, message: 'Simpósio não encontrado' });
      }
      
      // Busca o participante associado ao usuário logado
      const participant = await Participant.findOne({ user: req.user.id });
      
      if (!participant) {
        return res.status(404).json({ success: false, message: 'Participante não encontrado' });
      }
      
      // Busca subeventos onde o participante é responsável
      const subeventos = await Subevento.find({
        simposio: simposio._id,
        responsaveisMesarios: participant._id,
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
      // Usa FRONTEND_URL se configurado, senão detecta o IP local
      let frontendUrl = process.env.FRONTEND_URL;
      
      if (!frontendUrl) {
        // Detecta o IP local da máquina automaticamente
        const localIP = getLocalIP();
        const protocol = 'http'; // Em desenvolvimento
        const port = '5173'; // Porta padrão do Vite
        
        frontendUrl = `${protocol}://${localIP}:${port}`;
        
        console.log('Frontend URL detectada automaticamente:', frontendUrl);
      }
      
      const checkinUrl = `${frontendUrl}/checkin?token=${tokenRaw}`;
      
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
        // Verifica se há vagas disponíveis
        const inscritosConfirmados = subevento.inscritos.filter(i => i.status === 'CONFIRMADO').length;
        const vagasDisponiveis = subevento.vagas ? (subevento.vagas - inscritosConfirmados) : null;
        
        return res.status(403).json({ 
          success: false,
          code: 'NOT_ENROLLED',
          message: `Você não está inscrito no subevento "${subevento.titulo || subevento.evento}".`,
          data: {
            subevento: {
              _id: subevento._id,
              titulo: subevento.titulo,
              evento: subevento.evento,
              vagas: subevento.vagas,
              vagasDisponiveis: vagasDisponiveis,
              temVagas: !subevento.vagas || vagasDisponiveis > 0
            }
          }
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
          data: new Date()
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
      const Participant = require('../models/Participant');
      
      const presencas = await Presenca.find({ subevento: req.params.id })
        .populate({
          path: 'participant',
          select: 'nome cpf email'
        })
        .sort({ 'checkins.0.data': -1 }); // Ordena pelos mais recentes
      
      res.json({ success: true, data: presencas });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },

  getInscritosComPresenca: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      const Presenca = require('../models/Presenca');
      const Participant = require('../models/Participant');
      const subeventoId = req.params.id;
      
      // Busca o subevento com os inscritos
      const subevento = await Subevento.findById(subeventoId)
        .populate({
          path: 'inscritos.participant',
          select: 'nome cpf email'
        });
      
      if (!subevento) {
        return res.status(404).json({ success: false, message: 'Subevento não encontrado' });
      }
      
      // Verifica se é responsável
      if (!subevento.responsaveisMesarios.some(r => r.toString() === req.user.id)) {
        return res.status(403).json({ success: false, message: 'Você não é responsável por este subevento' });
      }
      
      // Busca todas as presenças deste subevento
      const presencas = await Presenca.find({ subevento: subeventoId });
      
      // Cria um mapa de presenças por participante
      const presencaMap = {};
      presencas.forEach(p => {
        presencaMap[p.participant.toString()] = p;
      });
      
      // Monta a lista de inscritos com status de presença
      const inscritosComPresenca = subevento.inscritos
        .filter(inscrito => inscrito.status === 'CONFIRMADO')
        .map(inscrito => {
          const participantId = inscrito.participant._id.toString();
          const presenca = presencaMap[participantId];
          
          return {
            participant: inscrito.participant,
            inscricaoStatus: inscrito.status,
            presenca: presenca ? {
              _id: presenca._id,
              checkins: presenca.checkins,
              ultimoCheckin: presenca.checkins[presenca.checkins.length - 1]
            } : null
          };
        })
        .sort((a, b) => {
          // Ordena: com presença primeiro, depois por nome
          if (a.presenca && !b.presenca) return -1;
          if (!a.presenca && b.presenca) return 1;
          return (a.participant.nome || '').localeCompare(b.participant.nome || '');
        });
      
      res.json({ success: true, data: inscritosComPresenca });
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
        checkins: [{ 
          origem: 'MANUAL',
          data: new Date(),
          confirmadoPor: req.user.id
        }],
      });

      const { logAudit } = require('../utils/auditLogger');
      logAudit('PRESENCA_MANUAL', req.user.id, { subeventoId, participantId, mesarioId: req.user.id });

      res.json({ success: true, data: presenca, message: 'Presença confirmada com sucesso' });
    } catch (error) {
      res.status(500).json({ success: false, message: error.message });
    }
  },

  inscreverNoSubevento: async (req, res) => {
    try {
      const Subevento = require('../models/Subevento');
      const Participant = require('../models/Participant');
      const InscricaoSimposio = require('../models/InscricaoSimposio');
      const User = require('../models/User');
      const subeventoId = req.params.id;
      
      // Busca o subevento
      const subevento = await Subevento.findById(subeventoId);
      if (!subevento) {
        return res.status(404).json({ success: false, message: 'Subevento não encontrado' });
      }
      
      // Busca participante pelo usuário logado
      let participant = await Participant.findOne({ user: req.user.id });
      
      // Se não existir, cria automaticamente a partir dos dados do User
      if (!participant) {
        const user = await User.findById(req.user.id);
        if (!user) {
          return res.status(404).json({ success: false, message: 'Usuário não encontrado' });
        }
        
        participant = await Participant.create({
          user: user._id,
          cpf: user.cpf,
          nome: user.nome,
          email: user.email,
          telefone: user.telefone || '',
          tipoParticipante: 'DOCENTE'
        });
        
        const { logAudit } = require('../utils/auditLogger');
        logAudit('PARTICIPANT_AUTO_CREATED', req.user.id, { 
          participantId: participant._id,
          reason: 'INSCRICAO_SUBEVENTO'
        });
      }
      
      // Verifica se o usuário é mesário responsável por este subevento
      const isMesarioResponsavel = subevento.responsaveisMesarios.some(
        mesarioId => mesarioId.toString() === req.user.id
      );
      
      if (isMesarioResponsavel) {
        return res.status(403).json({ 
          success: false, 
          message: 'Você é mesário responsável por este subevento e não pode se inscrever como participante.'
        });
      }
      
      // Verifica se está inscrito no simpósio
      const inscricao = await InscricaoSimposio.findOne({
        participant: participant._id,
        simposio: subevento.simposio,
        status: 'ATIVA'
      });
      
      if (!inscricao) {
        return res.status(403).json({ 
          success: false, 
          message: 'Você precisa estar inscrito no Simpósio para se inscrever em subeventos.'
        });
      }
      
      // Verifica se já está inscrito
      if (subevento.isParticipantInscrito(participant._id)) {
        return res.status(409).json({ 
          success: false, 
          message: 'Você já está inscrito neste subevento.' 
        });
      }
      
      // Verifica se há vagas disponíveis
      if (subevento.vagas) {
        const inscritosConfirmados = subevento.inscritos.filter(i => i.status === 'CONFIRMADO').length;
        if (inscritosConfirmados >= subevento.vagas) {
          return res.status(400).json({ 
            success: false, 
            message: 'Este subevento não possui mais vagas disponíveis.' 
          });
        }
      }
      
      // Verifica conflito de horários
      const conflito = await Subevento.verificarConflitoHorario(
        participant._id,
        subevento.data,
        subevento.horarioInicio,
        subevento.duracao
      );
      
      if (conflito.conflito) {
        return res.status(409).json({
          success: false,
          message: `Você já está inscrito em outro subevento neste horário: ${conflito.subevento.titulo}`,
          conflito: conflito.subevento
        });
      }
      
      // Adiciona inscrição
      subevento.inscritos.push({
        participant: participant._id,
        status: 'CONFIRMADO',
        dataInscricao: new Date()
      });
      
      await subevento.save();
      
      const { logAudit } = require('../utils/auditLogger');
      logAudit('INSCRICAO_SUBEVENTO', req.user.id, { 
        subeventoId: subevento._id, 
        participantId: participant._id 
      });
      
      res.json({ 
        success: true, 
        message: 'Inscrição realizada com sucesso!',
        data: {
          subevento: {
            _id: subevento._id,
            titulo: subevento.titulo,
            evento: subevento.evento
          }
        }
      });
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
router.post('/subeventos/:id/inscrever', auth, mesarioController.inscreverNoSubevento);
router.get('/subeventos/:id/presencas', auth, requireRoles(['MESARIO']), mesarioController.getPresencas);
router.get('/subeventos/:id/inscritos-presencas', auth, requireRoles(['MESARIO']), mesarioController.getInscritosComPresenca);

module.exports = router;
