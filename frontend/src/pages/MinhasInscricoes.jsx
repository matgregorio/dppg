import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const MinhasInscricoes = () => {
  const [inscricoes, setInscricoes] = useState([]);
  const [subeventos, setSubeventos] = useState([]);
  const [loading, setLoading] = useState(true);
  const [loadingSubeventos, setLoadingSubeventos] = useState(false);
  const [error, setError] = useState('');
  const [showModal, setShowModal] = useState(false);
  const [inscrevendo, setInscrevendo] = useState(false);
  const [inscricaoExpandida, setInscricaoExpandida] = useState(null);
  const currentYear = new Date().getFullYear();
  
  useEffect(() => {
    fetchInscricoes();
  }, []);
  
  const fetchInscricoes = async () => {
    try {
      setLoading(true);
      const { data } = await api.get('/user/inscricoes');
      if (data.success) {
        setInscricoes(data.data);
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao carregar inscrições');
    } finally {
      setLoading(false);
    }
  };

  const fetchSubeventos = async (simposioId) => {
    try {
      setLoadingSubeventos(true);
      // Buscar subeventos do simpósio com informações de presença do usuário
      // Adiciona timestamp para evitar cache
      const { data } = await api.get(`/public/simposios/${simposioId}/subeventos?t=${Date.now()}`);
      if (data.success) {
        console.log('[DEBUG] Subeventos recebidos:', data.data.map(s => ({ titulo: s.titulo, presenca: s.presenca })));
        setSubeventos(data.data);
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao carregar subeventos');
    } finally {
      setLoadingSubeventos(false);
    }
  };

  const toggleInscricao = (inscricaoId, simposioId) => {
    if (inscricaoExpandida === inscricaoId) {
      setInscricaoExpandida(null);
      setSubeventos([]);
    } else {
      setInscricaoExpandida(inscricaoId);
      fetchSubeventos(simposioId);
    }
  };
  
  const handleNovaInscricao = async () => {
    try {
      setInscrevendo(true);
      setError('');
      
      const { data } = await api.post('/user/inscricoes/simposio', {
        ano: currentYear,
      });
      
      if (data.success) {
        setShowModal(false);
        fetchInscricoes();
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao criar inscrição');
    } finally {
      setInscrevendo(false);
    }
  };
  
  const getStatusBadge = (status) => {
    return status === 'ATIVA' 
      ? <span className="br-tag success">Ativa</span>
      : <span className="br-tag danger">Cancelada</span>;
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
            <span>Minhas Inscrições</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <div className="d-flex justify-content-between align-items-center mb-4">
          <h1 className="text-up-03 text-weight-bold">Minhas Inscrições</h1>
          <button onClick={() => setShowModal(true)} className="br-button primary">
            <i className="fas fa-plus mr-2"></i>
            Nova Inscrição
          </button>
        </div>
        
        {error && (
          <div className="br-message danger mb-3" role="alert">
            <div className="icon">
              <i className="fas fa-times-circle fa-lg" aria-hidden="true"></i>
            </div>
            <div className="content">{error}</div>
          </div>
        )}
        
        {loading ? (
          <div className="text-center my-5">
            <div className="br-loading" aria-label="Carregando"></div>
          </div>
        ) : inscricoes.length === 0 ? (
          <div className="br-card">
            <div className="card-content text-center py-5">
              <i className="fas fa-clipboard-list fa-3x text-gray-40 mb-3"></i>
              <p className="text-up-01 text-weight-medium">Nenhuma inscrição encontrada</p>
              <p className="text-down-01 mb-3">Faça sua inscrição no simpósio {currentYear}</p>
              <button onClick={() => setShowModal(true)} className="br-button primary">
                Inscrever-se Agora
              </button>
            </div>
          </div>
        ) : (
          <div className="row">
            {inscricoes.map((inscricao) => (
              <div key={inscricao._id} className="col-12 mb-3">
                <div className="br-card">
                  <div className="card-header">
                    <div className="d-flex justify-content-between align-items-center">
                      <h5 className="text-weight-semi-bold mb-0">
                        Simpósio {inscricao.simposio?.ano}
                      </h5>
                      {getStatusBadge(inscricao.status)}
                    </div>
                  </div>
                  <div className="card-content">
                    <div className="mb-2">
                      <i className="fas fa-calendar mr-2 text-primary-default"></i>
                      <strong>Data da Inscrição:</strong>{' '}
                      {new Date(inscricao.dataInscricao).toLocaleDateString('pt-BR')}
                    </div>
                    <div className="mb-3">
                      <i className="fas fa-info-circle mr-2 text-primary-default"></i>
                      <strong>Status do Simpósio:</strong>{' '}
                      <span className={
                        inscricao.simposio?.status === 'INICIALIZADO' 
                          ? 'text-success' 
                          : 'text-gray-60'
                      }>
                        {inscricao.simposio?.status === 'INICIALIZADO' ? 'Em andamento' : 'Finalizado'}
                      </span>
                    </div>

                    <div className="d-flex gap-2">
                      <button
                        className="br-button secondary small"
                        onClick={() => toggleInscricao(inscricao._id, inscricao.simposio._id)}
                      >
                        <i className={`fas fa-${inscricaoExpandida === inscricao._id ? 'chevron-up' : 'chevron-down'} mr-2`}></i>
                        {inscricaoExpandida === inscricao._id ? 'Ocultar' : 'Ver'} Subeventos
                      </button>
                    </div>

                    {/* Lista de Subeventos */}
                    {inscricaoExpandida === inscricao._id && (
                      <div className="mt-3">
                        <div className="br-divider my-3"></div>
                        <h6 className="text-weight-semi-bold mb-3">Subeventos Disponíveis</h6>
                        
                        {loadingSubeventos ? (
                          <div className="text-center py-3">
                            <div className="br-loading small" aria-label="Carregando"></div>
                          </div>
                        ) : subeventos.length === 0 ? (
                          <p className="text-center text-gray-60">Nenhum subevento cadastrado</p>
                        ) : (
                          <div className="list-group">
                            {subeventos.map((subevento) => (
                              <div key={subevento._id} className="list-group-item p-3">
                                <div className="d-flex justify-content-between align-items-start">
                                  <div className="flex-fill">
                                    <h6 className="text-weight-semi-bold mb-2">{subevento.titulo}</h6>
                                    {subevento.evento && (
                                      <p className="mb-1">
                                        <i className="fas fa-bookmark mr-2 text-primary-default"></i>
                                        <strong>Evento:</strong> {subevento.evento}
                                      </p>
                                    )}
                                    {subevento.palestrante && (
                                      <p className="mb-1">
                                        <i className="fas fa-user mr-2 text-primary-default"></i>
                                        <strong>Palestrante:</strong> {subevento.palestrante}
                                      </p>
                                    )}
                                    <p className="mb-1">
                                      <i className="fas fa-calendar mr-2 text-primary-default"></i>
                                      {new Date(subevento.data).toLocaleDateString('pt-BR')} às {subevento.horarioInicio}
                                    </p>
                                    {subevento.local && (
                                      <p className="mb-1">
                                        <i className="fas fa-map-marker-alt mr-2 text-primary-default"></i>
                                        {subevento.local}
                                      </p>
                                    )}
                                    <div className="mt-2">
                                      {subevento.presenca ? (
                                        <span className="br-tag success">
                                          <i className="fas fa-check-circle mr-1"></i>
                                          Presença Confirmada
                                        </span>
                                      ) : (
                                        <span className="br-tag warning">
                                          <i className="fas fa-clock mr-1"></i>
                                          Aguardando Presença
                                        </span>
                                      )}
                                    </div>
                                  </div>
                                </div>
                              </div>
                            ))}
                          </div>
                        )}
                      </div>
                    )}
                  </div>
                </div>
              </div>
            ))}
          </div>
        )}
      </div>
      
      {/* Modal de confirmação de inscrição */}
      {showModal && (
        <div className="br-modal active" style={{ display: 'block' }}>
          <div className="br-modal-dialog">
            <div className="br-modal-content">
              <div className="br-modal-header">
                <div className="br-modal-title">Confirmar Inscrição</div>
              </div>
              <div className="br-modal-body">
                <p>Deseja confirmar sua inscrição no Simpósio {currentYear}?</p>
                {error && (
                  <div className="br-message danger mt-3" role="alert">
                    <div className="icon">
                      <i className="fas fa-times-circle fa-lg" aria-hidden="true"></i>
                    </div>
                    <div className="content">{error}</div>
                  </div>
                )}
              </div>
              <div className="br-modal-footer">
                <button
                  className="br-button secondary"
                  onClick={() => setShowModal(false)}
                  disabled={inscrevendo}
                >
                  Cancelar
                </button>
                <button
                  className="br-button primary"
                  onClick={handleNovaInscricao}
                  disabled={inscrevendo}
                >
                  {inscrevendo ? 'Inscrevendo...' : 'Confirmar'}
                </button>
              </div>
            </div>
          </div>
          <div className="br-scrim" onClick={() => !inscrevendo && setShowModal(false)}></div>
        </div>
      )}
    </MainLayout>
  );
};

export default MinhasInscricoes;
