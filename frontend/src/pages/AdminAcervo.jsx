import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

const AdminAcervo = () => {
  const { showSuccess, showError } = useNotification();
  const [acervos, setAcervos] = useState([]);
  const [loading, setLoading] = useState(true);
  const [showModal, setShowModal] = useState(false);
  const [editingId, setEditingId] = useState(null);
  const [pagination, setPagination] = useState({ currentPage: 1, totalPages: 1, total: 0 });
  const [filters, setFilters] = useState({ ano: '', busca: '' });
  
  const [formData, setFormData] = useState({
    titulo: '',
    anoEvento: new Date().getFullYear(),
    autores: '',
    palavras_chave: '',
    arquivo: null
  });

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
      
      const response = await api.get('/admin/acervo', { params });
      setAcervos(response.data.acervos);
      setPagination({
        currentPage: response.data.currentPage,
        totalPages: response.data.totalPages,
        total: response.data.total
      });
    } catch (error) {
      console.error('Erro ao carregar acervos:', error);
      showError('Erro ao carregar acervos');
    } finally {
      setLoading(false);
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    
    try {
      const formDataToSend = new FormData();
      formDataToSend.append('titulo', formData.titulo);
      formDataToSend.append('anoEvento', formData.anoEvento);
      formDataToSend.append('autores', formData.autores);
      formDataToSend.append('palavras_chave', formData.palavras_chave);
      
      if (formData.arquivo) {
        formDataToSend.append('arquivo', formData.arquivo);
      }

      if (editingId) {
        await api.put(`/admin/acervo/${editingId}`, formDataToSend, {
          headers: { 'Content-Type': 'multipart/form-data' }
        });
        showSuccess('Item atualizado com sucesso!');
      } else {
        await api.post('/admin/acervo', formDataToSend, {
          headers: { 'Content-Type': 'multipart/form-data' }
        });
        showSuccess('Item criado com sucesso!');
      }

      setShowModal(false);
      resetForm();
      carregarAcervos();
    } catch (error) {
      console.error('Erro ao salvar:', error);
      showError(error.response?.data?.message || 'Erro ao salvar item');
    }
  };

  const handleEdit = async (id) => {
    try {
      const response = await api.get(`/admin/acervo/${id}`);
      const acervo = response.data;
      
      setFormData({
        titulo: acervo.titulo,
        anoEvento: acervo.anoEvento,
        autores: acervo.autores.join(', '),
        palavras_chave: acervo.palavras_chave.join(', '),
        arquivo: null
      });
      setEditingId(id);
      setShowModal(true);
    } catch (error) {
      console.error('Erro ao carregar item:', error);
      showError('Erro ao carregar item');
    }
  };

  const handleDelete = async (id) => {
    if (!confirm('Tem certeza que deseja excluir este item?')) return;

    try {
      await api.delete(`/admin/acervo/${id}`);
      showSuccess('Item excluído com sucesso!');
      carregarAcervos();
    } catch (error) {
      console.error('Erro ao excluir:', error);
      showError('Erro ao excluir item');
    }
  };

  const resetForm = () => {
    setFormData({
      titulo: '',
      anoEvento: new Date().getFullYear(),
      autores: '',
      palavras_chave: '',
      arquivo: null
    });
    setEditingId(null);
  };

  const handleFileChange = (e) => {
    setFormData({ ...formData, arquivo: e.target.files[0] });
  };

  return (
    <MainLayout>
      <div className="container-lg my-4">
        <div className="row mb-4">
          <div className="col">
            <nav className="br-breadcrumb" aria-label="Breadcrumbs">
              <ol className="crumb-list" role="list">
                <li className="crumb home"><Link to="/">Início</Link></li>
                <li className="crumb" data-active="active"><span>Admin - Acervo</span></li>
              </ol>
            </nav>
          </div>
        </div>

        <div className="row mb-4">
          <div className="col">
            <h1 className="mb-4">Gerenciar Acervo</h1>
            
            <div className="br-card">
              <div className="card-header d-flex justify-content-between align-items-center">
                <h3>Filtros</h3>
                <button 
                  className="br-button primary"
                  onClick={() => {
                    resetForm();
                    setShowModal(true);
                  }}
                >
                  <i className="fas fa-plus mr-1"></i>
                  Novo Item
                </button>
              </div>
              
              <div className="card-content">
                <div className="row">
                  <div className="col-md-3">
                    <div className="br-input">
                      <label htmlFor="filtro-ano">Ano</label>
                      <input
                        id="filtro-ano"
                        type="number"
                        value={filters.ano}
                        onChange={(e) => setFilters({ ...filters, ano: e.target.value })}
                        placeholder="Ex: 2024"
                      />
                    </div>
                  </div>
                  <div className="col-md-6">
                    <div className="br-input">
                      <label htmlFor="filtro-busca">Buscar</label>
                      <input
                        id="filtro-busca"
                        type="text"
                        value={filters.busca}
                        onChange={(e) => setFilters({ ...filters, busca: e.target.value })}
                        placeholder="Título, autor ou palavra-chave"
                      />
                    </div>
                  </div>
                  <div className="col-md-3 d-flex align-items-end">
                    <button
                      className="br-button secondary"
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
          </div>
        ) : (
          <>
            <div className="br-table">
              <table>
                <thead>
                  <tr>
                    <th>Título</th>
                    <th>Ano</th>
                    <th>Autores</th>
                    <th>Arquivo</th>
                    <th width="150">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  {acervos.length === 0 ? (
                    <tr>
                      <td colSpan="5" className="text-center">
                        Nenhum item encontrado
                      </td>
                    </tr>
                  ) : (
                    acervos.map((acervo) => (
                      <tr key={acervo._id}>
                        <td>{acervo.titulo}</td>
                        <td>{acervo.anoEvento}</td>
                        <td>{acervo.autores.join(', ')}</td>
                        <td>
                          {acervo.arquivo ? (
                            <a 
                              href={`${import.meta.env.VITE_API_URL}/uploads/${acervo.arquivo}`}
                              target="_blank"
                              rel="noopener noreferrer"
                              className="br-button circle small"
                            >
                              <i className="fas fa-file-pdf"></i>
                            </a>
                          ) : (
                            <span className="text-muted">Sem arquivo</span>
                          )}
                        </td>
                        <td>
                          <button
                            className="br-button circle small mr-1"
                            onClick={() => handleEdit(acervo._id)}
                            title="Editar"
                          >
                            <i className="fas fa-edit"></i>
                          </button>
                          <button
                            className="br-button circle small"
                            onClick={() => handleDelete(acervo._id)}
                            title="Excluir"
                          >
                            <i className="fas fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                    ))
                  )}
                </tbody>
              </table>
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

      {showModal && (
        <>
          <div className="br-scrim fundo-modal" onClick={() => setShowModal(false)}></div>
          <div className="br-modal medium modal-centralizado">
            <div className="br-modal-header">
              <div className="br-modal-title">{editingId ? 'Editar' : 'Novo'} Item do Acervo</div>
            </div>
            <div className="br-modal-body">
              <form onSubmit={handleSubmit}>
                <div className="row">
                  <div className="col-12 mb-3">
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
                  
                  <div className="col-md-6 mb-3">
                    <div className="br-input">
                      <label htmlFor="anoEvento">Ano do Evento *</label>
                      <input
                        id="anoEvento"
                        type="number"
                        value={formData.anoEvento}
                        onChange={(e) => setFormData({ ...formData, anoEvento: e.target.value })}
                        required
                      />
                    </div>
                  </div>
                  
                  <div className="col-md-6 mb-3">
                    <div className="br-input">
                      <label htmlFor="autores">Autores (separados por vírgula)</label>
                      <input
                        id="autores"
                        type="text"
                        value={formData.autores}
                        onChange={(e) => setFormData({ ...formData, autores: e.target.value })}
                        placeholder="Ex: João Silva, Maria Santos"
                      />
                    </div>
                  </div>
                  
                  <div className="col-12 mb-3">
                    <div className="br-input">
                      <label htmlFor="palavras_chave">Palavras-chave (separadas por vírgula)</label>
                      <input
                        id="palavras_chave"
                        type="text"
                        value={formData.palavras_chave}
                        onChange={(e) => setFormData({ ...formData, palavras_chave: e.target.value })}
                        placeholder="Ex: educação, tecnologia, inovação"
                      />
                    </div>
                  </div>
                  
                  <div className="col-12 mb-3">
                    <div className="br-input">
                      <label htmlFor="arquivo">Arquivo (PDF, DOC, DOCX - máx 50MB)</label>
                      <input
                        id="arquivo"
                        type="file"
                        accept=".pdf,.doc,.docx"
                        onChange={handleFileChange}
                      />
                      {editingId && <small className="text-muted">Deixe em branco para manter o arquivo atual</small>}
                    </div>
                  </div>
                </div>

                <div className="br-modal-footer d-flex justify-content-end">
                  <button
                    type="button"
                    className="br-button secondary mr-2"
                    onClick={() => {
                      setShowModal(false);
                      resetForm();
                    }}
                  >
                    Cancelar
                  </button>
                  <button type="submit" className="br-button primary">
                    {editingId ? 'Atualizar' : 'Criar'}
                  </button>
                </div>
              </form>
            </div>
          </div>
        </>
      )}
    </MainLayout>
  );
};

export default AdminAcervo;
