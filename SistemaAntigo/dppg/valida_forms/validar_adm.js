function checkcontatos() 
{
	with(document.form_config_site) 
	{
		 
		 if (nome_site.value == "") 
		 {
			alert("Por favor digite o Nome do Site!");
			nome_site.focus();
			return false; 
		 }
		 if (titulo_rodape.value == "") 
		 {
			alert("Por favor digite o Titulo do Rodapé !");
			titulo_rodape.focus();
			return false; 
		 }
		 if (instituicao_rodape.value == "") 
		 {
			alert("Por favor digite o nome da Instituição !");
			instituicao_rodape.focus();
			return false; 
		 }
		 if (endereco_rodape.value == "") 
		 {
			alert("Por favor digite o Endereço do Rodapé !");
			endereco_rodape.focus();
			return false; 
		 }
		 if (telefone_rodape.value == "") 
		 {
			alert("Por favor digite o Telefone do Rodapé !");
			telefone_rodape.focus();
			return false; 
		 }
		 

		 var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	    
	    if (email_rodape.value == "") 
	    {
	       alert("Por favor digite o email rodapé !");
	       email_rodape.focus();
	       return false;
	    }
	    else {
  		        if (filter.test(email_rodape.value) == false) 
  		        {
		       		alert("Email inválido!");
		       		email_rodape.value = "";
		       		email_rodape.focus();
		       		return false;
		    		} 
	    		}
		if (desenvolvido.value == "") 
		 {
			alert("Por favor, informe os desenvolvedores do Site !");
			desenvolvido.focus();
			return false; 
		 }
		
	}	
}