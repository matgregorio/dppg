<?php
if ($_SESSION['logado_site_dppg'])
{	
	include('includes/config2.php');
	
	$codigo_menu = mysql_real_escape_string($_GET[codigo_menu]);
	
	$sql = "select * from menu_sistemas where codigo_menu='$codigo_menu'";
	$resultado = mysql_query($sql);
	
	if (mysql_num_rows($resultado)==1)
	{
	   $campos=mysql_fetch_array($resultado); 
		
	   $_SESSION['menu_sistema'] = TRUE;	   
	   $_SESSION['codigo_menu'] = $campos['codigo_menu'];
	   $_SESSION['nome_menu'] = $campos['nome_menu'];
	   $_SESSION['link_menu'] = $campos['link_menu'];
	   $_SESSION['link_index'] = $campos['link_index'];
	}
	echo'<div id="centralizar">';
		echo '<br><br><center><font color=#006400><b> Sistema '.$campos['nome_menu'].' iniciado com sucesso! </b></font></center><br>';
	echo'</div>';
	echo '<meta http-equiv="refresh" content="3;index.php?arquivo=principal_subsistemas.php" />';
}	
mysql_close($conexao);			
?>
