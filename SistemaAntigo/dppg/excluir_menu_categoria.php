<?php
	session_start();

	include_once ('trataInjection.php');

	if (protectorString($_GET[codigo_categoria]))
		return;

	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$codigo = mysql_real_escape_string($_GET[codigo_categoria]);
			
			$busca = "select * from menu_categoria where codigo_categoria='$codigo'"; 
			$reg = mysql_query($busca);
			$campos = mysql_fetch_array($reg);
			
			$posicao = $campos[posicao_menu];
			
			///////////////////////////////////////////////////////////////////////////////
			//reposiciona os valores 		
			$busca1 = "select * from menu_categoria where posicao_menu>'$posicao'";
			$reg = mysql_query($busca1);
			
			while($valor = mysql_fetch_array($reg)) 
			{
					$aux1 = ($valor[posicao_menu]-1);
					$aux2 = $valor[codigo_categoria];
					$s = mysql_query("update menu_categoria SET posicao_menu='$aux1' where codigo_categoria='$aux2'");
			}
			///////////////////////////////////////////////////////////////////////////////
			
			$sql = "delete from menu_categoria where codigo_categoria='$codigo'"; 
			$resultado = mysql_query($sql);
			
			$sql = "delete from menu_subcategoria where categoria='$codigo'"; 
			$resultado = mysql_query($sql);
		
			echo'<div id="centralizar">';
					
					if ($resultado==1)
					  echo '<br><br><center><font color=#006400><b>Excluido com sucesso!</b></font></center><br>';
					  
					else
					   echo '<br><br><center><font color="#B22222"><b>Erro na exclusão!</b></font></center><br>';
					   
			echo'</div>';
		}   
		mysql_close($conexao);
		echo '<meta http-equiv="refresh" content="2;index.php?arquivo=adm_geral.php" />';
	}
?>
