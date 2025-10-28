import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

const AdminPaginas = () => {
  const { showSuccess, showError } = useNotification();
  const [paginas, setPaginas] = useState([]);
  const [loading, setLoading] = useState(true);
  const [editingSlug, setEditingSlug] = useState(null);
  const [showModal, setShowModal] = useState(false);
  
  const [formData, setFormData] = useState({
    conteudo: '',
    linkExterno: '',
    pdf: null
  });

  const slugLabels = {
    'home': 'Página Inicial',
    'apresentacao': 'Apresentação',
    'regulamento': 'Regulamento',
    'corpo-editorial': 'Corpo Editorial',
    'expediente': 'Expediente',
    'normas-publicacao': 'Normas de Publicação',
    'programacao': 'Programação',
    'modelo-poster': 'Modelo de Pôster',
    'anais': 'Anais',
    'dppg': 'DPPG',
  };

  useEffect(() => {
    carregarPaginas();
  }, []);

  const carregarPaginas = async () => {
    try {
      setLoading(true);
      const response = await api.get('/admin/paginas');
      setPaginas(response.data.data);
    } catch (error) {
      console.error('Erro ao carregar páginas:', error);
      showError('Erro ao carregar páginas');
    } finally {
      setLoading(false);
    }
  };

  const handleEdit = async (slug) => {
    try {
      const response = await api.get(`/admin/paginas/${slug}`);
      const pagina = response.data.data;
      
      setFormData({
        conteudo: pagina?.conteudo || '',
        linkExterno: pagina?.linkExterno || '',
        pdf: null
      });
      setEditingSlug(slug);
      setShowModal(true);
    } catch (error) {
      // Se não existe, cria uma nova
      if (error.response?.status === 404) {
        setFormData({
          conteudo: '',
          linkExterno: '',
          pdf: null
        });
        setEditingSlug(slug);
        setShowModal(true);
      } else {
        console.error('Erro ao carregar página:', error);
        showError('Erro ao carregar página');
      }
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    
    try {
      const formDataToSend = new FormData();
      formDataToSend.append('conteudo', formData.conteudo);
      formDataToSend.append('linkExterno', formData.linkExterno);
      
      if (formData.pdf) {
        formDataToSend.append('pdf', formData.pdf);
      }

      await api.put(`/admin/paginas/${editingSlug}`, formDataToSend, {
        headers: { 'Content-Type': 'multipart/form-data' }
      });
      
      showSuccess('Página atualizada com sucesso!');
      setShowModal(false);
      resetForm();
      carregarPaginas();
    } catch (error) {
      console.error('Erro ao salvar:', error);
      showError(error.response?.data?.message || 'Erro ao salvar página');
    }
  };

  const handleRemoverPdf = async (slug) => {
    if (!confirm('Tem certeza que deseja remover o PDF desta página?')) return;

    try {
      await api.delete(`/admin/paginas/${slug}/remover-pdf`);
      showSuccess('PDF removido com sucesso!');
      carregarPaginas();
    } catch (error) {
      console.error('Erro ao remover PDF:', error);
      showError('Erro ao remover PDF');
    }
  };

  const resetForm = () => {
    setFormData({
      conteudo: '',
      linkExterno: '',
      pdf: null
    });
    setEditingSlug(null);
  };

  const handleFileChange = (e) => {
    setFormData({ ...formData, pdf: e.target.files[0] });
  };

  // Criar lista de todas as páginas possíveis
  const todasPaginas = Object.keys(slugLabels).map(slug => {
    const paginaExistente = paginas.find(p => p.slug === slug);
    return {
      slug,
      label: slugLabels[slug],
      ...paginaExistente
    };
  });

  return (
    <MainLayout>
      <div className="container-lg my-4">
        <div className="row mb-4">
          <div className="col">
            <nav className="br-breadcrumb" aria-label="Breadcrumbs">
              <ol className="crumb-list" role="list">
                <li className="crumb home"><Link to="/">Início</Link></li>
                <li className="crumb" data-active="active"><span>Admin - Páginas Estáticas</span></li>
              </ol>
            </nav>
          </div>
        </div>

        <div className="row mb-4">
          <div className="col">
            <h1 className="mb-3">Gerenciar Páginas Estáticas</h1>
            <p className="text-base mb-4">
              Edite o conteúdo das páginas públicas do site. Você pode adicionar texto HTML, 
              links externos ou fazer upload de arquivos PDF.
            </p>
          </div>
        </div>

        {loading ? (
          <div className="text-center my-5">
            <div className="br-loading"></div>
          </div>
        ) : (
          <div className="row">
            {todasPaginas.map((pagina) => (
              <div key={pagina.slug} className="col-md-6 col-lg-4 mb-4">
                <div className="br-card">
                  <div className="card-header">
                    <h4>{pagina.label}</h4>
                  </div>
                  <div className="card-content">
                    <div className="mb-2">
                      <strong className="text-muted" style={{ fontSize: '0.875rem' }}>
                        Status:
                      </strong>
                      <span className={`br-tag small ml-2 ${pagina.conteudo || pagina.linkExterno || pagina.pdf ? 'success' : 'warning'}`}>
                        {pagina.conteudo || pagina.linkExterno || pagina.pdf ? 'Configurada' : 'Não configurada'}
                      </span>
                    </div>
                    
                    {pagina.conteudo && (
                      <div className="mb-2">
                        <i className="fas fa-file-alt mr-1"></i>
                        <small>Conteúdo HTML definido</small>
                      </div>
                    )}
                    
                    {pagina.linkExterno && (
                      <div className="mb-2">
                        <i className="fas fa-external-link-alt mr-1"></i>
                        <small>Link externo configurado</small>
                      </div>
                    )}
                    
                    {pagina.pdf && (
                      <div className="mb-2">
                        <i className="fas fa-file-pdf mr-1 text-danger"></i>
                        <small>PDF anexado</small>
                      </div>
                    )}
                  </div>
                  <div className="card-footer d-flex justify-content-between">
                    <button
                      className="br-button secondary small"
                      onClick={() => handleEdit(pagina.slug)}
                    >
                      <i className="fas fa-edit mr-1"></i>
                      Editar
                    </button>
                    {pagina.pdf && (
                      <button
                        className="br-button circle small"
                        onClick={() => handleRemoverPdf(pagina.slug)}
                        title="Remover PDF"
                      >
                        <i className="fas fa-trash"></i>
                      </button>
                    )}
                  </div>
                </div>
              </div>
            ))}
          </div>
        )}
      </div>

      {showModal && (
        <>
          <div className="br-scrim fundo-modal" onClick={() => setShowModal(false)}></div>
          <div className="br-modal large modal-centralizado">
            <div className="br-modal-header">
              <div className="br-modal-title">
                Editar: {slugLabels[editingSlug]}
              </div>
            </div>
            <div className="br-modal-body">
              <form onSubmit={handleSubmit}>
                <div className="row">
                  <div className="col-12 mb-3">
                    <div className="br-textarea">
                      <label htmlFor="conteudo">Conteúdo HTML</label>
                      <textarea
                        id="conteudo"
                        rows="10"
                        value={formData.conteudo}
                        onChange={(e) => setFormData({ ...formData, conteudo: e.target.value })}
                        placeholder="Cole aqui o HTML da página..."
                      ></textarea>
                      <small className="text-muted">
                        Você pode usar tags HTML como &lt;h1&gt;, &lt;p&gt;, &lt;ul&gt;, etc.
                      </small>
                    </div>
                  </div>
                  
                  <div className="col-12 mb-3">
                    <div className="br-divider"></div>
                    <p className="text-center text-muted my-2">OU</p>
                    <div className="br-divider"></div>
                  </div>
                  
                  <div className="col-12 mb-3">
                    <div className="br-input">
                      <label htmlFor="linkExterno">Link Externo</label>
                      <input
                        id="linkExterno"
                        type="url"
                        value={formData.linkExterno}
                        onChange={(e) => setFormData({ ...formData, linkExterno: e.target.value })}
                        placeholder="https://exemplo.com"
                      />
                      <small className="text-muted">
                        URL externa para redirecionar os visitantes
                      </small>
                    </div>
                  </div>
                  
                  <div className="col-12 mb-3">
                    <div className="br-divider"></div>
                    <p className="text-center text-muted my-2">E/OU</p>
                    <div className="br-divider"></div>
                  </div>
                  
                  <div className="col-12 mb-3">
                    <div className="br-input">
                      <label htmlFor="pdf">Arquivo PDF (opcional)</label>
                      <input
                        id="pdf"
                        type="file"
                        accept=".pdf"
                        onChange={handleFileChange}
                      />
                      <small className="text-muted">
                        PDF para download (máx 20MB). Deixe em branco para manter o arquivo atual.
                      </small>
                    </div>
                  </div>
                </div>

                <div className="br-modal-footer d-flex justify-content-end">
                  <button
                    type="button"
                    className="br-button secondary mr-2"
                    onClick={() => {
                      setShowModal(false);
                      resetForm();
                    }}
                  >
                    Cancelar
                  </button>
                  <button type="submit" className="br-button primary">
                    Salvar
                  </button>
                </div>
              </form>
            </div>
          </div>
        </>
      )}
    </MainLayout>
  );
};

export default AdminPaginas;
