# 🎓 Ciclo de Vida dos Simpósios

## 📋 Visão Geral

Sistema completo para gerenciar o ciclo de vida de múltiplos simpósios, permitindo que o sistema funcione continuamente através dos anos sem necessidade de reinicialização manual ou perda de dados históricos.

## ✨ Funcionalidades

### 1. **Iniciar Novo Simpósio** 🚀

Permite criar um novo simpósio com todas as informações necessárias:

- **Ano do Simpósio**: Ano de realização (validação automática de duplicidade)
- **Tema**: Tema principal do simpósio
- **Datas do Evento**: Período de realização do simpósio
- **Datas de Submissão**: Período para submissão de trabalhos (opcional)
- **Datas de Inscrição**: Período para inscrições de participantes (opcional)
- **Notificação por E-mail**: Opção para enviar e-mail automático anunciando o novo simpósio

#### E-mail de Anúncio 📧

Quando ativada a opção de enviar e-mail, todos os usuários com e-mail verificado receberão uma **linda notificação personalizada** contendo:

- Tema e ano do simpósio
- Todas as datas importantes formatadas
- Design moderno com cores do GOV.BR
- Call-to-action para acessar o sistema
- Layout responsivo e profissional

**Template do E-mail inclui:**
- Header com gradiente azul elegante
- Card destacado com o tema do simpósio
- Seção de datas importantes com ícones
- Botão de ação com efeito visual
- Dicas e mensagem de encerramento
- Footer padronizado

### 2. **Finalizar Simpósio** 🏁

Permite encerrar e arquivar um simpósio:

- **Confirmação de Segurança**: Modal com aviso de ação irreversível
- **Marcação de Finalizado**: Simpósio é marcado como finalizado e arquivado
- **Data de Finalização**: Registra automaticamente quando foi finalizado
- **Proteção de Dados**: Simpósios finalizados não podem ser editados

### 3. **Visualização de Status** 📊

Sistema inteligente de badges de status:

- 🔴 **Finalizado**: Simpósio encerrado e arquivado
- 🔵 **Aguardando Início**: Simpósio criado mas ainda não começou
- 🟢 **Em Andamento**: Simpósio acontecendo no momento
- 🟡 **Encerrado (não finalizado)**: Simpósio passou da data mas não foi arquivado

### 4. **Interface Moderna** 💫

- Cards coloridos com indicadores visuais
- Informações organizadas e de fácil leitura
- Mensagens informativas e dicas contextuais
- Design seguindo padrões GOV.BR
- Responsivo para todos os dispositivos

## 🛠️ Arquitetura Técnica

### Backend

#### Novos Endpoints

```javascript
POST   /api/v1/admin/simposios                  // Criar novo simpósio
POST   /api/v1/admin/simposios/:id/finalizar    // Finalizar simpósio
GET    /api/v1/admin/simposios/:ano             // Buscar simpósio por ano
PUT    /api/v1/admin/simposios/:ano             // Atualizar simpósio
GET    /api/v1/public/simposios                 // Listar todos (público)
```

#### Controller: `simposioController.js`

Funções implementadas:
- `criarSimposio()`: Validação, criação e envio de e-mails
- `finalizarSimposio()`: Marca simpósio como finalizado
- `getSimposioPorAno()`: Busca por ano específico
- `atualizarSimposio()`: Atualiza dados (apenas não finalizados)
- `listarSimposios()`: Lista todos os simpósios

#### Modelo Atualizado: `Simposio.js`

Novos campos adicionados:
```javascript
{
  tema: String,                    // Tema do simpósio
  finalizado: Boolean,             // Flag de finalização
  dataInicio: Date,                // Data de início do evento
  dataFim: Date,                   // Data de término do evento
  dataInicioSubmissoes: Date,      // Início das submissões
  dataFimSubmissoes: Date,         // Fim das submissões
  dataInicioInscricoes: Date,      // Início das inscrições
  dataFimInscricoes: Date,         // Fim das inscrições
  dataFinalizacao: Date,           // Quando foi finalizado
}
```

#### Serviço de E-mail: `emailService.js`

Nova função `enviarNovoSimposio()`:
- Template HTML moderno e responsivo
- Gradientes e cores GOV.BR
- Formatação automática de datas
- Seções condicionais baseadas em dados
- Design profissional com ícones e espaçamento adequado

### Frontend

#### Nova Página: `AdminCicloSimposio.jsx`

Componentes principais:
- Lista de todos os simpósios (cards)
- Modal de criação de novo simpósio
- Modal de confirmação de finalização
- Sistema de badges de status
- Formulário completo com validação

#### Recursos da Interface:

**1. Lista de Simpósios**
- Cards coloridos com borda lateral indicativa
- Informações organizadas em grid responsivo
- Botões de ação contextuais
- Status visual claro

**2. Modal de Novo Simpósio**
- Formulário em seções organizadas
- Validação de campos obrigatórios
- Campos opcionais claramente identificados
- Checkbox para envio de e-mail
- Mensagem de aviso sobre envio de e-mails
- Botão com loading durante processamento

**3. Modal de Finalização**
- Aviso destacado sobre ação irreversível
- Resumo das informações do simpósio
- Confirmação explícita necessária
- Botão com loading durante processamento

