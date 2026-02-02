import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import { BrSelect, BrDateTimePicker } from '@govbr-ds/react-components';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

const AdminEditarSimposio = () => {
  const { ano } = useParams();
  const { showSuccess, showError } = useNotification();
  
  const [simposio, setSimposio] = useState(null);
  const [simposios, setSimposios] = useState([]);
  const [loading, setLoading] = useState(true);
  const [processando, setProcessando] = useState(false);
  const [anoSelecionado, setAnoSelecionado] = useState(ano);
  const [activeTab, setActiveTab] = useState('info');
  
  const [formData, setFormData] = useState({ tema: '' });
  
  // Subeventos
  const [subeventos, setSubeventos] = useState([]);
  const [showNovoSubeventoModal, setShowNovoSubeventoModal] = useState(false);
  const [mesarios, setMesarios] = useState([]);
  const [novoSubeventoForm, setNovoSubeventoForm] = useState({
    titulo: '',
    tipo: '',
    data: '',
    horarioInicio: '',
    duracao: '',
    palestrante: '',
    local: '',
    descricao: '',
    vagas: '',
    evento: '',
    simposio: '',
    responsaveisMesarios: [],
  });

  // Participantes
  const [participantes, setParticipantes] = useState([]);
  const [showNovoParticipanteModal, setShowNovoParticipanteModal] = useState(false);
  const [novoParticipanteForm, setNovoParticipanteForm] = useState({
    nome: '',
    email: '',
    cpf: '',
    instituicao: '',
  });

  // Certificados
  const [certificados, setCertificados] = useState([]);
  const [loadingCertificados, setLoadingCertificados] = useState(false);

  const tiposSubevento = ['Palestra', 'Minicurso', 'Workshop', 'Mesa Redonda', 'Apresentação', 'Outro'];

  useEffect(() => {
    fetchSimposios();
    fetchMesarios();
  }, []);

  useEffect(() => {
    if (anoSelecionado) {
      fetchSimposioDetalhes(anoSelecionado);
      if (activeTab === 'subeventos') {
        fetchSubeventos(anoSelecionado);
      } else if (activeTab === 'participantes') {
        fetchParticipantes(anoSelecionado);
      } else if (activeTab === 'certificados') {
        fetchCertificados(anoSelecionado);
      }
    }
  }, [anoSelecionado]);

  useEffect(() => {
    if (anoSelecionado) {
      if (activeTab === 'subeventos') {
        fetchSubeventos(anoSelecionado);
      } else if (activeTab === 'participantes') {
        fetchParticipantes(anoSelecionado);
      } else if (activeTab === 'certificados') {
        fetchCertificados(anoSelecionado);
      }
    }
  }, [activeTab, anoSelecionado]);

  const fetchSimposios = async () => {
    try {
      const { data } = await api.get('/public/simposios');
      if (data.success) {
        const simposiosOrdenados = data.data.sort((a, b) => b.ano - a.ano);
        setSimposios(simposiosOrdenados);
        const anoInicial = ano || (simposiosOrdenados.length > 0 ? simposiosOrdenados[0].ano : null);
        setAnoSelecionado(anoInicial);
      }
    } catch (err) {
      showError('Erro ao carregar simpósios');
    }
  };

  const fetchSimposioDetalhes = async (anoSimposio) => {
    try {
      setLoading(true);
      const { data } = await api.get(`/admin/simposios/${anoSimposio}`);
      if (data.success) {
        const simp = data.data;
        setSimposio(simp);
        setFormData({ tema: simp.tema || '' });
      }
    } catch (err) {
      showError('Erro ao carregar simpósio');
    } finally {
      setLoading(false);
    }
  };

  const fetchSubeventos = async (anoSimposio) => {
    try {
      const { data } = await api.get(`/admin/simposios/${anoSimposio}/subeventos`);
      if (data.success) {
        setSubeventos(data.data || []);
      }
    } catch (err) {
      console.error('Erro:', err);
      setSubeventos([]);
    }
  };

  const fetchParticipantes = async (anoSimposio) => {
    try {
      const { data } = await api.get(`/admin/participantes?simposio=${anoSimposio}`);
      if (data.success) {
        setParticipantes(data.data || []);
      }
    } catch (err) {
      console.error('Erro:', err);
      setParticipantes([]);
    }
  };

  const fetchCertificados = async (anoSimposio) => {
    try {
      setLoadingCertificados(true);
      const { data } = await api.get(`/admin/simposios/${anoSimposio}/certificados`);
      if (data.success) {
        setCertificados(data.data || []);
      }
    } catch (err) {
      console.error('Erro:', err);
      setCertificados([]);
    } finally {
      setLoadingCertificados(false);
    }
  };

  const fetchMesarios = async () => {
    try {
      const { data } = await api.get('/admin/participantes', {
        params: { limit: 1000 },
      });
      if (data.success) {
        const participantesOrdenados = data.data.sort((a, b) => a.nome.localeCompare(b.nome));
        setMesarios(participantesOrdenados);
      }
    } catch (err) {
      console.error('Erro ao carregar participantes:', err);
    }
  };

  const handleSalvarTema = async (e) => {
    e.preventDefault();
    if (!formData.tema) {
      showError('Preencha o tema');
      return;
    }
    try {
      setProcessando(true);
      const { data } = await api.put(`/admin/simposios/${anoSelecionado}`, { tema: formData.tema });
      if (data.success) {
        showSuccess('Simpósio atualizado!');
        fetchSimposioDetalhes(anoSelecionado);
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao atualizar');
    } finally {
      setProcessando(false);
    }
  };

  const handleAdicionarSubevento = async (e) => {
    e.preventDefault();
    if (!novoSubeventoForm.titulo || !novoSubeventoForm.data || !novoSubeventoForm.horarioInicio || !novoSubeventoForm.duracao || !novoSubeventoForm.simposio) {
      showError('Preencha todos os campos obrigatórios');
      return;
    }
    try {
      setProcessando(true);
      const { data } = await api.post('/admin/subeventos', {
        ...novoSubeventoForm,
        aprovado: true,
      });
      if (data.success) {
        showSuccess('Subeventos adicionado!');
        setShowNovoSubeventoModal(false);
        setNovoSubeventoForm({
          titulo: '',
          tipo: '',
          data: '',
          horarioInicio: '',
          duracao: '',
          palestrante: '',
          local: '',
          descricao: '',
          vagas: '',
          evento: '',
          simposio: simposios[0]?._id || '',
          responsaveisMesarios: [],
        });
        fetchSubeventos(anoSelecionado);
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao adicionar');
    } finally {
      setProcessando(false);
    }
  };

  const handleDeletarSubevento = async (id) => {
    if (!window.confirm('Remover subeventos?')) return;
    try {
      const { data } = await api.delete(`/admin/subeventos/${id}`);
      if (data.success) {
        showSuccess('Subeventos removido!');
        fetchSubeventos(anoSelecionado);
      }
    } catch (err) {
      showError('Erro ao remover');
    }
  };

  const handleAdicionarParticipante = async (e) => {
    e.preventDefault();
    if (!novoParticipanteForm.nome || !novoParticipanteForm.email || !novoParticipanteForm.cpf) {
      showError('Preencha nome, email e CPF');
      return;
    }
    try {
      setProcessando(true);
      const { data } = await api.post(`/admin/participantes`, {
        ...novoParticipanteForm,
        simposio: anoSelecionado,
      });
      if (data.success) {
        showSuccess('Participante adicionado!');
        setShowNovoParticipanteModal(false);
        setNovoParticipanteForm({ nome: '', email: '', cpf: '', instituicao: '' });
        fetchParticipantes(anoSelecionado);
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao adicionar');
    } finally {
      setProcessando(false);
    }
  };

  const handleDeletarParticipante = async (id) => {
    if (!window.confirm('Remover participante?')) return;
    try {
      const { data } = await api.delete(`/admin/participantes/${id}`);
      if (data.success) {
        showSuccess('Participante removido!');
        fetchParticipantes(anoSelecionado);
      }
    } catch (err) {
      showError('Erro ao remover');
    }
  };

  const handleMesarioToggle = (mesarioId) => {
    setNovoSubeventoForm((prev) => ({
      ...prev,
      responsaveisMesarios: prev.responsaveisMesarios.includes(mesarioId)
        ? prev.responsaveisMesarios.filter((id) => id !== mesarioId)
        : [...prev.responsaveisMesarios, mesarioId],
    }));
  };

  const handleNovoSubevento = () => {
    setNovoSubeventoForm({
      titulo: '',
      tipo: '',
      data: '',
      horarioInicio: '',
      duracao: '',
      palestrante: '',
      local: '',
      descricao: '',
      vagas: '',
      evento: '',
      simposio: simposios.find(s => s.ano === anoSelecionado)?._id || simposios[0]?._id || '',
      responsaveisMesarios: [],
    });
    setShowNovoSubeventoModal(true);
  };

  const handleRegenerarCertificados = async () => {
    if (!window.confirm('Regenerar todos os certificados? Pode levar alguns minutos.')) return;
    try {
      setProcessando(true);
      const { data } = await api.post(`/admin/simposios/${anoSelecionado}/certificados/regenerar-todos`);
      if (data.success) {
        showSuccess('Certificados regenerados!');
        fetchCertificados(anoSelecionado);
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao regenerar');
    } finally {
      setProcessando(false);
    }
  };

  const formatDate = (date) => {
    if (!date) return '-';
    return new Date(date).toLocaleDateString('pt-BR');
  };

  const formatDateTime = (date) => {
    if (!date) return '-';
    return new Date(date).toLocaleString('pt-BR');
  };

  if (!anoSelecionado) {
    return (
      <MainLayout>
        <div className="my-4">
          <h1 className="text-up-03 text-weight-bold mb-4">Gerenciar Simpósio</h1>
          <div className="br-card">
            <div className="card-content text-center py-5">
              <i className="fas fa-calendar-times fa-3x text-gray-40 mb-3"></i>
              <p>Nenhum simpósio selecionado</p>
            </div>
          </div>
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
            <Link to="/admin/ciclo-simposio">Ciclo de Vida</Link>
          </li>
          <li className="crumb">
            <i className="icon fas fa-chevron-right"></i>
            <span>Gerenciar Simpósio</span>
          </li>
        </ul>
      </div>

      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">Gerenciar Simpósio</h1>

        <div className="br-card mb-4">
          <div className="card-content">
            <BrSelect
              label="Selecione uma Edição"
              placeholder="Selecione..."
              options={simposios.map(s => ({
                label: `Simpósio ${s.ano} ${s.tema ? `- ${s.tema}` : ''} ${s.finalizado ? '(Finalizado)' : ''}`,
                value: s.ano
              }))}
              onChange={(value) => setAnoSelecionado(parseInt(value))}
              value={anoSelecionado ? String(anoSelecionado) : ''}
              emptyOptionsMessage="Nenhuma edição encontrada"
            />
          </div>
        </div>

        {loading ? (
          <div className="text-center my-5">
            <div className="br-loading"></div>
          </div>
        ) : simposio ? (
          <>
            <div className="br-card mb-4">
              <div className="card-header">
                <h5 className="text-weight-bold">Simpósio {simposio.ano}</h5>
              </div>
              <div className="card-content">
                <div className="row">
                  <div className="col-md-6">
                    <p className="mb-1"><strong>Status:</strong></p>
                    {simposio.finalizado ? (
                      <span className="br-tag danger">Finalizado</span>
                    ) : (
                      <span className="br-tag success">Em Andamento</span>
                    )}
                  </div>
                  <div className="col-md-6">
                    <p className="mb-1"><strong>Tema:</strong></p>
                    <p className="mb-0">{simposio.tema || 'Não configurado'}</p>
                  </div>
                </div>
              </div>
            </div>

            <div className="br-card">
              <div className="card-header" style={{ borderBottom: '1px solid #ddd', paddingBottom: 0 }}>
                <div style={{ display: 'flex', gap: '5px', flexWrap: 'wrap', paddingBottom: '10px' }}>
                  {['info', 'subeventos', 'participantes', 'certificados'].map((tab) => (
                    <button
                      key={tab}
                      className={`br-button ${activeTab === tab ? 'primary' : 'secondary'} small`}
                      onClick={() => setActiveTab(tab)}
                    >
                      {tab === 'info' && <><i className="fas fa-info-circle mr-2"></i>Informações</>}
                      {tab === 'subeventos' && <><i className="fas fa-calendar mr-2"></i>Subeventos</>}
                      {tab === 'participantes' && <><i className="fas fa-users mr-2"></i>Participantes</>}
                      {tab === 'certificados' && <><i className="fas fa-certificate mr-2"></i>Certificados</>}
                    </button>
                  ))}
                </div>
              </div>

              <div className="card-content">
                {activeTab === 'info' && (
                  <form onSubmit={handleSalvarTema}>
                    {simposio.finalizado && (
                      <div className="br-message warning mb-3">
                        <i className="fas fa-exclamation-triangle"></i>
                        <div className="content">
                          <p className="mb-0">Apenas o tema pode ser editado em simpósios finalizados.</p>
                        </div>
                      </div>
                    )}
                    <div className="br-input mb-4">
                      <label htmlFor="tema">Tema do Simpósio *</label>
                      <input
                        id="tema"
                        type="text"
                        value={formData.tema}
                        onChange={(e) => setFormData({ tema: e.target.value })}
                        required
                      />
                    </div>
                    <div style={{ display: 'flex', gap: '10px', justifyContent: 'flex-end' }}>
                      <Link to="/admin/ciclo-simposio" className="br-button secondary">
                        <i className="fas fa-times mr-2"></i>Voltar
                      </Link>
                      <button type="submit" className="br-button primary" disabled={processando}>
                        {processando ? 'Salvando...' : (<><i className="fas fa-save mr-2"></i>Salvar</>)}
                      </button>
                    </div>
                  </form>
                )}

                {activeTab === 'subeventos' && (
                  <div>
                    <div className="d-flex justify-content-between align-items-center mb-4">
                      <h6><i className="fas fa-calendar mr-2"></i>Subeventos ({subeventos.length})</h6>
                      <button onClick={handleNovoSubevento} className="br-button primary small">
                        <i className="fas fa-plus-circle mr-2"></i>Novo
                      </button>
                    </div>
                    {subeventos.length === 0 ? (
                      <p style={{ textAlign: 'center', color: '#666' }}>Nenhum subeventos</p>
                    ) : (
                      <table className="br-table">
                        <thead>
                          <tr>
                            <th>Título</th>
                            <th>Tipo</th>
                            <th>Data</th>
                            <th>Horário</th>
                            <th>Ações</th>
                          </tr>
                        </thead>
                        <tbody>
                          {subeventos.map((s) => (
                            <tr key={s._id}>
                              <td>{s.titulo}</td>
                              <td>{s.tipo || '-'}</td>
                              <td>{s.data ? new Date(s.data).toLocaleDateString('pt-BR') : '-'}</td>
                              <td>{s.horarioInicio || '-'}</td>
                              <td>
                                <button onClick={() => handleDeletarSubevento(s._id)} className="br-button danger small">
                                  <i className="fas fa-trash mr-2"></i>Remover
                                </button>
                              </td>
                            </tr>
                          ))}
                        </tbody>
                      </table>
                    )}
                  </div>
                )}

                {activeTab === 'participantes' && (
                  <div>
                    <div className="d-flex justify-content-between align-items-center mb-4">
                      <h6><i className="fas fa-users mr-2"></i>Participantes ({participantes.length})</h6>
                      <button onClick={() => setShowNovoParticipanteModal(true)} className="br-button primary small">
                        <i className="fas fa-user-plus mr-2"></i>Novo
                      </button>
                    </div>
                    {participantes.length === 0 ? (
                      <p style={{ textAlign: 'center', color: '#666' }}>Nenhum participante</p>
                    ) : (
                      <table className="br-table">
                        <thead>
                          <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>CPF</th>
                            <th>Instituição</th>
                            <th>Ações</th>
                          </tr>
                        </thead>
                        <tbody>
                          {participantes.map((p) => (
                            <tr key={p._id}>
                              <td>{p.nome}</td>
                              <td>{p.email}</td>
                              <td>{p.cpf}</td>
                              <td>{p.instituicao || '-'}</td>
                              <td>
                                <button onClick={() => handleDeletarParticipante(p._id)} className="br-button danger small">
                                  <i className="fas fa-trash mr-2"></i>Remover
                                </button>
                              </td>
                            </tr>
                          ))}
                        </tbody>
                      </table>
                    )}
                  </div>
                )}

                {activeTab === 'certificados' && (
                  <div>
                    <div className="d-flex justify-content-between align-items-center mb-4">
                      <h6><i className="fas fa-certificate mr-2"></i>Certificados ({certificados.length})</h6>
                      <button onClick={handleRegenerarCertificados} className="br-button primary small" disabled={processando}>
                        <i className="fas fa-sync-alt mr-2"></i>Regenerar Todos
                      </button>
                    </div>
                    {loadingCertificados ? (
                      <div className="text-center">
                        <div className="br-loading"></div>
                      </div>
                    ) : certificados.length === 0 ? (
                      <p style={{ textAlign: 'center', color: '#666' }}>Nenhum certificado</p>
                    ) : (
                      <table className="br-table">
                        <thead>
                          <tr>
                            <th>Participante</th>
                            <th>Tipo</th>
                            <th>Data</th>
                            <th>Ações</th>
                          </tr>
                        </thead>
                        <tbody>
                          {certificados.map((c) => (
                            <tr key={c._id}>
                              <td>{c.nomeParticipante || c.participante}</td>
                              <td><span className="br-tag">{c.tipo || 'PARTICIPANTE'}</span></td>
                              <td>{formatDate(c.dataGeracao)}</td>
                              <td>
                                {c.urlPDF && (
                                  <a href={c.urlPDF} target="_blank" rel="noopener noreferrer" className="br-button secondary small">
                                    <i className="fas fa-download mr-2"></i>Download
                                  </a>
                                )}
                              </td>
                            </tr>
                          ))}
                        </tbody>
                      </table>
                    )}
                  </div>
                )}
              </div>
            </div>
          </>
        ) : null}
      </div>

      {showNovoSubeventoModal && (
        <>
          <div
            className="br-scrim-util foco"
            onClick={() => setShowNovoSubeventoModal(false)}
            style={{
              backgroundColor: 'rgba(0, 0, 0, 0.7)',
              position: 'fixed',
              top: 0,
              left: 0,
              right: 0,
              bottom: 0,
              zIndex: 9998,
              display: 'block',
            }}
          ></div>

          <div
            className="br-modal large"
            style={{
              display: 'block',
              position: 'fixed',
              top: '50%',
              left: '50%',
              transform: 'translate(-50%, -50%)',
              zIndex: 9999,
              maxWidth: '900px',
              width: '90%',
              overflow: 'visible',
            }}
          >
            <div className="br-modal-header" style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
              <div className="br-modal-title"><i className="fas fa-calendar-plus mr-2"></i>Novo Subeventos</div>
              <button
                className="br-button circle small"
                onClick={() => setShowNovoSubeventoModal(false)}
                type="button"
                aria-label="Fechar"
              >
                <i className="fas fa-times"></i>
              </button>
            </div>

            <form onSubmit={handleAdicionarSubevento}>
              <div
                className="br-modal-body"
                style={{
                  maxHeight: '75vh',
                  overflowY: 'auto',
                  overflowX: 'visible',
                }}
              >
                <div className="row">
                  <div className="col-md-8 mb-3">
                    <div className="br-input">
                      <label htmlFor="titulo">Título *</label>
                      <input
                        id="titulo"
                        type="text"
                        value={novoSubeventoForm.titulo}
                        onChange={(e) => setNovoSubeventoForm({ ...novoSubeventoForm, titulo: e.target.value })}
                        placeholder="Digite o título do subevento"
                        required
                      />
                    </div>
                  </div>

                  <div className="col-md-4 mb-3">
                    <BrSelect
                      label="Tipo"
                      placeholder="Selecione..."
                      options={tiposSubevento.map(t => ({ label: t, value: t }))}
                      onChange={(value) => setNovoSubeventoForm({ ...novoSubeventoForm, tipo: value || '' })}
                      value={novoSubeventoForm.tipo}
                      emptyOptionsMessage="Nenhum tipo encontrado"
                    />
                  </div>
                </div>

                <div className="row">
                  <div className="col-md-6 mb-3">
                    <BrDateTimePicker
                      label="Data *"
                      dataMode="single"
                      dataType="date"
                      onChange={(date) => {
                        if (date) setNovoSubeventoForm({ ...novoSubeventoForm, data: date });
                      }}
                    />
                  </div>
                  <div className="col-md-6 mb-3">
                    <BrDateTimePicker
                      label="Horário Início *"
                      dataMode="single"
                      dataType="time"
                      onChange={(time) => {
                        if (time) setNovoSubeventoForm({ ...novoSubeventoForm, horarioInicio: time });
                      }}
                    />
                  </div>
                </div>
                
                <div className="row">
                  <div className="col-md-12 mb-3">
                    <div className="br-input">
                      <label htmlFor="duracao">Duração (ex: 02:00) *</label>
                      <input
                        id="duracao"
                        type="text"
                        value={novoSubeventoForm.duracao}
                        onChange={(e) => setNovoSubeventoForm({ ...novoSubeventoForm, duracao: e.target.value })}
                        placeholder="HH:MM"
                        required
                      />
                    </div>
                  </div>
                </div>

                <div className="row">
                  <div className="col-md-4 mb-3">
                    <BrSelect
                      label="Simpósio *"
                      placeholder="Selecione..."
                      options={simposios.map(s => ({ label: String(s.ano), value: s._id }))}
                      onChange={(value) => setNovoSubeventoForm({ ...novoSubeventoForm, simposio: value || '' })}
                      value={novoSubeventoForm.simposio}
                      emptyOptionsMessage="Nenhum simpósio encontrado"
                    />
                  </div>

                  <div className="col-md-4 mb-3">
                    <div className="br-input">
                      <label htmlFor="local">Local</label>
                      <input
                        id="local"
                        type="text"
                        value={novoSubeventoForm.local}
                        onChange={(e) => setNovoSubeventoForm({ ...novoSubeventoForm, local: e.target.value })}
                        placeholder="Sala, auditório..."
                      />
                    </div>
                  </div>
                  <div className="col-md-4 mb-3">
                    <div className="br-input">
                      <label htmlFor="vagas">Vagas</label>
                      <input
                        id="vagas"
                        type="number"
                        value={novoSubeventoForm.vagas}
                        onChange={(e) => setNovoSubeventoForm({ ...novoSubeventoForm, vagas: e.target.value })}
                        placeholder="Número de vagas"
                        min="0"
                      />
                    </div>
                  </div>
                </div>

                <div className="row">
                  <div className="col-md-6 mb-3">
                    <div className="br-input">
                      <label htmlFor="palestrante">Palestrante</label>
                      <input
                        id="palestrante"
                        type="text"
                        value={novoSubeventoForm.palestrante}
                        onChange={(e) => setNovoSubeventoForm({ ...novoSubeventoForm, palestrante: e.target.value })}
                        placeholder="Nome do palestrante"
                      />
                    </div>
                  </div>
                  <div className="col-md-6 mb-3">
                    <div className="br-input">
                      <label htmlFor="evento">Evento/Categoria</label>
                      <input
                        id="evento"
                        type="text"
                        value={novoSubeventoForm.evento}
                        onChange={(e) => setNovoSubeventoForm({ ...novoSubeventoForm, evento: e.target.value })}
                        placeholder="Ex: Conferência de Abertura"
                      />
                    </div>
                  </div>
                </div>

                <div className="mb-3">
                  <div className="br-textarea">
                    <label htmlFor="descricao">Descrição</label>
                    <textarea
                      id="descricao"
                      value={novoSubeventoForm.descricao}
                      onChange={(e) => setNovoSubeventoForm({ ...novoSubeventoForm, descricao: e.target.value })}
                      placeholder="Digite uma descrição detalhada do subevento"
                      rows="4"
                    />
                  </div>
                </div>

                {mesarios.length > 0 && (
                  <div className="mb-3">
                    <label className="d-block mb-2">
                      <strong>Responsáveis pelo Subevento (opcional)</strong>
                    </label>
                    <p className="text-down-01 mb-2" style={{ color: '#666' }}>
                      Selecione os participantes que serão responsáveis por gerenciar este subevento
                    </p>
                    <div
                      style={{
                        maxHeight: '200px',
                        overflowY: 'auto',
                        border: '1px solid #ddd',
                        borderRadius: '4px',
                        padding: '8px',
                      }}
                    >
                      {mesarios.map((mesario) => (
                        <div key={mesario._id} className="col-md-12 mb-1">
                          <div className="br-checkbox">
                            <input
                              id={`mesario-${mesario._id}`}
                              type="checkbox"
                              checked={novoSubeventoForm.responsaveisMesarios.includes(mesario._id)}
                              onChange={() => handleMesarioToggle(mesario._id)}
                            />
                            <label htmlFor={`mesario-${mesario._id}`}>
                              {mesario.nome}{' '}
                              <span className="text-down-01" style={{ opacity: 0.7 }}>
                                ({mesario.user?.email})
                              </span>
                            </label>
                          </div>
                        </div>
                      ))}
                    </div>
                    {novoSubeventoForm.responsaveisMesarios.length > 0 && (
                      <div className="mt-2">
                        <span className="br-tag info small">
                          {novoSubeventoForm.responsaveisMesarios.length} responsável
                          {novoSubeventoForm.responsaveisMesarios.length !== 1 ? 'eis' : ''} selecionado
                          {novoSubeventoForm.responsaveisMesarios.length !== 1 ? 's' : ''}
                        </span>
                      </div>
                    )}
                  </div>
                )}
              </div>

              <div className="br-modal-footer">
                <button type="button" className="br-button secondary" onClick={() => setShowNovoSubeventoModal(false)}>
                  Cancelar
                </button>
                <button type="submit" className="br-button primary" disabled={processando}>
                  {processando ? 'Adicionando...' : (<><i className="fas fa-plus-circle mr-2"></i>Adicionar</>)}
                </button>
              </div>
            </form>
          </div>
        </>
      )}

      {showNovoParticipanteModal && (
        <>
          <div className="br-modal active" style={{ display: 'flex', alignItems: 'center', justifyContent: 'center' }}>
            <div className="br-modal-dialog" style={{ maxWidth: '600px' }}>
              <div className="br-modal-content">
                <div className="br-modal-header" style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                  <div className="br-modal-title"><i className="fas fa-user-plus mr-2"></i>Novo Participante</div>
                  <button className="br-button circle small" onClick={() => setShowNovoParticipanteModal(false)}>
                    <i className="fas fa-times"></i>
                  </button>
                </div>
                <form onSubmit={handleAdicionarParticipante}>
                  <div className="br-modal-body">
                    <div className="br-input mb-3">
                      <label>Nome *</label>
                      <input type="text" value={novoParticipanteForm.nome} onChange={(e) => setNovoParticipanteForm({...novoParticipanteForm, nome: e.target.value})} required />
                    </div>
                    <div className="br-input mb-3">
                      <label>Email *</label>
                      <input type="email" value={novoParticipanteForm.email} onChange={(e) => setNovoParticipanteForm({...novoParticipanteForm, email: e.target.value})} required />
                    </div>
                    <div className="br-input mb-3">
                      <label>CPF *</label>
                      <input type="text" value={novoParticipanteForm.cpf} onChange={(e) => setNovoParticipanteForm({...novoParticipanteForm, cpf: e.target.value})} required />
                    </div>
                    <div className="br-input mb-3">
                      <label>Instituição</label>
                      <input type="text" value={novoParticipanteForm.instituicao} onChange={(e) => setNovoParticipanteForm({...novoParticipanteForm, instituicao: e.target.value})} />
                    </div>
                  </div>
                  <div className="br-modal-footer">
                    <button type="button" className="br-button secondary" onClick={() => setShowNovoParticipanteModal(false)}>Cancelar</button>
                    <button type="submit" className="br-button primary" disabled={processando}>
                      {processando ? 'Adicionando...' : (<><i className="fas fa-user-plus mr-2"></i>Adicionar</>)}
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div className="br-scrim active" onClick={() => setShowNovoParticipanteModal(false)} style={{ display: 'block' }}></div>
        </>
      )}
    </MainLayout>
  );
};

export default AdminEditarSimposio;
