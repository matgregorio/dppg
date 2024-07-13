<?php
	session_start();

	include_once ('trataInjection.php');

	if (protectorString($_POST[codigo_sub_subcategoria]) || protectorString($POST[combo_subcategoria]) || protectorString($POST[nome_sub_subcategoria]) || protectorString($POST[conteudo_sub_subcategoria]))
		return;

	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
	
			$codigo_sub_subcategoria = mysql_real_escape_string($_POST[codigo_sub_subcategoria]);
			$combo_subcategoria = mysql_real_escape_string($_POST[combo_subcategoria]);
			$nome_sub_subcategoria = mysql_real_escape_string($_POST[nome_sub_subcategoria]);
			$conteudo_sub_subcategoria = mysql_real_escape_string($_POST[conteudo_sub_subcategoria]);
		
			$sqlll = "update menu_sub_subcategoria SET menu_subcategoria = '$combo_subcategoria',nome_sub_subcategoria = '$nome_sub_subcategoria',conteudo_sub_subcategoria = '$conteudo_sub_subcategoria' where codigo_sub_subcategoria='$codigo_sub_subcategoria'";
			$resultadoxx = mysql_query($sqlll);
			
			echo'<div id="centralizar">';
			
				if ($resultadoxx==1) 
				{		
					echo '<br><br><center><font color=#006400><b> Alteração realizada com sucesso!! </b></font></center><br>';
				}
				else {
							echo '<br><br><center><font color="#B22222"><b>"Erro no Cadastro!</b></font></center><br>';	
					  }
					  
			echo'</div>';
		}
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2;index.php?arquivo=adm_geral.php" />';
	}
?>


