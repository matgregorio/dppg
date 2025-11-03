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
        params: { tipo: 'MESARIO', limit: 100 },
      });
      if (data.success) {
        setMesarios(data.data);
      }
    } catch (err) {
      console.error('Erro ao carregar mesários:', err);
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
                    <tr key={subevento._id}>
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
                      <strong>Mesários Responsáveis</strong>
                    </label>
                    <div className="row">
                      {mesarios.map((mesario) => (
                        <div key={mesario._id} className="col-md-4 mb-2">
                          <div className="br-checkbox">
                            <input
                              id={`mesario-${mesario._id}`}
                              type="checkbox"
                              checked={formData.responsaveisMesarios.includes(mesario._id)}
                              onChange={() => handleMesarioToggle(mesario._id)}
                            />
                            <label htmlFor={`mesario-${mesario._id}`}>{mesario.nome}</label>
                          </div>
                        </div>
                      ))}
                    </div>
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
    </MainLayout>
  );
};

export default AdminSubeventos;
