describe('Login Flow', () => {
  beforeEach(() => {
    cy.visit('/');
  });

  it('deve exibir a página de login', () => {
    cy.contains('Entrar').should('be.visible');
    cy.get('input[type="email"]').should('be.visible');
    cy.get('input[type="password"]').should('be.visible');
  });

  it('deve mostrar erro com credenciais inválidas', () => {
    cy.get('input[type="email"]').type('invalido@teste.com');
    cy.get('input[type="password"]').type('senhaerrada');
    cy.get('button[type="submit"]').click();
    
    // Aguarda mensagem de erro
    cy.contains('credenciais', { matchCase: false, timeout: 5000 }).should('be.visible');
  });

  it('deve fazer login com credenciais válidas de participante', () => {
    // Usando credenciais do seed
    cy.get('input[type="email"]').type('participante@teste.com');
    cy.get('input[type="password"]').type('Teste!234');
    cy.get('button[type="submit"]').click();
    
    // Verifica redirecionamento
    cy.url({ timeout: 10000 }).should('not.include', '/login');
    
    // Verifica token no localStorage
    cy.window().its('localStorage.accessToken').should('exist');
    
    // Verifica menu do usuário
    cy.get('.br-header').should('contain', 'Participante');
  });

  it('deve fazer login como admin e acessar dashboard', () => {
    cy.get('input[type="email"]').type('admin@teste.com');
    cy.get('input[type="password"]').type('Teste!234');
    cy.get('button[type="submit"]').click();
    
    cy.url({ timeout: 10000 }).should('not.include', '/login');
    
    // Navegar para dashboard
    cy.contains('Dashboard', { timeout: 5000 }).click();
    cy.url().should('include', '/admin/dashboard');
    cy.contains('Dashboard Administrativo').should('be.visible');
  });

  it('deve fazer logout com sucesso', () => {
    // Login
    cy.get('input[type="email"]').type('participante@teste.com');
    cy.get('input[type="password"]').type('Teste!234');
    cy.get('button[type="submit"]').click();
    
    cy.url({ timeout: 10000 }).should('not.include', '/login');
    
    // Logout
    cy.get('.br-header').within(() => {
      cy.contains('Sair', { timeout: 5000 }).click();
    });
    
    // Verifica que voltou para home
    cy.url().should('eq', Cypress.config().baseUrl + '/');
    
    // Token deve ser removido
    cy.window().its('localStorage.accessToken').should('not.exist');
  });
});
