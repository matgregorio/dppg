import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const OrientadorTrabalhos = () => {
  const [trabalhos, setTrabalhos] = useState([]);
  const [estatisticas, setEstatisticas] = useState(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [filtroStatus, setFiltroStatus] = useState('');

  useEffect(() => {
    carregarDados();
  }, [filtroStatus]);

  const carregarDados = async () => {
    try {
      setLoading(true);
      setError('');

      const params = {};
      if (filtroStatus) {
        params.status = filtroStatus;
      }

      const [trabalhosRes, statsRes] = await Promise.all([
        api.get('/orientador/trabalhos', { params }),
        api.get('/orientador/estatisticas'),
      ]);

      if (trabalhosRes.data.success) {
        setTrabalhos(trabalhosRes.data.data);
      }

      if (statsRes.data.success) {
        setEstatisticas(statsRes.data.data);
      }
    } catch (err) {
      console.error('Erro ao carregar dados:', err);
      setError(err.response?.data?.message || 'Erro ao carregar dados');
    } finally {
      setLoading(false);
    }
  };

  const getStatusBadge = (status) => {
    const badges = {
      AGUARDANDO_ORIENTADOR: { color: 'warning', text: 'Aguardando Avaliação' },
      APROVADO_ORIENTADOR: { color: 'success', text: 'Aprovado' },
      REPROVADO_ORIENTADOR: { color: 'danger', text: 'Reprovado' },
      EM_AVALIACAO: { color: 'info', text: 'Em Avaliação' },
      ACEITO: { color: 'success', text: 'Aceito' },
      REJEITADO: { color: 'danger', text: 'Rejeitado' },
      PUBLICADO: { color: 'success', text: 'Publicado' },
    };

    const badge = badges[status] || { color: 'secondary', text: status };
    
    return (
      <span className={`br-tag ${badge.color} text-up-01`}>
        {badge.text}
      </span>
    );
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
            <span>Meus Trabalhos Orientados</span>
          </li>
        </ul>
      </div>

      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">
          Trabalhos Orientados
        </h1>

        {error && (
          <div className="br-message danger mb-3" role="alert">
            <div className="icon">
              <i className="fas fa-times-circle fa-lg"></i>
            </div>
            <div className="content">{error}</div>
          </div>
        )}

        {/* Estatísticas */}
        {estatisticas && (
          <div className="row mb-4">
            <div className="col-md-3">
              <div className="br-card" style={{ padding: '16px' }}>
                <div className="text-center">
                  <div className="text-up-03 text-weight-bold text-warning">
                    {estatisticas.aguardandoAvaliacao}
                  </div>
                  <div className="text-down-01">Aguardando Avaliação</div>
                </div>
              </div>
            </div>
            <div className="col-md-3">
              <div className="br-card" style={{ padding: '16px' }}>
                <div className="text-center">
                  <div className="text-up-03 text-weight-bold text-success">
                    {estatisticas.aprovados}
                  </div>
                  <div className="text-down-01">Aprovados</div>
                </div>
              </div>
            </div>
            <div className="col-md-3">
              <div className="br-card" style={{ padding: '16px' }}>
                <div className="text-center">
                  <div className="text-up-03 text-weight-bold text-danger">
                    {estatisticas.reprovados}
                  </div>
                  <div className="text-down-01">Reprovados</div>
                </div>
              </div>
            </div>
            <div className="col-md-3">
              <div className="br-card" style={{ padding: '16px' }}>
                <div className="text-center">
                  <div className="text-up-03 text-weight-bold text-primary">
                    {estatisticas.total}
                  </div>
                  <div className="text-down-01">Total</div>
                </div>
              </div>
            </div>
          </div>
        )}

        {/* Filtros */}
        <div className="mb-3">
          <div className="br-input">
            <label htmlFor="filtroStatus">Filtrar por status</label>
            <select
              id="filtroStatus"
              value={filtroStatus}
              onChange={(e) => setFiltroStatus(e.target.value)}
              style={{
                height: '40px',
                padding: '8px 12px',
                fontSize: '16px',
                border: '1px solid #888',
                borderRadius: '4px',
                backgroundColor: '#fff',
                width: '300px',
              }}
            >
              <option value="">Todos os status</option>
              <option value="AGUARDANDO_ORIENTADOR">Aguardando Avaliação</option>
              <option value="APROVADO_ORIENTADOR">Aprovados</option>
              <option value="REPROVADO_ORIENTADOR">Reprovados</option>
              <option value="EM_AVALIACAO">Em Avaliação</option>
            </select>
          </div>
        </div>

        {/* Lista de Trabalhos */}
        {loading ? (
          <div className="text-center py-5">
            <div className="br-loading"></div>
            <p className="mt-3">Carregando trabalhos...</p>
          </div>
        ) : trabalhos.length === 0 ? (
          <div className="br-card" style={{ padding: '32px', textAlign: 'center' }}>
            <i className="fas fa-inbox fa-3x mb-3" style={{ color: '#888' }}></i>
            <p className="text-up-01">Nenhum trabalho encontrado</p>
          </div>
        ) : (
          <div className="br-table">
            <table>
              <thead>
                <tr>
                  <th>Título</th>
                  <th>Autor Principal</th>
                  <th>Subárea</th>
                  <th>Status</th>
                  <th>Data de Submissão</th>
                  <th className="text-center">Ações</th>
                </tr>
              </thead>
              <tbody>
                {trabalhos.map((trabalho) => (
                  <tr key={trabalho._id}>
                    <td>{trabalho.titulo}</td>
                    <td>{trabalho.autor?.nome || trabalho.autores?.[0]?.nome}</td>
                    <td>{trabalho.subarea?.nome}</td>
                    <td>{getStatusBadge(trabalho.status)}</td>
                    <td>
                      {new Date(trabalho.createdAt).toLocaleDateString('pt-BR')}
                    </td>
                    <td className="text-center">
                      <Link
                        to={`/orientador/trabalhos/${trabalho._id}`}
                        className="br-button secondary circle small"
                        title="Ver detalhes"
                      >
                        <i className="fas fa-eye"></i>
                      </Link>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        )}
      </div>
    </MainLayout>
  );
};

export default OrientadorTrabalhos;
