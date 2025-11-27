import React, { useState, useEffect } from 'react';
import { useDispatch } from 'react-redux';
import { useNavigate } from 'react-router-dom';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import authService from '../../services/authService';
import { loginSuccess } from '../../store/slices/authSlice';
import useNotification from '../../hooks/useNotification';

const registerSchema = z.object({
  nome: z.string().min(3, 'Nome deve ter no mínimo 3 caracteres'),
  email: z.string().email('Email inválido'),
  cpf: z.string().min(11, 'CPF deve ter 11 dígitos').max(14, 'CPF inválido'),
  telefone: z.string().min(10, 'Telefone deve ter no mínimo 10 dígitos'),
  senha: z.string().min(8, 'Senha deve ter no mínimo 8 caracteres')
    .regex(/[A-Z]/, 'Senha deve conter pelo menos uma letra maiúscula')
    .regex(/[a-z]/, 'Senha deve conter pelo menos uma letra minúscula')
    .regex(/[0-9]/, 'Senha deve conter pelo menos um número')
    .regex(/[!@#$%^&*]/, 'Senha deve conter pelo menos um caractere especial (!@#$%^&*)'),
  confirmarSenha: z.string(),
  tipoParticipante: z.enum(['ALUNO', 'DOCENTE', 'EX_ALUNO'], {
    required_error: 'Selecione o tipo de participante'
  }),
  instituicao: z.string().min(1, 'Instituição é obrigatória'),
  areaAtuacao: z.string().optional(),
  subarea: z.string().optional(),
  visitante: z.boolean().optional(),
}).refine((data) => data.senha === data.confirmarSenha, {
  message: 'As senhas não coincidem',
  path: ['confirmarSenha'],
}).refine((data) => {
  // Para DOCENTE, grande área e subárea são obrigatórias
  if (data.tipoParticipante === 'DOCENTE') {
    return data.areaAtuacao && data.subarea;
  }
  return true;
}, {
  message: 'Grande área e subárea são obrigatórias para docentes',
  path: ['areaAtuacao'],
});

const RegisterModal = ({ isOpen, onClose, onOpenLogin }) => {
  const dispatch = useDispatch();
  const navigate = useNavigate();
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);
  const { showSuccess } = useNotification();
  const [instituicoes, setInstituicoes] = useState([]);
  const [areasAtuacao, setareasAtuacao] = useState([]);
  const [subareas, setSubareas] = useState([]);
  const [subareasFiltradas, setSubareasFiltradas] = useState([]);
  
  const {
    register,
    handleSubmit,
    formState: { errors },
    reset,
    watch,
    setValue,
  } = useForm({
    resolver: zodResolver(registerSchema),
    defaultValues: {
      tipoParticipante: 'ALUNO',
      visitante: false
    }
  });
  
  const tipoParticipante = watch('tipoParticipante');
  const areaAtuacaoSelecionada = watch('areaAtuacao');
  
  // Carregar dados necessários
  React.useEffect(() => {
    if (isOpen) {
      carregarDados();
    }
  }, [isOpen]);
  
  // Filtrar subáreas quando grande área mudar
  React.useEffect(() => {
    if (areaAtuacaoSelecionada) {
      // Filtrar subáreas cuja área de atuação pertence à grande área selecionada
      const filtradas = subareas.filter(s => s.areaAtuacao?.areaAtuacao?._id === areaAtuacaoSelecionada || s.areaAtuacao?.areaAtuacao === areaAtuacaoSelecionada);
      setSubareasFiltradas(filtradas);
    } else {
      setSubareasFiltradas([]);
    }
  }, [areaAtuacaoSelecionada, subareas]);
  
  const carregarDados = async () => {
    try {
      // Carregar instituições
      const instResponse = await fetch(`${import.meta.env.VITE_API_BASE_URL || 'http://localhost:4000/api/v1'}/public/instituicoes`);
      if (instResponse.ok) {
        const instData = await instResponse.json();
        setInstituicoes(instData.data || []);
      }
      
      // Carregar áreas de atuação
      const gaResponse = await fetch(`${import.meta.env.VITE_API_BASE_URL || 'http://localhost:4000/api/v1'}/public/areas-atuacao`);
      if (gaResponse.ok) {
        const gaData = await gaResponse.json();
        setareasAtuacao(gaData.data || []);
      }
      
      // Carregar subáreas
      const subResponse = await fetch(`${import.meta.env.VITE_API_BASE_URL || 'http://localhost:4000/api/v1'}/public/subareas`);
      if (subResponse.ok) {
        const subData = await subResponse.json();
        setSubareas(subData.data || []);
      }
    } catch (err) {
      console.error('Erro ao carregar dados:', err);
    }
  };
  
  const formatCPF = (value) => {
    const numbers = value.replace(/\D/g, '');
    if (numbers.length <= 11) {
      return numbers
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d{1,2})/, '$1-$2')
        .replace(/(-\d{2})\d+?$/, '$1');
    }
    return value;
  };
  
  const formatTelefone = (value) => {
    const numbers = value.replace(/\D/g, '');
    if (numbers.length <= 11) {
      return numbers
        .replace(/(\d{2})(\d)/, '($1) $2')
        .replace(/(\d{5})(\d)/, '$1-$2')
        .replace(/(-\d{4})\d+?$/, '$1');
    }
    return value;
  };
  
  const onSubmit = async (data) => {
    try {
      setLoading(true);
      setError('');
      
      // Remove formatação do CPF e telefone
      const cpfLimpo = data.cpf.replace(/\D/g, '');
      const telefoneLimpo = data.telefone.replace(/\D/g, '');
      
      // Registra o usuário
      const registerData = {
        nome: data.nome,
        email: data.email,
        cpf: cpfLimpo,
        telefone: telefoneLimpo,
        senha: data.senha,
        tipoParticipante: data.tipoParticipante,
        instituicao: data.instituicao
      };
      
      // Adiciona campos específicos para DOCENTE
      if (data.tipoParticipante === 'DOCENTE') {
        registerData.areaAtuacao = data.areaAtuacao;
        registerData.subarea = data.subarea;
        registerData.visitante = data.visitante || false;
      }
      
      const registerResponse = await authService.register(registerData);
      
      if (registerResponse.success) {
        showSuccess('Cadastro realizado com sucesso! Você já está logado.');
        
        // Salva token no localStorage
        localStorage.setItem('accessToken', registerResponse.data.accessToken);
        
        // Busca dados completos do usuário
        const userResponse = await authService.me();
        
        if (userResponse.success) {
          // Salva tudo no Redux
          dispatch(loginSuccess({
            user: userResponse.data,
            accessToken: registerResponse.data.accessToken
          }));
          
          reset();
          onClose();
          navigate('/');
        }
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Erro ao realizar cadastro');
    } finally {
      setLoading(false);
    }
  };
  
  const handleClose = () => {
    reset();
    setError('');
    onClose();
  };
  
  const handleCPFChange = (e) => {
    e.target.value = formatCPF(e.target.value);
  };
  
  const handleTelefoneChange = (e) => {
    e.target.value = formatTelefone(e.target.value);
  };
  

  
  if (!isOpen) return null;
  
  return (
    <>
      <div className="br-scrim fundo-modal" onClick={handleClose}></div>
      <div className="br-modal large modal-centralizado" style={{ maxWidth: '800px', maxHeight: '90vh', display: 'flex', flexDirection: 'column' }}>
        <div className="br-modal-header" style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', flexShrink: 0 }}>
          <div className="br-modal-title">
            <i className="fas fa-user-plus mr-2"></i>
            Criar Conta
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
        
        <form onSubmit={handleSubmit(onSubmit)} style={{ display: 'flex', flexDirection: 'column', flex: 1, minHeight: 0 }}>
          <div className="br-modal-body" style={{ flex: 1, overflowY: 'auto', scrollbarWidth: 'none', msOverflowStyle: 'none' }}>
            {error && (
              <div className="br-message danger mb-3" role="alert">
                <div className="icon">
                  <i className="fas fa-times-circle fa-lg"></i>
                </div>
                <div className="content">{error}</div>
              </div>
            )}
            
            <div className="br-message info mb-4" role="alert">
              <div className="icon">
                <i className="fas fa-info-circle"></i>
              </div>
              <div className="content">
                <strong>Bem-vindo!</strong> Preencha o formulário abaixo para criar sua conta e participar do simpósio.
              </div>
            </div>
            
            <div className="row">
              <div className="col-md-12 mb-3">
                <div className={`br-input ${errors.nome ? 'danger' : ''}`}>
                  <label htmlFor="nome">
                    Nome Completo <span className="text-danger">*</span>
                  </label>
                  <input
                    id="nome"
                    type="text"
                    placeholder="Digite seu nome completo"
                    disabled={loading}
                    {...register('nome')}
                  />
                  {errors.nome && (
                    <span className="feedback danger" role="alert">
                      <i className="fas fa-times-circle"></i>
                      {errors.nome.message}
                    </span>
                  )}
                </div>
              </div>
              
              <div className="col-md-6 mb-3">
                <div className={`br-input ${errors.email ? 'danger' : ''}`}>
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
              </div>
              
              <div className="col-md-6 mb-3">
                <div className={`br-input ${errors.cpf ? 'danger' : ''}`}>
                  <label htmlFor="cpf">
                    CPF <span className="text-danger">*</span>
                  </label>
                  <input
                    id="cpf"
                    type="text"
                    placeholder="000.000.000-00"
                    maxLength="14"
                    disabled={loading}
                    {...register('cpf')}
                    onChange={handleCPFChange}
                  />
                  {errors.cpf && (
                    <span className="feedback danger" role="alert">
                      <i className="fas fa-times-circle"></i>
                      {errors.cpf.message}
                    </span>
                  )}
                </div>
              </div>
            </div>
            
            <div className="row">
              <div className="col-md-6 mb-3">
                <div className={`br-input ${errors.telefone ? 'danger' : ''}`}>
                  <label htmlFor="telefone">
                    Telefone <span className="text-danger">*</span>
                  </label>
                  <input
                    id="telefone"
                    type="text"
                    placeholder="(00) 00000-0000"
                    maxLength="15"
                    disabled={loading}
                    {...register('telefone')}
                    onChange={handleTelefoneChange}
                  />
                  {errors.telefone && (
                    <span className="feedback danger" role="alert">
                      <i className="fas fa-times-circle"></i>
                      {errors.telefone.message}
                    </span>
                  )}
                </div>
              </div>
              
              <div className="col-md-6 mb-3">
                <div className={`br-input ${errors.tipoParticipante ? 'danger' : ''}`}>
                  <label htmlFor="tipoParticipante">
                    Tipo de Participante <span className="text-danger">*</span>
                  </label>
                  <select
                    id="tipoParticipante"
                    className="form-control"
                    disabled={loading}
                    {...register('tipoParticipante')}
                  >
                    <option value="">Selecione o tipo de participante</option>
                    <option value="ALUNO">Aluno</option>
                    <option value="DOCENTE">Docente (Professor)</option>
                    <option value="EX_ALUNO">Ex-Aluno</option>
                  </select>
                  {errors.tipoParticipante && (
                    <span className="feedback danger" role="alert">
                      <i className="fas fa-times-circle"></i>
                      {errors.tipoParticipante.message}
                    </span>
                  )}
                </div>
              </div>
            </div>
            
            <div className="row">
              <div className="col-md-6 mb-3">
                <div className={`br-input ${errors.instituicao ? 'danger' : ''}`}>
                  <label htmlFor="instituicao">
                    Instituição <span className="text-danger">*</span>
                  </label>
                  <select
                    id="instituicao"
                    className="form-control"
                    disabled={loading}
                    {...register('instituicao')}
                  >
                    <option value="">Selecione uma instituição</option>
                    {instituicoes.map(inst => (
                      <option key={inst._id} value={inst._id}>
                        {inst.sigla ? `${inst.sigla} - ${inst.nome}` : inst.nome}
                      </option>
                    ))}
                  </select>
                  {errors.instituicao && (
                    <span className="feedback danger" role="alert">
                      <i className="fas fa-times-circle"></i>
                      {errors.instituicao.message}
                    </span>
                  )}
                </div>
              </div>
            </div>
              
              {tipoParticipante === 'DOCENTE' && (
                <>
                  <div className="col-md-6 mb-3">
                    <div className={`br-input ${errors.areaAtuacao ? 'danger' : ''}`}>
                      <label htmlFor="areaAtuacao">
                        Grande Área <span className="text-danger">*</span>
                      </label>
                      <select
                        id="areaAtuacao"
                        className="form-control"
                        disabled={loading}
                        {...register('areaAtuacao')}
                      >
                        <option value="">Selecione uma grande área</option>
                        {areasAtuacao.map(ga => (
                          <option key={ga._id} value={ga._id}>
                            {ga.nome}
                          </option>
                        ))}
                      </select>
                      {errors.areaAtuacao && (
                        <span className="feedback danger" role="alert">
                          <i className="fas fa-times-circle"></i>
                          {errors.areaAtuacao.message}
                        </span>
                      )}
                    </div>
                  </div>
                  
                  <div className="col-md-6 mb-3">
                    <div className={`br-input ${errors.subarea ? 'danger' : ''}`}>
                      <label htmlFor="subarea">
                        Subárea <span className="text-danger">*</span>
                      </label>
                      <select
                        id="subarea"
                        className="form-control"
                        disabled={loading || !areaAtuacaoSelecionada}
                        {...register('subarea')}
                      >
                        <option value="">
                          {!areaAtuacaoSelecionada ? "Selecione uma grande área primeiro" : "Selecione uma subárea"}
                        </option>
                        {subareasFiltradas.map(sub => (
                          <option key={sub._id} value={sub._id}>
                            {sub.nome}
                          </option>
                        ))}
                      </select>
                      {errors.subarea && (
                        <span className="feedback danger" role="alert">
                          <i className="fas fa-times-circle"></i>
                          {errors.subarea.message}
                        </span>
                      )}
                    </div>
                  </div>
                  
                  <div className="col-md-12 mb-3">
                    <div className="br-checkbox">
                      <input
                        id="visitante"
                        type="checkbox"
                        disabled={loading}
                        {...register('visitante')}
                      />
                      <label htmlFor="visitante">
                        Sou docente visitante
                      </label>
                    </div>
                  </div>
                </>
              )}
            
            <div className="row">
              <div className="col-md-6 mb-3">
                <div className={`br-input ${errors.senha ? 'danger' : ''}`}>
                  <label htmlFor="senha">
                    Senha <span className="text-danger">*</span>
                  </label>
                  <input
                    id="senha"
                    type="password"
                    placeholder="Mínimo 8 caracteres"
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
              </div>
              
              <div className="col-md-6 mb-3">
                <div className={`br-input ${errors.confirmarSenha ? 'danger' : ''}`}>
                  <label htmlFor="confirmarSenha">
                    Confirmar Senha <span className="text-danger">*</span>
                  </label>
                  <input
                    id="confirmarSenha"
                    type="password"
                    placeholder="Digite a senha novamente"
                    disabled={loading}
                    {...register('confirmarSenha')}
                  />
                  {errors.confirmarSenha && (
                    <span className="feedback danger" role="alert">
                      <i className="fas fa-times-circle"></i>
                      {errors.confirmarSenha.message}
                    </span>
                  )}
                </div>
              </div>
            </div>
            
            <div className="br-message warning" role="alert">
              <div className="icon">
                <i className="fas fa-exclamation-triangle"></i>
              </div>
              <div className="content">
                <strong>Requisitos da senha:</strong>
                <ul className="mt-2 mb-0" style={{ paddingLeft: '20px' }}>
                  <li>Mínimo de 8 caracteres</li>
                  <li>Pelo menos uma letra maiúscula</li>
                  <li>Pelo menos uma letra minúscula</li>
                  <li>Pelo menos um número</li>
                  <li>Pelo menos um caractere especial (!@#$%^&*)</li>
                </ul>
              </div>
            </div>
          </div>
          
          <div className="br-modal-footer justify-content-between" style={{ flexShrink: 0 }}>
            <div>
              <button
                type="button"
                className="br-button tertiary"
                onClick={() => {
                  handleClose();
                  if (onOpenLogin) onOpenLogin();
                }}
                disabled={loading}
              >
                <i className="fas fa-arrow-left mr-2"></i>
                Já tenho conta
              </button>
            </div>
            <div className="d-flex gap-2">
              <button
                type="button"
                className="br-button secondary"
                onClick={handleClose}
                disabled={loading}
              >
                Cancelar
              </button>
              <button
                type="submit"
                className="br-button primary"
                disabled={loading}
              >
                {loading ? (
                  <>
                    <i className="fas fa-spinner fa-spin mr-2"></i>
                    Criando conta...
                  </>
                ) : (
                  <>
                    <i className="fas fa-user-plus mr-2"></i>
                    Criar Conta
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

export default RegisterModal;
