<?php
	if ($_SESSION[logado_site_dppg])
	{
		include("includes/config2.php");
		
		echo '<br><br><center><font size=4><b>Alterar Links</b></font><hr>';		
	
		//listar links externos da menu lateral
		echo '<br><br><font size=2><b>Links Laterais</b></font><br>';	
		$sql = "select * from links_externos where tipo_link=1 order by nome_link asc"; 
		$resultado = mysql_query($sql);
		
		$linhas_lat = mysql_num_rows($resultado);
		if($linhas_lat==0) { echo '<br><font color=#006400><b>Nenhum link lateral cadastrado !</b></font>'; }

		while ($campos = mysql_fetch_array($resultado)) {					
			echo "	<br>
						<a href='index.php?arquivo=form_alterar_links.php&codigo_link=$campos[codigo_link]'>$campos[nome_link]  <img src=images/editar.png width=16 height=16 border=0 alt=editar></a>
						<br>";	
		}
		
		//listar links externos da menu lateral
		echo '<br><br><br><font size=2><b>Links Rodape</b></font><br>';	
		$sql = "select * from links_externos where tipo_link=2 order by nome_link asc"; 
		$resultado = mysql_query($sql);

		$linhas_rod = mysql_num_rows($resultado);
		if($linhas_rod==0) { echo '<br><font color=#006400><b>Nenhum link no rodape cadastrado !</b></font>'; }

		while ($campos = mysql_fetch_array($resultado)) {					
			echo "	<br>
						<a href='index.php?arquivo=form_alterar_links.php&codigo_link=$campos[codigo_link]'>$campos[nome_link]  <img src=images/editar.png width=16 height=16 border=0 alt=editar></a>
						<br>";	
		}
		
	
	echo'</center>';

	echo'<br><hr>';
		
	echo '<center><a href="index.php?arquivo=adm_geral.php"><input type="button" value="Voltar"></a></center>';	
	mysql_close($conexao);
	}
?>
