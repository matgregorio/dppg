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
  
  const handleLinkClick = () => {
    closeMenu();
    // Volta ao topo da página
    window.scrollTo({ top: 0, behavior: 'smooth' });
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
              <Link className={`menu-item ${isActive('/')}`} to="/" onClick={handleLinkClick}>
                <span className="content">Início</span>
              </Link>
              <Link className={`menu-item ${isActive('/apresentacao')}`} to="/apresentacao" onClick={handleLinkClick}>
                <span className="content">Apresentação</span>
              </Link>
              <Link className={`menu-item ${isActive('/programacao')}`} to="/programacao" onClick={handleLinkClick}>
                <span className="content">Programação</span>
              </Link>
              <Link className={`menu-item ${isActive('/regulamento')}`} to="/regulamento" onClick={handleLinkClick}>
                <span className="content">Regulamento</span>
              </Link>
              <Link className={`menu-item ${isActive('/corpo-editorial')}`} to="/corpo-editorial" onClick={handleLinkClick}>
                <span className="content">Corpo Editorial</span>
              </Link>
              <Link className={`menu-item ${isActive('/expediente')}`} to="/expediente" onClick={handleLinkClick}>
                <span className="content">Expediente</span>
              </Link>
              <Link className={`menu-item ${isActive('/normas-publicacao')}`} to="/normas-publicacao" onClick={handleLinkClick}>
                <span className="content">Normas para Publicação</span>
              </Link>
              <Link className={`menu-item ${isActive('/modelo-poster')}`} to="/modelo-poster" onClick={handleLinkClick}>
                <span className="content">Modelo de Pôster</span>
              </Link>
              <Link className={`menu-item ${isActive('/validar-certificado')}`} to="/validar-certificado" onClick={handleLinkClick}>
                <span className="content">Validar Certificado</span>
              </Link>
              <Link className={`menu-item ${isActive('/acervo')}`} to="/acervo" onClick={handleLinkClick}>
                <span className="content">Acervo</span>
              </Link>
              
              {isAuthenticated && hasRole(['USER', 'MESARIO']) && (
                <>
                  <div className="br-divider my-3"></div>
                  <div className="menu-title">Participante</div>
                  <Link className={`menu-item ${isActive('/inscricoes')}`} to="/inscricoes" onClick={handleLinkClick}>
                    <span className="content">Minhas Inscrições</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/trabalhos')}`} to="/trabalhos" onClick={handleLinkClick}>
                    <span className="content">Meus Trabalhos</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/submeter-trabalho')}`} to="/submeter-trabalho" onClick={handleLinkClick}>
                    <span className="content">Submeter Trabalho</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/certificados')}`} to="/certificados" onClick={handleLinkClick}>
                    <span className="content">Meus Certificados</span>
                  </Link>
                </>
              )}
              
              {isAuthenticated && hasRole(['MESARIO']) && (
                <>
                  <div className="br-divider my-3"></div>
                  <div className="menu-title">Mesário</div>
                  <Link className={`menu-item ${isActive('/mesario/subeventos')}`} to="/mesario/subeventos" onClick={handleLinkClick}>
                    <span className="content">Meus Subeventos</span>
                  </Link>
                </>
              )}
              
              {isAuthenticated && hasRole(['AVALIADOR']) && (
                <>
                  <div className="br-divider my-3"></div>
                  <div className="menu-title">Avaliador</div>
                  <Link className={`menu-item ${isActive('/avaliador/trabalhos')}`} to="/avaliador/trabalhos" onClick={handleLinkClick}>
                    <span className="content">Trabalhos para Avaliar</span>
                  </Link>
                </>
              )}
              
              {isAuthenticated && hasRole(['DOCENTE']) && (
                <>
                  <div className="br-divider my-3"></div>
                  <div className="menu-title">Orientador</div>
                  <Link className={`menu-item ${isActive('/orientador/trabalhos')}`} to="/orientador/trabalhos" onClick={handleLinkClick}>
                    <span className="content">Trabalhos Orientados</span>
                  </Link>
                </>
              )}
              
              {isAuthenticated && hasRole(['ADMIN', 'SUBADMIN']) && (
                <>
                  <div className="br-divider my-3"></div>
                  <div className="menu-title">Administração</div>
                  <Link className={`menu-item ${isActive('/area-administrativa')}`} to="/area-administrativa" onClick={handleLinkClick}>
                    <span className="content">Área Administrativa</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/dashboard')}`} to="/admin/dashboard" onClick={handleLinkClick}>
                    <span className="content">Dashboard</span>
                  </Link>
                  <Link 
                    className={`menu-item ${isActive('/admin/ciclo-simposio')}`} 
                    to="/admin/ciclo-simposio"
                    onClick={handleLinkClick}
                  >
                    <span className="content">Ciclo de Vida</span>
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
