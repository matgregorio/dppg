import React from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import './AreaAdministrativa.css';

const AreaAdministrativa = () => {
  const adminOptions = [
    { title: 'Área de Atuação', icon: 'fas fa-book-reader', link: '/admin/areas', color: '#1351B4' },
    { title: 'Subeventos', icon: 'fas fa-calendar-alt', link: '/admin/subeventos', color: '#1351B4' },
    { title: 'Grande Área', icon: 'fas fa-layer-group', link: '/admin/areas', color: '#1351B4' },
    { title: 'Acervo', icon: 'fas fa-archive', link: '/admin/acervo', color: '#1351B4' },
    { title: 'Configurar Datas', icon: 'fas fa-clock', link: '/admin/configurar-datas', color: '#1351B4' },
    { title: 'Participantes', icon: 'fas fa-users', link: '/admin/participantes', color: '#1351B4' },
    { title: 'Avaliadores', icon: 'fas fa-user-check', link: '/admin/avaliadores', color: '#1351B4' },
    { title: 'Avaliações Externas', icon: 'fas fa-star-half-alt', link: '/admin/avaliacoes-externas', color: '#1351B4' },
    { title: 'Páginas Estáticas', icon: 'fas fa-file-alt', link: '/admin/paginas', color: '#1351B4' },
    { title: 'Templates de Email', icon: 'fas fa-envelope', link: '/admin/email-templates', color: '#1351B4' },
    { title: 'Configuração de Certificados', icon: 'fas fa-award', link: '/admin/certificados-config', color: '#1351B4' },
    { title: 'Gerar Certificados', icon: 'fas fa-certificate', link: '/admin/certificados', color: '#1351B4' },
    { title: 'Trabalhos', icon: 'fas fa-file-upload', link: '/admin/trabalhos', color: '#1351B4' },
    { title: 'Simpósio', icon: 'fas fa-chalkboard-teacher', link: '/admin/simposio', color: '#1351B4' },
    { title: 'Ciclo do Simpósio', icon: 'fas fa-sync-alt', link: '/admin/ciclo-simposio', color: '#1351B4' },
    { title: 'Instituições', icon: 'fas fa-university', link: '/admin/instituicoes', color: '#1351B4' },
    { title: 'Docentes', icon: 'fas fa-user-graduate', link: '/admin/docentes', color: '#1351B4' },
    { title: 'Apoios', icon: 'fas fa-hands-helping', link: '/admin/apoios', color: '#1351B4' },
    { title: 'Funções Administrativas', icon: 'fas fa-user-shield', link: '/funcoes-administrativas', color: '#1351B4' },
    { title: 'Dashboard', icon: 'fas fa-chart-bar', link: '/admin/dashboard', color: '#1351B4' },
    { title: 'Validar Certificado', icon: 'fas fa-check-circle', link: '/validar-certificado', color: '#1351B4' }
  ];



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



        {/* Grid de Cards */}
        <div className="row g-4">
          {adminOptions.map((option, index) => (
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


      </div>
    </MainLayout>
  );
};

export default AreaAdministrativa;
