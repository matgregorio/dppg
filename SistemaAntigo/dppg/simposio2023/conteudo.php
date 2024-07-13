<?php
	echo '<div id="conteudo" class="barra_rolagem">';
	
		if(is_file("$_REQUEST[arquivo]")) //is_file função para verificar se o arquivo existe
			include("$_REQUEST[arquivo]"); //inclui o arquivo existente
		else 
			include("principal.php"); //chama a página principal
	
	echo '</div>';
?>