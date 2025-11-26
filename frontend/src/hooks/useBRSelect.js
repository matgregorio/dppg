import { useEffect } from 'react';

/**
 * Hook para inicializar componentes Select do GOV.BR Design System
 * Deve ser usado em componentes que renderizam .br-select
 */
const useBRSelect = () => {
  useEffect(() => {
    // Importa e inicializa os selects do GOV.BR
    const initSelects = async () => {
      try {
        // Verifica se o core do GOV.BR está disponível
        if (window.core && window.core.BRSelect) {
          // Seleciona todos os elementos .br-select que ainda não foram inicializados
          const selectElements = document.querySelectorAll('.br-select:not([data-initialized])');
          
          selectElements.forEach((element) => {
            // Marca como inicializado para evitar duplicação
            element.setAttribute('data-initialized', 'true');
            
            // Cria mensagem personalizada para busca não encontrada
            const notFoundElement = `
              <div class="br-item not-found">
                <div class="container">
                  <div class="row">
                    <div class="col">
                      <p><strong>Ops!</strong> Não encontramos o que você está procurando!</p>
                    </div>
                  </div>
                </div>
              </div>
            `;
            
            // Inicializa o componente
            new window.core.BRSelect('br-select', element, notFoundElement);
          });
        }
      } catch (error) {
        console.warn('Erro ao inicializar BRSelect:', error);
      }
    };
    
    // Aguarda um tick para garantir que o DOM está pronto
    const timer = setTimeout(initSelects, 100);
    
    return () => clearTimeout(timer);
  }, []); // Executa apenas uma vez na montagem
};

export default useBRSelect;
