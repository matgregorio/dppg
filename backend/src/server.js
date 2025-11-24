require('dotenv').config();
const express = require('express');
const cors = require('cors');
const helmet = require('helmet');
const compression = require('compression');
const cookieParser = require('cookie-parser');
const morgan = require('morgan');
const swaggerUi = require('swagger-ui-express');
const os = require('os');

const connectDB = require('./config/database');
const logger = require('./config/logger');
const swaggerSpec = require('./config/swagger');
const errorHandler = require('./middlewares/errorHandler');
const { apiLimiter } = require('./middlewares/rateLimiting');
const { verifyToken } = require('./utils/jwt');

// Função para detectar IP da máquina
const getLocalIP = () => {
  const interfaces = os.networkInterfaces();
  for (const name of Object.keys(interfaces)) {
    for (const iface of interfaces[name]) {
      if (iface.family === 'IPv4' && !iface.internal) {
        return iface.address;
      }
    }
  }
  return '0.0.0.0';
};

// Detectar IP automaticamente e configurar variáveis de ambiente dinâmicas
const DETECTED_IP = getLocalIP();
const PORT = process.env.PORT || 4000;
const HOST = process.env.HOST || '0.0.0.0';

// Usar IP detectado ou variáveis de ambiente se definidas
if (!process.env.PUBLIC_BASE_URL) {
  process.env.PUBLIC_BASE_URL = `http://${DETECTED_IP}:${PORT}`;
}
if (!process.env.FRONTEND_URL) {
  process.env.FRONTEND_URL = `http://${DETECTED_IP}:5173`;
}
if (!process.env.ALLOWED_ORIGINS) {
  process.env.ALLOWED_ORIGINS = `http://${DETECTED_IP}:5173`;
}

logger.info(`IP detectado: ${DETECTED_IP}`);
logger.info(`PUBLIC_BASE_URL: ${process.env.PUBLIC_BASE_URL}`);
logger.info(`FRONTEND_URL: ${process.env.FRONTEND_URL}`);
logger.info(`ALLOWED_ORIGINS: ${process.env.ALLOWED_ORIGINS}`);

// Conectar ao banco de dados
connectDB();

const app = express();

// Middlewares de segurança
app.use(helmet());

// Configuração de CORS mais permissiva em desenvolvimento
const corsOptions = {
  origin: function (origin, callback) {
    // Permitir requisições sem origin (como mobile apps, Postman)
    if (!origin) return callback(null, true);
    
    // Em desenvolvimento, permitir IPs da rede local
    if (process.env.NODE_ENV === 'development') {
      // Permitir IPs locais (192.168.x.x, 10.x.x.x, 172.16-31.x.x)
      if (
        /^https?:\/\/(192\.168\.\d{1,3}\.\d{1,3}|10\.\d{1,3}\.\d{1,3}\.\d{1,3}|172\.(1[6-9]|2[0-9]|3[01])\.\d{1,3}\.\d{1,3}):\d+$/.test(origin)
      ) {
        return callback(null, true);
      }
    }
    
    // Verificar lista de origens permitidas
    const allowedOrigins = process.env.ALLOWED_ORIGINS?.split(',') || [];
    if (allowedOrigins.indexOf(origin) !== -1) {
      callback(null, true);
    } else {
      callback(new Error('Not allowed by CORS'));
    }
  },
  credentials: true,
};

app.use(cors(corsOptions));

// Middlewares gerais
app.use(compression());
app.use(express.json({ limit: `${process.env.MAX_UPLOAD_MB || 20}mb` }));
app.use(express.urlencoded({ extended: true, limit: `${process.env.MAX_UPLOAD_MB || 20}mb` }));
app.use(cookieParser());
app.use(morgan('combined', { stream: { write: message => logger.info(message.trim()) } }));

// Middleware para extrair usuário do token ANTES do rate limiting
// Isso permite que o rate limiter acesse req.user
app.use('/api', (req, res, next) => {
  const token = req.cookies.token;
  if (token) {
    try {
      const decoded = verifyToken(token);
      req.user = decoded;
    } catch (err) {
      // Token inválido, mas não bloqueia a requisição
      // A autenticação será verificada novamente nas rotas protegidas
    }
  }
  next();
});

// Rate limiting (após extração do usuário)
app.use('/api', apiLimiter);

// Servir arquivos estáticos
app.use('/uploads', express.static('uploads'));

// Swagger documentation
app.use('/api-docs', swaggerUi.serve, swaggerUi.setup(swaggerSpec));

// Health check
app.get('/health', (req, res) => {
  res.json({ success: true, message: 'API rodando' });
});

// Rotas
app.use('/api/v1/auth', require('./routes/authRoutes'));
app.use('/api/v1/public', require('./routes/publicRoutes'));
app.use('/api/v1/user', require('./routes/userRoutes'));
app.use('/api/v1/avaliador', require('./routes/avaliadorRoutes'));
app.use('/api/v1/admin', require('./routes/adminRoutes'));
app.use('/api/v1/mesario', require('./routes/mesarioRoutes'));
app.use('/api/v1/trabalhos', require('./routes/trabalhoRoutes'));
app.use('/api/v1/orientador', require('./routes/orientadorRoutes'));

// Rota 404
app.use('*', (req, res) => {
  res.status(404).json({
    success: false,
    message: 'Rota não encontrada',
  });
});

// Error handler
app.use(errorHandler);

// Inicializar servidor
app.listen(PORT, HOST, () => {
  logger.info(`Servidor rodando na porta ${PORT} em todas as interfaces de rede`);
  logger.info(`Acesso via IP: http://${DETECTED_IP}:${PORT}/api-docs`);
  logger.info(`Swagger Docs: http://${DETECTED_IP}:${PORT}/api-docs`);
});

module.exports = app;
