import React, { useState } from 'react';
import { useDispatch } from 'react-redux';
import { useNavigate, Link } from 'react-router-dom';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import authService from '../../services/authService';
import { loginSuccess } from '../../store/slices/authSlice';

const loginSchema = z.object({
  email: z.string().email('Email inválido'),
  senha: z.string().min(6, 'Senha deve ter no mínimo 6 caracteres'),
});

const LoginModal = ({ isOpen, onClose, onOpenRegister }) => {
  const dispatch = useDispatch();
  const navigate = useNavigate();
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);
  
  const {
    register,
    handleSubmit,
    formState: { errors },
    reset,
  } = useForm({
    resolver: zodResolver(loginSchema),
  });
  
  const onSubmit = async (data) => {
    try {
      setLoading(true);
      setError('');
      
      // Faz login e obtém token
      const loginResponse = await authService.login(data.email, data.senha);
      
      if (loginResponse.success) {
        // Salva token no localStorage
        localStorage.setItem('accessToken', loginResponse.data.accessToken);
        
        // Busca dados completos do usuário
        const userResponse = await authService.me();
        
        if (userResponse.success) {
          // Salva tudo no Redux de uma vez
          dispatch(loginSuccess({
            user: userResponse.data,
            accessToken: loginResponse.data.accessToken
          }));
          
          reset();
          onClose();
          navigate('/');
        }
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao fazer login');
    } finally {
      setLoading(false);
    }
  };
  
  const handleClose = () => {
    reset();
    setError('');
    onClose();
  };
  
  if (!isOpen) return null;
  
  return (
    <>
      <div className="br-scrim fundo-modal" onClick={handleClose}></div>
      <div className="br-modal medium modal-centralizado">
        <div className="br-modal-header" style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
          <div className="br-modal-title">
            <i className="fas fa-sign-in-alt mr-2"></i>
            Entrar no Sistema
          </div>
          <button
            className="br-button circle small"
            type="button"
            onClick={handleClose}
            aria-label="Fechar"
          >
            <i className="fas fa-times"></i>
          </button>
        </div>
        
        <form onSubmit={handleSubmit(onSubmit)}>
          <div className="br-modal-body">
            {error && (
              <div className="br-message danger mb-3" role="alert">
                <div className="icon">
                  <i className="fas fa-times-circle fa-lg"></i>
                </div>
                <div className="content">{error}</div>
              </div>
            )}
            
            <div className={`br-input mb-3 ${errors.email ? 'danger' : ''}`}>
              <label htmlFor="email">
                Email <span className="text-danger">*</span>
              </label>
              <input
                id="email"
                type="email"
                placeholder="seu@email.com"
                disabled={loading}
                {...register('email')}
              />
              {errors.email && (
                <span className="feedback danger" role="alert">
                  <i className="fas fa-times-circle"></i>
                  {errors.email.message}
                </span>
              )}
            </div>
            
            <div className={`br-input mb-3 ${errors.senha ? 'danger' : ''}`}>
              <label htmlFor="senha">
                Senha <span className="text-danger">*</span>
              </label>
              <input
                id="senha"
                type="password"
                placeholder="••••••"
                disabled={loading}
                {...register('senha')}
              />
              {errors.senha && (
                <span className="feedback danger" role="alert">
                  <i className="fas fa-times-circle"></i>
                  {errors.senha.message}
                </span>
              )}
            </div>
            
            <div className="text-right mb-3">
              <Link 
                to="/forgot-password" 
                className="br-button tertiary small"
                onClick={handleClose}
              >
                <i className="fas fa-key mr-1"></i>
                Esqueceu a senha?
              </Link>
            </div>
            
            <div className="br-message info" role="alert">
              <div className="icon">
                <i className="fas fa-info-circle"></i>
              </div>
              <div className="content">
                <strong>Contas de teste:</strong>
                <ul className="mt-2 mb-0" style={{ paddingLeft: '20px' }}>
                  <li><code>admin@gov.br</code> / <code>Admin!234</code></li>
                  <li><code>participante1@gov.br</code> / <code>Participante!234</code></li>
                  <li><code>avaliador1@gov.br</code> / <code>Avaliador!234</code></li>
                </ul>
              </div>
            </div>
          </div>
          
          <div className="br-modal-footer justify-content-between">
            <button
              type="button"
              className="br-button secondary"
              onClick={handleClose}
              disabled={loading}
            >
              Cancelar
            </button>
            <div className="d-flex gap-2">
              <button
                type="button"
                className="br-button secondary"
                onClick={() => {
                  handleClose();
                  if (onOpenRegister) onOpenRegister();
                }}
                disabled={loading}
              >
                <i className="fas fa-user-plus mr-2"></i>
                Criar Conta
              </button>
              <button
                type="submit"
                className="br-button primary"
                disabled={loading}
              >
                {loading ? (
                  <>
                    <i className="fas fa-spinner fa-spin mr-2"></i>
                    Entrando...
                  </>
                ) : (
                  <>
                    <i className="fas fa-sign-in-alt mr-2"></i>
                    Entrar
                  </>
                )}
              </button>
            </div>
          </div>
        </form>
      </div>
    </>
  );
};

export default LoginModal;
