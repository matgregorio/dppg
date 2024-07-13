function checksistema() 
{
	with(document.form_editar_sistema)
	{
		 if (nome_menu.value == "") 
		 {
			alert("Por favor informe o nome do sistema !");
			nome_menu.focus();
			return false; 
		 }
		 if (link_menu.value == "") 
		 {
			alert("Por favor informe o link para o menu principal do sistema !");
			link_menu.focus();
			return false; 
		 }
		 if (cpf_usuario.value == "") {
			alert("Por favor informe o CPF do usuario !");
			cpf_usuario.focus();
			return false; 
		  }
		
		 if ((cpf_usuario.value != "") && (cpf_usuario.value != "00000000000") && (cpf_usuario.value != "11111111111") 
			&& (cpf_usuario.value != "22222222222") && (cpf_usuario.value != "33333333333") && (cpf_usuario.value != "44444444444") 
			&& (cpf_usuario.value != "55555555555") && (cpf_usuario.value != "66666666666") && (cpf_usuario.value != "77777777777") 
			&& (cpf_usuario.value != "88888888888") && (cpf_usuario.value != "99999999999")) {
			var CPF = cpf_usuario.value; // Recebe o valor digitado no campo
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
      			cpf_usuario.value = '';
      			cpf_usuario.focus();
      			return false;
   		   } 
		 }
		 else {
			alert('CPF inválido. Por favor informe novamente !');
		      	cpf_usuario.value = '';
		      	cpf_usuario.focus();
		      	return false;
		 }
		 if (nome.value == "") 
		 {
			alert("Por favor informe o nome do usuario !");
			nome.focus();
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
