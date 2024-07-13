<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");

			$sql= "select * from noticias order by codigo_noticia desc";
			
			$resultado = mysql_query($sql);
			
			
			echo '<br><br><b>&nbsp&nbspAlterar Notícias</b><br>
			<hr>';
			
				
				while ($campos = mysql_fetch_array($resultado)) 
				{
			
					echo '<br><a href="index.php?arquivo=form_alterar_noticia.php&codigo_noticia='.$campos[codigo_noticia].'">'.date("d/m", strtotime($campos[data_noticia])).' >> '.$campos[titulo_noticia].'  <img src=images/editar.png width=16 height=16 border=0 alt=editar> <br> ';
		
				}
			echo'<br><hr>';
		}	
		echo '<center><a href="index.php?arquivo=adm_geral.php"><input type="button" value="Voltar"></a></center>';
		mysql_close($conexao);
	}
?>

	
