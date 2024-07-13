<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			$sql = "select * from noticias order by codigo_noticia desc"; 
			$resultado = mysql_query($sql);
			
				echo '<br><br><b>&nbsp&nbsp Excluir Notícias</b><br>
				<hr>';
			
		
			while ($campos = mysql_fetch_array($resultado)) {
				echo "<a href=\"index.php?arquivo=excluir_noticia.php&codigo_noticia=$campos[codigo_noticia]\"  onClick=\"return confirm('Confirma exclusão de $campos[titulo_noticia]?')\"> >> $campos[titulo_noticia] <img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a><br><br>";
							
		
			}
			
			echo '</center><hr>';	
		}	
		echo '<center><a href="index.php?arquivo=adm_geral.php"><input type="button" value="Voltar"></a></center>';	
		mysql_close($conexao);
	}
?>
