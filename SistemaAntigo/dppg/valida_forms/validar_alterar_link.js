function checklinks() 
{
	with(document.form_alterar_links)
	{
		 if (nome_link.value == "") 
		 {
			alert("Por favor digite o Nome do Link !");
			nome_link.focus();
			return false; 
		 }
		 if (endereco_link.value == "") 
		 {
			alert("Por favor digite o endereço do Link !");
			endereco_link.focus();
			return false; 
		 }		
	}	
}