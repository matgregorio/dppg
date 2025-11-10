@echo off
echo ========================================
echo   Sistema de Simposio - Modo Rede
echo ========================================
echo.

echo Detectando IP da rede...
for /f "tokens=*" %%i in ('node backend\scripts\get-network-ip.js') do set NETWORK_IP=%%i

echo IP detectado: %NETWORK_IP%
echo.

echo Iniciando Backend...
start "Backend - Simposio" cmd /k "cd backend && npm run dev:network"

timeout /t 3 /nobreak >nul

echo Iniciando Frontend...
start "Frontend - Simposio" cmd /k "cd frontend && npm run dev:network"

echo.
echo ========================================
echo   Sistema iniciado com sucesso!
echo ========================================
echo.
echo URLs de acesso:
echo   Local:  http://localhost:5173/
echo   Rede:   http://%NETWORK_IP%:5173/
echo.
echo Backend API:
echo   Local:  http://localhost:4000/api-docs
echo   Rede:   http://%NETWORK_IP%:4000/api-docs
echo.
pause
