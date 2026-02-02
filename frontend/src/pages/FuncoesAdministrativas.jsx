import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

const FuncoesAdministrativas = () => {
  const { showSuccess, showError } = useNotification();
  const [usuarios, setUsuarios] = useState([]);
  const [loading, setLoading] = useState(true);
  const [searchTerm, setSearchTerm] = useState('');
  const [showModal, setShowModal] = useState(false);
  const [usuarioSelecionado, setUsuarioSelecionado] = useState(null);
  const [modalTipo, setModalTipo] = useState('promover'); // 'promover' ou 'remover'

  useEffect(() => {
    carregarUsuarios();
  }, []);

  const carregarUsuarios = async () => {
    try {
      setLoading(true);
      const response = await api.get('/admin/usuarios');
      setUsuarios(response.data.usuarios || []);
    } catch (error) {
      console.error('Erro ao carregar usuários:', error);
      showError('Erro ao carregar usuários: ' + (error.response?.data?.message || error.message));
    } finally {
      setLoading(false);
    }
  };

  const abrirModalPromocao = (usuario) => {
    setUsuarioSelecionado(usuario);
    setModalTipo('promover');
    setShowModal(true);
  };

  const abrirModalRemocao = (usuario) => {
    setUsuarioSelecionado(usuario);
    setModalTipo('remover');
    setShowModal(true);
  };

  const fecharModal = () => {
    setShowModal(false);
    setUsuarioSelecionado(null);
    setModalTipo('promover');
  };

  const confirmarPromocao = async () => {
    if (!usuarioSelecionado) return;

    try {
      await api.post(`/admin/usuarios/${usuarioSelecionado._id}/promover`);
      showSuccess(`${usuarioSelecionado.nome} foi promovido(a) para ADMINISTRADOR com sucesso!`);
      fecharModal();
      carregarUsuarios();
    } catch (error) {
      showError(error.response?.data?.message || 'Erro ao promover usuário');
    }
  };

  const confirmarRemocao = async () => {
    if (!usuarioSelecionado) return;

    try {
      await api.post(`/admin/usuarios/${usuarioSelecionado._id}/remover-admin`);
      showSuccess(`Permissões de ADMINISTRADOR removidas de ${usuarioSelecionado.nome} com sucesso!`);
      fecharModal();
      carregarUsuarios();
    } catch (error) {
      showError(error.response?.data?.message || 'Erro ao remover permissões');
    }
  };

  const getRolesDisplay = (roles) => {
    if (!roles || roles.length === 0) return 'Usuário';
    return roles.map(role => {
      const roleMap = {
        'ADMIN': 'Administrador',
        'SUBADMIN': 'Subadministrador',
        'AVALIADOR': 'Avaliador',
        'MESARIO': 'Mesário',
        'DOCENTE': 'Docente',
        'USER': 'Usuário'
      };
      return roleMap[role] || role;
    }).join(', ');
  };

  const isAdmin = (roles) => roles && roles.includes('ADMIN');

  // Usuários não-admin para promoção
  const usuariosNaoAdmin = usuarios.filter(u => !isAdmin(u.roles));
  
  // Usuários admin para remoção
  const usuariosAdmin = usuarios.filter(u => isAdmin(u.roles));

  const filteredUsuariosNaoAdmin = usuariosNaoAdmin.filter(u => 
    u.nome?.toLowerCase().includes(searchTerm.toLowerCase()) ||
    u.email?.toLowerCase().includes(searchTerm.toLowerCase()) ||
    u.cpf?.includes(searchTerm)
  );

  const filteredUsuariosAdmin = usuariosAdmin.filter(u => 
    u.nome?.toLowerCase().includes(searchTerm.toLowerCase()) ||
    u.email?.toLowerCase().includes(searchTerm.toLowerCase()) ||
    u.cpf?.includes(searchTerm)
  );

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
            <h1 className="mb-2">
              <i className="fas fa-user-shield mr-2"></i>
              Funções Administrativas
            </h1>
            <p className="text-muted">Gerencie permissões de administrador do sistema</p>
          </div>
        </div>

        {/* Card de Promover Usuários */}
        <div className="br-card mb-4">
          <div className="card-header">
            <h3><i className="fas fa-arrow-up mr-2"></i>Promover Usuários para Administrador</h3>
          </div>
          <div className="card-content">
            {loading ? (
              <div className="text-center py-5">
                <div className="br-loading"></div>
                <p className="mt-3">Carregando usuários...</p>
              </div>
            ) : (
              <>
                <div className="mb-4">
                  <div className="br-input">
                    <label htmlFor="search-promover">Buscar usuário</label>
                    <input
                      id="search-promover"
                      type="text"
                      placeholder="Digite nome, email ou CPF..."
                      value={searchTerm}
                      onChange={(e) => setSearchTerm(e.target.value)}
                    />
                    <button className="br-button circle" type="button" aria-label="Buscar">
                      <i className="fas fa-search" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>

                {filteredUsuariosNaoAdmin.length === 0 ? (
                  <div className="br-message info">
                    <div className="icon">
                      <i className="fas fa-info-circle"></i>
                    </div>
                    <div className="content">
                      {searchTerm ? 'Nenhum usuário encontrado com o termo buscado.' : 'Nenhum usuário disponível para promoção.'}
                    </div>
                  </div>
                ) : (
                  <div className="br-table">
                    <table>
                      <thead>
                        <tr>
                          <th>Nome</th>
                          <th>Email</th>
                          <th>CPF</th>
                          <th>Funções Atuais</th>
                          <th style={{ width: '150px', textAlign: 'center' }}>Ações</th>
                        </tr>
                      </thead>
                      <tbody>
                        {filteredUsuariosNaoAdmin.map(usuario => (
                          <tr key={usuario._id}>
                            <td>{usuario.nome}</td>
                            <td>{usuario.email}</td>
                            <td>{usuario.cpf || '-'}</td>
                            <td>
                              <span className="br-tag secondary">
                                {getRolesDisplay(usuario.roles)}
                              </span>
                            </td>
                            <td style={{ textAlign: 'center' }}>
                              <button
                                className="br-button primary small"
                                onClick={() => abrirModalPromocao(usuario)}
                                title={`Promover ${usuario.nome} para Administrador`}
                              >
                                <i className="fas fa-user-shield mr-1"></i>
                                Promover
                              </button>
                            </td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                )}

                <div className="br-message warning mt-4">
                  <div className="icon">
                    <i className="fas fa-exclamation-triangle"></i>
                  </div>
                  <div className="content">
                    <strong>Atenção:</strong> Ao promover um usuário para ADMINISTRADOR, ele terá acesso completo a todas as funcionalidades do sistema, incluindo gerenciamento de usuários, certificados e configurações críticas.
                  </div>
                </div>
              </>
            )}
          </div>
        </div>

        {/* Card de Remover Administradores */}
        <div className="br-card">
          <div className="card-header">
            <h3><i className="fas fa-user-minus mr-2"></i>Remover Permissões de Administrador</h3>
          </div>
          <div className="card-content">
            {loading ? (
              <div className="text-center py-5">
                <div className="br-loading"></div>
                <p className="mt-3">Carregando administradores...</p>
              </div>
            ) : (
              <>
                {filteredUsuariosAdmin.length === 0 ? (
                  <div className="br-message info">
                    <div className="icon">
                      <i className="fas fa-info-circle"></i>
                    </div>
                    <div className="content">
                      {searchTerm ? 'Nenhum administrador encontrado com o termo buscado.' : 'Nenhum administrador disponível.'}
                    </div>
                  </div>
                ) : (
                  <div className="br-table">
                    <table>
                      <thead>
                        <tr>
                          <th>Nome</th>
                          <th>Email</th>
                          <th>CPF</th>
                          <th>Funções Atuais</th>
                          <th style={{ width: '150px', textAlign: 'center' }}>Ações</th>
                        </tr>
                      </thead>
                      <tbody>
                        {filteredUsuariosAdmin.map(usuario => (
                          <tr key={usuario._id}>
                            <td>{usuario.nome}</td>
                            <td>{usuario.email}</td>
                            <td>{usuario.cpf || '-'}</td>
                            <td>
                              <span className="br-tag success">
                                {getRolesDisplay(usuario.roles)}
                              </span>
                            </td>
                            <td style={{ textAlign: 'center' }}>
                              <button
                                className="br-button secondary small"
                                onClick={() => abrirModalRemocao(usuario)}
                                title={`Remover permissões de administrador de ${usuario.nome}`}
                              >
                                <i className="fas fa-user-minus mr-1"></i>
                                Remover
                              </button>
                            </td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                )}

                <div className="br-message danger mt-4">
                  <div className="icon">
                    <i className="fas fa-exclamation-circle"></i>
                  </div>
                  <div className="content">
                    <strong>Cuidado:</strong> Ao remover permissões de ADMINISTRADOR, o usuário perderá acesso a todas as funcionalidades administrativas do sistema. Outras funções (como Avaliador, Docente, etc.) serão mantidas.
                  </div>
                </div>
              </>
            )}
          </div>
        </div>
      </div>

      {/* Modal de Confirmação */}
      {showModal && usuarioSelecionado && (
        <>
          <div className="br-modal active" style={{ display: 'block', position: 'fixed', top: '50%', left: '50%', transform: 'translate(-50%, -50%)', zIndex: 9999 }}>
            <div className="br-modal-dialog">
              <div className="br-modal-content">
                <div className="br-modal-header">
                  <div className="br-modal-title">
                    {modalTipo === 'promover' ? 'Confirmar Promoção' : 'Confirmar Remoção'}
                  </div>
                  <button
                    className="br-button circle small"
                    onClick={fecharModal}
                    type="button"
                    aria-label="Fechar"
                  >
                    <i className="fas fa-times"></i>
                  </button>
                </div>
                <div className="br-modal-body">
                  <div className="mb-3">
                    {modalTipo === 'promover' ? (
                      <>
                        <p className="mb-3">
                          Deseja realmente promover <strong>{usuarioSelecionado.nome}</strong> para <strong>ADMINISTRADOR</strong>?
                        </p>
                        <div className="br-message warning">
                          <div className="icon">
                            <i className="fas fa-exclamation-triangle"></i>
                          </div>
                          <div className="content">
                            <strong>Atenção:</strong> Esta ação dará permissões completas ao usuário, incluindo acesso a todas as funcionalidades administrativas do sistema.
                          </div>
                        </div>
                      </>
                    ) : (
                      <>
                        <p className="mb-3">
                          Deseja realmente remover as permissões de <strong>ADMINISTRADOR</strong> de <strong>{usuarioSelecionado.nome}</strong>?
                        </p>
                        <div className="br-message danger">
                          <div className="icon">
                            <i className="fas fa-exclamation-circle"></i>
                          </div>
                          <div className="content">
                            <strong>Cuidado:</strong> O usuário perderá acesso a todas as funcionalidades administrativas. Outras funções serão mantidas.
                          </div>
                        </div>
                      </>
                    )}
                    <div className="mt-3">
                      <p className="mb-2"><strong>Informações do usuário:</strong></p>
                      <ul className="list-unstyled ml-3">
                        <li><strong>Nome:</strong> {usuarioSelecionado.nome}</li>
                        <li><strong>Email:</strong> {usuarioSelecionado.email}</li>
                        <li><strong>CPF:</strong> {usuarioSelecionado.cpf || 'Não informado'}</li>
                        <li><strong>Funções atuais:</strong> {getRolesDisplay(usuarioSelecionado.roles)}</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div className="br-modal-footer">
                  <button
                    type="button"
                    className="br-button secondary"
                    onClick={fecharModal}
                  >
                    Cancelar
                  </button>
                  <button
                    type="button"
                    className="br-button primary"
                    onClick={modalTipo === 'promover' ? confirmarPromocao : confirmarRemocao}
                  >
                    {modalTipo === 'promover' ? (
                      <>
                        <i className="fas fa-check mr-2"></i>
                        Confirmar Promoção
                      </>
                    ) : (
                      <>
                        <i className="fas fa-user-minus mr-2"></i>
                        Confirmar Remoção
                      </>
                    )}
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div className="br-scrim foco active" style={{ zIndex: 9998 }} onClick={fecharModal}></div>
        </>
      )}
    </MainLayout>
  );
};

export default FuncoesAdministrativas;
