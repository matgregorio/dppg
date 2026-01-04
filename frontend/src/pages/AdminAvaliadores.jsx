import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

const AdminAvaliadores = () => {
  const [avaliadores, setAvaliadores] = useState([]);
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
  const [areasAtuacao, setareasAtuacao] = useState([]);
  const [formData, setFormData] = useState({
    nome: '',
    email: '',
    cpf: '',
    senha: '',
    lattes: '',
    areasConhecimento: [],
  });
  const { showSuccess, showError } = useNotification();

  useEffect(() => {
    fetchAvaliadores();
    fetchareasAtuacao();
  }, [pagination.page, busca]);

  const fetchAvaliadores = async () => {
    try {
      setLoading(true);
      const { data } = await api.get('/admin/avaliadores', {
        params: {
          page: pagination.page,
          limit: pagination.limit,
          busca,
        },
      });
      if (data.success) {
        setAvaliadores(data.data);
        setPagination(prev => ({
          ...prev,
          total: data.pagination.total,
          totalPages: data.pagination.totalPages,
        }));
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao carregar avaliadores');
    } finally {
      setLoading(false);
    }
  };

  const fetchareasAtuacao = async () => {
    try {
      const { data } = await api.get('/admin/grandes-areas');
      if (data.success) {
        setareasAtuacao(data.data);
      }
    } catch (err) {
      console.error('Erro ao carregar áreas:', err);
    }
  };

  const handleNovo = () => {
    setFormData({
      nome: '',
      email: '',
      cpf: '',
      senha: '',
      lattes: '',
      areasConhecimento: [],
    });
    setEditando(null);
    setShowModal(true);
  };

  const handleEditar = (avaliador) => {
    setFormData({
      nome: avaliador.nome,
      email: avaliador.email,
      cpf: avaliador.cpf,
      senha: '',
      lattes: avaliador.lattes || '',
      areasConhecimento: avaliador.areasConhecimento?.map(a => a._id) || [],
    });
    setEditando(avaliador);
    setShowModal(true);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    
    if (!formData.nome || !formData.email) {
      showError('Nome e email são obrigatórios');
      return;
    }
    
    if (!editando && !formData.senha) {
      showError('Senha é obrigatória para novo avaliador');
      return;
    }

    try {
      const payload = { ...formData };
      if (editando && !payload.senha) {
        delete payload.senha; // Não atualiza senha se não informada
      }

      if (editando) {
        await api.put(`/admin/avaliadores/${editando._id}`, payload);
        showSuccess('Avaliador atualizado com sucesso!');
      } else {
        await api.post('/admin/avaliadores', payload);
        showSuccess('Avaliador criado com sucesso!');
      }
      
      fetchAvaliadores();
      setShowModal(false);
      setFormData({
        nome: '',
        email: '',
        cpf: '',
        senha: '',
        lattes: '',
        areasConhecimento: [],
      });
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao salvar avaliador');
    }
  };

  const handleRemover = async (id) => {
    if (!confirm('Deseja realmente remover este avaliador?')) return;

    try {
      await api.delete(`/admin/avaliadores/${id}`);
      showSuccess('Avaliador removido com sucesso!');
      fetchAvaliadores();
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao remover avaliador');
    }
  };

  const handleBusca = (e) => {
    e.preventDefault();
    setPagination(prev => ({ ...prev, page: 1 }));
  };

  const handleAreaToggle = (areaId) => {
    setFormData(prev => ({
      ...prev,
      areasConhecimento: prev.areasConhecimento.includes(areaId)
        ? prev.areasConhecimento.filter(id => id !== areaId)
        : [...prev.areasConhecimento, areaId]
    }));
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
            <Link to="/area-administrativa">Área Administrativa</Link>
          </li>
          <li className="crumb">
            <i className="icon fas fa-chevron-right"></i>
            <span>Gerenciar Avaliadores</span>
          </li>
        </ul>
      </div>

      <div className="my-4">
        <div className="d-flex justify-content-between align-items-center mb-4">
          <h1 className="text-up-03 text-weight-bold">
            <i className="fas fa-user-check mr-2"></i>
            Gerenciar Avaliadores
          </h1>
          <button onClick={handleNovo} className="br-button primary">
            <i className="fas fa-plus mr-2"></i>
            Novo Avaliador
          </button>
        </div>

        {/* Busca */}
        <form onSubmit={handleBusca} className="mb-4">
          <div className="row">
            <div className="col-md-10">
              <div className="br-input">
                <label htmlFor="busca">Buscar por nome ou email</label>
                <input
                  id="busca"
                  type="text"
                  value={busca}
                  onChange={(e) => setBusca(e.target.value)}
                  placeholder="Digite para buscar..."
                />
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
            {pagination.total} avaliador{pagination.total !== 1 ? 'es' : ''} encontrado{pagination.total !== 1 ? 's' : ''}
          </span>
        </div>

        {loading ? (
          <div className="text-center my-5">
            <div className="spinner-border text-primary" role="status">
              <span className="sr-only">Carregando...</span>
            </div>
          </div>
        ) : avaliadores.length === 0 ? (
          <div className="br-message warning">
            <div className="icon">
              <i className="fas fa-exclamation-triangle" aria-hidden="true"></i>
            </div>
            <div className="content">
              Nenhum avaliador encontrado.
            </div>
          </div>
        ) : (
          <>
            <div className="table-responsive">
              <table className="br-table">
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Áreas de Conhecimento</th>
                    <th scope="col">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  {avaliadores.map((avaliador) => (
                    <tr key={avaliador._id}>
                      <td>{avaliador.nome}</td>
                      <td>{avaliador.email}</td>
                      <td>{avaliador.cpf || '-'}</td>
                      <td>
                        {avaliador.areasConhecimento?.length > 0 ? (
                          <div>
                            {avaliador.areasConhecimento.slice(0, 2).map(area => (
                              <span key={area._id} className="br-tag small mr-1">
                                {area.nome}
                              </span>
                            ))}
                            {avaliador.areasConhecimento.length > 2 && (
                              <span className="text-muted">
                                +{avaliador.areasConhecimento.length - 2}
                              </span>
                            )}
                          </div>
                        ) : (
                          <span className="text-muted">Nenhuma</span>
                        )}
                      </td>
                      <td>
                        <div className="d-flex gap-2">
                          <button
                            onClick={() => handleEditar(avaliador)}
                            className="br-button secondary small"
                            title="Editar"
                          >
                            <i className="fas fa-edit"></i>
                          </button>
                          <button
                            onClick={() => handleRemover(avaliador._id)}
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
          <div className="br-modal large" style={{ display: 'block' }}>
            <div className="br-modal-header">
              <div className="br-modal-title">
                {editando ? 'Editar Avaliador' : 'Novo Avaliador'}
              </div>
            </div>
            <form onSubmit={handleSubmit}>
              <div className="br-modal-body">
                <div className="row">
                  <div className="col-md-6 mb-3">
                    <div className="br-input">
                      <label htmlFor="nome">Nome *</label>
                      <input
                        id="nome"
                        type="text"
                        value={formData.nome}
                        onChange={(e) => setFormData({ ...formData, nome: e.target.value })}
                        required
                      />
                    </div>
                  </div>
                  <div className="col-md-6 mb-3">
                    <div className="br-input">
                      <label htmlFor="email">Email *</label>
                      <input
                        id="email"
                        type="email"
                        value={formData.email}
                        onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                        required
                      />
                    </div>
                  </div>
                </div>

                <div className="row">
                  <div className="col-md-6 mb-3">
                    <div className="br-input">
                      <label htmlFor="cpf">CPF</label>
                      <input
                        id="cpf"
                        type="text"
                        value={formData.cpf}
                        onChange={(e) => setFormData({ ...formData, cpf: e.target.value })}
                      />
                    </div>
                  </div>
                  <div className="col-md-6 mb-3">
                    <div className="br-input">
                      <label htmlFor="senha">
                        Senha {!editando && '*'}
                        {editando && <small className="text-muted"> (deixe vazio para não alterar)</small>}
                      </label>
                      <input
                        id="senha"
                        type="password"
                        value={formData.senha}
                        onChange={(e) => setFormData({ ...formData, senha: e.target.value })}
                        required={!editando}
                      />
                    </div>
                  </div>
                </div>

                <div className="mb-3">
                  <div className="br-input">
                    <label htmlFor="lattes">Link Lattes</label>
                    <input
                      id="lattes"
                      type="url"
                      value={formData.lattes}
                      onChange={(e) => setFormData({ ...formData, lattes: e.target.value })}
                      placeholder="http://lattes.cnpq.br/..."
                    />
                  </div>
                </div>

                <div className="mb-3">
                  <label className="d-block mb-2">
                    <strong>Áreas de Conhecimento</strong>
                  </label>
                  <div className="row">
                    {areasAtuacao.map((area) => (
                      <div key={area._id} className="col-md-4 mb-2">
                        <div className="br-checkbox">
                          <input
                            id={`area-${area._id}`}
                            type="checkbox"
                            checked={formData.areasConhecimento.includes(area._id)}
                            onChange={() => handleAreaToggle(area._id)}
                          />
                          <label htmlFor={`area-${area._id}`}>{area.nome}</label>
                        </div>
                      </div>
                    ))}
                  </div>
                </div>
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

export default AdminAvaliadores;
