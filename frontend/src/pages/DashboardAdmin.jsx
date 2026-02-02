import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { 
  PieChart, Pie, BarChart, Bar, LineChart, Line,
  XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer, Cell 
} from 'recharts';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

const DashboardAdmin = () => {
  const [stats, setStats] = useState(null);
  const [loading, setLoading] = useState(true);
  const [simposioAtual, setSimposioAtual] = useState(null);
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
    fetchSimposioAtual();
  }, []);

  const fetchSimposioAtual = async () => {
    try {
      // Buscar simpósio em execução (status INICIALIZADO)
      const { data } = await api.get('/public/simposios');
      if (data.success && data.data.length > 0) {
        // Pegar o simpósio mais recente ou em execução
        const simposioEmExecucao = data.data.find(s => s.status === 'INICIALIZADO') || data.data[0];
        setSimposioAtual(simposioEmExecucao);
        fetchStats(simposioEmExecucao._id);
      } else {
        setLoading(false);
      }
    } catch (err) {
      showError('Erro ao carregar simpósio atual');
      setLoading(false);
    }
  };

  const fetchStats = async (simposioId) => {
    try {
      setLoading(true);
      const { data } = await api.get('/admin/dashboard/stats', {
        params: { simposio: simposioId },
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
          <div>
            <h1 className="text-up-03 text-weight-bold">
              <i className="fas fa-chart-line mr-2"></i>
              Dashboard Administrativo
            </h1>
            {simposioAtual && (
              <p className="text-muted mb-0">
                <i className="fas fa-calendar mr-2"></i>
                Simpósio {simposioAtual.ano}
              </p>
            )}
          </div>
        </div>
      </div>

      <div className="my-4">
        <div className="row mb-4">
          <div className="col-md-3">
            <Link to="/admin/trabalhos" style={{ textDecoration: 'none', color: 'inherit' }}>
              <div className="br-card" 
                style={{ 
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
              <div className="br-card" 
                style={{ 
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
              <div className="br-card" 
                style={{ 
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
            <Link to="/admin/inscricoes" style={{ textDecoration: 'none', color: 'inherit' }}>
              <div className="br-card" 
                style={{ 
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

        {/* Linha adicional de cards */}
        <div className="row mb-4">
          <div className="col-md-3">
            <Link to="/admin/docentes" style={{ textDecoration: 'none', color: 'inherit' }}>
              <div className="br-card" 
                style={{ 
                  background: '#F3E5F5', 
                  borderLeft: '4px solid #9C27B0',
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
                      <p className="text-muted mb-1">Docentes</p>
                      <h2 className="mb-0">{stats.totais.docentes || 0}</h2>
                    </div>
                    <i className="fas fa-chalkboard-teacher fa-3x" style={{ color: '#9C27B0', opacity: 0.3 }}></i>
                  </div>
                </div>
              </div>
            </Link>
          </div>

          <div className="col-md-3">
            <Link to="/admin/instituicoes" style={{ textDecoration: 'none', color: 'inherit' }}>
              <div className="br-card" 
                style={{ 
                  background: '#E0F2F1', 
                  borderLeft: '4px solid #009688',
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
                      <p className="text-muted mb-1">Instituições</p>
                      <h2 className="mb-0">{stats.totais.instituicoes || 0}</h2>
                    </div>
                    <i className="fas fa-university fa-3x" style={{ color: '#009688', opacity: 0.3 }}></i>
                  </div>
                </div>
              </div>
            </Link>
          </div>

          <div className="col-md-3">
            <Link to="/admin/subeventos" style={{ textDecoration: 'none', color: 'inherit' }}>
              <div className="br-card" 
                style={{ 
                  background: '#FFF8E1', 
                  borderLeft: '4px solid #FBC02D',
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
                      <p className="text-muted mb-1">Subeventos</p>
                      <h2 className="mb-0">{stats.totais.subeventos || 0}</h2>
                    </div>
                    <i className="fas fa-calendar-alt fa-3x" style={{ color: '#FBC02D', opacity: 0.3 }}></i>
                  </div>
                </div>
              </div>
            </Link>
          </div>

          <div className="col-md-3">
            <Link to="/admin/areas" style={{ textDecoration: 'none', color: 'inherit' }}>
              <div className="br-card" 
                style={{ 
                  background: '#FFEBEE', 
                  borderLeft: '4px solid #F44336',
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
                      <p className="text-muted mb-1">Áreas de Atuação</p>
                      <h2 className="mb-0">{stats.totais.areasAtuacao || 0}</h2>
                    </div>
                    <i className="fas fa-book-reader fa-3x" style={{ color: '#F44336', opacity: 0.3 }}></i>
                  </div>
                </div>
              </div>
            </Link>
          </div>
        </div>

        {/* Ações Rápidas */}
        <div className="row mb-4">
          <div className="col-12">
            <h3 className="text-up-02 text-weight-semi-bold mb-3">
              <i className="fas fa-bolt mr-2"></i>
              Ações Rápidas
            </h3>
          </div>
          
          <div className="col-md-4">
            <Link to="/admin/simposio" style={{ textDecoration: 'none' }}>
              <div className="br-card" 
                style={{ 
                  cursor: 'pointer',
                  transition: 'transform 0.2s, box-shadow 0.2s',
                  borderTop: '3px solid #1351B4'
                }}
                onMouseEnter={(e) => {
                  e.currentTarget.style.transform = 'translateY(-2px)';
                  e.currentTarget.style.boxShadow = '0 4px 8px rgba(0,0,0,0.15)';
                }}
                onMouseLeave={(e) => {
                  e.currentTarget.style.transform = 'translateY(0)';
                  e.currentTarget.style.boxShadow = 'none';
                }}>
                <div className="card-content p-3">
                  <div className="text-center">
                    <i className="fas fa-cog fa-2x mb-2" style={{ color: '#1351B4' }}></i>
                    <h5 className="mb-1">Gerenciar Simpósio</h5>
                    <p className="text-muted small mb-0">Configure datas, áreas e subeventos</p>
                  </div>
                </div>
              </div>
            </Link>
          </div>

          <div className="col-md-4">
            <Link to="/admin/certificados" style={{ textDecoration: 'none' }}>
              <div className="br-card" 
                style={{ 
                  cursor: 'pointer',
                  transition: 'transform 0.2s, box-shadow 0.2s',
                  borderTop: '3px solid #28A745'
                }}
                onMouseEnter={(e) => {
                  e.currentTarget.style.transform = 'translateY(-2px)';
                  e.currentTarget.style.boxShadow = '0 4px 8px rgba(0,0,0,0.15)';
                }}
                onMouseLeave={(e) => {
                  e.currentTarget.style.transform = 'translateY(0)';
                  e.currentTarget.style.boxShadow = 'none';
                }}>
                <div className="card-content p-3">
                  <div className="text-center">
                    <i className="fas fa-certificate fa-2x mb-2" style={{ color: '#28A745' }}></i>
                    <h5 className="mb-1">Certificados</h5>
                    <p className="text-muted small mb-0">Gerar e enviar certificados</p>
                  </div>
                </div>
              </div>
            </Link>
          </div>

          <div className="col-md-4">
            <Link to="/admin/paginas" style={{ textDecoration: 'none' }}>
              <div className="br-card" 
                style={{ 
                  cursor: 'pointer',
                  transition: 'transform 0.2s, box-shadow 0.2s',
                  borderTop: '3px solid #9C27B0'
                }}
                onMouseEnter={(e) => {
                  e.currentTarget.style.transform = 'translateY(-2px)';
                  e.currentTarget.style.boxShadow = '0 4px 8px rgba(0,0,0,0.15)';
                }}
                onMouseLeave={(e) => {
                  e.currentTarget.style.transform = 'translateY(0)';
                  e.currentTarget.style.boxShadow = 'none';
                }}>
                <div className="card-content p-3">
                  <div className="text-center">
                    <i className="fas fa-file-alt fa-2x mb-2" style={{ color: '#9C27B0' }}></i>
                    <h5 className="mb-1">Páginas Estáticas</h5>
                    <p className="text-muted small mb-0">Editar conteúdo e banner da página inicial</p>
                  </div>
                </div>
              </div>
            </Link>
          </div>
        </div>

        <div className="row mb-4">
          <div className="col-md-4">
            <Link to="/admin/relatorios" style={{ textDecoration: 'none' }}>
              <div className="br-card" 
                style={{ 
                  cursor: 'pointer',
                  transition: 'transform 0.2s, box-shadow 0.2s',
                  borderTop: '3px solid #FF9800'
                }}
                onMouseEnter={(e) => {
                  e.currentTarget.style.transform = 'translateY(-2px)';
                  e.currentTarget.style.boxShadow = '0 4px 8px rgba(0,0,0,0.15)';
                }}
                onMouseLeave={(e) => {
                  e.currentTarget.style.transform = 'translateY(0)';
                  e.currentTarget.style.boxShadow = 'none';
                }}>
                <div className="card-content p-3">
                  <div className="text-center">
                    <i className="fas fa-file-pdf fa-2x mb-2" style={{ color: '#FF9800' }}></i>
                    <h5 className="mb-1">Relatórios</h5>
                    <p className="text-muted small mb-0">Exportar relatórios e estatísticas</p>
                  </div>
                </div>
              </div>
            </Link>
          </div>

          <div className="col-md-4">
            <Link to="/admin/acervo" style={{ textDecoration: 'none' }}>
              <div className="br-card" 
                style={{ 
                  cursor: 'pointer',
                  transition: 'transform 0.2s, box-shadow 0.2s',
                  borderTop: '3px solid #17A2B8'
                }}
                onMouseEnter={(e) => {
                  e.currentTarget.style.transform = 'translateY(-2px)';
                  e.currentTarget.style.boxShadow = '0 4px 8px rgba(0,0,0,0.15)';
                }}
                onMouseLeave={(e) => {
                  e.currentTarget.style.transform = 'translateY(0)';
                  e.currentTarget.style.boxShadow = 'none';
                }}>
                <div className="card-content p-3">
                  <div className="text-center">
                    <i className="fas fa-archive fa-2x mb-2" style={{ color: '#17A2B8' }}></i>
                    <h5 className="mb-1">Acervo</h5>
                    <p className="text-muted small mb-0">Gerenciar trabalhos publicados</p>
                  </div>
                </div>
              </div>
            </Link>
          </div>

          <div className="col-md-4">
            <Link to="/admin/funcoes" style={{ textDecoration: 'none' }}>
              <div className="br-card" 
                style={{ 
                  cursor: 'pointer',
                  transition: 'transform 0.2s, box-shadow 0.2s',
                  borderTop: '3px solid #E91E63'
                }}
                onMouseEnter={(e) => {
                  e.currentTarget.style.transform = 'translateY(-2px)';
                  e.currentTarget.style.boxShadow = '0 4px 8px rgba(0,0,0,0.15)';
                }}
                onMouseLeave={(e) => {
                  e.currentTarget.style.transform = 'translateY(0)';
                  e.currentTarget.style.boxShadow = 'none';
                }}>
                <div className="card-content p-3">
                  <div className="text-center">
                    <i className="fas fa-user-shield fa-2x mb-2" style={{ color: '#E91E63' }}></i>
                    <h5 className="mb-1">Funções Administrativas</h5>
                    <p className="text-muted small mb-0">Gerenciar permissões de usuários</p>
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
