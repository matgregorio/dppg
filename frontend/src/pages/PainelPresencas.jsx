import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const PainelPresencas = () => {
  const { subeventoId } = useParams();
  const [subevento, setSubevento] = useState(null);
  const [presencas, setPresencas] = useState([]);
  const [participantes, setParticipantes] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  const [autoRefresh, setAutoRefresh] = useState(true);
  const [showAdicionarModal, setShowAdicionarModal] = useState(false);
  const [showConfirmarModal, setShowConfirmarModal] = useState(false);
  const [cpfBusca, setCpfBusca] = useState('');
  const [participanteSelecionado, setParticipanteSelecionado] = useState(null);
  const [buscandoParticipante, setBuscandoParticipante] = useState(false);
  
  useEffect(() => {
    fetchData();
  }, [subeventoId]);
  
  useEffect(() => {
    if (!autoRefresh) return;
    
    const interval = setInterval(() => {
      fetchPresencas();
    }, 5000); // Atualiza a cada 5 segundos
    
    return () => clearInterval(interval);
  }, [autoRefresh, subeventoId]);
  
  const fetchData = async () => {
    try {
      setLoading(true);
      await Promise.all([fetchSubevento(), fetchPresencas()]);
    } catch (err) {
      setError('Erro ao carregar dados');
    } finally {
      setLoading(false);
    }
  };
  
  const fetchSubevento = async () => {
    const { data } = await api.get(`/mesario/subeventos/${subeventoId}`);
    if (data.success) {
      setSubevento(data.data);
    }
  };
  
  const fetchPresencas = async () => {
    const { data } = await api.get(`/mesario/subeventos/${subeventoId}/presencas`);
    if (data.success) {
      setPresencas(data.data);
    }
  };

  const buscarParticipante = async () => {
    try {
      setBuscandoParticipante(true);
      setError('');
      const { data } = await api.get(`/admin/participantes?cpf=${cpfBusca}`);
      if (data.success && data.data.length > 0) {
        setParticipanteSelecionado(data.data[0]);
      } else {
        setError('Participante não encontrado');
        setParticipanteSelecionado(null);
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao buscar participante');
      setParticipanteSelecionado(null);
    } finally {
      setBuscandoParticipante(false);
    }
  };

  const confirmarPresencaManual = async (participantId) => {
    try {
      setError('');
      setSuccess('');
      const { data } = await api.post(`/mesario/subeventos/${subeventoId}/presenca-manual`, {
        participantId
      });
      if (data.success) {
        setSuccess('Presença confirmada com sucesso!');
        setShowAdicionarModal(false);
        setShowConfirmarModal(false);
        setCpfBusca('');
        setParticipanteSelecionado(null);
        fetchPresencas();
        setTimeout(() => setSuccess(''), 3000);
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao confirmar presença');
    }
  };
  
  const formatDateTime = (dateString) => {
    if (!dateString) return 'N/A';
    const date = new Date(dateString);
    return date.toLocaleString('pt-BR', {
      day: '2-digit',
      month: '2-digit',
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
    });
  };
  
  const getOrigemBadge = (origem) => {
    const badges = {
      QR_CODE: { class: 'success', icon: 'fa-qrcode', text: 'QR Code' },
      MANUAL: { class: 'info', icon: 'fa-hand-pointer', text: 'Manual' },
    };
    return badges[origem] || { class: 'secondary', icon: 'fa-question', text: origem };
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
            <Link to="/mesario/subeventos">Meus Subeventos</Link>
          </li>
          <li className="crumb">
            <i className="icon fas fa-chevron-right"></i>
            <span>Painel de Presenças</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <div className="d-flex justify-content-between align-items-center mb-4">
          <h1 className="text-up-03 text-weight-bold">Painel de Presenças</h1>
          
          <div className="d-flex align-items-center gap-2">
            <div className="br-switch small">
              <input
                id="autoRefresh"
                type="checkbox"
                checked={autoRefresh}
                onChange={(e) => setAutoRefresh(e.target.checked)}
              />
              <label htmlFor="autoRefresh">
                <i className="fas fa-sync-alt mr-1"></i>
                Atualização automática
              </label>
            </div>
          </div>
        </div>

        {success && (
          <div className="br-message success mb-3" role="alert">
            <div className="icon">
              <i className="fas fa-check-circle fa-lg" aria-hidden="true"></i>
            </div>
            <div className="content">{success}</div>
          </div>
        )}
        
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
        ) : !subevento ? (
          <div className="br-card">
            <div className="card-content text-center py-5">
              <i className="fas fa-exclamation-triangle fa-3x text-gray-40 mb-3"></i>
              <p className="text-up-01 text-weight-medium">Subevento não encontrado</p>
            </div>
          </div>
        ) : (
          <>
            <div className="br-card mb-3">
              <div className="card-header">
                <h3 className="text-weight-semi-bold">{subevento.titulo}</h3>
              </div>
              <div className="card-content">
                <div className="row">
                  <div className="col-md-6">
                    {subevento.evento && (
                      <p>
                        <strong>Evento:</strong> {subevento.evento}
                      </p>
                    )}
                    {subevento.palestrante && (
                      <p>
                        <strong>Palestrante:</strong> {subevento.palestrante}
                      </p>
                    )}
                    <p>
                      <strong>Data:</strong> {new Date(subevento.data).toLocaleDateString('pt-BR')} às {subevento.horarioInicio}
                    </p>
                    {subevento.local && (
                      <p>
                        <strong>Local:</strong> {subevento.local}
                      </p>
                    )}
                  </div>
                  <div className="col-md-6">
                    <div className="text-right mb-3">
                      <span className="br-tag success large">
                        <i className="fas fa-check-circle mr-2"></i>
                        {presencas.length} Presenças
                      </span>
                    </div>
                    <div className="d-flex justify-content-end gap-2">
                      <button
                        className="br-button secondary small"
                        onClick={() => setShowConfirmarModal(true)}
                      >
                        <i className="fas fa-user-check mr-2"></i>
                        Confirmar Presença
                      </button>
                      <button
                        className="br-button primary small"
                        onClick={() => setShowAdicionarModal(true)}
                      >
                        <i className="fas fa-user-plus mr-2"></i>
                        Adicionar Pessoa
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            {presencas.length === 0 ? (
              <div className="br-card">
                <div className="card-content text-center py-5">
                  <i className="fas fa-user-clock fa-3x text-gray-40 mb-3"></i>
                  <p className="text-up-01 text-weight-medium">Nenhuma presença registrada</p>
                  <p className="text-down-01">
                    Aguardando check-in dos participantes
                  </p>
                </div>
              </div>
            ) : (
              <div className="br-table">
                <table>
                  <thead>
                    <tr>
                      <th scope="col">Participante</th>
                      <th scope="col">CPF</th>
                      <th scope="col">Horário</th>
                      <th scope="col">Origem</th>
                    </tr>
                  </thead>
                  <tbody>
                    {presencas.map((presenca) => {
                      // Pega o último checkin
                      const ultimoCheckin = presenca.checkins?.[presenca.checkins.length - 1];
                      const origem = getOrigemBadge(ultimoCheckin?.origem || 'DESCONHECIDO');
                      
                      return (
                        <tr key={presenca._id}>
                          <td>{presenca.participante?.nome || 'N/A'}</td>
                          <td>{presenca.participante?.cpf || 'N/A'}</td>
                          <td>{formatDateTime(ultimoCheckin?.timestamp)}</td>
                          <td>
                            <span className={`br-tag ${origem.class}`}>
                              <i className={`fas ${origem.icon} mr-1`}></i>
                              {origem.text}
                            </span>
                          </td>
                        </tr>
                      );
                    })}
                  </tbody>
                </table>
              </div>
            )}
          </>
        )}
      </div>

      {/* Modal para adicionar pessoa sem inscrição */}
      {showAdicionarModal && (
        <div className="br-modal active" style={{ display: 'block' }}>
          <div className="br-modal-dialog">
            <div className="br-modal-content">
              <div className="br-modal-header">
                <div className="br-modal-title">
                  <i className="fas fa-user-plus mr-2"></i>
                  Adicionar Pessoa Sem Inscrição
                </div>
              </div>
              <div className="br-modal-body">
                <p className="mb-3">
                  Busque o participante pelo CPF para adicionar presença manualmente:
                </p>
                <div className="br-input mb-3">
                  <label htmlFor="cpf-busca">CPF do Participante</label>
                  <input
                    id="cpf-busca"
                    type="text"
                    placeholder="Digite o CPF"
                    value={cpfBusca}
                    onChange={(e) => setCpfBusca(e.target.value)}
                    maxLength={14}
                  />
                </div>
                <button
                  className="br-button secondary mb-3"
                  onClick={buscarParticipante}
                  disabled={!cpfBusca || buscandoParticipante}
                >
                  <i className="fas fa-search mr-2"></i>
                  {buscandoParticipante ? 'Buscando...' : 'Buscar'}
                </button>

                {participanteSelecionado && (
                  <div className="br-card mt-3">
                    <div className="card-content">
                      <h6 className="text-weight-semi-bold mb-2">Participante Encontrado</h6>
                      <p className="mb-1"><strong>Nome:</strong> {participanteSelecionado.nome}</p>
                      <p className="mb-1"><strong>CPF:</strong> {participanteSelecionado.cpf}</p>
                      <p className="mb-1"><strong>Email:</strong> {participanteSelecionado.email}</p>
                    </div>
                  </div>
                )}

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
                  onClick={() => {
                    setShowAdicionarModal(false);
                    setCpfBusca('');
                    setParticipanteSelecionado(null);
                    setError('');
                  }}
                >
                  Cancelar
                </button>
                <button
                  className="br-button primary"
                  onClick={() => confirmarPresencaManual(participanteSelecionado._id)}
                  disabled={!participanteSelecionado}
                >
                  <i className="fas fa-check mr-2"></i>
                  Confirmar Presença
                </button>
              </div>
            </div>
          </div>
          <div className="br-scrim" onClick={() => {
            setShowAdicionarModal(false);
            setCpfBusca('');
            setParticipanteSelecionado(null);
            setError('');
          }}></div>
        </div>
      )}

      {/* Modal para confirmar presença de quem já tem inscrição */}
      {showConfirmarModal && (
        <div className="br-modal active" style={{ display: 'block' }}>
          <div className="br-modal-dialog">
            <div className="br-modal-content">
              <div className="br-modal-header">
                <div className="br-modal-title">
                  <i className="fas fa-user-check mr-2"></i>
                  Confirmar Presença Manual
                </div>
              </div>
              <div className="br-modal-body">
                <p className="mb-3">
                  Busque o participante inscrito para confirmar presença manualmente:
                </p>
                <div className="br-input mb-3">
                  <label htmlFor="cpf-confirmar">CPF do Participante</label>
                  <input
                    id="cpf-confirmar"
                    type="text"
                    placeholder="Digite o CPF"
                    value={cpfBusca}
                    onChange={(e) => setCpfBusca(e.target.value)}
                    maxLength={14}
                  />
                </div>
                <button
                  className="br-button secondary mb-3"
                  onClick={buscarParticipante}
                  disabled={!cpfBusca || buscandoParticipante}
                >
                  <i className="fas fa-search mr-2"></i>
                  {buscandoParticipante ? 'Buscando...' : 'Buscar'}
                </button>

                {participanteSelecionado && (
                  <div className="br-card mt-3">
                    <div className="card-content">
                      <h6 className="text-weight-semi-bold mb-2">Participante Encontrado</h6>
                      <p className="mb-1"><strong>Nome:</strong> {participanteSelecionado.nome}</p>
                      <p className="mb-1"><strong>CPF:</strong> {participanteSelecionado.cpf}</p>
                      <p className="mb-1"><strong>Email:</strong> {participanteSelecionado.email}</p>
                    </div>
                  </div>
                )}

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
                  onClick={() => {
                    setShowConfirmarModal(false);
                    setCpfBusca('');
                    setParticipanteSelecionado(null);
                    setError('');
                  }}
                >
                  Cancelar
                </button>
                <button
                  className="br-button primary"
                  onClick={() => confirmarPresencaManual(participanteSelecionado._id)}
                  disabled={!participanteSelecionado}
                >
                  <i className="fas fa-check mr-2"></i>
                  Confirmar Presença
                </button>
              </div>
            </div>
          </div>
          <div className="br-scrim" onClick={() => {
            setShowConfirmarModal(false);
            setCpfBusca('');
            setParticipanteSelecionado(null);
            setError('');
          }}></div>
        </div>
      )}
    </MainLayout>
  );
};

export default PainelPresencas;
