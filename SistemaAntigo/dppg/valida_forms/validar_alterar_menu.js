function checkmenu() 
{
	with(document.form_alterar_menu)
	{
		 if (nome_categoria.value == "") 
		 {
			alert("Por favor informe o Titulo do menu horizontal !");
			nome_categoria.focus();
			return false; 
		 }
					
	}	
}