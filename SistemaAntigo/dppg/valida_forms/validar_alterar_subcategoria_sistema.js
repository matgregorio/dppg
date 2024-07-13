function checksistema() 
{
	with(document.form_editsistema_subcategoria)
	{
		 if (nome_subcategoria.value == "") 
		 {
			alert("Por favor informe o nome do sistema !");
			nome_sistema.focus();
			return false; 
		 }
		 if (link_subcategoria.value == "") 
		 {
			alert("Por favor informe o link para o menu principal do sistema !");
			link_sistema.focus();
			return false; 
		 }
		 /*
  	    if (descricao_sistema.value == "") 
		 {
			alert("Por favor informe a descriçao do sistema !");
			descricao_sistema.focus();
			return false; 
		 }
		 */
					
	}	
}