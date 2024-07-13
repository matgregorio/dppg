<?php

	include("includes/config2.php");

	$sql= "select * from noticias order by codigo_noticia desc";
	
	$resultado = mysql_query($sql);
	
	//listar noticias
	echo '<br><br><b>&nbsp&nbspNotícias</b><br>
	<hr>';	
	
		
		while ($campos = mysql_fetch_array($resultado)) 
		{
	
			echo '<br><a href="index.php?arquivo=detal_noticia.php&codigo_noticia='.$campos[codigo_noticia].'">'.date("d/m", strtotime($campos[data_noticia])).' >> '.$campos[titulo_noticia].' <br> ';

		}
		echo '
		<br><hr>
		
			<center><a href="index.php"><input type="button" value="Voltar"></a></center>';


		  
	mysql_close($conexao);
	
?>

	
