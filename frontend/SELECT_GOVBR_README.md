# Componentes Select - GOV.BR Design System

Este projeto implementa corretamente o padrão de Select do GOV.BR Design System, seguindo as especificações oficiais disponíveis em: https://www.gov.br/ds/components/select

## 📦 Componentes Disponíveis

### 1. **FormSelect** - Para formulários com React Hook Form

Localização: `src/components/forms/FormSelect.jsx`

Componente integrado com **React Hook Form** e **Zod** para validação. Ideal para formulários completos.

**Uso:**
```jsx
import { FormProvider, useForm } from 'react-hook-form';
import { FormSelect } from '../components/forms';

// Dentro do componente
const methods = useForm();

<FormProvider {...methods}>
  <form>
    <FormSelect
      name="instituicao"
      label="Instituição"
      required
      options={instituicoes.map(i => ({ 
        value: i._id, 
        label: i.nome 
      }))}
      placeholder="Selecione uma instituição"
    />
  </form>
</FormProvider>
```

**Props:**
- `name` (string, obrigatório) - Nome do campo para React Hook Form
- `label` (string) - Label do campo
- `options` (array) - Array de objetos `[{ value, label }]`
- `placeholder` (string) - Texto quando nenhuma opção está selecionada
- `required` (boolean) - Se o campo é obrigatório
- `disabled` (boolean) - Se o campo está desabilitado
- `validation` (object) - Regras adicionais de validação do RHF

### 2. **SelectGovBR** - Para filtros e controles simples

Localização: `src/components/SelectGovBR.jsx`

Componente standalone para uso em filtros, toolbars e outros controles que não precisam de React Hook Form.

**Uso:**
```jsx
import SelectGovBR from '../components/SelectGovBR';

<SelectGovBR
  id="filtroTipo"
  label="Tipo"
  value={filtros.tipo}
  onChange={(e) => setFiltros({ ...filtros, tipo: e.target.value })}
  options={[
    { value: '', label: 'Todos' },
    { value: 'ATIVO', label: 'Ativo' },
    { value: 'INATIVO', label: 'Inativo' },
  ]}
/>
```

**Props:**
- `id` (string, obrigatório) - ID único do select
- `label` (string) - Label do campo
- `value` (string) - Valor atual
- `onChange` (function) - Callback de mudança `(event) => void`
- `options` (array) - Array de objetos `[{ value, label }]`
- `placeholder` (string) - Texto padrão
- `disabled` (boolean) - Se está desabilitado
- `className` (string) - Classes CSS adicionais

## 🎨 Estrutura HTML Gerada

Ambos os componentes geram a estrutura completa do GOV.BR Design System:

```html
<div class="br-select">
  <div class="br-input">
    <label for="nome-input">Label do Campo</label>
    <input 
      id="nome-input" 
      type="text" 
      placeholder="Selecione..." 
      readonly 
    />
    <button 
      class="br-button" 
      type="button" 
      data-trigger="data-trigger"
    >
      <i class="fas fa-angle-down"></i>
    </button>
  </div>
  
  <div class="br-list" tabindex="0">
    <div class="br-item">
      <div class="br-radio">
        <input id="opcao-1" type="radio" name="nome-radio" value="valor1" />
        <label for="opcao-1">Opção 1</label>
      </div>
    </div>
    <!-- Mais opções... -->
  </div>
</div>
```

## ⚙️ Inicialização JavaScript

Os componentes inicializam automaticamente a biblioteca JavaScript do GOV.BR (`window.core.BRSelect`) quando montados.

### Requisitos:

1. **core.min.js** deve estar carregado no HTML:
```html
<script src="/govbr-ds-dev-core/dist/core.min.js"></script>
```

2. **CSS do GOV.BR** deve estar incluído:
```html
<link rel="stylesheet" href="/govbr-ds-dev-core/dist/core.min.css" />
```

## 🔄 Migração de Selects Antigos

### De select HTML nativo:

**Antes:**
```jsx
<div className="br-select">
  <label htmlFor="tipo">Tipo</label>
  <select id="tipo" value={tipo} onChange={handleChange}>
    <option value="">Selecione...</option>
    <option value="A">Opção A</option>
    <option value="B">Opção B</option>
  </select>
</div>
```

