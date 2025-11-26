import React, { useState, useEffect } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const trabalhoSchema = z.object({
  titulo: z.string().min(10, 'Título deve ter no mínimo 10 caracteres'),
  resumo: z.string().min(100, 'Resumo deve ter no mínimo 100 caracteres'),
  autores: z.string().min(1, 'Informe ao menos um autor'),
  palavras_chave: z.string().min(1, 'Informe ao menos uma palavra-chave'),
  tipoProjeto: z.enum(['PESQUISA', 'EXTENSAO', 'ENSINO'], {
    errorMap: () => ({ message: 'Selecione o tipo de projeto' })
  }),
  orientador: z.string().min(1, 'Selecione um orientador'),
  areaAtuacao: z.string().min(1, 'Selecione uma Área de Atuação'),
  subarea: z.string().min(1, 'Selecione uma Subárea'),
});

const SubmeterTrabalho = () => {
  const navigate = useNavigate();
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  const [arquivo, setArquivo] = useState(null);
  const [areasAtuacao, setAreasAtuacao] = useState([]);
  const [subareas, setSubareas] = useState([]);
  const [subareasFiltradas, setSubareasFiltradas] = useState([]);
  const [docentes, setDocentes] = useState([]);
  
  // Estados para autocomplete de orientador
  const [searchTerm, setSearchTerm] = useState('');
  const [showSuggestions, setShowSuggestions] = useState(false);
  const [filteredDocentes, setFilteredDocentes] = useState([]);
  const [selectedOrientador, setSelectedOrientador] = useState(null);
  
  const {
    register,
    handleSubmit,
    watch,
    setValue,
    formState: { errors, isSubmitting },
  } = useForm({
    resolver: zodResolver(trabalhoSchema),
  });

  const areaAtuacaoSelecionada = watch('areaAtuacao');

  // Carregar áreas de atuação, subáreas e docentes
  useEffect(() => {
    const carregarDados = async () => {
      try {
        const [aaRes, saRes, docRes] = await Promise.all([
          api.get('/public/areas-atuacao'),
          api.get('/public/subareas'),
          api.get('/public/docentes'),
        ]);
        
        if (aaRes.data.success) setAreasAtuacao(aaRes.data.data);
        if (saRes.data.success) setSubareas(saRes.data.data);
        if (docRes.data.success) setDocentes(docRes.data.data);
      } catch (err) {
        console.error('Erro ao carregar dados:', err);
      }
    };
    
    carregarDados();
  }, []);

  // Filtrar subáreas quando a área de atuação muda
  useEffect(() => {
    if (areaAtuacaoSelecionada) {
      const filtradas = subareas.filter(
        (sub) => sub.areaAtuacao?._id === areaAtuacaoSelecionada || sub.areaAtuacao === areaAtuacaoSelecionada
      );
      setSubareasFiltradas(filtradas);
    } else {
      setSubareasFiltradas([]);
    }
  }, [areaAtuacaoSelecionada, subareas]);

  // Filtrar docentes conforme o usuário digita
  useEffect(() => {
    if (searchTerm.trim().length > 0) {
      const filtered = docentes.filter((doc) =>
        doc.nome.toLowerCase().includes(searchTerm.toLowerCase())
      );
      setFilteredDocentes(filtered);
    } else {
      setFilteredDocentes([]);
    }
  }, [searchTerm, docentes]);

  // Função para selecionar um orientador do autocomplete
  const handleSelectOrientador = (docente) => {
    setSelectedOrientador(docente);
    setSearchTerm(docente.nome);
    setValue('orientador', docente._id);
    setShowSuggestions(false);
  };

  // Fechar sugestões ao clicar fora
  useEffect(() => {
    const handleClickOutside = (event) => {
      const autocompleteContainer = document.getElementById('orientador');
      if (autocompleteContainer && !autocompleteContainer.closest('.mb-3').contains(event.target)) {
        setShowSuggestions(false);
      }
    };

    document.addEventListener('mousedown', handleClickOutside);
    return () => document.removeEventListener('mousedown', handleClickOutside);
  }, []);
  
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
      data.append('resumo', formData.resumo);
      data.append('autores', JSON.stringify(autoresArray));
      data.append('palavras_chave', JSON.stringify(palavrasChaveArray));
      data.append('tipoProjeto', formData.tipoProjeto);
      data.append('orientador', formData.orientador);
      data.append('areaAtuacao', formData.areaAtuacao);
      data.append('subarea', formData.subarea);
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
                <label htmlFor="resumo">
                  Resumo <span className="text-danger">*</span>
                  <span className="text-down-01 ml-2">(mínimo 100 caracteres)</span>
                </label>
                <textarea
                  {...register('resumo')}
                  id="resumo"
                  rows="6"
                  placeholder="Descreva o resumo do seu trabalho..."
                  className={errors.resumo ? 'danger' : ''}
                />
                {errors.resumo && (
                  <span className="feedback danger" role="alert">
                    <i className="fas fa-times-circle" aria-hidden="true"></i>
                    {errors.resumo.message}
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

              <div className="mb-3">
                <div className={`br-input ${errors.tipoProjeto ? 'danger' : ''}`}>
                  <label htmlFor="tipoProjeto">
                    Tipo de Projeto <span className="text-danger">*</span>
                  </label>
                  <select
                    id="tipoProjeto"
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
                    {...register('tipoProjeto')}
                  >
                    <option value="">Selecione...</option>
                    <option value="PESQUISA">Pesquisa</option>
                    <option value="EXTENSAO">Extensão</option>
                    <option value="ENSINO">Ensino</option>
                  </select>
                  {errors.tipoProjeto && (
                    <span className="feedback danger" role="alert">
                      <i className="fas fa-times-circle" aria-hidden="true"></i>
                      {errors.tipoProjeto.message}
                    </span>
                  )}
                </div>
              </div>

              <div className="mb-3" style={{ position: 'relative' }}>
                <div className={`br-input ${errors.orientador ? 'danger' : ''}`}>
                  <label htmlFor="orientador">
                    Orientador <span className="text-danger">*</span>
                  </label>
                  <input
                    type="text"
                    id="orientador"
                    placeholder="Digite o nome do orientador..."
                    value={searchTerm}
                    onChange={(e) => {
                      setSearchTerm(e.target.value);
                      setShowSuggestions(true);
                      if (!e.target.value) {
                        setValue('orientador', '');
                        setSelectedOrientador(null);
                      }
                    }}
                    onFocus={() => setShowSuggestions(true)}
                    autoComplete="off"
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
                  />
                  <input type="hidden" {...register('orientador')} />
                  {errors.orientador && (
                    <span className="feedback danger" role="alert">
                      <i className="fas fa-times-circle" aria-hidden="true"></i>
                      {errors.orientador.message}
                    </span>
                  )}
                </div>
                
                {/* Lista de sugestões */}
                {showSuggestions && searchTerm && filteredDocentes.length > 0 && (
                  <div
                    style={{
                      position: 'absolute',
                      top: '100%',
                      left: 0,
                      right: 0,
                      zIndex: 1000,
                      backgroundColor: '#fff',
                      border: '1px solid #888',
                      borderTop: 'none',
                      borderRadius: '0 0 4px 4px',
                      maxHeight: '200px',
                      overflowY: 'auto',
                      boxShadow: '0 4px 8px rgba(0,0,0,0.1)'
                    }}
                  >
                    {filteredDocentes.map((doc) => (
                      <div
                        key={doc._id}
                        onClick={() => handleSelectOrientador(doc)}
                        style={{
                          padding: '10px 12px',
                          cursor: 'pointer',
                          borderBottom: '1px solid #e0e0e0',
                          fontSize: '14px'
                        }}
                        onMouseEnter={(e) => e.target.style.backgroundColor = '#f5f5f5'}
                        onMouseLeave={(e) => e.target.style.backgroundColor = '#fff'}
                      >
                        <div style={{ fontWeight: '500' }}>{doc.nome}</div>
                        {doc.instituicao?.nome && (
                          <div style={{ fontSize: '12px', color: '#666', marginTop: '2px' }}>
                            {doc.instituicao.nome}
                          </div>
                        )}
                      </div>
                    ))}
                  </div>
                )}
                
                {showSuggestions && searchTerm && filteredDocentes.length === 0 && (
                  <div
                    style={{
                      position: 'absolute',
                      top: '100%',
                      left: 0,
                      right: 0,
                      zIndex: 1000,
                      backgroundColor: '#fff',
                      border: '1px solid #888',
                      borderTop: 'none',
                      borderRadius: '0 0 4px 4px',
                      padding: '10px 12px',
                      color: '#666',
                      fontSize: '14px',
                      boxShadow: '0 4px 8px rgba(0,0,0,0.1)'
                    }}
                  >
                    Nenhum orientador encontrado
                  </div>
                )}
              </div>

              <div className="mb-3">
                <div className={`br-input ${errors.areaAtuacao ? 'danger' : ''}`}>
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
                    {...register('areaAtuacao')}
                  >
                    <option value="">Selecione...</option>
                    {areasAtuacao.map((area) => (
                      <option key={area._id} value={area._id}>
                        {area.nome}
                      </option>
                    ))}
                  </select>
                  {errors.areaAtuacao && (
                    <span className="feedback danger" role="alert">
                      <i className="fas fa-times-circle" aria-hidden="true"></i>
                      {errors.areaAtuacao.message}
                    </span>
                  )}
                </div>
              </div>

              <div className="mb-3">
                <div className={`br-input ${errors.subarea ? 'danger' : ''}`}>
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
                    {...register('subarea')}
                    disabled={!areaAtuacaoSelecionada || subareasFiltradas.length === 0}
                  >
                    <option value="">
                      {!areaAtuacaoSelecionada 
                        ? 'Selecione primeiro uma Área de Atuação' 
                        : subareasFiltradas.length === 0 
                        ? 'Nenhuma subárea disponível'
                        : 'Selecione...'}
                    </option>
                    {subareasFiltradas.map((sub) => (
                      <option key={sub._id} value={sub._id}>
                        {sub.nome}
                      </option>
                    ))}
                  </select>
                  {errors.subarea && (
                    <span className="feedback danger" role="alert">
                      <i className="fas fa-times-circle" aria-hidden="true"></i>
                      {errors.subarea.message}
                    </span>
                  )}
                </div>
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
