import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import './AreaAdministrativa.css';

const AreaAdministrativa = () => {
  const [searchTerm, setSearchTerm] = useState('');

  const adminOptions = [
    { title: 'Área de Atuação', icon: 'fas fa-book-reader', link: '/admin/areas', color: '#90EE90' },
    { title: 'Subeventos', icon: 'fas fa-calendar-alt', link: '/admin/subeventos', color: '#90EE90' },
    { title: 'Grande Área', icon: 'fas fa-layer-group', link: '/admin/areas', color: '#90EE90' },
    { title: 'Acervo', icon: 'fas fa-archive', link: '/admin/acervo', color: '#90EE90' },
    { title: 'Configurar Datas', icon: 'fas fa-clock', link: '/configurar-datas', color: '#90EE90' },
    { title: 'Participantes', icon: 'fas fa-users', link: '/admin/participantes', color: '#90EE90' },
    { title: 'Avaliadores', icon: 'fas fa-user-check', link: '/admin/avaliadores', color: '#90EE90' },
    { title: 'Avaliações Externas', icon: 'fas fa-star-half-alt', link: '/admin/avaliacoes-externas', color: '#90EE90' },
    { title: 'Páginas Estáticas', icon: 'fas fa-file-alt', link: '/admin/paginas', color: '#90EE90' },
    { title: 'Templates de Email', icon: 'fas fa-envelope', link: '/admin/email-templates', color: '#90EE90' },
    { title: 'Configuração de Certificados', icon: 'fas fa-award', link: '/admin/certificados-config', color: '#90EE90' },
    { title: 'Gerar Certificados', icon: 'fas fa-certificate', link: '/admin/certificados', color: '#90EE90' },
    { title: 'Trabalhos', icon: 'fas fa-file-upload', link: '/admin/trabalhos', color: '#90EE90' },
    { title: 'Simpósio', icon: 'fas fa-chalkboard-teacher', link: '/admin/simposio', color: '#90EE90' },
    { title: 'Ciclo do Simpósio', icon: 'fas fa-sync-alt', link: '/admin/ciclo-simposio', color: '#90EE90' },
    { title: 'Instituições', icon: 'fas fa-university', link: '/admin/instituicoes', color: '#90EE90' },
    { title: 'Docentes', icon: 'fas fa-user-graduate', link: '/admin/docentes', color: '#90EE90' },
    { title: 'Apoios', icon: 'fas fa-hands-helping', link: '/admin/apoios', color: '#90EE90' },
    { title: 'Funções Administrativas', icon: 'fas fa-user-shield', link: '/funcoes-administrativas', color: '#90EE90' },
    { title: 'Dashboard', icon: 'fas fa-chart-bar', link: '/admin/dashboard', color: '#90EE90' },
    { title: 'Validar Certificado', icon: 'fas fa-check-circle', link: '/validar-certificado', color: '#90EE90' }
  ];

  // Filtrar opções baseado na busca
  const filteredOptions = adminOptions.filter(option =>
    option.title.toLowerCase().includes(searchTerm.toLowerCase())
  );

  return (
    <MainLayout>
      <div className="container-fluid my-4 px-4">
        {/* Breadcrumb */}
        <div className="row mb-4">
          <div className="col">
            <nav className="br-breadcrumb" aria-label="Breadcrumbs">
              <ol className="crumb-list" role="list">
                <li className="crumb home"><Link to="/">Início</Link></li>
                <li className="crumb" data-active="active"><span>Área Administrativa</span></li>
              </ol>
            </nav>
          </div>
        </div>

        {/* Cabeçalho */}
        <div className="row mb-4">
          <div className="col-12">
            <div className="admin-header">
              <h1 className="admin-title">
                <i className="fas fa-shield-alt mr-3"></i>
                Área Administrativa
              </h1>
              <p className="admin-subtitle">
                Selecione uma opção para gerenciar
              </p>
            </div>
          </div>
        </div>

        {/* Barra de Busca */}
        <div className="row mb-4">
          <div className="col-lg-6 offset-lg-3">
            <div className="br-input">
              <input
                type="text"
                placeholder="Buscar funcionalidade..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="admin-search"
              />
              <i className="fas fa-search"></i>
            </div>
          </div>
        </div>

        {/* Grid de Cards */}
        <div className="row g-4">
          {filteredOptions.map((option, index) => (
            <div key={index} className="col-xl-3 col-lg-4 col-md-6 col-sm-12">
              <Link to={option.link} className="admin-card-link">
                <div className="admin-card-simple" style={{ borderTopColor: option.color }}>
                  <div className="admin-card-simple-header" style={{ backgroundColor: option.color }}>
                    <i className={`${option.icon} admin-card-simple-icon`}></i>
                  </div>
                  <div className="admin-card-simple-body">
                    <h3 className="admin-card-simple-title">{option.title}</h3>
                  </div>
                </div>
              </Link>
            </div>
          ))}
        </div>

        {/* Mensagem quando não há resultados */}
        {filteredOptions.length === 0 && (
          <div className="row mt-5">
            <div className="col-12 text-center">
              <div className="alert alert-warning" role="alert">
                <i className="fas fa-search mr-2"></i>
                Nenhuma funcionalidade encontrada para "{searchTerm}"
              </div>
            </div>
          </div>
        )}
      </div>
    </MainLayout>
  );
};

export default AreaAdministrativa;
