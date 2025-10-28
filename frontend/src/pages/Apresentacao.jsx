import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const Apresentacao = () => {
  const [pagina, setPagina] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');

  useEffect(() => {
    fetchPagina();
  }, []);

  const fetchPagina = async () => {
    try {
      const { data } = await api.get('/public/paginas/apresentacao');
      if (data.success) {
        setPagina(data.data);
      }
    } catch (err) {
      setError('Erro ao carregar página de apresentação');
    } finally {
      setLoading(false);
    }
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
            <span>Apresentação</span>
          </li>
        </ul>
      </div>

      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">
          <i className="fas fa-info-circle mr-2"></i>
          Apresentação
        </h1>

        {loading ? (
          <div className="text-center my-5">
            <div className="br-loading" aria-label="Carregando"></div>
          </div>
        ) : error ? (
          <div className="br-message danger" role="alert">
            <div className="icon">
              <i className="fas fa-times-circle fa-lg"></i>
            </div>
            <div className="content">{error}</div>
          </div>
        ) : (
          <div className="br-card">
            <div className="card-content">
              {pagina?.conteudo ? (
                <div dangerouslySetInnerHTML={{ __html: pagina.conteudo }} />
              ) : (
                <>
                  <h2 className="text-up-02 text-weight-semi-bold mb-3">
                    Bem-vindo ao Simpósio Anual
                  </h2>
                  
                  <p className="text-base mb-3">
                    O Simpósio Anual é um evento acadêmico de excelência que reúne pesquisadores, 
                    estudantes e profissionais de diversas áreas do conhecimento para compartilhar 
                    experiências, apresentar trabalhos científicos e discutir os avanços em suas 
                    respectivas áreas.
                  </p>

                  <h3 className="text-up-01 text-weight-semi-bold mt-4 mb-2">Objetivos</h3>
                  <ul className="mb-3">
                    <li>Promover o intercâmbio de conhecimento entre pesquisadores</li>
                    <li>Estimular a produção científica e tecnológica</li>
                    <li>Divulgar resultados de pesquisas acadêmicas</li>
                    <li>Fortalecer a integração entre universidade e sociedade</li>
                    <li>Incentivar a formação de redes de colaboração científica</li>
                  </ul>

                  <h3 className="text-up-01 text-weight-semi-bold mt-4 mb-2">Público-Alvo</h3>
                  <p className="text-base mb-3">
                    O evento destina-se a docentes, discentes, pesquisadores e profissionais 
                    interessados em compartilhar suas experiências e conhecimentos científicos.
                  </p>

                  <h3 className="text-up-01 text-weight-semi-bold mt-4 mb-2">Áreas Temáticas</h3>
                  <ul className="mb-3">
                    <li>Ciências Exatas e da Terra</li>
                    <li>Engenharias</li>
                    <li>Ciências da Saúde</li>
                    <li>Ciências Humanas</li>
                    <li>Ciências Sociais Aplicadas</li>
                    <li>Linguística, Letras e Artes</li>
                  </ul>

                  {pagina?.links?.pdf && (
                    <div className="mt-4">
                      <a
                        href={pagina.links.pdf}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="br-button primary"
                      >
                        <i className="fas fa-file-pdf mr-2"></i>
                        Baixar Apresentação Completa (PDF)
                      </a>
                    </div>
                  )}
                </>
              )}
            </div>
          </div>
        )}
      </div>
    </MainLayout>
  );
};

export default Apresentacao;
