# 🚀 INÍCIO RÁPIDO - Sistema de Simpósio

## ⚡ Executar em 5 minutos

### 1️⃣ Pré-requisitos
- ✅ Node.js 18+ instalado
- ✅ MongoDB rodando (porta 27017)
- ✅ PowerShell (Windows) ou Terminal

### 2️⃣ Instalação

```powershell
# Backend
cd backend
npm install
Copy-Item .env.example .env

# Frontend
cd ..\frontend
npm install
Copy-Item .env.example .env
```

### 3️⃣ Configurar (IMPORTANTE!)

**Edite backend/.env:**
```env
JWT_ACCESS_SECRET=mude_este_secret_por_um_forte_123456789
JWT_REFRESH_SECRET=mude_este_outro_secret_tambem_987654321
```

> ⚠️ **NUNCA use os secrets padrão em produção!**

### 4️⃣ Popular Banco de Dados

```powershell
cd backend
npm run seed
```

**Aguarde ver:** ✅ Seed concluído com sucesso!

### 5️⃣ Iniciar Servidores

**Terminal 1 (Backend):**
```powershell
cd backend
npm run dev
```
✅ Aguarde: `Servidor rodando na porta 4000`

**Terminal 2 (Frontend):**
```powershell
cd frontend
npm run dev
```
✅ Aguarde: `Local: http://localhost:5173`

### 6️⃣ Acessar e Testar

1. **Abra:** http://localhost:5173
2. **Clique:** Botão "Entrar" no header
3. **Login com:**
   ```
   Email: admin@gov.br
   Senha: Admin!234
   ```
4. **Explore!** 🎉

---

## 🔑 Contas de Teste Disponíveis

| Email | Senha | Role | Descrição |
|-------|-------|------|-----------|
| admin@gov.br | Admin!234 | ADMIN | Acesso total ao sistema |
| subadmin@gov.br | SubAdmin!234 | SUBADMIN | Gerenciar simpósio |
| avaliador1@gov.br | Avaliador!234 | AVALIADOR | Avaliar trabalhos |
| avaliador2@gov.br | Avaliador!234 | AVALIADOR | Avaliar trabalhos |
| mesario@gov.br | Mesario!234 | MESARIO | Gerenciar presenças |
| participante1@gov.br | Participante!234 | USER | Submeter trabalhos |
| participante2@gov.br | Participante!234 | USER | Submeter trabalhos |

---

## 📍 Principais URLs

| Serviço | URL |
|---------|-----|
| Frontend | http://localhost:5173 |
| Backend API | http://localhost:4000/api/v1 |
| Swagger Docs | http://localhost:4000/api-docs |
| Logs Auditoria | `backend/logs/` |

---

## 🧪 Testar Fluxos Principais

### 🎯 Como Participante
1. Login: `participante1@gov.br`
2. Menu → **Minhas Inscrições**
3. Clique **Nova Inscrição** (já tem uma criada pelo seed)
4. Menu → **Meus Trabalhos**
5. Clique **Submeter Trabalho**
6. Preencha e faça upload de um PDF
7. Veja o trabalho na lista com status **SUBMETIDO**

### 📝 Como Avaliador
1. Login: `avaliador1@gov.br`
2. Menu → **Trabalhos para Avaliar**
3. Veja trabalhos atribuídos (seed cria alguns)
4. Clique **Avaliar** em um trabalho pendente
5. Dê nota (0-10) e parecer
6. Veja badge mudar para **Avaliado**

### 👨‍💼 Como Admin
1. Login: `admin@gov.br`
2. Menu → **Gerenciar Simpósio**
3. Veja dashboard do simpósio 2025
4. Clique **Configurar Datas**
5. Ajuste as 4 janelas de data
6. Menu → **Trabalhos** → Veja lista
7. Clique **+** para atribuir avaliador
8. Menu → **Áreas de Conhecimento**
9. Crie uma nova Grande Área
10. Crie Área de Atuação vinculada
11. Menu → **Participantes** → Veja lista com busca

### 🎫 Como Mesário
1. Login: `mesario@gov.br`
2. Menu → **Meus Subeventos**
3. Veja subevento "Abertura" (criado pelo seed)
4. Clique **Gerar QR Code**
5. Veja QR Code com countdown 5min
6. Clique **Painel de Presenças**
7. Veja lista em tempo real (auto-refresh 5s)

---

## 🐛 Problemas Comuns

### ❌ MongoDB não conecta
```powershell
# Inicie o MongoDB
net start MongoDB

# Ou verifique se está rodando
sc query MongoDB
```

### ❌ Porta 4000 ou 5173 em uso
```powershell
# Descubra o processo
netstat -ano | findstr :4000
netstat -ano | findstr :5173

# Mate o processo (substitua <PID>)
taskkill /PID <PID> /F
```

### ❌ Módulos não encontrados
```powershell
# Limpe e reinstale
cd backend
Remove-Item -Recurse -Force node_modules, package-lock.json
npm install

cd ..\frontend
Remove-Item -Recurse -Force node_modules, package-lock.json
npm install
```

### ❌ Seed falha
```powershell
# Reset completo do banco
cd backend
npm run seed:dev:reset
```

---

## 📚 Documentação Completa

- **README Principal:** `README.md`
- **Conclusão do Projeto:** `PROJETO_CONCLUIDO.md`
- **Swagger API:** http://localhost:4000/api-docs

---

## ✅ Checklist Pré-Execução

- [ ] Node.js 18+ instalado? (`node -v`)
- [ ] MongoDB rodando? (`sc query MongoDB`)
- [ ] Dependências instaladas? (`npm install` em ambos)
- [ ] .env criados? (backend e frontend)
- [ ] Secrets alterados? (JWT_ACCESS_SECRET e JWT_REFRESH_SECRET)
- [ ] Seed executado? (`npm run seed`)
- [ ] Backend rodando? (porta 4000)
- [ ] Frontend rodando? (porta 5173)

---

## 🎉 Pronto!

**Agora você tem um sistema completo de simpósios rodando localmente!**

Explore todas as funcionalidades com as 7 contas de teste.

**Divirta-se!** 🚀
