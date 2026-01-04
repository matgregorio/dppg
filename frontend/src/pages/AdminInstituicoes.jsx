import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { useForm, FormProvider } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import MainLayout from '../layouts/MainLayout';
import { FormInput } from '../components/forms';
import api from '../services/api';

const instituicaoSchema = z.object({
  nome: z.string().min(3, 'Nome deve ter no mínimo 3 caracteres'),
  sigla: z.string().optional(),
  cidade: z.string().optional(),
  estado: z.string().max(2, 'Use a sigla do estado (ex: SP)').optional(),
});

const AdminInstituicoes = () => {
  const [instituicoes, setInstituicoes] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  const [showModal, setShowModal] = useState(false);
  const [editingItem, setEditingItem] = useState(null);
  
  const methods = useForm({ resolver: zodResolver(instituicaoSchema) });
  
  useEffect(() => {
    fetchData();
  }, []);
  
  const fetchData = async () => {
    try {
      setLoading(true);
      const res = await api.get('/admin/instituicoes');
      
      if (res.data.success) {
        setInstituicoes(res.data.data);
      }
    } catch (err) {
      console.error('Erro ao carregar instituições:', err);
      setError('Erro ao carregar instituições: ' + (err.response?.data?.message || err.message));
    } finally {
      setLoading(false);
    }
  };
  
  const handleCreate = () => {
    setEditingItem(null);
    methods.reset({ nome: '', sigla: '', cidade: '', estado: '' });
    setShowModal(true);
  };
  
  const handleEdit = (item) => {
    setEditingItem(item);
    methods.reset({
      nome: item.nome,
      sigla: item.sigla || '',
      cidade: item.cidade || '',
      estado: item.estado || '',
    });
    setShowModal(true);
  };
  
  const onSubmit = async (data) => {
    try {
      setError('');
      setSuccess('');
      
      if (editingItem) {
        await api.put(`/admin/instituicoes/${editingItem._id}`, data);
        setSuccess('Instituição atualizada!');
      } else {
        await api.post('/admin/instituicoes', data);
        setSuccess('Instituição criada!');
      }
      
      fetchData();
      setShowModal(false);
      methods.reset();
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao salvar');
    }
  };
  
  const handleDelete = async (id) => {
    if (!confirm('Tem certeza que deseja excluir esta instituição?')) return;
    
    try {
      setError('');
      setSuccess('');
      
      await api.delete(`/admin/instituicoes/${id}`);
      setSuccess('Instituição excluída!');
      
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
            <i className="icon fas fa-chevron-right"></i>            <Link to="/area-administrativa">Área Administrativa</Link>
          </li>
          <li className="crumb">
            <i className="icon fas fa-chevron-right"></i>            <span>Instituições</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <div className="d-flex justify-content-between align-items-center mb-4">
          <h1 className="text-up-03 text-weight-bold">Instituições</h1>
          <button
            onClick={handleCreate}
            className="br-button primary"
          >
            <i className="fas fa-plus mr-2"></i>Nova Instituição
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
            <p className="mt-3">Carregando instituições...</p>
          </div>
        ) : (
          <div className="br-table">
            <table>
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Sigla</th>
                  <th>Cidade</th>
                  <th>Estado</th>
                  <th style={{ width: '150px' }}>Ações</th>
                </tr>
              </thead>
              <tbody>
                {instituicoes.length === 0 ? (
                  <tr>
                    <td colSpan="5" className="text-center py-4">
                      Nenhuma instituição cadastrada
                    </td>
                  </tr>
                ) : (
                  instituicoes.map((item) => (
                    <tr key={item._id}>
                      <td>{item.nome}</td>
                      <td>{item.sigla || '-'}</td>
                      <td>{item.cidade || '-'}</td>
                      <td>{item.estado || '-'}</td>
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
              <h4>{editingItem ? 'Editar' : 'Nova'} Instituição</h4>
            </div>
            <FormProvider {...methods}>
              <form onSubmit={methods.handleSubmit(onSubmit)}>
                <div className="br-modal-body">
                  <FormInput name="nome" label="Nome" required />
                  <FormInput name="sigla" label="Sigla" placeholder="Ex: USP, UNESP..." />
                  <div className="row">
                    <div className="col-md-8">
                      <FormInput name="cidade" label="Cidade" />
                    </div>
                    <div className="col-md-4">
                      <FormInput 
                        name="estado" 
                        label="Estado" 
                        placeholder="SP" 
                        maxLength={2}
                        style={{ textTransform: 'uppercase' }}
                      />
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

export default AdminInstituicoes;
