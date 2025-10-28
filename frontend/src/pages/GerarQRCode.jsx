import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const GerarQRCode = () => {
  const { subeventoId } = useParams();
  const [subevento, setSubevento] = useState(null);
  const [qrCode, setQrCode] = useState('');
  const [token, setToken] = useState('');
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [countdown, setCountdown] = useState(300); // 5 minutos em segundos
  
  useEffect(() => {
    fetchSubevento();
  }, [subeventoId]);
  
  useEffect(() => {
    if (countdown > 0) {
      const timer = setTimeout(() => setCountdown(countdown - 1), 1000);
      return () => clearTimeout(timer);
    }
  }, [countdown]);
  
  const fetchSubevento = async () => {
    try {
      setLoading(true);
      const { data } = await api.get(`/mesario/subeventos/${subeventoId}`);
      if (data.success) {
        setSubevento(data.data);
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao carregar subevento');
    } finally {
      setLoading(false);
    }
  };
  
  const handleGerarQRCode = async () => {
    try {
      setError('');
      const { data } = await api.post(`/mesario/subeventos/${subeventoId}/qrcode`);
      
      if (data.success) {
        setQrCode(data.data.qrCode);
        setToken(data.data.token);
        setCountdown(300); // Reset para 5 minutos
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao gerar QR Code');
    }
  };
  
  const formatCountdown = (seconds) => {
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${mins}:${secs.toString().padStart(2, '0')}`;
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
            <span>Gerar QR Code</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">Gerar QR Code</h1>
        
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
                <h3 className="text-weight-semi-bold">{subevento.nome}</h3>
              </div>
              <div className="card-content">
                <p>
                  <strong>Local:</strong> {subevento.local || 'N/A'}
                </p>
                <p>
                  <strong>Data/Hora:</strong>{' '}
                  {new Date(subevento.dataHora).toLocaleString('pt-BR')}
                </p>
              </div>
            </div>
            
            {!qrCode ? (
              <div className="text-center">
                <button
                  onClick={handleGerarQRCode}
                  className="br-button primary large"
                >
                  <i className="fas fa-qrcode mr-2"></i>
                  Gerar Novo QR Code
                </button>
                <p className="text-down-01 mt-3">
                  O QR Code gerado terá validade de 5 minutos
                </p>
              </div>
            ) : (
              <div className="br-card">
                <div className="card-content text-center">
                  <h4 className="mb-3">QR Code para Check-in</h4>
                  
                  <div className="mb-3">
                    <img
                      src={qrCode}
                      alt="QR Code para check-in"
                      style={{ maxWidth: '100%', height: 'auto' }}
                    />
                  </div>
                  
                  <div className="mb-3">
                    <span className="br-tag warning large">
                      <i className="fas fa-clock mr-2"></i>
                      Expira em: {formatCountdown(countdown)}
                    </span>
                  </div>
                  
                  {countdown === 0 && (
                    <div className="br-message warning mb-3" role="alert">
                      <div className="icon">
                        <i className="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i>
                      </div>
                      <div className="content">
                        O QR Code expirou. Gere um novo para continuar o check-in.
                      </div>
                    </div>
                  )}
                  
                  <button
                    onClick={handleGerarQRCode}
                    className="br-button primary"
                  >
                    <i className="fas fa-sync-alt mr-2"></i>
                    Gerar Novo QR Code
                  </button>
                  
                  <div className="mt-4 text-left">
                    <p className="text-down-01">
                      <strong>Instruções:</strong>
                    </p>
                    <ul className="text-down-01">
                      <li>Participantes devem escanear este QR Code com seus dispositivos</li>
                      <li>O token é válido por 5 minutos por questões de segurança</li>
                      <li>Gere um novo QR Code quando o atual expirar</li>
                      <li>Acompanhe as presenças no Painel de Presenças</li>
                    </ul>
                  </div>
                </div>
              </div>
            )}
          </>
        )}
      </div>
    </MainLayout>
  );
};

export default GerarQRCode;
