import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { useForm, FormProvider } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import MainLayout from '../layouts/MainLayout';
import { FormInput, FormSelect } from '../components/forms';
import api from '../services/api';

const docenteSchema = z.object({
  nome: z.string().min(3, 'Nome deve ter no mínimo 3 caracteres'),
  cpf: z.string().min(11, 'CPF inválido').max(14, 'CPF inválido'),
  email: z.string().email('Email inválido'),
  telefone: z.string().optional(),
  instituicao: z.string().min(1, 'Instituição é obrigatória'),
  grandeArea: z.string().min(1, 'Grande área é obrigatória'),
  subarea: z.string().min(1, 'Subárea é obrigatória'),
  visitante: z.boolean().optional(),
});

const AdminDocentes = () => {
  const [docentes, setDocentes] = useState([]);
  const [instituicoes, setInstituicoes] = useState([]);
  const [grandesAreas, setGrandesAreas] = useState([]);
  const [subareas, setSubareas] = useState([]);
  const [filteredSubareas, setFilteredSubareas] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  const [showModal, setShowModal] = useState(false);
  const [editingItem, setEditingItem] = useState(null);
  
  const methods = useForm({ resolver: zodResolver(docenteSchema) });
  const watchGrandeArea = methods.watch('grandeArea');
  
  useEffect(() => {
    fetchData();
    fetchFormData();
  }, []);
  
  useEffect(() => {
    if (watchGrandeArea) {
      const filtered = subareas.filter(s => 
        s.areaAtuacao?.grandeArea?._id === watchGrandeArea ||
        s.areaAtuacao?.grandeArea === watchGrandeArea
      );
      setFilteredSubareas(filtered);
    }
  }, [watchGrandeArea, subareas]);
  
  const fetchData = async () => {
    try {
      setLoading(true);
      const res = await api.get('/admin/docentes');
      
      if (res.data.success) {
        setDocentes(res.data.data);
      }
    } catch (err) {
      console.error('Erro ao carregar docentes:', err);
      setError('Erro ao carregar docentes: ' + (err.response?.data?.message || err.message));
    } finally {
      setLoading(false);
    }
  };
  
  const fetchFormData = async () => {
    try {
      const [instRes, gaRes, saRes] = await Promise.all([
        api.get('/public/instituicoes'),
        api.get('/public/grande-areas'),
        api.get('/public/subareas'),
      ]);
      
      if (instRes.data.success) setInstituicoes(instRes.data.data);
      if (gaRes.data.success) setGrandesAreas(gaRes.data.data);
      if (saRes.data.success) setSubareas(saRes.data.data);
    } catch (err) {
      console.error('Erro ao carregar dados do formulário:', err);
    }
  };
  
  const handleCreate = () => {
    setEditingItem(null);
    methods.reset({
      nome: '',
      cpf: '',
      email: '',
      telefone: '',
      instituicao: '',
      grandeArea: '',
      subarea: '',
      visitante: false,
    });
    setShowModal(true);
  };
  
  const handleEdit = (item) => {
    setEditingItem(item);
    methods.reset({
      nome: item.nome,
      cpf: item.cpf,
      email: item.email,
      telefone: item.telefone || '',
      instituicao: item.instituicao?._id || item.instituicao,
      grandeArea: item.grandeArea?._id || item.grandeArea,
      subarea: item.subarea?._id || item.subarea,
      visitante: item.visitante || false,
    });
    setShowModal(true);
  };
  
  const onSubmit = async (data) => {
    try {
      setError('');
      setSuccess('');
      
      if (editingItem) {
        await api.put(`/admin/docentes/${editingItem._id}`, data);
        setSuccess('Docente atualizado!');
      } else {
        await api.post('/admin/docentes', data);
        setSuccess('Docente cadastrado!');
      }
      
      fetchData();
      setShowModal(false);
      methods.reset();
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao salvar');
    }
  };
  
  const handleDelete = async (id) => {
    if (!confirm('Tem certeza que deseja excluir este docente?')) return;
    
    try {
      setError('');
      setSuccess('');
      
      await api.delete(`/admin/docentes/${id}`);
      setSuccess('Docente excluído!');
      
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
            <span>Docentes</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <div className="d-flex justify-content-between align-items-center mb-4">
          <h1 className="text-up-03 text-weight-bold">Docentes</h1>
          <button
            onClick={handleCreate}
            className="br-button primary"
          >
            <i className="fas fa-plus mr-2"></i>Novo Docente
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
            <p className="mt-3">Carregando docentes...</p>
          </div>
        ) : (
          <div className="br-table">
            <table>
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>CPF</th>
                  <th>Email</th>
                  <th>Instituição</th>
                  <th>Grande Área</th>
                  <th>Subárea</th>
                  <th>Visitante</th>
                  <th style={{ width: '150px' }}>Ações</th>
                </tr>
              </thead>
              <tbody>
                {docentes.length === 0 ? (
                  <tr>
                    <td colSpan="8" className="text-center py-4">
                      Nenhum docente cadastrado
                    </td>
                  </tr>
                ) : (
                  docentes.map((item) => (
                    <tr key={item._id}>
                      <td>{item.nome}</td>
                      <td>{item.cpf}</td>
                      <td>{item.email}</td>
                      <td>{item.instituicao?.nome || '-'}</td>
                      <td>{item.grandeArea?.nome || '-'}</td>
                      <td>{item.subarea?.nome || '-'}</td>
                      <td>{item.visitante ? 'Sim' : 'Não'}</td>
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
          <div className="br-modal large" style={{ display: 'block' }}>
            <div className="br-modal-header">
              <h4>{editingItem ? 'Editar' : 'Novo'} Docente</h4>
            </div>
            <FormProvider {...methods}>
              <form onSubmit={methods.handleSubmit(onSubmit)}>
                <div className="br-modal-body">
                  <div className="row">
                    <div className="col-md-8">
                      <FormInput name="nome" label="Nome Completo" required />
                    </div>
                    <div className="col-md-4">
                      <FormInput name="cpf" label="CPF" required placeholder="000.000.000-00" />
                    </div>
                  </div>
                  
                  <div className="row">
                    <div className="col-md-8">
                      <FormInput name="email" label="Email" type="email" required />
                    </div>
                    <div className="col-md-4">
                      <FormInput name="telefone" label="Telefone" placeholder="(00) 00000-0000" />
                    </div>
                  </div>
                  
                  <FormSelect
                    name="instituicao"
                    label="Instituição"
                    required
                    options={instituicoes.map(i => ({ value: i._id, label: i.nome }))}
                  />
                  
                  <div className="row">
                    <div className="col-md-6">
                      <FormSelect
                        name="grandeArea"
                        label="Grande Área"
                        required
                        options={grandesAreas.map(ga => ({ value: ga._id, label: ga.nome }))}
                      />
                    </div>
                    <div className="col-md-6">
                      <FormSelect
                        name="subarea"
                        label="Subárea"
                        required
                        options={filteredSubareas.map(sa => ({ value: sa._id, label: sa.nome }))}
                        disabled={!watchGrandeArea}
                      />
                    </div>
                  </div>
                  
                  <div className="br-checkbox">
                    <input
                      id="visitante"
                      type="checkbox"
                      {...methods.register('visitante')}
                    />
                    <label htmlFor="visitante">Docente Visitante</label>
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

export default AdminDocentes;
