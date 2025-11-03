// Cypress support file
import './commands';

// Previne erro de fetch não capturado
Cypress.on('uncaught:exception', (err, runnable) => {
  // Retorna false para prevenir que o teste falhe
  return false;
});
