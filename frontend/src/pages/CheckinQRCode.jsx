import React, { useEffect, useState } from 'react';
import { useNavigate, useSearchParams } from 'react-router-dom';
import { useAuth } from '../hooks/useAuth';
import api from '../services/api';
import MainLayout from '../layouts/MainLayout';

const CheckinQRCode = () => {
  const [searchParams] = useSearchParams();
  const navigate = useNavigate();
  const { user, loading: authLoading } = useAuth();
  const [status, setStatus] = useState('loading');
  const [message, setMessage] = useState('');
  const [subeventoInfo, setSubeventoInfo] = useState(null);
  const [processed, setProcessed] = useState(false); // Flag para evitar reprocessamento
  const token = searchParams.get('token');

  useEffect(() => {
    // Previne execução múltipla
    if (processed) return;
    
    // Aguarda carregar informações de autenticação
    if (authLoading) return;

    // Se não tiver token, erro
    if (!token) {
      setStatus('error');
      setMessage('Token não fornecido no QR Code');
      setProcessed(true);
      return;
    }

    // Se não estiver logado, redireciona para login com retorno
    if (!user) {
      const returnUrl = `/checkin?token=${token}`;
      sessionStorage.setItem('returnAfterLogin', returnUrl);
      navigate('/login');
      setProcessed(true);
      return;
    }

    // Se estiver logado, processa o checkin
    const doCheckin = async () => {
      try {
        setStatus('processing');
        setMessage('Processando check-in...');

        const { data } = await api.post(`/mesario/checkin?token=${token}`);

        if (data.success) {
          setStatus('success');
          setMessage('Check-in realizado com sucesso!');
          setSubeventoInfo(data.data.subevento);
        }
      } catch (err) {
        setStatus('error');
        
        if (err.response?.status === 409) {
          setMessage('Você já fez check-in neste evento anteriormente.');
        } else if (err.response?.status === 410) {
          setMessage('QR Code expirado. Solicite um novo QR Code ao responsável.');
        } else if (err.response?.status === 404) {
          setMessage('QR Code inválido ou evento não encontrado.');
        } else {
          setMessage(err.response?.data?.message || 'Erro ao processar check-in');
        }
      } finally {
        setProcessed(true);
      }
    };

    doCheckin();
  }, [user, authLoading, token, navigate, processed]);

  const handleGoToInscricoes = () => {
    navigate('/inscricoes');
  };

  if (authLoading || status === 'loading') {
    return (
      <MainLayout>
        <div className="text-center my-5">
          <div className="br-loading" aria-label="Carregando"></div>
          <p className="text-up-01 mt-3">Verificando autenticação...</p>
        </div>
      </MainLayout>
    );
  }

  return (
    <MainLayout>
      <div className="container-lg my-5">
        <div className="row justify-content-center">
          <div className="col-lg-6">
            <div className="br-card">
              <div className="card-content text-center py-5">
                {status === 'processing' && (
                  <>
                    <div className="br-loading mb-3" aria-label="Processando"></div>
                    <h3 className="text-up-02 text-weight-semi-bold mb-2">
                      Processando Check-in
                    </h3>
                    <p className="text-up-01">{message}</p>
                  </>
                )}

                {status === 'success' && (
                  <>
                    <i className="fas fa-check-circle fa-5x text-success mb-3"></i>
                    <h3 className="text-up-02 text-weight-semi-bold mb-3 text-success">
                      {message}
                    </h3>
                    
                    {subeventoInfo && (
                      <div className="br-card mb-3">
                        <div className="card-content">
                          <h4 className="text-weight-semi-bold mb-2">
                            {subeventoInfo.titulo}
                          </h4>
                          {subeventoInfo.evento && (
                            <p className="text-down-01 mb-1">
                              <strong>Evento:</strong> {subeventoInfo.evento}
                            </p>
                          )}
                        </div>
                      </div>
                    )}

                    <button
                      onClick={handleGoToInscricoes}
                      className="br-button primary large"
                    >
                      <i className="fas fa-list mr-2"></i>
                      Ver Minhas Inscrições
                    </button>
                  </>
                )}

                {status === 'error' && (
                  <>
                    <i className="fas fa-exclamation-circle fa-5x text-danger mb-3"></i>
                    <h3 className="text-up-02 text-weight-semi-bold mb-3 text-danger">
                      Erro no Check-in
                    </h3>
                    <p className="text-up-01 mb-4">{message}</p>
                    
                    <div className="d-flex justify-content-center gap-3">
                      <button
                        onClick={handleGoToInscricoes}
                        className="br-button secondary"
                      >
                        <i className="fas fa-list mr-2"></i>
                        Minhas Inscrições
                      </button>
                      <button
                        onClick={() => navigate('/')}
                        className="br-button secondary"
                      >
                        <i className="fas fa-home mr-2"></i>
                        Início
                      </button>
                    </div>
                  </>
                )}
              </div>
            </div>

            <div className="text-center mt-4">
              <div className="br-message info" role="alert">
                <div className="icon">
                  <i className="fas fa-info-circle fa-lg" aria-hidden="true"></i>
                </div>
                <div className="content text-left">
                  <p className="text-weight-semi-bold mb-2">ℹ️ Informações:</p>
                  <ul className="mb-0" style={{ paddingLeft: '20px' }}>
                    <li>O QR Code possui validade de 30 minutos</li>
                    <li>Você pode fazer check-in apenas uma vez por evento</li>
                    <li>Certifique-se de estar conectado à mesma rede Wi-Fi</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </MainLayout>
  );
};

export default CheckinQRCode;
