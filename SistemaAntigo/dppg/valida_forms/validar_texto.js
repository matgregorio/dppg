function checktexto() 
{
	with(document.form_alterar_texto_site)
	{
		 if (titulo_home.value == "") 
		 {
			alert("Por favor informe o Titulo da página principal !");
			titulo_home.focus();
			return false; 
		 }
		 /*
		 if (texto_home.value == "") 
		 {
			alert("Por favor informe o texto da página principal !");
			texto_home.focus();
			return false; 
		 }
		 */
			
	}	
}