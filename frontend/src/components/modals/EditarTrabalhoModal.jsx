import React, { useState, useEffect } from 'react';

const EditarTrabalhoModal = ({ trabalho, isOpen, onClose, onSave }) => {
  const [formData, setFormData] = useState({
    status: '',
    tipoApresentacao: '',
    notaExterna: '',
  });

  useEffect(() => {
    if (trabalho) {
      setFormData({
        status: trabalho.status || '',
        tipoApresentacao: trabalho.tipoApresentacao || 'NAO_DEFINIDO',
        notaExterna: trabalho.notaExterna || '',
      });
    }
  }, [trabalho]);

  const handleSubmit = (e) => {
    e.preventDefault();
    onSave(formData);
  };

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value,
    }));
  };

  if (!isOpen || !trabalho) return null;

  return (
    <>
      <div className="br-modal active" style={{ display: 'block', position: 'fixed', top: '50%', left: '50%', transform: 'translate(-50%, -50%)', zIndex: 9999, maxWidth: '750px', width: '90%' }}>
        <div className="br-modal-content">
            <div className="br-modal-header">
              <div className="br-modal-title">
                <i className="fas fa-edit mr-2"></i>
                Editar Trabalho
              </div>
              <button
                className="br-button close circle"
                type="button"
                onClick={onClose}
              >
                <i className="fas fa-times"></i>
              </button>
            </div>
            <div className="br-modal-body">
              <div className="mb-3">
                <h6 className="text-weight-semi-bold mb-2">{trabalho.titulo}</h6>
                <div className="text-down-01 text-gray-60">
                  <i className="fas fa-user mr-2"></i>
                  {trabalho.autores?.map(a => a.nome).join(', ')}
                </div>
              </div>
              
              <form onSubmit={handleSubmit}>
                <div className="row">
                  <div className="col-md-6">
                    <div className="mb-3">
                      <label htmlFor="status" className="mb-2">
                        <i className="fas fa-flag mr-2"></i>
                        Status *
                      </label>
                      <select
                        id="status"
                        value={formData.status}
                        onChange={(e) => setFormData({ ...formData, status: e.target.value })}
                        required
                        style={{
                          width: '100%',
                          padding: '0.5rem 0.75rem',
                          border: '1px solid #888',
                          borderRadius: '8px',
                          fontSize: '1rem',
                          fontFamily: 'Rawline, sans-serif',
                          backgroundColor: 'white',
                          cursor: 'pointer',
                          outline: 'none'
                        }}
                      >
                        <option value="SUBMETIDO">Submetido</option>
                        <option value="EM_AVALIACAO">Em Avaliação</option>
                        <option value="ACEITO">Aceito</option>
                        <option value="REJEITADO">Rejeitado</option>
                        <option value="PUBLICADO">Publicado</option>
                      </select>
                    </div>
                  </div>
                  
                  <div className="col-md-6">
                    <div className="mb-3">
                      <label htmlFor="tipoApresentacao" className="mb-2">
                        <i className="fas fa-presentation mr-2"></i>
                        Tipo de Apresentação
                      </label>
                      <select
                        id="tipoApresentacao"
                        value={formData.tipoApresentacao}
                        onChange={(e) => setFormData({ ...formData, tipoApresentacao: e.target.value })}
                        style={{
                          width: '100%',
                          padding: '0.5rem 0.75rem',
                          border: '1px solid #888',
                          borderRadius: '8px',
                          fontSize: '1rem',
                          fontFamily: 'Rawline, sans-serif',
                          backgroundColor: 'white',
                          cursor: 'pointer',
                          outline: 'none'
                        }}
                      >
                        <option value="NAO_DEFINIDO">Não Definido</option>
                        <option value="POSTER">Poster</option>
                        <option value="ORAL">Oral</option>
                      </select>
                    </div>
                  </div>
                </div>
                
                <div className="br-input mb-3">
                  <label htmlFor="notaExterna">
                    <i className="fas fa-star mr-2"></i>
                    Nota Externa (0-10)
                  </label>
                  <input
                    type="number"
                    id="notaExterna"
                    name="notaExterna"
                    className="form-control"
                    value={formData.notaExterna}
                    onChange={handleChange}
                    min="0"
                    max="10"
                    step="0.1"
                    placeholder="Nota de avaliação externa (opcional)"
                  />
                </div>
                
                {formData.status === 'ACEITO' && (
                  <div className="br-message info mb-3">
                    <div className="content">
                      <i className="fas fa-info-circle mr-2"></i>
                      Ao aceitar o trabalho, o autor receberá um email de notificação com o resultado.
                    </div>
                  </div>
                )}
                
                {formData.status === 'REJEITADO' && (
                  <div className="br-message warning mb-3">
                    <div className="content">
                      <i className="fas fa-exclamation-triangle mr-2"></i>
                      Ao rejeitar o trabalho, o autor receberá um email de notificação com o resultado.
                    </div>
                  </div>
                )}
                
                <div className="d-flex justify-content-end gap-2 mt-4">
                  <button
                    type="button"
                    className="br-button secondary"
                    onClick={onClose}
                  >
                    Cancelar
                  </button>
                  <button type="submit" className="br-button primary">
                    <i className="fas fa-save mr-2"></i>
                    Salvar Alterações
                  </button>
                </div>
              </form>
            </div>
        </div>
      </div>
      <div className="br-modal-backdrop active" onClick={onClose} style={{ backgroundColor: 'rgba(0, 0, 0, 0.5)', zIndex: 9998 }}></div>
    </>
  );
};

export default EditarTrabalhoModal;
