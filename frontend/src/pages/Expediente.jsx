import React from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';

const Expediente = () => {
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
            <span>Expediente</span>
          </li>
        </ul>
      </div>

      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">
          <i className="fas fa-info-circle mr-2"></i>
          Expediente
        </h1>

        <div className="br-card">
          <div className="card-content">
            <h2 className="text-up-02 text-weight-semi-bold mb-3">Realização</h2>
            <p className="text-base mb-4">
              Diretoria de Pesquisa e Pós-Graduação (DPPG)<br />
              Instituição de Ensino Superior
            </p>

            <h2 className="text-up-02 text-weight-semi-bold mb-3">Apoio</h2>
            <ul className="mb-4">
              <li>CAPES - Coordenação de Aperfeiçoamento de Pessoal de Nível Superior</li>
              <li>CNPq - Conselho Nacional de Desenvolvimento Científico e Tecnológico</li>
              <li>FAPEMIG - Fundação de Amparo à Pesquisa do Estado de Minas Gerais</li>
            </ul>

            <h2 className="text-up-02 text-weight-semi-bold mb-3">Contato</h2>
            <p className="text-base">
              <i className="fas fa-envelope mr-2"></i>
              <strong>Email:</strong> simposio@instituicao.edu.br<br />
              <i className="fas fa-phone mr-2"></i>
              <strong>Telefone:</strong> (00) 0000-0000
            </p>
          </div>
        </div>
      </div>
    </MainLayout>
  );
};

export default Expediente;
