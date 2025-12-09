import React, { useState, useEffect, useRef } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';
import { logout } from '../../store/slices/authSlice';
import authService from '../../services/authService';
import LoginModal from '../modals/LoginModal';
import RegisterModal from '../modals/RegisterModal';
import { useMenu } from '../../contexts/MenuContext';
import useNotification from '../../hooks/useNotification';

const Header = () => {
  const { isAuthenticated, user } = useSelector((state) => state.auth);
  const { isMenuOpen, toggleMenu } = useMenu();
  const dispatch = useDispatch();
  const navigate = useNavigate();
  const { showNotification } = useNotification();
  const [showLoginModal, setShowLoginModal] = useState(false);
  const [showRegisterModal, setShowRegisterModal] = useState(false);
  const [showUserMenu, setShowUserMenu] = useState(false);
  const [showAccessibilityMenu, setShowAccessibilityMenu] = useState(false);
  const [fontSize, setFontSize] = useState(() => {
    return parseInt(localStorage.getItem('fontSize') || '100');
  });
  const [highContrast, setHighContrast] = useState(() => {
    return localStorage.getItem('highContrast') === 'true';
  });
  const menuRef = useRef(null);
  const accessibilityRef = useRef(null);
  
  const handleLogout = async () => {
    try {
      await authService.logout();
      dispatch(logout());
      setShowUserMenu(false);
      
      // Mostra notificação de sucesso
      showNotification('Logout realizado com sucesso! Até breve.', 'success');
      
      // Aguarda um momento para o usuário ver a notificação antes de redirecionar
      setTimeout(() => {
        navigate('/');
      }, 1500);
    } catch (error) {
      console.error('Erro ao fazer logout:', error);
      showNotification('Erro ao fazer logout. Tente novamente.', 'error');
    }
  };
  
  // Aplicar configurações de acessibilidade
  useEffect(() => {
    document.documentElement.style.fontSize = `${fontSize}%`;
    localStorage.setItem('fontSize', fontSize.toString());
  }, [fontSize]);

  useEffect(() => {
    if (highContrast) {
      document.body.classList.add('high-contrast');
    } else {
      document.body.classList.remove('high-contrast');
    }
    localStorage.setItem('highContrast', highContrast.toString());
  }, [highContrast]);

  const increaseFontSize = () => {
    if (fontSize < 150) setFontSize(fontSize + 10);
  };

  const decreaseFontSize = () => {
    if (fontSize > 80) setFontSize(fontSize - 10);
  };

  const resetFontSize = () => {
    setFontSize(100);
  };

  const toggleContrast = () => {
    setHighContrast(!highContrast);
  };

  // Fecha os menus ao clicar fora
  useEffect(() => {
    const handleClickOutside = (event) => {
      if (menuRef.current && !menuRef.current.contains(event.target)) {
        setShowUserMenu(false);
      }
      if (accessibilityRef.current && !accessibilityRef.current.contains(event.target)) {
        setShowAccessibilityMenu(false);
      }
    };
    
    if (showUserMenu || showAccessibilityMenu) {
      document.addEventListener('mousedown', handleClickOutside);
    }
    
    return () => {
      document.removeEventListener('mousedown', handleClickOutside);
    };
  }, [showUserMenu, showAccessibilityMenu]);
  
  return (
    <header className="br-header" id="header" data-sticky="true">
      <div className="container-lg">
        <div className="header-top">
          {/* Botão hambúrguer DESKTOP no cabeçalho */}
          <button
            className="menu-toggle-desktop"
            onClick={toggleMenu}
            aria-label={isMenuOpen ? "Fechar menu" : "Abrir menu"}
            type="button"
            title={isMenuOpen ? "Fechar menu" : "Abrir menu"}
          >
            <i className={`fas fa-${isMenuOpen ? 'times' : 'bars'}`} style={{ fontSize: '1.5rem' }}></i>
          </button>
          
          <div className="header-logo">
            <Link to="/">
              <img src="/logo-govbr.png" alt="logo" onError={(e) => e.target.style.display = 'none'} />
              <span className="br-divider vertical mx-half mx-sm-1"></span>
              <span>Sistema de Simpósio</span>
            </Link>
          </div>
          <div className="header-actions">
            <div className="header-links" ref={accessibilityRef}>
              <button
                className="br-button circle small"
                type="button"
                onClick={() => setShowAccessibilityMenu(!showAccessibilityMenu)}
                aria-label="Acessibilidade"
                aria-expanded={showAccessibilityMenu}
              >
                <i className="fas fa-universal-access" aria-hidden="true"></i>
              </button>
              {showAccessibilityMenu && (
                <div className="header-menu" style={{ minWidth: '250px' }}>
                  <div className="br-list" role="menu">
                    <div className="br-item" style={{ padding: '12px 16px', borderBottom: '1px solid #e9ecef' }}>
                      <strong>Acessibilidade</strong>
                    </div>
                    <div className="br-item" style={{ padding: '12px 16px' }}>
                      <div className="d-flex justify-content-between align-items-center mb-2">
                        <span>Tamanho da fonte</span>
                        <span className="badge bg-primary">{fontSize}%</span>
                      </div>
                      <div className="d-flex gap-2">
                        <button
                          className="br-button secondary small flex-fill"
                          type="button"
                          onClick={decreaseFontSize}
                          disabled={fontSize <= 80}
                          title="Diminuir fonte"
                        >
                          <i className="fas fa-minus"></i> A
                        </button>
                        <button
                          className="br-button secondary small"
                          type="button"
                          onClick={resetFontSize}
                          title="Tamanho padrão"
                        >
                          <i className="fas fa-undo"></i>
                        </button>
                        <button
                          className="br-button secondary small flex-fill"
                          type="button"
                          onClick={increaseFontSize}
                          disabled={fontSize >= 150}
                          title="Aumentar fonte"
                        >
                          <i className="fas fa-plus"></i> A
                        </button>
                      </div>
                    </div>
                    <button 
                      className="br-item" 
                      type="button"
                      onClick={toggleContrast}
                      role="menuitem"
                      style={{ width: '100%', textAlign: 'left' }}
                    >
                      <i className={`fas fa-${highContrast ? 'check-square' : 'square'} mr-2`}></i>
                      Alto Contraste
                    </button>
                  </div>
                </div>
              )}
            </div>
            {isAuthenticated && (
              <div className="header-login" ref={menuRef}>
                <div className="header-sign-in">
                  <button 
                    className="br-sign-in small" 
                    type="button"
                    onClick={() => setShowUserMenu(!showUserMenu)}
                    aria-expanded={showUserMenu}
                  >
                    <i className="fas fa-user" aria-hidden="true"></i>
                    <span className="d-sm-inline">{user?.nome || 'Usuário'}</span>
                    <i className={`fas fa-caret-${showUserMenu ? 'up' : 'down'} ml-1`} aria-hidden="true"></i>
                  </button>
                </div>
                {showUserMenu && (
                  <div className="header-menu">
                    <div className="br-list" role="menu">
                      <Link 
                        className="br-item" 
                        to="/meu-perfil"
                        onClick={() => setShowUserMenu(false)}
                      >
                        Meu Perfil
                      </Link>
                      <button 
                        className="br-item" 
                        onClick={handleLogout}
                      >
                        Sair
                      </button>
                    </div>
                  </div>
                )}
              </div>
            )}
            {!isAuthenticated && (
              <div className="header-login">
                <button 
                  onClick={() => setShowLoginModal(true)} 
                  className="br-button primary small"
                >
                  <i className="fas fa-sign-in-alt mr-1"></i>
                  Entrar
                </button>
              </div>
            )}
          </div>
        </div>
      </div>
      
      <LoginModal 
        isOpen={showLoginModal} 
        onClose={() => setShowLoginModal(false)}
        onOpenRegister={() => {
          setShowLoginModal(false);
          setShowRegisterModal(true);
        }}
      />
      
      <RegisterModal
        isOpen={showRegisterModal}
        onClose={() => setShowRegisterModal(false)}
        onOpenLogin={() => {
          setShowRegisterModal(false);
          setShowLoginModal(true);
        }}
      />
    </header>
  );
};

export default Header;
