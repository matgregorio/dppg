import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

const AdminCertificadosConfig = () => {
  const { ano } = useParams();
  const [simposio, setSimposio] = useState(null);
  const [config, setConfig] = useState(null);
  const [loading, setLoading] = useState(true);
  const [processando, setProcessando] = useState(false);
  const { showSuccess, showError } = useNotification();

  const [formData, setFormData] = useState({
    nome1: '',
    cargo1: '',
    nome2: '',
    cargo2: '',
    nome3: '',
    cargo3: '',
  });

  useEffect(() => {
    fetchSimposio();
  }, [ano]);

  const fetchSimposio = async () => {
    try {
      setLoading(true);
      const { data } = await api.get(`/admin/simposios/${ano}`);
      if (data.success) {
        setSimposio(data.data);
        await fetchConfiguracoes(data.data._id);
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao carregar simpósio');
    } finally {
      setLoading(false);
    }
  };

  const fetchConfiguracoes = async (simposioId) => {
    try {
      const { data } = await api.get(`/admin/simposios/${simposioId}/certificados/configuracoes`);
      if (data.success) {
        setConfig(data.data);
        setFormData({
          nome1: data.data.nome1 || '',
          cargo1: data.data.cargo1 || '',
          nome2: data.data.nome2 || '',
          cargo2: data.data.cargo2 || '',
          nome3: data.data.nome3 || '',
          cargo3: data.data.cargo3 || '',
        });
      }
    } catch (err) {
      console.error('Erro ao carregar configurações:', err);
    }
  };

  const handleUploadImagem = async (tipo, file) => {
    if (!file) return;

    const formData = new FormData();
    formData.append('imagem', file);
    formData.append('tipo', tipo);

    try {
      setProcessando(true);
      const { data } = await api.post(
        `/admin/simposios/${simposio._id}/certificados/upload-imagem`,
        formData,
        {
          headers: { 'Content-Type': 'multipart/form-data' },
        }
      );

      if (data.success) {
        showSuccess('Imagem enviada com sucesso');
        await fetchConfiguracoes(simposio._id);
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao enviar imagem');
    } finally {
      setProcessando(false);
    }
  };

  const handleRemoverImagem = async (tipo) => {
    if (!confirm(`Deseja realmente remover esta imagem?`)) return;

    try {
      setProcessando(true);
      const { data } = await api.delete(
        `/admin/simposios/${simposio._id}/certificados/remover-imagem`,
        { data: { tipo } }
      );

      if (data.success) {
        showSuccess('Imagem removida com sucesso');
        await fetchConfiguracoes(simposio._id);
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao remover imagem');
    } finally {
      setProcessando(false);
    }
  };

  const handleSalvarTextos = async (e) => {
    e.preventDefault();

    try {
      setProcessando(true);
      const { data } = await api.put(
        `/admin/simposios/${simposio._id}/certificados/configuracoes`,
        formData
      );

      if (data.success) {
        showSuccess('Configurações salvas com sucesso');
        await fetchConfiguracoes(simposio._id);
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao salvar configurações');
    } finally {
      setProcessando(false);
    }
  };

  const handleReg

enerarTodos = async () => {
    if (!confirm('Deseja regenerar TODOS os certificados? Esta ação pode demorar alguns minutos.')) return;

    try {
      setProcessando(true);
      const { data } = await api.post(`/admin/simposios/${simposio._id}/certificados/regenerar-todos`);

      if (data.success) {
        showSuccess(`${data.data.regenerados} certificados regenerados com sucesso!`);
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao regenerar certificados');
    } finally {
      setProcessando(false);
    }
  };

  const ImageUploadCard = ({ titulo, tipo, imagemAtual, descricao }) => (
    <div className="br-card">
      <div className="card-header">
        <h5>{titulo}</h5>
        <p className="text-down-01">{descricao}</p>
      </div>
      <div className="card-content">
        {imagemAtual ? (
          <div className="mb-3">
            <img 
              src={`${import.meta.env.VITE_API_BASE_URL?.replace('/api/v1', '') || 'http://localhost:4000'}/uploads/certificados/imagens/${imagemAtual}`}
              alt={titulo}
              style={{ maxWidth: '200px', maxHeight: '100px', objectFit: 'contain' }}
              className="mb-2"
            />
            <br />
            <button
              onClick={() => handleRemoverImagem(tipo)}
              className="br-button secondary small"
              disabled={processando}
            >
              <i className="fas fa-trash mr-2"></i>
              Remover
            </button>
          </div>
        ) : (
          <p className="text-muted mb-3">Nenhuma imagem cadastrada</p>
        )}
        
        <div className="br-upload">
          <label className="upload-label">
            <input
              type="file"
              accept="image/jpeg,image/jpg,image/png"
              onChange={(e) => e.target.files[0] && handleUploadImagem(tipo, e.target.files[0])}
              disabled={processando}
            />
            <span className="upload-button">
              <i className="fas fa-upload mr-2"></i>
              {imagemAtual ? 'Substituir Imagem' : 'Enviar Imagem'}
            </span>
          </label>
          <small className="text-muted d-block mt-2">
            Formatos: JPG, JPEG, PNG (máx. 5MB)
          </small>
        </div>
      </div>
    </div>
  );

  if (loading) {
    return (
      <MainLayout>
        <div className="text-center my-5">
          <div className="br-loading" aria-label="Carregando"></div>
        </div>
      </MainLayout>
    );
  }

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
            <Link to={`/admin/simposios/${ano}`}>Simpósio {ano}</Link>
          </li>
          <li className="crumb">
            <i className="icon fas fa-chevron-right"></i>
            <span>Configurar Certificados</span>
          </li>
        </ul>
      </div>

      <div className="my-4">
        <div className="d-flex justify-content-between align-items-center mb-4">
          <h1 className="text-up-03 text-weight-bold">
            <i className="fas fa-certificate mr-2"></i>
            Configuração de Certificados
          </h1>
          <button
            onClick={handleRegenerarTodos}
            className="br-button primary"
            disabled={processando}
          >
            {processando ? (
              <>
                <span className="br-loading small mr-2"></span>
                Processando...
              </>
            ) : (
              <>
                <i className="fas fa-sync-alt mr-2"></i>
                Regenerar Todos os Certificados
              </>
            )}
          </button>
        </div>

        <div className="br-message info mb-4">
          <div className="icon">
            <i className="fas fa-info-circle fa-lg"></i>
          </div>
          <div className="content">
            <p className="mb-0">
              Configure os logos e assinaturas que aparecerão nos certificados. Após fazer upload das imagens,
              é recomendado regenerar todos os certificados para aplicar as alterações.
            </p>
          </div>
        </div>

        {/* Logos */}
        <h3 className="mb-3">Logos e Ícones</h3>
        <div className="row mb-4">
          <div className="col-md-6 mb-3">
            <ImageUploadCard
              titulo="Logo do IF"
              tipo="logoIF"
              imagemAtual={config?.logoIF}
              descricao="Logo da instituição (aparece no canto superior esquerdo)"
            />
          </div>
          <div className="col-md-6 mb-3">
            <ImageUploadCard
              titulo="Logo do Evento/DPPG"
              tipo="logoEvento"
              imagemAtual={config?.logoEvento}
              descricao="Logo do evento ou DPPG (aparece no canto superior direito)"
            />
          </div>
        </div>

        {/* Assinaturas */}
        <h3 className="mb-3">Assinaturas</h3>
        <div className="row mb-4">
          <div className="col-md-4 mb-3">
            <ImageUploadCard
              titulo="Assinatura 1"
              tipo="assinatura1"
              imagemAtual={config?.assinatura1}
              descricao="Primeira assinatura (esquerda)"
            />
          </div>
          <div className="col-md-4 mb-3">
            <ImageUploadCard
              titulo="Assinatura 2"
              tipo="assinatura2"
              imagemAtual={config?.assinatura2}
              descricao="Segunda assinatura (centro)"
            />
          </div>
          <div className="col-md-4 mb-3">
            <ImageUploadCard
              titulo="Assinatura 3"
              tipo="assinatura3"
              imagemAtual={config?.assinatura3}
              descricao="Terceira assinatura (direita)"
            />
          </div>
        </div>

        {/* Textos das Assinaturas */}
        <h3 className="mb-3">Informações das Assinaturas</h3>
        <form onSubmit={handleSalvarTextos}>
          <div className="br-card">
            <div className="card-content">
              <div className="row">
                <div className="col-md-4 mb-3">
                  <div className="br-input">
                    <label htmlFor="nome1">Nome (Assinatura 1)</label>
                    <input
                      id="nome1"
                      type="text"
                      value={formData.nome1}
                      onChange={(e) => setFormData({ ...formData, nome1: e.target.value })}
                      placeholder="Ex: Letícia de Araújo Cabral"
                    />
                  </div>
                  <div className="br-input">
                    <label htmlFor="cargo1">Cargo (Assinatura 1)</label>
                    <input
                      id="cargo1"
                      type="text"
                      value={formData.cargo1}
                      onChange={(e) => setFormData({ ...formData, cargo1: e.target.value })}
                      placeholder="Ex: Instrutora"
                    />
                  </div>
                </div>

                <div className="col-md-4 mb-3">
                  <div className="br-input">
                    <label htmlFor="nome2">Nome (Assinatura 2)</label>
                    <input
                      id="nome2"
                      type="text"
                      value={formData.nome2}
                      onChange={(e) => setFormData({ ...formData, nome2: e.target.value })}
                      placeholder="Ex: Isabela Campelo de Queiroz"
                    />
                  </div>
                  <div className="br-input">
                    <label htmlFor="cargo2">Cargo (Assinatura 2)</label>
                    <input
                      id="cargo2"
                      type="text"
                      value={formData.cargo2}
                      onChange={(e) => setFormData({ ...formData, cargo2: e.target.value })}
                      placeholder="Ex: Orientadora"
                    />
                  </div>
                </div>

                <div className="col-md-4 mb-3">
                  <div className="br-input">
                    <label htmlFor="nome3">Nome (Assinatura 3)</label>
                    <input
                      id="nome3"
                      type="text"
                      value={formData.nome3}
                      onChange={(e) => setFormData({ ...formData, nome3: e.target.value })}
                      placeholder="Ex: Márcio José F. de Barros"
                    />
                  </div>
                  <div className="br-input">
                    <label htmlFor="cargo3">Cargo (Assinatura 3)</label>
                    <input
                      id="cargo3"
                      type="text"
                      value={formData.cargo3}
                      onChange={(e) => setFormData({ ...formData, cargo3: e.target.value })}
                      placeholder="Ex: Presidente do CACTA"
                    />
                  </div>
                </div>
              </div>

              <div className="text-right mt-3">
                <button type="submit" className="br-button primary" disabled={processando}>
                  {processando ? (
                    <>
                      <span className="br-loading small mr-2"></span>
                      Salvando...
                    </>
                  ) : (
                    <>
                      <i className="fas fa-save mr-2"></i>
                      Salvar Informações
                    </>
                  )}
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </MainLayout>
  );
};

export default AdminCertificadosConfig;
