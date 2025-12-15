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
                  <Link 
                    className={`menu-item ${isActive(`/admin/simposios/${new Date().getFullYear()}`)}`} 
                    to={`/admin/simposios/${new Date().getFullYear()}`}
                    onClick={handleLinkClick}
                  >
                    <span className="content">Gerenciar Simpósio</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/trabalhos')}`} to="/admin/trabalhos" onClick={handleLinkClick}>
                    <span className="content">Trabalhos</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/areas')}`} to="/admin/areas" onClick={handleLinkClick}>
                    <span className="content">Áreas de Conhecimento</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/instituicoes')}`} to="/admin/instituicoes" onClick={handleLinkClick}>
                    <span className="content">Instituições</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/docentes')}`} to="/admin/docentes" onClick={handleLinkClick}>
                    <span className="content">Docentes</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/apoios')}`} to="/admin/apoios" onClick={handleLinkClick}>
                    <span className="content">Apoios</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/participantes')}`} to="/admin/participantes" onClick={handleLinkClick}>
                    <span className="content">Participantes</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/avaliadores')}`} to="/admin/avaliadores" onClick={handleLinkClick}>
                    <span className="content">Avaliadores</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/subeventos')}`} to="/admin/subeventos" onClick={handleLinkClick}>
                    <span className="content">Subeventos</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/avaliacoes-externas')}`} to="/admin/avaliacoes-externas" onClick={handleLinkClick}>
                    <span className="content">Avaliações Externas</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/acervo')}`} to="/admin/acervo" onClick={handleLinkClick}>
                    <span className="content">Acervo</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/paginas')}`} to="/admin/paginas" onClick={handleLinkClick}>
                    <span className="content">Páginas Estáticas</span>
                  </Link>
                  <Link className={`menu-item ${isActive('/admin/email-templates')}`} to="/admin/email-templates" onClick={handleLinkClick}>
                    <span className="content">Templates de Email</span>
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
