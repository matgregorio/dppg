import { defineConfig, loadEnv } from 'vite';
import react from '@vitejs/plugin-react';
import os from 'os';

// Função para obter o IP local da máquina
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

export default defineConfig(({ mode }) => {
  // Carregar variáveis de ambiente
  const env = loadEnv(mode, process.cwd(), '');
  
  // Detectar IP automaticamente
  const detectedIP = getLocalIP();
  
  // Usar VITE_API_BASE_URL do .env se definido, senão usar IP detectado
  const apiBaseUrl = env.VITE_API_BASE_URL || `http://${detectedIP}:4000/api/v1`;
  
  console.log('='.repeat(50));
  console.log('CONFIGURAÇÃO DO VITE');
  console.log('='.repeat(50));
  console.log(`IP Detectado: ${detectedIP}`);
  console.log(`API Base URL: ${apiBaseUrl}`);
  console.log(`VITE_API_BASE_URL (.env): ${env.VITE_API_BASE_URL || '(não definido - usando detecção automática)'}`);
  console.log('='.repeat(50));
  
  // Definir variável de ambiente para o Vite
  process.env.VITE_API_BASE_URL = apiBaseUrl;
  
  return {
    plugins: [react()],
    server: {
      port: 5173,
      host: '0.0.0.0', // Escuta em todas as interfaces de rede
      strictPort: true, // Falha se a porta estiver em uso
      proxy: {
        '/api': {
          target: `http://${detectedIP}:4000`,
          changeOrigin: true,
          secure: false,
        },
      },
    },
  build: {
    // Code splitting para chunks menores
    rollupOptions: {
      output: {
        manualChunks: (id) => {
          // React ecosystem em um chunk
          if (id.includes('node_modules/react') || 
              id.includes('node_modules/react-dom') || 
              id.includes('node_modules/react-router-dom')) {
            return 'react-vendor';
          }
          // GovBR DS em chunk separado (biblioteca grande)
          if (id.includes('node_modules/@govbr-ds')) {
            return 'govbr-vendor';
          }
          // Redux em chunk separado
          if (id.includes('node_modules/@reduxjs') || 
              id.includes('node_modules/react-redux')) {
            return 'redux-vendor';
          }
          // Recharts (gráficos) em chunk separado
          if (id.includes('node_modules/recharts')) {
            return 'charts-vendor';
          }
          // Editor de texto em chunk separado
          if (id.includes('node_modules/react-quill')) {
            return 'editor-vendor';
          }
          // QR Code scanner em chunk separado
          if (id.includes('node_modules/html5-qrcode')) {
            return 'qrcode-vendor';
          }
          // Utilitários (axios, dayjs, etc)
          if (id.includes('node_modules/axios') || 
              id.includes('node_modules/dayjs') ||
              id.includes('node_modules/zod')) {
            return 'utils-vendor';
          }
        }
      }
    },
    // Usa esbuild (mais rápido que terser)
    minify: 'esbuild',
    // Aumenta limite mas com chunks otimizados não deve alertar
    chunkSizeWarningLimit: 600
  }
  };
});
