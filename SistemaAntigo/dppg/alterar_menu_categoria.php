<?php
	session_start();
	include_once('trataInjection.php');

	if (protectorString($_POST[$codigo_categoria]) === true || protectorString($_POST[$nome_categoria]) === true || protectorString($_POST[$posicao_menu]) === true || protectorString($posicao_atual) === true)
		 return;

	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$codigo_categoria = mysql_real_escape_string($_POST[codigo_categoria]);
			$nome_categoria = mysql_real_escape_string($_POST[nome_categoria]);
			$posicao_menu = mysql_real_escape_string($_POST[posicao_menu]);
			$posicao_atual = mysql_real_escape_string($_POST[posicao_atual]);
		
			///////////////////////////////////////////////////////////////////////////////
			if($posicao_menu==1) 
			{		
				$sql = "select * from menu_categoria where posicao_menu < $posicao_atual";
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
				if($posicao_atual>2) 
				{	
					$sql = "select * from menu_categoria where posicao_menu<$posicao_atual and posicao_menu>=$posicao_menu";
					$registro = mysql_query($sql);
			
					while($valor = mysql_fetch_array($registro)) 
					{
						$aux1 = ($valor[posicao_menu]+1);
						$aux2 = $valor[codigo_categoria];
						$s = mysql_query("update menu_categoria SET posicao_menu = '$aux1' where codigo_categoria='$aux2'");
							
					}
				}
				if($posicao_atual<2) 
				{	
					$sql = "select * from menu_categoria where posicao_menu<3";
					$registro = mysql_query($sql);
			
					while($valor = mysql_fetch_array($registro)) 
					{
							if($valor==1) 
							{						
								$aux1 = ($valor[posicao_menu]+1);
								$aux2 = $valor[codigo_categoria];
							}
							else {
										$aux1 = ($valor[posicao_menu]-1);
										$aux2 = $valor[codigo_categoria];
									}
							$s = mysql_query("update menu_categoria SET posicao_menu = '$aux1' where codigo_categoria='$aux2'");
						}
				}		
			}
			
			if($posicao_menu==3) 
			{		
					if($posicao_atual>3) 
					{	
						$sql = "select * from menu_categoria where posicao_menu<$posicao_atual and posicao_menu>=$posicao_menu";
						$registro = mysql_query($sql);
			
						while($valor = mysql_fetch_array($registro)) 
						{
							$aux1 = ($valor[posicao_menu]+1);
							$aux2 = $valor[codigo_categoria];
							$s = mysql_query("update menu_categoria SET posicao_menu = '$aux1' where codigo_categoria='$aux2'");
						}
					}
					if($posicao_atual<3) 
					{	
						$sql = "select * from menu_categoria where posicao_menu>=$posicao_atual and posicao_menu<=$posicao_menu";
						$registro = mysql_query($sql);
			
						while($valor = mysql_fetch_array($registro)) 
						{
							if($valor==1)
							{						
								$aux1 = ($valor[posicao_menu]+1);
								$aux2 = $valor[codigo_categoria];
							}
							else{
										$aux1 = ($valor[posicao_menu] - 1);
										$aux2 = $valor[codigo_categoria];
								 }
							
							$s = mysql_query("update menu_categoria SET posicao_menu = '$aux1' where codigo_categoria='$aux2'");
						}
					}	
			}
			
			if($posicao_menu==4) 
			{		
					if($posicao_atual>4) 
					{	
						$sql = "select * from menu_categoria where posicao_menu<$posicao_atual and posicao_menu>=$posicao_menu";
						$registro = mysql_query($sql);
			
						while($valor = mysql_fetch_array($registro)) 
						{
							$aux1 = ($valor[posicao_menu]+1);
							$aux2 = $valor[codigo_categoria];
							$s = mysql_query("update menu_categoria SET posicao_menu = '$aux1' where codigo_categoria='$aux2'");
						}
					}
					if($posicao_atual<4) 
					{	
						$sql = "select * from menu_categoria where posicao_menu>=$posicao_atual and posicao_menu<=$posicao_menu";
						$registro = mysql_query($sql);
			
						while($valor = mysql_fetch_array($registro)) 
						{
							if($valor==1)
							{						
								$aux1 = ($valor[posicao_menu] + 1);
								$aux2 = $valor[codigo_categoria];
							}
							else{
										$aux1 = ($valor[posicao_menu] - 1);
										$aux2 = $valor[codigo_categoria];
		      				 }
								
							$s = mysql_query("update menu_categoria SET posicao_menu = '$aux1' where codigo_categoria='$aux2'");
						}
					}
				
			}
			
			if($posicao_menu==5) 
			{		
				$sql = "select * from menu_categoria where posicao_menu >= $posicao_atual";
				$registro = mysql_query($sql);
		
					while($valor = mysql_fetch_array($registro)) 
					{
						$aux1 = ($valor[posicao_menu]+1);
						$aux2 = $valor[codigo_categoria];
						$s = mysql_query("update menu_categoria SET posicao_menu = '$aux1' where codigo_categoria='$aux2'");					
					}
			}		
			///////////////////////////////////////////////////////////////////////////////
			$sql2 = "update menu_categoria SET nome_categoria='$nome_categoria', posicao_menu='$posicao_menu' where codigo_categoria='$codigo_categoria'";
			$resultado2 = mysql_query($sql2);
			
			echo'<div id="centralizar">';
				if ($resultado2 == 1) 
				{	
					echo '<br><br><center><font color=#006400><b> Alteração realizada com sucesso!! </b></font></center><br>';
				}
				else {
							echo '<br><br><center><font color="#B22222"><b>"Erro no Cadastro!</b></font></center><br>';	
					  }
			echo'</div>';
		}
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2;index.php?arquivo=adm_geral.php" />';
	}
?>

