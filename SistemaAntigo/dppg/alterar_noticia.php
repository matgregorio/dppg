<?php
	session_start();
	include_once ('trataInjection.php');

	if (protectorString($_POST[codigo_noticia]) === true || protectorString($_POST[titulo_noticia]) === true || protectorString($_POST[conteudo_noticia]) === true)
		return;

	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$codigo_noticia = mysql_real_escape_string($_POST[codigo_noticia]);
			$titulo_noticia = mysql_real_escape_string($_POST[titulo_noticia]);
			$conteudo_noticia = mysql_real_escape_string($_POST[conteudo_noticia]);
			$codigo_usuario = mysql_real_escape_string($_SESSION['cpf']);
			
			$busca_noticia = mysql_query("select * from noticias where codigo_noticia=$codigo_noticia");
			$noticia = mysql_fetch_array($busca_noticia);		
		
			$caminho = 'galeria/noticias/'.$noticia[arquivo_noticia].'/';
			
			$sql = "update noticias set titulo_noticia = '$titulo_noticia',conteudo_noticia = '$conteudo_noticia', conteudo_noticia = '$conteudo_noticia',codigo_usuario = '$codigo_usuario' where codigo_noticia='$codigo_noticia'";
			$resultado = mysql_query($sql);				
		
			echo '<div id="centralizar">';
			
			if ($resultado == 1) {
					
					echo '<br><center><font color=#006400><b>Notícia alterada com sucesso!</center></b></font><br><br>';
					
					for($i=0;$i < sizeof($_FILES[arq_noticia][name]);$i++)
						
							if($_FILES[arq_noticia][name][$i] != null) {
								system($comando);
								
								if(move_uploaded_file($_FILES[arq_noticia][tmp_name][$i], $caminho.$_FILES[arq_noticia][name][$i]))
									echo '<br><center><font color=#006400><b>'.$_FILES[arq_noticia][name][$i].'  - Enviado com sucesso!</center></b></font><br>';
								
							}
							else {
									   echo '<center><b>Nenhum arquivo enviado!</center></b>';
								  }	
			}			
			else 
				echo '<center><font color="#B22222"><b>Erro no cadastro!</center></font></b>';
			
			echo '</div>';	
			mysql_close($conexao);
			echo '<meta http-equiv="refresh" content="3;index.php?arquivo=adm_geral.php" />';
		}
	
	}
?>


