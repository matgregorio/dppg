function checkformulario() 
{
	with(document.form_cad_formulario)
	{
		 if (titulo_formulario.value == "") 
		 {
			alert("Por favor digite o Titulo do Formulário !");
			titulo_formulario.focus();
			return false; 
		 }			 
		 if (categoria.value == "0") 
		 {
			alert("Por favor selecione uma categoria !");
			categoria.focus();
			return false; 
		 }	
		 if (subcategoria.value == "0") 
		 {
			alert("Por favor selecione uma subcategoria !");
			subcategoria.focus();
			return false; 
		 }
	}	
}
