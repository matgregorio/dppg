<?php
	session_start();
	include_once ('trataInjection.php');

	if(protectorString($_POST[combo_nivel]) || protectorString($_POST[combo_nome]) || protectorString($_POST[combo_sistema]))
		return;

	if ($_SESSION['logado_site_dppg'])
	{
		if( ($pesquisa_adm) or ($pesquisa_subadm) ) 
		{
			include("includes/config2.php");
			
			$cod_grupo = mysql_real_escape_string($_POST[combo_nivel]);
			$cod_cpf = mysql_real_escape_string($_POST[combo_nome]);	
			$cod_sistema = mysql_real_escape_string($_POST[combo_sistema]);
		
			$sql_permissao = "insert into participa_grupos (codigo_grupo, cpf, codigo_sistema) values('$cod_grupo','$cod_cpf','$cod_sistema')";
			$resultado_permissao = mysql_query($sql_permissao);
			if ($resultado_permissao==1)
			   echo '<br><br><center><font color=#006400><b>Permissão concedida com sucesso!</b></font></center><br>';
			else
			   echo '<br><br><center><font color="#B22222"><b>Erro no cadastro!</b></font></center><br>';
			}
//echo $sql_permissao;
		echo '<meta http-equiv="refresh" content="2;index.php?arquivo=subsistemas/usuario/listar_ger_permissoes.php" />';
				
	}
	mysql_close($conexao);
?>
