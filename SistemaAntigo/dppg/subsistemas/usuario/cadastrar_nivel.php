<?php
	session_start();
	include_once ('trataInjection.php');

	if(protectorString($_POST[nome_nivel]) || protectorString($_POST[codigo_nivel]) || protectorString($_POST[descricao_nivel]))
		return;
	
	if ($_SESSION['logado_site_dppg'])
	{
		if( ($pesquisa_adm) or ($pesquisa_subadm) ) 
		{
			include("includes/config2.php");
			
			$nome_grupo = mysql_real_escape_string($_POST[nome_nivel]);
			$codigo_nivel = mysql_real_escape_string($_POST[codigo_nivel]);
			$descricao_nivel = mysql_real_escape_string($_POST[descricao_nivel]);
			
			$sql = "insert into grupo_usuario (codigo_grupo, nome_grupo, descricao_grupo) values('$codigo_nivel','$nome_grupo','$descricao_nivel')";
			
			/*	
			//libera a nova permissao também para o administrador do sistema
			$query = "select * from participa_grupos where codigo_grupo=1";
			$result = mysql_query($query);
			$adm = mysql_fetch_array($result);
			
			//verificar se é o adm ou sub adm que esta cadastrando um nuvel de usuario
			if( $_SESSION[cpf] == $adm[cpf] )
			{
				mysql_query("insert into participa_grupos values('$codigo_nivel','$adm[cpf]')");	
			}
			else {
						mysql_query("insert into participa_grupos values('$codigo_nivel','$adm[cpf]')");
						mysql_query("insert into participa_grupos values('$codigo_nivel','$_SESSION[cpf]')");
				  }
			*/	
							
			$resultado = mysql_query($sql);
			
			if ($resultado==1)
			   echo '<br><br><center><font color=#006400><b>Cadastro com sucesso!</b></font></center><br>';
			else
			   echo '<br><br><center><font color="#B22222"><b>Erro na cadastro!</b></font></center><br>';
		}	   
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2;index.php?arquivo=principal_subsistemas.php" />';
	}
?>
