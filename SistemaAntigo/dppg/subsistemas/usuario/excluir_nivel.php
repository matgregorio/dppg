<?php
	session_start();
	include_once ('trataInjection.php');

	if(protectorString($_GET[codigo_grupo]))
		return;
	
	if ($_SESSION['logado_site_dppg'])
	{
		if( ($pesquisa_adm) or ($pesquisa_subadm) ) 
		{
			include("includes/config2.php");
			
			$codigo_grupo = mysql_real_escape_string($_GET[codigo_grupo]);		
			
			$sqlUm = "delete from participa_grupos where codigo_grupo=$codigo_grupo"; 
			$resultadoUm = mysql_query($sqlUm);
			
			$sqlDois = "delete from grupo_usuario where codigo_grupo=$codigo_grupo"; 
			$resultadoDois = mysql_query($sqlDois);
			
			if (($resultadoUm == 1) && ($resultadoDois == 1))
			   echo '<br><br><center><font color=#006400><b>Excluido com sucesso!</b></font></center><br>';
			else
			   echo '<br><br><center><font color="#B22222"><b>Erro na exclusão!</b></font></center><br>';
		}
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2; URL=index.php" />';
	}
?>
