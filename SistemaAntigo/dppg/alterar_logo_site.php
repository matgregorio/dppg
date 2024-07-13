<?php
	session_start();

	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$sql = "select * from site";
			$resultado = mysql_query($sql);
			$campos = mysql_fetch_array($resultado);
	
			echo "<br><center><h2> Alterar Logo do Site</h2></center>";
			   
			echo "<center>
			<h2>Logo Atual</h2>
			<br>
			<img src='images/site/$campos[logo_topo]' width='100 height='80'>
			<br><br>";
			
			echo"	   
			<form name='form_alterar_site' method='post' action='index.php' onsubmit='javascript: return checkcontatos()' enctype='multipart/form-data'><br>
				
				<b>Carregar nova logo do Site</b><br>
				<br>
				<br>( Resolução ideal  200 pixels  x  130 pixels )	<br>	
				<input type='file' name='logo_topo'><br>
				
								
				<input type='hidden' name='codigo_site' value='".$campos[codigo_site]."'>
				<input type='hidden' name='arquivo' value='alterar_logo.php'>
				<br><br>
				<input type='submit' name='salvar' value='Salvar'><a href='index.php?arquivo=adm_geral.php'><input type='button' value='Voltar'></a>
			</center>	
			</form>";
		}
		mysql_close($conexao);
	}
?>
