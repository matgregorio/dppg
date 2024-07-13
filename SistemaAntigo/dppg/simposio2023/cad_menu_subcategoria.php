<?php
	if ($_SESSION[logado_site_dppg])
	{
		include("includes/config2.php");
	
		$posicao = mysql_real_escape_string($_POST[combo_posicao]); 
		
		$categoria = mysql_real_escape_string($_POST[combo_categoria]);	  	
	  	$nome = mysql_real_escape_string($_POST[nome_subcategoria]);   	
   	$conteudo = mysql_real_escape_string($_POST[conteudo_subcategoria]);
   	
   	/// ARRUMAR POSIÇÕES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				
		if( $posicao != 0 )
		{
			$sqlPos = "select * from menu_subcategoria where categoria=$categoria and posicao>=$posicao";
			$regist = mysql_query($sqlPos);
	
			while( $valor = mysql_fetch_array($regist) ) 
			{
				$aux1 = ($valor[posicao]+1);
				$aux2 = $valor[codigo_subcategoria];
				$s = mysql_query("update menu_subcategoria SET posicao = '$aux1' where codigo_subcategoria='$aux2'");
			}
		}
		
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		
		$sql ="INSERT INTO menu_subcategoria (codigo_subcategoria, nome_subcategoria, conteudo_subcategoria, categoria, posicao) VALUES ('', '$nome','$conteudo','$categoria','$posicao')";	
		$resultado = mysql_query($sql);
		
		echo'<div id="centralizar">';
		
				if ($resultado == 1) 
				{
					 echo '<br><br><center><font color=#006400><b>Cadastrado com sucesso!</b></font></center><br>';
				}
				else 
		  		    echo '<br><br><center><font color="#B22222"><b>Erro no cadastro!</b></font></center><br>';
		  		    
		echo'</div>';
	
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2;index.php?arquivo=adm_geral.php" />';
		
	}
?>
