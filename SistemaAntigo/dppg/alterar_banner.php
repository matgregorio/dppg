<?php
	session_start();
	include_once ('trataInjection.php');

	if (protectorString($_POST[codigo_banner]) === true || protectorString($_POST[nome_banner]) === true || protectorString($_POST[link_banner]) === true)
		return;

	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');

		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));


		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$codigo_banner = mysql_real_escape_string($_POST[codigo_banner]);
			$nome_banner = mysql_real_escape_string($_POST[nome_banner]);
			$link_banner = mysql_real_escape_string($_POST[link_banner]);
			
			
			if($_FILES[arquivo_banner][name]== "") {
				$sql = "update banner set nome_banner='$nome_banner', link_banner='$link_banner' where codigo_banner='$codigo_banner'";
			}
			else {	
						$randomico = mt_rand();
						$arquivo = $randomico.'_'.$_FILES[arquivo_banner][name];
						
						$sql2 = "select * from banner";
						$resultado2 = mysql_query($sql2);
						$campos2 = mysql_fetch_array($resultado2);
						$caminho = 'images/banner/'.$campos2[nome_banner];					
										
						unlink("$caminho");
						$sql = "update banner set nome_banner='$nome_banner', link_banner='$link_banner', arquivo_banner='$arquivo' where codigo_banner='$codigo_banner'";
				  }
				  
			$resultado = mysql_query($sql);
	
			echo'<div id="centralizar">';
			
				if ($resultado == 1) 
				{
					$caminho = 'images/banner/';
		
					if(move_uploaded_file($_FILES[arquivo_banner][tmp_name], $caminho.$randomico.'_'.$_FILES[arquivo_banner][name]))
							echo '<br><br><center><font color=#006400><b>'.$_FILES[arquivo][name].' Arquivo alterado com sucesso!</b></font><center><br>';
				 	
					echo '<br><br><center><font color=#006400><b>Alteração realizada com sucesso!</b></font><center><br>';
				}
				else 
					 echo '<br><br><center><font color="#B22222"><b>Erro ao alterar!</b></font></center><br>';
			
			echo'</div>';
		}		
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2;index.php?arquivo=adm_geral.php" />';
	}
?>
