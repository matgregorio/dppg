import React, { useEffect, useRef } from 'react';

/**
 * Componente Select simples seguindo padrão GOV.BR Design System
 * Para uso em filtros e controles sem React Hook Form
 * 
 * @param {string} id - ID do select
 * @param {string} label - Label do select
 * @param {string} value - Valor atual
 * @param {function} onChange - Callback de mudança
 * @param {array} options - Array de opções [{ value, label }]
 * @param {string} placeholder - Placeholder
 * @param {boolean} disabled - Se está desabilitado
 */
const SelectGovBR = ({
  id,
  label,
  value,
  onChange,
  options = [],
  placeholder = 'Selecione...',
  disabled = false,
  className = '',
}) => {
  const selectRef = useRef(null);
  const brSelectInstance = useRef(null);

  // Inicializa o BRSelect
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

        // Listener para onChange
        selectRef.current.addEventListener('onChange', () => {
          if (brSelectInstance.current && onChange) {
            const selectedValue = brSelectInstance.current.selectedValue || '';
            onChange({ target: { value: selectedValue } });
          }
        });
      } catch (error) {
        console.warn('Erro ao inicializar SelectGovBR:', error);
      }
    }

    return () => {
      if (brSelectInstance.current) {
        brSelectInstance.current = null;
      }
    };
  }, [onChange]);

  // Atualiza quando as opções mudam
  useEffect(() => {
    if (brSelectInstance.current && selectRef.current) {
      try {
        brSelectInstance.current.resetOptionsList();
      } catch (error) {
        console.warn('Erro ao resetar options:', error);
      }
    }
  }, [options]);
  
  return (
    <div 
      ref={selectRef}
      className={`br-select ${className}`}
    >
      <div className="br-input">
        {label && (
          <label htmlFor={`${id}-input`}>
            {label}
          </label>
        )}
        <input
          id={`${id}-input`}
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
      
      <div className="br-list" tabIndex="0">
        {options.map((option, index) => (
          <div 
            key={option.value || index} 
            className={`br-item ${value === option.value ? 'selected' : ''}`}
            tabIndex="-1"
          >
            <div className="br-radio">
              <input
                id={`${id}-${option.value || index}`}
                type="radio"
                name={`${id}-radio`}
                value={option.value}
                defaultChecked={value === option.value}
              />
              <label htmlFor={`${id}-${option.value || index}`}>
                {option.label}
              </label>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default SelectGovBR;
