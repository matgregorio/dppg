# Regra de Negócio: Mesário e Participante

## Definição

**Todo mesário é um participante, mas nem todo participante é um mesário.**

## Implementação

### 1. Modelo de Dados

O sistema utiliza dois modelos principais:

- **User**: Representa usuários do sistema com diferentes roles (`USER`, `MESARIO`, `AVALIADOR`, `ADMIN`, `SUBADMIN`)
- **Participant**: Representa participantes que podem se inscrever em simpósios e subeventos

### 2. Automação da Regra

A regra é garantida automaticamente em múltiplos pontos:

#### 2.1 Hook no Model User (`backend/src/models/User.js`)

```javascript
// Hook post-save que cria automaticamente um Participant 
// quando um User recebe a role MESARIO
userSchema.post('save', async function(doc) {
  if (doc.roles && doc.roles.includes('MESARIO')) {
    const participantExists = await Participant.findOne({ user: doc._id });
    if (!participantExists) {
      await Participant.create({
        user: doc._id,
        cpf: doc.cpf,
        nome: doc.nome,
        email: doc.email,
        telefone: doc.telefone || '',
        tipoParticipante: 'DOCENTE'
      });
    }
  }
});
```

#### 2.2 Auto-criação em Endpoints

Os seguintes endpoints criam automaticamente o Participant se não existir:

- **`POST /api/v1/user/inscricoes/simposio`** - Inscrição em simpósio
- **`POST /api/v1/mesario/subeventos/:id/inscrever`** - Inscrição em subevento

```javascript
let participant = await Participant.findOne({ user: req.user.id });

if (!participant) {
  const user = await User.findById(req.user.id);
  participant = await Participant.create({
    user: user._id,
    cpf: user.cpf,
    nome: user.nome,
    email: user.email,
    telefone: user.telefone || '',
    tipoParticipante: 'DOCENTE'
  });
}
```

#### 2.3 Utilitário de Migração (`backend/src/utils/garantirParticipantsMesarios.js`)

Ferramenta para garantir que todos os mesários existentes tenham Participant:

```bash
cd backend
node src/utils/garantirParticipantsMesarios.js
```

Este utilitário também é executado automaticamente no seed.

### 3. Permissões de Acesso

Mesários têm acesso a todas as funcionalidades de participante:

```javascript
// Rotas de participante incluem role MESARIO
router.get('/certificados', auth, requireRoles(['USER', 'MESARIO', ...]), ...);
router.get('/trabalhos', auth, requireRoles(['USER', 'MESARIO']), ...);
router.post('/trabalhos', auth, requireRoles(['USER', 'MESARIO']), ...);
router.post('/inscricoes/simposio', auth, requireRoles(['USER', 'MESARIO']), ...);
router.get('/inscricoes', auth, requireRoles(['USER', 'MESARIO']), ...);
```

### 4. Seed de Dados

O seed (`backend/src/seed/runSeed.js`) cria automaticamente:

1. User com roles `['USER', 'MESARIO']`
2. Participant correspondente
3. Executa `garantirParticipantsMesarios()` para validação

```javascript
// Usuário mesário
{ email: 'mesario@gov.br', senha: 'Mesario!234', 
  nome: 'Mesário', cpf: gerarCPF(), 
  roles: ['USER', 'MESARIO'] }

// Participant criado automaticamente
{ user: mesarioUser._id, cpf: mesarioUser.cpf, 
  nome: mesarioUser.nome, email: mesarioUser.email,
  tipoParticipante: 'DOCENTE' }
```

## Fluxo de Uso

### Cenário 1: Criar Novo Mesário
1. Admin cria User com role `MESARIO`
2. Hook `post('save')` detecta role MESARIO
3. Participant é criado automaticamente
4. Mesário pode acessar funcionalidades de participante imediatamente

### Cenário 2: Promover Participante a Mesário
1. Admin adiciona role `MESARIO` ao User existente
2. Hook `post('save')` detecta nova role
3. Como já existe Participant, nenhuma ação adicional
4. User agora tem acesso a funcionalidades de mesário

### Cenário 3: Mesário Fazendo Inscrição
1. Mesário acessa "Minhas Inscrições"
2. Clica em "Inscrever-se Agora"
3. Endpoint verifica se existe Participant
4. Se não existir (caso raro), cria automaticamente
5. Processa inscrição normalmente

## Auditoria

Todas as criações automáticas de Participant são registradas:

```javascript
logAudit('PARTICIPANT_AUTO_CREATED', userId, { 
  userId: user._id,
  reason: 'MESARIO_ROLE_ASSIGNED' // ou outro motivo
});
```

## Checklist de Validação

- [ ] Hook no User.js cria Participant quando role MESARIO é atribuída
- [ ] Endpoints de inscrição criam Participant automaticamente se necessário
- [ ] Mesários têm acesso a todas as rotas de participante
- [ ] Seed cria Participant para mesários
- [ ] Utilitário de migração disponível para correção de dados
- [ ] Auditoria registra todas as criações automáticas

## Manutenção

Se houver inconsistências nos dados (mesários sem Participant):

```bash
# Executar utilitário de correção
cd backend
node src/utils/garantirParticipantsMesarios.js

# Ou re-executar seed completo
npm run seed
```
