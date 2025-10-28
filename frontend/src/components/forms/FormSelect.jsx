import React from 'react';
import { useFormContext } from 'react-hook-form';

/**
 * Componente de select reutilizável com integração React Hook Form e GOVBR-DS
 * 
 * @param {string} name - Nome do campo (obrigatório para RHF)
 * @param {string} label - Label do campo
 * @param {array} options - Array de opções [{ value, label }]
 * @param {string} placeholder - Texto da primeira opção vazia
 * @param {boolean} required - Se o campo é obrigatório
 * @param {boolean} disabled - Se o campo está desabilitado
 * @param {object} validation - Regras de validação adicionais do RHF
 */
const FormSelect = ({
  name,
  label,
  options = [],
  placeholder = 'Selecione...',
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
    <div className={`br-select ${hasError ? 'danger' : ''}`}>
      {label && (
        <label htmlFor={name}>
          {label}
          {required && <span className="text-danger ml-1">*</span>}
        </label>
      )}
      <select
        id={name}
        disabled={disabled}
        aria-invalid={hasError}
        aria-describedby={hasError ? `${name}-error` : undefined}
        {...register(name, {
          required: required ? `${label || 'Este campo'} é obrigatório` : false,
          ...validation,
        })}
        {...rest}
      >
        {placeholder && <option value="">{placeholder}</option>}
        {options.map((option, index) => (
          <option key={option.value || index} value={option.value}>
            {option.label}
          </option>
        ))}
      </select>
      {hasError && (
        <span id={`${name}-error`} className="feedback danger" role="alert">
          <i className="fas fa-times-circle" aria-hidden="true"></i>
          {error.message}
        </span>
      )}
    </div>
  );
};

export default FormSelect;
