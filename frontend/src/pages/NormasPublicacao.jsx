import React from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';

const NormasPublicacao = () => {
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
            <span>Normas para Publicação</span>
          </li>
        </ul>
      </div>

      <div className="my-4">
        <h1 className="text-up-03 text-weight-bold mb-4">
          <i className="fas fa-book mr-2"></i>
          Normas para Publicação
        </h1>

        <div className="br-card">
          <div className="card-content">
            <h2 className="text-up-02 text-weight-semi-bold mb-3">Formato do Trabalho</h2>
            <ul className="mb-4">
              <li>Arquivo em PDF ou DOCX</li>
              <li>Tamanho máximo: 20MB</li>
              <li>Fonte: Times New Roman ou Arial, tamanho 12</li>
              <li>Espaçamento: 1,5 linhas</li>
              <li>Margens: 3cm (superior e esquerda), 2cm (inferior e direita)</li>
            </ul>

            <h2 className="text-up-02 text-weight-semi-bold mb-3">Estrutura</h2>
            <ol className="mb-4">
              <li><strong>Título:</strong> Claro e conciso (máximo 20 palavras)</li>
              <li><strong>Autores:</strong> Nome completo e afiliação institucional</li>
              <li><strong>Resumo:</strong> Entre 150 e 250 palavras</li>
              <li><strong>Palavras-chave:</strong> 3 a 5 palavras</li>
              <li><strong>Introdução:</strong> Contextualização e objetivos</li>
              <li><strong>Desenvolvimento:</strong> Metodologia e resultados</li>
              <li><strong>Conclusão:</strong> Considerações finais</li>
              <li><strong>Referências:</strong> Formato ABNT</li>
            </ol>

            <h2 className="text-up-02 text-weight-semi-bold mb-3">Citações e Referências</h2>
            <p className="text-base mb-4">
              Todas as citações devem seguir as normas ABNT NBR 10520. As referências devem ser 
              apresentadas ao final do trabalho, em ordem alfabética, seguindo a NBR 6023.
            </p>

            <h2 className="text-up-02 text-weight-semi-bold mb-3">Direitos Autorais</h2>
            <p className="text-base">
              Ao submeter um trabalho, o autor concede à organização do evento os direitos de 
              publicação nos anais. Os autores são responsáveis pelo conteúdo e originalidade 
              do trabalho submetido.
            </p>
          </div>
        </div>
      </div>
    </MainLayout>
  );
};

export default NormasPublicacao;
