# Script para iniciar o backend com IP de rede detectado automaticamente

Write-Host "Detectando IP da rede..." -ForegroundColor Cyan

# Obtém o IP da rede
$networkIP = node scripts/get-network-ip.js

Write-Host "IP detectado: $networkIP" -ForegroundColor Green

# Define as variáveis de ambiente
$env:PUBLIC_BASE_URL = "http://${networkIP}:4000"
$env:FRONTEND_URL = "http://${networkIP}:5173"
$env:ALLOWED_ORIGINS = "http://localhost:5173,http://${networkIP}:5173"

Write-Host "Configurações aplicadas:" -ForegroundColor Yellow
Write-Host "  PUBLIC_BASE_URL: $env:PUBLIC_BASE_URL" -ForegroundColor White
Write-Host "  FRONTEND_URL: $env:FRONTEND_URL" -ForegroundColor White
Write-Host "  ALLOWED_ORIGINS: $env:ALLOWED_ORIGINS" -ForegroundColor White
Write-Host ""
Write-Host "Iniciando servidor backend..." -ForegroundColor Cyan
Write-Host "Acesso local: http://localhost:4000/api-docs" -ForegroundColor Green
Write-Host "Acesso rede: http://${networkIP}:4000/api-docs" -ForegroundColor Green
Write-Host ""

# Inicia o servidor
node src/server.js
