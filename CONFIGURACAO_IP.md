# 🌐 Configuração de IP Dinâmico

## 📋 Visão Geral

O sistema foi projetado para **detectar automaticamente o IP da máquina** na inicialização, mas permite **sobrescrever qualquer configuração via arquivos `.env`**.

## 🔄 Detecção Automática

### Como Funciona:

1. **Na inicialização**, tanto backend quanto frontend detectam o IP da máquina
2. **Se as variáveis de ambiente estiverem vazias**, o sistema usa o IP detectado
3. **Se as variáveis estiverem definidas**, elas têm prioridade sobre a detecção

### Backend (Node.js):

```javascript
// Detecta IP automaticamente
const DETECTED_IP = getLocalIP(); // Ex: 192.168.2.214

// Configura URLs automaticamente se não definidas no .env
if (!process.env.PUBLIC_BASE_URL) {
  process.env.PUBLIC_BASE_URL = `http://${DETECTED_IP}:4000`;
}
if (!process.env.FRONTEND_URL) {
  process.env.FRONTEND_URL = `http://${DETECTED_IP}:5173`;
}
if (!process.env.ALLOWED_ORIGINS) {
  process.env.ALLOWED_ORIGINS = `http://${DETECTED_IP}:5173`;
}
```

### Frontend (Vite):

```javascript
// Detecta IP automaticamente
const detectedIP = getLocalIP(); // Ex: 192.168.2.214

// Usa .env se definido, senão usa IP detectado
const apiBaseUrl = env.VITE_API_BASE_URL || `http://${detectedIP}:4000/api/v1`;
```

## ⚙️ Configuração via .env

### 📁 Backend (.env)

#### Opção 1: Detecção Automática (Recomendado)

```env
# Deixe vazio para detecção automática
PUBLIC_BASE_URL=
FRONTEND_URL=
ALLOWED_ORIGINS=
```

**Resultado:** Sistema detecta IP automaticamente (ex: 192.168.2.214)

#### Opção 2: IP Fixo Específico

```env
# Defina um IP específico
PUBLIC_BASE_URL=http://192.168.1.100:4000
FRONTEND_URL=http://192.168.1.100:5173
ALLOWED_ORIGINS=http://192.168.1.100:5173
```

**Resultado:** Sistema usa o IP especificado (192.168.1.100)

#### Opção 3: Múltiplas Origens

```env
# Permitir múltiplos IPs/domínios
PUBLIC_BASE_URL=http://192.168.2.214:4000
FRONTEND_URL=http://192.168.2.214:5173
ALLOWED_ORIGINS=http://192.168.2.214:5173,http://192.168.1.50:5173,http://10.0.0.100:5173
```

**Resultado:** API aceita requisições de múltiplos endereços

### 📁 Frontend (.env)

#### Opção 1: Detecção Automática (Recomendado)

```env
# Deixe vazio para detecção automática
VITE_API_BASE_URL=
```

**Resultado:** Frontend usa IP detectado automaticamente

#### Opção 2: API em Servidor Específico

```env
# Apontar para um servidor específico
VITE_API_BASE_URL=http://192.168.1.100:4000/api/v1
```

**Resultado:** Frontend conecta ao servidor especificado

#### Opção 3: Servidor em Nuvem/Produção

```env
# Apontar para servidor de produção
VITE_API_BASE_URL=https://api.simposio.edu.br/api/v1
```

**Resultado:** Frontend conecta ao servidor de produção

## 🚀 Cenários de Uso

### Cenário 1: Desenvolvimento Local (Padrão)

**Configuração:**
```env
# backend/.env
PUBLIC_BASE_URL=
FRONTEND_URL=
ALLOWED_ORIGINS=

# frontend/.env
VITE_API_BASE_URL=
```

**Comportamento:**
- Sistema detecta IP: `192.168.2.214`
- Backend: `http://192.168.2.214:4000`
- Frontend: `http://192.168.2.214:5173`
- Funciona em qualquer dispositivo da rede local

### Cenário 2: IP Mudou (Novo WiFi)

**Situação:** Conectou em outra rede, IP mudou de `192.168.2.214` para `10.0.0.50`

**Solução:** Apenas reinicie os servidores!
```bash
# O sistema detecta o novo IP automaticamente
npm start  # backend
npm run dev  # frontend
```

**Resultado:**
- Backend: `http://10.0.0.50:4000`
- Frontend: `http://10.0.0.50:5173`

### Cenário 3: Múltiplos Desenvolvedores

**Situação:** Equipe trabalhando em diferentes IPs

**Desenvolvedor A (IP: 192.168.1.100):**
```env
# Deixa vazio - sistema detecta automaticamente
PUBLIC_BASE_URL=
```

