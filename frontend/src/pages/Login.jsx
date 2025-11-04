import React, { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { useDispatch } from 'react-redux';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import { loginStart, loginSuccess, loginFailure } from '../store/slices/authSlice';
import authService from '../services/authService';

const loginSchema = z.object({
  email: z.string().email('Email inválido').min(1, 'Email é obrigatório'),
  senha: z.string().min(6, 'Senha deve ter no mínimo 6 caracteres'),
});

const Login = () => {
  const navigate = useNavigate();
  const dispatch = useDispatch();
  const [error, setError] = useState('');
  
  const {
    register,
    handleSubmit,
    formState: { errors, isSubmitting },
  } = useForm({
    resolver: zodResolver(loginSchema),
  });
  
  const onSubmit = async (formData) => {
    try {
      setError('');
      dispatch(loginStart());
      
      const response = await authService.login(formData.email, formData.senha);
      
      if (response.success) {
        dispatch(loginSuccess(response.data));
        
        // Buscar dados completos do usuário
        const meResponse = await authService.me();
        if (meResponse.success) {
          dispatch(loginSuccess({ ...response.data, user: meResponse.data }));
        }
        
        // Verificar se há URL de retorno salva (do QR Code)
        const returnUrl = sessionStorage.getItem('returnAfterLogin');
        if (returnUrl) {
          sessionStorage.removeItem('returnAfterLogin');
          navigate(returnUrl);
        } else {
          navigate('/');
        }
      } else {
        throw new Error(response.message || 'Erro ao fazer login');
      }
    } catch (err) {
      const message = err.response?.data?.message || err.message || 'Erro ao fazer login';
      setError(message);
      dispatch(loginFailure(message));
    }
  };
  
  return (
    <div className="container-fluid d-flex align-items-center justify-content-center min-vh-100 bg-light">
      <div className="row w-100">
        <div className="col-12 col-md-6 col-lg-4 mx-auto">
          <div className="br-card">
            <div className="card-header">
              <div className="d-flex align-items-center">
                <span className="br-avatar mr-3">
                  <i className="fas fa-user fa-lg"></i>
                </span>
                <div>
                  <div className="text-weight-semi-bold text-up-02">Login</div>
                  <div className="text-down-01">Sistema de Simpósio</div>
                </div>
              </div>
            </div>
            <div className="card-content">
              <form onSubmit={handleSubmit(onSubmit)}>
                {error && (
                  <div className="br-message danger mb-3" role="alert">
                    <div className="icon">
                      <i className="fas fa-times-circle fa-lg" aria-hidden="true"></i>
                    </div>
                    <div className="content">{error}</div>
                  </div>
                )}
                
                <div className="br-input mb-3">
                  <label htmlFor="email">Email</label>
                  <input
                    {...register('email')}
                    id="email"
                    type="email"
                    placeholder="seu@email.com"
                    className={errors.email ? 'danger' : ''}
                  />
                  {errors.email && (
                    <span className="feedback danger" role="alert">
                      <i className="fas fa-times-circle" aria-hidden="true"></i>
                      {errors.email.message}
                    </span>
                  )}
                </div>
                
                <div className="br-input mb-3">
                  <label htmlFor="senha">Senha</label>
                  <input
                    {...register('senha')}
                    id="senha"
                    type="password"
                    placeholder="••••••••"
                    className={errors.senha ? 'danger' : ''}
                  />
                  {errors.senha && (
                    <span className="feedback danger" role="alert">
                      <i className="fas fa-times-circle" aria-hidden="true"></i>
                      {errors.senha.message}
                    </span>
                  )}
                </div>
                
                <button
                  type="submit"
                  className="br-button primary block mb-3"
                  disabled={isSubmitting}
                >
                  {isSubmitting ? 'Entrando...' : 'Entrar'}
                </button>
                
                <div className="text-center">
                  <Link to="/esqueci-senha" className="br-button secondary small">
                    Esqueci minha senha
                  </Link>
                  <br />
                  <Link to="/registro" className="br-button secondary small mt-2">
                    Criar conta
                  </Link>
                </div>
              </form>
            </div>
          </div>
          
          <div className="mt-4 p-3 bg-white br-card">
            <h6 className="text-weight-semi-bold mb-2">Contas de Teste:</h6>
            <small className="d-block">Admin: admin@gov.br / Admin!234</small>
            <small className="d-block">Participante: participante1@gov.br / Participante!234</small>
            <small className="d-block">Avaliador: avaliador1@gov.br / Avaliador!234</small>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Login;
