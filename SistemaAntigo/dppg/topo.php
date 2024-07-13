<?php
	include("includes/config2.php");
	$sql_site = 'select * from site';
	$resultado_site = mysql_query($sql_site);
	$campos_site = mysql_fetch_array($resultado_site);
?>

<html>
<body>
		<div id="logos">	 <!-- Divisão do topo -->
						<div class="esquerda_logo">
							<?php
							echo '<img src="images/site/logo_ifet.png" width="296" height="110" border="0" ">';
							?>	
						</div>
						
						<div class="direita_logo">
							<?php
								echo '<img src="images/site/'.$campos_site[logo_topo].'" width="190" height="120" border="0" ">';
							?>
						</div>
						
						<div class="centro_titulo">
							<?php
							echo 	"<br><br><br><br><font size='6' color=#006400><center>".$campos_site[nome_site]."</center></font>";
							?>	
						</div>
		</div>
<?php
	mysql_close($conexao);
?>	
</body>
</html>
