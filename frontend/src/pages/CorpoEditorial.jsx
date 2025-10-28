import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';

const CorpoEditorial = () => {
  const [pagina, setPagina] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchPagina();
  }, []);

  const fetchPagina = async () => {
    try {
      const { data } = await api.get('/public/paginas/corpo-editorial');
      if (data.success) setPagina(data.data);
    } catch (err) {
      console.error(err);
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
            <span>Corpo Editorial</span>
          </li>
        </ul>
      </div>

      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">
          <i className="fas fa-users mr-2"></i>
          Corpo Editorial
        </h1>

        {loading ? (
          <div className="text-center my-5">
            <div className="br-loading" aria-label="Carregando"></div>
          </div>
        ) : (
          <div className="br-card">
            <div className="card-content">
              {pagina?.conteudo ? (
                <div dangerouslySetInnerHTML={{ __html: pagina.conteudo }} />
              ) : (
                <>
                  <h2 className="text-up-02 text-weight-semi-bold mb-3">Comissão Organizadora</h2>
                  <ul className="mb-4">
                    <li><strong>Coordenação Geral:</strong> Prof. Dr. João Silva</li>
                    <li><strong>Vice-Coordenação:</strong> Profa. Dra. Maria Santos</li>
                    <li><strong>Secretaria Executiva:</strong> Dr. Pedro Oliveira</li>
                  </ul>

                  <h2 className="text-up-02 text-weight-semi-bold mb-3">Comissão Científica</h2>
                  <ul className="mb-4">
                    <li>Prof. Dr. Carlos Almeida</li>
                    <li>Profa. Dra. Ana Paula Costa</li>
                    <li>Prof. Dr. Roberto Lima</li>
                    <li>Profa. Dra. Juliana Ferreira</li>
                  </ul>

                  <h2 className="text-up-02 text-weight-semi-bold mb-3">Conselho Editorial</h2>
                  <p className="text-base">
                    O conselho editorial é composto por pesquisadores renomados de diversas instituições nacionais e internacionais.
                  </p>
                </>
              )}
            </div>
          </div>
        )}
      </div>
    </MainLayout>
  );
};

export default CorpoEditorial;
