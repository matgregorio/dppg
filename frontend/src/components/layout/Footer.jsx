import React from 'react';
import { Link } from 'react-router-dom';

const Footer = () => {
  return (
    <footer className="br-footer" id="footer">
      <div className="container-lg">
        <div className="info">
          <div className="text-down-01 text-medium pb-3">Sistema de Simpósio</div>
          <div className="text-down-01 text-regular pb-3">
            Sistema para gerenciamento de simpósios anuais com GOVBR-DS
          </div>
        </div>
      </div>
      <div className="br-divider my-3"></div>
      <div className="container-lg">
        <div className="d-flex align-items-center">
          <div className="ml-auto">
            <span className="text-up-01 text-medium">
              © {new Date().getFullYear()} - Todos os direitos reservados
            </span>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
