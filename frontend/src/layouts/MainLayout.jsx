import React from 'react';
import Header from '../components/layout/Header';
import Menu from '../components/layout/Menu';
import Footer from '../components/layout/Footer';
import useGovBRInit from '../hooks/useGovBRInit';
import { MenuProvider, useMenu } from '../contexts/MenuContext';

const MainLayoutContent = ({ children }) => {
  const { isMenuOpen } = useMenu();
  
  return (
    <div className="layout-root">
      {/* Skip Links para acessibilidade */}
      <a href="#main-content" className="skip-link">
        Pular para o conteúdo principal
      </a>
      <a href="#main-navigation" className="skip-link">
        Pular para a navegação
      </a>
      
      <Header />
      
      {/* Container para menu e conteúdo lado a lado */}
      <div className="layout-container">
        <Menu />
        <main 
          id="main-content" 
          className={`content-wrapper ${!isMenuOpen ? 'menu-closed' : ''}`}
          role="main" 
          aria-label="Conteúdo principal"
        >
          <div className="container-lg">
            {children}
          </div>
        </main>
      </div>
      
      <Footer className={!isMenuOpen ? 'menu-closed' : ''} />
    </div>
  );
};

const MainLayout = ({ children }) => {
  useGovBRInit();
  
  return (
    <MenuProvider>
      <MainLayoutContent>{children}</MainLayoutContent>
    </MenuProvider>
  );
};

export default MainLayout;
