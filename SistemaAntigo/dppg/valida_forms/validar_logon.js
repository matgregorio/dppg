function checklogin() 
{
	with(document.form_login)
	{
		 if (cpf.value == "") 
		 {
			alert("Por favor informe o cpf !");
			cpf.focus();
			return false; 
		 }
		 if (senha.value == "") 
		 {
			alert("Por favor informe a senha !");
			senha.focus();
			return false; 
		 }
		 if (valor.value == "") 
		 {
			alert("Por favor informe os caracteres da imagem !");
			valor.focus();
			return false; 
		 }
			
	}	
}
