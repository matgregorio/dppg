import React, { useState, useEffect } from 'react';
import { Link, useSearchParams } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const ValidarCertificado = () => {
  const [searchParams] = useSearchParams();
  const [hash, setHash] = useState(searchParams.get('hash') || '');
  const [certificado, setCertificado] = useState(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [sucesso, setSucesso] = useState(false);

  useEffect(() => {
    if (searchParams.get('hash')) {
      handleValidar();
    }
  }, []);

  const handleValidar = async (e) => {
    if (e) e.preventDefault();
    
    if (!hash.trim()) {
      setError('Por favor, informe o código de validação');
      return;
    }

    try {
      setLoading(true);
      setError('');
      setSucesso(false);
      setCertificado(null);

      const { data } = await api.get(`/public/certificados/validar/${hash}`);
      
      if (data.success) {
        setCertificado(data.data);
        setSucesso(true);
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Certificado não encontrado ou inválido');
      setCertificado(null);
      setSucesso(false);
    } finally {
      setLoading(false);
    }
  };

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
            <span>Validar Certificado</span>
          </li>
        </ul>
      </div>

      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">
          <i className="fas fa-certificate mr-2"></i>
          Validar Certificado
        </h1>

        <div className="row justify-content-center">
          <div className="col-lg-8">
            <div className="br-card">
              <div className="card-content">
                <p className="text-base mb-4">
                  Digite o código de validação do certificado para verificar sua autenticidade. 
                  O código está localizado no rodapé do certificado.
                </p>

                <form onSubmit={handleValidar}>
                  <div className="br-input mb-3">
                    <label htmlFor="hash">
                      Código de Validação <span className="text-danger">*</span>
                    </label>
                    <input
                      id="hash"
                      type="text"
                      placeholder="Ex: a1b2c3d4e5f6..."
                      value={hash}
                      onChange={(e) => setHash(e.target.value)}
                      disabled={loading}
                    />
                    <div className="text-base text-down-01 mt-2">
                      <i className="fas fa-info-circle mr-1"></i>
                      O código é uma sequência alfanumérica de 64 caracteres
                    </div>
                  </div>

                  <button
                    type="submit"
                    className="br-button primary large mb-3"
                    disabled={loading}
                  >
                    {loading ? (
                      <>
                        <i className="fas fa-spinner fa-spin mr-2"></i>
                        Validando...
                      </>
                    ) : (
                      <>
                        <i className="fas fa-check-circle mr-2"></i>
                        Validar Certificado
                      </>
                    )}
                  </button>
                </form>

                {error && (
                  <div className="br-message danger mt-4" role="alert">
                    <div className="icon">
                      <i className="fas fa-times-circle fa-lg"></i>
                    </div>
                    <div className="content">
                      <strong>Certificado Inválido</strong>
                      <p className="mt-2">{error}</p>
                    </div>
                  </div>
                )}

                {sucesso && certificado && (
                  <div className="br-message success mt-4" role="alert">
                    <div className="icon">
                      <i className="fas fa-check-circle fa-lg"></i>
                    </div>
                    <div className="content">
                      <strong className="mb-3 d-block">✅ Certificado Válido e Autêntico</strong>
                      
                      <div className="mt-3">
                        <div className="mb-2">
                          <strong>Tipo:</strong> {getTipoCertificado(certificado.tipo)}
                        </div>
                        <div className="mb-2">
                          <strong>Participante:</strong> {certificado.participante?.nome}
                        </div>
                        <div className="mb-2">
                          <strong>Simpósio:</strong> Ano {certificado.simposio?.ano}
                        </div>
                        {certificado.trabalho && (
                          <div className="mb-2">
                            <strong>Trabalho:</strong> {certificado.trabalho.titulo}
                          </div>
                        )}
                        <div className="mb-2">
                          <strong>Data de Emissão:</strong>{' '}
                          {new Date(certificado.gerado_em).toLocaleDateString('pt-BR')}
                        </div>
                        <div className="mb-2">
                          <strong>Status:</strong>{' '}
                          <span className={`text-weight-semi-bold ${certificado.status === 'ATIVO' ? 'text-success' : 'text-danger'}`}>
                            {certificado.status}
                          </span>
                        </div>
                      </div>

                      {certificado.pdfPath && (
                        <div className="mt-4">
                          <a
                            href={`${import.meta.env.VITE_API_BASE_URL.replace('/api/v1', '')}/uploads/${certificado.pdfPath}`}
                            target="_blank"
                            rel="noopener noreferrer"
                            className="br-button secondary"
                          >
                            <i className="fas fa-download mr-2"></i>
                            Baixar Certificado (PDF)
                          </a>
                        </div>
                      )}
                    </div>
                  </div>
                )}
              </div>
            </div>

            <div className="br-card mt-3">
              <div className="card-content">
                <h3 className="text-up-01 text-weight-semi-bold mb-3">
                  <i className="fas fa-question-circle mr-2"></i>
                  Como validar?
                </h3>
                <ol className="pl-4">
                  <li className="mb-2">Localize o código de validação no rodapé do certificado</li>
                  <li className="mb-2">Cole ou digite o código no campo acima</li>
                  <li className="mb-2">Clique em "Validar Certificado"</li>
                  <li>Verifique as informações exibidas</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
    </MainLayout>
  );
};

export default ValidarCertificado;
