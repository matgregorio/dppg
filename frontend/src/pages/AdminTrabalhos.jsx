import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import { BrSelect } from '@govbr-ds/react-components';
import api from '../services/api';
import useNotification from '../hooks/useNotification';
import TrabalhoDetalhesModal from '../components/modals/TrabalhoDetalhesModal';
import EditarTrabalhoModal from '../components/modals/EditarTrabalhoModal';

const AdminTrabalhos = () => {
  const [trabalhos, setTrabalhos] = useState([]);
  const [loading, setLoading] = useState(true);
  const [showModal, setShowModal] = useState(false);
  const [showDetalhesModal, setShowDetalhesModal] = useState(false);
  const [showEditarModal, setShowEditarModal] = useState(false);
  const [selectedTrabalho, setSelectedTrabalho] = useState(null);
  const [trabalhoDetalhes, setTrabalhoDetalhes] = useState(null);
  const [avaliadores, setAvaliadores] = useState([]);
  const [selectedAvaliadorId, setSelectedAvaliadorId] = useState('');
  const [pagination, setPagination] = useState({
    page: 1,
    limit: 20,
    total: 0,
    totalPages: 0,
  });
  const [filtros, setFiltros] = useState({
    ano: new Date().getFullYear(),
    status: '',
    busca: '',
  });
  const { showSuccess, showError } = useNotification();
  
  useEffect(() => {
    fetchTrabalhos();
    fetchAvaliadores();
  }, [pagination.page, filtros]);
  
  const fetchTrabalhos = async () => {
    try {
      setLoading(true);
      const { data } = await api.get('/admin/trabalhos', {
        params: {
          ano: filtros.ano,
          status: filtros.status,
          busca: filtros.busca,
          page: pagination.page,
          limit: pagination.limit,
        },
      });
      if (data.success) {
        setTrabalhos(data.data);
        setPagination(prev => ({
          ...prev,
          total: data.pagination.total,
          totalPages: data.pagination.totalPages,
        }));
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao carregar trabalhos');
    } finally {
      setLoading(false);
    }
  };
  
  const fetchAvaliadores = async () => {
    try {
      const { data } = await api.get('/admin/avaliadores');
      if (data.success) {
        setAvaliadores(data.data);
      }
    } catch (err) {
      console.error('Erro ao carregar avaliadores:', err);
    }
  };
  
  const handleAtribuir = (trabalho) => {
    setSelectedTrabalho(trabalho);
    setShowModal(true);
  };
  
  const handleVerDetalhes = async (trabalhoId) => {
    try {
      const { data } = await api.get(`/admin/trabalhos/${trabalhoId}`);
      if (data.success) {
        setTrabalhoDetalhes(data.data);
        setShowDetalhesModal(true);
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao carregar detalhes');
    }
  };
  
  const handleSubmit = async (e) => {
    if (!selectedAvaliadorId || !selectedTrabalho) return;
    
    try {
      const { data } = await api.post(
        `/admin/trabalhos/${selectedTrabalho._id}/atribuir-avaliador`,
        { avaliadorId: selectedAvaliadorId }
      );
      
      if (data.success) {
        showSuccess('Avaliador atribuído com sucesso!');
        fetchTrabalhos();
        setShowModal(false);
        setSelectedTrabalho(null);
        setSelectedAvaliadorId('');
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao atribuir avaliador');
    }
  };
  
  const confirmAtribuicao = async () => {
    if (!selectedAvaliadorId || !selectedTrabalho) return;
    
    try {
      const { data } = await api.post(
        `/admin/trabalhos/${selectedTrabalho._id}/atribuir-avaliador`,
        { avaliadorId: selectedAvaliadorId }
      );
      
      if (data.success) {
        showSuccess('Avaliador atribuído com sucesso!');
        fetchTrabalhos();
        setShowModal(false);
        setSelectedTrabalho(null);
        setSelectedAvaliadorId('');
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao atribuir avaliador');
    }
  };

  const handleFiltroChange = (campo, valor) => {
    setFiltros(prev => ({ ...prev, [campo]: valor }));
    setPagination(prev => ({ ...prev, page: 1 }));
  };

  const handleBuscar = (e) => {
    e.preventDefault();
    setPagination(prev => ({ ...prev, page: 1 }));
  };
  
  const handleEditar = (trabalho) => {
    setSelectedTrabalho(trabalho);
    setShowEditarModal(true);
  };
  
  const handleSalvarEdicao = async (formData) => {
    try {
      const { data } = await api.put(`/admin/trabalhos/${selectedTrabalho._id}`, formData);
      
      if (data.success) {
        showSuccess('Trabalho atualizado com sucesso!');
        fetchTrabalhos();
        setShowEditarModal(false);
        setSelectedTrabalho(null);
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao atualizar trabalho');
    }
  };
  
  const getStatusBadge = (status) => {
    const badges = {
      SUBMETIDO: 'info',
      EM_AVALIACAO: 'warning',
      AVALIADO: 'success',
      REJEITADO: 'danger',
      ACEITO: 'success',
    };
    return badges[status] || 'secondary';
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
            <span>Gerenciar Trabalhos</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">Gerenciar Trabalhos</h1>
        
        {/* Filtros */}
        <div className="row mb-4">
          <div className="col-md-3">
            <div className="br-input">
              <label htmlFor="ano">Ano do Simpósio</label>
              <input
                type="number"
                id="ano"
                className="form-control"
                value={filtros.ano}
                onChange={(e) => handleFiltroChange('ano', parseInt(e.target.value))}
              />
            </div>
          </div>
          <div className="col-md-3">
            <BrSelect
              label="Status"
              placeholder="Selecione o status"
              options={[
                { label: 'Todos', value: '' },
                { label: 'Submetido', value: 'SUBMETIDO' },
                { label: 'Em Avaliação', value: 'EM_AVALIACAO' },
                { label: 'Aceito', value: 'ACEITO' },
                { label: 'Rejeitado', value: 'REJEITADO' },
                { label: 'Publicado', value: 'PUBLICADO' }
              ]}
              onChange={(value) => handleFiltroChange('status', value)}
              value={filtros.status}
              emptyOptionsMessage="Nenhuma opção encontrada"
            />
          </div>
          <div className="col-md-6">
            <form onSubmit={handleBuscar}>
              <div className="br-input">
                <label htmlFor="busca">Buscar</label>
                <input
                  type="text"
                  id="busca"
                  className="form-control"
                  placeholder="Título, autor ou email..."
                  value={filtros.busca}
                  onChange={(e) => setFiltros(prev => ({ ...prev, busca: e.target.value }))}
                />
              </div>
            </form>
          </div>
        </div>

        {/* Info */}
        <div className="mb-3">
          <span className="br-tag info">
            {pagination.total} trabalho{pagination.total !== 1 ? 's' : ''} encontrado{pagination.total !== 1 ? 's' : ''}
          </span>
        </div>
        
        {loading ? (
          <div className="text-center my-5">
            <div className="spinner-border text-primary" role="status">
              <span className="sr-only">Carregando...</span>
            </div>
          </div>
        ) : trabalhos.length === 0 ? (
          <div className="br-message warning">
            <div className="icon">
              <i className="fas fa-exclamation-triangle" aria-hidden="true"></i>
            </div>
            <div className="content">
              Nenhum trabalho encontrado com os filtros selecionados.
            </div>
          </div>
        ) : (
          <>
            <div className="table-responsive">
              <table className="br-table">
                <thead>
                  <tr>
                    <th scope="col" style={{ width: '35%' }}>Trabalho</th>
                    <th scope="col" style={{ width: '15%' }}>Área</th>
                    <th scope="col" style={{ width: '10%' }}>Status</th>
                    <th scope="col" style={{ width: '15%' }}>Avaliações</th>
                    <th scope="col" style={{ width: '10%' }}>Média</th>
                    <th scope="col" style={{ width: '15%' }}>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  {trabalhos.map((trabalho) => (
                    <tr key={trabalho._id}>
                      <td>
                        <strong>{trabalho.titulo}</strong>
                        <br />
                        <small className="text-muted">
                          {trabalho.autores?.map(a => a.nome).join(', ') || 'Sem autores'}
                        </small>
                      </td>
                      <td>
                        {trabalho.areaAtuacao?.nome || '-'}
                        {trabalho.areaAtuacao && (
                          <>
                            <br />
                            <small className="text-muted">{trabalho.areaAtuacao.nome}</small>
                          </>
                        )}
                      </td>
                      <td>
                        <span className={`br-tag ${getStatusBadge(trabalho.status)}`}>
                          {trabalho.status}
                        </span>
                      </td>
                      <td>
                        <small>
                          Enviados: {trabalho.qtd_enviados || 0}
                          <br />
                          Avaliados: {trabalho.qtd_avaliados || 0}
                        </small>
                      </td>
                      <td className="text-center">
                        {trabalho.media !== null && trabalho.media !== undefined ? (
                          <span className="br-tag success">{trabalho.media.toFixed(2)}</span>
                        ) : (
                          <span className="text-muted">-</span>
                        )}
                      </td>
                      <td>
                        <div className="d-flex gap-2">
                          <button
                            onClick={() => handleVerDetalhes(trabalho._id)}
                            className="br-button secondary small"
                            title="Ver detalhes e avaliações"
                          >
                            <i className="fas fa-eye"></i>
                          </button>
                          <button
                            onClick={() => handleEditar(trabalho)}
                            className="br-button secondary small"
                            title="Editar status e tipo"
                          >
                            <i className="fas fa-edit"></i>
                          </button>
                          <button
                            onClick={() => handleAtribuir(trabalho)}
                            className="br-button primary small"
                            title={
                              trabalho.status === 'AGUARDANDO_ORIENTADOR'
                                ? 'Aguardando aprovação do orientador'
                                : trabalho.status === 'REPROVADO_ORIENTADOR'
                                ? 'Trabalho reprovado pelo orientador'
                                : 'Atribuir avaliador'
                            }
                            disabled={
                              trabalho.status === 'AGUARDANDO_ORIENTADOR' ||
                              trabalho.status === 'REPROVADO_ORIENTADOR'
                            }
                            style={{
                              opacity:
                                trabalho.status === 'AGUARDANDO_ORIENTADOR' ||
                                trabalho.status === 'REPROVADO_ORIENTADOR'
                                  ? 0.5
                                  : 1,
                              cursor:
                                trabalho.status === 'AGUARDANDO_ORIENTADOR' ||
                                trabalho.status === 'REPROVADO_ORIENTADOR'
                                  ? 'not-allowed'
                                  : 'pointer',
                            }}
                          >
                            <i className="fas fa-user-plus"></i>
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
                  <nav aria-label="Paginação de trabalhos">
                    <ul className="br-pagination" role="list">
                      <li>
                        <button
                          className="br-button"
                          disabled={pagination.page === 1}
                          onClick={() => setPagination(prev => ({ ...prev, page: prev.page - 1 }))}
                        >
                          <i className="fas fa-chevron-left"></i> Anterior
                        </button>
                      </li>
                      <li>
                        <span className="px-3 py-2">
                          Página {pagination.page} de {pagination.totalPages}
                        </span>
                      </li>
                      <li>
                        <button
                          className="br-button"
                          disabled={pagination.page >= pagination.totalPages}
                          onClick={() => setPagination(prev => ({ ...prev, page: prev.page + 1 }))}
                        >
                          Próxima <i className="fas fa-chevron-right"></i>
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
      
      {showModal && selectedTrabalho && (
        <>
          <div className="br-scrim" onClick={() => setShowModal(false)} style={{ backgroundColor: 'rgba(0, 0, 0, 0.5)', zIndex: 9998 }}></div>
          <div className="br-modal medium" style={{ display: 'block', position: 'fixed', top: '50%', left: '50%', transform: 'translate(-50%, -50%)', zIndex: 9999 }}>
            <div className="br-modal-header">
              <h4>Atribuir Avaliador</h4>
            </div>
            <div className="br-modal-body">
              <p className="mb-3">
                <strong>Trabalho:</strong> {selectedTrabalho.titulo}
              </p>
              
              
              <BrSelect
                label="Selecione um avaliador"
                placeholder="Selecione um avaliador"
                options={avaliadores.map(av => ({ 
                  label: `${av.nome} (${av.email})`, 
                  value: av._id 
                }))}
                onChange={(value) => setSelectedAvaliadorId(value)}
                value={selectedAvaliadorId}
                emptyOptionsMessage="Nenhum avaliador encontrado"
              />
            </div>
            <div className="br-modal-footer">
              <button
                className="br-button secondary"
                onClick={() => {
                  setShowModal(false);
                  setSelectedTrabalho(null);
                  setSelectedAvaliadorId('');
                }}
              >
                Cancelar
              </button>
              <button
                className="br-button primary"
                onClick={confirmAtribuicao}
                disabled={!selectedAvaliadorId}
              >
                Atribuir
              </button>
            </div>
          </div>
        </>
      )}
      
      {/* Modal de Detalhes do Trabalho */}
      <TrabalhoDetalhesModal
        trabalho={trabalhoDetalhes}
        isOpen={showDetalhesModal}
        onClose={() => {
          setShowDetalhesModal(false);
          setTrabalhoDetalhes(null);
        }}
        isAdmin={true}
      />
      
      {/* Modal de Edição do Trabalho */}
      <EditarTrabalhoModal
        trabalho={selectedTrabalho}
        isOpen={showEditarModal}
        onClose={() => {
          setShowEditarModal(false);
          setSelectedTrabalho(null);
        }}
        onSave={handleSalvarEdicao}
      />
    </MainLayout>
  );
};

export default AdminTrabalhos;
