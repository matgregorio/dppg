# Script para iniciar todo o sistema com IP de rede detectado automaticamente

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Sistema de Simpósio - Modo Rede" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Detecta o IP da rede
Write-Host "Detectando IP da rede..." -ForegroundColor Yellow
$networkIP = node backend/scripts/get-network-ip.js
Write-Host "IP detectado: $networkIP" -ForegroundColor Green
Write-Host ""

# Inicia o backend em um novo terminal
Write-Host "Iniciando Backend..." -ForegroundColor Yellow
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd '$PWD\backend'; npm run dev:network"

# Aguarda 3 segundos para o backend iniciar
Start-Sleep -Seconds 3

# Inicia o frontend em um novo terminal
Write-Host "Iniciando Frontend..." -ForegroundColor Yellow
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd '$PWD\frontend'; npm run dev:network"

Write-Host ""
Write-Host "========================================" -ForegroundColor Green
Write-Host "  Sistema iniciado com sucesso!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green
Write-Host ""
Write-Host "URLs de acesso:" -ForegroundColor Cyan
Write-Host "  Local:  http://localhost:5173/" -ForegroundColor White
Write-Host "  Rede:   http://${networkIP}:5173/" -ForegroundColor White
Write-Host ""
Write-Host "Backend API:" -ForegroundColor Cyan
Write-Host "  Local:  http://localhost:4000/api-docs" -ForegroundColor White
Write-Host "  Rede:   http://${networkIP}:4000/api-docs" -ForegroundColor White
Write-Host ""
Write-Host "Pressione qualquer tecla para fechar esta janela..." -ForegroundColor Gray
$null = $Host.UI.RawUI.ReadKey("NoEcho,IncludeKeyDown")
