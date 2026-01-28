import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { useForm, FormProvider, Controller } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import { BrSelect } from '@govbr-ds/react-components';
import MainLayout from '../layouts/MainLayout';
import { FormInput } from '../components/forms';
import api from '../services/api';

const areaAtuacaoSchema = z.object({
  nome: z.string().min(3, 'Nome deve ter no mínimo 3 caracteres'),
});

const subareaSchema = z.object({
  nome: z.string().min(3, 'Nome deve ter no mínimo 3 caracteres'),
  areaAtuacao: z.string().min(1, 'Selecione uma Área de Atuação'),
});

const AdminAreas = () => {
  const [activeTab, setActiveTab] = useState('areasAtuacao');
  const [areasAtuacao, setAreasAtuacao] = useState([]);
  const [subareas, setSubareas] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  const [showModal, setShowModal] = useState(false);
  const [editingItem, setEditingItem] = useState(null);
  
  const areaAtuacaoMethods = useForm({ resolver: zodResolver(areaAtuacaoSchema) });
  const subareaMethods = useForm({ resolver: zodResolver(subareaSchema) });
  
  useEffect(() => {
    fetchData();
  }, []);
  
  const fetchData = async () => {
    try {
      setLoading(true);
      const [aaRes, saRes] = await Promise.all([
        api.get('/admin/areas-atuacao'),
        api.get('/admin/subareas'),
      ]);
      
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
    if (type === 'areaAtuacao') areaAtuacaoMethods.reset({ nome: '' });
    if (type === 'subarea') subareaMethods.reset({ nome: '', areaAtuacao: '' });
    setShowModal(type);
  };
  
  const handleEdit = (item, type) => {
    setEditingItem(item);
    if (type === 'areaAtuacao') areaAtuacaoMethods.reset({ nome: item.nome });
    if (type === 'subarea') {
      subareaMethods.reset({
        nome: item.nome,
        areaAtuacao: item.areaAtuacao?._id || item.areaAtuacao,
      });
    }
    setShowModal(type);
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
      
      if (type === 'areaAtuacao') {
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
            <Link to="/area-administrativa">Área Administrativa</Link>
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
                          <th style={{ width: '150px' }}>Ações</th>
                        </tr>
                      </thead>
                      <tbody>
                        {areasAtuacao.map((item) => (
                          <tr key={item._id}>
                            <td>{item.nome}</td>
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
      
      {/* Modal Área Atuação */}
      {showModal === 'areaAtuacao' && (
        <>
          <div className="br-scrim-util foco" onClick={() => setShowModal(false)} style={{ backgroundColor: 'rgba(0, 0, 0, 0.7)', position: 'fixed', top: 0, left: 0, right: 0, bottom: 0, zIndex: 9998, display: 'block' }}></div>
          <div className="br-modal large" style={{ display: 'block', position: 'fixed', top: '50%', left: '50%', transform: 'translate(-50%, -50%)', zIndex: 9999, maxWidth: '600px', width: '90%' }}>
            <div className="br-modal-header">
              <h4>{editingItem ? 'Editar' : 'Nova'} Área de Atuação</h4>
            </div>
            <FormProvider {...areaAtuacaoMethods}>
              <form onSubmit={areaAtuacaoMethods.handleSubmit(onSubmitAreaAtuacao)}>
                <div className="br-modal-body">
                  <FormInput name="nome" label="Nome" required placeholder="Ex: Ciências Exatas e da Terra" />
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
      {/* Modal Subárea - CORRIGIDO */}
{showModal === 'subarea' && (
  <>
    <div className="br-scrim-util foco" onClick={() => setShowModal(false)} style={{ backgroundColor: 'rgba(0, 0, 0, 0.7)', position: 'fixed', top: 0, left: 0, right: 0, bottom: 0, zIndex: 9998, display: 'block' }}></div>
    <div className="br-modal large" style={{ 
      display: 'block', 
      position: 'fixed', 
      top: '50%', 
      left: '50%', 
      transform: 'translate(-50%, -50%)', 
      zIndex: 9999, 
      maxWidth: '600px', 
      width: '90%',
      maxHeight: '90vh',
      overflow: 'visible' // MUDANÇA AQUI
    }}>
      <div className="br-modal-header">
        <h4>{editingItem ? 'Editar' : 'Nova'} Subárea</h4>
      </div>
      <FormProvider {...subareaMethods}>
        <form onSubmit={subareaMethods.handleSubmit(onSubmitSubarea)}>
          <div className="br-modal-body" style={{ 
            minHeight: '300px', // MUDANÇA AQUI
            overflow: 'visible', // MUDANÇA AQUI
            paddingBottom: '20px' // MUDANÇA AQUI
          }}>
            <FormInput name="nome" label="Nome" required placeholder="Ex: Matemática, Física, Química" />
            
            <div className="mb-3" style={{ position: 'relative', zIndex: 1000 }}> {/* MUDANÇA AQUI */}
              <Controller
                name="areaAtuacao"
                control={subareaMethods.control}
                rules={{ required: 'Selecione uma Área de Atuação' }}
                render={({ field, fieldState: { error } }) => (
                  <>
                    <BrSelect
                      label="Área de Atuação *"
                      placeholder="Selecione uma Área de Atuação"
                      options={areasAtuacao.map(aa => ({ 
                        label: aa.nome, 
                        value: aa._id 
                      }))}
                      onChange={(value) => field.onChange(value)}
                      value={field.value}
                      emptyOptionsMessage="Nenhuma área encontrada"
                      type="single"
                      state={error ? 'danger' : undefined}
                      required
                    />
                    {error && (
                      <span className="feedback danger" role="alert">
                        <i className="fas fa-times-circle" aria-hidden="true"></i>
                        {error.message}
                      </span>
                    )}
                  </>
                )}
              />
            </div>
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