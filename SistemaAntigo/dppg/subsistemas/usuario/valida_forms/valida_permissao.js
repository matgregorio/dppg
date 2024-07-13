function checkpermissao() 
{
	with(document.form_permissao)
	{
		 if (combo_nome.value == 0) 
		 {
			alert("Por favor informe um usuario !");
			combo_nome.focus();
			return false; 
		 }	
		 if (combo_nivel.value == 0) 
		 {
			alert("Por favor informe um nivel para o usuario !");
			combo_nivel.focus();
			return false; 
		 }	

	}	
}


