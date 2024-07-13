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
			$nome_arquivo = mysql_real_escape_string($_GET[nome_arquivo]);
			
			$sql = "select * from noticias where codigo_noticia='$codigo_noticia'";
			$resultado = mysql_query($sql);
			$campos = mysql_fetch_array($resultado);
			
			$caminho = 'galeria/noticias/'.$campos[arquivo_noticia].'/'.$nome_arquivo.'';
			unlink("$caminho");
	
			echo '<div id="centralizar">
		   			<br><br><center><font color=#006400><b>Arquivo excluido com sucesso!</b></font></center><br>
					</div>';	
		}
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2; URL=index.php?arquivo=form_alterar_noticia.php&codigo_noticia='.$campos[codigo_noticia].'" />';
	}
?>