#### Navegação

Nova opção no menu de administração:
- **Ciclo de Vida**: Acesso rápido ao gerenciamento

Localização: Menu Admin > Ciclo de Vida

## 📱 Fluxo de Uso

### Criando um Novo Simpósio

1. Acesse **Admin > Ciclo de Vida**
2. Clique em **Iniciar Novo Simpósio**
3. Preencha as informações:
   - Ano (auto-incrementado baseado no último)
   - Tema do simpósio
   - Datas do evento (obrigatório)
   - Datas de submissão (opcional)
   - Datas de inscrição (opcional)
4. Marque se deseja enviar e-mail de notificação
5. Clique em **Criar e Iniciar Simpósio**
6. ✅ Simpósio criado! E-mails enviados (se selecionado)

### Finalizando um Simpósio

1. Na lista de simpósios, localize o simpósio desejado
2. Clique no botão **Finalizar**
3. Leia o aviso sobre a ação irreversível
4. Confirme os dados do simpósio
5. Clique em **Sim, Finalizar Simpósio**
6. ✅ Simpósio arquivado!

## 🎨 Design e UX

### Cores e Badges

- **Verde (#168821)**: Simpósio ativo/em andamento
- **Vermelho (#c92a2a)**: Simpósio finalizado
- **Azul (#1351B4)**: Informações e simpósio aguardando
- **Amarelo (#ffc107)**: Avisos e simpósio encerrado

### Ícones Utilizados

- 🎓 Simpósio
- 📅 Datas
- 📧 E-mail
- 🚀 Iniciar
- 🏁 Finalizar
- ⚙️ Configurar
- ℹ️ Informação
- ⚠️ Aviso

### Mensagens Informativas

- Dicas contextuais sobre funcionalidades
- Avisos claros sobre ações irreversíveis
- Confirmações de sucesso
- Mensagens de erro descritivas

## 🔐 Segurança

### Validações Backend

- ✅ Verificação de ano duplicado
- ✅ Validação de datas (fim > início)
- ✅ Proteção contra edição de simpósios finalizados
- ✅ Autenticação e autorização (ADMIN/SUBADMIN)
- ✅ Validação de campos obrigatórios

### Validações Frontend

- ✅ Campos obrigatórios marcados
- ✅ Tipos de input adequados (date, number)
- ✅ Limites de ano (2020-2099)
- ✅ Confirmação para ações destrutivas
- ✅ Feedback visual de processamento

## 📊 Compatibilidade

### Retrocompatibilidade

O sistema mantém compatibilidade com o código existente:

- ✅ Rotas antigas ainda funcionam
- ✅ Campo `datasConfig` ainda suportado
- ✅ Campos novos são opcionais
- ✅ Validações adaptadas para campos existentes

### Integração com Sistema Existente

- ✅ Trabalha em conjunto com AdminSimposio
- ✅ Não quebra funcionalidades existentes
- ✅ Adiciona camada de gerenciamento sem impactar código legado

## 🚀 Benefícios

### Para Administradores

1. **Gestão Multi-Anual**: Gerencia múltiplos simpósios facilmente
2. **Histórico Completo**: Mantém registro de todos os simpósios
3. **Comunicação Automática**: E-mails automatizados para participantes
4. **Interface Intuitiva**: Fácil de usar e entender
5. **Segurança**: Proteções contra perda acidental de dados

### Para Participantes

1. **Notificações Automáticas**: Recebem avisos de novos simpósios
2. **Informações Claras**: E-mails com todas as datas importantes
3. **Acesso Fácil**: Link direto para o sistema

### Para o Sistema

1. **Escalabilidade**: Suporta infinitos simpósios
2. **Manutenibilidade**: Código organizado e documentado
3. **Extensibilidade**: Fácil adicionar novos recursos
4. **Performance**: Queries otimizadas com índices

## 📝 Exemplo de E-mail Enviado

O e-mail enviado possui:

**Header:**
- Gradiente azul elegante
- Título do simpósio em destaque
- Linha decorativa

**Corpo:**
- Saudação personalizada
- Anúncio do novo simpósio
- Card com tema em destaque
- Datas importantes organizadas:
  - Período do evento (destaque azul)
  - Submissões (se configurado)
  - Inscrições (se configurado)

**Call-to-Action:**
- Botão estilizado para acessar sistema
- Link para frontend

**Footer:**
- Dica sobre adicionar ao calendário
- Mensagem da equipe
- Informações de copyright

## 🎯 Próximos Passos Sugeridos

- [ ] Dashboard com estatísticas por simpósio
- [ ] Exportação de dados históricos
- [ ] Templates de e-mail customizáveis
- [ ] Relatórios comparativos entre simpósios
- [ ] Clone de configurações de simpósios anteriores
- [ ] Sistema de lembretes automáticos por data

## 💡 Dicas de Uso

1. **Planejamento**: Configure todas as datas logo na criação
2. **Comunicação**: Use a opção de e-mail para manter todos informados
3. **Organização**: Finalize simpósios antigos para manter a lista limpa
4. **Backup**: Sempre verifique as informações antes de finalizar

---

**Desenvolvido com 💙 usando GOV.BR Design System**
