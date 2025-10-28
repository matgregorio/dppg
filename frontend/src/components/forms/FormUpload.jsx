import React, { useState } from 'react';
import { useFormContext } from 'react-hook-form';

/**
 * Componente de upload reutilizável com integração React Hook Form e GOVBR-DS
 * 
 * @param {string} name - Nome do campo (obrigatório para RHF)
 * @param {string} label - Label do campo
 * @param {string} accept - Tipos de arquivo aceitos (ex: .pdf,.doc,.docx)
 * @param {number} maxSizeMB - Tamanho máximo em MB
 * @param {boolean} required - Se o campo é obrigatório
 * @param {boolean} disabled - Se o campo está desabilitado
 * @param {string} helpText - Texto de ajuda
 */
const FormUpload = ({
  name,
  label,
  accept = '*',
  maxSizeMB = 20,
  required = false,
  disabled = false,
  helpText = '',
  ...rest
}) => {
  const {
    register,
    setValue,
    formState: { errors },
  } = useFormContext();
  
  const [fileName, setFileName] = useState('');
  const [fileError, setFileError] = useState('');
  
  const error = errors[name];
  const hasError = !!error || !!fileError;
  const errorMessage = error?.message || fileError;
  
  const handleFileChange = (e) => {
    const file = e.target.files[0];
    
    if (!file) {
      setFileName('');
      setFileError('');
      return;
    }
    
    // Valida tamanho
    const fileSizeMB = file.size / 1024 / 1024;
    if (fileSizeMB > maxSizeMB) {
      setFileError(`Arquivo muito grande. Tamanho máximo: ${maxSizeMB}MB`);
      e.target.value = '';
      setFileName('');
      return;
    }
    
    setFileError('');
    setFileName(file.name);
    setValue(name, e.target.files);
  };
  
  return (
    <div className={`br-upload ${hasError ? 'danger' : ''}`}>
      {label && (
        <label htmlFor={name}>
          {label}
          {required && <span className="text-danger ml-1">*</span>}
        </label>
      )}
      
      <div className="upload-button">
        <label htmlFor={name} className="br-button secondary" aria-disabled={disabled}>
          <i className="fas fa-upload mr-2" aria-hidden="true"></i>
          <span>{fileName || 'Selecionar arquivo'}</span>
        </label>
        <input
          id={name}
          type="file"
          accept={accept}
          disabled={disabled}
          aria-invalid={hasError}
          aria-describedby={hasError ? `${name}-error` : `${name}-help`}
          {...register(name, {
            required: required ? `${label || 'Arquivo'} é obrigatório` : false,
          })}
          onChange={handleFileChange}
          {...rest}
        />
      </div>
      
      {fileName && (
        <div className="upload-list mt-2">
          <div className="br-item">
            <div className="content">
              <i className="fas fa-file mr-2" aria-hidden="true"></i>
              <span className="name">{fileName}</span>
            </div>
          </div>
        </div>
      )}
      
      {helpText && !hasError && (
        <div id={`${name}-help`} className="text-base mt-1">
          <small>{helpText}</small>
        </div>
      )}
      
      {hasError && (
        <span id={`${name}-error`} className="feedback danger" role="alert">
          <i className="fas fa-times-circle" aria-hidden="true"></i>
          {errorMessage}
        </span>
      )}
    </div>
  );
};

export default FormUpload;
