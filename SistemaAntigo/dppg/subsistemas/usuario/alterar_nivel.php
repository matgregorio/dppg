<?php
	session_start();
	include_once ('trataInjection.php');

	if(protectorString($_POST[nome]) || protectorString($_POST[codigo_grupo]) || protectorString($_POST[descricao_nivel]))
		return;

	if ($_SESSION['logado_site_dppg'])
	{
		if( ($pesquisa_adm) or ($pesquisa_subadm) ) 
		{
			include("includes/config2.php");
			
			$nome = mysql_real_escape_string($_POST[nome]);
			$codigo_grupo = mysql_real_escape_string($_POST[codigo_grupo]);
			$descricao_grupo = mysql_real_escape_string($_POST[descricao_nivel]);
			
			$sql = "update grupo_usuario set nome_grupo='$nome', descricao_grupo='$descricao_grupo' where codigo_grupo=$codigo_grupo";
			$resultado = mysql_query($sql);
			
			echo'<div id="centralizar">';
			
				if ($resultado==1)
				   echo '<br><br><center><font color=#006400><b>Atualizado com sucesso!</b></font></center><br>';
				else
				   echo '<br><br><center><font color="#B22222"><b>Erro na atualização!</b></font></center><br>';
				   
			echo'</div>';   
		}	
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2;index.php" />';
	}

?>
