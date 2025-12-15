# 📜 Sistema de Certificados Personalizados

## ✨ Funcionalidades Implementadas

### 🎨 Design Personalizado
- Layout baseado no modelo fornecido (Minicurso Raízes de Valor)
- Bordas decorativas com ornamentos
- Logos personalizáveis (IF e Evento/DPPG)
- 3 assinaturas configuráveis com imagens
- QR Code para validação pública
- Texto institucional e dados formatados

### 📤 Upload de Imagens
- **Logos**: IF e Evento/DPPG
- **Assinaturas**: 3 assinaturas com imagens PNG/JPG
- **Configuração**: Nome e cargo para cada assinatura
- **Gerenciamento**: Upload, visualização e remoção de imagens

### 🔐 Validação Pública
- QR Code em cada certificado
- Página pública de validação: `/validar-certificado/{hash}`
- Exibição de informações do certificado
- Verificação de autenticidade

### 🔄 Regeneração de Certificados
- Regeneração individual ou em massa
- Aplicação automática das novas configurações
- Mantém hash de validação original

## 🛠️ Arquitetura

### Backend

#### Modelos
- **ConfiguracaoCertificado**: Armazena logos e assinaturas por simpósio
- **Certificado**: Mantém certificados e hash de validação

#### Controllers
- **certificadoConfigController.js**: Gerencia configurações, uploads e validação

#### Rotas
```javascript
// Admin
GET    /admin/simposios/:simposioId/certificados/configuracoes
PUT    /admin/simposios/:simposioId/certificados/configuracoes
POST   /admin/simposios/:simposioId/certificados/upload-imagem
DELETE /admin/simposios/:simposioId/certificados/remover-imagem
POST   /admin/simposios/:simposioId/certificados/regenerar-todos

// Público
GET    /public/validar-certificado/:hash
```

#### Serviço de Certificados
**certificadoService.js** - Geração de PDFs com:
- Bordas duplas decorativas
- Ornamentos nos cantos (❦)
- Linhas decorativas horizontais
- Cabeçalho com logos
- Título do evento
- Palavra "Certificado" em destaque
- Texto de certificação personalizado
- Data e local
- 3 assinaturas com nomes/cargos
- QR Code com hash de validação
- Ornamento central (❧)

### Frontend

#### Páginas
1. **AdminCertificadosConfig.jsx**
   - Upload de logos (IF, Evento/DPPG)
   - Upload de 3 assinaturas
   - Configuração de nomes e cargos
   - Botão para regenerar todos os certificados

2. **ValidarCertificado.jsx**
   - Validação pública por hash
   - Exibição de informações do certificado
   - Design responsivo

#### Rotas
```javascript
/admin/simposios/:ano/certificados     // Configuração
/validar-certificado/:hash             // Validação pública
```

## 📋 Estrutura do Certificado

### Layout
```
┌──────────────────────────────────────────────────────────────┐
│ ❦        ══════════════════════════════════════════       ❦ │
│                                                              │
│  [Logo IF]     Instituto Federal... Campus Rio Pomba  [Logo]│
│                                                              │
│                  ══════════════════════════════════          │
│                                                              │
│                     TÍTULO DO EVENTO                         │
│                                                              │
│                      Certificado                             │
│                                                              │
│  Certificamos que [NOME], participou com êxito do evento... │
│                                                              │
│                   Rio Pomba, 03/12/2025                      │
│                                                              │
│                                                              │
│  [Assinatura 1]     [Assinatura 2]     [Assinatura 3]      │
│  ──────────────     ──────────────     ──────────────        │
│   Nome 1               Nome 2              Nome 3           │
│   Cargo 1              Cargo 2             Cargo 3           │
│                                                              │
│                          ❧                                   │
│                                                              │
│ [QR Code]                                                    │
│ Verifique...                                                 │
│ ❦                                                         ❦ │
└──────────────────────────────────────────────────────────────┘
```

## 🚀 Como Usar

### 1. Configurar Certificados
1. Acesse **Admin > Simpósio {ano} > Certificados**
2. Faça upload das imagens:
   - Logo do IF (PNG/JPG, máx 5MB)
   - Logo do Evento/DPPG
   - 3 Assinaturas
3. Configure nomes e cargos
4. Salve as configurações

### 2. Regenerar Certificados
- Após alterar configurações, clique em **"Regenerar Todos os Certificados"**
- Todos os certificados existentes serão recriados com o novo layout

### 3. Validar Certificado
- Escaneie o QR Code do certificado OU
- Acesse `/validar-certificado/{hash}`
- Veja as informações do certificado validado

## 🎯 Tipos de Certificado

- **PARTICIPACAO**: Participação em subevento
- **APRESENTACAO**: Apresentação de trabalho
- **AVALIADOR**: Atuação como avaliador
- **PALESTRANTE**: Ministração de palestra
- **ORGANIZACAO**: Participação na organização

## 💾 Armazenamento

```
uploads/
├── certificados/
│   ├── {uuid}.pdf              # Certificados gerados
│   └── imagens/
│       ├── logoIF-{timestamp}.png
│       ├── logoEvento-{timestamp}.png
│       ├── assinatura1-{timestamp}.png
│       ├── assinatura2-{timestamp}.png
│       └── assinatura3-{timestamp}.png
```

## 🔒 Segurança

- ✅ Autenticação obrigatória para admin
- ✅ Validação de tipos de arquivo (apenas imagens)
- ✅ Limite de tamanho (5MB por imagem)
- ✅ Hash único para cada certificado
- ✅ Validação pública sem autenticação

## 📱 Responsivo

- Design adaptativo para diferentes tamanhos de tela
- QR Code otimizado para leitura
- Layout de certificado em PDF paisagem (A4)

## 🎨 Personalizações Disponíveis

### Por Simpósio
- Logos institucionais
- Logos do evento
- Assinaturas dos responsáveis
- Nomes e cargos

### Automático
- Data e local do evento
- Nome do participante
- Tipo de certificado
- Título do trabalho (se aplicável)
- Carga horária
- Hash de validação único

## ✅ Checklist de Implementação

- [x] Modelo de configuração no banco
- [x] Upload de imagens (logos e assinaturas)
- [x] Serviço de geração de PDF customizado
- [x] QR Code com validação
- [x] Página de validação pública
- [x] Interface admin para configuração
- [x] Regeneração em massa de certificados
- [x] Rotas e controllers
- [x] Integração com sistema existente

---

**Sistema pronto para uso!** 🎉
