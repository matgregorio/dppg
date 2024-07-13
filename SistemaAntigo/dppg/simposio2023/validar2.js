function checkregistro() {
	with(document.form_registro) {
       if (nome.value == "") {
			alert("Por favor digite seu nome!");
			nome.focus();
			return false; 
		}
		
		var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	    if (email.value == "") {
	       alert("Por favor digite seu email!");
	       email.focus();
	       return false;
	    }
	    else {
          if (filter.test(email.value) == false) {
		       alert("Email inválido!");
		       email.value = "";
		       email.focus();
		       return false;
		    } 
	    }
	    
	    if (usuario.value == "") {
			alert("Por favor digite seu nome de usuário!");
			usuario.focus();
			return false; 
		}
	    
		 if (senha.value == "") {
			alert("Por favor digite uma senha!");
			senha.focus();
			return false; 
		}

	   if (verificasenha.value == "") {
			alert("Por favor confirme a senha!");
			verificasenha.focus();
			return false; 
		}

      if (verificasenha.value != senha.value) {
         alert("Senhas diferentes! Digite novamente!");
			senha.value = "";
			verificasenha.value = "";
         senha.focus();
         return false;
      }
      
       if (instituicao.value == "") {
			alert("Por favor selecione a Instituição da qual faz parte!");
			instituicao.focus();
			return false; 
		}
      
		if (cargo.value == "") {
			alert("Por favor selecione o cargo que ocupa!");
			cargo.focus();
			return false; 
		}    
		
		if (titulacao.value == "") {
			alert("Por favor selecione a titulação!");
			titulacao.focus();
			return false; 
		} 
	
		if ((atuacao.value == "") || (atuacao.value == "0")){
			alert("Por favor selecione a área de atuação!");
			atuacao.focus();
			return false; 
		} 
		
		if ((atuacao.value == "11") && (peq_areas_atuacao.value == "0")){
			atuacao.focus();
			return true; 
		} 	
		else if((peq_areas_atuacao.value == "") || (peq_areas_atuacao.value == "0")){
				alert("Por favor selecione a pequena área de atuação!");
				peq_areas_atuacao.focus();
				return false; 
			} 
		
		if (subareatuacao.value == "") {
			alert("Por favor informe a subárea de atuação!");
			subareatuacao.focus();
			return false; 
		} 
		
      submit();
	}
}
		