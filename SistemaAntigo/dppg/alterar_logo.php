<?php
	session_start();
	include_once ('trataInjection.php');

	if (protectorString($_POST[$codigo_site]) === true)
		return;

	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$codigo_site = mysql_real_escape_string($_POST[codigo_site]);
			
			//echo $_FILES[logo_topo];
			
			$randomico = mt_rand();
			$arquivo = $randomico.'_'.$_FILES[logo_topo][name];
			
			$sql2 = "select * from site where codigo_site='$codigo_site'";
			$resultado2 = mysql_query($sql2);
			$campos2 = mysql_fetch_array($resultado2);
			$caminho = 'images/site/'.$campos2[logo_topo];
			
			unlink("$caminho");
					
			$sql = "update site set logo_topo='$arquivo' where codigo_site='$codigo_site'";
			$resultado = mysql_query($sql);
			
			echo'<div id="centralizar">';
			
				if ($resultado == 1) 
				{
					$caminho = 'images/site/';
					if(move_uploaded_file($_FILES[logo_topo][tmp_name], $caminho.$randomico.'_'.$_FILES[logo_topo][name]))
							echo '<br><br><center><font color=#006400><b>'.$_FILES[arquivo][name].' Enviado com sucesso!</b></font><center><br>';
					echo '<br><br><center><font color=#006400><b> Cadastrado realizado com sucesso! </b></font></center><br>';		
				}
				else{ 
						echo '<br><br><center><font color="#B22222"><b> Erro no cadastro! </b></font></center><br>';
					 }
					 
			echo'</div>';
		}
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2;index.php?arquivo=adm_geral.php" />';
	}

?>
