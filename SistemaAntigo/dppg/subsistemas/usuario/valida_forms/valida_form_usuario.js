function checkusuario() 
{
	with(document.form_cad_usuario)
	{
		 if (cpf.value == "") {
			alert("Por favor informe o CPF do usuario !");
			cpf.focus();
			return false; 
		  }
		
		 if ((cpf.value != "") && (cpf.value != "00000000000") && (cpf.value != "11111111111") 
			&& (cpf.value != "22222222222") && (cpf.value != "33333333333") && (cpf.value != "44444444444") 
			&& (cpf.value != "55555555555") && (cpf.value != "66666666666") && (cpf.value != "77777777777") 
			&& (cpf.value != "88888888888") && (cpf.value != "99999999999")) {
			var CPF = cpf.value; // Recebe o valor digitado no campo
			// Aqui começa a checagem do CPF
			//var POSICAO, I, SOMA, DV, DV_INFORMADO;
			var DIGITO = new Array(10);
			DV_INFORMADO = CPF.substr(9, 2); // Retira os dois últimos dígitos do número informado
			// Desemembra o número do CPF na array DIGITO
			for (I=0; I<=8; I++) {
  				DIGITO[I] = CPF.substr( I, 1);
			}

			// Calcula o valor do 10º dígito da verificação
			POSICAO = 10;
			SOMA = 0;
   		for (I=0; I<=8; I++) {
      		SOMA = SOMA + DIGITO[I] * POSICAO;
      		POSICAO = POSICAO - 1;
   		}
			DIGITO[9] = SOMA % 11;
   		if (DIGITO[9] < 2) {
        		DIGITO[9] = 0;
			}
   		else{
       		DIGITO[9] = 11 - DIGITO[9];
			}

			// Calcula o valor do 11º dígito da verificação
			POSICAO = 11;
			SOMA = 0;
   		for (I=0; I<=9; I++) {
      		SOMA = SOMA + DIGITO[I] * POSICAO;
      		POSICAO = POSICAO - 1;
   		}
			DIGITO[10] = SOMA % 11;
   		if (DIGITO[10] < 2) {
        		DIGITO[10] = 0;
   		}
   		else {
        		DIGITO[10] = 11 - DIGITO[10];
		   }

			// Verifica se os valores dos dígitos verificadores conferem
			DV = DIGITO[9] * 10 + DIGITO[10];

		   if (DV != DV_INFORMADO) {
      		alert('CPF inválido');
      		cpf.value = '';
      		cpf.focus();
      		return false;
   		} 
		 }
		 else {
			alert('CPF inválido. Por favor informe novamente !');
      	cpf.value = '';
      	cpf.focus();
      	return false;
		 }
		 if (nome.value == "") 
		 {
			alert("Por favor informe o nome do usuario !");
			nome.focus();
			return false; 
		 }	
		 if (telefone.value == "") 
		 {
			alert("Por favor informe o telefone do usuario !");
			telefone.focus();
			return false; 
		 }	
		 if (email.value == "") 
		 {
			alert("Por favor informe o email do usuario !");
			email.focus();
			return false; 
		 }
		 if(email.value == "" || email.value.indexOf('@', 0) == -1 || email.value.indexOf('.', 0) == -1){
			email.focus();
			email.value = "";		
			alert("Email inválido. Por favor informe novamente !");
			return false;
		 }
		 if(senha.value != confimar_senha.value){
			senha.focus();
			senha.value = "";
			confirmar_senha.value = "";
			alert("Senhas não conferem ! Por favor informe novamente !");
			return false;	
		 }
		 
	}	
}


