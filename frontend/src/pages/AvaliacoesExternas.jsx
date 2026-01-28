import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { BrSelect } from '@govbr-ds/react-components';
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
  const [trabalhoDetalhes, setTrabalhoDetalhes] = useState(null);
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
        <div className="br-breadcrumb mb-4">
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
              <span>Avaliações Externas</span>
            </li>
          </ul>
        </div>

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
            <BrSelect
              label="Simpósio"
              placeholder="Selecione..."
              options={simposios.map(s => ({ label: `${s.ano} - ${s.status}`, value: s._id }))}
              onChange={(value) => {
                setSimposioSelecionado(value || '');
                setPagination(prev => ({ ...prev, page: 1 }));
              }}
              value={simposioSelecionado}
              emptyOptionsMessage="Nenhum simpósio encontrado"
            />
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
                    <tr 
                      key={trabalho._id} 
                      style={{ cursor: 'pointer' }}
                      onClick={() => setTrabalhoDetalhes(trabalho)}
                    >
                      <td>
                        <strong>{trabalho.titulo}</strong>
                        <br />
                        <small className="text-muted">
                          {trabalho.autores?.map(a => a.nome).join(', ')}
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
                              onClick={(e) => {
                                e.stopPropagation();
                                salvarNota(trabalho._id);
                              }}
                              title="Salvar nota"
                            >
                              <i className="fas fa-check"></i> Salvar
                            </button>
                            <button
                              className="br-button secondary small"
                              onClick={(e) => {
                                e.stopPropagation();
                                cancelarEdicao();
                              }}
                              title="Cancelar"
                            >
                              <i className="fas fa-times"></i> Cancelar
                            </button>
                          </div>
                        ) : (
                          <div className="d-flex gap-2">
                            <button
                              className="br-button primary small"
                              onClick={(e) => {
                                e.stopPropagation();
                                iniciarEdicao(trabalho);
                              }}
                              title={trabalho.notaExterna !== null ? 'Editar nota' : 'Lançar nota'}
                            >
                              <i className={trabalho.notaExterna !== null ? 'fas fa-edit' : 'fas fa-plus'}></i>
                              {trabalho.notaExterna !== null ? ' Editar' : ' Lançar'}
                            </button>
                            {trabalho.notaExterna !== null && (
                              <button
                                className="br-button danger small"
                                onClick={(e) => {
                                  e.stopPropagation();
                                  removerNota(trabalho._id);
                                }}
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

        {/* Modal de Detalhes do Trabalho */}
        {trabalhoDetalhes && (
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
              onClick={() => setTrabalhoDetalhes(null)}
            />
            <div 
              className="br-modal"
              style={{
                position: 'fixed',
                top: '50%',
                left: '50%',
                transform: 'translate(-50%, -50%)',
                maxWidth: '800px',
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
                  Detalhes do Trabalho
                </div>
                <button
                  className="br-button circle small"
                  onClick={() => setTrabalhoDetalhes(null)}
                  style={{ background: 'transparent', border: 'none', fontSize: '1.5rem', cursor: 'pointer' }}
                >
                  ×
                </button>
              </div>
              <div className="br-modal-body" style={{ padding: '1.5rem' }}>
                <h5 style={{ color: '#1351b4', marginBottom: '1rem' }}>{trabalhoDetalhes.titulo}</h5>
                
                <div style={{ marginBottom: '1.5rem' }}>
                  <strong>Autores:</strong>
                  <p style={{ marginTop: '0.5rem' }}>
                    {trabalhoDetalhes.autores?.map(a => a.nome).join(', ')}
                  </p>
                </div>

                <div style={{ marginBottom: '1.5rem' }}>
                  <strong>Área de Atuação:</strong>
                  <p style={{ marginTop: '0.5rem' }}>
                    {trabalhoDetalhes.areaAtuacao?.nome || '-'}
                  </p>
                </div>

                <div style={{ marginBottom: '1.5rem' }}>
                  <strong>Tipo de Apresentação:</strong>
                  <p style={{ marginTop: '0.5rem' }}>
                    {trabalhoDetalhes.tipoApresentacao === 'ORAL' && 'Apresentação Oral'}
                    {trabalhoDetalhes.tipoApresentacao === 'POSTER' && 'Pôster'}
                    {trabalhoDetalhes.tipoApresentacao === 'NAO_DEFINIDO' && 'Não Definido'}
                  </p>
                </div>

                <hr style={{ margin: '1.5rem 0' }} />

                <h6 style={{ color: '#1351b4', marginBottom: '1rem' }}>Avaliações Internas</h6>
                {trabalhoDetalhes.avaliacoes && trabalhoDetalhes.avaliacoes.length > 0 ? (
                  <div style={{ marginBottom: '1.5rem' }}>
                    {trabalhoDetalhes.avaliacoes.map((av, index) => (
                      <div key={index} style={{ 
                        padding: '1rem', 
                        backgroundColor: '#f8f9fa', 
                        borderRadius: '8px', 
                        marginBottom: '1rem',
                        border: '1px solid #e0e0e0'
                      }}>
                        <div style={{ marginBottom: '0.5rem' }}>
                          <strong>Avaliador:</strong> {av.avaliador?.nome || 'Não identificado'}
                        </div>
                        {av.competencias && (
                          <div style={{ marginBottom: '0.5rem' }}>
                            <strong>Competências:</strong>
                            <ul style={{ marginTop: '0.5rem', marginLeft: '1.5rem' }}>
                              {av.competencias.relevancia && <li>Relevância: {av.competencias.relevancia.toFixed(1)}</li>}
                              {av.competencias.metodologia && <li>Metodologia: {av.competencias.metodologia.toFixed(1)}</li>}
                              {av.competencias.clareza && <li>Clareza: {av.competencias.clareza.toFixed(1)}</li>}
                              {av.competencias.fundamentacao && <li>Fundamentação: {av.competencias.fundamentacao.toFixed(1)}</li>}
                              {av.competencias.contribuicao && <li>Contribuição: {av.competencias.contribuicao.toFixed(1)}</li>}
                            </ul>
                          </div>
                        )}
                        <div style={{ marginBottom: '0.5rem' }}>
                          <strong>Nota Final:</strong> 
                          <span style={{ 
                            marginLeft: '0.5rem', 
                            padding: '0.25rem 0.75rem', 
                            backgroundColor: '#28a745', 
                            color: '#fff', 
                            borderRadius: '4px',
                            fontWeight: 'bold'
                          }}>
                            {(av.notaFinal || av.nota)?.toFixed(2) || '-'}
                          </span>
                        </div>
                        {av.parecer && (
                          <div>
                            <strong>Parecer:</strong>
                            <p style={{ marginTop: '0.5rem', fontStyle: 'italic' }}>{av.parecer}</p>
                          </div>
                        )}
                      </div>
                    ))}
                    <div style={{ 
                      padding: '1rem', 
                      backgroundColor: '#e8f5e9', 
                      borderRadius: '8px',
                      border: '1px solid #4caf50'
                    }}>
                      <strong>Média das Avaliações Internas:</strong> 
                      <span style={{ 
                        marginLeft: '0.5rem', 
                        fontSize: '1.25rem',
                        color: '#2e7d32',
                        fontWeight: 'bold'
                      }}>
                        {trabalhoDetalhes.media !== null ? trabalhoDetalhes.media.toFixed(2) : '-'}
                      </span>
                    </div>
                  </div>
                ) : (
                  <p style={{ color: '#666', marginBottom: '1.5rem' }}>Nenhuma avaliação interna registrada.</p>
                )}

                <hr style={{ margin: '1.5rem 0' }} />

                <h6 style={{ color: '#1351b4', marginBottom: '1rem' }}>Avaliação Externa</h6>
                <div style={{ 
                  padding: '1rem', 
                  backgroundColor: trabalhoDetalhes.notaExterna !== null ? '#e3f2fd' : '#fff3cd', 
                  borderRadius: '8px',
                  border: `1px solid ${trabalhoDetalhes.notaExterna !== null ? '#2196f3' : '#ffc107'}`
                }}>
                  <strong>Nota Externa:</strong> 
                  <span style={{ 
                    marginLeft: '0.5rem', 
                    fontSize: '1.25rem',
                    color: trabalhoDetalhes.notaExterna !== null ? '#1565c0' : '#666',
                    fontWeight: 'bold'
                  }}>
                    {trabalhoDetalhes.notaExterna !== null ? trabalhoDetalhes.notaExterna.toFixed(2) : 'Não lançada'}
                  </span>
                </div>
              </div>
            </div>
          </>
        )}
      </div>
    </MainLayout>
  );
};

export default AvaliacoesExternas;
