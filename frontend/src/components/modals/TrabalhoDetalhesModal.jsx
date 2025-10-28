import React from 'react';

const TrabalhoDetalhesModal = ({ trabalho, isOpen, onClose, isAdmin = false }) => {
  if (!isOpen || !trabalho) return null;

  const calcularMedia = (competencias) => {
    if (!competencias) return 0;
    const valores = Object.values(competencias);
    return (valores.reduce((acc, val) => acc + val, 0) / valores.length).toFixed(2);
  };

  const competenciasLabels = {
    relevancia: 'Relevância do Tema',
    metodologia: 'Metodologia Adequada',
    clareza: 'Clareza na Apresentação',
    fundamentacao: 'Fundamentação Teórica',
    contribuicao: 'Contribuição Científica'
  };

  return (
    <>
      {/* Overlay */}
      <div 
        className="br-scrim-util foco" 
        style={{ display: 'block' }}
        onClick={onClose}
      ></div>

      {/* Modal */}
      <div 
        className="br-modal medium" 
        style={{ 
          display: 'block',
          position: 'fixed',
          top: '50%',
          left: '50%',
          transform: 'translate(-50%, -50%)',
          maxHeight: '90vh',
          overflowY: 'auto',
          zIndex: 9999
        }}
      >
        <div className="br-modal-header">
          <div className="br-modal-title" style={{ fontSize: '1.25rem', fontWeight: 600 }}>
            Detalhes do Trabalho
          </div>
        </div>

        <div className="br-modal-body" style={{ padding: '1.5rem' }}>
          {/* Informações Básicas */}
          <div className="mb-4">
            <h4 className="text-up-01 text-weight-semi-bold mb-3">
              <i className="fas fa-file-alt mr-2"></i>
              Informações Básicas
            </h4>
            
            <div className="mb-3">
              <strong>Título:</strong>
              <p className="mb-2">{trabalho.titulo}</p>
            </div>

            <div className="mb-3">
              <strong>Status:</strong>
              <span className={`br-tag ml-2 ${
                trabalho.status === 'ACEITO' ? 'success' :
                trabalho.status === 'REJEITADO' ? 'danger' :
                trabalho.status === 'EM_AVALIACAO' ? 'warning' : 'info'
              }`}>
                {trabalho.status}
              </span>
            </div>

            {trabalho.autores && trabalho.autores.length > 0 && (
              <div className="mb-3">
                <strong>Autores:</strong>
                <ul className="mt-2">
                  {trabalho.autores.map((autor, idx) => (
                    <li key={idx}>
                      {autor.nome} {autor.email && `(${autor.email})`}
                    </li>
                  ))}
                </ul>
              </div>
            )}

            {trabalho.grandeArea && (
              <div className="mb-2">
                <strong>Grande Área:</strong> {trabalho.grandeArea.nome || trabalho.grandeArea}
              </div>
            )}

            {trabalho.areaAtuacao && (
              <div className="mb-2">
                <strong>Área de Atuação:</strong> {trabalho.areaAtuacao.nome || trabalho.areaAtuacao}
              </div>
            )}

            {trabalho.media !== null && trabalho.media !== undefined && (
              <div className="mb-2">
                <strong>Média Final:</strong> 
                <span className="text-primary text-weight-bold ml-2">
                  {trabalho.media.toFixed(2)}
                </span>
              </div>
            )}

            {trabalho.notaExterna !== null && trabalho.notaExterna !== undefined && (
              <div className="mb-2">
                <strong>Nota Externa:</strong> 
                <span className="text-info text-weight-bold ml-2">
                  {trabalho.notaExterna.toFixed(2)}
                </span>
              </div>
            )}
          </div>

          <div className="br-divider my-4"></div>

          {/* Avaliações */}
          {trabalho.avaliacoes && trabalho.avaliacoes.length > 0 ? (
            <div>
              <h4 className="text-up-01 text-weight-semi-bold mb-3">
                <i className="fas fa-star mr-2"></i>
                Avaliações ({trabalho.avaliacoes.length})
              </h4>

              {trabalho.avaliacoes.map((avaliacao, idx) => (
                <div key={avaliacao._id || idx} className="br-card mb-3">
                  <div className="card-content" style={{ padding: '1rem' }}>
                    {/* Cabeçalho da Avaliação */}
                    <div className="mb-3 d-flex justify-content-between align-items-center">
                      <h5 className="text-weight-semi-bold mb-0">
                        Avaliação {idx + 1}
                      </h5>
                      {isAdmin && avaliacao.avaliador && (
                        <div className="text-sm">
                          <i className="fas fa-user-check mr-1"></i>
                          <strong>Avaliador:</strong> {avaliacao.avaliador.nome}
                        </div>
                      )}
                    </div>

                    {/* Competências */}
                    {avaliacao.competencias && Object.keys(avaliacao.competencias).length > 0 && (
                      <div className="mb-3">
                        <strong className="d-block mb-2">Competências Avaliadas:</strong>
                        <div className="row">
                          {Object.entries(competenciasLabels).map(([key, label]) => (
                            avaliacao.competencias[key] !== undefined && (
                              <div key={key} className="col-md-6 mb-2">
                                <div className="d-flex justify-content-between align-items-center">
                                  <span className="text-sm">{label}:</span>
                                  <span className="br-tag info ml-2">
                                    {avaliacao.competencias[key].toFixed(1)}
                                  </span>
                                </div>
                              </div>
                            )
                          ))}
                        </div>
                      </div>
                    )}

                    {/* Nota Final */}
                    {avaliacao.notaFinal !== undefined && avaliacao.notaFinal !== null && (
                      <div className="mb-3">
                        <strong>Nota Final:</strong>
                        <span className="text-primary text-weight-bold ml-2" style={{ fontSize: '1.2rem' }}>
                          {avaliacao.notaFinal.toFixed(2)}
                        </span>
                        {avaliacao.competencias && Object.keys(avaliacao.competencias).length > 0 && (
                          <span className="text-muted ml-2">
                            (Média: {calcularMedia(avaliacao.competencias)})
                          </span>
                        )}
                      </div>
                    )}
                    
                    {/* Nota (formato antigo - para compatibilidade) */}
                    {!avaliacao.notaFinal && avaliacao.nota !== undefined && avaliacao.nota !== null && (
                      <div className="mb-3">
                        <strong>Nota:</strong>
                        <span className="text-primary text-weight-bold ml-2" style={{ fontSize: '1.2rem' }}>
                          {avaliacao.nota.toFixed(2)}
                        </span>
                      </div>
                    )}

                    {/* Parecer */}
                    {avaliacao.parecer && (
                      <div className="mb-2">
                        <strong className="d-block mb-1">Parecer:</strong>
                        <div 
                          className="p-2" 
                          style={{ 
                            backgroundColor: '#f8f9fa', 
                            borderRadius: '4px',
                            whiteSpace: 'pre-wrap'
                          }}
                        >
                          {avaliacao.parecer}
                        </div>
                      </div>
                    )}

                    {/* Data */}
                    {avaliacao.data && (
                      <div className="text-sm text-muted mt-2">
                        <i className="fas fa-calendar-alt mr-1"></i>
                        Avaliado em: {new Date(avaliacao.data).toLocaleDateString('pt-BR', {
                          day: '2-digit',
                          month: '2-digit',
                          year: 'numeric',
                          hour: '2-digit',
                          minute: '2-digit'
                        })}
                      </div>
                    )}
                  </div>
                </div>
              ))}
            </div>
          ) : (
            <div className="br-message warning">
              <div className="icon">
                <i className="fas fa-exclamation-triangle fa-lg" aria-hidden="true"></i>
              </div>
              <div className="content">
                <span className="message-title">Nenhuma Avaliação</span>
                <span className="message-body">Este trabalho ainda não foi avaliado.</span>
              </div>
            </div>
          )}

          {/* Atribuições (apenas admin) */}
          {isAdmin && trabalho.atribuicoes && trabalho.atribuicoes.length > 0 && (
            <>
              <div className="br-divider my-4"></div>
              <div>
                <h4 className="text-up-01 text-weight-semi-bold mb-3">
                  <i className="fas fa-users mr-2"></i>
                  Avaliadores Atribuídos
                </h4>
                <ul>
                  {trabalho.atribuicoes
                    .filter(a => !a.revogado_em)
                    .map((atrib, idx) => (
                      <li key={idx}>
                        {atrib.avaliador?.nome || 'Avaliador não encontrado'}
                        {' '}({atrib.avaliador?.email || 'N/A'})
                        {atrib.enviado_em && (
                          <span className="text-muted ml-2">
                            - Atribuído em {new Date(atrib.enviado_em).toLocaleDateString('pt-BR')}
                          </span>
                        )}
                      </li>
                    ))}
                </ul>
              </div>
            </>
          )}
        </div>

        <div className="br-modal-footer" style={{ justifyContent: 'flex-end' }}>
          <button 
            className="br-button primary" 
            type="button"
            onClick={onClose}
          >
            Fechar
          </button>
        </div>
      </div>
    </>
  );
};

export default TrabalhoDetalhesModal;
