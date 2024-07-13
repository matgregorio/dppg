function checkcontatos() 
{
	with(document.form_contato) 
	{
		 
		 
		 if (nome.value == "") 
		 {
			alert("Por favor informe o Nome!");
			nome.focus();
			return false; 
		 }

		 var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	    
	    if (email.value == "") 
	    {
	       alert("Por favor informe o seu email!");
	       email.focus();
	       return false;
	    }
	    else {
  		        if (filter.test(email.value) == false) 
  		        {
		       		alert("Email inválido!");
		       		email.value = "";
		       		email.focus();
		       		return false;
		    		} 
	    		}
	
		
		if (assunto.value == "") 
		 {
			alert("Por favor informe o Assunto !");
			assunto.focus();
			return false; 
		 }
		 /*
		if (mensagem.value == "") 
		 {
			alert("Por favor informe a Mensagem !");
			mensagem.focus();
			return false; 
		 }
		*/
		
	}	
}