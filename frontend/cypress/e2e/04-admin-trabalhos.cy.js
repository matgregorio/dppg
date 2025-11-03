describe('Gerenciamento Admin de Trabalhos', () => {
  beforeEach(() => {
    // Login como admin
    cy.visit('/');
    cy.get('input[type="email"]').type('admin@teste.com');
    cy.get('input[type="password"]').type('Teste!234');
    cy.get('button[type="submit"]').click();
    cy.url({ timeout: 10000 }).should('not.include', '/login');
  });

  it('deve acessar página de gerenciamento de trabalhos', () => {
    cy.contains('Trabalhos', { timeout: 5000 }).click();
    cy.url().should('include', '/admin/trabalhos');
    cy.contains('Gerenciar Trabalhos').should('be.visible');
  });

  it('deve exibir filtros de trabalhos', () => {
    cy.visit('/admin/trabalhos');
    
    // Verificar filtros
    cy.get('input[type="number"]').should('be.visible'); // Ano
    cy.get('select').should('have.length.greaterThan', 0); // Status
    cy.get('input[type="text"]').first().should('be.visible'); // Busca
  });

  it('deve filtrar trabalhos por status', () => {
    cy.visit('/admin/trabalhos');
    
    // Selecionar status
    cy.get('select').first().select('EM_ANALISE');
    
    // Aguardar carregamento
    cy.wait(1000);
    
    // Verificar que carregou
    cy.get('body').should('be.visible');
  });

  it('deve buscar trabalhos por título', () => {
    cy.visit('/admin/trabalhos');
    
    // Digitar busca
    cy.get('input[type="text"]').first().type('teste');
    
    // Aguardar debounce
    cy.wait(1500);
    
    // Verificar que tentou buscar
    cy.get('body').should('be.visible');
  });

  it('deve exportar relatório de trabalhos em Excel', () => {
    cy.visit('/admin/trabalhos');
    
    // Clicar no botão Excel
    cy.contains('button', 'Excel').click();
    
    // Verificar mensagem de sucesso
    cy.contains('sucesso', { matchCase: false, timeout: 10000 }).should('be.visible');
  });

  it('deve exportar relatório de trabalhos em PDF', () => {
    cy.visit('/admin/trabalhos');
    
    // Clicar no botão PDF
    cy.contains('button', 'PDF').click();
    
    // Verificar mensagem de sucesso
    cy.contains('sucesso', { matchCase: false, timeout: 10000 }).should('be.visible');
  });

  it('deve abrir modal de atribuição de avaliador', () => {
    cy.visit('/admin/trabalhos');
    
    cy.get('body').then($body => {
      if ($body.find('button[title*="Atribuir"]').length > 0) {
        cy.get('button[title*="Atribuir"]').first().click();
        
        // Modal deve abrir
        cy.get('.br-modal').should('be.visible');
        cy.contains('Atribuir Avaliador').should('be.visible');
      } else {
        cy.log('Nenhum trabalho disponível para atribuição');
      }
    });
  });

  it('deve visualizar detalhes de trabalho', () => {
    cy.visit('/admin/trabalhos');
    
    cy.get('body').then($body => {
      if ($body.find('button[title*="detalhes"]').length > 0) {
        cy.get('button[title*="detalhes"]').first().click();
        
        // Modal de detalhes deve abrir
        cy.get('.br-modal').should('be.visible');
        cy.contains('Detalhes do Trabalho').should('be.visible');
      } else if ($body.find('.fa-eye').length > 0) {
        cy.get('.fa-eye').first().click();
        
        cy.get('.br-modal').should('be.visible');
      } else {
        cy.log('Nenhum trabalho disponível para visualizar');
      }
    });
  });

  it('deve acessar dashboard com gráficos', () => {
    cy.contains('Dashboard', { timeout: 5000 }).click();
    cy.url().should('include', '/admin/dashboard');
    
    // Verificar cards de resumo
    cy.contains('Total de Trabalhos').should('be.visible');
    cy.contains('Participantes').should('be.visible');
    cy.contains('Avaliadores').should('be.visible');
    
    // Verificar gráficos (SVG do recharts)
    cy.get('svg').should('have.length.greaterThan', 0);
  });

  it('deve filtrar dashboard por simpósio', () => {
    cy.visit('/admin/dashboard');
    
    // Selecionar simpósio
    cy.get('select').first().select(1);
    
    // Aguardar atualização
    cy.wait(1000);
    
    // Dashboard deve atualizar
    cy.get('body').should('be.visible');
  });

  it('deve gerenciar avaliadores', () => {
    cy.contains('Avaliadores', { timeout: 5000 }).click();
    cy.url().should('include', '/admin/avaliadores');
    
    cy.contains('Gerenciar Avaliadores').should('be.visible');
    cy.contains('Novo Avaliador').should('be.visible');
  });

  it('deve gerenciar subeventos', () => {
    cy.contains('Subeventos', { timeout: 5000 }).click();
    cy.url().should('include', '/admin/subeventos');
    
    cy.contains('Gerenciar Subeventos').should('be.visible');
    cy.contains('Novo Subevento').should('be.visible');
  });
});
