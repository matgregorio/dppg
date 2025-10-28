import React from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';

const ModeloPoster = () => {
  const handleDownload = () => {
    // Link para download do modelo
    window.open('/api/v1/public/modelo-poster', '_blank');
  };

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
            <span>Modelo de Pôster</span>
          </li>
        </ul>
      </div>

      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">
          <i className="fas fa-file-image mr-2"></i>
          Modelo de Pôster
        </h1>

        <div className="row justify-content-center">
          <div className="col-lg-8">
            <div className="br-card">
              <div className="card-content text-center">
                <div className="mb-4">
                  <i className="fas fa-file-pdf fa-5x text-primary"></i>
                </div>

                <h2 className="text-up-02 text-weight-semi-bold mb-3">
                  Baixe o Modelo Oficial
                </h2>

                <p className="text-base mb-4">
                  Utilize o modelo oficial para garantir que seu pôster atenda a todos os 
                  requisitos do simpósio. O arquivo contém orientações sobre dimensões, 
                  fontes e estrutura recomendada.
                </p>

                <button onClick={handleDownload} className="br-button primary large mb-4">
                  <i className="fas fa-download mr-2"></i>
                  Baixar Modelo (PDF)
                </button>

                <div className="br-divider my-4"></div>

                <div className="text-left">
                  <h3 className="text-up-01 text-weight-semi-bold mb-3">Especificações</h3>
                  <ul className="mb-3">
                    <li>Dimensões: 90cm (largura) x 120cm (altura)</li>
                    <li>Orientação: Retrato (vertical)</li>
                    <li>Resolução mínima: 300 DPI</li>
                    <li>Formato de impressão: PDF de alta qualidade</li>
                  </ul>

                  <h3 className="text-up-01 text-weight-semi-bold mb-3">Conteúdo Obrigatório</h3>
                  <ul>
                    <li>Título do trabalho</li>
                    <li>Nome dos autores e instituição</li>
                    <li>Introdução/Objetivos</li>
                    <li>Metodologia</li>
                    <li>Resultados</li>
                    <li>Conclusões</li>
                    <li>Referências (principais)</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </MainLayout>
  );
};

export default ModeloPoster;
