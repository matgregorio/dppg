<?php
include_once ('trataInjection.php');

if (protectorString($_POST[nome]) || protectorString($_POST[telefone]) || protectorString($_POST[email]) || protectorString($_POST[senha]))
	return;

if ($_SESSION['logado_site_dppg']) {

	include("includes/config2.php");
	
	$nome = mysql_real_escape_string($_POST[nome]);
	$telefone = mysql_real_escape_string($_POST[telefone]);
	$email = mysql_real_escape_string($_POST[email]);
	$senha = mysql_real_escape_string($_POST[senha]);
	
	if($senha=="")
	{
		$sql = "update usuarios set nome='$nome', telefone='$telefone', email='$email' where cpf='$_SESSION[cpf]'";
	}
	else  {
				$sql = "update usuarios set nome='$nome', telefone='$telefone', email='$email', senha='".md5($senha)."'	where cpf='$_SESSION[cpf]'";	
			}					
	$resultado = mysql_query($sql);
	
	echo'<div id="centralizar">';
		
		if ($resultado==1)
		   echo '<br><br><center><font color=#006400><b>Atualizado com sucesso!</b></font></center><br>';
		else
		   echo '<br><br><center><font color="#B22222"><b>Erro na atualização!</b></font></center><br>';
		   
	echo'</div>';   
	   
	mysql_close($conexao);
	echo '<meta http-equiv="refresh" content="2;index.php" />';
}

?>
