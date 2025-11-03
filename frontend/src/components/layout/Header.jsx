import React, { useState, useEffect, useRef } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';
import { logout } from '../../store/slices/authSlice';
import authService from '../../services/authService';
import LoginModal from '../modals/LoginModal';
import RegisterModal from '../modals/RegisterModal';

const Header = () => {
  const { isAuthenticated, user } = useSelector((state) => state.auth);
  const dispatch = useDispatch();
  const navigate = useNavigate();
  const [showLoginModal, setShowLoginModal] = useState(false);
  const [showRegisterModal, setShowRegisterModal] = useState(false);
  const [showUserMenu, setShowUserMenu] = useState(false);
  const menuRef = useRef(null);
  
  const handleLogout = async () => {
    try {
      await authService.logout();
      dispatch(logout());
      navigate('/');
      setShowUserMenu(false);
    } catch (error) {
      console.error('Erro ao fazer logout:', error);
    }
  };
  
  // Fecha o menu ao clicar fora
  useEffect(() => {
    const handleClickOutside = (event) => {
      if (menuRef.current && !menuRef.current.contains(event.target)) {
        setShowUserMenu(false);
      }
    };
    
    if (showUserMenu) {
      document.addEventListener('mousedown', handleClickOutside);
    }
    
    return () => {
      document.removeEventListener('mousedown', handleClickOutside);
    };
  }, [showUserMenu]);
  
  return (
    <header className="br-header" id="header" data-sticky="true">
      <div className="container-lg">
        <div className="header-top">
          <div className="header-logo">
            <Link to="/">
              <img src="/logo-govbr.png" alt="logo" onError={(e) => e.target.style.display = 'none'} />
              <span className="br-divider vertical mx-half mx-sm-1"></span>
              <span>Sistema de Simpósio</span>
            </Link>
          </div>
          <div className="header-actions">
            <div className="header-links dropdown">
              <button
                className="br-button circle small"
                type="button"
                data-toggle="dropdown"
                aria-label="Acessibilidade"
              >
                <i className="fas fa-universal-access" aria-hidden="true"></i>
              </button>
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
