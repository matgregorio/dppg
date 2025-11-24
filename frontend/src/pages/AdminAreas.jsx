import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { useForm, FormProvider } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import MainLayout from '../layouts/MainLayout';
import { FormInput, FormSelect } from '../components/forms';
import api from '../services/api';

const grandeAreaSchema = z.object({
  nome: z.string().min(3, 'Nome deve ter no mínimo 3 caracteres'),
});

const areaAtuacaoSchema = z.object({
  nome: z.string().min(3, 'Nome deve ter no mínimo 3 caracteres'),
  grandeArea: z.string().min(1, 'Selecione uma Grande Área'),
});

const subareaSchema = z.object({
  nome: z.string().min(3, 'Nome deve ter no mínimo 3 caracteres'),
  areaAtuacao: z.string().min(1, 'Selecione uma Área de Atuação'),
});

const AdminAreas = () => {
  const [activeTab, setActiveTab] = useState('grandeAreas');
  const [grandeAreas, setGrandeAreas] = useState([]);
  const [areasAtuacao, setAreasAtuacao] = useState([]);
  const [subareas, setSubareas] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  const [showModal, setShowModal] = useState(false);
  const [editingItem, setEditingItem] = useState(null);
  
  const grandeAreaMethods = useForm({ resolver: zodResolver(grandeAreaSchema) });
  const areaAtuacaoMethods = useForm({ resolver: zodResolver(areaAtuacaoSchema) });
  const subareaMethods = useForm({ resolver: zodResolver(subareaSchema) });
  
  useEffect(() => {
    fetchData();
  }, []);
  
  const fetchData = async () => {
    try {
      setLoading(true);
      const [gaRes, aaRes, saRes] = await Promise.all([
        api.get('/admin/grandes-areas'),
        api.get('/admin/areas-atuacao'),
        api.get('/admin/subareas'),
      ]);
      
      if (gaRes.data.success) setGrandeAreas(gaRes.data.data);
      if (aaRes.data.success) setAreasAtuacao(aaRes.data.data);
      if (saRes.data.success) setSubareas(saRes.data.data);
    } catch (err) {
      console.error('Erro ao carregar dados:', err);
      setError('Erro ao carregar dados: ' + (err.response?.data?.message || err.message));
    } finally {
      setLoading(false);
    }
  };
  
  const handleCreate = (type) => {
    setEditingItem(null);
    if (type === 'grandeArea') grandeAreaMethods.reset({ nome: '' });
    if (type === 'areaAtuacao') areaAtuacaoMethods.reset({ nome: '', grandeArea: '' });
    if (type === 'subarea') subareaMethods.reset({ nome: '', areaAtuacao: '' });
    setShowModal(type);
  };
  
  const handleEdit = (item, type) => {
    setEditingItem(item);
    if (type === 'grandeArea') grandeAreaMethods.reset({ nome: item.nome });
    if (type === 'areaAtuacao') {
      areaAtuacaoMethods.reset({
        nome: item.nome,
        grandeArea: item.grandeArea?._id || item.grandeArea,
      });
    }
    if (type === 'subarea') {
      subareaMethods.reset({
        nome: item.nome,
        areaAtuacao: item.areaAtuacao?._id || item.areaAtuacao,
      });
    }
    setShowModal(type);
  };
  
  const onSubmitGrandeArea = async (data) => {
    try {
      setError('');
      setSuccess('');
      
      if (editingItem) {
        await api.put(`/admin/grandes-areas/${editingItem._id}`, data);
        setSuccess('Grande Área atualizada!');
      } else {
        await api.post('/admin/grandes-areas', data);
        setSuccess('Grande Área criada!');
      }
      
      fetchData();
      setShowModal(false);
      grandeAreaMethods.reset();
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao salvar');
    }
  };
  
  const onSubmitAreaAtuacao = async (data) => {
    try {
      setError('');
      setSuccess('');
      
      if (editingItem) {
        await api.put(`/admin/areas-atuacao/${editingItem._id}`, data);
        setSuccess('Área de Atuação atualizada!');
      } else {
        await api.post('/admin/areas-atuacao', data);
        setSuccess('Área de Atuação criada!');
      }
      
      fetchData();
      setShowModal(false);
      areaAtuacaoMethods.reset();
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao salvar');
    }
  };
  
  const onSubmitSubarea = async (data) => {
    try {
      setError('');
      setSuccess('');
      
      if (editingItem) {
        await api.put(`/admin/subareas/${editingItem._id}`, data);
        setSuccess('Subárea atualizada!');
      } else {
        await api.post('/admin/subareas', data);
        setSuccess('Subárea criada!');
      }
      
      fetchData();
      setShowModal(false);
      subareaMethods.reset();
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao salvar');
    }
  };
  
  const handleDelete = async (id, type) => {
    if (!confirm('Tem certeza que deseja excluir?')) return;
    
    try {
      setError('');
      setSuccess('');
      
      if (type === 'grandeArea') {
        await api.delete(`/admin/grandes-areas/${id}`);
        setSuccess('Grande Área excluída!');
      } else if (type === 'areaAtuacao') {
        await api.delete(`/admin/areas-atuacao/${id}`);
        setSuccess('Área de Atuação excluída!');
      } else if (type === 'subarea') {
        await api.delete(`/admin/subareas/${id}`);
        setSuccess('Subárea excluída!');
      }
      
      fetchData();
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao excluir');
    }
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
            <span>Áreas de Conhecimento</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">Áreas de Conhecimento</h1>
        
        {error && (
          <div className="br-message danger mb-3" role="alert">
            <div className="icon"><i className="fas fa-times-circle fa-lg"></i></div>
            <div className="content">{error}</div>
          </div>
        )}
        
        {success && (
          <div className="br-message success mb-3" role="alert">
            <div className="icon"><i className="fas fa-check-circle fa-lg"></i></div>
            <div className="content">{success}</div>
          </div>
        )}
        
        <div className="br-tab">
          <nav className="tab-nav">
            <ul>
              <li
                className={`tab-item ${activeTab === 'grandeAreas' ? 'active' : ''}`}
                onClick={() => setActiveTab('grandeAreas')}
              >
                <button type="button">Grandes Áreas</button>
              </li>
              <li
                className={`tab-item ${activeTab === 'areasAtuacao' ? 'active' : ''}`}
                onClick={() => setActiveTab('areasAtuacao')}
              >
                <button type="button">Áreas de Atuação</button>
              </li>
              <li
                className={`tab-item ${activeTab === 'subareas' ? 'active' : ''}`}
                onClick={() => setActiveTab('subareas')}
              >
                <button type="button">Subáreas</button>
              </li>
            </ul>
          </nav>
          
          <div className="tab-content">
            {activeTab === 'grandeAreas' && (
              <div className="tab-panel active">
                <div className="d-flex justify-content-end mb-3">
                  <button
                    onClick={() => handleCreate('grandeArea')}
                    className="br-button primary"
                  >
                    <i className="fas fa-plus mr-2"></i>Nova Grande Área
                  </button>
                </div>
                
                {loading ? (
                  <div className="text-center"><div className="br-loading"></div></div>
                ) : (
                  <div className="br-table">
                    <table>
                      <thead>
                        <tr>
                          <th>Nome</th>
                          <th style={{ width: '150px' }}>Ações</th>
                        </tr>
                      </thead>
                      <tbody>
                        {grandeAreas.map((item) => (
                          <tr key={item._id}>
                            <td>{item.nome}</td>
                            <td>
                              <button
                                onClick={() => handleEdit(item, 'grandeArea')}
                                className="br-button circle small"
                                title="Editar"
                              >
                                <i className="fas fa-edit"></i>
                              </button>
                              <button
                                onClick={() => handleDelete(item._id, 'grandeArea')}
                                className="br-button circle small ml-2"
                                title="Excluir"
                              >
                                <i className="fas fa-trash"></i>
                              </button>
                            </td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                )}
              </div>
            )}
            
            {activeTab === 'areasAtuacao' && (
              <div className="tab-panel active">
                <div className="d-flex justify-content-end mb-3">
                  <button
                    onClick={() => handleCreate('areaAtuacao')}
                    className="br-button primary"
                  >
                    <i className="fas fa-plus mr-2"></i>Nova Área de Atuação
                  </button>
                </div>
                
                {loading ? (
                  <div className="text-center"><div className="br-loading"></div></div>
                ) : (
                  <div className="br-table">
                    <table>
                      <thead>
                        <tr>
                          <th>Nome</th>
                          <th>Grande Área</th>
                          <th style={{ width: '150px' }}>Ações</th>
                        </tr>
                      </thead>
                      <tbody>
                        {areasAtuacao.map((item) => (
                          <tr key={item._id}>
                            <td>{item.nome}</td>
                            <td>{item.grandeArea?.nome || 'N/A'}</td>
                            <td>
                              <button
                                onClick={() => handleEdit(item, 'areaAtuacao')}
                                className="br-button circle small"
                                title="Editar"
                              >
                                <i className="fas fa-edit"></i>
                              </button>
                              <button
                                onClick={() => handleDelete(item._id, 'areaAtuacao')}
                                className="br-button circle small ml-2"
                                title="Excluir"
                              >
                                <i className="fas fa-trash"></i>
                              </button>
                            </td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                )}
              </div>
            )}
            
            {activeTab === 'subareas' && (
              <div className="tab-panel active">
                <div className="d-flex justify-content-end mb-3">
                  <button
                    onClick={() => handleCreate('subarea')}
                    className="br-button primary"
                  >
                    <i className="fas fa-plus mr-2"></i>Nova Subárea
                  </button>
                </div>
                
                {loading ? (
                  <div className="text-center"><div className="br-loading"></div></div>
                ) : (
                  <div className="br-table">
                    <table>
                      <thead>
                        <tr>
                          <th>Nome</th>
                          <th>Área de Atuação</th>
                          <th style={{ width: '150px' }}>Ações</th>
                        </tr>
                      </thead>
                      <tbody>
                        {subareas.map((item) => (
                          <tr key={item._id}>
                            <td>{item.nome}</td>
                            <td>{item.areaAtuacao?.nome || 'N/A'}</td>
                            <td>
                              <button
                                onClick={() => handleEdit(item, 'subarea')}
                                className="br-button circle small"
                                title="Editar"
                              >
                                <i className="fas fa-edit"></i>
                              </button>
                              <button
                                onClick={() => handleDelete(item._id, 'subarea')}
                                className="br-button circle small ml-2"
                                title="Excluir"
                              >
                                <i className="fas fa-trash"></i>
                              </button>
                            </td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                )}
              </div>
            )}
          </div>
        </div>
      </div>
      
      {/* Modal Grande Área */}
      {showModal === 'grandeArea' && (
        <>
          <div className="br-scrim" onClick={() => setShowModal(false)}></div>
          <div className="br-modal medium" style={{ display: 'block' }}>
            <div className="br-modal-header">
              <h4>{editingItem ? 'Editar' : 'Nova'} Grande Área</h4>
            </div>
            <FormProvider {...grandeAreaMethods}>
              <form onSubmit={grandeAreaMethods.handleSubmit(onSubmitGrandeArea)}>
                <div className="br-modal-body">
                  <FormInput name="nome" label="Nome" required />
                </div>
                <div className="br-modal-footer">
                  <button type="button" className="br-button secondary" onClick={() => setShowModal(false)}>
                    Cancelar
                  </button>
                  <button type="submit" className="br-button primary">
                    Salvar
                  </button>
                </div>
              </form>
            </FormProvider>
          </div>
        </>
      )}
      
      {/* Modal Área Atuação */}
      {showModal === 'areaAtuacao' && (
        <>
          <div className="br-scrim" onClick={() => setShowModal(false)}></div>
          <div className="br-modal medium" style={{ display: 'block' }}>
            <div className="br-modal-header">
              <h4>{editingItem ? 'Editar' : 'Nova'} Área de Atuação</h4>
            </div>
            <FormProvider {...areaAtuacaoMethods}>
              <form onSubmit={areaAtuacaoMethods.handleSubmit(onSubmitAreaAtuacao)}>
                <div className="br-modal-body">
                  <FormInput name="nome" label="Nome" required />
                  <FormSelect
                    name="grandeArea"
                    label="Grande Área"
                    required
                    options={grandeAreas.map((ga) => ({ value: ga._id, label: ga.nome }))}
                  />
                </div>
                <div className="br-modal-footer">
                  <button type="button" className="br-button secondary" onClick={() => setShowModal(false)}>
                    Cancelar
                  </button>
                  <button type="submit" className="br-button primary">
                    Salvar
                  </button>
                </div>
              </form>
            </FormProvider>
          </div>
        </>
      )}
      
      {/* Modal Subárea */}
      {showModal === 'subarea' && (
        <>
          <div className="br-scrim" onClick={() => setShowModal(false)}></div>
          <div className="br-modal medium" style={{ display: 'block' }}>
            <div className="br-modal-header">
              <h4>{editingItem ? 'Editar' : 'Nova'} Subárea</h4>
            </div>
            <FormProvider {...subareaMethods}>
              <form onSubmit={subareaMethods.handleSubmit(onSubmitSubarea)}>
                <div className="br-modal-body">
                  <FormInput name="nome" label="Nome" required />
                  <FormSelect
                    name="areaAtuacao"
                    label="Área de Atuação"
                    required
                    options={areasAtuacao.map((aa) => ({ value: aa._id, label: aa.nome }))}
                  />
                </div>
                <div className="br-modal-footer">
                  <button type="button" className="br-button secondary" onClick={() => setShowModal(false)}>
                    Cancelar
                  </button>
                  <button type="submit" className="br-button primary">
                    Salvar
                  </button>
                </div>
              </form>
            </FormProvider>
          </div>
        </>
      )}
    </MainLayout>
  );
};

export default AdminAreas;