**Desenvolvedor B (IP: 192.168.1.101):**
```env
# Deixa vazio - sistema detecta automaticamente
PUBLIC_BASE_URL=
```

**Resultado:** Cada desenvolvedor tem seu ambiente configurado automaticamente

### Cenário 4: Backend Centralizado

**Situação:** Um servidor backend para múltiplos frontends

**Backend (IP: 192.168.1.100):**
```env
PUBLIC_BASE_URL=http://192.168.1.100:4000
FRONTEND_URL=http://192.168.1.100:5173
ALLOWED_ORIGINS=http://192.168.1.100:5173,http://192.168.1.101:5173,http://192.168.1.102:5173
```

**Frontend Dev 1 (IP: 192.168.1.101):**
```env
VITE_API_BASE_URL=http://192.168.1.100:4000/api/v1
```

**Frontend Dev 2 (IP: 192.168.1.102):**
```env
VITE_API_BASE_URL=http://192.168.1.100:4000/api/v1
```

## 📊 Logs de Inicialização

### Backend:

```
info: IP detectado: 192.168.2.214
info: PUBLIC_BASE_URL: http://192.168.2.214:4000
info: FRONTEND_URL: http://192.168.2.214:5173
info: ALLOWED_ORIGINS: http://192.168.2.214:5173
info: Servidor rodando na porta 4000 em todas as interfaces de rede
info: Acesso via IP: http://192.168.2.214:4000/api-docs
```

### Frontend:

```
==================================================
CONFIGURAÇÃO DO VITE
==================================================
IP Detectado: 192.168.2.214
API Base URL: http://192.168.2.214:4000/api/v1
VITE_API_BASE_URL (.env): (não definido - usando detecção automática)
==================================================
```

## 🔍 Verificar Configuração Atual

### Verificar IP Detectado:

```powershell
# Windows PowerShell
Get-NetIPAddress -AddressFamily IPv4 | Where-Object { $_.IPAddress -like "192.168.*" -or $_.IPAddress -like "10.*" } | Select-Object -First 1 -ExpandProperty IPAddress
```

### Verificar Variáveis de Ambiente:

```bash
# Backend
cd backend
cat .env | grep -E "PUBLIC_BASE_URL|FRONTEND_URL|ALLOWED_ORIGINS"

# Frontend
cd frontend
cat .env | grep VITE_API_BASE_URL
```

## ⚠️ Troubleshooting

### Problema: IP Detectado Incorretamente

**Solução:** Force o IP correto no `.env`

```env
# backend/.env
PUBLIC_BASE_URL=http://SEU_IP_CORRETO:4000
FRONTEND_URL=http://SEU_IP_CORRETO:5173
ALLOWED_ORIGINS=http://SEU_IP_CORRETO:5173
```

### Problema: CORS Error

**Causa:** IP do frontend não está em `ALLOWED_ORIGINS`

**Solução:** Adicione o IP à lista

```env
ALLOWED_ORIGINS=http://192.168.2.214:5173,http://NOVO_IP:5173
```

### Problema: Frontend não Conecta ao Backend

**Verificar:**
1. Backend está rodando?
2. IP correto no `VITE_API_BASE_URL`?
3. Firewall bloqueando?

**Solução:** Force a URL correta

```env
# frontend/.env
VITE_API_BASE_URL=http://IP_DO_BACKEND:4000/api/v1
```

## 📱 Acesso de Dispositivos Móveis

Para acessar via QR Code ou smartphone:

1. **Certifique-se** de que backend e frontend estão na mesma rede
2. **Deixe as variáveis vazias** para detecção automática
3. **Verifique** o firewall do Windows (permitir porta 4000 e 5173)
4. **Acesse** via IP detectado no smartphone

**URL QR Code:** `http://IP_DETECTADO:5173/checkin?token=...`

## 🎯 Recomendações

✅ **FAÇA:**
- Deixe variáveis vazias para detecção automática
- Use `.env` para sobrescrever quando necessário
- Verifique os logs de inicialização

❌ **NÃO FAÇA:**
- Hardcode IPs no código-fonte
- Commit de IPs específicos no `.env`
- Ignore os logs de detecção de IP

## 📝 Resumo

| Cenário | Configuração .env | Comportamento |
|---------|------------------|---------------|
| Desenvolvimento Padrão | Vazio | Detecta IP automaticamente |
| IP Fixo Necessário | Define valor | Usa valor definido |
| Múltiplas Origens | Lista separada por vírgula | Aceita todas as origens |
| Backend Remoto | URL completa | Conecta ao servidor remoto |

**O sistema é totalmente flexível e se adapta automaticamente ao ambiente!** 🎉
