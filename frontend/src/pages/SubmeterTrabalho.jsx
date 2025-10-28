import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const trabalhoSchema = z.object({
  titulo: z.string().min(10, 'Título deve ter no mínimo 10 caracteres'),
  autores: z.string().min(1, 'Informe ao menos um autor'),
  palavras_chave: z.string().min(1, 'Informe ao menos uma palavra-chave'),
  grandeArea: z.string().optional(),
  areaAtuacao: z.string().optional(),
  subarea: z.string().optional(),
});

const SubmeterTrabalho = () => {
  const navigate = useNavigate();
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  const [arquivo, setArquivo] = useState(null);
  
  const {
    register,
    handleSubmit,
    formState: { errors, isSubmitting },
  } = useForm({
    resolver: zodResolver(trabalhoSchema),
  });
  
  const onSubmit = async (formData) => {
    try {
      setError('');
      setSuccess('');
      
      // Converter autores e palavras-chave de string para array
      const autoresArray = formData.autores.split('\n')
        .filter(a => a.trim())
        .map(linha => {
          const [nome, email, cpf] = linha.split(',').map(s => s.trim());
          return { nome, email, cpf };
        });
      
      const palavrasChaveArray = formData.palavras_chave.split(',').map(p => p.trim());
      
      // Criar FormData
      const data = new FormData();
      data.append('titulo', formData.titulo);
      data.append('autores', JSON.stringify(autoresArray));
      data.append('palavras_chave', JSON.stringify(palavrasChaveArray));
      if (formData.grandeArea) data.append('grandeArea', formData.grandeArea);
      if (formData.areaAtuacao) data.append('areaAtuacao', formData.areaAtuacao);
      if (formData.subarea) data.append('subarea', formData.subarea);
      if (arquivo) data.append('arquivo', arquivo);
      data.append('ano', new Date().getFullYear());
      
      const response = await api.post('/user/trabalhos', data, {
        headers: { 'Content-Type': 'multipart/form-data' },
      });
      
      if (response.data.success) {
        setSuccess('Trabalho submetido com sucesso!');
        setTimeout(() => navigate('/trabalhos'), 2000);
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao submeter trabalho');
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
            <Link to="/trabalhos">Meus Trabalhos</Link>
          </li>
          <li className="crumb">
            <i className="icon fas fa-chevron-right"></i>
            <span>Submeter</span>
          </li>
        </ul>
      </div>
      
      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">Submeter Trabalho</h1>
        
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
        
        <div className="br-card">
          <div className="card-content">
            <form onSubmit={handleSubmit(onSubmit)}>
              <div className="br-input mb-3">
                <label htmlFor="titulo">
                  Título do Trabalho <span className="text-danger">*</span>
                </label>
                <input
                  {...register('titulo')}
                  id="titulo"
                  type="text"
                  placeholder="Ex: Análise de Algoritmos para Simpósios"
                  className={errors.titulo ? 'danger' : ''}
                />
                {errors.titulo && (
                  <span className="feedback danger" role="alert">
                    <i className="fas fa-times-circle" aria-hidden="true"></i>
                    {errors.titulo.message}
                  </span>
                )}
              </div>
              
              <div className="br-textarea mb-3">
                <label htmlFor="autores">
                  Autores <span className="text-danger">*</span>
                  <span className="text-down-01 ml-2">(um por linha: Nome, Email, CPF)</span>
                </label>
                <textarea
                  {...register('autores')}
                  id="autores"
                  rows="4"
                  placeholder="João Silva, joao@email.com, 12345678900"
                  className={errors.autores ? 'danger' : ''}
                />
                {errors.autores && (
                  <span className="feedback danger" role="alert">
                    <i className="fas fa-times-circle" aria-hidden="true"></i>
                    {errors.autores.message}
                  </span>
                )}
              </div>
              
              <div className="br-input mb-3">
                <label htmlFor="palavras_chave">
                  Palavras-chave <span className="text-danger">*</span>
                  <span className="text-down-01 ml-2">(separadas por vírgula)</span>
                </label>
                <input
                  {...register('palavras_chave')}
                  id="palavras_chave"
                  type="text"
                  placeholder="algoritmos, otimização, performance"
                  className={errors.palavras_chave ? 'danger' : ''}
                />
                {errors.palavras_chave && (
                  <span className="feedback danger" role="alert">
                    <i className="fas fa-times-circle" aria-hidden="true"></i>
                    {errors.palavras_chave.message}
                  </span>
                )}
              </div>
              
              <div className="br-upload mb-3">
                <label htmlFor="arquivo" className="upload-label">
                  <i className="fas fa-upload mr-2" aria-hidden="true"></i>
                  <span>Arquivo do Trabalho (PDF)</span>
                  <input
                    id="arquivo"
                    type="file"
                    accept=".pdf"
                    onChange={(e) => setArquivo(e.target.files[0])}
                  />
                </label>
                {arquivo && (
                  <div className="upload-list">
                    <div className="br-item">
                      <div className="content">
                        <i className="fas fa-file-pdf mr-2"></i>
                        {arquivo.name}
                      </div>
                    </div>
                  </div>
                )}
              </div>
              
              <div className="d-flex justify-content-between mt-4">
                <Link to="/trabalhos" className="br-button secondary">
                  Cancelar
                </Link>
                <button type="submit" className="br-button primary" disabled={isSubmitting}>
                  {isSubmitting ? 'Enviando...' : 'Submeter Trabalho'}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </MainLayout>
  );
};

export default SubmeterTrabalho;
