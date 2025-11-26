import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import SelectGovBR from '../components/SelectGovBR';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

function AdminCertificados() {
  const navigate = useNavigate();
  const { showNotification } = useNotification();
  const [certificados, setCertificados] = useState([]);
  const [loading, setLoading] = useState(true);
  const [filtros, setFiltros] = useState({
    tipo: '',
    enviadoEmail: '',
    page: 1,
    limit: 20
  });
  const [pagination, setPagination] = useState({ total: 0, page: 1, pages: 1 });
  const [certificadoSelecionado, setCertificadoSelecionado] = useState(null);
  const [showModal, setShowModal] = useState(false);
  const [editData, setEditData] = useState({});

  useEffect(() => {
    carregarCertificados();
  }, [filtros]);

  const carregarCertificados = async () => {
    try {
      setLoading(true);
      const params = new URLSearchParams();
      if (filtros.tipo) params.append('tipo', filtros.tipo);
      if (filtros.enviadoEmail) params.append('enviadoEmail', filtros.enviadoEmail);
      params.append('page', filtros.page);
      params.append('limit', filtros.limit);

      const response = await api.get(`/admin/certificados?${params.toString()}`);
      if (response.data.success) {
        setCertificados(response.data.data);
        setPagination(response.data.pagination);
      }
    } catch (error) {
      console.error('Erro ao carregar certificados:', error);
      showNotification('Erro ao carregar certificados', 'error');
    } finally {
      setLoading(false);
    }
  };

  const abrirModalEditar = async (certificadoId) => {
    try {
      const response = await api.get(`/admin/certificados/${certificadoId}`);
      if (response.data.success) {
        setCertificadoSelecionado(response.data.data);
        setEditData({
          conteudo: response.data.data.conteudo || '',
          horasCarga: response.data.data.horasCarga || '',
          edicao: response.data.data.edicao || '',
          assinatura1: response.data.data.assinatura1 || { nome: '', cargo: '' },
          assinatura2: response.data.data.assinatura2 || { nome: '', cargo: '' }
        });
        setShowModal(true);
      }
    } catch (error) {
      console.error('Erro ao carregar certificado:', error);
      showNotification('Erro ao carregar certificado', 'error');
    }
  };

  const salvarEdicao = async () => {
    try {
      const response = await api.put(`/admin/certificados/${certificadoSelecionado._id}`, editData);
      if (response.data.success) {
        showNotification('Certificado atualizado com sucesso', 'success');
        setShowModal(false);
        carregarCertificados();
      }
    } catch (error) {
      console.error('Erro ao atualizar certificado:', error);
      showNotification('Erro ao atualizar certificado', 'error');
    }
  };

  const enviarCertificado = async (certificadoId) => {
    if (!confirm('Deseja enviar este certificado por e-mail?')) return;

    try {
      const response = await api.post(`/admin/certificados/${certificadoId}/enviar`);
      if (response.data.success) {
        showNotification('Certificado enviado com sucesso', 'success');
        carregarCertificados();
      }
    } catch (error) {
      console.error('Erro ao enviar certificado:', error);
      showNotification(error.response?.data?.message || 'Erro ao enviar certificado', 'error');
    }
  };

  const regenerarCertificado = async (certificadoId) => {
    if (!confirm('Deseja regenerar o PDF deste certificado?')) return;

    try {
      const response = await api.post(`/admin/certificados/${certificadoId}/regenerar`);
      if (response.data.success) {
        showNotification('Certificado regenerado com sucesso', 'success');
        carregarCertificados();
      }
    } catch (error) {
      console.error('Erro ao regenerar certificado:', error);
      showNotification('Erro ao regenerar certificado', 'error');
    }
  };

  const excluirCertificado = async (certificadoId) => {
    if (!confirm('Tem certeza que deseja EXCLUIR este certificado? Esta ação não pode ser desfeita!')) return;

    try {
      const response = await api.delete(`/admin/certificados/${certificadoId}`);
      if (response.data.success) {
        showNotification('Certificado excluído com sucesso', 'success');
        carregarCertificados();
      }
    } catch (error) {
      console.error('Erro ao excluir certificado:', error);
      showNotification('Erro ao excluir certificado', 'error');
    }
  };

  const getTipoBadgeClass = (tipo) => {
    const classes = {
      'PARTICIPANTE': 'bg-info',
      'ORIENTADOR': 'bg-primary',
      'AVALIADOR': 'bg-warning',
      'MESARIO': 'bg-secondary',
      'ORGANIZADOR': 'bg-success'
    };
    return classes[tipo] || 'bg-dark';
  };

  return (
    <MainLayout>
      <div className="container-lg mt-4 mb-5">
        <div className="d-flex justify-content-between align-items-center mb-4">
          <h1>Gerenciar Certificados</h1>
          <button
            className="br-button secondary"
            onClick={() => navigate('/admin/funcoes')}
          >
            <i className="fas fa-arrow-left mr-2"></i>
            Voltar
          </button>
        </div>

        {/* Filtros */}
        <div className="br-card mb-4">
          <div className="card-content p-3">
            <div className="row g-3">
              <div className="col-md-4">
                <SelectGovBR
                  id="filtroTipo"
                  label="Tipo"
                  value={filtros.tipo}
                  onChange={(e) => setFiltros({ ...filtros, tipo: e.target.value, page: 1 })}
                  options={[
                    { value: '', label: 'Todos' },
                    { value: 'PARTICIPANTE', label: 'Participante' },
                    { value: 'ORIENTADOR', label: 'Orientador' },
                    { value: 'AVALIADOR', label: 'Avaliador' },
                    { value: 'MESARIO', label: 'Mesário' },
                    { value: 'ORGANIZADOR', label: 'Organizador' },
                  ]}
                />
              </div>
              <div className="col-md-4">
                <SelectGovBR
                  id="filtroEnviado"
                  label="Status de Envio"
                  value={filtros.enviadoEmail}
                  onChange={(e) => setFiltros({ ...filtros, enviadoEmail: e.target.value, page: 1 })}
                  options={[
                    { value: '', label: 'Todos' },
                    { value: 'true', label: 'Enviado' },
                    { value: 'false', label: 'Não Enviado' },
                  ]}
                />
              </div>
            </div>
          </div>
        </div>

        {/* Lista de Certificados */}
        {loading ? (
          <div className="text-center py-5">
            <div className="br-loading" aria-label="Carregando"></div>
            <p className="mt-3">Carregando certificados...</p>
          </div>
        ) : (
          <>
            <div className="br-table" data-search="data-search" data-selection="data-selection" data-collapse="data-collapse" data-random="data-random">
              <div className="table-header">
                <div className="top-bar">
                  <div className="table-title">
                    Total: {pagination.total} certificado(s)
                  </div>
                </div>
              </div>
              <table>
                <thead>
                  <tr>
                    <th scope="col">Tipo</th>
                    <th scope="col">Participante</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Horas</th>
                    <th scope="col">Enviado</th>
                    <th scope="col">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  {certificados.length === 0 ? (
                    <tr>
                      <td colSpan="6" className="text-center py-4">
                        Nenhum certificado encontrado
                      </td>
                    </tr>
                  ) : (
                    certificados.map((cert) => (
                      <tr key={cert._id}>
                        <td>
                          <span className={`br-tag ${getTipoBadgeClass(cert.tipo)} text-white`}>
                            {cert.tipo}
                          </span>
                        </td>
                        <td>{cert.participante?.nome || 'N/A'}</td>
                        <td>{cert.participante?.email || 'N/A'}</td>
                        <td>{cert.horasCarga || 0}h</td>
                        <td>
                          {cert.enviadoEmail ? (
                            <span className="br-tag success">
                              <i className="fas fa-check mr-1"></i>
                              Sim
                            </span>
                          ) : (
                            <span className="br-tag warning">
                              <i className="fas fa-times mr-1"></i>
                              Não
                            </span>
                          )}
                        </td>
                        <td>
                          <div className="btn-group" role="group">
                            <button
                              className="br-button circle small"
                              type="button"
                              title="Editar"
                              onClick={() => abrirModalEditar(cert._id)}
                            >
                              <i className="fas fa-edit"></i>
                            </button>
                            <button
                              className="br-button circle small"
                              type="button"
                              title="Enviar por e-mail"
                              onClick={() => enviarCertificado(cert._id)}
                              disabled={cert.enviadoEmail}
                            >
                              <i className="fas fa-envelope"></i>
                            </button>
                            <button
                              className="br-button circle small"
                              type="button"
                              title="Regenerar PDF"
                              onClick={() => regenerarCertificado(cert._id)}
                            >
                              <i className="fas fa-sync"></i>
                            </button>
                            <button
                              className="br-button circle small danger"
                              type="button"
                              title="Excluir"
                              onClick={() => excluirCertificado(cert._id)}
                            >
                              <i className="fas fa-trash"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                    ))
                  )}
                </tbody>
              </table>
            </div>

            {/* Paginação */}
            {pagination.pages > 1 && (
              <div className="d-flex justify-content-center mt-4">
                <nav aria-label="Paginação">
                  <ul className="br-pagination" data-total={pagination.pages} data-current={pagination.page}>
                    <li>
                      <button
                        className="br-button circle"
                        type="button"
                        disabled={pagination.page === 1}
                        onClick={() => setFiltros({ ...filtros, page: pagination.page - 1 })}
                      >
                        <i className="fas fa-chevron-left"></i>
                      </button>
                    </li>
                    <li>
                      <span className="br-item">
                        {pagination.page} / {pagination.pages}
                      </span>
                    </li>
                    <li>
                      <button
                        className="br-button circle"
                        type="button"
                        disabled={pagination.page === pagination.pages}
                        onClick={() => setFiltros({ ...filtros, page: pagination.page + 1 })}
                      >
                        <i className="fas fa-chevron-right"></i>
                      </button>
                    </li>
                  </ul>
                </nav>
              </div>
            )}
          </>
        )}
      </div>

      {/* Modal de Edição */}
      {showModal && (
        <div className="br-modal active">
          <div className="br-modal-dialog br-modal-lg">
            <div className="br-modal-content">
              <div className="br-modal-header">
                <div className="br-modal-title">Editar Certificado</div>
                <button
                  className="br-button circle small"
                  type="button"
                  onClick={() => setShowModal(false)}
                >
                  <i className="fas fa-times"></i>
                </button>
              </div>
              <div className="br-modal-body">
                <div className="mb-3">
                  <strong>Participante:</strong> {certificadoSelecionado?.participante?.nome}
                </div>
                <div className="mb-3">
                  <strong>Tipo:</strong> {certificadoSelecionado?.tipo}
                </div>

                <div className="br-textarea mb-3">
                  <label htmlFor="conteudo">Conteúdo do Certificado</label>
                  <textarea
                    id="conteudo"
                    rows="4"
                    value={editData.conteudo}
                    onChange={(e) => setEditData({ ...editData, conteudo: e.target.value })}
                  />
                </div>

                <div className="row g-3 mb-3">
                  <div className="col-md-6">
                    <div className="br-input">
                      <label htmlFor="horasCarga">Carga Horária</label>
                      <input
                        id="horasCarga"
                        type="number"
                        value={editData.horasCarga}
                        onChange={(e) => setEditData({ ...editData, horasCarga: e.target.value })}
                      />
                    </div>
                  </div>
                  <div className="col-md-6">
                    <div className="br-input">
                      <label htmlFor="edicao">Edição</label>
                      <input
                        id="edicao"
                        type="text"
                        value={editData.edicao}
                        onChange={(e) => setEditData({ ...editData, edicao: e.target.value })}
                      />
                    </div>
                  </div>
                </div>

                <h5 className="mb-2">Assinatura 1</h5>
                <div className="row g-3 mb-3">
                  <div className="col-md-6">
                    <div className="br-input">
                      <label htmlFor="ass1Nome">Nome</label>
                      <input
                        id="ass1Nome"
                        type="text"
                        value={editData.assinatura1?.nome || ''}
                        onChange={(e) => setEditData({
                          ...editData,
                          assinatura1: { ...editData.assinatura1, nome: e.target.value }
                        })}
                      />
                    </div>
                  </div>
                  <div className="col-md-6">
                    <div className="br-input">
                      <label htmlFor="ass1Cargo">Cargo</label>
                      <input
                        id="ass1Cargo"
                        type="text"
                        value={editData.assinatura1?.cargo || ''}
                        onChange={(e) => setEditData({
                          ...editData,
                          assinatura1: { ...editData.assinatura1, cargo: e.target.value }
                        })}
                      />
                    </div>
                  </div>
                </div>

                <h5 className="mb-2">Assinatura 2</h5>
                <div className="row g-3">
                  <div className="col-md-6">
                    <div className="br-input">
                      <label htmlFor="ass2Nome">Nome</label>
                      <input
                        id="ass2Nome"
                        type="text"
                        value={editData.assinatura2?.nome || ''}
                        onChange={(e) => setEditData({
                          ...editData,
                          assinatura2: { ...editData.assinatura2, nome: e.target.value }
                        })}
                      />
                    </div>
                  </div>
                  <div className="col-md-6">
                    <div className="br-input">
                      <label htmlFor="ass2Cargo">Cargo</label>
                      <input
                        id="ass2Cargo"
                        type="text"
                        value={editData.assinatura2?.cargo || ''}
                        onChange={(e) => setEditData({
                          ...editData,
                          assinatura2: { ...editData.assinatura2, cargo: e.target.value }
                        })}
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div className="br-modal-footer justify-content-end">
                <button
                  className="br-button secondary mr-3"
                  type="button"
                  onClick={() => setShowModal(false)}
                >
                  Cancelar
                </button>
                <button
                  className="br-button primary"
                  type="button"
                  onClick={salvarEdicao}
                >
                  Salvar
                </button>
              </div>
            </div>
          </div>
        </div>
      )}
    </MainLayout>
  );
}

export default AdminCertificados;
