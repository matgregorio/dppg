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
      <div className="br-modal active" style={{ display: 'block' }}>
        <div className="br-modal-dialog" style={{ maxWidth: '600px' }}>
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
                    <div className="br-input mb-3">
                      <label htmlFor="status">
                        <i className="fas fa-flag mr-2"></i>
                        Status *
                      </label>
                      <select
                        id="status"
                        name="status"
                        className="form-control"
                        value={formData.status}
                        onChange={handleChange}
                        required
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
                    <div className="br-input mb-3">
                      <label htmlFor="tipoApresentacao">
                        <i className="fas fa-presentation mr-2"></i>
                        Tipo de Apresentação
                      </label>
                      <select
                        id="tipoApresentacao"
                        name="tipoApresentacao"
                        className="form-control"
                        value={formData.tipoApresentacao}
                        onChange={handleChange}
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
      </div>
      <div className="br-modal-backdrop active" onClick={onClose}></div>
    </>
  );
};

export default EditarTrabalhoModal;
