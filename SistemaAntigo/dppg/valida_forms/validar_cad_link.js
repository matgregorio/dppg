function checklinks() 
{
	with(document.form_cad_links)
	{
		 if (tipo_link.value == "0") 
		 {
			alert("Por favor selecione o tipo do Link !");
			tipo_link.focus();
			return false; 
		 }	
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
