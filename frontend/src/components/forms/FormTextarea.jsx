import React from 'react';
import { useFormContext } from 'react-hook-form';

/**
 * Componente de textarea reutilizável com integração React Hook Form e GOVBR-DS
 * 
 * @param {string} name - Nome do campo (obrigatório para RHF)
 * @param {string} label - Label do campo
 * @param {string} placeholder - Placeholder do textarea
 * @param {number} rows - Número de linhas visíveis
 * @param {boolean} required - Se o campo é obrigatório
 * @param {boolean} disabled - Se o campo está desabilitado
 * @param {number} maxLength - Comprimento máximo do texto
 * @param {object} validation - Regras de validação adicionais do RHF
 */
const FormTextarea = ({
  name,
  label,
  placeholder = '',
  rows = 4,
  required = false,
  disabled = false,
  maxLength,
  validation = {},
  ...rest
}) => {
  const {
    register,
    watch,
    formState: { errors },
  } = useFormContext();
  
  const error = errors[name];
  const hasError = !!error;
  const currentValue = watch(name) || '';
  
  return (
    <div className={`br-textarea ${hasError ? 'danger' : ''}`}>
      {label && (
        <label htmlFor={name}>
          {label}
          {required && <span className="text-danger ml-1">*</span>}
        </label>
      )}
      <textarea
        id={name}
        rows={rows}
        placeholder={placeholder}
        disabled={disabled}
        maxLength={maxLength}
        aria-invalid={hasError}
        aria-describedby={hasError ? `${name}-error` : undefined}
        {...register(name, {
          required: required ? `${label || 'Este campo'} é obrigatório` : false,
          maxLength: maxLength
            ? {
                value: maxLength,
                message: `Máximo de ${maxLength} caracteres`,
              }
            : undefined,
          ...validation,
        })}
        {...rest}
      />
      {maxLength && (
        <div className="text-base mb-1 text-right">
          <small>
            {currentValue.length} / {maxLength}
          </small>
        </div>
      )}
      {hasError && (
        <span id={`${name}-error`} className="feedback danger" role="alert">
          <i className="fas fa-times-circle" aria-hidden="true"></i>
          {error.message}
        </span>
      )}
    </div>
  );
};

export default FormTextarea;
