describe('Submissão de Trabalho', () => {
  beforeEach(() => {
    // Login como participante
    cy.visit('/');
    cy.get('input[type="email"]').type('participante@teste.com');
    cy.get('input[type="password"]').type('Teste!234');
    cy.get('button[type="submit"]').click();
    cy.url({ timeout: 10000 }).should('not.include', '/login');
  });

  it('deve acessar página de submissão de trabalho', () => {
    cy.contains('Submeter Trabalho', { timeout: 5000 }).click();
    cy.url().should('include', '/submeter-trabalho');
    cy.contains('Submeter Novo Trabalho').should('be.visible');
  });

  it('deve validar campos obrigatórios', () => {
    cy.visit('/submeter-trabalho');
    
    // Tentar submeter sem preencher
    cy.get('button[type="submit"]').click();
    
    // Deve mostrar mensagens de validação HTML5
    cy.get('input:invalid').should('have.length.greaterThan', 0);
  });

  it('deve preencher formulário de trabalho completo', () => {
    cy.visit('/submeter-trabalho');
    
    // Preencher campos
    cy.get('input[name="titulo"]').type('Trabalho de Teste E2E - ' + Date.now());
    
    // Selecionar grande área (primeiro option disponível)
    cy.get('select').first().select(1);
    
    // Área de atuação
    cy.wait(500); // Aguarda carregamento de áreas
    cy.get('select').eq(1).select(1);
    
    // Tipo de trabalho
    cy.contains('label', 'Tipo').parent().find('select').select('ARTIGO');
    
    // Palavras-chave
    cy.get('input[placeholder*="palavra"]').type('teste, cypress, e2e');
    
    // Resumo
    cy.get('textarea[name="resumo"]').type('Este é um resumo de teste criado pelo Cypress para validação do fluxo de submissão de trabalhos no sistema.');
    
    // Co-autores
    cy.get('input[placeholder*="Nome"]').first().type('Co-autor Teste');
    cy.get('input[placeholder*="Email"]').first().type('coautor@teste.com');
    
    // Arquivo (simular upload)
    const fileName = 'trabalho-teste.pdf';
    cy.get('input[type="file"]').selectFile({
      contents: Cypress.Buffer.from('PDF simulado'),
      fileName: fileName,
      mimeType: 'application/pdf',
    }, { force: true });
    
    // Submeter
    cy.get('button[type="submit"]').click();
    
    // Verificar sucesso
    cy.contains('sucesso', { matchCase: false, timeout: 10000 }).should('be.visible');
  });

  it('deve visualizar trabalhos submetidos', () => {
    cy.contains('Meus Trabalhos', { timeout: 5000 }).click();
    cy.url().should('include', '/trabalhos');
    cy.contains('Meus Trabalhos').should('be.visible');
    
    // Verificar se tem tabela ou mensagem
    cy.get('body').should('contain.text', 'trabalho');
  });
});
