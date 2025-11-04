import React, { createContext, useContext, useState, useEffect } from 'react';

const MenuContext = createContext();

export const useMenu = () => {
  const context = useContext(MenuContext);
  if (!context) {
    throw new Error('useMenu must be used within a MenuProvider');
  }
  return context;
};

export const MenuProvider = ({ children }) => {
  // Define estado inicial baseado no tamanho da tela
  const [isMenuOpen, setIsMenuOpen] = useState(() => {
    return window.innerWidth > 768; // Aberto em desktop, fechado em mobile
  });

  // Detecta mudanças de tamanho da tela
  useEffect(() => {
    const handleResize = () => {
      if (window.innerWidth > 768) {
        setIsMenuOpen(true); // Sempre aberto em desktop por padrão ao redimensionar
      }
    };

    window.addEventListener('resize', handleResize);
    return () => window.removeEventListener('resize', handleResize);
  }, []);

  const toggleMenu = () => {
    setIsMenuOpen(prev => !prev);
  };

  const closeMenu = () => {
    // Só fecha automaticamente em mobile
    if (window.innerWidth <= 768) {
      setIsMenuOpen(false);
    }
  };

  return (
    <MenuContext.Provider value={{ isMenuOpen, toggleMenu, closeMenu }}>
      {children}
    </MenuContext.Provider>
  );
};
