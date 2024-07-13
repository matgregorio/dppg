<?php
	session_start();

	include_once ('trataInjection.php');

	if (protectorString($_POST[codigo_subcategoria]) || protectorString($_POST[combo_subcategoria]) || protectorString($_POST[nome_subcategoria]) || protectorString($_POST[link_subcategoria]))
		return;

	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$codigo_subcategoria = mysql_real_escape_string($_POST[codigo_subcategoria]);
			$codigo_menu = mysql_real_escape_string($_POST[combo_subcategoria]);
			$nome_subcategoria = mysql_real_escape_string($_POST[nome_subcategoria]);
			$link_subcategoria = mysql_real_escape_string($_POST[link_subcategoria]);
			
			$sql = "update menu_sistemas_subcategoria SET codigo_subcategoria = '$codigo_subcategoria',nome_subcategoria = '$nome_subcategoria',link_subcategoria = '$link_subcategoria',codigo_menu='$codigo_menu' where codigo_subcategoria='$codigo_subcategoria'";
			$resultado = mysql_query($sql);
			
			echo'<div id="centralizar">';
			
				if ($resultado == 1) 
				{
					echo '<br><br><center><font color=#006400><b>Alteração realizada com sucesso!! </b></font></center><br>';
				}
				else {
							echo '<br><br><center><font color="#B22222"><b>Erro no Cadastro!</b></font></center><br>';	
					  }
			
			echo'</div>';
		}
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2;index.php?arquivo=adm_geral.php" />';
	}
?>


