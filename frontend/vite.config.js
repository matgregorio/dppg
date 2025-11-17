import { defineConfig } from 'vite';
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
  return 'localhost';
};

const localIP = getLocalIP();

export default defineConfig({
  plugins: [react()],
  server: {
    port: 5173,
    host: '0.0.0.0', // Escuta em todas as interfaces de rede
    strictPort: true, // Falha se a porta estiver em uso
    proxy: {
      '/api': {
        target: `http://${localIP}:4000`,
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
});
