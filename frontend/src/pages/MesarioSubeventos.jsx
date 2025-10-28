import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const MesarioSubeventos = () => {
  const [subeventos, setSubeventos] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const currentYear = new Date().getFullYear();
  
  useEffect(() => {
    const fetchSubeventos = async () => {
      try {
        setLoading(true);
        const { data } = await api.get(`/mesario/subeventos?ano=${currentYear}`);
        if (data.success) {
          setSubeventos(data.data);
        }
      } catch (err) {
        setError(err.response?.data?.message || 'Erro ao carregar subeventos');
      } finally {
        setLoading(false);
      }
    };
    
    fetchSubeventos();
  }, [currentYear]);
  
  const formatDate = (dateString) => {
    if (!dateString) return 'N/A';
    const date = new Date(dateString);
    return date.toLocaleString('pt-BR', {
      day: '2-digit',
      month: '2-digit',
      year: 'numeric',
      hour: '2-digit',
      minute: '2-digit',
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
            <span>Meus Subeventos</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">Meus Subeventos</h1>
        
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
        ) : subeventos.length === 0 ? (
          <div className="br-card">
            <div className="card-content text-center py-5">
              <i className="fas fa-calendar-day fa-3x text-gray-40 mb-3"></i>
              <p className="text-up-01 text-weight-medium">Nenhum subevento atribuído</p>
              <p className="text-down-01">
                Você ainda não foi designado como mesário para nenhum subevento
              </p>
            </div>
          </div>
        ) : (
          <div className="row">
            {subeventos.map((subevento) => (
              <div key={subevento._id} className="col-md-6 col-lg-4 mb-3">
                <div className="br-card">
                  <div className="card-header">
                    <h5 className="text-weight-semi-bold">{subevento.nome}</h5>
                  </div>
                  <div className="card-content">
                    <div className="mb-2">
                      <strong>Data/Hora:</strong>
                      <br />
                      {formatDate(subevento.dataHora)}
                    </div>
                    
                    {subevento.local && (
                      <div className="mb-3">
                        <strong>Local:</strong>
                        <br />
                        {subevento.local}
                      </div>
                    )}
                    
                    <div className="d-flex flex-column gap-2">
                      <Link
                        to={`/mesario/subeventos/${subevento._id}/qrcode`}
                        className="br-button primary small"
                      >
                        <i className="fas fa-qrcode mr-2"></i>
                        Gerar QR Code
                      </Link>
                      
                      <Link
                        to={`/mesario/subeventos/${subevento._id}/presencas`}
                        className="br-button secondary small"
                      >
                        <i className="fas fa-list-check mr-2"></i>
                        Painel de Presenças
                      </Link>
                    </div>
                  </div>
                </div>
              </div>
            ))}
          </div>
        )}
      </div>
    </MainLayout>
  );
};

export default MesarioSubeventos;
