import React, { useState, useEffect } from 'react';
import { Link, useParams, useNavigate } from 'react-router-dom';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const avaliacaoSchema = z.object({
  aprovado: z.preprocess(
    (val) => {
      if (typeof val === 'string') {
        return val === 'true';
      }
      return val;
    },
    z.boolean()
  ),
  comentarios: z.string().min(10, 'O comentário deve ter no mínimo 10 caracteres'),
});

const AvaliarTrabalhoOrientador = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const [trabalho, setTrabalho] = useState(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');

  const {
    register,
    handleSubmit,
    watch,
    setValue,
    formState: { errors, isSubmitting },
  } = useForm({
    resolver: zodResolver(avaliacaoSchema),
    defaultValues: {
      aprovado: true,
      comentarios: '',
    },
  });

  const aprovado = watch('aprovado');

  useEffect(() => {
    carregarTrabalho();
  }, [id]);

  // Debug: log dos erros de validação
  useEffect(() => {
    if (Object.keys(errors).length > 0) {
      console.log('Erros de validação:', errors);
    }
  }, [errors]);

  const carregarTrabalho = async () => {
    try {
      setLoading(true);
      setError('');

      const res = await api.get(`/orientador/trabalhos/${id}`);

      if (res.data.success) {
        setTrabalho(res.data.data);
      }
    } catch (err) {
      console.error('Erro ao carregar trabalho:', err);
      setError(err.response?.data?.message || 'Erro ao carregar trabalho');
    } finally {
      setLoading(false);
    }
  };

  const onSubmit = async (data) => {
    try {
      console.log('=== INÍCIO DA AVALIAÇÃO ===');
      console.log('onSubmit foi chamado!');
      console.log('Dados do formulário:', data);
      console.log('Tipo de aprovado:', typeof data.aprovado);
      console.log('ID do trabalho:', id);
      
      setError('');
      setSuccess('');

      const res = await api.post(`/orientador/trabalhos/${id}/avaliar`, {
        aprovado: data.aprovado,
        comentarios: data.comentarios
      });
      
      console.log('Resposta da API:', res.data);

      if (res.data.success) {
        setSuccess(`Trabalho ${data.aprovado ? 'aprovado' : 'reprovado'} com sucesso!`);
        setTimeout(() => {
          navigate('/orientador/trabalhos');
        }, 2000);
      } else {
        setError(res.data.message || 'Erro ao avaliar trabalho');
      }
    } catch (err) {
      console.error('=== ERRO NA AVALIAÇÃO ===');
      console.error('Erro completo:', err);
      console.error('Resposta do servidor:', err.response?.data);
      console.error('Status do erro:', err.response?.status);
      setError(err.response?.data?.message || 'Erro ao avaliar trabalho');
    }
  };

  const downloadArquivo = () => {
    if (trabalho?.arquivo) {
      // Remove /uploads do início se já estiver presente
      const arquivoPath = trabalho.arquivo.startsWith('trabalhos/') ? trabalho.arquivo : `trabalhos/${trabalho.arquivo}`;
      window.open(`${api.defaults.baseURL}/uploads/${arquivoPath}`, '_blank');
    }
  };

  const getStatusBadge = (status) => {
    const badges = {
      AGUARDANDO_ORIENTADOR: { color: 'warning', text: 'Aguardando Avaliação' },
      APROVADO_ORIENTADOR: { color: 'success', text: 'Aprovado' },
      REPROVADO_ORIENTADOR: { color: 'danger', text: 'Reprovado' },
      EM_AVALIACAO: { color: 'info', text: 'Em Avaliação' },
    };

    const badge = badges[status] || { color: 'secondary', text: status };
    
    return (
      <span className={`br-tag ${badge.color} text-up-01`}>
        {badge.text}
      </span>
    );
  };

  if (loading) {
    return (
      <MainLayout>
        <div className="text-center py-5">
          <div className="br-loading"></div>
          <p className="mt-3">Carregando trabalho...</p>
        </div>
      </MainLayout>
    );
  }

  if (error && !trabalho) {
    return (
      <MainLayout>
        <div className="br-message danger" role="alert">
          <div className="icon">
            <i className="fas fa-times-circle fa-lg"></i>
          </div>
          <div className="content">{error}</div>
        </div>
        <Link to="/orientador/trabalhos" className="br-button secondary mt-3">
          <i className="fas fa-arrow-left mr-2"></i>
          Voltar
        </Link>
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
            <Link to="/orientador/trabalhos">
              <i className="icon fas fa-chevron-right"></i>
              Trabalhos Orientados
            </Link>
          </li>
          <li className="crumb">
            <i className="icon fas fa-chevron-right"></i>
            <span>Avaliar Trabalho</span>
          </li>
        </ul>
      </div>

      <div className="my-4">
        <div className="d-flex justify-content-between align-items-center mb-4">
          <h1 className="text-up-03 text-weight-bold">Avaliar Trabalho</h1>
          <Link to="/orientador/trabalhos" className="br-button secondary">
            <i className="fas fa-arrow-left mr-2"></i>
            Voltar
          </Link>
        </div>

        {error && (
          <div className="br-message danger mb-3" role="alert">
            <div className="icon">
              <i className="fas fa-times-circle fa-lg"></i>
            </div>
            <div className="content">{error}</div>
          </div>
        )}

        {success && (
          <div className="br-message success mb-3" role="alert">
            <div className="icon">
              <i className="fas fa-check-circle fa-lg"></i>
            </div>
            <div className="content">{success}</div>
          </div>
        )}

        {trabalho && (
          <>
            {/* Informações do Trabalho */}
            <div className="br-card mb-4" style={{ padding: '24px' }}>
              <h3 className="text-up-02 text-weight-bold mb-3">
                Informações do Trabalho
              </h3>

              <div className="row mb-3">
                <div className="col-md-8">
                  <p className="text-weight-bold mb-1">Título:</p>
                  <p>{trabalho.titulo}</p>
                </div>
                <div className="col-md-4">
                  <p className="text-weight-bold mb-1">Status:</p>
                  <p>{getStatusBadge(trabalho.status)}</p>
                </div>
              </div>

              <div className="row mb-3">
                <div className="col-md-6">
                  <p className="text-weight-bold mb-1">Autor Principal:</p>
                  <p>{trabalho.autor?.nome || trabalho.autores?.[0]?.nome}</p>
                  <p className="text-down-01">{trabalho.autor?.email}</p>
                </div>
                <div className="col-md-6">
                  <p className="text-weight-bold mb-1">Subárea:</p>
                  <p>{trabalho.subarea?.nome}</p>
                </div>
              </div>

              <div className="row mb-3">
                <div className="col-md-6">
                  <p className="text-weight-bold mb-1">Tipo de Projeto:</p>
                  <p>
                    {trabalho.tipoProjeto === 'PESQUISA' && 'Pesquisa'}
                    {trabalho.tipoProjeto === 'EXTENSAO' && 'Extensão'}
                    {trabalho.tipoProjeto === 'ENSINO' && 'Ensino'}
                  </p>
                </div>
                <div className="col-md-6">
                  <p className="text-weight-bold mb-1">Data de Submissão:</p>
                  <p>{new Date(trabalho.createdAt).toLocaleDateString('pt-BR')}</p>
                </div>
              </div>

              <div className="mb-3">
                <p className="text-weight-bold mb-1">Resumo:</p>
                <p style={{ textAlign: 'justify', wordWrap: 'break-word', overflowWrap: 'break-word' }}>{trabalho.resumo}</p>
              </div>

              <div className="mb-3">
                <p className="text-weight-bold mb-1">Palavras-chave:</p>
                <div className="d-flex flex-wrap gap-2">
                  {trabalho.palavras_chave?.map((palavra, index) => (
                    <span key={index} className="br-tag info">
                      {palavra}
                    </span>
                  ))}
                </div>
              </div>

              {trabalho.autores && trabalho.autores.length > 0 && (
                <div className="mb-3">
                  <p className="text-weight-bold mb-1">Autores:</p>
                  <ul>
                    {trabalho.autores.map((autor, index) => (
                      <li key={index}>
                        {autor.nome} {autor.email && `- ${autor.email}`}
                      </li>
                    ))}
                  </ul>
                </div>
              )}

              {trabalho.arquivo && (
                <div>
                  <button
                    onClick={downloadArquivo}
                    className="br-button primary"
                  >
                    <i className="fas fa-download mr-2"></i>
                    Baixar Arquivo do Trabalho
                  </button>
                </div>
              )}
            </div>

            {/* Parecer Anterior (se existir) */}
            {trabalho.parecerOrientador && (
              <div className="br-card mb-4" style={{ padding: '24px', backgroundColor: '#f5f5f5' }}>
                <h3 className="text-up-02 text-weight-bold mb-3">
                  Parecer Anterior
                </h3>
                <p className="text-weight-bold mb-1">
                  Decisão: 
                  <span className={trabalho.parecerOrientador.aprovado ? 'text-success' : 'text-danger'}>
                    {' '}{trabalho.parecerOrientador.aprovado ? 'APROVADO' : 'REPROVADO'}
                  </span>
                </p>
                <p className="text-weight-bold mb-1">Comentários:</p>
                <p>{trabalho.parecerOrientador.comentarios}</p>
                <p className="text-down-01 mt-2">
                  Data: {new Date(trabalho.parecerOrientador.data).toLocaleString('pt-BR')}
                </p>
              </div>
            )}

            {/* Formulário de Avaliação */}
            <div className="br-card" style={{ padding: '24px' }}>
              <h3 className="text-up-02 text-weight-bold mb-3">
                {trabalho.parecerOrientador ? 'Reavaliar Trabalho' : 'Avaliação do Orientador'}
              </h3>
              {trabalho.parecerOrientador && (
                <div className="br-message warning mb-3" role="alert">
                  <div className="icon">
                    <i className="fas fa-exclamation-triangle fa-lg"></i>
                  </div>
                  <div className="content">
                    Este trabalho já foi avaliado. Você pode modificar sua avaliação abaixo.
                  </div>
                </div>
              )}

                <form onSubmit={handleSubmit(onSubmit)}>
                  <div className="mb-4">
                    <p className="text-weight-bold mb-2">Decisão:</p>
                    <div className="br-radio">
                      <input
                        id="aprovar"
                        type="radio"
                        value="true"
                        {...register('aprovado', {
                          setValueAs: (v) => v === 'true',
                        })}
                      />
                      <label htmlFor="aprovar">
                        <i className="fas fa-check-circle text-success mr-2"></i>
                        Aprovar trabalho
                      </label>
                    </div>
                    <div className="br-radio">
                      <input
                        id="reprovar"
                        type="radio"
                        value="false"
                        {...register('aprovado', {
                          setValueAs: (v) => v === 'true',
                        })}
                      />
                      <label htmlFor="reprovar">
                        <i className="fas fa-times-circle text-danger mr-2"></i>
                        Reprovar trabalho
                      </label>
                    </div>
                    {errors.aprovado && (
                      <span className="feedback danger mt-1" role="alert">
                        <i className="fas fa-times-circle" aria-hidden="true"></i>
                        {errors.aprovado.message}
                      </span>
                    )}
                  </div>

                  <div className="mb-4">
                    <div className={`br-textarea ${errors.comentarios ? 'danger' : ''}`}>
                      <label htmlFor="comentarios">
                        Comentários <span className="text-danger">*</span>
                      </label>
                      <textarea
                        id="comentarios"
                        rows="6"
                        placeholder="Deixe seus comentários sobre o trabalho..."
                        {...register('comentarios')}
                      />
                      {errors.comentarios && (
                        <span className="feedback danger" role="alert">
                          <i className="fas fa-times-circle" aria-hidden="true"></i>
                          {errors.comentarios.message}
                        </span>
                      )}
                    </div>
                  </div>

                  <div className="d-flex gap-3">
                    <button
                      type="submit"
                      disabled={isSubmitting}
                      onClick={(e) => {
                        console.log('Botão clicado!');
                        console.log('Valor de aprovado (watch):', aprovado);
                        console.log('Tipo de aprovado:', typeof aprovado);
                        console.log('Erros atuais:', errors);
                      }}
                      className={`br-button ${aprovado ? 'primary' : 'danger'}`}
                    >
                      {isSubmitting ? (
                        <>
                          <span className="mr-2">Processando...</span>
                          <i className="fas fa-spinner fa-spin"></i>
                        </>
                      ) : (
                        <>
                          <i className={`fas ${aprovado ? 'fa-check' : 'fa-times'} mr-2`}></i>
                          {aprovado ? 'Aprovar Trabalho' : 'Reprovar Trabalho'}
                        </>
                      )}
                    </button>
                  </div>
                </form>
              </div>
          </>
        )}
      </div>
    </MainLayout>
  );
};

export default AvaliarTrabalhoOrientador;
