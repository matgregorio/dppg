import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { useSelector } from 'react-redux';
import MainLayout from '../layouts/MainLayout';
import LoginModal from '../components/modals/LoginModal';

const Home = () => {
  const currentYear = new Date().getFullYear();
  const { isAuthenticated } = useSelector((state) => state.auth);
  const [showLoginModal, setShowLoginModal] = useState(false);
  
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
          <li className="crumb" data-active="active">
            <i className="icon fas fa-chevron-right"></i>
            <span>Início</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-3">
          Simpósio Anual {currentYear}
        </h1>
        <p className="text-up-01">
          Bem-vindo ao Sistema de Gerenciamento do Simpósio Anual
        </p>
      </div>
      
      <div className="row">
        <div className="col-12 col-md-4 mb-3">
          <div className="br-card">
            <div className="card-header">
              <i className="fas fa-calendar-alt fa-2x text-primary-default"></i>
            </div>
            <div className="card-content">
              <h5 className="text-weight-semi-bold mb-2">Programação</h5>
              <p className="text-down-01">
                Confira a programação completa do simpósio {currentYear}
              </p>
              <Link to="/programacao" className="br-button secondary small">
                Ver programação
              </Link>
            </div>
          </div>
        </div>
        
        <div className="col-12 col-md-4 mb-3">
          <div className="br-card">
            <div className="card-header">
              <i className="fas fa-file-alt fa-2x text-primary-default"></i>
            </div>
            <div className="card-content">
              <h5 className="text-weight-semi-bold mb-2">Submissão</h5>
              <p className="text-down-01">
                Submeta seu trabalho e participe do simpósio
              </p>
              {isAuthenticated ? (
                <Link to="/submeter-trabalho" className="br-button secondary small">
                  Submeter trabalho
                </Link>
              ) : (
                <button 
                  onClick={() => setShowLoginModal(true)} 
                  className="br-button secondary small"
                >
                  Submeter trabalho
                </button>
              )}
            </div>
          </div>
        </div>
        
        <div className="col-12 col-md-4 mb-3">
          <div className="br-card">
            <div className="card-header">
              <i className="fas fa-certificate fa-2x text-primary-default"></i>
            </div>
            <div className="card-content">
              <h5 className="text-weight-semi-bold mb-2">Certificados</h5>
              <p className="text-down-01">
                Valide ou baixe certificados de participação
              </p>
              <Link to="/validar-certificado" className="br-button secondary small">
                Validar certificado
              </Link>
            </div>
          </div>
        </div>
      </div>
      
      <div className="br-divider my-4"></div>
      
      <div className="row">
        <div className="col-12 col-md-8">
          <h2 className="text-up-02 text-weight-semi-bold mb-3">Sobre o Simpósio</h2>
          <p className="text-base">
            O Simpósio Anual é um evento acadêmico que reúne pesquisadores, estudantes e 
            profissionais de diversas áreas do conhecimento para compartilhar experiências, 
            apresentar trabalhos e discutir os avanços científicos e tecnológicos.
          </p>
          <p className="text-base">
            Através desta plataforma, você pode se inscrever no evento, submeter trabalhos, 
            consultar a programação, avaliar trabalhos (se for avaliador) e emitir certificados.
          </p>
        </div>
        
        <div className="col-12 col-md-4">
          <div className="br-card bg-primary-lighten-01">
            <div className="card-content">
              <h5 className="text-weight-semi-bold mb-2">Links Importantes</h5>
              <ul className="br-list">
                <li>
                  <Link className="br-item" to="/apresentacao">Apresentação</Link>
                </li>
                <li>
                  <Link className="br-item" to="/regulamento">Regulamento</Link>
                </li>
                <li>
                  <Link className="br-item" to="/normas-publicacao">Normas de Publicação</Link>
                </li>
                <li>
                  <Link className="br-item" to="/modelo-poster">Modelo de Pôster</Link>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      
      <LoginModal 
        isOpen={showLoginModal} 
        onClose={() => setShowLoginModal(false)} 
      />
    </MainLayout>
  );
};

export default Home;
