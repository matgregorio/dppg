import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { 
  PieChart, Pie, BarChart, Bar, LineChart, Line,
  XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer, Cell 
} from 'recharts';
import MainLayout from '../layouts/MainLayout';
import { BrSelect } from '@govbr-ds/react-components';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

const DashboardAdmin = () => {
  const [stats, setStats] = useState(null);
  const [loading, setLoading] = useState(true);
  const [simposioFiltro, setSimposioFiltro] = useState('');
  const [simposios, setSimposios] = useState([]);
  const [uploadingBanner, setUploadingBanner] = useState(false);
  const { showError, showSuccess } = useNotification();

  const COLORS = {
    'EM_ANALISE': '#FFC107',
    'AVALIADO': '#17A2B8',
    'APROVADO': '#28A745',
    'REJEITADO': '#DC3545',
    'APROVADO_CONDICIONAL': '#FF9800',
  };

  const STATUS_LABELS = {
    'EM_ANALISE': 'Em Análise',
    'AVALIADO': 'Avaliado',
    'APROVADO': 'Aprovado',
    'REJEITADO': 'Rejeitado',
    'APROVADO_CONDICIONAL': 'Aprovado Condicional',
  };

  useEffect(() => {
    fetchSimposios();
  }, []);

  useEffect(() => {
    fetchStats();
  }, [simposioFiltro]);

  const fetchSimposios = async () => {
    try {
      const { data } = await api.get('/public/simposios');
      if (data.success) {
        setSimposios(data.data);
      }
    } catch (err) {
      console.error('Erro ao carregar simpósios:', err);
    }
  };

  const fetchStats = async () => {
    try {
      setLoading(true);
      const { data } = await api.get('/admin/dashboard/stats', {
        params: simposioFiltro ? { simposio: simposioFiltro } : {},
      });
      
      if (data.success) {
        setStats(data.data);
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao carregar estatísticas');
    } finally {
      setLoading(false);
    }
  };

  const handleUploadBanner = async (event) => {
    const file = event.target.files[0];
    if (!file) return;

    // Validar tipo de arquivo
    const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    if (!validTypes.includes(file.type)) {
      showError('Formato inválido. Use JPG ou PNG.');
      return;
    }

    // Validar tamanho (5MB)
    if (file.size > 5 * 1024 * 1024) {
      showError('Arquivo muito grande. Tamanho máximo: 5MB.');
      return;
    }

    try {
      setUploadingBanner(true);
      const formData = new FormData();
      formData.append('banner', file);

      const { data } = await api.post('/admin/upload-banner', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });

      if (data.success) {
        showSuccess('Banner atualizado com sucesso! Recarregue a página inicial para ver.');
        // Limpar input
        event.target.value = '';
      }
    } catch (err) {
      showError(err.response?.data?.message || 'Erro ao fazer upload do banner');
    } finally {
      setUploadingBanner(false);
    }
  };

  if (loading) {
    return (
      <MainLayout>
        <div className="text-center my-5">
          <div className="spinner-border text-primary" role="status">
            <span className="sr-only">Carregando...</span>
          </div>
        </div>
      </MainLayout>
    );
  }

  if (!stats) return null;

  // Preparar dados para gráficos
  const trabalhosPorStatusData = Object.entries(stats.trabalhosPorStatus).map(([key, value]) => ({
    name: STATUS_LABELS[key] || key,
    value,
    color: COLORS[key],
  })).filter(item => item.value > 0);

  const inscricoesPorTipoData = Object.entries(stats.inscricoesPorTipo).map(([key, value]) => ({
    name: key,
    inscricoes: value,
  }));

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
            <span>Dashboard</span>
          </li>
        </ul>
      </div>

      <div className="my-4">
        <div className="d-flex justify-content-between align-items-center mb-4">
          <h1 className="text-up-03 text-weight-bold">
            <i className="fas fa-chart-line mr-2"></i>
            Dashboard Administrativo
          </h1>
          
          
          <BrSelect
            placeholder="Selecione o simpósio"
            options={[
              { label: 'Todos os Simpósios', value: '' },
              ...simposios.map(s => ({ label: s.ano.toString(), value: s._id }))
            ]}
            onChange={(value) => setSimposioFiltro(value)}
            value={simposioFiltro}
            emptyOptionsMessage="Nenhum simpósio encontrado"
            type="single"
            className="" 
            style={{ minWidth: '200px' }}
          />
        </div>

        {/* Upload de Banner */}
        <div className="row mb-4">
          <div className="col-12">
            <div className="br-card">
              <div className="card-header" style={{ background: '#1351B4', color: 'white' }}>
                <h5 className="mb-0">
                  <i className="fas fa-image mr-2"></i>
                  Gerenciar Banner da Página Inicial
                </h5>
              </div>
              <div className="card-content p-4">
                <div className="row align-items-center">
                  <div className="col-md-8">
                    <p className="mb-2">
                      <strong>Atualize o banner principal</strong> que aparece na página inicial do sistema.
                    </p>
                    <p className="text-muted mb-0">
                      <i className="fas fa-info-circle mr-1"></i>
                      Formatos aceitos: JPG ou PNG | Tamanho máximo: 5MB | Dimensões recomendadas: 1920x400px
                    </p>
                  </div>
                  <div className="col-md-4 text-center">
                    <label 
                      htmlFor="banner-upload" 
                      className="br-button primary"
                      style={{ cursor: uploadingBanner ? 'not-allowed' : 'pointer', opacity: uploadingBanner ? 0.6 : 1 }}
                    >
                      {uploadingBanner ? (
                        <>
                          <span className="spinner-border spinner-border-sm mr-2" role="status"></span>
                          Enviando...
                        </>
                      ) : (
                        <>
                          <i className="fas fa-upload mr-2"></i>
                          Escolher Banner
                        </>
                      )}
                    </label>
                    <input
                      id="banner-upload"
                      type="file"
                      accept="image/jpeg,image/jpg,image/png"
                      onChange={handleUploadBanner}
                      disabled={uploadingBanner}
                      style={{ display: 'none' }}
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Cards de Resumo */}
        <div className="row mb-4">
          <div className="col-md-3">
            <Link to="/admin/trabalhos" style={{ textDecoration: 'none', color: 'inherit' }}>
              <div className="br-card" style={{ 
                background: '#E8F5E9', 
                borderLeft: '4px solid #28A745',
                cursor: 'pointer',
                transition: 'transform 0.2s, box-shadow 0.2s'
              }}
              onMouseEnter={(e) => {
                e.currentTarget.style.transform = 'translateY(-2px)';
                e.currentTarget.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';
              }}
              onMouseLeave={(e) => {
                e.currentTarget.style.transform = 'translateY(0)';
                e.currentTarget.style.boxShadow = 'none';
              }}>
                <div className="card-content p-3">
                  <div className="d-flex justify-content-between align-items-center">
                    <div>
                      <p className="text-muted mb-1">Total de Trabalhos</p>
                      <h2 className="mb-0">{stats.totais.trabalhos}</h2>
                    </div>
                    <i className="fas fa-file-alt fa-3x" style={{ color: '#28A745', opacity: 0.3 }}></i>
                  </div>
                </div>
              </div>
            </Link>
          </div>

          <div className="col-md-3">
            <Link to="/admin/participantes" style={{ textDecoration: 'none', color: 'inherit' }}>
              <div className="br-card" style={{ 
                background: '#E3F2FD', 
                borderLeft: '4px solid #2196F3',
                cursor: 'pointer',
                transition: 'transform 0.2s, box-shadow 0.2s'
              }}
              onMouseEnter={(e) => {
                e.currentTarget.style.transform = 'translateY(-2px)';
                e.currentTarget.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';
              }}
              onMouseLeave={(e) => {
                e.currentTarget.style.transform = 'translateY(0)';
                e.currentTarget.style.boxShadow = 'none';
              }}>
                <div className="card-content p-3">
                  <div className="d-flex justify-content-between align-items-center">
                    <div>
                      <p className="text-muted mb-1">Participantes</p>
                      <h2 className="mb-0">{stats.totais.participantes}</h2>
                    </div>
                    <i className="fas fa-users fa-3x" style={{ color: '#2196F3', opacity: 0.3 }}></i>
                  </div>
                </div>
              </div>
            </Link>
          </div>

          <div className="col-md-3">
            <Link to="/admin/avaliadores" style={{ textDecoration: 'none', color: 'inherit' }}>
              <div className="br-card" style={{ 
                background: '#FFF3E0', 
                borderLeft: '4px solid #FF9800',
                cursor: 'pointer',
                transition: 'transform 0.2s, box-shadow 0.2s'
              }}
              onMouseEnter={(e) => {
                e.currentTarget.style.transform = 'translateY(-2px)';
                e.currentTarget.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';
              }}
              onMouseLeave={(e) => {
                e.currentTarget.style.transform = 'translateY(0)';
                e.currentTarget.style.boxShadow = 'none';
              }}>
                <div className="card-content p-3">
                  <div className="d-flex justify-content-between align-items-center">
                    <div>
                      <p className="text-muted mb-1">Avaliadores</p>
                      <h2 className="mb-0">{stats.totais.avaliadores}</h2>
                    </div>
                    <i className="fas fa-user-check fa-3x" style={{ color: '#FF9800', opacity: 0.3 }}></i>
                  </div>
                </div>
              </div>
            </Link>
          </div>

          <div className="col-md-3">
            <Link to="/admin/participantes" style={{ textDecoration: 'none', color: 'inherit' }}>
              <div className="br-card" style={{ 
                background: '#FCE4EC', 
                borderLeft: '4px solid #E91E63',
                cursor: 'pointer',
                transition: 'transform 0.2s, box-shadow 0.2s'
              }}
              onMouseEnter={(e) => {
                e.currentTarget.style.transform = 'translateY(-2px)';
                e.currentTarget.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';
              }}
              onMouseLeave={(e) => {
                e.currentTarget.style.transform = 'translateY(0)';
                e.currentTarget.style.boxShadow = 'none';
              }}>
                <div className="card-content p-3">
                  <div className="d-flex justify-content-between align-items-center">
                    <div>
                      <p className="text-muted mb-1">Inscrições</p>
                      <h2 className="mb-0">{stats.totais.inscricoes}</h2>
                    </div>
                    <i className="fas fa-clipboard-check fa-3x" style={{ color: '#E91E63', opacity: 0.3 }}></i>
                  </div>
                </div>
              </div>
            </Link>
          </div>
        </div>

        {/* Alertas */}
        {(stats.avaliacoesPendentes > 0 || stats.trabalhosProntosParaFinalizar > 0) && (
          <div className="row mb-4">
            {stats.avaliacoesPendentes > 0 && (
              <div className="col-md-6">
                <div className="br-message warning">
                  <div className="icon">
                    <i className="fas fa-exclamation-triangle"></i>
                  </div>
                  <div className="content">
                    <strong>{stats.avaliacoesPendentes} trabalho(s)</strong> aguardando avaliações
                  </div>
                </div>
              </div>
            )}
            
            {stats.trabalhosProntosParaFinalizar > 0 && (
              <div className="col-md-6">
                <div className="br-message info">
                  <div className="icon">
                    <i className="fas fa-info-circle"></i>
                  </div>
                  <div className="content">
                    <strong>{stats.trabalhosProntosParaFinalizar} trabalho(s)</strong> prontos para finalização
                  </div>
                </div>
              </div>
            )}
          </div>
        )}

        {/* Gráficos */}
        <div className="row">
          {/* Trabalhos por Status - Pie Chart */}
          <div className="col-md-6 mb-4">
            <div className="br-card">
              <div className="card-header">
                <h4>Trabalhos por Status</h4>
              </div>
              <div className="card-content p-3">
                {trabalhosPorStatusData.length > 0 ? (
                  <ResponsiveContainer width="100%" height={300}>
                    <PieChart>
                      <Pie
                        data={trabalhosPorStatusData}
                        cx="50%"
                        cy="50%"
                        labelLine={false}
                        label={({ name, value }) => `${name}: ${value}`}
                        outerRadius={80}
                        fill="#8884d8"
                        dataKey="value"
                      >
                        {trabalhosPorStatusData.map((entry, index) => (
                          <Cell key={`cell-${index}`} fill={entry.color} />
                        ))}
                      </Pie>
                      <Tooltip />
                    </PieChart>
                  </ResponsiveContainer>
                ) : (
                  <p className="text-center text-muted">Nenhum dado disponível</p>
                )}
              </div>
            </div>
          </div>

          {/* Inscrições por Tipo - Bar Chart */}
          <div className="col-md-6 mb-4">
            <div className="br-card">
              <div className="card-header">
                <h4>Inscrições por Tipo</h4>
              </div>
              <div className="card-content p-3">
                {inscricoesPorTipoData.length > 0 ? (
                  <ResponsiveContainer width="100%" height={300}>
                    <BarChart data={inscricoesPorTipoData}>
                      <CartesianGrid strokeDasharray="3 3" />
                      <XAxis dataKey="name" />
                      <YAxis />
                      <Tooltip />
                      <Legend />
                      <Bar dataKey="inscricoes" fill="#155BCB" />
                    </BarChart>
                  </ResponsiveContainer>
                ) : (
                  <p className="text-center text-muted">Nenhum dado disponível</p>
                )}
              </div>
            </div>
          </div>

          {/* Timeline de Submissões - Line Chart */}
          <div className="col-md-12 mb-4">
            <div className="br-card">
              <div className="card-header">
                <h4>Timeline de Submissões (Últimos 30 dias)</h4>
              </div>
              <div className="card-content p-3">
                {stats.timeline.length > 0 ? (
                  <ResponsiveContainer width="100%" height={300}>
                    <LineChart data={stats.timeline}>
                      <CartesianGrid strokeDasharray="3 3" />
                      <XAxis dataKey="data" />
                      <YAxis />
                      <Tooltip />
                      <Legend />
                      <Line type="monotone" dataKey="submissoes" stroke="#155BCB" strokeWidth={2} />
                    </LineChart>
                  </ResponsiveContainer>
                ) : (
                  <p className="text-center text-muted">Nenhuma submissão nos últimos 30 dias</p>
                )}
              </div>
            </div>
          </div>
        </div>
      </div>
    </MainLayout>
  );
};

export default DashboardAdmin;
