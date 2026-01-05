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
  areaAtuacao: z.string().min(1, 'Área de Atuação é obrigatória'),
  subarea: z.string().min(1, 'Subárea é obrigatória'),
  visitante: z.boolean().optional(),
});

const AdminDocentes = () => {
  const [docentes, setDocentes] = useState([]);
  const [instituicoes, setInstituicoes] = useState([]);
  const [areasAtuacao, setareasAtuacao] = useState([]);
  const [subareas, setSubareas] = useState([]);
  const [filteredSubareas, setFilteredSubareas] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  const [showModal, setShowModal] = useState(false);
  const [editingItem, setEditingItem] = useState(null);
  
  const methods = useForm({ resolver: zodResolver(docenteSchema) });
  const watchAreaAtuacao = methods.watch('areaAtuacao');
  
  useEffect(() => {
    fetchData();
    fetchFormData();
  }, []);
  
  // Scroll para o topo e bloqueia scroll quando modal abrir
  useEffect(() => {
    if (showModal) {
      window.scrollTo({ top: 0, behavior: 'smooth' });
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = 'unset';
    }
    
    return () => {
      document.body.style.overflow = 'unset';
    };
  }, [showModal]);
  
  useEffect(() => {
    if (watchAreaAtuacao) {
      const filtered = subareas.filter(s => 
        s.areaAtuacao?._id === watchAreaAtuacao ||
        s.areaAtuacao === watchAreaAtuacao
      );
      setFilteredSubareas(filtered);
    } else {
      setFilteredSubareas([]);
    }
  }, [watchAreaAtuacao, subareas]);
  
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
        api.get('/public/areas-atuacao'),
        api.get('/public/subareas'),
      ]);
      
      if (instRes.data.success) setInstituicoes(instRes.data.data);
      if (gaRes.data.success) setareasAtuacao(gaRes.data.data);
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
      areaAtuacao: '',
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
      areaAtuacao: item.areaAtuacao?._id || item.areaAtuacao,
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
            <i className="icon fas fa-chevron-right"></i>            <Link to="/area-administrativa">Área Administrativa</Link>
          </li>
          <li className="crumb">
            <i className="icon fas fa-chevron-right"></i>            <span>Docentes</span>
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
                  <th>Área de Atuação</th>
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
                      <td>{item.areaAtuacao?.nome || '-'}</td>
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
          <div className="br-scrim active" style={{ 
            position: 'fixed',
            top: 0,
            left: 0,
            right: 0,
            bottom: 0,
            backgroundColor: 'rgba(0, 0, 0, 0.5)',
            zIndex: 9998
          }} onClick={() => setShowModal(false)}></div>
          
          <div style={{ 
            position: 'fixed',
            top: '50%',
            left: '50%',
            transform: 'translate(-50%, -50%)',
            zIndex: 9999,
            width: '90%',
            maxWidth: '600px',
            maxHeight: '85vh',
            backgroundColor: '#fff',
            borderRadius: '8px',
            boxShadow: '0 8px 32px rgba(0,0,0,0.3)',
            display: 'flex',
            flexDirection: 'column',
            overflow: 'hidden'
          }}>
            <div className="br-modal-header" style={{ 
              padding: '1.5rem 2rem',
              borderBottom: '1px solid #ddd',
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'space-between'
            }}>
              <h4 style={{ margin: 0, fontSize: '1.5rem', fontWeight: 600 }}>
                {editingItem ? 'Editar' : 'Novo'} Docente
              </h4>
              <button
                className="br-button circle"
                onClick={() => setShowModal(false)}
                type="button"
                style={{ flexShrink: 0 }}
              >
                <i className="fas fa-times"></i>
              </button>
            </div>
            <FormProvider {...methods}>
              <form onSubmit={methods.handleSubmit(onSubmit)} style={{ display: 'flex', flexDirection: 'column', height: '100%' }}>
                <div style={{ 
                  overflowY: 'auto', 
                  flex: 1,
                  padding: '2rem'
                }}>
                  <FormInput name="nome" label="Nome Completo" required placeholder="Digite o nome completo" />
                  
                  <div style={{ maxWidth: '250px' }}>
                    <FormInput name="cpf" label="CPF" required placeholder="000.000.000-00" />
                  </div>
                  
                  <FormInput name="email" label="Email" type="email" required placeholder="exemplo@email.com" />
                  
                  <div style={{ maxWidth: '250px' }}>
                    <FormInput name="telefone" label="Telefone" placeholder="(00) 00000-0000" />
                  </div>
                  
                  <div className="mb-3">
                    <div className={`br-input ${methods.formState.errors.instituicao ? 'danger' : ''}`}>
                      <label htmlFor="instituicao">
                        Instituição <span className="text-danger">*</span>
                      </label>
                      <select
                        id="instituicao"
                        style={{
                          height: '40px',
                          padding: '8px 12px',
                          fontSize: '16px',
                          lineHeight: '1.5',
                          border: '1px solid #888',
                          borderRadius: '4px',
                          backgroundColor: '#fff',
                          width: '100%'
                        }}
                        {...methods.register('instituicao')}
                      >
                        <option value="">Selecione...</option>
                        {instituicoes.map(i => (
                          <option key={i._id} value={i._id}>
                            {i.nome}
                          </option>
                        ))}
                      </select>
                      {methods.formState.errors.instituicao && (
                        <span className="feedback danger" role="alert">
                          <i className="fas fa-times-circle" aria-hidden="true"></i>
                          {methods.formState.errors.instituicao.message}
                        </span>
                      )}
                    </div>
                  </div>
                  
                  <div className="mb-3">
                    <div className={`br-input ${methods.formState.errors.areaAtuacao ? 'danger' : ''}`}>
                      <label htmlFor="areaAtuacao">
                        Área de Atuação <span className="text-danger">*</span>
                      </label>
                          <select
                            id="areaAtuacao"
                            style={{
                              height: '40px',
                              padding: '8px 12px',
                              fontSize: '16px',
                              lineHeight: '1.5',
                              border: '1px solid #888',
                              borderRadius: '4px',
                              backgroundColor: '#fff',
                              width: '100%'
                            }}
                            {...methods.register('areaAtuacao')}
                          >
                            <option value="">Selecione...</option>
                            {areasAtuacao.map(ga => (
                              <option key={ga._id} value={ga._id}>
                                {ga.nome}
                              </option>
                            ))}
                          </select>
                          {methods.formState.errors.areaAtuacao && (
                            <span className="feedback danger" role="alert">
                              <i className="fas fa-times-circle" aria-hidden="true"></i>
                              {methods.formState.errors.areaAtuacao.message}
                            </span>
                          )}
                        </div>
                      </div>
                  
                  <div className="mb-3">
                    <div className={`br-input ${methods.formState.errors.subarea ? 'danger' : ''}`}>
                      <label htmlFor="subarea">
                        Subárea <span className="text-danger">*</span>
                      </label>
                          <select
                            id="subarea"
                            style={{
                              height: '40px',
                              padding: '8px 12px',
                              fontSize: '16px',
                              lineHeight: '1.5',
                              border: '1px solid #888',
                              borderRadius: '4px',
                              backgroundColor: '#fff',
                              width: '100%'
                            }}
                            {...methods.register('subarea')}
                            disabled={!watchAreaAtuacao}
                          >
                            <option value="">
                              {!watchAreaAtuacao ? 'Selecione primeiro uma Área de Atuação' : 'Selecione...'}
                            </option>
                            {filteredSubareas.map(sa => (
                              <option key={sa._id} value={sa._id}>
                                {sa.nome}
                              </option>
                            ))}
                          </select>
                          {methods.formState.errors.subarea && (
                            <span className="feedback danger" role="alert">
                              <i className="fas fa-times-circle" aria-hidden="true"></i>
                              {methods.formState.errors.subarea.message}
                            </span>
                          )}
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
                <div style={{ 
                  padding: '1.5rem 2rem',
                  borderTop: '1px solid #ddd',
                  display: 'flex',
                  gap: '1rem',
                  justifyContent: 'flex-end',
                  flexShrink: 0,
                  backgroundColor: '#f8f9fa'
                }}>
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
