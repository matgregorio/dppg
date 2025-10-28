import React, { useState } from 'react';
import { Link, useNavigate, useSearchParams } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

const ResetPassword = () => {
  const { showSuccess, showError } = useNotification();
  const [searchParams] = useSearchParams();
  const navigate = useNavigate();
  const token = searchParams.get('token');
  
  const [formData, setFormData] = useState({
    novaSenha: '',
    confirmarSenha: ''
  });
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    
    if (formData.novaSenha !== formData.confirmarSenha) {
      showError('As senhas não coincidem');
      return;
    }
    
    if (formData.novaSenha.length < 6) {
      showError('A senha deve ter no mínimo 6 caracteres');
      return;
    }
    
    try {
      setLoading(true);
      await api.post('/auth/reset-password', {
        token,
        novaSenha: formData.novaSenha
      });
      
      showSuccess('Senha redefinida com sucesso! Você pode fazer login agora.');
      setTimeout(() => {
        navigate('/');
      }, 2000);
    } catch (error) {
      console.error('Erro ao redefinir senha:', error);
      showError(error.response?.data?.message || 'Erro ao redefinir senha. O token pode estar expirado.');
    } finally {
      setLoading(false);
    }
  };

  if (!token) {
    return (
      <MainLayout>
        <div className="container-lg my-5">
          <div className="row justify-content-center">
            <div className="col-md-6">
              <div className="br-message danger">
                <div className="icon">
                  <i className="fas fa-times-circle" aria-hidden="true"></i>
                </div>
                <div className="content">
                  <span className="message-title">Token inválido</span>
                  <span className="message-body">
                    O link de recuperação é inválido ou está incompleto.
                  </span>
                </div>
              </div>
              <div className="text-center mt-3">
                <Link to="/forgot-password" className="br-button primary">
                  Solicitar Novo Link
                </Link>
              </div>
            </div>
          </div>
        </div>
      </MainLayout>
    );
  }

  return (
    <MainLayout>
      <div className="container-lg my-5">
        <div className="row justify-content-center">
          <div className="col-md-6 col-lg-5">
            <div className="br-card">
              <div className="card-header">
                <h2 className="text-center mb-0">Redefinir Senha</h2>
              </div>
              <div className="card-content">
                <p className="text-center mb-4">
                  Digite sua nova senha abaixo.
                </p>
                
                <form onSubmit={handleSubmit}>
                  <div className="br-input mb-3">
                    <label htmlFor="novaSenha">Nova Senha</label>
                    <input
                      id="novaSenha"
                      type="password"
                      value={formData.novaSenha}
                      onChange={(e) => setFormData({ ...formData, novaSenha: e.target.value })}
                      required
                      minLength="6"
                      placeholder="Mínimo 6 caracteres"
                      autoFocus
                    />
                  </div>

                  <div className="br-input mb-4">
                    <label htmlFor="confirmarSenha">Confirmar Nova Senha</label>
                    <input
                      id="confirmarSenha"
                      type="password"
                      value={formData.confirmarSenha}
                      onChange={(e) => setFormData({ ...formData, confirmarSenha: e.target.value })}
                      required
                      minLength="6"
                      placeholder="Digite a senha novamente"
                    />
                  </div>

                  <button
                    type="submit"
                    className="br-button primary w-100 mb-3"
                    disabled={loading}
                  >
                    {loading ? 'Redefinindo...' : 'Redefinir Senha'}
                  </button>
                </form>
                
                <div className="text-center mt-3">
                  <Link to="/" className="br-button secondary">
                    Voltar ao Início
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </MainLayout>
  );
};

export default ResetPassword;
