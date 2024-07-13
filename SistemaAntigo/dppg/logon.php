<?php

	include('includes/config2.php');
    include_once ('trataInjection.php');

    if (protectorString($_POST[cpf]) || protectorString($_POST[senha]) || protectorString($_POST[valor]) || protectorString($_POST['cpf']))
        return;

	$cpf = mysql_real_escape_string($_POST[cpf]);
	$senha = mysql_real_escape_string($_POST[senha]);
	
	$sql = "select * from usuarios where cpf='$cpf' and senha='".md5($senha)."'";
	$resultado = mysql_query($sql);
	
	$valor = strtolower($_POST[valor]);
	
	if(($_SESSION[valor] == $valor)) {	

		if (mysql_num_rows($resultado)==1)
		{
		   $campos=mysql_fetch_array($resultado); 
			
		   $_SESSION['logado_site_dppg'] = TRUE;
		   $_SESSION['menu_sistema'] = FALSE;

		   $_SESSION['nome_usuario'] = $campos['nome'];
		   $_SESSION['cpf'] = mysql_real_escape_string($_POST['cpf']);
		
  			$sqlGrupo = "select codigo_grupo from participa_grupos where cpf='$_SESSION[cpf]'";
  			$resultadoGrupo = mysql_query($sqlGrupo);
  			
  			while($camposGrupo = mysql_fetch_array($resultadoGrupo)){
  					$grupos_logon[] = $camposGrupo['codigo_grupo'];
  			}
  			
  			$_SESSION['grupos_usuarios'] = $grupos_logon;
  	
		   echo '<meta http-equiv="refresh" content="2;index.php" />';	
			
			echo'<div id="centralizar">';		
				echo '<center>
				<img src="images/login_ok.png" width=70 heigth=70><br>
				<font color="#006400"><b>Login efetuado com sucesso!</b></center><br>';
			echo'</div>';
		}
		else
		{
			echo'<div id="centralizar">';
			   echo '<center>
			   <img src="images/login_erro.png" width=70 heigth=70><br>
			   <font color="#B22222"><b>Erro no Login!</b></font></center><br>';
			echo'</div>';
		   echo '<meta http-equiv="refresh" content="3;index.php" />';
		}
		
	} else { 
				echo'<div id="centralizar">';
			   	echo '<center>
			   			<img src="images/login_erro.png" width=60 heigth=60><br>
			   			<font color="#B22222"><b>Valor digitado não corresponde a imagem !</b></font></center><br>';
				echo'</div>';
		   	echo '<meta http-equiv="refresh" content="3;index.php" />';
			}
		
	mysql_close($conexao);

?>