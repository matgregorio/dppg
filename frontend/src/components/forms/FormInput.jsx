import React from 'react';
import { useFormContext } from 'react-hook-form';

/**
 * Componente de input reutilizável com integração React Hook Form e GOVBR-DS
 * 
 * @param {string} name - Nome do campo (obrigatório para RHF)
 * @param {string} label - Label do campo
 * @param {string} type - Tipo do input (text, email, password, number, date, etc)
 * @param {string} placeholder - Placeholder do input
 * @param {boolean} required - Se o campo é obrigatório
 * @param {boolean} disabled - Se o campo está desabilitado
 * @param {object} validation - Regras de validação adicionais do RHF
 */
const FormInput = ({
  name,
  label,
  type = 'text',
  placeholder = '',
  required = false,
  disabled = false,
  validation = {},
  ...rest
}) => {
  const {
    register,
    formState: { errors },
  } = useFormContext();
  
  const error = errors[name];
  const hasError = !!error;
  
  return (
    <div className={`br-input ${hasError ? 'danger' : ''}`}>
      {label && (
        <label htmlFor={name}>
          {label}
          {required && <span className="text-danger ml-1">*</span>}
        </label>
      )}
      <input
        id={name}
        type={type}
        placeholder={placeholder}
        disabled={disabled}
        aria-invalid={hasError}
        aria-describedby={hasError ? `${name}-error` : undefined}
        {...register(name, {
          required: required ? `${label || 'Este campo'} é obrigatório` : false,
          ...validation,
        })}
        {...rest}
      />
      {hasError && (
        <span id={`${name}-error`} className="feedback danger" role="alert">
          <i className="fas fa-times-circle" aria-hidden="true"></i>
          {error.message}
        </span>
      )}
    </div>
  );
};

export default FormInput;
