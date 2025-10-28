import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const Regulamento = () => {
  const [pagina, setPagina] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');

  useEffect(() => {
    fetchPagina();
  }, []);

  const fetchPagina = async () => {
    try {
      const { data } = await api.get('/public/paginas/regulamento');
      if (data.success) {
        setPagina(data.data);
      }
    } catch (err) {
      setError('Erro ao carregar regulamento');
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
            <span>Regulamento</span>
          </li>
        </ul>
      </div>

      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">
          <i className="fas fa-gavel mr-2"></i>
          Regulamento
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
                    Regulamento Geral do Simpósio
                  </h2>

                  <h3 className="text-up-01 text-weight-semi-bold mt-4 mb-2">1. DAS INSCRIÇÕES</h3>
                  <p className="text-base mb-2">
                    1.1. As inscrições serão realizadas exclusivamente através do sistema online, 
                    dentro do período estabelecido no cronograma.
                  </p>
                  <p className="text-base mb-3">
                    1.2. Cada participante poderá submeter até 2 (dois) trabalhos como autor principal.
                  </p>

                  <h3 className="text-up-01 text-weight-semi-bold mt-4 mb-2">2. DA SUBMISSÃO DE TRABALHOS</h3>
                  <p className="text-base mb-2">
                    2.1. Os trabalhos deverão ser submetidos em formato PDF ou DOCX, com no máximo 20MB.
                  </p>
                  <p className="text-base mb-2">
                    2.2. O trabalho deve conter: título, autores, resumo, palavras-chave, introdução, 
                    desenvolvimento, conclusão e referências.
                  </p>
                  <p className="text-base mb-3">
                    2.3. A submissão implica na aceitação automática de todos os termos deste regulamento.
                  </p>

                  <h3 className="text-up-01 text-weight-semi-bold mt-4 mb-2">3. DA AVALIAÇÃO</h3>
                  <p className="text-base mb-2">
                    3.1. Todos os trabalhos submetidos serão avaliados por no mínimo 2 (dois) avaliadores.
                  </p>
                  <p className="text-base mb-2">
                    3.2. A avaliação será baseada em critérios de originalidade, relevância, 
                    metodologia e qualidade da apresentação.
                  </p>
                  <p className="text-base mb-3">
                    3.3. Os avaliadores atribuirão notas de 0 a 10 e um parecer descritivo.
                  </p>

                  <h3 className="text-up-01 text-weight-semi-bold mt-4 mb-2">4. DA APRESENTAÇÃO</h3>
                  <p className="text-base mb-2">
                    4.1. Os trabalhos aprovados deverão ser apresentados na modalidade definida 
                    pela organização (oral, pôster ou outra).
                  </p>
                  <p className="text-base mb-3">
                    4.2. A ausência na apresentação implicará na não publicação do trabalho nos anais.
                  </p>

                  <h3 className="text-up-01 text-weight-semi-bold mt-4 mb-2">5. DOS CERTIFICADOS</h3>
                  <p className="text-base mb-2">
                    5.1. Serão emitidos certificados para participação, apresentação de trabalhos e avaliação.
                  </p>
                  <p className="text-base mb-3">
                    5.2. Os certificados estarão disponíveis para download no sistema após o evento.
                  </p>

                  <h3 className="text-up-01 text-weight-semi-bold mt-4 mb-2">6. DISPOSIÇÕES GERAIS</h3>
                  <p className="text-base mb-3">
                    6.1. Os casos omissos serão resolvidos pela Comissão Organizadora do evento.
                  </p>
                </>
              )}

              {pagina?.links?.pdf && (
                <div className="mt-4 text-center">
                  <a
                    href={pagina.links.pdf}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="br-button primary large"
                  >
                    <i className="fas fa-file-pdf mr-2"></i>
                    Baixar Regulamento Completo (PDF)
                  </a>
                </div>
              )}
            </div>
          </div>
        )}
      </div>
    </MainLayout>
  );
};

export default Regulamento;
