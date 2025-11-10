# Script para iniciar o frontend com IP de rede detectado automaticamente

Write-Host "Detectando IP da rede..." -ForegroundColor Cyan

# Obtém o IP da rede
$networkIP = node scripts/get-network-ip.js

Write-Host "IP detectado: $networkIP" -ForegroundColor Green

# Cria o arquivo .env.local com o IP dinâmico
$envContent = "VITE_API_BASE_URL=http://${networkIP}:4000/api/v1"
Set-Content -Path ".env.local" -Value $envContent

Write-Host "Configurações aplicadas:" -ForegroundColor Yellow
Write-Host "  VITE_API_BASE_URL: http://${networkIP}:4000/api/v1" -ForegroundColor White
Write-Host ""
Write-Host "Iniciando servidor frontend..." -ForegroundColor Cyan
Write-Host "Acesso local: http://localhost:5173/" -ForegroundColor Green
Write-Host "Acesso rede: http://${networkIP}:5173/" -ForegroundColor Green
Write-Host ""

# Inicia o servidor
npm run dev
