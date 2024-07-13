function checkaltusuario() 
{
	with(document.form_alterar_usuario)
	{
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
		 if (senha.value == "") 
		 {
			alert("Por favor informe a nova senha do usuario !");
			senha.focus();
			return false; 
		 }
		 if (confirmar_senha.value == "") 
		 {
			alert("Por favor confirme a nova senha do usuario !");
			confirmar_senha.focus();
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


