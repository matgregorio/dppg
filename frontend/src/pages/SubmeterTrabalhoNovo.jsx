import React, { useState, useEffect } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useForm, FormProvider, useFieldArray } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import MainLayout from '../layouts/MainLayout';
import { FormInput, FormSelect, FormTextarea } from '../components/forms';
import api from '../services/api';

const trabalhoSchema = z.object({
  titulo: z.string().min(10, 'Título deve ter no mínimo 10 caracteres'),
  orientador: z.string().min(1, 'Orientador é obrigatório'),
  outrosAutores: z.array(z.object({
    nome: z.string().min(3, 'Nome deve ter no mínimo 3 caracteres'),
    email: z.string().email('Email inválido'),
  })).optional(),
  tipoProjeto: z.enum(['PESQUISA', 'ENSINO', 'EXTENSAO']),
  apoios: z.array(z.string()).optional(),
  resumo: z.string()
    .min(250, 'Resumo deve ter no mínimo 250 palavras')
    .max(400, 'Resumo deve ter no máximo 400 palavras'),
  palavrasChave: z.array(z.string()).optional(),
  concordanciaNormas: z.boolean().refine(val => val === true, {
    message: 'Você deve concordar com as normas',
  }),
});

const SubmeterTrabalhoNovo = () => {
  const navigate = useNavigate();
  const [docentes, setDocentes] = useState([]);
  const [apoios, setApoios] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [wordCount, setWordCount] = useState(0);
  
  const methods = useForm({
    resolver: zodResolver(trabalhoSchema),
    defaultValues: {
      outrosAutores: [],
      apoios: [],
      palavrasChave: [],
      tipoProjeto: 'PESQUISA',
      concordanciaNormas: false,
    },
  });
  
  const { fields, append, remove } = useFieldArray({
    control: methods.control,
    name: 'outrosAutores',
  });
  
  const watchResumo = methods.watch('resumo');
  
  useEffect(() => {
    fetchFormData();
  }, []);
  
  useEffect(() => {
    if (watchResumo) {
      const words = watchResumo.trim().split(/\s+/).filter(w => w.length > 0);
      setWordCount(words.length);
    } else {
      setWordCount(0);
    }
  }, [watchResumo]);
  
  const fetchFormData = async () => {
    try {
      const [docentesRes, apoiosRes] = await Promise.all([
        api.get('/public/docentes'),
        api.get('/public/apoios'),
      ]);
      
      if (docentesRes.data.success) setDocentes(docentesRes.data.data);
      if (apoiosRes.data.success) setApoios(apoiosRes.data.data);
    } catch (err) {
      console.error('Erro ao carregar dados:', err);
      setError('Erro ao carregar dados do formulário');
    }
  };
  
  const onSubmit = async (data) => {
    try {
      setLoading(true);
      setError('');
      
      // Validar número de palavras manualmente
      if (wordCount < 250 || wordCount > 400) {
        setError('O resumo deve ter entre 250 e 400 palavras');
        return;
      }
      
      // Validar máximo de autores (1 principal + 5 outros = 6 total)
      if (data.outrosAutores && data.outrosAutores.length > 5) {
        setError('Máximo de 6 autores (você + 5 outros autores)');
        return;
      }
      
      const res = await api.post('/trabalhos/submeter', data);
      
      if (res.data.success) {
        alert('Trabalho submetido com sucesso! Aguarde a avaliação do orientador.');
        navigate('/meus-trabalhos');
      }
    } catch (err) {
      console.error('Erro ao submeter trabalho:', err);
      setError(err.response?.data?.message || 'Erro ao submeter trabalho');
    } finally {
      setLoading(false);
    }
  };
  
  const addAutor = () => {
    if (fields.length >= 5) {
      alert('Máximo de 6 autores no total (você + 5 outros)');
      return;
    }
    append({ nome: '', email: '' });
  };
  
  const getWordCountClass = () => {
    if (wordCount < 250) return 'text-danger';
    if (wordCount > 400) return 'text-danger';
    return 'text-success';
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
            <Link to="/meus-trabalhos">Meus Trabalhos</Link>
          </li>
          <li className="crumb">
            <i className="icon fas fa-chevron-right"></i>
            <span>Submeter Trabalho</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">Submeter Trabalho</h1>
        
        {error && (
          <div className="br-message danger mb-3" role="alert">
            <div className="icon"><i className="fas fa-times-circle fa-lg"></i></div>
            <div className="content">{error}</div>
          </div>
        )}
        
        <div className="br-card">
          <div className="card-content p-4">
            <FormProvider {...methods}>
              <form onSubmit={methods.handleSubmit(onSubmit)}>
                <FormInput
                  name="titulo"
                  label="Título do Trabalho"
                  required
                  placeholder="Digite o título do trabalho"
                />
                
                <div className="row">
                  <div className="col-md-6">
                    <FormSelect
                      name="orientador"
                      label="Orientador"
                      required
                      options={docentes.map(d => ({
                        value: d._id,
                        label: `${d.nome} - ${d.instituicao?.sigla || d.instituicao?.nome || ''}`,
                      }))}
                    />
                  </div>
                  <div className="col-md-6">
                    <FormSelect
                      name="tipoProjeto"
                      label="Tipo de Projeto"
                      required
                      options={[
                        { value: 'PESQUISA', label: 'Pesquisa' },
                        { value: 'ENSINO', label: 'Ensino' },
                        { value: 'EXTENSAO', label: 'Extensão' },
                      ]}
                    />
                  </div>
                </div>
                
                <div className="mb-4">
                  <label className="text-weight-bold mb-2">
                    Outros Autores (opcional - máx. 5)
                  </label>
                  {fields.map((field, index) => (
                    <div key={field.id} className="row mb-2">
                      <div className="col-md-5">
                        <FormInput
                          name={`outrosAutores.${index}.nome`}
                          placeholder="Nome do autor"
                        />
                      </div>
                      <div className="col-md-5">
                        <FormInput
                          name={`outrosAutores.${index}.email`}
                          placeholder="Email do autor"
                          type="email"
                        />
                      </div>
                      <div className="col-md-2">
                        <button
                          type="button"
                          className="br-button secondary"
                          onClick={() => remove(index)}
                        >
                          <i className="fas fa-trash"></i>
                        </button>
                      </div>
                    </div>
                  ))}
                  {fields.length < 5 && (
                    <button
                      type="button"
                      className="br-button secondary"
                      onClick={addAutor}
                    >
                      <i className="fas fa-plus mr-2"></i>Adicionar Autor
                    </button>
                  )}
                </div>
                
                <FormSelect
                  name="apoios"
                  label="Apoios Recebidos (opcional)"
                  multiple
                  options={apoios.map(a => ({
                    value: a._id,
                    label: `${a.nome}${a.sigla ? ` (${a.sigla})` : ''} - ${a.tipo}`,
                  }))}
                />
                
                <div className="mb-3">
                  <FormTextarea
                    name="resumo"
                    label="Resumo"
                    required
                    rows={10}
                    placeholder="Digite o resumo do trabalho (250 a 400 palavras)"
                  />
                  <small className={`form-text ${getWordCountClass()}`}>
                    <strong>Palavras: {wordCount}</strong> (mínimo: 250, máximo: 400)
                    {wordCount < 250 && ' - Adicione mais palavras'}
                    {wordCount > 400 && ' - Reduza o texto'}
                    {wordCount >= 250 && wordCount <= 400 && ' ✓'}
                  </small>
                </div>
                
                <div className="br-checkbox mb-4">
                  <input
                    id="concordanciaNormas"
                    type="checkbox"
                    {...methods.register('concordanciaNormas')}
                  />
                  <label htmlFor="concordanciaNormas">
                    Declaro que li e concordo com as{' '}
                    <Link to="/normas-publicacao" target="_blank">
                      normas de publicação
                    </Link>
                    {' '}e que o trabalho é original e inédito. *
                  </label>
                  {methods.formState.errors.concordanciaNormas && (
                    <div className="text-danger mt-1">
                      {methods.formState.errors.concordanciaNormas.message}
                    </div>
                  )}
                </div>
                
                <div className="d-flex justify-content-between">
                  <button
                    type="button"
                    className="br-button secondary"
                    onClick={() => navigate('/meus-trabalhos')}
                  >
                    Cancelar
                  </button>
                  <button
                    type="submit"
                    className="br-button primary"
                    disabled={loading}
                  >
                    {loading ? (
                      <>
                        <i className="fas fa-spinner fa-spin mr-2"></i>
                        Enviando...
                      </>
                    ) : (
                      <>
                        <i className="fas fa-paper-plane mr-2"></i>
                        Submeter Trabalho
                      </>
                    )}
                  </button>
                </div>
              </form>
            </FormProvider>
          </div>
        </div>
      </div>
    </MainLayout>
  );
};

export default SubmeterTrabalhoNovo;
