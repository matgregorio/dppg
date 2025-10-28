require('dotenv').config();
const express = require('express');
const cors = require('cors');
const helmet = require('helmet');
const compression = require('compression');
const cookieParser = require('cookie-parser');
const morgan = require('morgan');
const swaggerUi = require('swagger-ui-express');

const connectDB = require('./config/database');
const logger = require('./config/logger');
const swaggerSpec = require('./config/swagger');
const errorHandler = require('./middlewares/errorHandler');
const { apiLimiter } = require('./middlewares/rateLimiting');

// Conectar ao banco de dados
connectDB();

const app = express();

// Middlewares de segurança
app.use(helmet());
app.use(cors({
  origin: process.env.ALLOWED_ORIGINS?.split(',') || 'http://localhost:5173',
  credentials: true,
}));

// Middlewares gerais
app.use(compression());
app.use(express.json({ limit: `${process.env.MAX_UPLOAD_MB || 20}mb` }));
app.use(express.urlencoded({ extended: true, limit: `${process.env.MAX_UPLOAD_MB || 20}mb` }));
app.use(cookieParser());
app.use(morgan('combined', { stream: { write: message => logger.info(message.trim()) } }));

// Rate limiting
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

// Rota 404
app.use('*', (req, res) => {
  res.status(404).json({
    success: false,
    message: 'Rota não encontrada',
  });
});

// Error handler
app.use(errorHandler);

const PORT = process.env.PORT || 4000;

app.listen(PORT, () => {
  logger.info(`Servidor rodando na porta ${PORT}`);
  logger.info(`Documentação Swagger: http://localhost:${PORT}/api-docs`);
});

module.exports = app;
