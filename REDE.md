# Iniciar Sistema em Rede

Este documento explica como iniciar o sistema automaticamente em modo rede, permitindo acesso de outros dispositivos na mesma rede.

## Opção 1: Iniciar tudo de uma vez (Recomendado)

Execute o script principal na raiz do projeto:

```powershell
.\start-network.ps1
```

Este script irá:
- Detectar automaticamente o IP da sua máquina
- Iniciar o backend em uma janela separada
- Iniciar o frontend em outra janela separada
- Mostrar as URLs de acesso (local e rede)

## Opção 2: Iniciar manualmente cada parte

### Backend
```powershell
cd backend
npm run dev:network
```

### Frontend
```powershell
cd frontend
npm run dev:network
```

## Como funciona

Os scripts detectam automaticamente o IP da sua máquina na rede local e configuram:

### Backend
- `PUBLIC_BASE_URL`: URL pública do backend
- `FRONTEND_URL`: URL do frontend
- `ALLOWED_ORIGINS`: Origens permitidas para CORS

### Frontend
- `VITE_API_BASE_URL`: URL da API do backend
- Cria automaticamente um arquivo `.env.local` com as configurações

## Acessar de outros dispositivos

Após iniciar o sistema, você poderá acessar de qualquer dispositivo na mesma rede usando o IP mostrado no console.

Por exemplo, se o IP detectado for `192.168.0.103`:
- Frontend: `http://192.168.0.103:5173/`
- Backend API: `http://192.168.0.103:4000/api-docs`

## Modo Local (sem rede)

Para rodar apenas localmente (localhost):

### Backend
```powershell
cd backend
npm run dev
```

### Frontend
```powershell
cd frontend
npm run dev
```

## Troubleshooting

### Erro de execução de scripts PowerShell

Se aparecer erro de política de execução, execute:
```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

### Porta já em uso

Se as portas 4000 ou 5173 já estiverem em uso, finalize os processos:
```powershell
# Finalizar processo na porta 4000
netstat -ano | findstr :4000
taskkill /F /PID [PID_NUMBER]

# Finalizar processo na porta 5173
netstat -ano | findstr :5173
taskkill /F /PID [PID_NUMBER]
```

### IP não detectado corretamente

O script detecta o primeiro IP IPv4 não-interno encontrado. Se você tiver múltiplas interfaces de rede, pode ser necessário editar manualmente o arquivo `.env` do backend e `.env.local` do frontend.
