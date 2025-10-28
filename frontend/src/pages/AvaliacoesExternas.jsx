import { useState, useEffect } from 'react';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

const AvaliacoesExternas = () => {
  const [trabalhos, setTrabalhos] = useState([]);
  const [simposios, setSimposios] = useState([]);
  const [loading, setLoading] = useState(true);
  const [simposioSelecionado, setSimposioSelecionado] = useState('');
  const [busca, setBusca] = useState('');
  const [pagination, setPagination] = useState({
    page: 1,
    limit: 50,
    total: 0,
    totalPages: 0,
  });
  const [editando, setEditando] = useState(null);
  const [notaTemp, setNotaTemp] = useState('');
  const { showSuccess, showError } = useNotification();

  useEffect(() => {
    carregarSimposios();
  }, []);

  useEffect(() => {
    carregarTrabalhos();
  }, [pagination.page, simposioSelecionado, busca]);

  const carregarSimposios = async () => {
    try {
      const response = await api.get('/public/simposios');
      setSimposios(response.data.data || []);
      
      // Seleciona o simpósio mais recente por padrão
      if (response.data.data && response.data.data.length > 0) {
        const maisRecente = response.data.data.sort((a, b) => b.ano - a.ano)[0];
        setSimposioSelecionado(maisRecente._id);
      }
    } catch (error) {
      console.error('Erro ao carregar simpósios:', error);
      showError('Erro ao carregar simpósios');
    }
  };

  const carregarTrabalhos = async () => {
    if (!simposioSelecionado) return;
    
    setLoading(true);
    try {
      const response = await api.get('/admin/avaliacoes-externas', {
        params: {
          simposioId: simposioSelecionado,
          page: pagination.page,
          limit: pagination.limit,
          busca,
        },
      });
      
      setTrabalhos(response.data.data || []);
      setPagination(prev => ({
        ...prev,
        total: response.data.pagination.total,
        totalPages: response.data.pagination.totalPages,
      }));
    } catch (error) {
      console.error('Erro ao carregar trabalhos:', error);
      showError('Erro ao carregar trabalhos');
    } finally {
      setLoading(false);
    }
  };

  const handleBuscar = (e) => {
    e.preventDefault();
    setPagination(prev => ({ ...prev, page: 1 }));
  };

  const iniciarEdicao = (trabalho) => {
    setEditando(trabalho._id);
    setNotaTemp(trabalho.notaExterna !== null ? trabalho.notaExterna.toString() : '');
  };

  const cancelarEdicao = () => {
    setEditando(null);
    setNotaTemp('');
  };

  const salvarNota = async (trabalhoId) => {
    const nota = parseFloat(notaTemp);
    
    if (isNaN(nota) || nota < 0 || nota > 10) {
      showError('A nota deve estar entre 0 e 10');
      return;
    }
    
    try {
      await api.post(`/admin/avaliacoes-externas/${trabalhoId}`, {
        notaExterna: nota,
      });
      
      showSuccess('Nota externa lançada com sucesso!');
      setEditando(null);
      setNotaTemp('');
      carregarTrabalhos();
    } catch (error) {
      console.error('Erro ao lançar nota:', error);
      if (error.response?.data?.message) {
        showError(error.response.data.message);
      } else {
        showError('Erro ao lançar nota externa');
      }
    }
  };

  const removerNota = async (trabalhoId) => {
    if (!confirm('Deseja realmente remover esta nota externa?')) {
      return;
    }
    
    try {
      await api.delete(`/admin/avaliacoes-externas/${trabalhoId}`);
      showSuccess('Nota externa removida com sucesso!');
      carregarTrabalhos();
    } catch (error) {
      console.error('Erro ao remover nota:', error);
      if (error.response?.data?.message) {
        showError(error.response.data.message);
      } else {
        showError('Erro ao remover nota externa');
      }
    }
  };

  return (
    <MainLayout>
      <div className="container-fluid py-4">
        <div className="row mb-4">
          <div className="col-md-12">
            <h2 className="text-primary">Avaliações Externas</h2>
            <p className="text-muted">
              Lance as notas de avaliação externa para trabalhos aceitos ou publicados.
            </p>
          </div>
        </div>

        {/* Filtros */}
        <div className="row mb-4">
          <div className="col-md-4">
            <div className="br-input">
              <label htmlFor="simposio">Simpósio</label>
              <select
                id="simposio"
                className="form-control"
                value={simposioSelecionado}
                onChange={(e) => {
                  setSimposioSelecionado(e.target.value);
                  setPagination(prev => ({ ...prev, page: 1 }));
                }}
              >
                <option value="">Selecione...</option>
                {simposios.map(s => (
                  <option key={s._id} value={s._id}>
                    {s.ano} - {s.status}
                  </option>
                ))}
              </select>
            </div>
          </div>
          <div className="col-md-8">
            <form onSubmit={handleBuscar}>
              <div className="br-input">
                <label htmlFor="busca">Buscar trabalho</label>
                <input
                  type="text"
                  id="busca"
                  className="form-control"
                  placeholder="Título ou autor..."
                  value={busca}
                  onChange={(e) => setBusca(e.target.value)}
                />
              </div>
            </form>
          </div>
        </div>

        {/* Informações */}
        <div className="row mb-3">
          <div className="col-md-12">
            <div className="br-message info">
              <div className="icon">
                <i className="fas fa-info-circle" aria-hidden="true"></i>
              </div>
              <div className="content">
                <strong>Atenção:</strong> As notas externas só podem ser lançadas dentro do período 
                configurado no simpósio. Somente trabalhos com status ACEITO ou PUBLICADO aparecem nesta lista.
              </div>
            </div>
          </div>
        </div>

        {/* Tabela de Trabalhos */}
        {loading ? (
          <div className="text-center py-5">
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
                    <th scope="col" style={{ width: '40%' }}>Trabalho</th>
                    <th scope="col" style={{ width: '20%' }}>Área</th>
                    <th scope="col" style={{ width: '10%' }}>Média Interna</th>
                    <th scope="col" style={{ width: '15%' }}>Nota Externa</th>
                    <th scope="col" style={{ width: '15%' }}>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  {trabalhos.map(trabalho => (
                    <tr key={trabalho._id}>
                      <td>
                        <strong>{trabalho.titulo}</strong>
                        <br />
                        <small className="text-muted">
                          {trabalho.autores?.map(a => a.nome).join(', ')}
                        </small>
                      </td>
                      <td>
                        {trabalho.grandeArea?.nome || '-'}
                        {trabalho.areaAtuacao && (
                          <>
                            <br />
                            <small className="text-muted">{trabalho.areaAtuacao.nome}</small>
                          </>
                        )}
                      </td>
                      <td className="text-center">
                        {trabalho.media !== null ? (
                          <span className="br-tag success">{trabalho.media.toFixed(2)}</span>
                        ) : (
                          <span className="text-muted">-</span>
                        )}
                      </td>
                      <td>
                        {editando === trabalho._id ? (
                          <div className="br-input small">
                            <input
                              type="number"
                              step="0.1"
                              min="0"
                              max="10"
                              className="form-control"
                              value={notaTemp}
                              onChange={(e) => setNotaTemp(e.target.value)}
                              placeholder="0.0 a 10.0"
                              autoFocus
                            />
                          </div>
                        ) : trabalho.notaExterna !== null ? (
                          <div className="text-center">
                            <span className="br-tag info">
                              {trabalho.notaExterna.toFixed(2)}
                            </span>
                          </div>
                        ) : (
                          <span className="text-muted text-center d-block">Não lançada</span>
                        )}
                      </td>
                      <td>
                        {editando === trabalho._id ? (
                          <div className="d-flex gap-2">
                            <button
                              className="br-button primary small"
                              onClick={() => salvarNota(trabalho._id)}
                              title="Salvar nota"
                            >
                              <i className="fas fa-check"></i> Salvar
                            </button>
                            <button
                              className="br-button secondary small"
                              onClick={cancelarEdicao}
                              title="Cancelar"
                            >
                              <i className="fas fa-times"></i> Cancelar
                            </button>
                          </div>
                        ) : (
                          <div className="d-flex gap-2">
                            <button
                              className="br-button primary small"
                              onClick={() => iniciarEdicao(trabalho)}
                              title={trabalho.notaExterna !== null ? 'Editar nota' : 'Lançar nota'}
                            >
                              <i className={trabalho.notaExterna !== null ? 'fas fa-edit' : 'fas fa-plus'}></i>
                              {trabalho.notaExterna !== null ? ' Editar' : ' Lançar'}
                            </button>
                            {trabalho.notaExterna !== null && (
                              <button
                                className="br-button danger small"
                                onClick={() => removerNota(trabalho._id)}
                                title="Remover nota"
                              >
                                <i className="fas fa-trash"></i>
                              </button>
                            )}
                          </div>
                        )}
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
                          Página {pagination.page} de {pagination.totalPages} ({pagination.total} trabalhos)
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

export default AvaliacoesExternas;
