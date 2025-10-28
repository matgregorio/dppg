import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import api from '../services/api';
import useNotification from '../hooks/useNotification';

const ForgotPassword = () => {
  const { showSuccess, showError } = useNotification();
  const [email, setEmail] = useState('');
  const [loading, setLoading] = useState(false);
  const [submitted, setSubmitted] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    
    try {
      setLoading(true);
      const response = await api.post('/auth/forgot-password', { email });
      
      setSubmitted(true);
      showSuccess('Se o email existir, você receberá instruções para recuperação');
      
      // Em desenvolvimento, mostra o token no console
      if (response.data.devToken) {
        console.log('Token de recuperação (DEV):', response.data.devToken);
      }
    } catch (error) {
      console.error('Erro ao solicitar recuperação:', error);
      showError('Erro ao processar solicitação');
    } finally {
      setLoading(false);
    }
  };

  return (
    <MainLayout>
      <div className="container-lg my-5">
        <div className="row justify-content-center">
          <div className="col-md-6 col-lg-5">
            <div className="br-card">
              <div className="card-header">
                <h2 className="text-center mb-0">Recuperar Senha</h2>
              </div>
              <div className="card-content">
                {!submitted ? (
                  <>
                    <p className="text-center mb-4">
                      Digite seu email para receber instruções de recuperação de senha.
                    </p>
                    
                    <form onSubmit={handleSubmit}>
                      <div className="br-input mb-4">
                        <label htmlFor="email">Email</label>
                        <input
                          id="email"
                          type="email"
                          value={email}
                          onChange={(e) => setEmail(e.target.value)}
                          required
                          placeholder="seu@email.com"
                          autoFocus
                        />
                      </div>

                      <button
                        type="submit"
                        className="br-button primary w-100 mb-3"
                        disabled={loading}
                      >
                        {loading ? 'Enviando...' : 'Enviar Instruções'}
                      </button>
                    </form>
                  </>
                ) : (
                  <div className="br-message success">
                    <div className="icon">
                      <i className="fas fa-check-circle" aria-hidden="true"></i>
                    </div>
                    <div className="content">
                      <span className="message-title">Solicitação enviada!</span>
                      <span className="message-body">
                        Se o email fornecido estiver cadastrado, você receberá 
                        instruções para recuperação de senha.
                      </span>
                    </div>
                  </div>
                )}
                
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

export default ForgotPassword;
