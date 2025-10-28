import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const Acervo = () => {
  const [acervos, setAcervos] = useState([]);
  const [loading, setLoading] = useState(true);
  const [pagination, setPagination] = useState({ currentPage: 1, totalPages: 1, total: 0 });
  const [filters, setFilters] = useState({ ano: '', busca: '' });

  useEffect(() => {
    carregarAcervos();
  }, [filters, pagination.currentPage]);

  const carregarAcervos = async () => {
    try {
      setLoading(true);
      const params = {
        page: pagination.currentPage,
        limit: 20,
        ...(filters.ano && { ano: filters.ano }),
        ...(filters.busca && { busca: filters.busca })
      };
      
      const response = await api.get('/public/acervo', { params });
      setAcervos(response.data.acervos);
      setPagination({
        currentPage: response.data.currentPage,
        totalPages: response.data.totalPages,
        total: response.data.total
      });
    } catch (error) {
      console.error('Erro ao carregar acervos:', error);
    } finally {
      setLoading(false);
    }
  };

  return (
    <MainLayout>
      <div className="container-lg my-4">
        <div className="row mb-4">
          <div className="col">
            <nav className="br-breadcrumb" aria-label="Breadcrumbs">
              <ol className="crumb-list" role="list">
                <li className="crumb home"><Link to="/">Início</Link></li>
                <li className="crumb" data-active="active"><span>Acervo</span></li>
              </ol>
            </nav>
          </div>
        </div>

        <div className="row mb-4">
          <div className="col">
            <h1 className="mb-3">Acervo de Trabalhos</h1>
            <p className="text-base mb-4">
              Consulte trabalhos publicados em edições anteriores do simpósio.
            </p>
            
            <div className="br-card">
              <div className="card-header">
                <h3>Filtros de Busca</h3>
              </div>
              
              <div className="card-content">
                <div className="row">
                  <div className="col-md-3 mb-3">
                    <div className="br-input">
                      <label htmlFor="filtro-ano">Ano</label>
                      <input
                        id="filtro-ano"
                        type="number"
                        value={filters.ano}
                        onChange={(e) => {
                          setFilters({ ...filters, ano: e.target.value });
                          setPagination({ ...pagination, currentPage: 1 });
                        }}
                        placeholder="Ex: 2024"
                      />
                    </div>
                  </div>
                  <div className="col-md-7 mb-3">
                    <div className="br-input">
                      <label htmlFor="filtro-busca">Buscar</label>
                      <input
                        id="filtro-busca"
                        type="text"
                        value={filters.busca}
                        onChange={(e) => {
                          setFilters({ ...filters, busca: e.target.value });
                          setPagination({ ...pagination, currentPage: 1 });
                        }}
                        placeholder="Título, autor ou palavra-chave"
                      />
                    </div>
                  </div>
                  <div className="col-md-2 mb-3 d-flex align-items-end">
                    <button
                      className="br-button secondary w-100"
                      onClick={() => {
                        setFilters({ ano: '', busca: '' });
                        setPagination({ ...pagination, currentPage: 1 });
                      }}
                    >
                      Limpar
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {loading ? (
          <div className="text-center my-5">
            <div className="br-loading"></div>
            <p className="mt-3">Carregando acervo...</p>
          </div>
        ) : acervos.length === 0 ? (
          <div className="br-message warning">
            <div className="content">
              <span className="message-title">Nenhum resultado encontrado</span>
              <span className="message-body">
                Tente ajustar os filtros de busca ou limpar para ver todos os itens.
              </span>
            </div>
          </div>
        ) : (
          <>
            <div className="row">
              <div className="col-12 mb-3">
                <p className="text-muted">
                  Exibindo {acervos.length} de {pagination.total} resultados
                </p>
              </div>
            </div>
            
            <div className="row">
              {acervos.map((acervo) => (
                <div key={acervo._id} className="col-md-6 col-lg-4 mb-4">
                  <div className="br-card">
                    <div className="card-header">
                      <span className="br-tag primary small">{acervo.anoEvento}</span>
                    </div>
                    <div className="card-content">
                      <h4 className="mb-2">{acervo.titulo}</h4>
                      
                      {acervo.autores && acervo.autores.length > 0 && (
                        <div className="mb-2">
                          <strong className="text-muted" style={{ fontSize: '0.875rem' }}>
                            <i className="fas fa-users mr-1"></i>
                            Autores:
                          </strong>
                          <p className="mb-0" style={{ fontSize: '0.875rem' }}>
                            {acervo.autores.join(', ')}
                          </p>
                        </div>
                      )}
                      
                      {acervo.palavras_chave && acervo.palavras_chave.length > 0 && (
                        <div className="mb-3">
                          <strong className="text-muted" style={{ fontSize: '0.875rem' }}>
                            <i className="fas fa-tags mr-1"></i>
                            Palavras-chave:
                          </strong>
                          <div className="mt-1">
                            {acervo.palavras_chave.map((palavra, idx) => (
                              <span key={idx} className="br-tag small mr-1 mb-1">
                                {palavra}
                              </span>
                            ))}
                          </div>
                        </div>
                      )}
                    </div>
                    {acervo.arquivo && (
                      <div className="card-footer">
                        <a
                          href={`${import.meta.env.VITE_API_URL}/uploads/${acervo.arquivo}`}
                          target="_blank"
                          rel="noopener noreferrer"
                          className="br-button secondary small"
                        >
                          <i className="fas fa-file-pdf mr-1"></i>
                          Visualizar Arquivo
                        </a>
                      </div>
                    )}
                  </div>
                </div>
              ))}
            </div>

            {pagination.totalPages > 1 && (
              <div className="d-flex justify-content-center mt-4">
                <div className="br-pagination">
                  <button
                    className="br-button circle"
                    disabled={pagination.currentPage === 1}
                    onClick={() => setPagination({ ...pagination, currentPage: pagination.currentPage - 1 })}
                  >
                    <i className="fas fa-chevron-left"></i>
                  </button>
                  <span className="mx-3">
                    Página {pagination.currentPage} de {pagination.totalPages}
                  </span>
                  <button
                    className="br-button circle"
                    disabled={pagination.currentPage === pagination.totalPages}
                    onClick={() => setPagination({ ...pagination, currentPage: pagination.currentPage + 1 })}
                  >
                    <i className="fas fa-chevron-right"></i>
                  </button>
                </div>
              </div>
            )}
          </>
        )}
      </div>
    </MainLayout>
  );
};

export default Acervo;
