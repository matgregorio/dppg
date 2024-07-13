function checkaltnivel() 
{
	with(document.form_alterar_nivel)
	{
		 if (nome.value == 0) 
		 {
			alert("Por favor informe o nome do nivel de usuário !");
			nome.focus();
			return false; 
		 }	
		 
	}	
}


