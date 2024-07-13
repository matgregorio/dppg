function checknoticia() 
{
	with(document.form_cad_noticia)
	{
		 if (titulo_noticia.value == "") 
		 {
			alert("Por favor digite o Titulo da Notícia !");
			titulo_noticia.focus();
			return false; 
		 }		
	}	
}
