import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

const AdminCicloSimposio = () => {
  const [simposios, setSimposios] = useState([]);
  const [loading, setLoading] = useState(true);
  const [showNovoSimposioModal, setShowNovoSimposioModal] = useState(false);
  const [showFinalizarModal, setShowFinalizarModal] = useState(false);
  const [simposioParaFinalizar, setSimposioParaFinalizar] = useState(null);
  const [processando, setProcessando] = useState(false);
  const { showSuccess, showError } = useNotification();

  const [formData, setFormData] = useState({
    ano: new Date().getFullYear() + 1,
    tema: '',
    dataInicio: '',
    dataFim: '',
    dataInicioSubmissoes: '',
    dataFimSubmissoes: '',
    dataInicioInscricoes: '',
    dataFimInscricoes: '',
    enviarEmail: true,
  });

  useEffect(() => {
    fetchSimposios();
  }, []);

  const fetchSimposios = async () => {
    try {
      setLoading(true);
      const { data } = await api.get('/public/simposios');
      if (data.success) {
        // Ordena por ano decrescente
        const simposiosOrdenados = data.data.sort((a, b) => b.ano - a.ano);
        setSimposios(simposiosOrdenados);
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao carregar simpósios');
    } finally {
      setLoading(false);
    }
  };

  const handleNovoSimposio = () => {
    const proximoAno = Math.max(...simposios.map(s => s.ano), new Date().getFullYear()) + 1;
    setFormData({
      ano: proximoAno,
      tema: '',
      dataInicio: '',
      dataFim: '',
      dataInicioSubmissoes: '',
      dataFimSubmissoes: '',
      dataInicioInscricoes: '',
      dataFimInscricoes: '',
      enviarEmail: true,
    });
    setShowNovoSimposioModal(true);
  };

  const handleCriarSimposio = async (e) => {
    e.preventDefault();
    
    if (!formData.tema || !formData.dataInicio || !formData.dataFim) {
      showError('Preencha todos os campos obrigatórios');
      return;
    }

    try {
      setProcessando(true);
      const { data } = await api.post('/admin/simposios', formData);
      
      if (data.success) {
        showSuccess(
          formData.enviarEmail 
            ? 'Simpósio criado com sucesso! E-mails de notificação foram enviados.'
            : 'Simpósio criado com sucesso!'
        );
        setShowNovoSimposioModal(false);
        fetchSimposios();
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao criar simpósio');
    } finally {
      setProcessando(false);
    }
  };

  const handlePrepararFinalizar = (simposio) => {
    setSimposioParaFinalizar(simposio);
    setShowFinalizarModal(true);
  };

  const handleFinalizarSimposio = async () => {
    try {
      setProcessando(true);
      const { data } = await api.post(`/admin/simposios/${simposioParaFinalizar._id}/finalizar`);
      
      if (data.success) {
        showSuccess('Simpósio finalizado com sucesso!');
        setShowFinalizarModal(false);
        setSimposioParaFinalizar(null);
        fetchSimposios();
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao finalizar simpósio');
    } finally {
      setProcessando(false);
    }
  };

  const getStatusBadge = (simposio) => {
    if (simposio.finalizado) {
      return <span className="br-tag danger">Finalizado</span>;
    }
    
    const hoje = new Date();
    const dataInicio = new Date(simposio.dataInicio);
    const dataFim = new Date(simposio.dataFim);
    
    if (hoje < dataInicio) {
      return <span className="br-tag info">Aguardando Início</span>;
    } else if (hoje >= dataInicio && hoje <= dataFim) {
      return <span className="br-tag success">Em Andamento</span>;
    } else {
      return <span className="br-tag warning">Encerrado (não finalizado)</span>;
    }
  };

  const formatDate = (date) => {
    return new Date(date).toLocaleDateString('pt-BR');
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
            <span>Ciclo de Vida dos Simpósios</span>
          </li>
        </ul>
      </div>

      <div className="my-4">
        <div className="d-flex justify-content-between align-items-center mb-4">
          <h1 className="text-up-03 text-weight-bold">
            <i className="fas fa-calendar-check mr-2"></i>
            Ciclo de Vida dos Simpósios
          </h1>
          <button onClick={handleNovoSimposio} className="br-button primary">
            <i className="fas fa-plus-circle mr-2"></i>
            Iniciar Novo Simpósio
          </button>
        </div>

        {/* Card informativo */}
        <div className="br-message info mb-4">
          <div className="icon">
            <i className="fas fa-info-circle fa-lg"></i>
          </div>
          <div className="content">
            <p className="mb-2">
              <strong>Gerenciamento do Ciclo de Vida</strong>
            </p>
            <ul className="mb-0" style={{ paddingLeft: '20px' }}>
              <li>Inicie um novo simpósio definindo ano, tema e datas importantes</li>
              <li>Configure períodos de submissão e inscrição</li>
              <li>Envie notificações automáticas por e-mail aos participantes</li>
              <li>Finalize simpósios anteriores para arquivamento</li>
            </ul>
          </div>
        </div>

        {loading ? (
          <div className="text-center my-5">
            <div className="br-loading" aria-label="Carregando"></div>
          </div>
        ) : simposios.length === 0 ? (
          <div className="br-card">
            <div className="card-content text-center py-5">
              <i className="fas fa-calendar-times fa-3x text-gray-40 mb-3"></i>
              <p className="text-up-01 text-weight-medium">Nenhum simpósio cadastrado</p>
              <button onClick={handleNovoSimposio} className="br-button primary mt-3">
                <i className="fas fa-plus-circle mr-2"></i>
                Criar Primeiro Simpósio
              </button>
            </div>
          </div>
        ) : (
          <div className="row">
            {simposios.map((simposio) => (
              <div key={simposio._id} className="col-md-6 mb-4">
                <div className="br-card" style={{ 
                  borderLeft: simposio.finalizado ? '4px solid #c92a2a' : '4px solid #168821' 
                }}>
                  <div className="card-header">
                    <div className="d-flex justify-content-between align-items-start">
                      <div>
                        <h3 className="text-weight-bold mb-1">
                          Simpósio {simposio.ano}
                        </h3>
                        {simposio.tema && (
                          <p className="text-down-01 mb-0" style={{ fontStyle: 'italic' }}>
                            "{simposio.tema}"
                          </p>
                        )}
                      </div>
                      {getStatusBadge(simposio)}
                    </div>
                  </div>
                  <div className="card-content">
                    <div className="mb-3">
                      <div className="row">
                        <div className="col-6">
                          <p className="mb-1">
                            <i className="fas fa-calendar-alt mr-2 text-primary"></i>
                            <strong>Período do Evento</strong>
                          </p>
                          <p className="text-down-01 mb-0">
                            {formatDate(simposio.dataInicio)} a {formatDate(simposio.dataFim)}
                          </p>
                        </div>
                        {simposio.dataInicioSubmissoes && simposio.dataFimSubmissoes && (
                          <div className="col-6">
                            <p className="mb-1">
                              <i className="fas fa-file-upload mr-2 text-info"></i>
                              <strong>Submissões</strong>
                            </p>
                            <p className="text-down-01 mb-0">
                              {formatDate(simposio.dataInicioSubmissoes)} a {formatDate(simposio.dataFimSubmissoes)}
                            </p>
                          </div>
                        )}
                      </div>
                    </div>

                    {simposio.dataInicioInscricoes && simposio.dataFimInscricoes && (
                      <div className="mb-3">
                        <p className="mb-1">
                          <i className="fas fa-user-plus mr-2 text-success"></i>
                          <strong>Inscrições</strong>
                        </p>
                        <p className="text-down-01 mb-0">
                          {formatDate(simposio.dataInicioInscricoes)} a {formatDate(simposio.dataFimInscricoes)}
                        </p>
                      </div>
                    )}

                    <div className="d-flex gap-2 mt-3">
                      <Link
                        to={`/admin/simposios/${simposio.ano}`}
                        className="br-button secondary small"
                      >
                        <i className="fas fa-cog mr-2"></i>
                        Configurar
                      </Link>
                      {!simposio.finalizado && (
                        <button
                          onClick={() => handlePrepararFinalizar(simposio)}
                          className="br-button danger small"
                        >
                          <i className="fas fa-flag-checkered mr-2"></i>
                          Finalizar
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

      {/* Modal Novo Simpósio */}
      {showNovoSimposioModal && (
        <>
          <div className="br-modal active" style={{ display: 'block' }}>
            <div className="br-modal-dialog" style={{ maxWidth: '800px' }}>
              <div className="br-modal-content">
                <div className="br-modal-header">
                  <div className="br-modal-title">
                    <i className="fas fa-calendar-plus mr-2"></i>
                    Iniciar Novo Simpósio
                  </div>
                  <button
                    className="br-button circle small"
                    onClick={() => setShowNovoSimposioModal(false)}
                  >
                    <i className="fas fa-times"></i>
                  </button>
                </div>
                <form onSubmit={handleCriarSimposio}>
                  <div className="br-modal-body">
                    <div className="br-message info mb-4">
                      <div className="icon">
                        <i className="fas fa-lightbulb"></i>
                      </div>
                      <div className="content">
                        <p className="mb-0">
                          <strong>Dica:</strong> Configure todas as datas importantes agora. Você poderá ajustá-las depois na página de configuração do simpósio.
                        </p>
                      </div>
                    </div>

                    <div className="row">
                      <div className="col-md-4 mb-3">
                        <div className="br-input">
                          <label htmlFor="ano">Ano do Simpósio *</label>
                          <input
                            id="ano"
                            type="number"
                            value={formData.ano}
                            onChange={(e) => setFormData({ ...formData, ano: parseInt(e.target.value) })}
                            min="2020"
                            max="2099"
                            required
                          />
                        </div>
                      </div>
                      <div className="col-md-8 mb-3">
                        <div className="br-input">
                          <label htmlFor="tema">Tema do Simpósio *</label>
                          <input
                            id="tema"
                            type="text"
                            value={formData.tema}
                            onChange={(e) => setFormData({ ...formData, tema: e.target.value })}
                            placeholder="Ex: Inovação e Tecnologia na Educação"
                            required
                          />
                        </div>
                      </div>
                    </div>

                    <div className="br-divider my-3"></div>
                    <h6 className="text-weight-semi-bold mb-3">
                      <i className="fas fa-calendar-alt mr-2"></i>
                      Datas do Evento
                    </h6>

                    <div className="row">
                      <div className="col-md-6 mb-3">
                        <div className="br-input">
                          <label htmlFor="dataInicio">Data de Início *</label>
                          <input
                            id="dataInicio"
                            type="date"
                            value={formData.dataInicio}
                            onChange={(e) => setFormData({ ...formData, dataInicio: e.target.value })}
                            required
                          />
                        </div>
                      </div>
                      <div className="col-md-6 mb-3">
                        <div className="br-input">
                          <label htmlFor="dataFim">Data de Término *</label>
                          <input
                            id="dataFim"
                            type="date"
                            value={formData.dataFim}
                            onChange={(e) => setFormData({ ...formData, dataFim: e.target.value })}
                            required
                          />
                        </div>
                      </div>
                    </div>

                    <div className="br-divider my-3"></div>
                    <h6 className="text-weight-semi-bold mb-3">
                      <i className="fas fa-file-upload mr-2"></i>
                      Período de Submissão de Trabalhos (opcional)
                    </h6>

                    <div className="row">
                      <div className="col-md-6 mb-3">
                        <div className="br-input">
                          <label htmlFor="dataInicioSubmissoes">Início das Submissões</label>
                          <input
                            id="dataInicioSubmissoes"
                            type="date"
                            value={formData.dataInicioSubmissoes}
                            onChange={(e) => setFormData({ ...formData, dataInicioSubmissoes: e.target.value })}
                          />
                        </div>
                      </div>
                      <div className="col-md-6 mb-3">
                        <div className="br-input">
                          <label htmlFor="dataFimSubmissoes">Fim das Submissões</label>
                          <input
                            id="dataFimSubmissoes"
                            type="date"
                            value={formData.dataFimSubmissoes}
                            onChange={(e) => setFormData({ ...formData, dataFimSubmissoes: e.target.value })}
                          />
                        </div>
                      </div>
                    </div>

                    <div className="br-divider my-3"></div>
                    <h6 className="text-weight-semi-bold mb-3">
                      <i className="fas fa-user-plus mr-2"></i>
                      Período de Inscrições (opcional)
                    </h6>

                    <div className="row">
                      <div className="col-md-6 mb-3">
                        <div className="br-input">
                          <label htmlFor="dataInicioInscricoes">Início das Inscrições</label>
                          <input
                            id="dataInicioInscricoes"
                            type="date"
                            value={formData.dataInicioInscricoes}
                            onChange={(e) => setFormData({ ...formData, dataInicioInscricoes: e.target.value })}
                          />
                        </div>
                      </div>
                      <div className="col-md-6 mb-3">
                        <div className="br-input">
                          <label htmlFor="dataFimInscricoes">Fim das Inscrições</label>
                          <input
                            id="dataFimInscricoes"
                            type="date"
                            value={formData.dataFimInscricoes}
                            onChange={(e) => setFormData({ ...formData, dataFimInscricoes: e.target.value })}
                          />
                        </div>
                      </div>
                    </div>

                    <div className="br-divider my-3"></div>
                    <div className="br-checkbox mb-3">
                      <input
                        id="enviarEmail"
                        type="checkbox"
                        checked={formData.enviarEmail}
                        onChange={(e) => setFormData({ ...formData, enviarEmail: e.target.checked })}
                      />
                      <label htmlFor="enviarEmail">
                        <i className="fas fa-envelope mr-2"></i>
                        Enviar e-mail de notificação para todos os participantes cadastrados
                      </label>
                    </div>

                    {formData.enviarEmail && (
                      <div className="br-message warning">
                        <div className="icon">
                          <i className="fas fa-exclamation-triangle"></i>
                        </div>
                        <div className="content">
                          <p className="mb-0">
                            Um e-mail será enviado para todos os participantes anunciando o novo simpósio com as informações e datas cadastradas.
                          </p>
                        </div>
                      </div>
                    )}
                  </div>
                  <div className="br-modal-footer">
                    <button
                      type="button"
                      className="br-button secondary"
                      onClick={() => setShowNovoSimposioModal(false)}
                    >
                      Cancelar
                    </button>
                    <button type="submit" className="br-button primary" disabled={processando}>
                      {processando ? (
                        <>
                          <span className="br-loading small mr-2" style={{ display: 'inline-block' }}></span>
                          Criando...
                        </>
                      ) : (
                        <>
                          <i className="fas fa-rocket mr-2"></i>
                          Criar e Iniciar Simpósio
                        </>
                      )}
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div className="br-scrim active" onClick={() => setShowNovoSimposioModal(false)}></div>
        </>
      )}

      {/* Modal Finalizar Simpósio */}
      {showFinalizarModal && simposioParaFinalizar && (
        <>
          <div className="br-modal active" style={{ display: 'block' }}>
            <div className="br-modal-dialog">
              <div className="br-modal-content">
                <div className="br-modal-header">
                  <div className="br-modal-title">
                    <i className="fas fa-flag-checkered mr-2"></i>
                    Finalizar Simpósio
                  </div>
                  <button
                    className="br-button circle small"
                    onClick={() => setShowFinalizarModal(false)}
                  >
                    <i className="fas fa-times"></i>
                  </button>
                </div>
                <div className="br-modal-body">
                  <div className="br-message danger mb-3">
                    <div className="icon">
                      <i className="fas fa-exclamation-triangle fa-lg"></i>
                    </div>
                    <div className="content">
                      <p className="text-weight-semi-bold mb-2">Atenção! Esta ação não pode ser desfeita.</p>
                      <p className="mb-0">
                        Ao finalizar o simpósio, ele será marcado como encerrado e arquivado. Nenhuma alteração poderá ser feita posteriormente.
                      </p>
                    </div>
                  </div>

                  <div className="mb-3 p-3" style={{ backgroundColor: '#f8f9fa', borderRadius: '4px' }}>
                    <h6 className="text-weight-semi-bold mb-2">Você está finalizando:</h6>
                    <p className="mb-1">
                      <strong>Ano:</strong> {simposioParaFinalizar.ano}
                    </p>
                    {simposioParaFinalizar.tema && (
                      <p className="mb-1">
                        <strong>Tema:</strong> {simposioParaFinalizar.tema}
                      </p>
                    )}
                    <p className="mb-0">
                      <strong>Período:</strong> {formatDate(simposioParaFinalizar.dataInicio)} a {formatDate(simposioParaFinalizar.dataFim)}
                    </p>
                  </div>

                  <p className="text-center text-weight-semi-bold">
                    Tem certeza que deseja finalizar este simpósio?
                  </p>
                </div>
                <div className="br-modal-footer">
                  <button
                    type="button"
                    className="br-button secondary"
                    onClick={() => setShowFinalizarModal(false)}
                  >
                    Cancelar
                  </button>
                  <button 
                    onClick={handleFinalizarSimposio} 
                    className="br-button danger"
                    disabled={processando}
                  >
                    {processando ? (
                      <>
                        <span className="br-loading small mr-2" style={{ display: 'inline-block' }}></span>
                        Finalizando...
                      </>
                    ) : (
                      <>
                        <i className="fas fa-check-circle mr-2"></i>
                        Sim, Finalizar Simpósio
                      </>
                    )}
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div className="br-scrim active" onClick={() => setShowFinalizarModal(false)}></div>
        </>
      )}
    </MainLayout>
  );
};

export default AdminCicloSimposio;
