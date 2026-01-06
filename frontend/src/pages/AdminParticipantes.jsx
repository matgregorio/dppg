import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

const AdminParticipantes = () => {
  const [participantes, setParticipantes] = useState([]);
  const [loading, setLoading] = useState(true);
  const [simposioAtual, setSimposioAtual] = useState(null);
  const [pagination, setPagination] = useState({
    page: 1,
    limit: 20,
    total: 0,
    totalPages: 0,
  });
  const [filtros, setFiltros] = useState({
    busca: '',
    tipo: '',
  });
  const { showError, showSuccess } = useNotification();
  
  useEffect(() => {
    fetchSimposioAtual();
  }, []);
  
  useEffect(() => {
    if (simposioAtual) {
      fetchParticipantes();
    }
  }, [pagination.page, filtros, simposioAtual]);
  
  const fetchSimposioAtual = async () => {
    try {
      const { data } = await api.get('/public/simposios');
      if (data.success && data.data.length > 0) {
        setSimposioAtual(data.data[0]);
      }
    } catch (err) {
      showError('Erro ao carregar simpósio atual');
    }
  };
  
  const fetchParticipantes = async () => {
    try {
      setLoading(true);
      const { data } = await api.get('/admin/participantes', {
        params: {
          page: pagination.page,
          limit: pagination.limit,
          busca: filtros.busca,
          tipo: filtros.tipo,
          simposio: simposioAtual?._id,
        },
      });
      if (data.success) {
        setParticipantes(data.data);
        setPagination(prev => ({
          ...prev,
          total: data.pagination.total,
          totalPages: data.pagination.totalPages,
        }));
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao carregar participantes');
    } finally {
      setLoading(false);
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
  
  const getTipoParticipante = (tipo) => {
    const tipos = {
      SERVIDOR: 'Servidor',
      DISCENTE: 'Discente',
      EXTERNO: 'Externo',
    };
    return tipos[tipo] || tipo;
  };

  const getTipoBadge = (tipo) => {
    const badges = {
      SERVIDOR: 'success',
      DISCENTE: 'info',
      EXTERNO: 'warning',
    };
    return badges[tipo] || 'secondary';
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
            <span>Participantes</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <div className="d-flex justify-content-between align-items-center mb-4">
          <h1 className="text-up-03 text-weight-bold">
            Participantes{simposioAtual ? ` do Simpósio ${simposioAtual.ano}` : ''}
          </h1>
          <div className="d-flex gap-2 align-items-center">
            <span className="br-tag info large">{pagination.total} Total</span>
          </div>
        </div>
        
        {/* Filtros */}
        <div className="row mb-4">
          <div className="col-md-4">
            <div className="br-input">
              <label htmlFor="tipo">Tipo de Participante</label>
              <select
                id="tipo"
                value={filtros.tipo}
                onChange={(e) => handleFiltroChange('tipo', e.target.value)}
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
                <option value="SERVIDOR">Servidor</option>
                <option value="DISCENTE">Discente</option>
                <option value="EXTERNO">Externo</option>
              </select>
            </div>
          </div>
          <div className="col-md-8">
            <form onSubmit={handleBuscar}>
              <div className="br-input">
                <label htmlFor="busca">Buscar participante</label>
                <input
                  type="text"
                  id="busca"
                  className="form-control"
                  placeholder="Nome, CPF ou email..."
                  value={filtros.busca}
                  onChange={(e) => setFiltros(prev => ({ ...prev, busca: e.target.value }))}
                />
              </div>
            </form>
          </div>
        </div>
        
        {loading ? (
          <div className="text-center py-5">
            <div className="spinner-border text-primary" role="status">
              <span className="sr-only">Carregando...</span>
            </div>
          </div>
        ) : participantes.length === 0 ? (
          <div className="br-message warning">
            <div className="icon">
              <i className="fas fa-exclamation-triangle" aria-hidden="true"></i>
            </div>
            <div className="content">
              Nenhum participante encontrado com os filtros selecionados.
            </div>
          </div>
        ) : (
          <>
            <div className="table-responsive">
              <table className="br-table">
                <thead>
                  <tr>
                    <th scope="col" style={{ width: '30%' }}>Nome</th>
                    <th scope="col" style={{ width: '15%' }}>CPF</th>
                    <th scope="col" style={{ width: '25%' }}>Email</th>
                    <th scope="col" style={{ width: '15%' }}>Telefone</th>
                    <th scope="col" style={{ width: '15%' }}>Tipo</th>
                  </tr>
                </thead>
                <tbody>
                  {participantes.map((p) => (
                    <tr key={p._id}>
                      <td><strong>{p.nome}</strong></td>
                      <td>{p.cpf || '-'}</td>
                      <td>{p.email}</td>
                      <td>{p.telefone || '-'}</td>
                      <td>
                        <span className={`br-tag ${getTipoBadge(p.tipo || p.tipoParticipante)}`}>
                          {getTipoParticipante(p.tipo || p.tipoParticipante) || '-'}
                        </span>
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
                  <nav aria-label="Paginação de participantes">
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
    </MainLayout>
  );
};

export default AdminParticipantes;
