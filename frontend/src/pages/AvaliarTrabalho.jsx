import React, { useState, useEffect } from 'react';
import { Link, useParams } from 'react-router-dom';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const avaliacaoSchema = z.object({
  nota: z.number().min(0).max(10),
  parecer: z.string().min(20, 'Parecer deve ter no mínimo 20 caracteres'),
});

const AvaliarTrabalho = () => {
  const { id } = useParams();
  const [trabalho, setTrabalho] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  
  const {
    register,
    handleSubmit,
    formState: { errors, isSubmitting },
  } = useForm({
    resolver: zodResolver(avaliacaoSchema),
  });
  
  useEffect(() => {
    const fetchTrabalho = async () => {
      try {
        setLoading(true);
        const { data } = await api.get(`/avaliador/trabalhos/${id}`);
        if (data.success) {
          setTrabalho(data.data);
        }
      } catch (err) {
        setError(err.response?.data?.message || 'Erro ao carregar trabalho');
      } finally {
        setLoading(false);
      }
    };
    
    if (id) fetchTrabalho();
  }, [id]);
  
  const onSubmit = async (formData) => {
    try {
      setError('');
      setSuccess('');
      
      const { data } = await api.post(`/avaliador/trabalhos/${id}/avaliar`, formData);
      
      if (data.success) {
        setSuccess('Avaliação registrada com sucesso!');
        setTimeout(() => window.location.href = '/avaliador/trabalhos', 2000);
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao registrar avaliação');
    }
  };
  
  if (loading) {
    return (
      <MainLayout>
        <div className="text-center my-5">
          <div className="br-loading" aria-label="Carregando"></div>
        </div>
      </MainLayout>
    );
  }
  
  if (!trabalho) {
    return (
      <MainLayout>
        <div className="br-message danger" role="alert">
          <div className="icon">
            <i className="fas fa-times-circle fa-lg" aria-hidden="true"></i>
          </div>
          <div className="content">Trabalho não encontrado</div>
        </div>
      </MainLayout>
    );
  }
  
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
            <Link to="/avaliador/trabalhos">Trabalhos</Link>
          </li>
          <li className="crumb">
            <i className="icon fas fa-chevron-right"></i>
            <span>Avaliar</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">Avaliar Trabalho</h1>
        
        {error && (
          <div className="br-message danger mb-3" role="alert">
            <div className="icon">
              <i className="fas fa-times-circle fa-lg" aria-hidden="true"></i>
            </div>
            <div className="content">{error}</div>
          </div>
        )}
        
        {success && (
          <div className="br-message success mb-3" role="alert">
            <div className="icon">
              <i className="fas fa-check-circle fa-lg" aria-hidden="true"></i>
            </div>
            <div className="content">{success}</div>
          </div>
        )}
        
        <div className="br-card mb-4">
          <div className="card-header">
            <h5 className="text-weight-semi-bold">{trabalho.titulo}</h5>
          </div>
          <div className="card-content">
            <div className="mb-2">
              <strong>Autores:</strong>{' '}
              {trabalho.autores?.map(a => a.nome).join(', ')}
            </div>
            <div className="mb-2">
              <strong>Palavras-chave:</strong>{' '}
              {trabalho.palavras_chave?.join(', ')}
            </div>
            {trabalho.arquivo && (
              <a
                href={`${import.meta.env.VITE_API_BASE_URL.replace('/api/v1', '')}/uploads/${trabalho.arquivo}`}
                target="_blank"
                rel="noopener noreferrer"
                className="br-button secondary small mt-2"
              >
                <i className="fas fa-download mr-2"></i>
                Baixar Trabalho
              </a>
            )}
          </div>
        </div>
        
        <div className="br-card">
          <div className="card-header">
            <h5 className="text-weight-semi-bold">Formulário de Avaliação</h5>
          </div>
          <div className="card-content">
            <form onSubmit={handleSubmit(onSubmit)}>
              <div className="br-input mb-3">
                <label htmlFor="nota">
                  Nota (0 a 10) <span className="text-danger">*</span>
                </label>
                <input
                  {...register('nota', { valueAsNumber: true })}
                  id="nota"
                  type="number"
                  min="0"
                  max="10"
                  step="0.1"
                  placeholder="8.5"
                  className={errors.nota ? 'danger' : ''}
                />
                {errors.nota && (
                  <span className="feedback danger" role="alert">
                    <i className="fas fa-times-circle" aria-hidden="true"></i>
                    {errors.nota.message}
                  </span>
                )}
              </div>
              
              <div className="br-textarea mb-3">
                <label htmlFor="parecer">
                  Parecer <span className="text-danger">*</span>
                </label>
                <textarea
                  {...register('parecer')}
                  id="parecer"
                  rows="6"
                  placeholder="Descreva sua avaliação do trabalho..."
                  className={errors.parecer ? 'danger' : ''}
                />
                {errors.parecer && (
                  <span className="feedback danger" role="alert">
                    <i className="fas fa-times-circle" aria-hidden="true"></i>
                    {errors.parecer.message}
                  </span>
                )}
              </div>
              
              <div className="d-flex justify-content-between mt-4">
                <Link to="/avaliador/trabalhos" className="br-button secondary">
                  Voltar
                </Link>
                <button type="submit" className="br-button primary" disabled={isSubmitting}>
                  {isSubmitting ? 'Salvando...' : 'Registrar Avaliação'}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </MainLayout>
  );
};

export default AvaliarTrabalho;
