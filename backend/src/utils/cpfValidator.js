/**
 * Valida CPF brasileiro
 * @param {string} cpf - CPF a ser validado
 * @returns {boolean}
 */
const validarCPF = (cpf) => {
  if (!cpf) return false;
  
  // Remove caracteres não numéricos
  cpf = cpf.replace(/[^\d]/g, '');
  
  if (cpf.length !== 11) return false;
  
  // Verifica se todos os dígitos são iguais
  if (/^(\d)\1{10}$/.test(cpf)) return false;
  
  // Valida primeiro dígito verificador
  let soma = 0;
  for (let i = 0; i < 9; i++) {
    soma += parseInt(cpf.charAt(i)) * (10 - i);
  }
  let resto = 11 - (soma % 11);
  let digitoVerificador1 = resto >= 10 ? 0 : resto;
  
  if (digitoVerificador1 !== parseInt(cpf.charAt(9))) return false;
  
  // Valida segundo dígito verificador
  soma = 0;
  for (let i = 0; i < 10; i++) {
    soma += parseInt(cpf.charAt(i)) * (11 - i);
  }
  resto = 11 - (soma % 11);
  let digitoVerificador2 = resto >= 10 ? 0 : resto;
  
  return digitoVerificador2 === parseInt(cpf.charAt(10));
};

/**
 * Formata CPF para padrão XXX.XXX.XXX-XX
 */
const formatarCPF = (cpf) => {
  if (!cpf) return '';
  cpf = cpf.replace(/[^\d]/g, '');
  return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
};

/**
 * Gera um CPF válido aleatório (para testes)
 */
const gerarCPF = () => {
  const randomDigits = (n) => {
    let result = '';
    for (let i = 0; i < n; i++) {
      result += Math.floor(Math.random() * 10);
    }
    return result;
  };
  
  let cpf = randomDigits(9);
  
  // Calcula primeiro dígito
  let soma = 0;
  for (let i = 0; i < 9; i++) {
    soma += parseInt(cpf.charAt(i)) * (10 - i);
  }
  let resto = 11 - (soma % 11);
  cpf += resto >= 10 ? 0 : resto;
  
  // Calcula segundo dígito
  soma = 0;
  for (let i = 0; i < 10; i++) {
    soma += parseInt(cpf.charAt(i)) * (11 - i);
  }
  resto = 11 - (soma % 11);
  cpf += resto >= 10 ? 0 : resto;
  
  return cpf;
};

module.exports = {
  validarCPF,
  formatarCPF,
  gerarCPF,
};
