<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$codigo_subcategoria = mysql_real_escape_string($_POST[codigo_subcategoria]);
			$categoria = mysql_real_escape_string($_POST[combo_categoria]);
			$nome_subcategoria = mysql_real_escape_string($_POST[nome_subcategoria]);
			$conteudo_subcategoria = mysql_real_escape_string($_POST[conteudo_subcategoria]);
			
			$sql = "update menu_subcategoria SET categoria = '$categoria',nome_subcategoria = '$nome_subcategoria',conteudo_subcategoria = '$conteudo_subcategoria' where codigo_subcategoria='$codigo_subcategoria'";
			$resultado = mysql_query($sql);
			
			echo'<div id="centralizar">';
			
				if ($resultado == 1) 
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


