<?php
	
	include("includes/config2.php");
	
	//chama os links externos
	include('links_externos_rodape.php');
	
	
	$sql_site = 'select * from site';
	$resultado_site = mysql_query($sql_site);
	$campos_site = mysql_fetch_array($resultado_site);
	
		
	//echo "<img src='images/site/rodape.png' class='bg'/>";
	
	//texto do rodape	 
		echo '<center><font face="arial">';
	   echo '<b>'.$campos_site[titulo_rodape].'</b>';
	  
	   echo '<br>'.$campos_site[instituicao_rodape].'<br>';
	   echo ''.$campos_site[endereco_rodape].'<br>';
	   echo 'Telefone : '.$campos_site[telefone_rodape].' Email: '.$campos_site[email_rodape].'<br>';
	   echo '© Webmaster reponsavel: '.$campos_site[desenvolvido].'<br>';
	   echo '</font></center>';
 		   
	mysql_close($conexao);
?>			

