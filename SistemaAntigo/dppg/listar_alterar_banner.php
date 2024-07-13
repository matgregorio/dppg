<?php
	if ($_SESSION[logado_site_dppg])
	{
		include("includes/config2.php");
		
		echo '<br><br><center><font size=4><b>Alterar Banner</b></font><hr>
		<br>
		Para alterar clique em um banner !
		<br><br>';		
		
		$sql = "select * from banner"; 
		$resultado = mysql_query($sql);
		
		$linhas_lat = mysql_num_rows($resultado);
		
		if($linhas_lat==0) { 
			echo '<br><font color=#006400><b>Nenhum banner cadastrado !</b></font>'; 
		}
		
		echo "<table border=0>";
		while ($campos = mysql_fetch_array($resultado)) {					
			echo "	
						<tr>
							<td><a href='index.php?arquivo=form_alterar_banner.php&codigo_banner=$campos[codigo_banner]'><img src='images/banner/".$campos[arquivo_banner]."' width='200' height='50'/> </a><br><br></td>
						</tr>";	
		}
		echo "</table>";
		
	
	echo'</center>';

	echo'<hr>';
		
	echo '<center><a href="index.php?arquivo=adm_geral.php"><input type="button" value="Voltar"></a></center>';	
	mysql_close($conexao);
	}
?>
