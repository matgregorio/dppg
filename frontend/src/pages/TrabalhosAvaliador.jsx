import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const TrabalhosAvaliador = () => {
  const [trabalhos, setTrabalhos] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const currentYear = new Date().getFullYear();
  
  useEffect(() => {
    const fetchTrabalhos = async () => {
      try {
        setLoading(true);
        const { data } = await api.get(`/avaliador/trabalhos?ano=${currentYear}`);
        if (data.success) {
          setTrabalhos(data.data);
        }
      } catch (err) {
        setError(err.response?.data?.message || 'Erro ao carregar trabalhos');
      } finally {
        setLoading(false);
      }
    };
    
    fetchTrabalhos();
  }, [currentYear]);
  
  const jaAvaliado = (trabalho, userId) => {
    return trabalho.avaliacoes?.some(av => av.avaliador === userId);
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
            <span>Trabalhos para Avaliar</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">Trabalhos Atribuídos</h1>
        
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
        ) : trabalhos.length === 0 ? (
          <div className="br-card">
            <div className="card-content text-center py-5">
              <i className="fas fa-clipboard-check fa-3x text-gray-40 mb-3"></i>
              <p className="text-up-01 text-weight-medium">Nenhum trabalho atribuído</p>
              <p className="text-down-01">
                Você ainda não tem trabalhos para avaliar no simpósio {currentYear}
              </p>
            </div>
          </div>
        ) : (
          <div className="row">
            {trabalhos.map((trabalho) => {
              const avaliado = jaAvaliado(trabalho, 'userId'); // TODO: pegar userId do Redux
              
              return (
                <div key={trabalho._id} className="col-12 mb-3">
                  <div className="br-card">
                    <div className="card-header">
                      <div className="d-flex justify-content-between align-items-start">
                        <h5 className="text-weight-semi-bold mb-2">{trabalho.titulo}</h5>
                        {avaliado ? (
                          <span className="br-tag success">
                            <i className="fas fa-check-circle mr-1"></i>
                            Avaliado
                          </span>
                        ) : (
                          <span className="br-tag warning">
                            <i className="fas fa-clock mr-1"></i>
                            Pendente
                          </span>
                        )}
                      </div>
                    </div>
                    <div className="card-content">
                      <div className="mb-2">
                        <strong>Autores:</strong>{' '}
                        {trabalho.autores?.map(a => a.nome).join(', ') || 'N/A'}
                      </div>
                      <div className="mb-2">
                        <strong>Palavras-chave:</strong>{' '}
                        {trabalho.palavras_chave?.join(', ') || 'N/A'}
                      </div>
                      <div className="mb-3">
                        <strong>Status:</strong>{' '}
                        <span className="br-tag info">{trabalho.status}</span>
                      </div>
                      
                      <div className="d-flex gap-2">
                        {trabalho.arquivo && (
                          <a
                            href={`${import.meta.env.VITE_API_BASE_URL.replace('/api/v1', '')}/uploads/${trabalho.arquivo}`}
                            target="_blank"
                            rel="noopener noreferrer"
                            className="br-button secondary small"
                          >
                            <i className="fas fa-download mr-2"></i>
                            Baixar Trabalho
                          </a>
                        )}
                        
                        {!avaliado && (
                          <Link
                            to={`/avaliador/trabalhos/${trabalho._id}/avaliar`}
                            className="br-button primary small"
                          >
                            <i className="fas fa-edit mr-2"></i>
                            Avaliar
                          </Link>
                        )}
                      </div>
                    </div>
                  </div>
                </div>
              );
            })}
          </div>
        )}
      </div>
    </MainLayout>
  );
};

export default TrabalhosAvaliador;
