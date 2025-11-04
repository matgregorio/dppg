import React, { useState, useEffect } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { useSelector } from 'react-redux';
import { useMenu } from '../../contexts/MenuContext';

const Menu = () => {
  const { isAuthenticated, user } = useSelector((state) => state.auth);
  const location = useLocation();
  const { isMenuOpen, toggleMenu, closeMenu } = useMenu();
  
  const isActive = (path) => location.pathname === path ? 'active' : '';
  
  const hasRole = (roles) => {
    if (!user || !user.roles) return false;
    return roles.some(role => user.roles.includes(role));
  };

  const handleToggleMenu = (e) => {
    e.preventDefault();
    e.stopPropagation();
    console.log('Toggle menu:', !isMenuOpen);
    toggleMenu();
  };
  
  return (
    <>
      {/* Botão hambúrguer MOBILE - canto inferior direito */}
      <button
        className="menu-toggle-mobile br-button circle"
        onClick={handleToggleMenu}
        onTouchEnd={handleToggleMenu}
        aria-label={isMenuOpen ? "Fechar menu" : "Abrir menu"}
        type="button"
      >
        <i className={`fas fa-${isMenuOpen ? 'times' : 'bars'}`}></i>
      </button>

      {/* Overlay para fechar menu ao clicar fora (apenas mobile) - não cobre o menu */}
      {isMenuOpen && window.innerWidth <= 768 && (
        <div 
          className="menu-mobile-overlay" 
          onClick={closeMenu}
          onTouchEnd={closeMenu}
        ></div>
      )}

      <div 
        className={`br-menu ${!isMenuOpen ? 'menu-closed' : ''} ${isMenuOpen && window.innerWidth <= 768 ? 'menu-mobile-open' : ''}`} 
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
              <Link className={`menu-item ${isActive('/')}`} to="/" onClick={closeMenu}>
                <span className="content">Início</span>
              </Link>
              <Link className={`menu-item ${isActive('/apresentacao')}`} to="/apresentacao" onClick={closeMenu}>
                <span className="content">Apresentação</span>
              </Link>
              <Link className={`menu-item ${isActive('/programacao')}`} to="/programacao" onClick={closeMenu}>
                <span className="content">Programação</span>
              </Link>
              <Link className={`menu-item ${isActive('/regulamento')}`} to="/regulamento" onClick={closeMenu}>
                <span className="content">Regulamento</span>
              </Link>
              <Link className={`menu-item ${isActive('/corpo-editorial')}`} to="/corpo-editorial" onClick={closeMenu}>
                <span className="content">Corpo Editorial</span>
              </Link>
              <Link className={`menu-item ${isActive('/expediente')}`} to="/expediente" onClick={closeMenu}>
                <span className="content">Expediente</span>
              </Link>
              <Link className={`menu-item ${isActive('/normas-publicacao')}`} to="/normas-publicacao" onClick={closeMenu}>
                <span className="content">Normas para Publicação</span>
              </Link>
              <Link className={`menu-item ${isActive('/modelo-poster')}`} to="/modelo-poster" onClick={closeMenu}>
                <span className="content">Modelo de Pôster</span>
              </Link>
              <Link className={`menu-item ${isActive('/validar-certificado')}`} to="/validar-certificado" onClick={closeMenu}>
                <span className="content">Validar Certificado</span>
              </Link>
              <Link className={`menu-item ${isActive('/acervo')}`} to="/acervo" onClick={closeMenu}>
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
              
              {isAuthenticated && hasRole(['USER', 'MESARIO']) && (
                <>
                  <div className="br-divider my-3"></div>
                  <div className="menu-title">Participante</div>
                  <Link className={`menu-item ${isActive('/inscricoes')}`} to="/inscricoes" onClick={closeMenu}>
                    <span className="content">Minhas Inscrições</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/trabalhos')}`} to="/trabalhos" onClick={closeMenu}>
                    <span className="content">Meus Trabalhos</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/certificados')}`} to="/certificados" onClick={closeMenu}>
                    <span className="content">Meus Certificados</span>
                  </Link>
                </>
              )}
              
              {isAuthenticated && hasRole(['MESARIO']) && (
                <>
                  <div className="br-divider my-3"></div>
                  <div className="menu-title">Mesário</div>
                  <Link className={`menu-item ${isActive('/mesario/subeventos')}`} to="/mesario/subeventos" onClick={closeMenu}>
                    <span className="content">Meus Subeventos</span>
                  </Link>
                </>
              )}
              
              {isAuthenticated && hasRole(['AVALIADOR']) && (
                <>
                  <div className="br-divider my-3"></div>
                  <div className="menu-title">Avaliador</div>
                  <Link className={`menu-item ${isActive('/avaliador/trabalhos')}`} to="/avaliador/trabalhos" onClick={closeMenu}>
                    <span className="content">Trabalhos para Avaliar</span>
                  </Link>
                </>
              )}
              
              {isAuthenticated && hasRole(['ADMIN', 'SUBADMIN']) && (
                <>
                  <div className="br-divider my-3"></div>
                  <div className="menu-title">Administração</div>
                  <Link className={`menu-item ${isActive('/admin/dashboard')}`} to="/admin/dashboard" onClick={closeMenu}>
                    <span className="content">Dashboard</span>
                  </Link>
                  <Link 
                    className={`menu-item ${isActive(`/admin/simposios/${new Date().getFullYear()}`)}`} 
                    to={`/admin/simposios/${new Date().getFullYear()}`}
                    onClick={closeMenu}
                  >
                    <span className="content">Gerenciar Simpósio</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/trabalhos')}`} to="/admin/trabalhos" onClick={closeMenu}>
                    <span className="content">Trabalhos</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/areas')}`} to="/admin/areas" onClick={closeMenu}>
                    <span className="content">Áreas de Conhecimento</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/participantes')}`} to="/admin/participantes" onClick={closeMenu}>
                    <span className="content">Participantes</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/avaliadores')}`} to="/admin/avaliadores" onClick={closeMenu}>
                    <span className="content">Avaliadores</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/subeventos')}`} to="/admin/subeventos" onClick={closeMenu}>
                    <span className="content">Subeventos</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/avaliacoes-externas')}`} to="/admin/avaliacoes-externas" onClick={closeMenu}>
                    <span className="content">Avaliações Externas</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/acervo')}`} to="/admin/acervo" onClick={closeMenu}>
                    <span className="content">Acervo</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/paginas')}`} to="/admin/paginas" onClick={closeMenu}>
                    <span className="content">Páginas Estáticas</span>
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
