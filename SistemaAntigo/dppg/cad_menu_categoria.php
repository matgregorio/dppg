<?php
	session_start();

	include_once ('trataInjection.php');

	if (protectorString($_POST[nome_categoria]) || protectorString($_POST[posicao_menu]))
		return;

	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$nome_categoria = mysql_real_escape_string($_POST[nome_categoria]);
			$posicao_menu = mysql_real_escape_string($_POST[posicao_menu]);
			
			///////////////////////////////////////////////////////////////////////////////
			if($posicao_menu==1) 
			{		
				$sql = "select * from menu_categoria";
				$registro = mysql_query($sql);
	
				while($valor = mysql_fetch_array($registro)) 
				{
					$aux1 = ($valor[posicao_menu]+1);
					$aux2 = $valor[codigo_categoria];
					$s = mysql_query("update menu_categoria SET posicao_menu = '$aux1' where codigo_categoria='$aux2'");
				}
			}
			
			if($posicao_menu==2) 
			{		
				$sql = "select * from menu_categoria where posicao_menu>1";
				$registro = mysql_query($sql);
	
				while($valor = mysql_fetch_array($registro)) 
				{
					$aux1 = ($valor[posicao_menu]+1);
					$aux2 = $valor[codigo_categoria];
					$s = mysql_query("update menu_categoria SET posicao_menu = '$aux1' where codigo_categoria='$aux2'");
				}
			}
			
			if($posicao_menu==3) 
			{		
				$sql = "select * from menu_categoria where posicao_menu>2";
				$registro = mysql_query($sql);
	
				while($valor = mysql_fetch_array($registro)) 
				{
					$aux1 = ($valor[posicao_menu]+1);
					$aux2 = $valor[codigo_categoria];
					$s = mysql_query("update menu_categoria SET posicao_menu = '$aux1' where codigo_categoria='$aux2'");			
				}
			}
			
			if($posicao_menu==4) 
			{		
				$sql = "select * from menu_categoria where posicao_menu > 3";
				$registro = mysql_query($sql);
	
				while($valor = mysql_fetch_array($registro)) 
				{
					$aux1 = ($valor[posicao_menu]+1);
					$aux2 = $valor[codigo_categoria];
					$s = mysql_query("update menu_categoria SET posicao_menu = '$aux1' where codigo_categoria='$aux2'");
				}
			}
			
			///////////////////////////////////////////////////////////////////////////////
			
			$sql1 ="insert into menu_categoria values('','$nome_categoria','$posicao_menu')";	
			$resultado1 = mysql_query($sql1);
			
			echo'<div id="centralizar">';
					if ($resultado1 == 1) 
					{
						 echo '<br><br><center><font color=#006400><b>Cadastrado com sucesso!</b></font></center><br>';
					}else 
					 	echo '<br><br><center><font color="#B22222"><b>Erro no cadastro!</b></font></center><br>';
					 	
			echo'</div>';
		}
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2;index.php?arquivo=adm_geral.php" />';
	}
?>
