<?php
	session_start();
	include_once ('trataInjection.php');

	if(protectorString($_POST[cpf]) || protectorString($_POST[senha]) || protectorString($_POST[nome]) ||
	   protectorString($_POST[email]) || protectorString($_POST[telefone]) || protectorString($_POST[tipo_usuario]))
		return;


if ($_SESSION['logado_site_dppg'])
	{
		if( ($pesquisa_adm) or ($pesquisa_subadm) ) 
		{
			include("includes/config2.php");
			
			$cpf = mysql_real_escape_string($_POST[cpf]);
			$senha_tmp = mysql_real_escape_string($_POST[senha]);
			$senha = md5($senha_tmp);
			$nome = mysql_real_escape_string($_POST[nome]);
			$email = mysql_real_escape_string($_POST[email]);
			$telefone = mysql_real_escape_string($_POST[telefone]);
			$codigo_grupo = mysql_real_escape_string($_POST[tipo_usuario]);
			
			if($senha=="")
			{
				$sql = "update usuarios set nome='$nome', email='$email', telefone='$telefone' where cpf=$cpf";
			}
			else {
						$sql = "update usuarios set senha='".md5($senha)."', nome='$nome', email='$email', telefone='$telefone' where cpf=$cpf";
				  }
								
			$resultado = mysql_query($sql);
			
			echo'<div id="centralizar">';
				
				if ($resultado==1)
				   echo '<br><br><center><font color=#006400><b>Atualizado com sucesso!</b></font></center><br>';
				else
				   echo '<br><br><center><font color="#B22222"><b>Erro na atualização!</b></font></center><br>';
				   
			echo'</div>';   
		}
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2;index.php?arquivo=subsistemas/usuario/listar_ger_usuario.php" />';
	}	
?>
