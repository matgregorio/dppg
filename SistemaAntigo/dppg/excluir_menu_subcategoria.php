<?php

	include_once ('trataInjection.php');

	if (protectorString($_GET[codigo_subcategoria]))
		return;

	if ($_SESSION[logado_site_dppg])
	{
		include("includes/config2.php");
		 
		$codigo = mysql_real_escape_string($_GET[codigo_subcategoria]);
		
		/// ARRUMAR POSIÇÕES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		$sql = mysql_query("select * from menu_subcategoria where codigo_subcategoria=$codigo");
		$valorPos = mysql_fetch_array($sql);
		$posicao = $valorPos['posicao'];
		$categoria = $valorPos['categoria'];
				
		if( $posicao != 0 )
		{
			$sqlPos = "select * from menu_subcategoria where categoria=$categoria and posicao>=$posicao";
			$regist = mysql_query($sqlPos);
	
			while( $valor = mysql_fetch_array($regist) ) 
			{
				$auxUm = ( $valor[posicao] - 1 );
				$auxDois = $valor[codigo_subcategoria];
				$s = mysql_query("update menu_subcategoria SET posicao = '$auxUm' where codigo_subcategoria='$auxDois'");
			}
		}
		
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
	
		$sql = "delete from menu_subcategoria where codigo_subcategoria='$codigo'"; 
		$resultado = mysql_query($sql);
		
		echo'<div id="centralizar">';
		
					if ($resultado==1)
					  echo '<br><br><center><font color=#006400><b>Excluido com sucesso!</b></font></center><br>';
					  
					else
					   echo '<br><br><center><font color="#B22222"><b>Erro na exclusão!</b></font></center><br>';
					   
		echo'</div>';
   
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2;index.php?arquivo=adm_geral.php" />';
	}
?>
