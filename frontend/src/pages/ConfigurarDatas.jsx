import React, { useState, useEffect } from 'react';
import { useParams, useNavigate, Link } from 'react-router-dom';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const schema = z.object({
  inscricaoParticipante_inicio: z.string().min(1, 'Data de início obrigatória'),
  inscricaoParticipante_fim: z.string().min(1, 'Data de fim obrigatória'),
  submissaoTrabalhos_inicio: z.string().min(1, 'Data de início obrigatória'),
  submissaoTrabalhos_fim: z.string().min(1, 'Data de fim obrigatória'),
  prazoAvaliacao_inicio: z.string().min(1, 'Data de início obrigatória'),
  prazoAvaliacao_fim: z.string().min(1, 'Data de fim obrigatória'),
  notasAvaliacaoExterna_inicio: z.string().min(1, 'Data de início obrigatória'),
  notasAvaliacaoExterna_fim: z.string().min(1, 'Data de fim obrigatória'),
});

const ConfigurarDatas = () => {
  const { ano } = useParams();
  const navigate = useNavigate();
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  
  const {
    register,
    handleSubmit,
    setValue,
    formState: { errors, isSubmitting },
  } = useForm({
    resolver: zodResolver(schema),
  });
  
  useEffect(() => {
    const fetchSimposio = async () => {
      try {
        setLoading(true);
        const { data } = await api.get(`/admin/simposios/${ano}`);
        if (data.success && data.data.datasConfig) {
          const cfg = data.data.datasConfig;
          
          if (cfg.inscricaoParticipante) {
            setValue('inscricaoParticipante_inicio', cfg.inscricaoParticipante.inicio?.split('T')[0] || '');
            setValue('inscricaoParticipante_fim', cfg.inscricaoParticipante.fim?.split('T')[0] || '');
          }
          if (cfg.submissaoTrabalhos) {
            setValue('submissaoTrabalhos_inicio', cfg.submissaoTrabalhos.inicio?.split('T')[0] || '');
            setValue('submissaoTrabalhos_fim', cfg.submissaoTrabalhos.fim?.split('T')[0] || '');
          }
          if (cfg.prazoAvaliacao) {
            setValue('prazoAvaliacao_inicio', cfg.prazoAvaliacao.inicio?.split('T')[0] || '');
            setValue('prazoAvaliacao_fim', cfg.prazoAvaliacao.fim?.split('T')[0] || '');
          }
          if (cfg.notasAvaliacaoExterna) {
            setValue('notasAvaliacaoExterna_inicio', cfg.notasAvaliacaoExterna.inicio?.split('T')[0] || '');
            setValue('notasAvaliacaoExterna_fim', cfg.notasAvaliacaoExterna.fim?.split('T')[0] || '');
          }
        }
      } catch (err) {
        setError(err.response?.data?.message || 'Erro ao carregar configurações');
      } finally {
        setLoading(false);
      }
    };
    
    fetchSimposio();
  }, [ano, setValue]);
  
  const onSubmit = async (formData) => {
    try {
      setError('');
      setSuccess('');
      
      const datasConfig = {
        inscricaoParticipante: {
          inicio: formData.inscricaoParticipante_inicio,
          fim: formData.inscricaoParticipante_fim,
        },
        submissaoTrabalhos: {
          inicio: formData.submissaoTrabalhos_inicio,
          fim: formData.submissaoTrabalhos_fim,
        },
        prazoAvaliacao: {
          inicio: formData.prazoAvaliacao_inicio,
          fim: formData.prazoAvaliacao_fim,
        },
        notasAvaliacaoExterna: {
          inicio: formData.notasAvaliacaoExterna_inicio,
          fim: formData.notasAvaliacaoExterna_fim,
        },
      };
      
      const { data } = await api.put(`/admin/simposios/${ano}/datas`, { datasConfig });
      
      if (data.success) {
        setSuccess('Datas configuradas com sucesso!');
        setTimeout(() => navigate(`/admin/simposios/${ano}`), 2000);
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao salvar configurações');
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
            <Link to={`/admin/simposios/${ano}`}>Gerenciar Simpósio</Link>
          </li>
          <li className="crumb">
            <i className="icon fas fa-chevron-right"></i>
            <span>Configurar Datas</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">Configurar Datas - Simpósio {ano}</h1>
        
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
        
        {loading ? (
          <div className="text-center my-5">
            <div className="br-loading" aria-label="Carregando"></div>
          </div>
        ) : (
          <form onSubmit={handleSubmit(onSubmit)}>
            <div className="br-card mb-3">
              <div className="card-header">
                <h3 className="text-weight-semi-bold">Inscrição de Participantes</h3>
              </div>
              <div className="card-content">
                <div className="row">
                  <div className="col-md-6 mb-3">
                    <div className="br-input">
                      <label htmlFor="inscricaoParticipante_inicio">Data de Início</label>
                      <input
                        type="date"
                        id="inscricaoParticipante_inicio"
                        {...register('inscricaoParticipante_inicio')}
                      />
                      {errors.inscricaoParticipante_inicio && (
                        <span className="feedback danger" role="alert">
                          {errors.inscricaoParticipante_inicio.message}
                        </span>
                      )}
                    </div>
                  </div>
                  <div className="col-md-6 mb-3">
                    <div className="br-input">
                      <label htmlFor="inscricaoParticipante_fim">Data de Fim</label>
                      <input
                        type="date"
                        id="inscricaoParticipante_fim"
                        {...register('inscricaoParticipante_fim')}
                      />
                      {errors.inscricaoParticipante_fim && (
                        <span className="feedback danger" role="alert">
                          {errors.inscricaoParticipante_fim.message}
                        </span>
                      )}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div className="br-card mb-3">
              <div className="card-header">
                <h3 className="text-weight-semi-bold">Submissão de Trabalhos</h3>
              </div>
              <div className="card-content">
                <div className="row">
                  <div className="col-md-6 mb-3">
                    <div className="br-input">
                      <label htmlFor="submissaoTrabalhos_inicio">Data de Início</label>
                      <input
                        type="date"
                        id="submissaoTrabalhos_inicio"
                        {...register('submissaoTrabalhos_inicio')}
                      />
                      {errors.submissaoTrabalhos_inicio && (
                        <span className="feedback danger" role="alert">
                          {errors.submissaoTrabalhos_inicio.message}
                        </span>
                      )}
                    </div>
                  </div>
                  <div className="col-md-6 mb-3">
                    <div className="br-input">
                      <label htmlFor="submissaoTrabalhos_fim">Data de Fim</label>
                      <input
                        type="date"
                        id="submissaoTrabalhos_fim"
                        {...register('submissaoTrabalhos_fim')}
                      />
                      {errors.submissaoTrabalhos_fim && (
                        <span className="feedback danger" role="alert">
                          {errors.submissaoTrabalhos_fim.message}
                        </span>
                      )}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div className="br-card mb-3">
              <div className="card-header">
                <h3 className="text-weight-semi-bold">Prazo de Avaliação</h3>
              </div>
              <div className="card-content">
                <div className="row">
                  <div className="col-md-6 mb-3">
                    <div className="br-input">
                      <label htmlFor="prazoAvaliacao_inicio">Data de Início</label>
                      <input
                        type="date"
                        id="prazoAvaliacao_inicio"
                        {...register('prazoAvaliacao_inicio')}
                      />
                      {errors.prazoAvaliacao_inicio && (
                        <span className="feedback danger" role="alert">
                          {errors.prazoAvaliacao_inicio.message}
                        </span>
                      )}
                    </div>
                  </div>
                  <div className="col-md-6 mb-3">
                    <div className="br-input">
                      <label htmlFor="prazoAvaliacao_fim">Data de Fim</label>
                      <input
                        type="date"
                        id="prazoAvaliacao_fim"
                        {...register('prazoAvaliacao_fim')}
                      />
                      {errors.prazoAvaliacao_fim && (
                        <span className="feedback danger" role="alert">
                          {errors.prazoAvaliacao_fim.message}
                        </span>
                      )}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div className="br-card mb-3">
              <div className="card-header">
                <h3 className="text-weight-semi-bold">Notas de Avaliação Externa</h3>
              </div>
              <div className="card-content">
                <div className="row">
                  <div className="col-md-6 mb-3">
                    <div className="br-input">
                      <label htmlFor="notasAvaliacaoExterna_inicio">Data de Início</label>
                      <input
                        type="date"
                        id="notasAvaliacaoExterna_inicio"
                        {...register('notasAvaliacaoExterna_inicio')}
                      />
                      {errors.notasAvaliacaoExterna_inicio && (
                        <span className="feedback danger" role="alert">
                          {errors.notasAvaliacaoExterna_inicio.message}
                        </span>
                      )}
                    </div>
                  </div>
                  <div className="col-md-6 mb-3">
                    <div className="br-input">
                      <label htmlFor="notasAvaliacaoExterna_fim">Data de Fim</label>
                      <input
                        type="date"
                        id="notasAvaliacaoExterna_fim"
                        {...register('notasAvaliacaoExterna_fim')}
                      />
                      {errors.notasAvaliacaoExterna_fim && (
                        <span className="feedback danger" role="alert">
                          {errors.notasAvaliacaoExterna_fim.message}
                        </span>
                      )}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div className="d-flex gap-2">
              <button
                type="submit"
                className="br-button primary"
                disabled={isSubmitting}
              >
                {isSubmitting ? 'Salvando...' : 'Salvar Configurações'}
              </button>
              <Link
                to={`/admin/simposios/${ano}`}
                className="br-button secondary"
              >
                Cancelar
              </Link>
            </div>
          </form>
        )}
      </div>
    </MainLayout>
  );
};

export default ConfigurarDatas;
