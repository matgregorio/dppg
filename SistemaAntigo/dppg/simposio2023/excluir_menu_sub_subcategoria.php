<?php
	if ($_SESSION[logado_site_dppg])
	{
		include("includes/config2.php");
		 
		$codigo = mysql_real_escape_string($_GET[codigo_sub_subcategoria]);
		
		/// ARRUMAR POSIÇÕES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		$sql = mysql_query("select * from menu_sub_subcategoria where codigo_sub_subcategoria=$codigo");
		$valorPos = mysql_fetch_array($sql);
		$posicao = $valorPos['posicao'];
		$categoria = $valorPos['menu_subcategoria'];
				
		if( $posicao != 0 )
		{
			$sqlPos = "select * from menu_sub_subcategoria where menu_subcategoria=$categoria and posicao>=$posicao";
			$regist = mysql_query($sqlPos);
	
			while( $valor = mysql_fetch_array($regist) ) 
			{
				$auxUm = ( $valor[posicao] - 1 );
				$auxDois = $valor[codigo_sub_subcategoria];
				$s = mysql_query("update menu_sub_subcategoria SET posicao = '$auxUm' where codigo_sub_subcategoria='$auxDois'");
			}
		}
		
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
	
		$sql = "delete from menu_sub_subcategoria where codigo_sub_subcategoria='$codigo'"; 
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
