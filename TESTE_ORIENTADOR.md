# Como Testar o Sistema de Aprovação do Orientador

## 📋 Pré-requisitos

O orientador de teste já foi criado no banco de dados com as seguintes credenciais:

**Email:** orientador@teste.com  
**Senha:** 123456

## 🎯 Passos para Testar

### 1. Criar/Submeter um Trabalho

Primeiro, você precisa ter um trabalho no sistema. Você pode:

**Opção A - Submeter um novo trabalho:**
1. Faça login como participante (ou crie uma conta)
2. Acesse "Submeter Trabalho" no menu
3. Preencha o formulário completo incluindo:
   - Título
   - Resumo (mínimo 100 caracteres)
   - Autores
   - Palavras-chave
   - Tipo de Projeto (Pesquisa/Extensão/Ensino)
   - **Orientador: Prof. Dr. João Silva** (use o autocomplete)
   - Área de Atuação
   - Subárea
   - Arquivo PDF
4. Submeta o trabalho

**Opção B - Atribuir trabalhos existentes ao orientador:**
```bash
cd backend
node src/utils/atribuirTrabalhosOrientador.js
```

### 2. Acessar como Orientador

1. Faça logout se estiver logado
2. Faça login com as credenciais do orientador:
   - Email: `orientador@teste.com`
   - Senha: `123456`
3. No menu lateral, você verá uma nova seção **"Orientador"**
4. Clique em **"Trabalhos Orientados"**

### 3. Visualizar Trabalhos Pendentes

Na página `/orientador/trabalhos` você verá:
- **Estatísticas:** Aguardando Avaliação, Aprovados, Reprovados, Total
- **Filtro por status:** Para filtrar trabalhos
- **Lista de trabalhos:** Com título, autor, subárea, status e data

### 4. Avaliar um Trabalho

1. Clique no botão de visualizar (ícone de olho) em um trabalho
2. Você será direcionado para `/orientador/trabalhos/:id`
3. Nesta página você verá:
   - **Informações completas do trabalho:**
     - Título
     - Resumo
     - Autores
     - Palavras-chave
     - Tipo de Projeto
     - Subárea
     - Data de submissão
   - **Botão para baixar o arquivo PDF**
   - **Formulário de avaliação:**
     - Opção: Aprovar ou Reprovar
     - Campo de comentários (obrigatório, mínimo 10 caracteres)

4. Escolha **Aprovar** ou **Reprovar**
5. Deixe seus comentários
6. Clique em **"Aprovar Trabalho"** ou **"Reprovar Trabalho"**

### 5. Verificar o Resultado

Após a avaliação:
- O trabalho terá seu status atualizado
- O aluno receberá um email com o parecer
- Você será redirecionado para a lista de trabalhos
- O trabalho não poderá mais ser editado (exibirá o parecer anterior)

### 6. Verificar no Painel Admin

1. Faça login como administrador
2. Acesse **"Trabalhos"** no menu
3. Observe que:
   - Trabalhos **AGUARDANDO_ORIENTADOR**: Botão de atribuir avaliador está **desabilitado**
   - Trabalhos **REPROVADO_ORIENTADOR**: Botão de atribuir avaliador está **desabilitado**
   - Trabalhos **APROVADO** (EM_AVALIACAO): Botão de atribuir avaliador está **habilitado**

## 🔄 Fluxo Completo

```
1. ALUNO submete trabalho
   ↓
   Status: AGUARDANDO_ORIENTADOR
   ↓
2. ORIENTADOR recebe notificação
   ↓
3. ORIENTADOR avalia trabalho
   ↓
   ┌─────────────────┬─────────────────┐
   │    APROVADO     │    REPROVADO    │
   └─────────────────┴─────────────────┘
          ↓                   ↓
   Status: EM_AVALIACAO   Status: REPROVADO_ORIENTADOR
          ↓                   ↓
   Admin pode atribuir   Admin NÃO pode atribuir
   avaliadores externos  avaliadores
```

## 🧪 Scripts Úteis

### Criar novo orientador
```bash
cd backend
node src/utils/criarOrientadorTeste.js
```

### Atribuir trabalhos ao orientador
```bash
cd backend
node src/utils/atribuirTrabalhosOrientador.js
```

### Resetar status de trabalhos
Para colocar trabalhos de volta em "AGUARDANDO_ORIENTADOR":
```javascript
// No MongoDB Compass ou mongosh
db.trabalhos.updateMany(
  { orientador: ObjectId("ID_DO_ORIENTADOR") },
  { 
    $set: { 
      status: "AGUARDANDO_ORIENTADOR",
      parecerOrientador: null
    } 
  }
)
```

## 📧 Email de Parecer

Quando o orientador avaliar um trabalho, o aluno receberá um email com:
- Título do trabalho
- Decisão do orientador (Aprovado/Reprovado)
- Comentários do orientador
- Data da avaliação

## ✅ Checklist de Teste

- [ ] Login como orientador funciona
- [ ] Menu mostra seção "Orientador"
- [ ] Lista de trabalhos carrega corretamente
- [ ] Estatísticas são exibidas
- [ ] Filtro por status funciona
- [ ] Detalhes do trabalho são exibidos
- [ ] Download do arquivo funciona
- [ ] Formulário de avaliação valida campos obrigatórios
- [ ] Aprovação atualiza status para EM_AVALIACAO
- [ ] Reprovação atualiza status para REPROVADO_ORIENTADOR
- [ ] Trabalho avaliado não pode ser reavaliado
- [ ] Admin não pode atribuir avaliadores antes da aprovação
- [ ] Email é enviado ao aluno (verificar logs)
