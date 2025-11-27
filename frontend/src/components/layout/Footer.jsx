import React, { useEffect } from 'react';
import { Link } from 'react-router-dom';

const Footer = ({ className = '' }) => {
  useEffect(() => {
    // Inicializar o componente Footer do GOV.BR
    const footerElement = document.querySelector('.br-footer');
    if (footerElement && window.core) {
      new window.core.BRFooter('br-footer', footerElement);
    }
  }, []);

  return (
    <footer className={`br-footer ${className}`} id="footer">
      <div className="container-lg">
        <div className="logo text-center">
          <img 
            src="https://www.gov.br/++theme++padrao_govbr/img/govbr-logo-large.png" 
            alt="Governo Federal" 
          />
        </div>
        <div className="br-list horizontal" data-toggle="data-toggle" data-unique="data-unique">
          <div className="col-3">
            <a className="br-item header" href="javascript:void(0);" data-toggle="data-toggle">
              <div className="content text-down-01 text-bold text-uppercase">Institucional</div>
              <div className="support"><i className="fas fa-angle-down"></i></div>
            </a>
            <div className="br-list">
              <Link className="br-item" to="/apresentacao">
                <div className="content">Apresentação</div>
              </Link>
              <Link className="br-item" to="/programacao">
                <div className="content">Programação</div>
              </Link>
              <Link className="br-item" to="/regulamento">
                <div className="content">Regulamento</div>
              </Link>
              <Link className="br-item" to="/corpo-editorial">
                <div className="content">Corpo Editorial</div>
              </Link>
              <Link className="br-item" to="/expediente">
                <div className="content">Expediente</div>
              </Link>
            </div>
          </div>
          <div className="col-3">
            <a className="br-item header" href="javascript:void(0);" data-toggle="data-toggle">
              <div className="content text-down-01 text-bold text-uppercase">Publicações</div>
              <div className="support"><i className="fas fa-angle-down"></i></div>
            </a>
            <div className="br-list">
              <Link className="br-item" to="/normas-publicacao">
                <div className="content">Normas para Publicação</div>
              </Link>
              <Link className="br-item" to="/modelo-poster">
                <div className="content">Modelo de Pôster</div>
              </Link>
              <Link className="br-item" to="/acervo">
                <div className="content">Acervo</div>
              </Link>
            </div>
          </div>
          <div className="col-3">
            <a className="br-item header" href="javascript:void(0);" data-toggle="data-toggle">
              <div className="content text-down-01 text-bold text-uppercase">Serviços</div>
              <div className="support"><i className="fas fa-angle-down"></i></div>
            </a>
            <div className="br-list">
              <Link className="br-item" to="/validar-certificado">
                <div className="content">Validar Certificado</div>
              </Link>
              <a className="br-item" href="https://acesso.gov.br" target="_blank" rel="noopener noreferrer">
                <div className="content">Acesso Gov.br</div>
              </a>
            </div>
          </div>
          <div className="col-3">
            <a className="br-item header" href="javascript:void(0);" data-toggle="data-toggle">
              <div className="content text-down-01 text-bold text-uppercase">Links Importantes</div>
              <div className="support"><i className="fas fa-angle-down"></i></div>
            </a>
            <div className="br-list">
              <a className="br-item" href="https://www.gov.br/capes" target="_blank" rel="noopener noreferrer">
                <div className="content">CAPES</div>
              </a>
              <a className="br-item" href="https://www.gov.br/cnpq" target="_blank" rel="noopener noreferrer">
                <div className="content">CNPq</div>
              </a>
              <a className="br-item" href="https://www.periodicos.capes.gov.br" target="_blank" rel="noopener noreferrer">
                <div className="content">Portal de Periódicos</div>
              </a>
              <a className="br-item" href="https://lattes.cnpq.br" target="_blank" rel="noopener noreferrer">
                <div className="content">Plataforma Lattes</div>
              </a>
            </div>
          </div>
        </div>
        <div className="d-none d-sm-block">
          <div className="row align-items-end justify-content-between py-5">
            <div className="col social-network">
              <p className="text-up-01 text-extra-bold text-uppercase">Redes Sociais</p>
              <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 24 24' fill='%231351B4'%3E%3Cpath d='M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z'/%3E%3C/svg%3E" alt="Facebook" />
              </a>
              <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 24 24' fill='%231351B4'%3E%3Cpath d='M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z'/%3E%3C/svg%3E" alt="Twitter" />
              </a>
              <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 24 24' fill='%231351B4'%3E%3Cpath d='M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z'/%3E%3C/svg%3E" alt="Instagram" />
              </a>
            </div>
            <div className="col assigns text-right">
              <img 
                src="https://www.gov.br/++theme++padrao_govbr/img/govbr-logo-large.png" 
                alt="Governo Federal" 
              />
            </div>
          </div>
        </div>
      </div>
      <div className="br-divider my-3"></div>
      <div className="container-lg">
        <div className="info">
          <div className="text-down-01 text-medium pb-3 text-center">
            Sistema de Gerenciamento de Simpósios - Todo o conteúdo deste site está publicado sob a licença <strong>Creative Commons Atribuição-SemDerivações 3.0 Não Adaptada</strong>.
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
