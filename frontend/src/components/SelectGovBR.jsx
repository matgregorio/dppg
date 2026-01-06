import React, { useEffect, useRef } from 'react';

/**
 * Select simples seguindo GOV.BR DS (core BRSelect)
 */
const SelectGovBR = ({
  id,
  label,
  value,
  onChange,
  options = [],
  placeholder = 'Selecione o item',
  disabled = false,
  className = '',
}) => {
  const selectRef = useRef(null);
  const brSelectInstance = useRef(null);

  // Instancia o BRSelect (conforme docs: new core.BRSelect('br-select', element))
  useEffect(() => {
    const el = selectRef.current;
    if (!el) return;

    if (!window.core?.BRSelect) {
      console.warn(
        '[SelectGovBR] window.core.BRSelect não encontrado. Verifique se @govbr-ds/core (core.min.js) foi carregado.'
      );
      return;
    }

    // Evita dupla inicialização (React StrictMode em dev)
    if (!brSelectInstance.current) {
      brSelectInstance.current = new window.core.BRSelect('br-select', el);
    }

    // Captura mudança pelo change dos radios
    const handleChange = () => {
      const checked = el.querySelector('input[type="radio"]:checked');
      const newValue = checked?.value ?? '';
      onChange?.({ target: { value: newValue } });
    };

    el.addEventListener('change', handleChange);
    return () => el.removeEventListener('change', handleChange);
  }, [onChange]);

  // Mantém o "checked" sincronizado quando value muda por fora
  useEffect(() => {
    const el = selectRef.current;
    if (!el) return;

    el.querySelectorAll('input[type="radio"]').forEach((r) => {
      r.checked = r.value === value;
    });
  }, [value, options]);

  return (
    <div ref={selectRef} className={`br-select ${className}`}>
      <div className="br-input">
        {label && <label htmlFor={id}>{label}</label>}

        {/* no DS é um input texto normal (não readOnly), o core controla */}
        <input id={id} type="text" placeholder={placeholder} disabled={disabled} />

        <button
          className="br-button"
          type="button"
          aria-label="Exibir lista"
          tabIndex={-1}
          data-trigger="data-trigger"
          disabled={disabled}
        >
          <i className="fas fa-angle-down" aria-hidden="true"></i>
        </button>
      </div>

      <div className="br-list" tabIndex={0}>
        {options.map((opt, idx) => (
          <div key={opt.value ?? idx} className="br-item" tabIndex={-1}>
            <div className="br-radio">
              <input
                id={`${id}-opt-${idx}`}
                type="radio"
                name={`${id}-radio`}
                value={opt.value}
                defaultChecked={opt.value === value}
              />
              <label htmlFor={`${id}-opt-${idx}`}>{opt.label}</label>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default SelectGovBR;
