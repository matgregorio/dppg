<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$codigo_menu = mysql_real_escape_string($_POST[codigo_menu]);
			$nome_menu = mysql_real_escape_string($_POST[nome_menu]);
			$link_menu = mysql_real_escape_string($_POST[link_sistema]);
			$link_index = mysql_real_escape_string($_POST[link_index]);
			$descricao_sistema = mysql_real_escape_string($_POST[descricao_sistema]);
			
			$sql = "update menu_sistemas SET nome_menu = '$nome_menu',descricao_sistema = '$descricao_sistema',link_menu = '$link_menu',link_index = '$link_index' where codigo_menu='$codigo_menu'";
			$resultado = mysql_query($sql);
			
			echo'<div id="centralizar">';
			
				if ($resultado == 1) 
				{
					echo '<br><br><center><font color=#006400><b> Alteração realizada com sucesso!! </b></font></center><br>';
				}
				else {
							echo '<br><br><center><font color="#B22222"><b>Erro na alteração!</b></font></center><br>';	
					  }
					  
			echo'</div>';
		}
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2;index.php?arquivo=adm_geral.php" />';
	}
?>


