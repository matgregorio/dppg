function checkmenu() 
{
	with(document.form_cadmenu_subcategoria)
	{
		 if (nome_subcategoria.value == "") 
		 {
			alert("Por favor informe o Titulo da sub-categoria do menu horizontal !");
			nome_subcategoria.focus();
			return false; 
		 }
		 /*
		 if (conteudo_subcategoria.value == "") 
		 {
			alert("Por favor informe o conteudo da sub-categoria do menu horizontal !");
			conteudo_subcategoria.focus();
			return false; 
		 }
		 */
					
	}	
	with(document.form_cadmenu_sub_subcategoria)
	{
		 if (nome_subcategoria.value == "") 
		 {
			alert("Por favor informe o Titulo da sub-categoria do menu horizontal !");
			nome_subcategoria.focus();
			return false; 
		 }
		
			
	}	
}