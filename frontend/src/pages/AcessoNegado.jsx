import React from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';

const AcessoNegado = () => {
  return (
    <MainLayout>
      <div className="br-breadcrumb">
        <ul className="crumb-list">
          <li className="crumb home">
            <Link className="br-button circle" to="/">
              <span className="sr-only">Página inicial</span>
              <i className="fas fa-home"></i>
            </Link>
          </li>
          <li className="crumb">
            <i className="icon fas fa-chevron-right"></i>
            <span>Acesso Negado</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <div className="br-card">
          <div className="card-content text-center py-5">
            <i className="fas fa-ban fa-4x text-danger mb-4"></i>
            <h1 className="text-up-02 text-weight-bold mb-3">Acesso Negado</h1>
            <p className="text-base mb-4">
              Você não possui permissão para acessar esta página.
            </p>
            <p className="text-down-01 mb-4">
              Se você acredita que deveria ter acesso, entre em contato com o administrador do sistema.
            </p>
            <Link to="/" className="br-button primary">
              <i className="fas fa-home mr-2"></i>
              Voltar para o Início
            </Link>
          </div>
        </div>
      </div>
    </MainLayout>
  );
};

export default AcessoNegado;
