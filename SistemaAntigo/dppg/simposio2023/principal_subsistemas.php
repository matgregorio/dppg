<?php

	include("includes/config2.php");
	
	$codigo = $_SESSION['codigo_menu'];
	$index = $_SESSION['link_index'];
	
	$sql = "select * from menu_sistemas where codigo_menu='$codigo'";
	$resultado = mysql_query($sql);
	$campos= mysql_fetch_array($resultado);
	
	if($index!="") 
	{
		include($index);
	}
	else{
			echo '<br><center><b>Sistema '.$campos[nome_menu].'</b></center>
						
						<p class="conteudo"> '.$campos[descricao_sistema].' </p> <br>
				';
		 }
	
				

	mysql_close($conexao);
?>