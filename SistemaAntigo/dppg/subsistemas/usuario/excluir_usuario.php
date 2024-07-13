<?php
	session_start();
	
	if ($_SESSION['logado_site_dppg'])
	{
		if( ($pesquisa_adm) or ($pesquisa_subadm) ) 
		{
			include("includes/config2.php");
			
			$cpf = mysql_real_escape_string($_GET[cpf]);

			//excluir o usuario da tabela usuario		
			$sql = "delete from usuarios where cpf='$cpf'"; 
			$resultado = mysql_query($sql);
			
			// excluir o usuario relacionado a um perfil de administraÁ„o
			$sql1 = "delete from participa_grupos where cpf='$cpf'"; 
			$resultado1 = mysql_query($sql1);		
			
			if ($resultado==1)
			   echo '<br><br><center><font color=#006400><b>Excluido com sucesso!</b></font></center><br>';
			else
			   echo '<br><br><center><font color="#B22222"><b>Erro na exclus√£o!</b></font></center><br>';
		}
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2; URL=index.php?arquivo=subsistemas/usuario/listar_ger_usuario.php" />';
	}
?>
