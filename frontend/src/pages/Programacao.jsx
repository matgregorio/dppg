import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const Programacao = () => {
  const [simposio, setSimposio] = useState(null);
  const [subeventos, setSubeventos] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const currentYear = new Date().getFullYear();

  useEffect(() => {
    fetchProgramacao();
  }, []);

  const fetchProgramacao = async () => {
    try {
      const { data } = await api.get(`/public/programacao?ano=${currentYear}`);
      if (data.success) {
        setSimposio(data.data.simposio);
        setSubeventos(data.data.subeventos);
      }
    } catch (err) {
      setError('Erro ao carregar programação');
    } finally {
      setLoading(false);
    }
  };

  const formatDateTime = (dateString, timeString) => {
    if (!dateString) return 'A definir';
    const date = new Date(dateString);
    const formattedDate = date.toLocaleDateString('pt-BR', {
      day: '2-digit',
      month: 'long',
      year: 'numeric',
    });
    return timeString ? `${formattedDate} às ${timeString}` : formattedDate;
  };

  const groupByDate = (eventos) => {
    const groups = {};
    eventos.forEach(evento => {
      if (!evento.data) return; // Pula eventos sem data
      const date = new Date(evento.data).toLocaleDateString('pt-BR', {
        day: '2-digit',
        month: 'long',
        year: 'numeric',
      });
      if (!groups[date]) groups[date] = [];
      groups[date].push(evento);
    });
    return groups;
  };

  const grouped = groupByDate(subeventos);

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
            <span>Programação</span>
          </li>
        </ul>
      </div>

      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">
          <i className="fas fa-calendar-alt mr-2"></i>
          Programação {currentYear}
        </h1>

        {loading ? (
          <div className="text-center my-5">
            <div className="br-loading" aria-label="Carregando"></div>
          </div>
        ) : error ? (
          <div className="br-message danger" role="alert">
            <div className="icon">
              <i className="fas fa-times-circle fa-lg"></i>
            </div>
            <div className="content">{error}</div>
          </div>
        ) : !simposio ? (
          <div className="br-card">
            <div className="card-content text-center py-5">
              <i className="fas fa-calendar-times fa-3x text-gray-40 mb-3"></i>
              <p className="text-up-01 text-weight-medium">
                Programação ainda não disponível para {currentYear}
              </p>
            </div>
          </div>
        ) : (
          <>
            {subeventos.length === 0 ? (
              <div className="br-message info" role="alert">
                <div className="icon">
                  <i className="fas fa-info-circle"></i>
                </div>
                <div className="content">
                  A programação detalhada será divulgada em breve.
                </div>
              </div>
            ) : (
              <>
                {Object.entries(grouped).map(([date, eventos]) => (
                  <div key={date} className="mb-4">
                    <h2 className="text-up-02 text-weight-semi-bold mb-3 pb-2 border-bottom">
                      <i className="fas fa-calendar-day mr-2"></i>
                      {date}
                    </h2>
                    
                    <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fill, minmax(300px, 1fr))', gap: '1rem' }}>
                      {eventos.map((evento) => (
                        <div key={evento._id}>
                          <div className="br-card" style={{ height: '100%' }}>
                            <div className="card-header">
                              <div className="d-flex align-items-start justify-content-between">
                                <h5 className="text-weight-semi-bold mb-0">
                                  {evento.nome || evento.titulo}
                                </h5>
                                {evento.tipo && (
                                  <span className={`br-tag small ${
                                    evento.tipo === 'ABERTURA' ? 'warning' :
                                    evento.tipo === 'PALESTRA' ? 'primary' :
                                    evento.tipo === 'WORKSHOP' ? 'info' :
                                    'secondary'
                                  }`}>
                                    {evento.tipo}
                                  </span>
                                )}
                              </div>
                            </div>
                            <div className="card-content">
                              <div className="mb-2">
                                <i className="fas fa-clock mr-2 text-primary"></i>
                                <strong>Horário:</strong>{' '}
                                {evento.horarioInicio || 'A definir'}
                                {evento.duracao && ` - Duração: ${evento.duracao}`}
                              </div>
                              
                              {evento.local && (
                                <div className="mb-2">
                                  <i className="fas fa-map-marker-alt mr-2 text-danger"></i>
                                  <strong>Local:</strong> {evento.local}
                                </div>
                              )}
                              
                              {evento.palestrante && (
                                <div className="mb-2">
                                  <i className="fas fa-user mr-2 text-success"></i>
                                  <strong>Palestrante:</strong> {evento.palestrante}
                                </div>
                              )}
                              
                              {evento.vagas && (
                                <div className="mb-2">
                                  <i className="fas fa-users mr-2 text-info"></i>
                                  <strong>Vagas:</strong> {evento.vagas}
                                </div>
                              )}
                              
                              {evento.descricao && (
                                <div className="mt-3">
                                  <p className="text-down-01">{evento.descricao}</p>
                                </div>
                              )}
                            </div>
                          </div>
                        </div>
                      ))}
                    </div>
                  </div>
                ))}
              </>
            )}
          </>
        )}
      </div>
    </MainLayout>
  );
};

export default Programacao;
