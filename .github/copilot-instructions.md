# Sistema de Simpósio Anual - AI Coding Assistant Instructions

## 🏗️ Architecture Overview

**Full-stack symposium management system**: Node.js/Express/MongoDB backend + React/Vite frontend with GOVBR-DS (Brazilian Government Design System).

### Core Structure
- **Backend**: `backend/src/` - RESTful API with role-based access control (RBAC)
- **Frontend**: `frontend/src/` - React SPA with Redux Toolkit state management
- **Roles**: ADMIN, SUBADMIN, AVALIADOR (evaluator), MESARIO (event staff), DOCENTE (faculty), USER (participant)

### Key Models (`backend/src/models/`)
- **Simposio**: Annual event with temporal windows (submission, registration, events)
- **Trabalho**: Submitted academic works with status flow: SUBMETIDO → EM_AVALIACAO → ACEITO/REJEITADO → PUBLICADO
- **Participant**: Separate from User - mesários auto-create Participant records via post-save hook
- **User**: Authentication entity with multi-role support (`roles` array)

## 🎯 Critical Business Rules

### Mesário-Participante Relationship
**Every mesário IS a participant, but not all participants are mesários**. This is enforced automatically:
- `User.js` post-save hook creates `Participant` when `MESARIO` role added
- Inscription endpoints auto-create missing `Participant` records
- See [backend/REGRA_MESARIO_PARTICIPANTE.md](backend/REGRA_MESARIO_PARTICIPANTE.md)

### Temporal Windows (`enforceWindow` middleware)
Submissions/registrations respect date ranges in `Simposio.datasConfig`:
```javascript
// Example: backend/src/middlewares/enforceWindow.js
enforceWindow('submissaoTrabalhos') // Blocks if outside window
```
Apply to routes requiring time-bound operations.

### Soft Deletes Pattern
Models use `deleted_at` field instead of hard deletes:
```javascript
// Models: Acervo, Docente, Instituicao, Presenca
find() // Auto-filters deleted_at: null
model.softDelete() // Sets deleted_at timestamp
```

## 🛠️ Development Workflow

### Startup Commands
```powershell
# Backend (Terminal 1)
cd backend
npm install
Copy-Item .env.example .env  # Edit JWT secrets!
npm run seed                  # Populate DB with test data
npm run dev

# Frontend (Terminal 2)
cd frontend
npm install
Copy-Item .env.example .env
npm run dev
```

**Test accounts after seed**: See [INICIO_RAPIDO.md](INICIO_RAPIDO.md) - admin@gov.br/Admin!234, etc.

### Network Development
Use PowerShell scripts for LAN access:
```powershell
npm run dev:network  # Backend or Frontend
```
Auto-detects local IP and configures CORS/PUBLIC_BASE_URL.

### Testing
```bash
cd backend
npm test                                # All tests (Jest + Supertest)
npm test -- --testNamePattern="Auth"   # Specific suite
```
35+ tests covering auth, CRUD, pagination, RBAC. Always run after model/route changes.

## 📐 Code Patterns & Conventions

### Authentication Flow
1. **JWT Tokens**: Access token (15min) + refresh token (7 days) in HTTP-only cookies
2. **Middleware chain**: `auth` → `requireRoles(['ADMIN'])` → controller
3. **Example route protection**:
```javascript
const auth = require('../middlewares/auth');
const requireRoles = require('../middlewares/requireRoles');

router.post('/admin/simposio', 
  auth, 
  requireRoles(['ADMIN', 'SUBADMIN']), 
  simposioController.create
);
```

### Frontend: GOVBR-DS Components
**Use official GOV.BR Design System patterns**. Key components:
- **FormSelect** (React Hook Form integrated): See [frontend/SELECT_GOVBR_README.md](frontend/SELECT_GOVBR_README.md)
- **SelectGovBR** (standalone filters)
- Initialize with `useGovBRInit()` hook in layouts

