import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

const AdminSubeventos = () => {
  const [subeventos, setSubeventos] = useState([]);
  const [simposios, setSimposios] = useState([]);
  const [mesarios, setMesarios] = useState([]);
  const [loading, setLoading] = useState(true);
  const [showModal, setShowModal] = useState(false);
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
    fetchSubeventos();
    fetchSimposios();
    fetchMesarios();
  }, [pagination.page, busca, simposioFiltro]);

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
        setPagination(prev => ({
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
        // Ordena por nome para facilitar a busca
        const participantesOrdenados = data.data.sort((a, b) => 
          a.nome.localeCompare(b.nome)
        );
        setMesarios(participantesOrdenados);
      }
    } catch (err) {
      console.error('Erro ao carregar participantes:', err);
    }
  };

  const handleGerenciarInscritos = async (subevento) => {
    // Se já está expandido, recolhe
    if (subeventoExpandido === subevento._id) {
      setSubeventoExpandido(null);
      setInscritos([]);
      return;
    }
    
    // Expande o novo subevento
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
    if (!confirm('Deseja realmente confirmar a presença deste participante?')) return;
    
    try {
      const { data } = await api.post(`/admin/subeventos/${subeventoExpandido}/inscritos/${inscritoId}/presenca`);
      if (data.success) {
        showSuccess('Presença confirmada com sucesso!');
        await fetchInscritos(subeventoExpandido);
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao confirmar presença');
    }
  };

  const handleRemoverInscrito = async (inscritoId) => {
    if (!confirm('Deseja realmente remover este inscrito?')) return;

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
      responsaveisMesarios: subevento.responsaveisMesarios?.map(m => m._id) || [],
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
    if (!confirm('Deseja realmente remover este subevento?')) return;

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
    setPagination(prev => ({ ...prev, page: 1 }));
  };

  const handleMesarioToggle = (mesarioId) => {
    setFormData(prev => ({
      ...prev,
      responsaveisMesarios: prev.responsaveisMesarios.includes(mesarioId)
        ? prev.responsaveisMesarios.filter(id => id !== mesarioId)
        : [...prev.responsaveisMesarios, mesarioId]
    }));
  };

  const handleGerenciarMesarios = (subevento) => {
    setSubeventoMesarios(subevento);
    setMesariosSelecionados(subevento.responsaveisMesarios?.map(m => m._id) || []);
    setBuscaMesario('');
    setShowMesariosModal(true);
  };

  const handleToggleMesarioModal = (mesarioId) => {
    setMesariosSelecionados(prev =>
      prev.includes(mesarioId)
        ? prev.filter(id => id !== mesarioId)
        : [...prev, mesarioId]
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

  const formatData = (data) => {
    return new Date(data).toLocaleDateString('pt-BR');
  };

  const tiposSubevento = [
    'Palestra',
    'Minicurso',
    'Workshop',
    'Mesa Redonda',
    'Apresentação',
    'Outro',
  ];

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
            <span>Gerenciar Subeventos</span>
          </li>
        </ul>
      </div>

      <div className="my-4">
        <div className="d-flex justify-content-between align-items-center mb-4">
          <h1 className="text-up-03 text-weight-bold">
            <i className="fas fa-calendar-alt mr-2"></i>
            Gerenciar Subeventos
          </h1>
          <button onClick={handleNovo} className="br-button primary">
            <i className="fas fa-plus mr-2"></i>
            Novo Subevento
          </button>
        </div>

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
              <div className="br-select">
                <label htmlFor="simposioFiltro">Filtrar por Simpósio</label>
                <select
                  id="simposioFiltro"
                  value={simposioFiltro}
                  onChange={(e) => setSimposioFiltro(e.target.value)}
                >
                  <option value="">Todos</option>
                  {simposios.map(s => (
                    <option key={s._id} value={s._id}>{s.ano}</option>
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
            <div className="content">
              Nenhum subevento encontrado.
            </div>
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
                        <td>
                          {subevento.tipo && (
                            <span className="br-tag small">{subevento.tipo}</span>
                          )}
                        </td>
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
                            >
                              <i className={`fas fa-${subeventoExpandido === subevento._id ? 'chevron-up' : 'users'}`}></i>
                            </button>
                            <button
                              onClick={() => handleGerenciarMesarios(subevento)}
                              className="br-button secondary small"
                              title="Gerenciar Responsáveis"
                            >
                              <i className="fas fa-users-cog"></i>
                            </button>
                            <button
                              onClick={() => handleEditar(subevento)}
                              className="br-button secondary small"
                              title="Editar"
                            >
                              <i className="fas fa-edit"></i>
                            </button>
                            <button
                              onClick={() => handleRemover(subevento._id)}
                              className="br-button danger small"
                              title="Remover"
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
                                >
                                  <i className="fas fa-user-plus mr-2"></i>
                                  Adicionar Participante
                                </button>
                              </div>

                              <div className="mb-3">
                                <p className="mb-1">
                                  <strong>Vagas:</strong> {subevento.vagas || 'Ilimitado'} | 
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
                                  <div className="content">
                                    Nenhum inscrito encontrado neste subevento.
                                  </div>
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
                                            <span className={`br-tag ${
                                              inscrito.status === 'CONFIRMADO' ? 'success' :
                                              inscrito.status === 'CANCELADO' ? 'danger' :
                                              'warning'
                                            }`}>
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
                                                >
                                                  <i className="fas fa-check"></i>
                                                </button>
                                              )}
                                              <button
                                                onClick={() => handleRemoverInscrito(inscrito._id)}
                                                className="br-button danger small"
                                                title="Remover Inscrito"
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
                          onClick={() => setPagination(prev => ({ ...prev, page: prev.page - 1 }))}
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
                          onClick={() => setPagination(prev => ({ ...prev, page: prev.page + 1 }))}
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
      </div>

      {/* Modal */}
      {showModal && (
        <>
          <div className="br-scrim-util foco" onClick={() => setShowModal(false)}></div>
          <div className="br-modal large" style={{ display: 'block', maxHeight: '90vh', overflowY: 'auto' }}>
            <div className="br-modal-header">
              <div className="br-modal-title">
                {editando ? 'Editar Subevento' : 'Novo Subevento'}
              </div>
            </div>
            <form onSubmit={handleSubmit}>
              <div className="br-modal-body">
                <div className="row">
                  <div className="col-md-8 mb-3">
                    <div className="br-input">
                      <label htmlFor="titulo">Título *</label>
                      <input
                        id="titulo"
                        type="text"
                        value={formData.titulo}
                        onChange={(e) => setFormData({ ...formData, titulo: e.target.value })}
                        required
                      />
                    </div>
                  </div>
                  <div className="col-md-4 mb-3">
                    <div className="br-select">
                      <label htmlFor="tipo">Tipo</label>
                      <select
                        id="tipo"
                        value={formData.tipo}
                        onChange={(e) => setFormData({ ...formData, tipo: e.target.value })}
                      >
                        <option value="">Selecione...</option>
                        {tiposSubevento.map(tipo => (
                          <option key={tipo} value={tipo}>{tipo}</option>
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
                    <div className="br-select">
                      <label htmlFor="simposio">Simpósio *</label>
                      <select
                        id="simposio"
                        value={formData.simposio}
                        onChange={(e) => setFormData({ ...formData, simposio: e.target.value })}
                        required
                      >
                        <option value="">Selecione...</option>
                        {simposios.map(s => (
                          <option key={s._id} value={s._id}>{s.ano}</option>
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
                    <div style={{ maxHeight: '200px', overflowY: 'auto', border: '1px solid #ddd', borderRadius: '4px', padding: '8px' }}>
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
                              {mesario.nome} <span className="text-down-01" style={{ opacity: 0.7 }}>({mesario.user?.email})</span>
                            </label>
                          </div>
                        </div>
                      ))}
                    </div>
                    {formData.responsaveisMesarios.length > 0 && (
                      <div className="mt-2">
                        <span className="br-tag info small">
                          {formData.responsaveisMesarios.length} responsável{formData.responsaveisMesarios.length !== 1 ? 'eis' : ''} selecionado{formData.responsaveisMesarios.length !== 1 ? 's' : ''}
                        </span>
                      </div>
                    )}
                  </div>
                )}
              </div>
              <div className="br-modal-footer">
                <button
                  type="button"
                  className="br-button secondary"
                  onClick={() => setShowModal(false)}
                >
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
                      .filter(p => !inscritos.some(i => i.participant?._id === p._id))
                      .filter(p => {
                        if (!filtroParticipante) return true;
                        const busca = filtroParticipante.toLowerCase();
                        return (
                          p.nome.toLowerCase().includes(busca) ||
                          p.user?.email.toLowerCase().includes(busca) ||
                          p.cpf.includes(busca)
                        );
                      })
                      .map(p => (
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
                            if (participanteSelecionado !== p._id) {
                              e.target.style.backgroundColor = '#f8f9fa';
                            }
                          }}
                          onMouseLeave={(e) => {
                            if (participanteSelecionado !== p._id) {
                              e.target.style.backgroundColor = 'transparent';
                            }
                          }}
                        >
                          <div style={{ fontWeight: 'bold' }}>{p.nome}</div>
                          <div style={{ fontSize: '0.875rem', opacity: 0.8 }}>
                            {p.user?.email} • CPF: {p.cpf}
                          </div>
                        </div>
                      ))}
                    {participantes
                      .filter(p => !inscritos.some(i => i.participant?._id === p._id))
                      .filter(p => {
                        if (!filtroParticipante) return true;
                        const busca = filtroParticipante.toLowerCase();
                        return (
                          p.nome.toLowerCase().includes(busca) ||
                          p.user?.email.toLowerCase().includes(busca) ||
                          p.cpf.includes(busca)
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
                  >
                    Cancelar
                  </button>
                  <button
                    className="br-button primary"
                    onClick={handleAdicionarInscrito}
                    disabled={!participanteSelecionado}
                  >
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
                <div className="br-modal-header">
                  <div className="br-modal-title">
                    <i className="fas fa-users-cog mr-2"></i>
                    Gerenciar Responsáveis pelo Subevento
                  </div>
                  <button
                    className="br-button circle small"
                    onClick={() => setShowMesariosModal(false)}
                  >
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
                      <div className="content">
                        Nenhum participante cadastrado no sistema.
                      </div>
                    </div>
                  ) : (
                    <>
                      <div className="br-message info mb-3">
                        <div className="icon">
                          <i className="fas fa-info-circle"></i>
                        </div>
                        <div className="content">
                          <p className="mb-1"><strong>Responsáveis são opcionais</strong></p>
                          <p className="mb-0 text-down-01">Qualquer participante pode ser selecionado como responsável. Eles terão acesso para gerenciar presenças e gerar QR Codes para este subevento.</p>
                        </div>
                      </div>
                      
                      <div className="mb-3" style={{ position: 'relative' }}>
                        <div className="br-input">
                          <label htmlFor="buscaMesario">
                            <i className="fas fa-search mr-1"></i>
                            Buscar por nome, e-mail ou CPF
                          </label>
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
                            style={{ 
                              position: 'absolute', 
                              right: '4px', 
                              bottom: '4px',
                              zIndex: 10
                            }}
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
                          const participantesFiltrados = mesarios.filter(mesario => {
                            if (!buscaMesario) return true;
                            const busca = buscaMesario.toLowerCase().trim();
                            const nome = (mesario.nome || '').toLowerCase();
                            const email = (mesario.user?.email || mesario.email || '').toLowerCase();
                            const cpf = (mesario.cpf || '').replace(/\D/g, '');
                            const buscaLimpa = busca.replace(/\D/g, '');
                            
                            const match = (
                              nome.includes(busca) ||
                              email.includes(busca) ||
                              (buscaLimpa && cpf.includes(buscaLimpa))
                            );
                            
                            return match;
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
                                  transition: 'all 0.2s'
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
                                <label 
                                  htmlFor={`mesario-modal-${mesario._id}`}
                                  style={{ cursor: 'pointer', marginBottom: 0 }}
                                >
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
                        {buscaMesario && (() => {
                          const participantesFiltrados = mesarios.filter(mesario => {
                            const busca = buscaMesario.toLowerCase().trim();
                            const nome = (mesario.nome || '').toLowerCase();
                            const email = (mesario.user?.email || mesario.email || '').toLowerCase();
                            const cpf = (mesario.cpf || '').replace(/\D/g, '');
                            const buscaLimpa = busca.replace(/\D/g, '');
                            
                            return (
                              nome.includes(busca) ||
                              email.includes(busca) ||
                              (buscaLimpa && cpf.includes(buscaLimpa))
                            );
                          });
                          
                          return participantesFiltrados.length === 0 && (
                            <div className="text-center py-4" style={{ color: '#666' }}>
                              <i className="fas fa-search fa-2x mb-2"></i>
                              <p className="mb-0">Nenhum participante encontrado para "{buscaMesario}"</p>
                            </div>
                          );
                        })()}
                      </div>
                      <div className="mt-3">
                        {mesariosSelecionados.length > 0 ? (
                          <span className="br-tag info">
                            <i className="fas fa-check-circle mr-1"></i>
                            {mesariosSelecionados.length} responsável{mesariosSelecionados.length !== 1 ? 'eis' : ''} selecionado{mesariosSelecionados.length !== 1 ? 's' : ''}
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
                  <button
                    className="br-button secondary"
                    onClick={() => setShowMesariosModal(false)}
                  >
                    Cancelar
                  </button>
                  <button
                    className="br-button primary"
                    onClick={handleSalvarMesarios}
                  >
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
    </MainLayout>
  );
};

export default AdminSubeventos;
