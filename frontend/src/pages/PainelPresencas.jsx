import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const PainelPresencas = () => {
  const { subeventoId } = useParams();
  const [subevento, setSubevento] = useState(null);
  const [inscritos, setInscritos] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [autoRefresh, setAutoRefresh] = useState(true);
  
  useEffect(() => {
    fetchData();
  }, [subeventoId]);
  
  useEffect(() => {
    if (!autoRefresh) return;
    
    const interval = setInterval(() => {
      fetchInscritos();
    }, 5000); // Atualiza a cada 5 segundos
    
    return () => clearInterval(interval);
  }, [autoRefresh, subeventoId]);
  
  const fetchData = async () => {
    try {
      setLoading(true);
      await Promise.all([fetchSubevento(), fetchInscritos()]);
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
  
  const fetchInscritos = async () => {
    const { data } = await api.get(`/mesario/subeventos/${subeventoId}/inscritos-presencas`);
    if (data.success) {
      setInscritos(data.data);
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
                      <span className="br-tag info large mr-2">
                        <i className="fas fa-users mr-2"></i>
                        {inscritos.length} Inscritos
                      </span>
                      <span className="br-tag success large">
                        <i className="fas fa-check-circle mr-2"></i>
                        {inscritos.filter(i => i.presenca).length} Presenças
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            {inscritos.length === 0 ? (
              <div className="br-card">
                <div className="card-content text-center py-5">
                  <i className="fas fa-user-times fa-3x text-gray-40 mb-3"></i>
                  <p className="text-up-01 text-weight-medium">Nenhum participante inscrito</p>
                  <p className="text-down-01">
                    Não há participantes inscritos neste subevento
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
                      <th scope="col">Status</th>
                      <th scope="col">Horário Check-in</th>
                      <th scope="col">Origem</th>
                    </tr>
                  </thead>
                  <tbody>
                    {inscritos.map((inscrito) => {
                      const ultimoCheckin = inscrito.presenca?.ultimoCheckin;
                      const origem = ultimoCheckin ? getOrigemBadge(ultimoCheckin.origem) : null;
                      
                      return (
                        <tr key={inscrito.participant._id}>
                          <td>{inscrito.participant?.nome || 'N/A'}</td>
                          <td>{inscrito.participant?.cpf || 'N/A'}</td>
                          <td>
                            {inscrito.presenca ? (
                              <span className="br-tag success">
                                <i className="fas fa-check mr-1"></i>
                                Presente
                              </span>
                            ) : (
                              <span className="br-tag warning">
                                <i className="fas fa-clock mr-1"></i>
                                Aguardando
                              </span>
                            )}
                          </td>
                          <td>
                            {inscrito.presenca ? formatDateTime(ultimoCheckin?.data) : '-'}
                          </td>
                          <td>
                            {origem ? (
                              <span className={`br-tag ${origem.class}`}>
                                <i className={`fas ${origem.icon} mr-1`}></i>
                                {origem.text}
                              </span>
                            ) : (
                              '-'
                            )}
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
    </MainLayout>
  );
};

export default PainelPresencas;
