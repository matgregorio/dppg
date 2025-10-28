import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const MeusCertificados = () => {
  const [certificados, setCertificados] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const currentYear = new Date().getFullYear();
  
  useEffect(() => {
    const fetchCertificados = async () => {
      try {
        setLoading(true);
        const { data } = await api.get(`/user/certificados?ano=${currentYear}`);
        if (data.success) {
          setCertificados(data.data);
        }
      } catch (err) {
        setError(err.response?.data?.message || 'Erro ao carregar certificados');
      } finally {
        setLoading(false);
      }
    };
    
    fetchCertificados();
  }, [currentYear]);
  
  const getTipoCertificado = (tipo) => {
    const tipos = {
      PARTICIPACAO: 'Participação',
      APRESENTACAO_TRABALHO: 'Apresentação de Trabalho',
      AVALIADOR: 'Avaliador',
      PALESTRANTE: 'Palestrante',
      ORGANIZACAO: 'Organização',
    };
    return tipos[tipo] || tipo;
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
            <span>Meus Certificados</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">Meus Certificados</h1>
        
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
        ) : certificados.length === 0 ? (
          <div className="br-card">
            <div className="card-content text-center py-5">
              <i className="fas fa-certificate fa-3x text-gray-40 mb-3"></i>
              <p className="text-up-01 text-weight-medium">Nenhum certificado disponível</p>
              <p className="text-down-01">
                Os certificados serão gerados após o término do simpósio
              </p>
            </div>
          </div>
        ) : (
          <div className="row">
            {certificados.map((cert) => (
              <div key={cert._id} className="col-12 col-md-6 col-lg-4 mb-3">
                <div className="br-card">
                  <div className="card-header">
                    <div className="d-flex align-items-center">
                      <i className="fas fa-certificate fa-2x text-primary-default mr-3"></i>
                      <div>
                        <h5 className="text-weight-semi-bold mb-1">
                          {getTipoCertificado(cert.tipo)}
                        </h5>
                        <small className="text-down-01">
                          Simpósio {cert.simposio?.ano}
                        </small>
                      </div>
                    </div>
                  </div>
                  <div className="card-content">
                    <div className="mb-2">
                      <i className="fas fa-calendar mr-2 text-gray-60"></i>
                      <small>
                        Emitido em {new Date(cert.gerado_em).toLocaleDateString('pt-BR')}
                      </small>
                    </div>
                    <div className="mb-3">
                      <i className="fas fa-check-circle mr-2 text-success"></i>
                      <small className="text-success text-weight-medium">
                        Certificado Ativo
                      </small>
                    </div>
                    
                    <div className="d-flex gap-2">
                      {cert.pdfPath && (
                        <a
                          href={`${import.meta.env.VITE_API_BASE_URL.replace('/api/v1', '')}/uploads/${cert.pdfPath}`}
                          target="_blank"
                          rel="noopener noreferrer"
                          className="br-button primary small flex-fill"
                        >
                          <i className="fas fa-download mr-1"></i>
                          Baixar PDF
                        </a>
                      )}
                      <Link
                        to={`/validar-certificado?hash=${cert.hashValidacao}`}
                        className="br-button secondary small"
                      >
                        <i className="fas fa-qrcode mr-1"></i>
                        Validar
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

export default MeusCertificados;