### Route Organization
Backend routes split by role:
- `authRoutes.js` - Public auth endpoints
- `publicRoutes.js` - No auth required (pages, acervo, certificate validation)
- `userRoutes.js` - USER role (submit trabalhos, manage inscriptions)
- `orientadorRoutes.js` - DOCENTE role (approve student works)
- `avaliadorRoutes.js` - AVALIADOR role (evaluate submissions)
- `mesarioRoutes.js` - MESARIO role (event check-ins, QR codes)
- `adminRoutes.js` - ADMIN/SUBADMIN (full symposium management)

### API Response Format
**Always use this structure**:
```javascript
// Success
res.json({
  success: true,
  data: { /* payload */ },
  meta: { page, totalPages } // For paginated responses
});

// Error
res.status(400).json({
  success: false,
  message: 'User-friendly error',
  error: err.message // Optional dev info
});
```

### Redux Store (`frontend/src/store/`)
- `authSlice.js` - User session, roles, auth state
- `notificationSlice.js` - Toast notifications
- Use `useSelector()` for auth checks in components

## 🔄 Symposium Lifecycle

Managed via [CICLO_SIMPOSIO.md](CICLO_SIMPOSIO.md):
1. **Initialize**: POST `/admin/simposio/iniciar` - Creates new year, sends announcement emails
2. **Manage**: Configure dates, areas, subeventos during INICIALIZADO status
3. **Finalize**: POST `/admin/simposio/finalizar-completo` - Marks FINALIZADO, generates certificates (See [backend/CERTIFICADOS_README.md](backend/CERTIFICADOS_README.md))

**Status Flow**: INICIALIZADO → FINALIZADO (irreversible).

## 📄 Certificate System

Certificates auto-generated on symposium finalization:
- **Types**: PARTICIPANTE, ORIENTADOR, AVALIADOR, MESARIO, ORGANIZADOR, PALESTRANTE
- **PDF**: A4 landscape, QR code validation, dual signatures
- **Routes**: `/admin/certificados` - CRUD, regenerate, email sending
- **Frontend**: AdminCertificados page with edit modal

## 🔍 Key Files to Reference

- [API_DOCUMENTATION.md](backend/API_DOCUMENTATION.md) - Complete endpoint reference with examples
- [INICIO_RAPIDO.md](INICIO_RAPIDO.md) - 5-minute quickstart, test accounts
- [backend/src/server.js](backend/src/server.js) - Entry point, CORS config, IP detection
- [backend/src/config/swagger.js](backend/src/config/swagger.js) - Swagger/OpenAPI setup
- [frontend/src/App.jsx](frontend/src/App.jsx) - Route definitions, auth guards

## 💡 Best Practices

1. **Never hard-code secrets**: Use `.env` variables (JWT_ACCESS_SECRET, JWT_REFRESH_SECRET)
2. **Rate limiting**: Already configured in `rateLimiting.js` - 100 req/15min per IP/user
3. **Logging**: Winston logger in `backend/logs/` (combined, error, audit). Use `logger.info()` not `console.log()`
4. **Uploads**: Multer handles files in `backend/uploads/`, max size in MAX_UPLOAD_MB env var
5. **Validation**: Use express-validator in routes, Zod + React Hook Form in frontend
6. **Database indexes**: Check model files for performance-critical queries (e.g., `cpf`, `email`, `deleted_at`)

## 🚨 Common Gotchas

- **Participant vs User**: User authenticates, Participant enrolls in events - linked but separate
- **Temporal windows**: Check `enforceWindow` middleware before modifying submission/registration routes
- **Soft deletes**: Use `.find()` for active records, explicit `{ deleted_at: { $ne: null } }` for archived
- **GOVBR-DS**: Must call `window.GOVBRDSCore.init()` after component mounts with official components
- **Network mode**: When using `dev:network`, update ALLOWED_ORIGINS in backend `.env` to match detected IP

## 📚 Documentation

- **Swagger UI**: http://localhost:4000/api-docs (after `npm run dev`)
- **README files**: Project root has multiple domain-specific guides (CERTIFICADOS, CICLO_SIMPOSIO, REDE, etc.)
