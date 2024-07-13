<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$codigo_noticia = mysql_real_escape_string($_GET[codigo_noticia]);		
			
			$sql = "select * from noticias where codigo_noticia='$codigo_noticia'";
			$resultado = mysql_query($sql);
			$campos = mysql_fetch_array($resultado);
			
			$pasta = $campos[arquivo_noticia];
			if ($pasta != null)
		   	$comando = 'rm -rf galeria/noticias/'.$pasta;			
			
			$sql = "delete from noticias where codigo_noticia='$codigo_noticia'"; 
			$resultado = mysql_query($sql);
			
			echo '<div id="centralizar">';
				if ($resultado==1){
					system($comando);
				   echo '<br><br><center><font color=#006400><b>Excluido com sucesso!</b></font></center><br>';
				}   
				else
				   echo '<br><br><center><font color="#B22222"><b>Erro na exclusão!</b></font></center><br>';
			echo '</div>';   
		}
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2; URL=index.php?arquivo=listar_excluir_noticia.php" />';
	}
?>
