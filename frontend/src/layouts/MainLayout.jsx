import React from 'react';
import Header from '../components/layout/Header';
import Menu from '../components/layout/Menu';
import Footer from '../components/layout/Footer';
import useGovBRInit from '../hooks/useGovBRInit';

const MainLayout = ({ children }) => {
  useGovBRInit();
  
  return (
    <div className="d-flex flex-column min-vh-100">
      {/* Skip Links para acessibilidade */}
      <a href="#main-content" className="skip-link">
        Pular para o conteúdo principal
      </a>
      <a href="#main-navigation" className="skip-link">
        Pular para a navegação
      </a>
      
      <Header />
      <Menu />
      <main id="main-content" className="content-wrapper flex-fill" role="main" aria-label="Conteúdo principal">
        <div className="container-lg">
          {children}
        </div>
      </main>
      <Footer />
    </div>
  );
};

export default MainLayout;
