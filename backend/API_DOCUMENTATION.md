# Documentação da API - Sistema de Simpósio

## 📋 Índice

- [Visão Geral](#visão-geral)
- [Autenticação](#autenticação)
- [Endpoints Públicos](#endpoints-públicos)
- [Endpoints de Usuário](#endpoints-de-usuário)
- [Endpoints de Avaliador](#endpoints-de-avaliador)
- [Endpoints de Admin](#endpoints-de-admin)
- [Modelos de Dados](#modelos-de-dados)
- [Códigos de Erro](#códigos-de-erro)

## 🌐 Visão Geral

**Base URL:** `http://localhost:4000/api/v1`

**Formato de Resposta:** JSON

**Autenticação:** JWT Bearer Token

## 🔐 Autenticação

### Login
```http
POST /auth/login
```

**Request Body:**
```json
{
  "email": "user@example.com",
  "senha": "password123"
}
```

**Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "accessToken": "eyJhbGciOiJIUzI1NiIs...",
    "user": {
      "id": "507f1f77bcf86cd799439011",
      "nome": "João Silva",
      "email": "user@example.com",
      "papel": "USER"
    }
  }
}
```

### Logout
```http
POST /auth/logout
Authorization: Bearer {token}
```

### Recuperação de Senha
```http
POST /auth/forgot-password
```

**Request Body:**
```json
{
  "email": "user@example.com"
}
```

```http
POST /auth/reset-password
```

**Request Body:**
```json
{
  "token": "abc123...",
  "novaSenha": "newpassword123"
}
```

### Verificar Usuário Logado
```http
GET /auth/me
Authorization: Bearer {token}
```

## 🌍 Endpoints Públicos

### Listar Simpósios
```http
GET /public/simposios
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "_id": "...",
      "ano": 2025,
      "status": "INICIALIZADO",
      "datasConfig": { ... }
    }
  ]
}
```

### Obter Página Estática
```http
GET /public/paginas/:slug
```

**Slugs disponíveis:**
- `home`, `apresentacao`, `regulamento`, `corpo-editorial`, `expediente`
- `normas-publicacao`, `programacao`, `modelo-poster`, `validar-certificado`

### Listar Acervo
```http
GET /public/acervo?page=1&limit=20&ano=2025&busca=titulo
```

**Query Parameters:**
- `page` (number, default: 1)
- `limit` (number, default: 20)
- `ano` (number)
- `busca` (string) - busca por título, autores, palavras-chave

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "_id": "...",
      "titulo": "Título do Trabalho",
      "autores": ["Autor 1", "Autor 2"],
      "ano": 2025,
      "arquivo": "path/to/file.pdf"
    }
  ],
  "pagination": {
    "total": 100,
    "page": 1,
    "limit": 20,
    "totalPages": 5
  }
}
```

### Validar Certificado
```http
GET /public/certificados/validar/:codigo
```

## 👤 Endpoints de Usuário

**Requer autenticação** (`Authorization: Bearer {token}`)

### Meus Trabalhos
```http
GET /user/trabalhos
```

### Submeter Trabalho
```http
POST /user/trabalhos
Content-Type: multipart/form-data
```

**Form Data:**
- `titulo` (string)
- `autores` (array de objetos: nome, cpf, email)
- `palavras_chave` (array de strings)
- `grandeArea` (ObjectId)
- `areaAtuacao` (ObjectId)
- `subarea` (ObjectId)
- `arquivo` (file, max 10MB)

### Minhas Inscrições
```http
GET /user/inscricoes
```

### Criar Inscrição
```http
POST /user/inscricoes
```

**Request Body:**
```json
{
  "simposioId": "...",
  "subeventos": ["subeventoId1", "subeventoId2"]
}
```

### Meus Certificados
```http
GET /user/certificados
```

## 🎓 Endpoints de Avaliador

**Requer papel AVALIADOR**

### Trabalhos para Avaliar
```http
GET /avaliador/trabalhos
```

### Avaliar Trabalho
```http
POST /avaliador/trabalhos/:id/avaliar
```

**Request Body:**
```json
{
  "nota": 8.5,
  "parecer": "Trabalho bem desenvolvido..."
}
```

## 👨‍💼 Endpoints de Admin

**Requer papel ADMIN ou SUBADMIN**

### Gerenciamento de Simpósio

#### Inicializar Simpósio
```http
POST /admin/simposio/inicializar
```

**Request Body:**
```json
{
  "ano": 2025,
  "datasConfig": {
    "inscricaoParticipante": {
      "inicio": "2025-01-01T00:00:00Z",
      "fim": "2025-02-28T23:59:59Z"
    },
    "submissaoTrabalhos": {
      "inicio": "2025-01-15T00:00:00Z",
      "fim": "2025-03-15T23:59:59Z"
    },
    "prazoAvaliacao": {
      "inicio": "2025-03-16T00:00:00Z",
      "fim": "2025-04-30T23:59:59Z"
    },
    "notasAvaliacaoExterna": {
      "inicio": "2025-05-01T00:00:00Z",
      "fim": "2025-05-31T23:59:59Z"
    }
  }
}
```

#### Finalizar Simpósio
```http
POST /admin/simposio/finalizar
```

### Trabalhos

#### Listar Trabalhos
```http
GET /admin/trabalhos?ano=2025&page=1&limit=20&status=SUBMETIDO&busca=termo
```

**Query Parameters:**
- `ano` (number)
- `page` (number, default: 1)
- `limit` (number, default: 20)
- `status` (enum: SUBMETIDO, EM_AVALIACAO, ACEITO, REJEITADO, PUBLICADO)
- `busca` (string) - título, autor ou email

#### Atribuir Avaliador
```http
POST /admin/trabalhos/:id/atribuir-avaliador
```

**Request Body:**
```json
{
  "avaliadorId": "507f1f77bcf86cd799439011"
}
```

#### Revogar Avaliador
```http
POST /admin/trabalhos/:id/revogar-avaliador
```

### Participantes

#### Listar Participantes
```http
GET /admin/participantes?page=1&limit=20&tipo=SERVIDOR&busca=nome
```

**Query Parameters:**
- `page` (number)
- `limit` (number)
- `tipo` (enum: SERVIDOR, DISCENTE, EXTERNO)
- `busca` (string) - nome, CPF ou email

### Avaliadores

#### Listar Avaliadores
```http
GET /admin/avaliadores
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "_id": "...",
      "nome": "Prof. João Silva",
      "email": "joao@email.com"
    }
  ]
}
```

### Acervo

#### Listar Acervo (Admin)
```http
GET /admin/acervo?page=1&limit=20
```

#### Obter Acervo por ID
```http
GET /admin/acervo/:id
```

#### Criar Item no Acervo
```http
POST /admin/acervo
Content-Type: multipart/form-data
```

**Form Data:**
- `titulo` (string)
- `autores` (array de strings)
- `ano` (number)
- `palavras_chave` (array de strings)
- `arquivo` (file, PDF, max 50MB)

#### Atualizar Acervo
```http
PUT /admin/acervo/:id
Content-Type: multipart/form-data
```

#### Excluir Acervo (Soft Delete)
```http
DELETE /admin/acervo/:id
```

### Páginas Estáticas

#### Listar Todas as Páginas
```http
GET /admin/paginas
```

#### Obter Página por Slug
```http
GET /admin/paginas/:slug
```

#### Atualizar Página
```http
PUT /admin/paginas/:slug
Content-Type: multipart/form-data
```

**Form Data:**
- `conteudo` (string, HTML) - para conteúdo HTML
- `linkExterno` (string, URL) - para link externo
- `pdf` (file) - para upload de PDF

#### Remover PDF da Página
```http
DELETE /admin/paginas/:slug/remover-pdf
```

### Avaliações Externas

#### Listar Trabalhos para Avaliação Externa
```http
GET /admin/avaliacoes-externas?simposioId=...&page=1&limit=50&busca=termo
```

**Query Parameters:**
- `simposioId` (ObjectId)
- `page` (number, default: 1)
- `limit` (number, default: 50)
- `busca` (string)

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "_id": "...",
      "titulo": "Título do Trabalho",
      "autores": [...],
      "status": "ACEITO",
      "media": 8.5,
      "notaExterna": null,
      "grandeArea": { ... },
      "simposio": { ... }
    }
  ],
  "pagination": { ... }
}
```

#### Lançar Nota Externa
```http
POST /admin/avaliacoes-externas/:id
```

**Request Body:**
```json
{
  "notaExterna": 9.0
}
```

**Validações:**
- Nota deve estar entre 0 e 10
- Só pode lançar dentro da janela `notasAvaliacaoExterna`
- Trabalho deve estar ACEITO ou PUBLICADO

**Response (403 - Fora do Prazo):**
```json
{
  "success": false,
  "message": "Fora do prazo para lançamento de notas externas",
  "janela": {
    "inicio": "2025-05-01T00:00:00Z",
    "fim": "2025-05-31T23:59:59Z"
  }
}
```

#### Remover Nota Externa
```http
DELETE /admin/avaliacoes-externas/:id
```

## 📊 Modelos de Dados

### Trabalho
```typescript
{
  _id: ObjectId
  titulo: string
  autores: Array<{
    nome: string
    cpf?: string
    email?: string
  }>
  palavras_chave: string[]
  arquivo: string
  grandeArea: ObjectId (ref: GrandeArea)
  areaAtuacao: ObjectId (ref: AreaAtuacao)
  subarea: ObjectId (ref: Subarea)
  status: 'SUBMETIDO' | 'EM_AVALIACAO' | 'ACEITO' | 'REJEITADO' | 'PUBLICADO'
  atribuicoes: Array<{
    avaliador: ObjectId
    enviado_em: Date
    revogado_em?: Date
  }>
  avaliacoes: Array<{
    avaliador: ObjectId
    nota: number (0-10)
    parecer: string
    data: Date
  }>
  media: number | null
  notaExterna: number | null (0-10)
  qtd_enviados: number
  qtd_avaliados: number
  simposio: ObjectId (ref: Simposio)
  createdAt: Date
  updatedAt: Date
  deleted_at: Date | null
}
```

### Acervo
```typescript
{
  _id: ObjectId
  titulo: string
  autores: string[]
  ano: number
  palavras_chave: string[]
  arquivo: string
  createdAt: Date
  updatedAt: Date
  deleted_at: Date | null
}
```

### PaginasEstaticas
```typescript
{
  _id: ObjectId
  slug: string (unique)
  conteudo: string (HTML)
  linkExterno: string (URL)
  pdf: string (file path)
  createdAt: Date
  updatedAt: Date
}
```

### Participant
```typescript
{
  _id: ObjectId
  nome: string
  cpf: string
  email: string
  telefone: string
  tipo: 'SERVIDOR' | 'DISCENTE' | 'EXTERNO'
  createdAt: Date
  deleted_at: Date | null
}
```

## ⚠️ Códigos de Erro

| Código | Descrição |
|--------|-----------|
| 200 | Sucesso |
| 201 | Criado com sucesso |
| 400 | Requisição inválida |
| 401 | Não autenticado |
| 403 | Acesso negado / Fora do prazo |
| 404 | Recurso não encontrado |
| 409 | Conflito (ex: já existe) |
| 500 | Erro interno do servidor |

### Estrutura de Erro Padrão
```json
{
  "success": false,
  "message": "Descrição do erro",
  "error": "Detalhes técnicos (apenas em dev)"
}
```

## 📝 Notas Importantes

### Paginação
Todos os endpoints que retornam listas suportam paginação via query parameters:
- `page` (default: 1)
- `limit` (default: 20 ou 50 dependendo do endpoint)

### Soft Delete
Os modelos Trabalho, Acervo e Participant usam soft delete (campo `deleted_at`).
Itens deletados não aparecem em queries normais.

### Upload de Arquivos
Limites de tamanho:
- Trabalhos: 10MB
- Acervo: 50MB
- Páginas (PDF): 20MB

### Janelas Temporais
Várias operações só podem ser realizadas dentro de janelas configuradas no simpósio:
- Submissão de trabalhos
- Avaliação
- Lançamento de notas externas

### Auditoria
Ações administrativas importantes são registradas em logs de auditoria:
- Inicialização/finalização de simpósio
- Atribuição/revogação de avaliadores
- Lançamento de notas externas

## 🔧 Swagger UI

Acesse a documentação interativa em:
```
http://localhost:4000/api-docs
```

## 📞 Suporte

Para mais informações, consulte o código fonte ou entre em contato com a equipe de desenvolvimento.
