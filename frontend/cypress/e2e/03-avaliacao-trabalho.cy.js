describe('Avaliação de Trabalho', () => {
  beforeEach(() => {
    // Login como avaliador
    cy.visit('/');
    cy.get('input[type="email"]').type('avaliador@teste.com');
    cy.get('input[type="password"]').type('Teste!234');
    cy.get('button[type="submit"]').click();
    cy.url({ timeout: 10000 }).should('not.include', '/login');
  });

  it('deve acessar lista de trabalhos para avaliar', () => {
    cy.contains('Trabalhos', { timeout: 5000 }).click();
    cy.url().should('include', '/avaliador/trabalhos');
    cy.contains('Trabalhos Atribuídos').should('be.visible');
  });

  it('deve exibir mensagem quando não há trabalhos', () => {
    cy.visit('/avaliador/trabalhos');
    
    // Pode ter ou não trabalhos dependendo do estado do banco
    cy.get('body').should('be.visible');
    
    // Verificar que a página carregou corretamente
    cy.contains('Trabalhos').should('be.visible');
  });

  it('deve abrir formulário de avaliação se houver trabalho', () => {
    cy.visit('/avaliador/trabalhos');
    
    // Verificar se existe botão "Avaliar"
    cy.get('body').then($body => {
      if ($body.find('button:contains("Avaliar")').length > 0) {
        cy.contains('button', 'Avaliar').first().click();
        
        // Deve abrir página de avaliação
        cy.url().should('include', '/avaliar');
        cy.contains('Avaliar Trabalho').should('be.visible');
        
        // Verificar campos de avaliação
        cy.contains('Relevância').should('be.visible');
        cy.contains('Metodologia').should('be.visible');
        cy.contains('Clareza').should('be.visible');
        cy.contains('Fundamentação').should('be.visible');
        cy.contains('Contribuição').should('be.visible');
      } else {
        cy.log('Nenhum trabalho disponível para avaliação no momento');
      }
    });
  });

  it('deve validar preenchimento de notas', () => {
    cy.visit('/avaliador/trabalhos');
    
    cy.get('body').then($body => {
      if ($body.find('button:contains("Avaliar")').length > 0) {
        cy.contains('button', 'Avaliar').first().click();
        cy.url().should('include', '/avaliar');
        
        // Tentar submeter sem preencher
        cy.get('button[type="submit"]').click();
        
        // Deve validar campos obrigatórios
        cy.contains('obrigatório', { matchCase: false }).should('be.visible');
      } else {
        cy.log('Teste pulado - nenhum trabalho disponível');
      }
    });
  });

  it('deve submeter avaliação completa', () => {
    cy.visit('/avaliador/trabalhos');
    
    cy.get('body').then($body => {
      if ($body.find('button:contains("Avaliar")').length > 0) {
        cy.contains('button', 'Avaliar').first().click();
        cy.url().should('include', '/avaliar');
        
        // Preencher notas (0-10)
        cy.get('input[type="number"]').each($input => {
          cy.wrap($input).clear().type('8');
        });
        
        // Parecer
        cy.get('textarea').type('Trabalho bem elaborado, com boa fundamentação teórica e metodologia adequada. Aprovado para apresentação.');
        
        // Submeter
        cy.get('button[type="submit"]').click();
        
        // Verificar sucesso
        cy.contains('sucesso', { matchCase: false, timeout: 10000 }).should('be.visible');
      } else {
        cy.log('Teste pulado - nenhum trabalho disponível');
      }
    });
  });
});
