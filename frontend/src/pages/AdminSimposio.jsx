import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const AdminSimposio = () => {
  const [simposio, setSimposio] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  const [showModal, setShowModal] = useState(false);
  const [modalAction, setModalAction] = useState(''); // 'inicializar' ou 'finalizar'
  const currentYear = new Date().getFullYear();
  
  useEffect(() => {
    fetchSimposio();
  }, [currentYear]);
  
  const fetchSimposio = async () => {
    try {
      setLoading(true);
      const { data } = await api.get(`/admin/simposios/${currentYear}`);
      if (data.success) {
        setSimposio(data.data);
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao carregar simpósio');
    } finally {
      setLoading(false);
    }
  };
  
  const handleInicializar = () => {
    setModalAction('inicializar');
    setShowModal(true);
  };
  
  const handleFinalizar = () => {
    setModalAction('finalizar');
    setShowModal(true);
  };
  
  const confirmAction = async () => {
    try {
      setError('');
      setSuccess('');
      
      if (modalAction === 'inicializar') {
        const { data } = await api.post(`/admin/simposios/${currentYear}/inicializar`);
        if (data.success) {
          setSuccess('Simpósio inicializado com sucesso!');
          fetchSimposio();
        }
      } else if (modalAction === 'finalizar') {
        const { data } = await api.post(`/admin/simposios/${currentYear}/finalizar`);
        if (data.success) {
          setSuccess('Simpósio finalizado com sucesso!');
          fetchSimposio();
        }
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao executar ação');
    } finally {
      setShowModal(false);
      setModalAction('');
    }
  };
  
  const getStatusBadge = (status) => {
    const badges = {
      PLANEJAMENTO: 'info',
      EM_ANDAMENTO: 'success',
      FINALIZADO: 'warning',
    };
    return badges[status] || 'secondary';
  };
  
  const formatDateTime = (dateString) => {
    if (!dateString) return 'Não configurado';
    const date = new Date(dateString);
    return date.toLocaleString('pt-BR', {
      day: '2-digit',
      month: '2-digit',
      year: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    });
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
            <span>Gerenciar Simpósio</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">Gerenciar Simpósio {currentYear}</h1>
        
        {error && (
          <div className="br-message danger mb-3" role="alert">
            <div className="icon">
              <i className="fas fa-times-circle fa-lg" aria-hidden="true"></i>
            </div>
            <div className="content">{error}</div>
          </div>
        )}
        
        {success && (
          <div className="br-message success mb-3" role="alert">
            <div className="icon">
              <i className="fas fa-check-circle fa-lg" aria-hidden="true"></i>
            </div>
            <div className="content">{success}</div>
          </div>
        )}
        
        {loading ? (
          <div className="text-center my-5">
            <div className="br-loading" aria-label="Carregando"></div>
          </div>
        ) : !simposio ? (
          <div className="br-card">
            <div className="card-content text-center py-5">
              <i className="fas fa-calendar-times fa-3x text-gray-40 mb-3"></i>
              <p className="text-up-01 text-weight-medium">Simpósio não encontrado</p>
              <p className="text-down-01">
                O simpósio para o ano {currentYear} ainda não foi criado
              </p>
            </div>
          </div>
        ) : (
          <>
            <div className="br-card mb-3">
              <div className="card-header">
                <h3 className="text-weight-semi-bold">Informações do Simpósio</h3>
              </div>
              <div className="card-content">
                <div className="row mb-3">
                  <div className="col-md-6">
                    <strong>Ano:</strong> {simposio.ano}
                  </div>
                  <div className="col-md-6">
                    <strong>Status:</strong>{' '}
                    <span className={`br-tag ${getStatusBadge(simposio.status)}`}>
                      {simposio.status}
                    </span>
                  </div>
                </div>
                
                <div className="mb-3">
                  <strong>Tema:</strong> {simposio.tema || 'N/A'}
                </div>
                
                <div className="d-flex gap-2">
                  {simposio.status === 'PLANEJAMENTO' && (
                    <button
                      onClick={handleInicializar}
                      className="br-button primary"
                    >
                      <i className="fas fa-play-circle mr-2"></i>
                      Inicializar Simpósio
                    </button>
                  )}
                  
                  {simposio.status === 'EM_ANDAMENTO' && (
                    <button
                      onClick={handleFinalizar}
                      className="br-button secondary"
                    >
                      <i className="fas fa-stop-circle mr-2"></i>
                      Finalizar Simpósio
                    </button>
                  )}
                  
                  <Link
                    to={`/admin/simposios/${currentYear}/datas`}
                    className="br-button secondary"
                  >
                    <i className="fas fa-calendar-alt mr-2"></i>
                    Configurar Datas
                  </Link>
                </div>
              </div>
            </div>
            
            {/* Calendário de Datas Configuradas */}
            {simposio.datasConfig && (
              <div className="br-card mb-3">
                <div className="card-header">
                  <h3 className="text-weight-semi-bold">
                    <i className="fas fa-calendar-alt mr-2"></i>
                    Datas Configuradas
                  </h3>
                </div>
                <div className="card-content">
                  <div className="row">
                    <div className="col-md-6 mb-3">
                      <div className="br-card" style={{ background: '#E8F5E9', border: '1px solid #4CAF50' }}>
                        <div className="card-content p-3">
                          <h5 className="text-weight-semi-bold mb-2">
                            <i className="fas fa-users text-success mr-2"></i>
                            Inscrição de Participantes
                          </h5>
                          <div className="mb-2">
                            <small className="text-muted">Início:</small>
                            <br />
                            <strong>{formatDateTime(simposio.datasConfig.inscricaoParticipante?.inicio)}</strong>
                          </div>
                          <div>
                            <small className="text-muted">Fim:</small>
                            <br />
                            <strong>{formatDateTime(simposio.datasConfig.inscricaoParticipante?.fim)}</strong>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div className="col-md-6 mb-3">
                      <div className="br-card" style={{ background: '#E3F2FD', border: '1px solid #2196F3' }}>
                        <div className="card-content p-3">
                          <h5 className="text-weight-semi-bold mb-2">
                            <i className="fas fa-file-alt text-primary mr-2"></i>
                            Submissão de Trabalhos
                          </h5>
                          <div className="mb-2">
                            <small className="text-muted">Início:</small>
                            <br />
                            <strong>{formatDateTime(simposio.datasConfig.submissaoTrabalhos?.inicio)}</strong>
                          </div>
                          <div>
                            <small className="text-muted">Fim:</small>
                            <br />
                            <strong>{formatDateTime(simposio.datasConfig.submissaoTrabalhos?.fim)}</strong>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div className="col-md-6 mb-3">
                      <div className="br-card" style={{ background: '#FFF3E0', border: '1px solid #FF9800' }}>
                        <div className="card-content p-3">
                          <h5 className="text-weight-semi-bold mb-2">
                            <i className="fas fa-clipboard-check text-warning mr-2"></i>
                            Prazo de Avaliação
                          </h5>
                          <div className="mb-2">
                            <small className="text-muted">Início:</small>
                            <br />
                            <strong>{formatDateTime(simposio.datasConfig.prazoAvaliacao?.inicio)}</strong>
                          </div>
                          <div>
                            <small className="text-muted">Fim:</small>
                            <br />
                            <strong>{formatDateTime(simposio.datasConfig.prazoAvaliacao?.fim)}</strong>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div className="col-md-6 mb-3">
                      <div className="br-card" style={{ background: '#FCE4EC', border: '1px solid #E91E63' }}>
                        <div className="card-content p-3">
                          <h5 className="text-weight-semi-bold mb-2">
                            <i className="fas fa-star text-danger mr-2"></i>
                            Notas de Avaliação Externa
                          </h5>
                          <div className="mb-2">
                            <small className="text-muted">Início:</small>
                            <br />
                            <strong>{formatDateTime(simposio.datasConfig.notasAvaliacaoExterna?.inicio)}</strong>
                          </div>
                          <div>
                            <small className="text-muted">Fim:</small>
                            <br />
                            <strong>{formatDateTime(simposio.datasConfig.notasAvaliacaoExterna?.fim)}</strong>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div className="text-center mt-3">
                    <Link
                      to={`/admin/simposios/${currentYear}/datas`}
                      className="br-button primary"
                    >
                      <i className="fas fa-edit mr-2"></i>
                      Editar Datas
                    </Link>
                  </div>
                </div>
              </div>
            )}
            
            <div className="br-card">
              <div className="card-header">
                <h3 className="text-weight-semi-bold">Ações Rápidas</h3>
              </div>
              <div className="card-content">
                <div className="row">
                  <div className="col-md-6 mb-3">
                    <Link to="/admin/participantes" className="br-button secondary block">
                      <i className="fas fa-users mr-2"></i>
                      Gerenciar Participantes
                    </Link>
                  </div>
                  <div className="col-md-6 mb-3">
                    <Link to="/admin/trabalhos" className="br-button secondary block">
                      <i className="fas fa-file-alt mr-2"></i>
                      Gerenciar Trabalhos
                    </Link>
                  </div>
                  <div className="col-md-6 mb-3">
                    <Link to="/admin/avaliadores" className="br-button secondary block">
                      <i className="fas fa-user-tie mr-2"></i>
                      Gerenciar Avaliadores
                    </Link>
                  </div>
                  <div className="col-md-6 mb-3">
                    <Link to="/admin/subeventos" className="br-button secondary block">
                      <i className="fas fa-calendar-day mr-2"></i>
                      Gerenciar Subeventos
                    </Link>
                  </div>
                  <div className="col-md-6 mb-3">
                    <Link to="/admin/areas" className="br-button secondary block">
                      <i className="fas fa-sitemap mr-2"></i>
                      Áreas de Conhecimento
                    </Link>
                  </div>
                  <div className="col-md-6 mb-3">
                    <Link to="/admin/paginas" className="br-button secondary block">
                      <i className="fas fa-file-code mr-2"></i>
                      Páginas Estáticas
                    </Link>
                  </div>
                </div>
              </div>
            </div>
          </>
        )}
      </div>
      
      {showModal && (
        <>
          <div className="br-scrim" onClick={() => setShowModal(false)}></div>
          <div className="br-modal medium" style={{ display: 'block' }}>
            <div className="br-modal-header">
              <h4>Confirmar Ação</h4>
            </div>
            <div className="br-modal-body">
              <p>
                {modalAction === 'inicializar'
                  ? 'Tem certeza que deseja inicializar o simpósio? Esta ação mudará o status para EM_ANDAMENTO.'
                  : 'Tem certeza que deseja finalizar o simpósio? Esta ação mudará o status para FINALIZADO e não poderá ser revertida.'}
              </p>
            </div>
            <div className="br-modal-footer">
              <button
                className="br-button secondary"
                onClick={() => setShowModal(false)}
              >
                Cancelar
              </button>
              <button
                className="br-button primary"
                onClick={confirmAction}
              >
                Confirmar
              </button>
            </div>
          </div>
        </>
      )}
    </MainLayout>
  );
};

export default AdminSimposio;
