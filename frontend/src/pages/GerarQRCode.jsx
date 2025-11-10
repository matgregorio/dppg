import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const GerarQRCode = () => {
  const { subeventoId } = useParams();
  const [subevento, setSubevento] = useState(null);
  const [qrCode, setQrCode] = useState('');
  const [expiresAt, setExpiresAt] = useState(null);
  const [loading, setLoading] = useState(true);
  const [generatingQR, setGeneratingQR] = useState(false);
  const [error, setError] = useState('');
  const [timeRemaining, setTimeRemaining] = useState(0);
  const [presencas, setPresencas] = useState([]);
  const [loadingPresencas, setLoadingPresencas] = useState(false);
  
  useEffect(() => {
    fetchSubevento();
    fetchPresencas();
  }, [subeventoId]);
  
  useEffect(() => {
    if (expiresAt) {
      const interval = setInterval(() => {
        const now = new Date();
        const expires = new Date(expiresAt);
        const diff = Math.max(0, Math.floor((expires - now) / 1000));
        setTimeRemaining(diff);
        
        console.log('Time check:', {
          now: now.toISOString(),
          expires: expires.toISOString(),
          diff,
          isExpired: diff === 0
        });
        
        if (diff === 0) {
          clearInterval(interval);
        }
      }, 1000);
      
      return () => clearInterval(interval);
    }
  }, [expiresAt]);
  
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
  
  const fetchPresencas = async () => {
    try {
      setLoadingPresencas(true);
      const { data } = await api.get(`/mesario/subeventos/${subeventoId}/presencas`);
      if (data.success) {
        setPresencas(data.data);
      }
    } catch (err) {
      console.error('Erro ao carregar presenças:', err);
    } finally {
      setLoadingPresencas(false);
    }
  };
  
  const handleGerarQRCode = async () => {
    if (generatingQR) return; // Previne cliques duplos
    
    try {
      setGeneratingQR(true);
      setError('');
      console.log('Gerando novo QR Code...');
      
      const { data } = await api.post(`/mesario/subeventos/${subeventoId}/qrcode`);
      
      if (data.success) {
        console.log('QR Code gerado com sucesso:', data.data);
        setQrCode(data.data.qrcode);
        setExpiresAt(data.data.expiresAt);
        // Recarregar presenças após gerar novo QR Code
        fetchPresencas();
      }
    } catch (err) {
      console.error('Erro ao gerar QR Code:', err);
      setError(err.response?.data?.message || 'Erro ao gerar QR Code');
    } finally {
      setGeneratingQR(false);
    }
  };
  
  const formatTimeRemaining = (seconds) => {
    if (seconds === 0) return 'Expirado';
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${mins}:${secs.toString().padStart(2, '0')}`;
  };
  
  const isExpired = expiresAt && timeRemaining === 0;
  const hasQRCode = qrCode && expiresAt;
  
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
                <h3 className="text-weight-semi-bold">{subevento.titulo}</h3>
              </div>
              <div className="card-content">
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
                  <strong>Data:</strong>{' '}
                  {new Date(subevento.data).toLocaleDateString('pt-BR')}
                </p>
                <p>
                  <strong>Horário:</strong> {subevento.horarioInicio}
                  {subevento.duracao && ` (Duração: ${subevento.duracao})`}
                </p>
                {subevento.local && (
                  <p>
                    <strong>Local:</strong> {subevento.local}
                  </p>
                )}
                {subevento.tipo && (
                  <p>
                    <strong>Tipo:</strong> {subevento.tipo}
                  </p>
                )}
              </div>
            </div>
            
            {!hasQRCode ? (
              <div className="text-center">
                <button
                  onClick={handleGerarQRCode}
                  className="br-button primary large"
                  disabled={generatingQR}
                >
                  {generatingQR ? (
                    <>
                      <span className="br-loading small mr-2" style={{ display: 'inline-block', verticalAlign: 'middle' }}></span>
                      Gerando QR Code...
                    </>
                  ) : (
                    <>
                      <i className="fas fa-qrcode mr-2"></i>
                      Gerar Novo QR Code
                    </>
                  )}
                </button>
                <p className="text-down-01 mt-3">
                  O QR Code gerado terá validade de 30 minutos
                </p>
              </div>
            ) : (
              <div className="br-card">
                <div className="card-content text-center">
                  <h4 className="mb-3">QR Code para Check-in</h4>
                  
                  <div className="mb-3" style={{ opacity: isExpired ? 0.3 : 1, position: 'relative' }}>
                    <img
                      src={qrCode}
                      alt="QR Code para check-in"
                      style={{ maxWidth: '100%', height: 'auto' }}
                    />
                    {isExpired && (
                      <div style={{
                        position: 'absolute',
                        top: '50%',
                        left: '50%',
                        transform: 'translate(-50%, -50%)',
                        fontSize: '2rem',
                        fontWeight: 'bold',
                        color: '#d32f2f',
                        textShadow: '2px 2px 4px rgba(0,0,0,0.5)'
                      }}>
                        EXPIRADO
                      </div>
                    )}
                  </div>
                  
                  <div className="mb-3">
                    <span className={`br-tag large ${isExpired ? 'danger' : timeRemaining < 300 ? 'warning' : 'success'}`}>
                      <i className={`fas ${isExpired ? 'fa-times-circle' : 'fa-clock'} mr-2`}></i>
                      {isExpired ? 'QR Code Expirado' : `Expira em: ${formatTimeRemaining(timeRemaining)}`}
                    </span>
                  </div>
                  
                  {isExpired && (
                    <div className="br-message danger mb-3" role="alert">
                      <div className="icon">
                        <i className="fas fa-exclamation-circle fa-lg" aria-hidden="true"></i>
                      </div>
                      <div className="content">
                        <strong>QR Code Expirado!</strong><br/>
                        Por segurança, gere um novo QR Code para continuar o check-in.
                      </div>
                    </div>
                  )}
                  
                  {!isExpired && timeRemaining < 300 && (
                    <div className="br-message warning mb-3" role="alert">
                      <div className="icon">
                        <i className="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i>
                      </div>
                      <div className="content">
                        O QR Code expirará em breve. Prepare-se para gerar um novo.
                      </div>
                    </div>
                  )}
                  
                  <button
                    onClick={handleGerarQRCode}
                    className={`br-button ${isExpired ? 'primary large' : 'secondary'}`}
                    disabled={generatingQR}
                  >
                    {generatingQR ? (
                      <>
                        <span className="br-loading small mr-2" style={{ display: 'inline-block', verticalAlign: 'middle' }}></span>
                        Gerando...
                      </>
                    ) : (
                      <>
                        <i className="fas fa-sync-alt mr-2"></i>
                        {isExpired ? 'Gerar Novo QR Code' : 'Renovar QR Code'}
                      </>
                    )}
                  </button>
                  
                  <div className="mt-4 text-left">
                    <div className="br-message info" role="alert">
                      <div className="icon">
                        <i className="fas fa-info-circle fa-lg" aria-hidden="true"></i>
                      </div>
                      <div className="content">
                        <p className="text-weight-semi-bold mb-2">🔒 Segurança Aprimorada:</p>
                        <ul className="mb-0" style={{ paddingLeft: '20px' }}>
                          <li>Token único e criptografado</li>
                          <li>Validade de 30 minutos (renovável)</li>
                          <li>Armazenamento seguro no banco de dados</li>
                          <li>Proteção contra reutilização indevida</li>
                          <li>Log de auditoria de todos os check-ins</li>
                        </ul>
                      </div>
                    </div>
                    
                    <p className="text-down-01 mt-3">
                      <strong>Instruções:</strong>
                    </p>
                    <ul className="text-down-01">
                      <li>Participantes devem escanear este QR Code com seus dispositivos</li>
                      <li>Cada participante pode fazer check-in apenas uma vez</li>
                      <li>O token é validado em tempo real no servidor</li>
                      <li>Acompanhe as presenças no Painel de Presenças</li>
                    </ul>
                  </div>
                </div>
              </div>
            )}
          </>
        )}
        
        {/* Lista de Presenças */}
        {!loading && subevento && (
          <div className="br-card mt-4">
            <div className="card-header">
              <div className="d-flex justify-content-between align-items-center">
                <h4 className="mb-0">
                  <i className="fas fa-list-check mr-2"></i>
                  Lista de Presenças
                </h4>
                <button
                  onClick={fetchPresencas}
                  className="br-button secondary circle small"
                  title="Atualizar lista"
                  disabled={loadingPresencas}
                >
                  <i className={`fas fa-sync-alt ${loadingPresencas ? 'fa-spin' : ''}`}></i>
                </button>
              </div>
            </div>
            <div className="card-content">
              {loadingPresencas ? (
                <div className="text-center py-3">
                  <div className="br-loading" aria-label="Carregando"></div>
                </div>
              ) : presencas.length === 0 ? (
                <div className="text-center py-4 text-gray-60">
                  <i className="fas fa-users-slash fa-2x mb-2"></i>
                  <p className="mb-0">Nenhuma presença confirmada ainda</p>
                </div>
              ) : (
                <>
                  <div className="mb-3">
                    <span className="br-tag info">
                      <i className="fas fa-users mr-1"></i>
                      Total: {presencas.length} {presencas.length === 1 ? 'participante' : 'participantes'}
                    </span>
                  </div>
                  
                  <div className="table-responsive">
                    <table className="br-table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nome</th>
                          <th scope="col">CPF</th>
                          <th scope="col">E-mail</th>
                          <th scope="col">Data/Hora</th>
                          <th scope="col">Origem</th>
                        </tr>
                      </thead>
                      <tbody>
                        {presencas.map((presenca, index) => (
                          <tr key={presenca._id}>
                            <td>{index + 1}</td>
                            <td>{presenca.participant?.nome || 'N/A'}</td>
                            <td>{presenca.participant?.cpf || 'N/A'}</td>
                            <td>{presenca.participant?.email || 'N/A'}</td>
                            <td>
                              {presenca.checkins?.[0]?.timestamp 
                                ? new Date(presenca.checkins[0].timestamp).toLocaleString('pt-BR', {
                                    day: '2-digit',
                                    month: '2-digit',
                                    year: 'numeric',
                                    hour: '2-digit',
                                    minute: '2-digit',
                                  })
                                : 'N/A'}
                            </td>
                            <td>
                              <span className={`br-tag small ${presenca.checkins?.[0]?.origem === 'QR_CODE' ? 'success' : 'warning'}`}>
                                {presenca.checkins?.[0]?.origem === 'QR_CODE' ? (
                                  <>
                                    <i className="fas fa-qrcode mr-1"></i>
                                    QR Code
                                  </>
                                ) : (
                                  <>
                                    <i className="fas fa-hand-pointer mr-1"></i>
                                    Manual
                                  </>
                                )}
                              </span>
                            </td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                </>
              )}
            </div>
          </div>
        )}
      </div>
    </MainLayout>
  );
};

export default GerarQRCode;
