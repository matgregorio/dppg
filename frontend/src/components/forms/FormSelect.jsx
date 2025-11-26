import React, { useEffect, useRef } from 'react';
import { useFormContext } from 'react-hook-form';

/**
 * Componente de select reutilizável com integração React Hook Form e GOVBR-DS
 * Implementa o padrão completo do Design System GOV.BR
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
    setValue,
    watch,
  } = useFormContext();
  
  const selectRef = useRef(null);
  const brSelectInstance = useRef(null);
  const error = errors[name];
  const hasError = !!error;
  const currentValue = watch(name);

  // Inicializa o BRSelect quando o componente monta
  useEffect(() => {
    if (selectRef.current && window.core && window.core.BRSelect) {
      try {
        const notFoundElement = `
          <div class="br-item not-found">
            <div class="container">
              <div class="row">
                <div class="col">
                  <p><strong>Ops!</strong> Não encontramos o que você está procurando!</p>
                </div>
              </div>
            </div>
          </div>
        `;
        
        brSelectInstance.current = new window.core.BRSelect(
          'br-select',
          selectRef.current,
          notFoundElement
        );

        // Listener para onChange do select
        selectRef.current.addEventListener('onChange', (e) => {
          const selectedValue = brSelectInstance.current?.selectedValue || '';
          setValue(name, selectedValue, { shouldValidate: true });
        });
      } catch (error) {
        console.warn('Erro ao inicializar BRSelect:', error);
      }
    }

    return () => {
      // Cleanup se necessário
      if (brSelectInstance.current) {
        brSelectInstance.current = null;
      }
    };
  }, [name, setValue]);

  // Atualiza a visualização quando as opções mudam
  useEffect(() => {
    if (brSelectInstance.current && selectRef.current) {
      try {
        // Destrói e recria a instância para garantir atualização
        if (window.core && window.core.BRSelect) {
          const notFoundElement = `
            <div class="br-item not-found">
              <div class="container">
                <div class="row">
                  <div class="col">
                    <p><strong>Ops!</strong> Não encontramos o que você está procurando!</p>
                  </div>
                </div>
              </div>
            </div>
          `;
          
          brSelectInstance.current = new window.core.BRSelect(
            'br-select',
            selectRef.current,
            notFoundElement
          );

          selectRef.current.addEventListener('onChange', (e) => {
            const selectedValue = brSelectInstance.current?.selectedValue || '';
            setValue(name, selectedValue, { shouldValidate: true });
          });
        }
      } catch (error) {
        console.warn('Erro ao atualizar options:', error);
      }
    }
  }, [options, name, setValue]);
  
  return (
    <div 
      ref={selectRef}
      className={`br-select ${hasError ? 'danger' : ''}`}
    >
      <div className="br-input">
        {label && (
          <label htmlFor={`${name}-input`}>
            {label}
            {required && <span className="text-danger ml-1"> *</span>}
          </label>
        )}
        <input
          id={`${name}-input`}
          type="text"
          placeholder={placeholder}
          disabled={disabled}
          readOnly
        />
        <button
          className="br-button"
          type="button"
          aria-label="Exibir lista"
          tabIndex="-1"
          data-trigger="data-trigger"
          disabled={disabled}
        >
          <i className="fas fa-angle-down" aria-hidden="true"></i>
        </button>
      </div>
      
      {/* Hidden input for React Hook Form */}
      <input
        type="hidden"
        {...register(name, {
          required: required ? `${label || 'Este campo'} é obrigatório` : false,
          ...validation,
        })}
      />
      
      <div className="br-list" tabIndex="0">
        {options.map((option, index) => (
          <div 
            key={option.value || index} 
            className={`br-item ${currentValue === option.value ? 'selected' : ''}`}
            tabIndex="-1"
          >
            <div className="br-radio">
              <input
                id={`${name}-${option.value || index}`}
                type="radio"
                name={`${name}-radio`}
                value={option.value}
                defaultChecked={currentValue === option.value}
              />
              <label htmlFor={`${name}-${option.value || index}`}>
                {option.label}
              </label>
            </div>
          </div>
        ))}
      </div>
      
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
