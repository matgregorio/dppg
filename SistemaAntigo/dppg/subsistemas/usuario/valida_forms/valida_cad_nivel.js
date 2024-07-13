function checknivel() 
{
	with(document.form_cad_nivel)
	{
		 if (nome_nivel.value == 0) 
		 {
			alert("Por favor informe o nome do nivel de usuário !");
			nome_nivel.focus();
			return false; 
		 }	
		 
	}	
}


