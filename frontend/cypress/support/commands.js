// Comandos customizados do Cypress

// Comando para fazer login
Cypress.Commands.add('login', (email, senha) => {
  cy.visit('/');
  cy.get('input[type="email"]').type(email);
  cy.get('input[type="password"]').type(senha);
  cy.get('button[type="submit"]').click();
  cy.url().should('not.include', '/login');
  cy.window().its('localStorage.accessToken').should('exist');
});

// Comando para logout
Cypress.Commands.add('logout', () => {
  cy.get('.br-header').within(() => {
    cy.contains('Sair').click();
  });
  cy.url().should('include', '/');
});

// Comando para verificar se está autenticado
Cypress.Commands.add('checkAuthenticated', () => {
  cy.window().its('localStorage.accessToken').should('exist');
});
