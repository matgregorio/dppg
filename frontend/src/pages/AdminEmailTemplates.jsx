import { useState, useEffect } from 'react';
import { useNotification } from '../hooks/useNotification';
import api from '../services/api';
import MainLayout from '../layouts/MainLayout';

export default function AdminEmailTemplates() {
  const [templates, setTemplates] = useState([]);
  const [templateSelecionado, setTemplateSelecionado] = useState(null);
  const [loading, setLoading] = useState(true);
  const [salvando, setSalvando] = useState(false);
  const [modoEdicao, setModoEdicao] = useState(false);
  const [emailTeste, setEmailTeste] = useState('');
  const [enviandoTeste, setEnviandoTeste] = useState(false);
  const showNotification = useNotification();

  useEffect(() => {
    carregarTemplates();
  }, []);

  const carregarTemplates = async () => {
    try {
      setLoading(true);
      const response = await api.get('/admin/email-templates');
      setTemplates(response.data.data);
      
      if (response.data.data.length > 0 && !templateSelecionado) {
        setTemplateSelecionado(response.data.data[0]);
      }
    } catch (error) {
      console.error('Erro ao carregar templates:', error);
      showNotification('Erro ao carregar templates de email', 'error');
    } finally {
      setLoading(false);
    }
  };

  const inicializarTemplates = async () => {
    try {
      await api.post('/admin/email-templates/inicializar');
      showNotification('Templates inicializados com sucesso', 'success');
      carregarTemplates();
    } catch (error) {
      console.error('Erro ao inicializar templates:', error);
      showNotification('Erro ao inicializar templates', 'error');
    }
  };

  const selecionarTemplate = (template) => {
    setTemplateSelecionado({ ...template });
    setModoEdicao(false);
  };

  const salvarTemplate = async () => {
    try {
      setSalvando(true);
      
      await api.put(`/admin/email-templates/${templateSelecionado._id}`, {
        assunto: templateSelecionado.assunto,
        corpo: templateSelecionado.corpo,
        ativo: templateSelecionado.ativo,
      });
      
      showNotification('Template atualizado com sucesso', 'success');
      setModoEdicao(false);
      carregarTemplates();
    } catch (error) {
      console.error('Erro ao salvar template:', error);
      showNotification('Erro ao salvar template', 'error');
    } finally {
      setSalvando(false);
    }
  };

  const restaurarPadrao = async () => {
    if (!confirm('Deseja realmente restaurar este template para o padrão? As alterações atuais serão perdidas.')) {
      return;
    }
    
    try {
      await api.post(`/admin/email-templates/${templateSelecionado._id}/restaurar`);
      showNotification('Template restaurado para o padrão', 'success');
      setModoEdicao(false);
      carregarTemplates();
    } catch (error) {
      console.error('Erro ao restaurar template:', error);
      showNotification('Erro ao restaurar template', 'error');
    }
  };

  const enviarEmailTeste = async () => {
    if (!emailTeste) {
      showNotification('Digite um email de destino', 'warning');
      return;
    }
    
    try {
      setEnviandoTeste(true);
      
      await api.post(`/admin/email-templates/${templateSelecionado._id}/testar`, {
        emailDestino: emailTeste,
      });
      
      showNotification(`Email de teste enviado para ${emailTeste}`, 'success');
      setEmailTeste('');
    } catch (error) {
      console.error('Erro ao enviar email de teste:', error);
      showNotification('Erro ao enviar email de teste', 'error');
    } finally {
      setEnviandoTeste(false);
    }
  };

  if (loading) {
    return (
      <MainLayout>
        <div className="container-lg py-4">
          <div className="text-center py-5">
            <div className="br-loading" style={{ margin: '0 auto' }}></div>
            <p className="mt-3 text-base">Carregando templates...</p>
          </div>
        </div>
      </MainLayout>
    );
  }

  if (templates.length === 0) {
    return (
      <MainLayout>
        <div className="container-lg py-4">
          <div className="br-message warning">
            <div className="icon">
              <i className="fas fa-exclamation-triangle fa-lg"></i>
            </div>
            <div className="content">
              <span className="message-title">Nenhum template encontrado</span>
              <span className="message-body">
                Os templates de email ainda não foram inicializados. Clique no botão abaixo para criar os templates padrão.
              </span>
            </div>
            <div className="close">
              <button 
                className="br-button primary mt-3" 
                type="button"
                onClick={inicializarTemplates}
              >
                <i className="fas fa-plus-circle me-2"></i>
                Inicializar Templates
              </button>
            </div>
          </div>
        </div>
      </MainLayout>
    );
  }

  return (
    <MainLayout>
      <div className="container-lg py-4">
        <div className="mb-4">
          <h2 className="mb-2">Gerenciar Templates de Email</h2>
          <p className="text-base mb-0">
            Personalize os emails automáticos enviados pelo sistema. Use variáveis no formato <code>{`{{nome_variavel}}`}</code> para inserir dados dinâmicos.
          </p>
        </div>

        <div className="row g-4">
          {/* Lista de templates */}
          <div className="col-lg-4">
            <div className="br-card h-100">
              <div className="card-header">
                <div className="d-flex align-items-center">
                  <div className="flex-fill">
                    <h5 className="mb-0">Templates</h5>
                  </div>
                </div>
              </div>
              <div className="card-content">
                <div className="br-list">
                  {templates.map((template) => (
                    <div 
                      key={template._id} 
                      className={`br-item ${templateSelecionado?._id === template._id ? 'active' : ''}`}
                      style={{ cursor: 'pointer' }}
                      onClick={() => selecionarTemplate(template)}
                    >
                      <div className="row align-items-center">
                        <div className="col">
                          <span style={{ 
                            fontWeight: templateSelecionado?._id === template._id ? '600' : '400',
                            color: templateSelecionado?._id === template._id ? '#fff' : 'inherit'
                          }}>
                            {template.nome}
                          </span>
                        </div>
                        {!template.ativo && (
                          <div className="col-auto">
                            <span className="br-tag small" style={{ background: '#888' }}>Inativo</span>
                          </div>
                        )}
                      </div>
                    </div>
                  ))}
                </div>
              </div>
            </div>
          </div>

          {/* Editor do template */}
          <div className="col-lg-8">
            {templateSelecionado && (
              <div className="br-card">
                <div className="card-header">
                  <div className="d-flex justify-content-between align-items-center">
                    <h5 className="mb-0">{templateSelecionado.nome}</h5>
                    {!modoEdicao ? (
                      <button
                        className="br-button primary"
                        type="button"
                        onClick={() => setModoEdicao(true)}
                      >
                        <i className="fas fa-edit me-1"></i>
                        Editar
                      </button>
                    ) : (
                      <div className="d-flex gap-2">
                        <button
                          className="br-button secondary"
                          type="button"
                          onClick={() => {
                            setModoEdicao(false);
                            carregarTemplates();
                          }}
                        >
                          Cancelar
                        </button>
                        <button
                          className="br-button primary"
                          type="button"
                          onClick={salvarTemplate}
                          disabled={salvando}
                        >
                          {salvando ? 'Salvando...' : 'Salvar'}
                        </button>
                        <button
                          className="br-button"
                          type="button"
                          onClick={restaurarPadrao}
                        >
                          Restaurar Padrão
                        </button>
                      </div>
                    )}
                  </div>
                </div>

                <div className="card-content p-4">
                  {/* Status */}
                  <div className="mb-4">
                    <div className="br-switch">
                      <input
                        id="templateAtivo"
                        type="checkbox"
                        checked={templateSelecionado.ativo}
                        onChange={(e) =>
                          setTemplateSelecionado({
                            ...templateSelecionado,
                            ativo: e.target.checked,
                          })
                        }
                        disabled={!modoEdicao}
                      />
                      <label htmlFor="templateAtivo">Template ativo</label>
                    </div>
                  </div>

                  {/* Assunto */}
                  <div className="br-input mb-4">
                    <label htmlFor="assunto">Assunto do Email</label>
                    <input
                      id="assunto"
                      type="text"
                      value={templateSelecionado.assunto}
                      onChange={(e) =>
                        setTemplateSelecionado({
                          ...templateSelecionado,
                          assunto: e.target.value,
                        })
                      }
                      disabled={!modoEdicao}
                      placeholder="Digite o assunto do email"
                    />
                  </div>

                  {/* Corpo */}
                  <div className="br-textarea mb-4">
                    <label htmlFor="corpo">Corpo do Email</label>
                    <textarea
                      id="corpo"
                      rows="15"
                      value={templateSelecionado.corpo}
                      onChange={(e) =>
                        setTemplateSelecionado({
                          ...templateSelecionado,
                          corpo: e.target.value,
                        })
                      }
                      disabled={!modoEdicao}
                      placeholder="Digite o conteúdo do email"
                      style={{ fontFamily: 'monospace', fontSize: '13px' }}
                    />
                  </div>

                  {/* Variáveis disponíveis */}
                  <div className="mb-4">
                    <h6 className="mb-3">Variáveis Disponíveis</h6>
                    
                    <div className="br-message info mb-3">
                      <div className="icon">
                        <i className="fas fa-lightbulb fa-lg"></i>
                      </div>
                      <div className="content">
                        <span className="message-title">Como usar variáveis</span>
                        <span className="message-body">
                          Insira as variáveis no formato <code>{`{{nome_variavel}}`}</code> no assunto ou corpo do email.
                          Elas serão automaticamente substituídas pelos valores reais ao enviar.
                        </span>
                      </div>
                    </div>

                    <div className="br-card mb-3">
                      <div className="card-content p-3" style={{ background: '#f8f9fa' }}>
                        <strong className="d-block mb-2">Exemplo:</strong>
                        <code className="d-block text-muted mb-2">
                          Olá {`{{usuario_nome}}`}, seu trabalho "{`{{trabalho_titulo}}`}" foi submetido!
                        </code>
                        <div className="text-center my-2">
                          <i className="fas fa-arrow-down text-success"></i>
                        </div>
                        <span className="text-success">
                          Olá <strong>João Silva</strong>, seu trabalho "<strong>Inteligência Artificial</strong>" foi submetido!
                        </span>
                      </div>
                    </div>

                    <div className="br-table">
                      <table>
                        <thead>
                          <tr>
                            <th scope="col" style={{ width: '40%' }}>Variável</th>
                            <th scope="col">Descrição</th>
                          </tr>
                        </thead>
                        <tbody>
                          {templateSelecionado.variaveis.map((variavel, index) => (
                            <tr 
                              key={index}
                              style={{ cursor: 'pointer' }}
                              onClick={() => {
                                navigator.clipboard.writeText(variavel.chave);
                                showNotification('Variável copiada para área de transferência', 'success');
                              }}
                              title="Clique para copiar"
                            >
                              <td>
                                <code className="text-primary-default" style={{ fontWeight: 600 }}>
                                  {variavel.chave}
                                </code>
                              </td>
                              <td>{variavel.descricao}</td>
                            </tr>
                          ))}
                        </tbody>
                      </table>
                    </div>
                    <p className="mt-2 mb-0 text-base text-muted">
                      <i className="fas fa-info-circle me-1"></i>
                      Clique em qualquer variável para copiá-la
                    </p>
                  </div>

                  {/* Teste de envio */}
                  <div className="br-card" style={{ background: '#f8f9fa', border: '1px solid #e9ecef' }}>
                    <div className="card-content p-3">
                      <h6 className="mb-2">Enviar Email de Teste</h6>
                      <p className="text-base text-muted mb-3">
                        Envie um email de teste com dados de exemplo para verificar o resultado
                      </p>
                      <div className="row g-2 align-items-end">
                        <div className="col">
                          <div className="br-input">
                            <label htmlFor="emailTeste">Email de destino</label>
                            <input
                              id="emailTeste"
                              type="email"
                              placeholder="seu-email@exemplo.com"
                              value={emailTeste}
                              onChange={(e) => setEmailTeste(e.target.value)}
                            />
                          </div>
                        </div>
                        <div className="col-auto">
                          <button
                            className="br-button primary"
                            type="button"
                            onClick={enviarEmailTeste}
                            disabled={enviandoTeste || !emailTeste}
                          >
                            <i className="fas fa-paper-plane me-1"></i>
                            {enviandoTeste ? 'Enviando...' : 'Enviar Teste'}
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            )}
          </div>
        </div>
      </div>
    </MainLayout>
  );
}
