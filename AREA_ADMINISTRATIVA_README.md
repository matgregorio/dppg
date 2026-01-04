# Área Administrativa - Central de Gerenciamento do Sistema DPPG

## Descrição

A **Área Administrativa** é uma página centralizada que reúne todas as funcionalidades administrativas do sistema DPPG. Foi desenvolvida para facilitar o acesso dos administradores às diferentes áreas de gerenciamento através de uma interface visual moderna e intuitiva.

## Características

### 🎨 Interface Moderna
- Design limpo e organizado com cards coloridos
- Ícones intuitivos para cada seção
- Esquema de cores que facilita a identificação de diferentes categorias

### 🔍 Busca Inteligente
- Campo de busca integrado para localizar rapidamente funcionalidades
- Filtragem em tempo real por nome de seção ou ação
- Interface responsiva que se adapta a diferentes dispositivos

### 📱 Responsividade Total
- Layout otimizado para desktop, tablet e mobile
- Cards que se reorganizam automaticamente conforme o tamanho da tela
- Menu hamburguer intuitivo em dispositivos móveis

## Funcionalidades Disponíveis

A página está organizada em 20 seções principais:

### 1. **Área de Atuação**
Gerenciamento de áreas de conhecimento e atuação
- Cadastrar, mostrar, alterar e excluir áreas

### 2. **Subeventos**
Administração de subeventos do simpósio
- Gerenciar subeventos e listar participantes por subevento

### 3. **Grande Área**
Gerenciamento de grandes áreas do conhecimento
- CRUD completo de grandes áreas

### 4. **Acervo**
Gestão do acervo digital
- Adicionar e remover itens do acervo

### 5. **Filisar Dados**
Configuração de prazos e janelas de submissão
- Configurar prazos de inscrição, certificados, submissão e avaliação
- Importar notas de eventos externos

### 6. **Participantes**
Gerenciamento de participantes do evento
- Cadastro, listagem e geração de códigos de barra

### 7. **Cadastrar Avaliadores**
Administração de avaliadores
- Adicionar, visualizar e remover avaliadores

### 8. **Notas Avaliações Externas**
Importação de avaliações de eventos externos
- Adicionar, visualizar e excluir notas externas

### 9. **Páginas Estáticas**
Edição de conteúdo público do site
- Banner, formulários, avisos, normas e templates de e-mail

### 10. **Alterar Certificado**
Configuração de certificados
- Editar textos, assinaturas, logos e períodos

### 11. **Submissões**
Gerenciamento de trabalhos submetidos
- Adicionar/editar notas de apresentações
- Alterar status de submissões

### 12. **Sistema**
Funções de manutenção do sistema
- Backup e recuperação de dados

### 13. **Gerar PDF por Sub-Área**
Relatórios em PDF
- Gerar PDFs por sub-área ou tipo de trabalho

### 14. **Validar Certificados**
Sistema de validação de certificados
- Verificar autenticidade de certificados emitidos

### 15. **Simpósio**
Configuração geral do simpósio
- Gerenciar ciclo de vida e configurar datas

### 16. **Instituições**
Cadastro de instituições parceiras
- CRUD completo de instituições

### 17. **Docentes**
Gerenciamento de orientadores
- Cadastro e manutenção de docentes

### 18. **Apoio**
Gestão de apoios e patrocínios
- Adicionar, listar e editar apoios

### 19. **Funções Administrativas**
Operações críticas do sistema
- Promover usuários
- Finalizar simpósio
- Gerar certificados em lote

### 20. **Relatórios**
Visualização de estatísticas
- Dashboard com gráficos
- Estatísticas do evento

## Como Acessar

1. **Via Menu Lateral:**
   - Faça login como administrador
   - No menu lateral, clique em "🏛️ Área Administrativa"

2. **Via URL Direta:**
   - Acesse: `/area-administrativa`

## Permissões Necessárias

Para acessar a Área Administrativa, o usuário deve ter uma das seguintes roles:
- `ADMIN` (Administrador completo)
- `SUBADMIN` (Sub-administrador com permissões limitadas)

## Estrutura Técnica

### Arquivos Principais

```
frontend/src/pages/
├── AreaAdministrativa.jsx     # Componente principal
└── AreaAdministrativa.css     # Estilos customizados
```

### Roteamento

A rota está configurada em `App.jsx`:

```jsx
<Route
  path="/area-administrativa"
  element={
    <RequireAuth>
      <RequireRoles roles={['ADMIN', 'SUBADMIN']}>
        <AreaAdministrativa />
      </RequireRoles>
    </RequireAuth>
  }
/>
```

### Tecnologias Utilizadas

- **React** - Framework principal
- **React Router** - Navegação entre páginas
- **CSS3** - Estilização moderna com gradientes e animações
- **Font Awesome** - Ícones vetoriais
- **Design System Gov.BR** - Componentes do governo

## Estilização

### Cores das Seções

Cada seção possui uma cor específica para facilitar a identificação:

- 🟢 Verde (`#90EE90`) - Funcionalidades CRUD gerais
- 🔵 Azul (`#87CEEB`) - Cadastros específicos
- 🟡 Amarelo (`#FFD700`) - Configurações importantes
- 🔴 Rosa (`#FFB6C1`) - Funções administrativas críticas
- ⚪ Cinza (`#D3D3D3`) - Funções de sistema
- 🟣 Roxo (`#DDA0DD`) - Gestão de pessoas

### Botões de Ação

Os botões seguem um código de cores padrão:

- 🟢 **Success (Verde)** - Ações de criação/cadastro
- 🔵 **Primary (Azul)** - Ações de visualização
- 🟡 **Warning (Amarelo)** - Ações de edição
- 🔴 **Danger (Vermelho)** - Ações de exclusão
- 🔷 **Info (Ciano)** - Ações informativas
- ⚫ **Secondary (Cinza)** - Ações de sistema

## Busca e Filtros

O campo de busca permite filtrar funcionalidades por:
- Nome da seção
- Nome das ações disponíveis

A busca é case-insensitive e atualiza os resultados em tempo real.

## Boas Práticas de Uso

1. **Organização:** As seções estão agrupadas por tipo de funcionalidade
2. **Atalhos:** Use a busca para encontrar rapidamente o que precisa
3. **Responsabilidade:** Todas as ações administrativas são auditadas
4. **Backup:** Realize backups regulares antes de operações críticas
5. **Segurança:** Não compartilhe credenciais administrativas

## Informações Adicionais

### Rodapé Informativo

A página inclui três boxes informativos:

1. **Ajuda** - Informações sobre documentação e suporte
2. **Segurança** - Lembrete sobre auditoria de ações
3. **Backup** - Recomendação de backups regulares

## Desenvolvimento Futuro

Possíveis melhorias planejadas:

- [ ] Adicionar favoritos para acesso rápido
- [ ] Implementar histórico de ações recentes
- [ ] Adicionar atalhos de teclado
- [ ] Criar tour guiado para novos administradores
- [ ] Implementar notificações de tarefas pendentes
- [ ] Adicionar modo escuro

## Suporte

Em caso de dúvidas ou problemas:
- Consulte a documentação técnica do sistema
- Entre em contato com a equipe de desenvolvimento
- Verifique os logs de auditoria em caso de problemas

---

**Versão:** 1.0.0  
**Última Atualização:** Janeiro de 2026  
**Autor:** Sistema DPPG
