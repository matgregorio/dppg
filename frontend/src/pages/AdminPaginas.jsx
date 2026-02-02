import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import ReactQuill from 'react-quill';
import 'react-quill/dist/quill.snow.css';
import { BrUpload } from '@govbr-ds/react-components';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

const AdminPaginas = () => {
  const { showSuccess, showError } = useNotification();
  const [paginas, setPaginas] = useState([]);
  const [loading, setLoading] = useState(true);
  const [editingSlug, setEditingSlug] = useState(null);
  const [showModal, setShowModal] = useState(false);
  const [uploadingBanner, setUploadingBanner] = useState(false);
  
  const [formData, setFormData] = useState({
    conteudo: '',
    linkExterno: '',
    pdf: null
  });

  // Configuração do ReactQuill
  const quillModules = {
    toolbar: [
      [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
      ['bold', 'italic', 'underline', 'strike'],
      [{ 'list': 'ordered'}, { 'list': 'bullet' }],
      [{ 'indent': '-1'}, { 'indent': '+1' }],
      [{ 'color': [] }, { 'background': [] }],
      [{ 'align': [] }],
      ['link', 'image', 'video'],
      ['clean']
    ],
  };

  const quillFormats = [
    'header',
    'bold', 'italic', 'underline', 'strike',
    'list', 'bullet', 'indent',
    'color', 'background',
    'align',
    'link', 'image', 'video'
  ];

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
                  <span>Páginas Estáticas</span>
                </li>
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

        {/* Upload de Banner da Página Inicial */}
        <div className="row mb-4">
          <div className="col">
            <div className="br-card">
              <div className="card-header" style={{ background: '#1351B4', color: 'white' }}>
                <h4 className="mb-0">
                  <i className="fas fa-image mr-2"></i>
                  Gerenciar Banner da Página Inicial
                </h4>
              </div>
              <div className="card-content p-4">
                <p className="mb-3">
                  Faça upload de uma imagem para o banner principal da página inicial. 
                  Formatos aceitos: JPG, PNG. Tamanho máximo: 5MB.
                </p>
                <BrUpload
                  disabled={uploadingBanner}
                  accept="image/jpeg,image/jpg,image/png"
                  onChange={handleUploadBanner}
                  label={uploadingBanner ? "Enviando..." : "Selecionar imagem do banner"}
                />
              </div>
            </div>
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
                    <label htmlFor="conteudo" className="d-block mb-2">
                      <strong>Conteúdo HTML</strong>
                    </label>
                    <ReactQuill
                      theme="snow"
                      value={formData.conteudo}
                      onChange={(content) => setFormData({ ...formData, conteudo: content })}
                      modules={quillModules}
                      formats={quillFormats}
                      style={{ height: '300px', marginBottom: '50px' }}
                    />
                    <small className="text-muted d-block mt-2">
                      Use o editor para formatar o conteúdo da página com negrito, listas, links, imagens, etc.
                    </small>
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
                    <BrUpload
                      label="Arquivo PDF (opcional)"
                      onChange={handleFileChange}
                    />
                    <small className="text-muted d-block mt-2">
                      PDF para download (máx 20MB). Deixe em branco para manter o arquivo atual.
                    </small>
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
