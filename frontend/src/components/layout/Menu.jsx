import React, { useState } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { useSelector } from 'react-redux';

const Menu = () => {
  const { isAuthenticated, user } = useSelector((state) => state.auth);
  const location = useLocation();
  const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
  
  const isActive = (path) => location.pathname === path ? 'active' : '';
  
  const hasRole = (roles) => {
    if (!user || !user.roles) return false;
    return roles.some(role => user.roles.includes(role));
  };

  const closeMobileMenu = () => {
    setIsMobileMenuOpen(false);
  };
  
  return (
    <>
      {/* Botão hambúrguer para mobile */}
      <button
        className="menu-toggle-mobile br-button circle"
        onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}
        aria-label="Abrir menu"
      >
        <i className={`fas fa-${isMobileMenuOpen ? 'times' : 'bars'}`}></i>
      </button>

      {/* Overlay para fechar menu mobile */}
      {isMobileMenuOpen && (
        <div 
          className="menu-mobile-overlay" 
          onClick={closeMobileMenu}
        ></div>
      )}

      <div 
        className={`br-menu ${isMobileMenuOpen ? 'menu-mobile-open' : ''}`} 
        id="main-navigation" 
        style={{ 
          display: 'block', 
        visibility: 'visible'
      }}
    >
      <div className="menu-container">
        <div className="menu-panel">
          <nav className="menu-body">
            <div className="menu-folder">
              <Link className={`menu-item ${isActive('/')}`} to="/">
                <span className="content">Início</span>
              </Link>
              <Link className={`menu-item ${isActive('/apresentacao')}`} to="/apresentacao" onClick={closeMobileMenu}>
                <span className="content">Apresentação</span>
              </Link>
              <Link className={`menu-item ${isActive('/programacao')}`} to="/programacao" onClick={closeMobileMenu}>
                <span className="content">Programação</span>
              </Link>
              <Link className={`menu-item ${isActive('/regulamento')}`} to="/regulamento" onClick={closeMobileMenu}>
                <span className="content">Regulamento</span>
              </Link>
              <Link className={`menu-item ${isActive('/corpo-editorial')}`} to="/corpo-editorial" onClick={closeMobileMenu}>
                <span className="content">Corpo Editorial</span>
              </Link>
              <Link className={`menu-item ${isActive('/expediente')}`} to="/expediente" onClick={closeMobileMenu}>
                <span className="content">Expediente</span>
              </Link>
              <Link className={`menu-item ${isActive('/normas-publicacao')}`} to="/normas-publicacao" onClick={closeMobileMenu}>
                <span className="content">Normas para Publicação</span>
              </Link>
              <Link className={`menu-item ${isActive('/modelo-poster')}`} to="/modelo-poster" onClick={closeMobileMenu}>
                <span className="content">Modelo de Pôster</span>
              </Link>
              <Link className={`menu-item ${isActive('/validar-certificado')}`} to="/validar-certificado" onClick={closeMobileMenu}>
                <span className="content">Validar Certificado</span>
              </Link>
              <Link className={`menu-item ${isActive('/acervo')}`} to="/acervo" onClick={closeMobileMenu}>
                <span className="content">Acervo</span>
              </Link>
              
              <div className="br-divider my-3"></div>
              <div className="menu-title">Links Importantes</div>
              <a 
                className="menu-item" 
                href="https://www.gov.br/capes" 
                target="_blank" 
                rel="noopener noreferrer"
              >
                <span className="content">
                  <i className="fas fa-external-link-alt mr-2"></i>
                  CAPES
                </span>
              </a>
              <a 
                className="menu-item" 
                href="https://www.gov.br/cnpq" 
                target="_blank" 
                rel="noopener noreferrer"
              >
                <span className="content">
                  <i className="fas fa-external-link-alt mr-2"></i>
                  CNPq
                </span>
              </a>
              <a 
                className="menu-item" 
                href="https://www.periodicos.capes.gov.br" 
                target="_blank" 
                rel="noopener noreferrer"
              >
                <span className="content">
                  <i className="fas fa-external-link-alt mr-2"></i>
                  Portal de Periódicos
                </span>
              </a>
              <a 
                className="menu-item" 
                href="https://lattes.cnpq.br" 
                target="_blank" 
                rel="noopener noreferrer"
              >
                <span className="content">
                  <i className="fas fa-external-link-alt mr-2"></i>
                  Plataforma Lattes
                </span>
              </a>
              
              {isAuthenticated && hasRole(['USER']) && (
                <>
                  <div className="br-divider my-3"></div>
                  <div className="menu-title">Participante</div>
                  <Link className={`menu-item ${isActive('/inscricoes')}`} to="/inscricoes" onClick={closeMobileMenu}>
                    <span className="content">Minhas Inscrições</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/trabalhos')}`} to="/trabalhos" onClick={closeMobileMenu}>
                    <span className="content">Meus Trabalhos</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/certificados')}`} to="/certificados" onClick={closeMobileMenu}>
                    <span className="content">Meus Certificados</span>
                  </Link>
                </>
              )}
              
              {isAuthenticated && hasRole(['AVALIADOR']) && (
                <>
                  <div className="br-divider my-3"></div>
                  <div className="menu-title">Avaliador</div>
                  <Link className={`menu-item ${isActive('/avaliador/trabalhos')}`} to="/avaliador/trabalhos" onClick={closeMobileMenu}>
                    <span className="content">Trabalhos para Avaliar</span>
                  </Link>
                </>
              )}
              
              {isAuthenticated && hasRole(['ADMIN', 'SUBADMIN']) && (
                <>
                  <div className="br-divider my-3"></div>
                  <div className="menu-title">Administração</div>
                  <Link 
                    className={`menu-item ${isActive(`/admin/simposios/${new Date().getFullYear()}`)}`} 
                    to={`/admin/simposios/${new Date().getFullYear()}`}
                    onClick={closeMobileMenu}
                  >
                    <span className="content">Gerenciar Simpósio</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/trabalhos')}`} to="/admin/trabalhos" onClick={closeMobileMenu}>
                    <span className="content">Trabalhos</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/areas')}`} to="/admin/areas" onClick={closeMobileMenu}>
                    <span className="content">Áreas de Conhecimento</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/participantes')}`} to="/admin/participantes" onClick={closeMobileMenu}>
                    <span className="content">Participantes</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/avaliacoes-externas')}`} to="/admin/avaliacoes-externas" onClick={closeMobileMenu}>
                    <span className="content">Avaliações Externas</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/acervo')}`} to="/admin/acervo" onClick={closeMobileMenu}>
                    <span className="content">Acervo</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/paginas')}`} to="/admin/paginas" onClick={closeMobileMenu}>
                    <span className="content">Páginas Estáticas</span>
                  </Link>
                </>
              )}
              
              {isAuthenticated && hasRole(['MESARIO']) && (
                <>
                  <div className="br-divider my-3"></div>
                  <div className="menu-title">Mesário</div>
                  <Link className={`menu-item ${isActive('/mesario/subeventos')}`} to="/mesario/subeventos" onClick={closeMobileMenu}>
                    <span className="content">Meus Subeventos</span>
                  </Link>
                </>
              )}
            </div>
          </nav>
        </div>
      </div>
    </div>
    </>
  );
};

export default Menu;
