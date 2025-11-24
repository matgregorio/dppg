import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { useForm, FormProvider } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import MainLayout from '../layouts/MainLayout';
import { FormInput, FormSelect } from '../components/forms';
import api from '../services/api';

const apoioSchema = z.object({
  nome: z.string().min(3, 'Nome deve ter no mínimo 3 caracteres'),
  sigla: z.string().optional(),
  tipo: z.enum(['FINANCEIRO', 'INSTITUCIONAL', 'LOGISTICO', 'OUTRO']),
});

const AdminApoios = () => {
  const [apoios, setApoios] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  const [showModal, setShowModal] = useState(false);
  const [editingItem, setEditingItem] = useState(null);
  
  const methods = useForm({ resolver: zodResolver(apoioSchema) });
  
  const tiposApoio = [
    { value: 'FINANCEIRO', label: 'Financeiro' },
    { value: 'INSTITUCIONAL', label: 'Institucional' },
    { value: 'LOGISTICO', label: 'Logístico' },
    { value: 'OUTRO', label: 'Outro' },
  ];
  
  useEffect(() => {
    fetchData();
  }, []);
  
  const fetchData = async () => {
    try {
      setLoading(true);
      const res = await api.get('/admin/apoios');
      
      if (res.data.success) {
        setApoios(res.data.data);
      }
    } catch (err) {
      console.error('Erro ao carregar apoios:', err);
      setError('Erro ao carregar apoios: ' + (err.response?.data?.message || err.message));
    } finally {
      setLoading(false);
    }
  };
  
  const handleCreate = () => {
    setEditingItem(null);
    methods.reset({ nome: '', sigla: '', tipo: 'FINANCEIRO' });
    setShowModal(true);
  };
  
  const handleEdit = (item) => {
    setEditingItem(item);
    methods.reset({
      nome: item.nome,
      sigla: item.sigla || '',
      tipo: item.tipo,
    });
    setShowModal(true);
  };
  
  const onSubmit = async (data) => {
    try {
      setError('');
      setSuccess('');
      
      if (editingItem) {
        await api.put(`/admin/apoios/${editingItem._id}`, data);
        setSuccess('Apoio atualizado!');
      } else {
        await api.post('/admin/apoios', data);
        setSuccess('Apoio cadastrado!');
      }
      
      fetchData();
      setShowModal(false);
      methods.reset();
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao salvar');
    }
  };
  
  const handleDelete = async (id) => {
    if (!confirm('Tem certeza que deseja excluir este apoio?')) return;
    
    try {
      setError('');
      setSuccess('');
      
      await api.delete(`/admin/apoios/${id}`);
      setSuccess('Apoio excluído!');
      
      fetchData();
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao excluir');
    }
  };
  
  const getTipoLabel = (tipo) => {
    const item = tiposApoio.find(t => t.value === tipo);
    return item ? item.label : tipo;
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
            <span>Apoios</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <div className="d-flex justify-content-between align-items-center mb-4">
          <h1 className="text-up-03 text-weight-bold">Apoios</h1>
          <button
            onClick={handleCreate}
            className="br-button primary"
          >
            <i className="fas fa-plus mr-2"></i>Novo Apoio
          </button>
        </div>
        
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
        
        {loading ? (
          <div className="text-center py-5">
            <div className="br-loading"></div>
            <p className="mt-3">Carregando apoios...</p>
          </div>
        ) : (
          <div className="br-table">
            <table>
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Sigla</th>
                  <th>Tipo</th>
                  <th style={{ width: '150px' }}>Ações</th>
                </tr>
              </thead>
              <tbody>
                {apoios.length === 0 ? (
                  <tr>
                    <td colSpan="4" className="text-center py-4">
                      Nenhum apoio cadastrado
                    </td>
                  </tr>
                ) : (
                  apoios.map((item) => (
                    <tr key={item._id}>
                      <td>{item.nome}</td>
                      <td>{item.sigla || '-'}</td>
                      <td>{getTipoLabel(item.tipo)}</td>
                      <td>
                        <button
                          onClick={() => handleEdit(item)}
                          className="br-button circle small"
                          title="Editar"
                        >
                          <i className="fas fa-edit"></i>
                        </button>
                        <button
                          onClick={() => handleDelete(item._id)}
                          className="br-button circle small ml-2"
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
        )}
      </div>
      
      {/* Modal */}
      {showModal && (
        <>
          <div className="br-scrim" onClick={() => setShowModal(false)}></div>
          <div className="br-modal medium" style={{ display: 'block' }}>
            <div className="br-modal-header">
              <h4>{editingItem ? 'Editar' : 'Novo'} Apoio</h4>
            </div>
            <FormProvider {...methods}>
              <form onSubmit={methods.handleSubmit(onSubmit)}>
                <div className="br-modal-body">
                  <FormInput name="nome" label="Nome" required />
                  <FormInput name="sigla" label="Sigla" placeholder="Ex: FAPESP, CNPq..." />
                  <FormSelect
                    name="tipo"
                    label="Tipo de Apoio"
                    required
                    options={tiposApoio}
                  />
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
                    <i className="fas fa-save mr-2"></i>
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

export default AdminApoios;
