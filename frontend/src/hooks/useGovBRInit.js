import { useEffect } from 'react';

/**
 * Hook para inicializar componentes do GOVBR-DS após renderização
 */
const useGovBRInit = () => {
  useEffect(() => {
    // Pequeno delay para garantir que o DOM está pronto
    const timer = setTimeout(() => {
      if (typeof window !== 'undefined' && window.core) {
        // Header
        const headers = document.querySelectorAll('.br-header');
        headers.forEach((el) => {
          try {
            new window.core.BRHeader('br-header', el);
          } catch (e) {
            console.warn('Erro ao inicializar BRHeader:', e);
          }
        });
        
        // Menu - Desabilitado: usando implementação customizada
        // const menus = document.querySelectorAll('.br-menu');
        // menus.forEach((el) => {
        //   try {
        //     new window.core.BRMenu('br-menu', el);
        //   } catch (e) {
        //     console.warn('Erro ao inicializar BRMenu:', e);
        //   }
        // });
        
        // Footer
        const footers = document.querySelectorAll('.br-footer');
        footers.forEach((el) => {
          try {
            new window.core.BRFooter('br-footer', el);
          } catch (e) {
            console.warn('Erro ao inicializar BRFooter:', e);
          }
        });
        
        // Tabs
        const tabs = document.querySelectorAll('.br-tab');
        tabs.forEach((el) => {
          try {
            new window.core.BRTab('br-tab', el);
          } catch (e) {
            console.warn('Erro ao inicializar BRTab:', e);
          }
        });
        
        // Modals
        const modals = document.querySelectorAll('.br-modal');
        modals.forEach((el) => {
          try {
            new window.core.BRModal('br-modal', el);
          } catch (e) {
            console.warn('Erro ao inicializar BRModal:', e);
          }
        });
      }
    }, 100);
    
    return () => clearTimeout(timer);
  }, []);
};

export default useGovBRInit;
