import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { useSelector } from 'react-redux';
import MainLayout from '../layouts/MainLayout';
import LoginModal from '../components/modals/LoginModal';
import RegisterModal from '../components/modals/RegisterModal';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

const Home = () => {
  const currentYear = new Date().getFullYear();
  const { isAuthenticated } = useSelector((state) => state.auth);
  const [showLoginModal, setShowLoginModal] = useState(false);
  const [showRegisterModal, setShowRegisterModal] = useState(false);
  const [inscricaoAtual, setInscricaoAtual] = useState(null);
  const [loadingInscricao, setLoadingInscricao] = useState(true);
  const [inscrevendo, setInscrevendo] = useState(false);
  const [simposio, setSimposio] = useState(null);
  const [loadingSimposio, setLoadingSimposio] = useState(true);
  const { showSuccess, showError } = useNotification();
  
  useEffect(() => {
    buscarSimposio();
    if (isAuthenticated) {
      verificarInscricao();
    } else {
      setLoadingInscricao(false);
    }
  }, [isAuthenticated]);
  
  useEffect(() => {
    console.log('📊 Estado do simpósio:', simposio);
    console.log('⏳ Loading simpósio:', loadingSimposio);
  }, [simposio, loadingSimposio]);
  
  const buscarSimposio = async () => {
    try {
      setLoadingSimposio(true);
      console.log('🔍 Buscando simpósio do ano:', currentYear);
      const { data } = await api.get(`/public/simposios/${currentYear}`);
      
      console.log('📦 Resposta da API:', data);
      
      if (data.success) {
        console.log('✅ Simpósio encontrado:', data.data);
        setSimposio(data.data);
      }
    } catch (err) {
      console.error('❌ Erro ao buscar simpósio:', err);
      console.error('❌ Detalhes do erro:', err.response?.data);
    } finally {
      setLoadingSimposio(false);
    }
  };
  
  const verificarInscricao = async () => {
    try {
      setLoadingInscricao(true);
      const { data } = await api.get('/user/inscricoes');
      
      if (data.success) {
        // Verifica se existe inscrição ativa no ano atual
        const inscricaoAnoAtual = data.data.find(
          insc => insc.simposio?.ano === currentYear && insc.status === 'ATIVA'
        );
        setInscricaoAtual(inscricaoAnoAtual || null);
      }
    } catch (err) {
      console.error('Erro ao verificar inscrição:', err);
    } finally {
      setLoadingInscricao(false);
    }
  };
  
  const handleInscrever = async () => {
    if (!isAuthenticated) {
      setShowLoginModal(true);
      return;
    }
    
    try {
      setInscrevendo(true);
      const { data } = await api.post('/user/inscricoes/simposio', {
        simposioAno: currentYear
      });
      
      if (data.success) {
        showSuccess('Inscrição realizada com sucesso!');
        verificarInscricao();
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao realizar inscrição');
    } finally {
      setInscrevendo(false);
    }
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
          <li className="crumb" data-active="active">
            <i className="icon fas fa-chevron-right"></i>
            <span>Início</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-3">
          {loadingSimposio ? `Simpósio Anual ${currentYear}` : simposio?.nome || `Simpósio Anual ${currentYear}`}
        </h1>
        <p className="text-up-01">
          Bem-vindo ao Sistema de Gerenciamento do Simpósio Anual
        </p>
      </div>
      
      {/* Botão de Inscrição no Simpósio */}
      {(!isAuthenticated || (isAuthenticated && !loadingInscricao && !inscricaoAtual)) && (
        <div className="br-card mb-4" style={{ 
          background: 'linear-gradient(135deg, #1351B4 0%, #071D41 100%)',
          border: 'none',
          color: 'white'
        }}>
          <div className="card-content p-4">
            {loadingSimposio ? (
              <div className="text-center py-4">
                <span className="spinner-border spinner-border-lg" role="status" style={{ color: 'white' }}></span>
                <p className="mt-3 mb-0" style={{ color: 'white' }}>Carregando informações do simpósio...</p>
              </div>
            ) : (
              <div className="row align-items-center">
                <div className="col-md-8">
                  <div className="d-flex align-items-center mb-3">
                    <i className="fas fa-clipboard-check fa-3x mr-3"></i>
                    <div>
                      <h3 className="text-weight-bold mb-1" style={{ color: 'white' }}>
                        Inscreva-se no {simposio?.nome || `Simpósio ${currentYear}`}
                      </h3>
                      <p className="mb-0" style={{ color: 'rgba(255,255,255,0.9)' }}>
                        {!isAuthenticated 
                          ? 'Faça login e garanta sua participação no evento'
                          : 'Faça sua inscrição agora e participe do evento'}
                      </p>
                      {simposio?.datas?.inscricaoParticipante?.fim && (
                        <p className="mb-0 mt-2" style={{ color: '#FFCD07', fontWeight: 'bold' }}>
                          <i className="fas fa-clock mr-1"></i>
                          As inscrições vão até {new Date(simposio.datas.inscricaoParticipante.fim).toLocaleDateString('pt-BR', { 
                            day: '2-digit', 
                            month: '2-digit', 
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                          })}
                        </p>
                      )}
                    </div>
                  </div>
                  <ul className="pl-4 mb-0" style={{ color: 'rgba(255,255,255,0.9)' }}>
                    <li>Participe de palestras e apresentações</li>
                    <li>Submeta seus trabalhos científicos</li>
                    <li>Receba certificado de participação</li>
                  </ul>
                </div>
                <div className="col-md-4 text-center">
                  {!isAuthenticated ? (
                    <button 
                      onClick={() => setShowLoginModal(true)}
                      className="br-button primary large"
                      style={{ 
                        background: 'white',
                        color: '#1351B4',
                        fontWeight: 'bold',
                        padding: '12px 32px'
                      }}
                    >
                      <i className="fas fa-sign-in-alt mr-2"></i>
                      Fazer Login para Inscrever
                    </button>
                  ) : (
                    <button 
                      onClick={handleInscrever}
                      disabled={inscrevendo}
                      className="br-button primary large"
                      style={{ 
                        background: 'white',
                        color: '#1351B4',
                        fontWeight: 'bold',
                        padding: '12px 32px'
                      }}
                    >
                      {inscrevendo ? (
                        <>
                          <span className="spinner-border spinner-border-sm mr-2" role="status"></span>
                          Inscrevendo...
                        </>
                      ) : (
                        <>
                          <i className="fas fa-user-plus mr-2"></i>
                          Inscrever-me Agora
                        </>
                      )}
                    </button>
                  )}
                </div>
              </div>
            )}
          </div>
        </div>
      )}
      
      {/* Mensagem quando já está inscrito */}
      {isAuthenticated && !loadingInscricao && inscricaoAtual && (
        <div className="br-message success mb-4">
          <div className="icon">
            <i className="fas fa-check-circle fa-lg"></i>
          </div>
          <div className="content">
            <span className="message-title">Você já está inscrito no {simposio?.nome || `Simpósio ${currentYear}`}!</span>
            <span className="message-body">
              Sua inscrição está ativa. Você pode submeter trabalhos e participar do evento.
            </span>
          </div>
        </div>
      )}
      
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
        <div className="col-12">
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
    </MainLayout>
  );
};

export default Home;
