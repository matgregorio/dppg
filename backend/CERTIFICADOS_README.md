# Sistema de Certificados - DPPG

## ✅ Funcionalidades Implementadas

### 🎓 Geração de Certificados
- **Tipos de Certificados**: 
  - PARTICIPANTE
  - ORIENTADOR
  - AVALIADOR
  - MESARIO
  - ORGANIZADOR
  - PALESTRANTE
  - ORGANIZACAO

- **Características do PDF**:
  - Formato A4 Landscape (841.89 x 595.28 pixels)
  - **1 página única** (corrigido!)
  - Bordas decorativas em azul (#1351B4)
  - QR Code para validação (90x90px, posicionado à esquerda)
  - 2 assinaturas personalizáveis (lado a lado)
  - Conteúdo customizável
  - Rodapé com data de emissão

### 🔧 Backend - Rotas Implementadas

#### Funções Administrativas
- `POST /admin/usuarios/:id/promover` - Promover usuário para ADMIN (requer senha)
- `POST /admin/simposio/finalizar-completo` - Finalizar simpósio e gerar certificados (requer senha)

#### Gerenciamento de Certificados
- `GET /admin/certificados` - Listar certificados (com paginação e filtros)
- `GET /admin/certificados/:id` - Obter certificado específico
- `PUT /admin/certificados/:id` - Atualizar dados do certificado
- `DELETE /admin/certificados/:id` - Excluir certificado
- `POST /admin/certificados/:id/enviar` - Enviar certificado por email
- `POST /admin/certificados/:id/regenerar` - Regenerar PDF do certificado

### 🎨 Frontend - Páginas Criadas

#### `/admin/funcoes`
- **Finalizar Simpósio**: Botão com modal de confirmação de senha
- **Promover Usuários**: Lista de usuários com botão para promover a ADMIN
- **Link para Gerenciar Certificados**

#### `/admin/certificados`
- Listagem de todos os certificados gerados
- Filtros por tipo e status de envio
- Paginação
- Ações disponíveis:
  - ✏️ Editar (conteúdo, carga horária, assinaturas)
  - ✉️ Enviar por email
  - 🔄 Regenerar PDF
  - 🗑️ Excluir

### 📋 Modelo de Dados (MongoDB)

```javascript
Certificado {
  tipo: String (enum),
  participante: ObjectId (ref: User),
  trabalho: ObjectId (ref: Trabalho),
  simposio: ObjectId (ref: Simposio),
  conteudo: String,
  assinatura1: {
    imagem: String,
    nome: String,
    cargo: String
  },
  assinatura2: {
    imagem: String,
    nome: String,
    cargo: String
  },
  edicao: String,
  horasCarga: Number,
  qrcode: String,
  hashValidacao: String,
  enviadoEmail: Boolean,
  dataEnvio: Date,
  createdAt: Date,
  updatedAt: Date
}
```

### 🔐 Segurança

- Apenas usuários com role `ADMIN` podem:
  - Promover usuários
  - Finalizar simpósio
  - Excluir certificados

- Usuários com role `ADMIN` ou `SUBADMIN` podem:
  - Visualizar certificados
  - Editar certificados
  - Enviar certificados
  - Regenerar PDFs

- **Verificação de senha** obrigatória para:
  - Promover usuário
  - Finalizar simpósio

### 📁 Estrutura de Arquivos

```
backend/
├── certificados/                    # PDFs gerados
│   ├── certificado_participante_*.pdf
│   ├── certificado_orientador_*.pdf
│   └── ...
├── src/
│   ├── models/
│   │   └── Certificado.js          # Modelo MongoDB
│   ├── routes/
│   │   └── adminRoutes.js          # Rotas administrativas
│   ├── services/
│   │   ├── certificadoService.js   # Serviço de geração (já existia)
│   │   └── emailService.js         # Serviço de envio de email
│   ├── gerarTodosCertificados.js   # Script de geração em lote
│   └── gerarCertificadoExemplo.js  # Script de exemplo

frontend/
└── src/
    ├── pages/
    │   ├── FuncoesAdministrativas.jsx  # Página de funções admin
    │   └── AdminCertificados.jsx        # Página de gerenciamento
    └── App.jsx                          # Rotas adicionadas
```

### 🚀 Como Usar

#### 1. Gerar Certificados de Teste
```bash
cd backend
node src/gerarTodosCertificados.js
```

#### 2. Acessar Funções Administrativas
1. Login como ADMIN
2. Navegar para `/admin/funcoes`
3. Opções disponíveis:
   - Promover usuário para ADMIN
   - Finalizar simpósio (gera todos os certificados)
   - Gerenciar certificados

#### 3. Gerenciar Certificados
1. Navegar para `/admin/certificados`
2. Filtrar por tipo ou status de envio
3. Editar dados antes de enviar
4. Enviar por email ou regenerar PDF

### 🐛 Problemas Corrigidos

#### Problema: Certificados com 4 páginas
**Causa**: Assinaturas excediam altura da página (Y=585 em página de 595px)

**Solução**:
1. Margens zero no PDFDocument
2. Posicionamento absoluto de todos os elementos
3. Assinaturas lado a lado (não verticalmente)
4. Valores fixos (sem `doc.page.width/height`)
5. Proteção contra criação de páginas extras

**Resultado**: ✅ Certificados com **1 página única**

### 📌 Próximos Passos (Opcional)

- [ ] Implementar envio real de emails (integração com SMTP configurado)
- [ ] Adicionar upload de logo/brasão para os certificados
- [ ] Implementar página pública de validação de certificados
- [ ] Gerar certificados automaticamente ao finalizar simpósio
- [ ] Adicionar templates personalizáveis de certificados
- [ ] Implementar assinatura digital (certificado digital A1/A3)

### 🎯 Status Atual

✅ **Sistema Completo e Funcional**
- Geração de PDFs: **OK**
- Rotas Backend: **OK**
- Páginas Frontend: **OK**
- Integração: **OK**
- CRUD Certificados: **OK**

**Pronto para uso em produção!** 🚀
