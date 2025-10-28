import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';
import TrabalhoDetalhesModal from '../components/modals/TrabalhoDetalhesModal';

const MeusTrabalhos = () => {
  const [trabalhos, setTrabalhos] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [showDetalhesModal, setShowDetalhesModal] = useState(false);
  const [trabalhoDetalhes, setTrabalhoDetalhes] = useState(null);
  const currentYear = new Date().getFullYear();
  
  useEffect(() => {
    const fetchTrabalhos = async () => {
      try {
        setLoading(true);
        const { data } = await api.get(`/user/trabalhos?ano=${currentYear}`);
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
  
  const getStatusBadge = (status) => {
    const statusMap = {
      SUBMETIDO: { class: 'info', text: 'Submetido' },
      EM_AVALIACAO: { class: 'warning', text: 'Em Avaliação' },
      ACEITO: { class: 'success', text: 'Aceito' },
      REJEITADO: { class: 'danger', text: 'Rejeitado' },
      PUBLICADO: { class: 'success', text: 'Publicado' },
    };
    const { class: className, text } = statusMap[status] || { class: 'secondary', text: status };
    return <span className={`br-tag ${className}`}>{text}</span>;
  };
  
  const handleVerDetalhes = async (trabalhoId) => {
    try {
      const { data } = await api.get(`/user/trabalhos/${trabalhoId}`);
      if (data.success) {
        setTrabalhoDetalhes(data.data);
        setShowDetalhesModal(true);
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao carregar detalhes do trabalho');
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
          <li className="crumb">
            <i className="icon fas fa-chevron-right"></i>
            <span>Meus Trabalhos</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <div className="d-flex justify-content-between align-items-center mb-4">
          <h1 className="text-up-03 text-weight-bold">Meus Trabalhos</h1>
          <Link to="/submeter-trabalho" className="br-button primary">
            <i className="fas fa-plus mr-2"></i>
            Submeter Trabalho
          </Link>
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
        ) : trabalhos.length === 0 ? (
          <div className="br-card">
            <div className="card-content text-center py-5">
              <i className="fas fa-file-alt fa-3x text-gray-40 mb-3"></i>
              <p className="text-up-01 text-weight-medium">Nenhum trabalho submetido ainda</p>
              <p className="text-down-01 mb-3">Comece submetendo seu primeiro trabalho</p>
              <Link to="/submeter-trabalho" className="br-button primary">
                Submeter Trabalho
              </Link>
            </div>
          </div>
        ) : (
          <div className="row">
            {trabalhos.map((trabalho) => (
              <div key={trabalho._id} className="col-12 mb-3">
                <div className="br-card">
                  <div className="card-header">
                    <div className="d-flex justify-content-between align-items-start">
                      <div className="flex-fill">
                        <h5 className="text-weight-semi-bold mb-2">{trabalho.titulo}</h5>
                        <div className="mb-2">
                          {getStatusBadge(trabalho.status)}
                        </div>
                      </div>
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
                    {trabalho.media && (
                      <div className="mb-2">
                        <strong>Média das avaliações:</strong>{' '}
                        <span className="text-primary-default text-weight-semi-bold">
                          {trabalho.media.toFixed(1)}
                        </span>
                      </div>
                    )}
                    {trabalho.qtd_avaliados > 0 && (
                      <div className="mb-2">
                        <strong>Avaliações:</strong> {trabalho.qtd_avaliados} de {trabalho.qtd_enviados}
                      </div>
                    )}
                    {trabalho.arquivo && (
                      <a
                        href={`${import.meta.env.VITE_API_BASE_URL.replace('/api/v1', '')}/uploads/${trabalho.arquivo}`}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="br-button secondary small mt-2 mr-2"
                      >
                        <i className="fas fa-download mr-2"></i>
                        Baixar Arquivo
                      </a>
                    )}
                    {trabalho.qtd_avaliados > 0 && (
                      <button
                        onClick={() => handleVerDetalhes(trabalho._id)}
                        className="br-button primary small mt-2"
                      >
                        <i className="fas fa-eye mr-2"></i>
                        Ver Avaliações
                      </button>
                    )}
                  </div>
                </div>
              </div>
            ))}
          </div>
        )}
      </div>
      
      {/* Modal de Detalhes do Trabalho */}
      <TrabalhoDetalhesModal
        trabalho={trabalhoDetalhes}
        isOpen={showDetalhesModal}
        onClose={() => {
          setShowDetalhesModal(false);
          setTrabalhoDetalhes(null);
        }}
        isAdmin={false}
      />
    </MainLayout>
  );
};

export default MeusTrabalhos;
