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
      SUBMETIDO: { class: 'info', text: 'Submetido', icon: 'fa-paper-plane' },
      EM_AVALIACAO: { class: 'warning', text: 'Em Avaliação', icon: 'fa-clock' },
      ACEITO: { class: 'success', text: 'Aceito', icon: 'fa-check-circle' },
      REJEITADO: { class: 'danger', text: 'Rejeitado', icon: 'fa-times-circle' },
      PUBLICADO: { class: 'success', text: 'Publicado', icon: 'fa-check-double' },
    };
    const { class: className, text, icon } = statusMap[status] || { class: 'secondary', text: status, icon: 'fa-question' };
    return (
      <span className={`br-tag ${className}`}>
        <i className={`fas ${icon} mr-1`}></i>
        {text}
      </span>
    );
  };
  
  const getTipoApresentacaoBadge = (tipo) => {
    if (!tipo || tipo === 'NAO_DEFINIDO') return null;
    
    const tipoMap = {
      POSTER: { class: 'info', text: 'Poster', icon: 'fa-image' },
      ORAL: { class: 'warning', text: 'Oral', icon: 'fa-microphone' },
    };
    const { class: className, text, icon } = tipoMap[tipo] || { class: 'secondary', text: tipo, icon: 'fa-question' };
    return (
      <span className={`br-tag ${className} ml-2`}>
        <i className={`fas ${icon} mr-1`}></i>
        {text}
      </span>
    );
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
                          {getTipoApresentacaoBadge(trabalho.tipoApresentacao)}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="card-content">
                    <div className="row mb-3">
                      <div className="col-md-6">
                        <div className="mb-2">
                          <strong><i className="fas fa-users mr-2 text-primary-default"></i>Autores:</strong>
                          <div className="ml-4">
                            {trabalho.autores?.map((a, idx) => (
                              <div key={idx} className="text-down-01">
                                {a.nome} {a.email && `(${a.email})`}
                              </div>
                            )) || 'N/A'}
                          </div>
                        </div>
                      </div>
                      <div className="col-md-6">
                        <div className="mb-2">
                          <strong><i className="fas fa-tags mr-2 text-primary-default"></i>Palavras-chave:</strong>
                          <div className="ml-4">
                            {trabalho.palavras_chave?.map((palavra, idx) => (
                              <span key={idx} className="br-tag secondary small mr-1 mb-1">
                                {palavra}
                              </span>
                            )) || 'N/A'}
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div className="row mb-3">
                      <div className="col-md-4">
                        {trabalho.areaAtuacao && (
                          <div className="mb-2">
                            <strong><i className="fas fa-book mr-2 text-primary-default"></i>Grande Área:</strong>
                            <div className="ml-4 text-down-01">{trabalho.areaAtuacao.nome}</div>
                          </div>
                        )}
                      </div>
                      <div className="col-md-4">
                        {trabalho.areaAtuacao && (
                          <div className="mb-2">
                            <strong><i className="fas fa-bookmark mr-2 text-primary-default"></i>Área:</strong>
                            <div className="ml-4 text-down-01">{trabalho.areaAtuacao.nome}</div>
                          </div>
                        )}
                      </div>
                      <div className="col-md-4">
                        {trabalho.subarea && (
                          <div className="mb-2">
                            <strong><i className="fas fa-tag mr-2 text-primary-default"></i>Subárea:</strong>
                            <div className="ml-4 text-down-01">{trabalho.subarea.nome}</div>
                          </div>
                        )}
                      </div>
                    </div>
                    
                    {(trabalho.media || trabalho.qtd_avaliados > 0) && (
                      <div className="br-divider mb-3"></div>
                    )}
                    
                    <div className="row">
                      {trabalho.media && (
                        <div className="col-md-4">
                          <div className="text-center p-3 bg-primary-lighten-01 rounded">
                            <div className="text-up-02 text-weight-bold text-primary-default">
                              {trabalho.media.toFixed(1)}
                            </div>
                            <div className="text-down-01">Média das Avaliações</div>
                          </div>
                        </div>
                      )}
                      {trabalho.qtd_avaliados > 0 && (
                        <div className="col-md-4">
                          <div className="text-center p-3 bg-info-lighten-01 rounded">
                            <div className="text-up-02 text-weight-bold text-info-default">
                              {trabalho.qtd_avaliados} / {trabalho.qtd_enviados}
                            </div>
                            <div className="text-down-01">Avaliações Concluídas</div>
                          </div>
                        </div>
                      )}
                    </div>
                    
                    <div className="br-divider mt-3 mb-3"></div>
                    
                    <div className="d-flex gap-2 flex-wrap">
                      {trabalho.arquivo && (
                        <a
                          href={`${import.meta.env.VITE_API_BASE_URL.replace('/api/v1', '')}/uploads/${trabalho.arquivo}`}
                          target="_blank"
                          rel="noopener noreferrer"
                          className="br-button secondary small"
                        >
                          <i className="fas fa-download mr-2"></i>
                          Baixar Arquivo
                        </a>
                      )}
                      {trabalho.qtd_avaliados > 0 && (
                        <button
                          onClick={() => handleVerDetalhes(trabalho._id)}
                          className="br-button primary small"
                        >
                          <i className="fas fa-eye mr-2"></i>
                          Ver Avaliações
                        </button>
                      )}
                    </div>
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