**Depois (com React Hook Form):**
```jsx
<FormSelect
  name="tipo"
  label="Tipo"
  options={[
    { value: 'A', label: 'Opção A' },
    { value: 'B', label: 'Opção B' },
  ]}
  placeholder="Selecione..."
/>
```

**Depois (sem React Hook Form):**
```jsx
<SelectGovBR
  id="tipo"
  label="Tipo"
  value={tipo}
  onChange={(e) => setTipo(e.target.value)}
  options={[
    { value: 'A', label: 'Opção A' },
    { value: 'B', label: 'Opção B' },
  ]}
  placeholder="Selecione..."
/>
```

## 📝 Exemplos Práticos

### Exemplo 1: Select com dados da API

```jsx
const [instituicoes, setInstituicoes] = useState([]);

useEffect(() => {
  api.get('/instituicoes').then(res => {
    setInstituicoes(res.data.data);
  });
}, []);

<SelectGovBR
  id="instituicao"
  label="Instituição"
  value={instituicaoId}
  onChange={(e) => setInstituicaoId(e.target.value)}
  options={[
    { value: '', label: 'Selecione uma instituição...' },
    ...instituicoes.map(i => ({
      value: i._id,
      label: i.nome
    }))
  ]}
/>
```

### Exemplo 2: Select dependente (Cascading)

```jsx
const grandeAreaSelecionada = watch('grandeArea');
const subareasFiltradas = subareas.filter(
  s => s.grandeArea === grandeAreaSelecionada
);

<FormSelect
  name="grandeArea"
  label="Grande Área"
  required
  options={grandesAreas.map(ga => ({
    value: ga._id,
    label: ga.nome
  }))}
/>

<FormSelect
  name="subarea"
  label="Subárea"
  required
  disabled={!grandeAreaSelecionada}
  options={subareasFiltradas.map(sa => ({
    value: sa._id,
    label: sa.nome
  }))}
/>
```

### Exemplo 3: Select em Modal

```jsx
// Adicionar useEffect para inicializar após modal abrir
useEffect(() => {
  if (isOpen && window.core?.BRSelect) {
    setTimeout(() => {
      const selects = document.querySelectorAll('.br-modal .br-select');
      selects.forEach(el => {
        if (!el.getAttribute('data-initialized')) {
          new window.core.BRSelect('br-select', el);
          el.setAttribute('data-initialized', 'true');
        }
      });
    }, 100);
  }
}, [isOpen]);
```

## 🐛 Troubleshooting

### Select não abre ao clicar

**Causa:** JavaScript do GOV.BR não foi carregado ou inicializado.

**Solução:** Verifique se `window.core.BRSelect` está disponível no console do navegador.

### Opções não aparecem

**Causa:** Array de opções vazio ou formato incorreto.

**Solução:** Garanta que `options` é um array de objetos `[{ value, label }]`.

### Valor não atualiza no formulário

**Causa:** Nome do campo não corresponde ao schema do Zod.

**Solução:** Verifique se o `name` no `FormSelect` corresponde ao campo no schema de validação.

### Select fica "cortado" em modal

**Causa:** `overflow: hidden` no container do modal.

**Solução:** Adicione `overflow: visible` ao `.br-modal-body` ou use `position: fixed` no `.br-list`.

## 📚 Referências

- [Documentação Oficial GOV.BR - Select](https://www.gov.br/ds/components/select)
- [React Hook Form](https://react-hook-form.com/)
- [Zod](https://zod.dev/)

## ✅ Arquivos Atualizados

- ✅ `src/components/forms/FormSelect.jsx` - Componente com RHF
- ✅ `src/components/SelectGovBR.jsx` - Componente standalone
- ✅ `src/components/modals/RegisterModal.jsx` - Migrado para novo padrão
- ✅ `src/pages/AdminCertificados.jsx` - Migrado para SelectGovBR
- ✅ `src/pages/AdminAcervo.jsx` - Migrado para SelectGovBR
- ✅ `src/components/modals/EditarTrabalhoModal.jsx` - Migrado para SelectGovBR
- ✅ `src/components/QRScanner.jsx` - Migrado para SelectGovBR
- ✅ `src/pages/AdminAreas.jsx` - Já usa FormSelect corretamente
- ✅ `src/pages/AdminDocentes.jsx` - Já usa FormSelect corretamente
