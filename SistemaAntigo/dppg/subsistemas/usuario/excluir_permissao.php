<?php
	session_start();
	include_once ('trataInjection.php');

	if(protectorString($_GET[cpf]) || protectorString($_GET[codigo_grupo]))
		return;
	
	if ($_SESSION['logado_site_dppg'])
	{
		if( ($pesquisa_adm) or ($pesquisa_subadm) ) 
		{
			include("includes/config2.php");
			
			$cpf = mysql_real_escape_string($_GET[cpf]);
			$codigo_grupo = mysql_real_escape_string($_GET[codigo_grupo]);
			
			//excluir permissao do usuario da tabela participa_grupos		
			$sql = "delete from participa_grupos where (codigo_grupo='$codigo_grupo' and cpf='$cpf')"; 
			$resultado = mysql_query($sql);		
			
			if ($resultado==1)
			   echo '<br><br><center><font color=#006400><b>Permissão retirada com sucesso!</b></font></center><br>';
			else
			   echo '<br><br><center><font color="#B22222"><b>Erro na exclusão!</b></font></center><br>';
		}
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2; URL=index.php?arquivo=subsistemas/usuario/listar_ger_permissoes.php" />';
	}
?>
