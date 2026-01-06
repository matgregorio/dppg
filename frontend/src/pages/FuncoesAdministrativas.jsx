import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

const FuncoesAdministrativas = () => {
  const { showSuccess, showError } = useNotification();
  const [usuarios, setUsuarios] = useState([]);
  const [simposioAtual, setSimposioAtual] = useState(null);
  const [loading, setLoading] = useState(true);
  const [showFinalizarModal, setShowFinalizarModal] = useState(false);
  const [senha, setSenha] = useState('');
  const [finalizando, setFinalizando] = useState(false);

  useEffect(() => {
    carregarDados();
  }, []);

  const carregarDados = async () => {
    try {
      setLoading(true);
      
      // Carregar simpósio atual
      const resSimposio = await api.get('/public/simposios/2025');
      setSimposioAtual(resSimposio.data);

      // Carregar usuários (participantes e avaliadores)
      const resUsuarios = await api.get('/admin/usuarios');
      setUsuarios(resUsuarios.data.usuarios || []);
    } catch (error) {
      console.error('Erro ao carregar dados:', error);
      showError('Erro ao carregar dados');
    } finally {
      setLoading(false);
    }
  };

  const promoverUsuario = async (userId, nome) => {
    if (!confirm(`Deseja realmente promover ${nome} para ADMINISTRADOR?`)) return;

    try {
      await api.post(`/admin/usuarios/${userId}/promover`);
      showSuccess('Usuário promovido para administrador com sucesso!');
      carregarDados();
    } catch (error) {
      showError(error.response?.data?.message || 'Erro ao promover usuário');
    }
  };

  const handleFinalizarSimposio = async (e) => {
    e.preventDefault();
    
    if (!senha) {
      showError('Digite sua senha para confirmar');
      return;
    }

    try {
      setFinalizando(true);
      await api.post('/admin/simposio/finalizar', {
        ano: simposioAtual.ano,
        senha
      });
      
      showSuccess('Simpósio finalizado! Certificados estão sendo gerados...');
      setShowFinalizarModal(false);
      setSenha('');
      carregarDados();
    } catch (error) {
      showError(error.response?.data?.message || 'Erro ao finalizar simpósio');
    } finally {
      setFinalizando(false);
    }
  };

  if (loading) {
    return (
      <MainLayout>
        <div className="container-lg my-4">
          <div className="text-center py-5">
            <div className="spinner-border text-primary" role="status">
              <span className="sr-only">Carregando...</span>
            </div>
          </div>
        </div>
      </MainLayout>
    );
  }

  return (
    <MainLayout>
      <div className="container-lg my-4">
        <div className="br-breadcrumb mb-4">
          <ul className="crumb-list">
            <li className="crumb home">
              <Link className="br-button circle" to="/">
                <span className="sr-only">Página inicial</span>
                <i className="fas fa-home"></i>
              </Link>
            </li>
            <li className="crumb">
              <i className="icon fas fa-chevron-right"></i>
              <Link to="/area-administrativa">Área Administrativa</Link>
            </li>
            <li className="crumb">
              <i className="icon fas fa-chevron-right"></i>
              <span>Funções Administrativas</span>
            </li>
          </ul>
        </div>

        <div className="row mb-4">
          <div className="col">
            <h1 className="mb-4">
              <i className="fas fa-user-shield mr-2"></i>
              Funções Administrativas
            </h1>
          </div>
        </div>

        {/* Finalizar Simpósio */}
        <div className="row mb-4">
          <div className="col">
            <div className="br-card">
              <div className="card-header">
                <h3><i className="fas fa-flag-checkered mr-2"></i>Finalizar Simpósio</h3>
              </div>
              <div className="card-content">
                {simposioAtual && simposioAtual.status === 'INICIALIZADO' ? (
                  <>
                    <p><strong>Simpósio Atual:</strong> {simposioAtual.nome} ({simposioAtual.ano})</p>
                    <p><strong>Status:</strong> <span className="br-tag warning">Em Andamento</span></p>
                    <div className="br-message warning mt-3">
                      <div className="icon">
                        <i className="fas fa-exclamation-triangle"></i>
                      </div>
                      <div className="content">
                        <strong>Atenção!</strong> Ao finalizar o simpósio, todos os certificados serão gerados automaticamente e enviados por email para os participantes, avaliadores e orientadores.
                      </div>
                    </div>
                    <button
                      className="br-button primary mt-3"
                      onClick={() => setShowFinalizarModal(true)}
                    >
                      <i className="fas fa-flag-checkered mr-2"></i>
                      Finalizar Simpósio
                    </button>
                  </>
                ) : (
                  <div className="br-message success">
                    <div className="icon">
                      <i className="fas fa-check-circle"></i>
                    </div>
                    <div className="content">
                      O simpósio de {simposioAtual?.ano} já foi finalizado.
                    </div>
                  </div>
                )}
              </div>
            </div>
          </div>
        </div>

        {/* Promover Usuários */}
        <div className="row mb-4">
          <div className="col">
            <div className="br-card">
              <div className="card-header">
                <h3><i className="fas fa-user-shield mr-2"></i>Promover Usuários para Administrador</h3>
              </div>
              <div className="card-content">
                <p className="mb-3">Transforme participantes e avaliadores em administradores do sistema.</p>
                
                {usuarios.length === 0 ? (
                  <div className="br-message info">
                    <div className="icon">
                      <i className="fas fa-info-circle"></i>
                    </div>
                    <div className="content">
                      Nenhum usuário disponível para promoção.
                    </div>
                  </div>
                ) : (
                  <div className="table-responsive">
                    <table className="br-table">
                      <thead>
                        <tr>
                          <th>Nome</th>
                          <th>Email</th>
                          <th>Papel Atual</th>
                          <th>Ações</th>
                        </tr>
                      </thead>
                      <tbody>
                        {usuarios
                          .filter(u => u.role !== 'ADMIN')
                          .map(usuario => (
                            <tr key={usuario._id}>
                              <td>{usuario.nome || usuario.email}</td>
                              <td>{usuario.email}</td>
                              <td>
                                <span className={`br-tag ${
                                  usuario.role === 'SUBADMIN' ? 'info' :
                                  usuario.role === 'AVALIADOR' ? 'warning' :
                                  'secondary'
                                }`}>
                                  {usuario.role}
                                </span>
                              </td>
                              <td>
                                <button
                                  className="br-button primary small"
                                  onClick={() => promoverUsuario(usuario._id, usuario.nome || usuario.email)}
                                  title="Promover para Administrador"
                                >
                                  <i className="fas fa-arrow-up mr-1"></i>
                                  Promover
                                </button>
                              </td>
                            </tr>
                          ))}
                      </tbody>
                    </table>
                  </div>
                )}
              </div>
            </div>
          </div>
        </div>

        {/* Link para Gerenciar Certificados */}
        <div className="row mb-4">
          <div className="col">
            <div className="br-card">
              <div className="card-header">
                <h3><i className="fas fa-certificate mr-2"></i>Certificados</h3>
              </div>
              <div className="card-content">
                <p>Gerencie os certificados do simpósio, edite conteúdos e assinaturas.</p>
                <Link to="/admin/certificados" className="br-button secondary">
                  <i className="fas fa-certificate mr-2"></i>
                  Gerenciar Certificados
                </Link>
              </div>
            </div>
          </div>
        </div>

        {/* Modal Finalizar Simpósio */}
        {showFinalizarModal && (
          <>
            <div className="br-modal active" style={{ display: 'block' }}>
              <div className="br-modal-dialog">
                <div className="br-modal-content">
                  <div className="br-modal-header">
                    <div className="br-modal-title">Confirmar Finalização do Simpósio</div>
                    <button
                      className="br-button circle small"
                      onClick={() => {
                        setShowFinalizarModal(false);
                        setSenha('');
                      }}
                      disabled={finalizando}
                    >
                      <i className="fas fa-times"></i>
                    </button>
                  </div>
                  <form onSubmit={handleFinalizarSimposio}>
                    <div className="br-modal-body">
                      <div className="br-message warning mb-3">
                        <div className="icon">
                          <i className="fas fa-exclamation-triangle"></i>
                        </div>
                        <div className="content">
                          <strong>Esta ação é irreversível!</strong><br/>
                          Ao finalizar, todos os certificados serão gerados e enviados.
                        </div>
                      </div>

                      <div className="br-input">
                        <label htmlFor="senha">Digite sua senha para confirmar *</label>
                        <input
                          id="senha"
                          type="password"
                          value={senha}
                          onChange={(e) => setSenha(e.target.value)}
                          required
                          disabled={finalizando}
                          placeholder="Sua senha de administrador"
                          autoFocus
                        />
                      </div>
                    </div>
                    <div className="br-modal-footer">
                      <button
                        type="button"
                        className="br-button secondary"
                        onClick={() => {
                          setShowFinalizarModal(false);
                          setSenha('');
                        }}
                        disabled={finalizando}
                      >
                        Cancelar
                      </button>
                      <button
                        type="submit"
                        className="br-button primary"
                        disabled={finalizando || !senha}
                      >
                        {finalizando ? (
                          <>
                            <i className="fas fa-spinner fa-spin mr-2"></i>
                            Finalizando...
                          </>
                        ) : (
                          <>
                            <i className="fas fa-check mr-2"></i>
                            Confirmar Finalização
                          </>
                        )}
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div className="br-scrim active" onClick={() => !finalizando && setShowFinalizarModal(false)}></div>
          </>
        )}
      </div>
    </MainLayout>
  );
};

export default FuncoesAdministrativas;
