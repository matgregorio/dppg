import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import SelectGovBR from '../components/SelectGovBR';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

const AdminSubeventos = () => {
  const [abaAtiva, setAbaAtiva] = useState('subeventos'); // 'subeventos' ou 'apresentacoes'
  const [subeventos, setSubeventos] = useState([]);
  const [trabalhos, setTrabalhos] = useState([]);
  const [simposios, setSimposios] = useState([]);
  const [mesarios, setMesarios] = useState([]);
  const [loading, setLoading] = useState(true);
  const [showModal, setShowModal] = useState(false);
  const [trabalhoEditando, setTrabalhoEditando] = useState(null);
  const [showApresentacaoModal, setShowApresentacaoModal] = useState(false);
  const [apresentacaoData, setApresentacaoData] = useState({
    data: '',
    horarioInicio: '',
    duracao: '',
    local: ''
  });
  const [tipoFiltro, setTipoFiltro] = useState('TODOS');
  const [subeventoExpandido, setSubeventoExpandido] = useState(null);
  const [inscritos, setInscritos] = useState([]);
  const [participantes, setParticipantes] = useState([]);
  const [loadingInscritos, setLoadingInscritos] = useState(false);
  const [showAddInscritoModal, setShowAddInscritoModal] = useState(false);
  const [showMesariosModal, setShowMesariosModal] = useState(false);
  const [subeventoMesarios, setSubeventoMesarios] = useState(null);
  const [mesariosSelecionados, setMesariosSelecionados] = useState([]);
  const [buscaMesario, setBuscaMesario] = useState('');
  const [participanteSelecionado, setParticipanteSelecionado] = useState('');
  const [filtroParticipante, setFiltroParticipante] = useState('');
  const [editando, setEditando] = useState(null);
  const [pagination, setPagination] = useState({
    page: 1,
    limit: 20,
    total: 0,
    totalPages: 0,
  });
  const [busca, setBusca] = useState('');
  const [simposioFiltro, setSimposioFiltro] = useState('');
  const [formData, setFormData] = useState({
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

  const { showSuccess, showError } = useNotification();

  useEffect(() => {
    if (abaAtiva === 'subeventos') {
      fetchSubeventos();
    } else {
      fetchTrabalhosAprovados();
    }
    fetchSimposios();
    fetchMesarios();
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [pagination.page, busca, simposioFiltro, abaAtiva, tipoFiltro]);

  const fetchTrabalhosAprovados = async () => {
    if (!simposioFiltro) return;
    
    try {
      setLoading(true);
      const { data } = await api.get('/admin/trabalhos-aprovados', {
        params: {
          simposioId: simposioFiltro,
          page: pagination.page,
          limit: pagination.limit,
          tipo: tipoFiltro,
        },
      });
      if (data.success) {
        setTrabalhos(data.data);
        setPagination((prev) => ({
          ...prev,
          total: data.pagination.total,
          totalPages: data.pagination.totalPages,
        }));
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao carregar trabalhos aprovados');
    } finally {
      setLoading(false);
    }
  };

  const fetchSubeventos = async () => {
    try {
      setLoading(true);
      const { data } = await api.get('/admin/subeventos', {
        params: {
          page: pagination.page,
          limit: pagination.limit,
          busca,
          simposio: simposioFiltro,
        },
      });
      if (data.success) {
        setSubeventos(data.data);
        setPagination((prev) => ({
          ...prev,
          total: data.pagination.total,
          totalPages: data.pagination.totalPages,
        }));
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao carregar subeventos');
    } finally {
      setLoading(false);
    }
  };

  const fetchSimposios = async () => {
    try {
      const { data } = await api.get('/public/simposios');
      if (data.success) {
        setSimposios(data.data);
      }
    } catch (err) {
      console.error('Erro ao carregar simpósios:', err);
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

  const handleGerenciarInscritos = async (subevento) => {
    if (subeventoExpandido === subevento._id) {
      setSubeventoExpandido(null);
      setInscritos([]);
      return;
    }

    setSubeventoExpandido(subevento._id);
    await fetchInscritos(subevento._id);
  };

  const fetchInscritos = async (subeventoId) => {
    try {
      setLoadingInscritos(true);
      const { data } = await api.get(`/admin/subeventos/${subeventoId}/inscritos`);
      if (data.success) {
        setInscritos(data.data);
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao carregar inscritos');
    } finally {
      setLoadingInscritos(false);
    }
  };

  const fetchParticipantes = async () => {
    try {
      const { data } = await api.get('/admin/participantes', {
        params: { limit: 1000 },
      });
      if (data.success) {
        setParticipantes(data.data);
      }
    } catch (err) {
      showError('Erro ao carregar participantes');
    }
  };

  const handleAdicionarInscrito = async () => {
    if (!participanteSelecionado) {
      showError('Selecione um participante');
      return;
    }

    try {
      const { data } = await api.post(`/admin/subeventos/${subeventoExpandido}/inscritos`, {
        participantId: participanteSelecionado,
      });
      if (data.success) {
        showSuccess('Participante inscrito com sucesso!');
        setShowAddInscritoModal(false);
        setParticipanteSelecionado('');
        await fetchInscritos(subeventoExpandido);
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao inscrever participante');
    }
  };

  const handleConfirmarPresenca = async (inscritoId) => {
    if (!window.confirm('Deseja realmente confirmar a presença deste participante?')) return;

    try {
      const { data } = await api.post(
        `/admin/subeventos/${subeventoExpandido}/inscritos/${inscritoId}/presenca`
      );
      if (data.success) {
        showSuccess('Presença confirmada com sucesso!');
        await fetchInscritos(subeventoExpandido);
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao confirmar presença');
    }
  };

  const handleRemoverInscrito = async (inscritoId) => {
    if (!window.confirm('Deseja realmente remover este inscrito?')) return;

    try {
      const { data } = await api.delete(`/admin/subeventos/${subeventoExpandido}/inscritos/${inscritoId}`);
      if (data.success) {
        showSuccess('Inscrito removido com sucesso!');
        await fetchInscritos(subeventoExpandido);
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao remover inscrito');
    }
  };

  const handleNovo = () => {
    setFormData({
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
    setEditando(null);
    setShowModal(true);
  };

  const handleEditar = (subevento) => {
    setFormData({
      titulo: subevento.titulo,
      tipo: subevento.tipo || '',
      data: subevento.data ? new Date(subevento.data).toISOString().split('T')[0] : '',
      horarioInicio: subevento.horarioInicio,
      duracao: subevento.duracao,
      palestrante: subevento.palestrante || '',
      local: subevento.local || '',
      descricao: subevento.descricao || '',
      vagas: subevento.vagas || '',
      evento: subevento.evento || '',
      simposio: subevento.simposio._id || subevento.simposio,
      responsaveisMesarios: subevento.responsaveisMesarios?.map((m) => m._id) || [],
    });
    setEditando(subevento);
    setShowModal(true);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    if (!formData.titulo || !formData.data || !formData.horarioInicio || !formData.duracao || !formData.simposio) {
      showError('Preencha todos os campos obrigatórios');
      return;
    }

    try {
      if (editando) {
        await api.put(`/admin/subeventos/${editando._id}`, formData);
        showSuccess('Subevento atualizado com sucesso!');
      } else {
        await api.post('/admin/subeventos', formData);
        showSuccess('Subevento criado com sucesso!');
      }

      fetchSubeventos();
      setShowModal(false);
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao salvar subevento');
    }
  };

  const handleRemover = async (id) => {
    if (!window.confirm('Deseja realmente remover este subevento?')) return;

    try {
      await api.delete(`/admin/subeventos/${id}`);
      showSuccess('Subevento removido com sucesso!');
      fetchSubeventos();
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao remover subevento');
    }
  };

  const handleBusca = (e) => {
    e.preventDefault();
    setPagination((prev) => ({ ...prev, page: 1 }));
  };

  const handleEditarApresentacao = (trabalho) => {
    setTrabalhoEditando(trabalho);
    setApresentacaoData({
      data: trabalho.apresentacao?.data ? new Date(trabalho.apresentacao.data).toISOString().split('T')[0] : '',
      horarioInicio: trabalho.apresentacao?.horarioInicio || '',
      duracao: trabalho.apresentacao?.duracao || '',
      local: trabalho.apresentacao?.local || ''
    });
    setShowApresentacaoModal(true);
  };

  const handleSalvarApresentacao = async (e) => {
    e.preventDefault();

    if (!apresentacaoData.data || !apresentacaoData.horarioInicio || !apresentacaoData.duracao || !apresentacaoData.local) {
      showError('Preencha todos os campos obrigatórios');
      return;
    }

    try {
      await api.put(`/admin/trabalhos-aprovados/${trabalhoEditando._id}/apresentacao`, apresentacaoData);
      showSuccess('Informações de apresentação atualizadas com sucesso!');
      setShowApresentacaoModal(false);
      fetchTrabalhosAprovados();
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao atualizar apresentação');
    }
  };

  const handleMesarioToggle = (mesarioId) => {
    setFormData((prev) => ({
      ...prev,
      responsaveisMesarios: prev.responsaveisMesarios.includes(mesarioId)
        ? prev.responsaveisMesarios.filter((id) => id !== mesarioId)
        : [...prev.responsaveisMesarios, mesarioId],
    }));
  };

  const handleGerenciarMesarios = (subevento) => {
    setSubeventoMesarios(subevento);
    setMesariosSelecionados(subevento.responsaveisMesarios?.map((m) => m._id) || []);
    setBuscaMesario('');
    setShowMesariosModal(true);
  };

  const handleToggleMesarioModal = (mesarioId) => {
    setMesariosSelecionados((prev) =>
      prev.includes(mesarioId) ? prev.filter((id) => id !== mesarioId) : [...prev, mesarioId]
    );
  };

  const handleSalvarMesarios = async () => {
    try {
      await api.put(`/admin/subeventos/${subeventoMesarios._id}`, {
        ...subeventoMesarios,
        responsaveisMesarios: mesariosSelecionados,
        simposio: subeventoMesarios.simposio._id || subeventoMesarios.simposio,
      });
      showSuccess('Mesários atualizados com sucesso!');
      setShowMesariosModal(false);
      fetchSubeventos();
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao atualizar mesários');
    }
  };

  const formatData = (data) => new Date(data).toLocaleDateString('pt-BR');

  const tiposSubevento = ['Palestra', 'Minicurso', 'Workshop', 'Mesa Redonda', 'Apresentação', 'Outro'];

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
            <Link to="/area-administrativa">Área Administrativa</Link>
          </li>
          <li className="crumb">
            <i className="icon fas fa-chevron-right"></i>
            <span>Gerenciar Subeventos</span>
          </li>
        </ul>
      </div>

      <div className="my-4">
        <div className="d-flex justify-content-between align-items-center mb-4">
          <h1 className="text-up-03 text-weight-bold">
            <i className="fas fa-calendar-alt mr-2"></i>
            Gerenciar Subeventos e Apresentações
          </h1>
          {abaAtiva === 'subeventos' && (
            <button onClick={handleNovo} className="br-button primary" type="button">
              <i className="fas fa-plus mr-2"></i>
              Novo Subevento
            </button>
          )}
        </div>

        {/* Abas */}
        <div className="br-tab" style={{ marginBottom: '2rem' }}>
          <nav className="tab-nav">
            <ul>
              <li className="tab-item">
                <button
                  type="button"
                  className={`tab-button ${abaAtiva === 'subeventos' ? 'active' : ''}`}
                  onClick={() => {
                    setAbaAtiva('subeventos');
                    setPagination(prev => ({ ...prev, page: 1 }));
                  }}
                >
                  <i className="fas fa-calendar-alt mr-2"></i>
                  Subeventos
                </button>
              </li>
              <li className="tab-item">
                <button
                  type="button"
                  className={`tab-button ${abaAtiva === 'apresentacoes' ? 'active' : ''}`}
                  onClick={() => {
                    setAbaAtiva('apresentacoes');
                    setPagination(prev => ({ ...prev, page: 1 }));
                  }}
                >
                  <i className="fas fa-presentation mr-2"></i>
                  Apresentações de Trabalhos
                </button>
              </li>
            </ul>
          </nav>
        </div>

        {/* Conteúdo das Abas */}
        {abaAtiva === 'subeventos' ? (
          <>
            {/* Filtros */}
            <form onSubmit={handleBusca} className="mb-4">
              <div className="row">
                <div className="col-md-6">
                  <div className="br-input">
                    <label htmlFor="busca">Buscar por título, palestrante ou tipo</label>
                    <input
                      id="busca"
                      type="text"
                      value={busca}
                      onChange={(e) => setBusca(e.target.value)}
                      placeholder="Digite para buscar..."
                    />
                  </div>
                </div>

                <div className="col-md-4">
                  <div className="br-input">
                    <label htmlFor="simposioFiltro">Filtrar por Simpósio</label>
                    <select
                      id="simposioFiltro"
                      value={simposioFiltro}
                      onChange={(e) => setSimposioFiltro(e.target.value)}
                      style={{
                        width: '100%',
                        padding: '0.5rem 0.75rem',
                        border: '1px solid #888',
                        borderRadius: '8px',
                        fontSize: '1rem',
                        fontFamily: 'Rawline, sans-serif',
                        backgroundColor: 'white',
                        cursor: 'pointer',
                        outline: 'none'
                      }}
                    >
                      <option value="">Todos</option>
                      {simposios.map((s) => (
                        <option key={s._id} value={s._id}>{String(s.ano)}</option>
                      ))}
                    </select>
                  </div>
                </div>

                <div className="col-md-2">
                  <button type="submit" className="br-button primary mt-4">
                    <i className="fas fa-search mr-2"></i>
                    Buscar
                  </button>
                </div>
              </div>
            </form>

            {/* Info */}
            <div className="mb-3">
              <span className="br-tag info">
                {pagination.total} subevento{pagination.total !== 1 ? 's' : ''} encontrado{pagination.total !== 1 ? 's' : ''}
              </span>
            </div>

            {loading ? (
              <div className="text-center my-5">
                <div className="spinner-border text-primary" role="status">
                  <span className="sr-only">Carregando...</span>
                </div>
              </div>
            ) : subeventos.length === 0 ? (
              <div className="br-message warning">
                <div className="icon">
                  <i className="fas fa-exclamation-triangle" aria-hidden="true"></i>
                </div>
                <div className="content">Nenhum subevento encontrado.</div>
              </div>
            ) : (
              <>
                <div className="table-responsive">
              <table className="br-table">
                <thead>
                  <tr>
                    <th scope="col">Título</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Data</th>
                    <th scope="col">Horário</th>
                    <th scope="col">Duração</th>
                    <th scope="col">Local</th>
                    <th scope="col">Palestrante</th>
                    <th scope="col">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  {subeventos.map((subevento) => (
                    <React.Fragment key={subevento._id}>
                      <tr>
                        <td>{subevento.titulo}</td>
                        <td>{subevento.tipo && <span className="br-tag small">{subevento.tipo}</span>}</td>
                        <td>{formatData(subevento.data)}</td>
                        <td>{subevento.horarioInicio}</td>
                        <td>{subevento.duracao}</td>
                        <td>{subevento.local || '-'}</td>
                        <td>{subevento.palestrante || '-'}</td>
                        <td>
                          <div className="d-flex gap-2">
                            <button
                              onClick={() => handleGerenciarInscritos(subevento)}
                              className={`br-button ${subeventoExpandido === subevento._id ? 'primary' : 'secondary'} small`}
                              title={subeventoExpandido === subevento._id ? 'Recolher Inscritos' : 'Gerenciar Inscritos'}
                              type="button"
                            >
                              <i className={`fas fa-${subeventoExpandido === subevento._id ? 'chevron-up' : 'users'}`}></i>
                            </button>
                            <button
                              onClick={() => handleGerenciarMesarios(subevento)}
                              className="br-button secondary small"
                              title="Gerenciar Responsáveis"
                              type="button"
                            >
                              <i className="fas fa-users-cog"></i>
                            </button>
                            <button
                              onClick={() => handleEditar(subevento)}
                              className="br-button secondary small"
                              title="Editar"
                              type="button"
                            >
                              <i className="fas fa-edit"></i>
                            </button>
                            <button
                              onClick={() => handleRemover(subevento._id)}
                              className="br-button danger small"
                              title="Remover"
                              type="button"
                            >
                              <i className="fas fa-trash"></i>
                            </button>
                          </div>
                        </td>
                      </tr>

                      {/* Linha expandida com inscritos */}
                      {subeventoExpandido === subevento._id && (
                        <tr>
                          <td colSpan="8" style={{ padding: 0, backgroundColor: '#f8f9fa' }}>
                            <div style={{ padding: '1.5rem' }}>
                              <div className="d-flex justify-content-between align-items-center mb-3">
                                <h5 className="mb-0">
                                  <i className="fas fa-users mr-2"></i>
                                  Inscritos em {subevento.titulo}
                                </h5>
                                <button
                                  onClick={() => {
                                    setShowAddInscritoModal(true);
                                    fetchParticipantes();
                                  }}
                                  className="br-button primary small"
                                  type="button"
                                >
                                  <i className="fas fa-user-plus mr-2"></i>
                                  Adicionar Participante
                                </button>
                              </div>

                              <div className="mb-3">
                                <p className="mb-1">
                                  <strong>Vagas:</strong> {subevento.vagas || 'Ilimitado'} |{' '}
                                  <strong className="ml-2">Inscritos:</strong> {inscritos.length}
                                </p>
                              </div>

                              {loadingInscritos ? (
                                <div className="text-center py-4">
                                  <div className="spinner-border text-primary" role="status">
                                    <span className="sr-only">Carregando...</span>
                                  </div>
                                </div>
                              ) : inscritos.length === 0 ? (
                                <div className="br-message info">
                                  <div className="icon">
                                    <i className="fas fa-info-circle"></i>
                                  </div>
                                  <div className="content">Nenhum inscrito encontrado neste subevento.</div>
                                </div>
                              ) : (
                                <div className="table-responsive">
                                  <table className="br-table">
                                    <thead>
                                      <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>CPF</th>
                                        <th>Status</th>
                                        <th>Data Inscrição</th>
                                        <th>Presença</th>
                                        <th>Ações</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      {inscritos.map((inscrito) => (
                                        <tr key={inscrito._id}>
                                          <td>{inscrito.participant?.nome || '-'}</td>
                                          <td>{inscrito.participant?.user?.email || '-'}</td>
                                          <td>{inscrito.participant?.cpf || '-'}</td>
                                          <td>
                                            <span
                                              className={`br-tag ${
                                                inscrito.status === 'CONFIRMADO'
                                                  ? 'success'
                                                  : inscrito.status === 'CANCELADO'
                                                  ? 'danger'
                                                  : 'warning'
                                              }`}
                                            >
                                              {inscrito.status}
                                            </span>
                                          </td>
                                          <td>{new Date(inscrito.dataInscricao).toLocaleDateString('pt-BR')}</td>
                                          <td>
                                            {inscrito.presenca ? (
                                              <span className="br-tag success">
                                                <i className="fas fa-check mr-1"></i>
                                                Confirmada
                                              </span>
                                            ) : (
                                              <span className="br-tag warning">
                                                <i className="fas fa-clock mr-1"></i>
                                                Pendente
                                              </span>
                                            )}
                                          </td>
                                          <td>
                                            <div className="d-flex gap-2">
                                              {!inscrito.presenca && (
                                                <button
                                                  onClick={() => handleConfirmarPresenca(inscrito._id)}
                                                  className="br-button primary small"
                                                  title="Confirmar Presença"
                                                  type="button"
                                                >
                                                  <i className="fas fa-check"></i>
                                                </button>
                                              )}
                                              <button
                                                onClick={() => handleRemoverInscrito(inscrito._id)}
                                                className="br-button danger small"
                                                title="Remover Inscrito"
                                                type="button"
                                              >
                                                <i className="fas fa-times"></i>
                                              </button>
                                            </div>
                                          </td>
                                        </tr>
                                      ))}
                                    </tbody>
                                  </table>
                                </div>
                              )}
                            </div>
                          </td>
                        </tr>
                      )}
                    </React.Fragment>
                  ))}
                </tbody>
              </table>
            </div>

            {/* Paginação */}
            {pagination.totalPages > 1 && (
              <div className="row mt-4">
                <div className="col-md-12">
                  <nav aria-label="Paginação">
                    <ul className="br-pagination" role="list">
                      <li>
                        <button
                          className="br-button"
                          disabled={pagination.page === 1}
                          onClick={() => setPagination((prev) => ({ ...prev, page: prev.page - 1 }))}
                          type="button"
                        >
                          Anterior
                        </button>
                      </li>
                      <li>
                        <span className="mx-3">
                          Página {pagination.page} de {pagination.totalPages}
                        </span>
                      </li>
                      <li>
                        <button
                          className="br-button"
                          disabled={pagination.page === pagination.totalPages}
                          onClick={() => setPagination((prev) => ({ ...prev, page: prev.page + 1 }))}
                          type="button"
                        >
                          Próxima
                        </button>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
            )}
              </>
            )}
          </>
        ) : (
          <>
            {/* Aba de Apresentações de Trabalhos */}
            <div className="row mb-4">
              <div className="col-md-4">
                <label htmlFor="simposioFiltroApresentacao" style={{ display: 'block', marginBottom: '0.5rem', fontWeight: '500' }}>
                  Simpósio *
                </label>
                <select
                  id="simposioFiltroApresentacao"
                  value={simposioFiltro}
                  onChange={(e) => {
                    setSimposioFiltro(e.target.value);
                    setPagination((prev) => ({ ...prev, page: 1 }));
                  }}
                  style={{
                    width: '100%',
                    padding: '0.5rem 0.75rem',
                    border: '1px solid #888',
                    borderRadius: '8px',
                    fontSize: '1rem',
                    backgroundColor: '#fff'
                  }}
                >
                  <option value="">Selecione o simpósio...</option>
                  {simposios.map((s) => (
                    <option key={s._id} value={s._id}>{String(s.ano)}</option>
                  ))}
                </select>
              </div>
              <div className="col-md-4">
                <label htmlFor="tipoFiltro" style={{ display: 'block', marginBottom: '0.5rem', fontWeight: '500' }}>
                  Tipo de Apresentação
                </label>
                <select
                  id="tipoFiltro"
                  value={tipoFiltro}
                  onChange={(e) => {
                    setTipoFiltro(e.target.value);
                    setPagination((prev) => ({ ...prev, page: 1 }));
                  }}
                  style={{
                    width: '100%',
                    padding: '0.5rem 0.75rem',
                    border: '1px solid #888',
                    borderRadius: '8px',
                    fontSize: '1rem',
                    backgroundColor: '#fff'
                  }}
                >
                  <option value="TODOS">Todos</option>
                  <option value="ORAL">Oral</option>
                  <option value="POSTER">Pôster</option>
                </select>
              </div>
            </div>

            {!simposioFiltro ? (
              <div className="br-message warning">
                <div className="icon">
                  <i className="fas fa-exclamation-triangle" aria-hidden="true"></i>
                </div>
                <div className="content">
                  Selecione um simpósio para visualizar os trabalhos aprovados.
                </div>
              </div>
            ) : loading ? (
              <div className="text-center py-5">
                <div className="spinner-border text-primary" role="status">
                  <span className="sr-only">Carregando...</span>
                </div>
              </div>
            ) : trabalhos.length === 0 ? (
              <div className="br-message info">
                <div className="icon">
                  <i className="fas fa-info-circle" aria-hidden="true"></i>
                </div>
                <div className="content">
                  Nenhum trabalho aprovado encontrado para este simpósio.
                </div>
              </div>
            ) : (
              <>
                <div className="table-responsive">
                  <table className="br-table">
                    <thead>
                      <tr>
                        <th scope="col" style={{ width: '30%' }}>Trabalho</th>
                        <th scope="col" style={{ width: '10%' }}>Tipo</th>
                        <th scope="col" style={{ width: '12%' }}>Data</th>
                        <th scope="col" style={{ width: '10%' }}>Horário</th>
                        <th scope="col" style={{ width: '8%' }}>Duração</th>
                        <th scope="col" style={{ width: '18%' }}>Local</th>
                        <th scope="col" style={{ width: '12%' }}>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      {trabalhos.map(trabalho => (
                        <tr key={trabalho._id}>
                          <td>
                            <strong>{trabalho.titulo}</strong>
                            <br />
                            <small className="text-muted">
                              {trabalho.autores?.map(a => a.nome).join(', ') || 'N/A'}
                            </small>
                          </td>
                          <td>
                            <span className={`br-tag ${trabalho.tipoApresentacao === 'ORAL' ? 'success' : 'info'}`}>
                              {trabalho.tipoApresentacao === 'ORAL' ? 'Oral' : 'Pôster'}
                            </span>
                          </td>
                          <td>
                            {trabalho.apresentacao?.data 
                              ? new Date(trabalho.apresentacao.data).toLocaleDateString('pt-BR')
                              : <span className="text-muted">-</span>
                            }
                          </td>
                          <td>
                            {trabalho.apresentacao?.horarioInicio || <span className="text-muted">-</span>}
                          </td>
                          <td>
                            {trabalho.apresentacao?.duracao 
                              ? `${trabalho.apresentacao.duracao} min`
                              : <span className="text-muted">-</span>
                            }
                          </td>
                          <td>
                            {trabalho.apresentacao?.local || <span className="text-muted">-</span>}
                          </td>
                          <td>
                            <button
                              className="br-button primary small"
                              onClick={() => handleEditarApresentacao(trabalho)}
                              type="button"
                              title="Configurar apresentação"
                            >
                              <i className="fas fa-edit mr-1"></i>
                              Configurar
                            </button>
                          </td>
                        </tr>
                      ))}
                    </tbody>
                  </table>
                </div>

                {/* Paginação */}
                {pagination.totalPages > 1 && (
                  <div className="row mt-4">
                    <div className="col-md-12">
                      <nav aria-label="Paginação">
                        <ul className="br-pagination" role="list">
                          <li>
                            <button
                              className="br-button"
                              disabled={pagination.page === 1}
                              onClick={() => setPagination((prev) => ({ ...prev, page: prev.page - 1 }))}
                              type="button"
                            >
                              Anterior
                            </button>
                          </li>
                          <li>
                            <span className="mx-3">
                              Página {pagination.page} de {pagination.totalPages}
                            </span>
                          </li>
                          <li>
                            <button
                              className="br-button"
                              disabled={pagination.page === pagination.totalPages}
                              onClick={() => setPagination((prev) => ({ ...prev, page: prev.page + 1 }))}
                              type="button"
                            >
                              Próxima
                            </button>
                          </li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                )}
              </>
            )}
          </>
        )}
      </div>

      {/* Modal */}
      {showModal && (
        <>
          <div
            className="br-scrim-util foco"
            onClick={() => setShowModal(false)}
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

          {/* ⚠️ Importante: overflow do container do modal como visible para não cortar a lista do select */}
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
              <div className="br-modal-title">{editando ? 'Editar Subevento' : 'Novo Subevento'}</div>
              <button
                className="br-button circle small"
                onClick={() => setShowModal(false)}
                type="button"
                aria-label="Fechar"
              >
                <i className="fas fa-times"></i>
              </button>
            </div>

            <form onSubmit={handleSubmit}>
              {/* Scroll apenas no body */}
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
                        value={formData.titulo}
                        onChange={(e) => setFormData({ ...formData, titulo: e.target.value })}
                        placeholder="Digite o título do subevento"
                        required
                      />
                    </div>
                  </div>

                  <div className="col-md-4 mb-3">
                    <div className="br-input">
                      <label htmlFor="tipo">Tipo</label>
                      <select
                        id="tipo"
                        value={formData.tipo}
                        onChange={(e) => setFormData({ ...formData, tipo: e.target.value })}
                        style={{
                          width: '100%',
                          padding: '0.5rem 0.75rem',
                          border: '1px solid #888',
                          borderRadius: '8px',
                          fontSize: '1rem',
                          fontFamily: 'Rawline, sans-serif',
                          backgroundColor: 'white',
                          cursor: 'pointer',
                          outline: 'none'
                        }}
                      >
                        <option value="">Selecione...</option>
                        {tiposSubevento.map((t) => (
                          <option key={t} value={t}>{t}</option>
                        ))}
                      </select>
                    </div>
                  </div>
                </div>

                <div className="row">
                  <div className="col-md-4 mb-3">
                    <div className="br-input">
                      <label htmlFor="data">Data *</label>
                      <input
                        id="data"
                        type="date"
                        value={formData.data}
                        onChange={(e) => setFormData({ ...formData, data: e.target.value })}
                        required
                      />
                    </div>
                  </div>
                  <div className="col-md-4 mb-3">
                    <div className="br-input">
                      <label htmlFor="horarioInicio">Horário Início *</label>
                      <input
                        id="horarioInicio"
                        type="time"
                        value={formData.horarioInicio}
                        onChange={(e) => setFormData({ ...formData, horarioInicio: e.target.value })}
                        required
                      />
                    </div>
                  </div>
                  <div className="col-md-4 mb-3">
                    <div className="br-input">
                      <label htmlFor="duracao">Duração (ex: 02:00) *</label>
                      <input
                        id="duracao"
                        type="text"
                        value={formData.duracao}
                        onChange={(e) => setFormData({ ...formData, duracao: e.target.value })}
                        placeholder="HH:MM"
                        required
                      />
                    </div>
                  </div>
                </div>

                <div className="row">
                  <div className="col-md-4 mb-3">
                    <div className="br-input">
                      <label htmlFor="simposio">Simpósio *</label>
                      <select
                        id="simposio"
                        value={formData.simposio}
                        onChange={(e) => setFormData({ ...formData, simposio: e.target.value })}
                        required
                        style={{
                          width: '100%',
                          padding: '0.5rem 0.75rem',
                          border: '1px solid #888',
                          borderRadius: '8px',
                          fontSize: '1rem',
                          fontFamily: 'Rawline, sans-serif',
                          backgroundColor: 'white',
                          cursor: 'pointer',
                          outline: 'none'
                        }}
                      >
                        <option value="">Selecione...</option>
                        {simposios.map((s) => (
                          <option key={s._id} value={s._id}>{String(s.ano)}</option>
                        ))}
                      </select>
                    </div>
                  </div>

                  <div className="col-md-4 mb-3">
                    <div className="br-input">
                      <label htmlFor="local">Local</label>
                      <input
                        id="local"
                        type="text"
                        value={formData.local}
                        onChange={(e) => setFormData({ ...formData, local: e.target.value })}
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
                        value={formData.vagas}
                        onChange={(e) => setFormData({ ...formData, vagas: e.target.value })}
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
                        value={formData.palestrante}
                        onChange={(e) => setFormData({ ...formData, palestrante: e.target.value })}
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
                        value={formData.evento}
                        onChange={(e) => setFormData({ ...formData, evento: e.target.value })}
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
                      value={formData.descricao}
                      onChange={(e) => setFormData({ ...formData, descricao: e.target.value })}
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
                              checked={formData.responsaveisMesarios.includes(mesario._id)}
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
                    {formData.responsaveisMesarios.length > 0 && (
                      <div className="mt-2">
                        <span className="br-tag info small">
                          {formData.responsaveisMesarios.length} responsável
                          {formData.responsaveisMesarios.length !== 1 ? 'eis' : ''} selecionado
                          {formData.responsaveisMesarios.length !== 1 ? 's' : ''}
                        </span>
                      </div>
                    )}
                  </div>
                )}
              </div>

              <div className="br-modal-footer">
                <button type="button" className="br-button secondary" onClick={() => setShowModal(false)}>
                  Cancelar
                </button>
                <button type="submit" className="br-button primary">
                  {editando ? 'Atualizar' : 'Criar'}
                </button>
              </div>
            </form>
          </div>
        </>
      )}

      {/* Modal de Adicionar Inscrito */}
      {showAddInscritoModal && (
        <>
          <div className="br-modal active" style={{ display: 'block' }}>
            <div className="br-modal-dialog">
              <div className="br-modal-content">
                <div className="br-modal-header">
                  <div className="br-modal-title">Adicionar Participante</div>
                  <button
                    className="br-button circle small"
                    onClick={() => {
                      setShowAddInscritoModal(false);
                      setParticipanteSelecionado('');
                      setFiltroParticipante('');
                    }}
                    type="button"
                  >
                    <i className="fas fa-times"></i>
                  </button>
                </div>
                <div className="br-modal-body">
                  <div className="br-input">
                    <label htmlFor="filtroParticipante">Buscar Participante</label>
                    <input
                      id="filtroParticipante"
                      type="text"
                      placeholder="Digite o nome, email ou CPF..."
                      value={filtroParticipante}
                      onChange={(e) => setFiltroParticipante(e.target.value)}
                      autoFocus
                    />
                  </div>

                  <div className="mt-3" style={{ maxHeight: '300px', overflowY: 'auto', border: '1px solid #ddd', borderRadius: '4px' }}>
                    {participantes
                      .filter((p) => !inscritos.some((i) => i.participant?._id === p._id))
                      .filter((p) => {
                        if (!filtroParticipante) return true;
                        const buscaLower = filtroParticipante.toLowerCase();
                        return (
                          p.nome.toLowerCase().includes(buscaLower) ||
                          p.user?.email.toLowerCase().includes(buscaLower) ||
                          p.cpf.includes(buscaLower)
                        );
                      })
                      .map((p) => (
                        <div
                          key={p._id}
                          onClick={() => setParticipanteSelecionado(p._id)}
                          style={{
                            padding: '12px',
                            cursor: 'pointer',
                            backgroundColor: participanteSelecionado === p._id ? '#1351b4' : 'transparent',
                            color: participanteSelecionado === p._id ? '#fff' : '#333',
                            borderBottom: '1px solid #eee',
                          }}
                          onMouseEnter={(e) => {
                            if (participanteSelecionado !== p._id) e.currentTarget.style.backgroundColor = '#f8f9fa';
                          }}
                          onMouseLeave={(e) => {
                            if (participanteSelecionado !== p._id) e.currentTarget.style.backgroundColor = 'transparent';
                          }}
                        >
                          <div style={{ fontWeight: 'bold' }}>{p.nome}</div>
                          <div style={{ fontSize: '0.875rem', opacity: 0.8 }}>
                            {p.user?.email} • CPF: {p.cpf}
                          </div>
                        </div>
                      ))}

                    {participantes
                      .filter((p) => !inscritos.some((i) => i.participant?._id === p._id))
                      .filter((p) => {
                        if (!filtroParticipante) return true;
                        const buscaLower = filtroParticipante.toLowerCase();
                        return (
                          p.nome.toLowerCase().includes(buscaLower) ||
                          p.user?.email.toLowerCase().includes(buscaLower) ||
                          p.cpf.includes(buscaLower)
                        );
                      }).length === 0 && (
                      <div style={{ padding: '12px', textAlign: 'center', color: '#666' }}>
                        {filtroParticipante ? 'Nenhum participante encontrado' : 'Nenhum participante disponível'}
                      </div>
                    )}
                  </div>
                </div>
                <div className="br-modal-footer">
                  <button
                    className="br-button secondary"
                    onClick={() => {
                      setShowAddInscritoModal(false);
                      setParticipanteSelecionado('');
                      setFiltroParticipante('');
                    }}
                    type="button"
                  >
                    Cancelar
                  </button>
                  <button className="br-button primary" onClick={handleAdicionarInscrito} disabled={!participanteSelecionado} type="button">
                    Adicionar
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div className="br-scrim active" onClick={() => setShowAddInscritoModal(false)}></div>
        </>
      )}

      {/* Modal de Gerenciar Mesários */}
      {showMesariosModal && subeventoMesarios && (
        <>
          <div className="br-modal active" style={{ display: 'block' }}>
            <div className="br-modal-dialog">
              <div className="br-modal-content">
                <div className="br-modal-header" style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                  <div className="br-modal-title">
                    <i className="fas fa-users-cog mr-2"></i>
                    Gerenciar Responsáveis pelo Subevento
                  </div>
                  <button className="br-button circle small" onClick={() => setShowMesariosModal(false)} type="button">
                    <i className="fas fa-times"></i>
                  </button>
                </div>
                <div className="br-modal-body">
                  <div className="mb-3">
                    <h6 className="text-weight-semi-bold">{subeventoMesarios.titulo}</h6>
                    <p className="text-down-01 mb-0">
                      <i className="fas fa-calendar mr-1"></i>
                      {formatData(subeventoMesarios.data)} às {subeventoMesarios.horarioInicio}
                    </p>
                  </div>

                  <div className="br-divider my-3"></div>

                  {mesarios.length === 0 ? (
                    <div className="br-message warning">
                      <div className="icon">
                        <i className="fas fa-exclamation-triangle"></i>
                      </div>
                      <div className="content">Nenhum participante cadastrado no sistema.</div>
                    </div>
                  ) : (
                    <>
                      <div className="br-message info mb-3">
                        <div className="icon">
                          <i className="fas fa-info-circle"></i>
                        </div>
                        <div className="content">
                          <p className="mb-1">
                            <strong>Responsáveis são opcionais</strong>
                          </p>
                          <p className="mb-0 text-down-01">
                            Qualquer participante pode ser selecionado como responsável. Eles terão acesso para gerenciar presenças e gerar QR Codes para este subevento.
                          </p>
                        </div>
                      </div>

                      <div className="mb-3" style={{ position: 'relative' }}>
                        <div className="br-input">
                          <label htmlFor="buscaMesario">Buscar por nome, e-mail ou CPF</label>
                          <input
                            id="buscaMesario"
                            type="text"
                            placeholder="Digite para filtrar..."
                            value={buscaMesario}
                            onChange={(e) => setBuscaMesario(e.target.value)}
                            autoFocus
                            style={{ paddingRight: buscaMesario ? '40px' : '12px' }}
                          />
                        </div>
                        {buscaMesario && (
                          <button
                            className="br-button circle small"
                            style={{ position: 'absolute', right: '4px', bottom: '4px', zIndex: 10 }}
                            onClick={() => setBuscaMesario('')}
                            type="button"
                            title="Limpar busca"
                          >
                            <i className="fas fa-times"></i>
                          </button>
                        )}
                      </div>

                      <p className="text-weight-semi-bold mb-2">
                        {buscaMesario ? 'Resultados da busca:' : 'Selecione os participantes responsáveis:'}
                      </p>

                      <div style={{ maxHeight: '350px', overflowY: 'auto', border: '1px solid #ddd', borderRadius: '4px', padding: '8px' }}>
                        {(() => {
                          const participantesFiltrados = mesarios.filter((mesario) => {
                            if (!buscaMesario) return true;
                            const buscaLower = buscaMesario.toLowerCase().trim();
                            const nome = (mesario.nome || '').toLowerCase();
                            const email = (mesario.user?.email || mesario.email || '').toLowerCase();
                            const cpf = (mesario.cpf || '').replace(/\D/g, '');
                            const buscaLimpa = buscaLower.replace(/\D/g, '');
                            return nome.includes(buscaLower) || email.includes(buscaLower) || (buscaLimpa && cpf.includes(buscaLimpa));
                          });

                          return participantesFiltrados.map((mesario) => {
                            const estaSelecionado = mesariosSelecionados.includes(mesario._id);

                            return (
                              <div
                                key={mesario._id}
                                className="br-checkbox mb-2"
                                style={{
                                  padding: '12px',
                                  backgroundColor: estaSelecionado ? '#f0f7ff' : 'transparent',
                                  borderRadius: '4px',
                                  border: estaSelecionado ? '2px solid #1351b4' : '1px solid #ddd',
                                  cursor: 'pointer',
                                  transition: 'all 0.2s',
                                }}
                                onClick={() => handleToggleMesarioModal(mesario._id)}
                              >
                                <input
                                  id={`mesario-modal-${mesario._id}`}
                                  type="checkbox"
                                  checked={estaSelecionado}
                                  onChange={() => handleToggleMesarioModal(mesario._id)}
                                  onClick={(e) => e.stopPropagation()}
                                />
                                <label htmlFor={`mesario-modal-${mesario._id}`} style={{ cursor: 'pointer', marginBottom: 0 }}>
                                  <div>
                                    <div className="text-weight-semi-bold">
                                      {mesario.nome}
                                      {estaSelecionado && (
                                        <span className="br-tag success tiny ml-2" style={{ fontSize: '0.7rem', padding: '2px 6px' }}>
                                          <i className="fas fa-user-check mr-1"></i>
                                          RESPONSÁVEL
                                        </span>
                                      )}
                                    </div>
                                    <div className="text-down-01" style={{ opacity: 0.7 }}>
                                      {mesario.user?.email} • CPF: {mesario.cpf}
                                      {mesario.tipo && (
                                        <span className="br-tag tiny ml-2" style={{ fontSize: '0.7rem', padding: '2px 6px' }}>
                                          {mesario.tipo}
                                        </span>
                                      )}
                                    </div>
                                  </div>
                                </label>
                              </div>
                            );
                          });
                        })()}

                        {buscaMesario &&
                          (() => {
                            const participantesFiltrados = mesarios.filter((mesario) => {
                              const buscaLower = buscaMesario.toLowerCase().trim();
                              const nome = (mesario.nome || '').toLowerCase();
                              const email = (mesario.user?.email || mesario.email || '').toLowerCase();
                              const cpf = (mesario.cpf || '').replace(/\D/g, '');
                              const buscaLimpa = buscaLower.replace(/\D/g, '');
                              return nome.includes(buscaLower) || email.includes(buscaLower) || (buscaLimpa && cpf.includes(buscaLimpa));
                            });

                            return (
                              participantesFiltrados.length === 0 && (
                                <div className="text-center py-4" style={{ color: '#666' }}>
                                  <i className="fas fa-search fa-2x mb-2"></i>
                                  <p className="mb-0">Nenhum participante encontrado para "{buscaMesario}"</p>
                                </div>
                              )
                            );
                          })()}
                      </div>

                      <div className="mt-3">
                        {mesariosSelecionados.length > 0 ? (
                          <span className="br-tag info">
                            <i className="fas fa-check-circle mr-1"></i>
                            {mesariosSelecionados.length} responsável{mesariosSelecionados.length !== 1 ? 'eis' : ''} selecionado
                            {mesariosSelecionados.length !== 1 ? 's' : ''}
                          </span>
                        ) : (
                          <span className="br-tag warning">
                            <i className="fas fa-exclamation-circle mr-1"></i>
                            Nenhum responsável selecionado
                          </span>
                        )}
                      </div>
                    </>
                  )}
                </div>
                <div className="br-modal-footer">
                  <button className="br-button secondary" onClick={() => setShowMesariosModal(false)} type="button">
                    Cancelar
                  </button>
                  <button className="br-button primary" onClick={handleSalvarMesarios} type="button">
                    <i className="fas fa-save mr-2"></i>
                    Salvar Alterações
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div className="br-scrim active" onClick={() => setShowMesariosModal(false)}></div>
        </>
      )}

      {/* Modal de Configuração de Apresentação */}
      {showApresentacaoModal && trabalhoEditando && (
        <>
          <div
            style={{
              position: 'fixed',
              top: 0,
              left: 0,
              right: 0,
              bottom: 0,
              backgroundColor: 'rgba(0, 0, 0, 0.5)',
              zIndex: 9998
            }}
            onClick={() => setShowApresentacaoModal(false)}
          />
          <div
            className="br-modal"
            style={{
              position: 'fixed',
              top: '50%',
              left: '50%',
              transform: 'translate(-50%, -50%)',
              maxWidth: '600px',
              width: '90%',
              maxHeight: '90vh',
              overflow: 'auto',
              zIndex: 9999,
              backgroundColor: '#fff',
              borderRadius: '8px',
              boxShadow: '0 4px 12px rgba(0,0,0,0.15)'
            }}
          >
            <div className="br-modal-header" style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', padding: '1.5rem', borderBottom: '1px solid #ddd' }}>
              <div className="br-modal-title" style={{ fontSize: '1.5rem', fontWeight: 'bold', color: '#1351b4' }}>
                Configurar Apresentação
              </div>
              <button
                className="br-button circle small"
                onClick={() => setShowApresentacaoModal(false)}
                type="button"
                style={{ background: 'transparent', border: 'none', fontSize: '1.5rem', cursor: 'pointer' }}
              >
                ×
              </button>
            </div>
            <form onSubmit={handleSalvarApresentacao}>
              <div className="br-modal-body" style={{ padding: '1.5rem' }}>
                <div style={{ marginBottom: '1rem', padding: '1rem', backgroundColor: '#f8f9fa', borderRadius: '8px' }}>
                  <strong style={{ color: '#1351b4' }}>{trabalhoEditando.titulo}</strong>
                  <br />
                  <small className="text-muted">
                    Tipo: <span className={`br-tag ${trabalhoEditando.tipoApresentacao === 'ORAL' ? 'success' : 'info'}`}>
                      {trabalhoEditando.tipoApresentacao === 'ORAL' ? 'Apresentação Oral' : 'Pôster'}
                    </span>
                  </small>
                </div>

                <div className="row">
                  <div className="col-md-6 mb-3">
                    <label htmlFor="dataApresentacao" style={{ display: 'block', marginBottom: '0.5rem', fontWeight: '500' }}>
                      Data da Apresentação *
                    </label>
                    <input
                      type="date"
                      id="dataApresentacao"
                      value={apresentacaoData.data}
                      onChange={(e) => setApresentacaoData({ ...apresentacaoData, data: e.target.value })}
                      required
                      style={{
                        width: '100%',
                        padding: '0.5rem 0.75rem',
                        border: '1px solid #888',
                        borderRadius: '8px',
                        fontSize: '1rem'
                      }}
                    />
                  </div>

                  <div className="col-md-6 mb-3">
                    <label htmlFor="horarioInicio" style={{ display: 'block', marginBottom: '0.5rem', fontWeight: '500' }}>
                      Horário de Início *
                    </label>
                    <input
                      type="time"
                      id="horarioInicio"
                      value={apresentacaoData.horarioInicio}
                      onChange={(e) => setApresentacaoData({ ...apresentacaoData, horarioInicio: e.target.value })}
                      required
                      style={{
                        width: '100%',
                        padding: '0.5rem 0.75rem',
                        border: '1px solid #888',
                        borderRadius: '8px',
                        fontSize: '1rem'
                      }}
                    />
                  </div>
                </div>

                <div className="row">
                  <div className="col-md-6 mb-3">
                    <label htmlFor="duracao" style={{ display: 'block', marginBottom: '0.5rem', fontWeight: '500' }}>
                      Duração (minutos) *
                    </label>
                    <input
                      type="number"
                      id="duracao"
                      value={apresentacaoData.duracao}
                      onChange={(e) => setApresentacaoData({ ...apresentacaoData, duracao: e.target.value })}
                      required
                      min="1"
                      placeholder="Ex: 15"
                      style={{
                        width: '100%',
                        padding: '0.5rem 0.75rem',
                        border: '1px solid #888',
                        borderRadius: '8px',
                        fontSize: '1rem'
                      }}
                    />
                  </div>

                  <div className="col-md-12 mb-3">
                    <label htmlFor="local" style={{ display: 'block', marginBottom: '0.5rem', fontWeight: '500' }}>
                      Local da Apresentação *
                    </label>
                    <input
                      type="text"
                      id="local"
                      value={apresentacaoData.local}
                      onChange={(e) => setApresentacaoData({ ...apresentacaoData, local: e.target.value })}
                      required
                      placeholder="Ex: Auditório Principal, Sala 201, etc."
                      style={{
                        width: '100%',
                        padding: '0.5rem 0.75rem',
                        border: '1px solid #888',
                        borderRadius: '8px',
                        fontSize: '1rem'
                      }}
                    />
                  </div>
                </div>

                <div className="br-message info" style={{ marginTop: '1rem' }}>
                  <div className="icon">
                    <i className="fas fa-info-circle" aria-hidden="true"></i>
                  </div>
                  <div className="content">
                    <small>
                      Configure aqui a data, horário, duração e local da apresentação do trabalho. 
                      Essas informações serão usadas na programação do evento.
                    </small>
                  </div>
                </div>
              </div>

              <div className="br-modal-footer" style={{ display: 'flex', justifyContent: 'flex-end', gap: '1rem', padding: '1rem 1.5rem', borderTop: '1px solid #ddd' }}>
                <button
                  className="br-button secondary"
                  onClick={() => setShowApresentacaoModal(false)}
                  type="button"
                >
                  <i className="fas fa-times mr-2"></i>
                  Cancelar
                </button>
                <button className="br-button primary" type="submit">
                  <i className="fas fa-save mr-2"></i>
                  Salvar
                </button>
              </div>
            </form>
          </div>
        </>
      )}
    </MainLayout>
  );
};

export default AdminSubeventos;
