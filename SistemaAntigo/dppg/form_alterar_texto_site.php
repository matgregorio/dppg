<?php
	if ($_SESSION[logado_site_dppg])
	{
		include("includes/config2.php");
		
		$sql = "select * from site";
		$resultado = mysql_query($sql);
		$campos = mysql_fetch_array($resultado);

		echo "<script src='valida_forms/validar_texto.js'></script>";
		
		echo "<form name='form_alterar_texto_site' method='post' onsubmit='javascript: return checktexto()' action='index.php' enctype='multipart/form-data'><br>
		
			  	 <center><h2> Alterar texto principal do Site</h2></center>
		
			  	<br><br>
				<table align=center>
				<tr>				
						<td><b> Titulo da página principal</b></td>
				</tr>
				<tr>		
						<td><input type='text' name='titulo_home' size='60' maxlength='100' value='$campos[titulo_home]'></td>
				</tr>
				<tr>		
						<td><b>Texto da página principal</b></td>
				</tr>
				<tr>			
						<td><textarea name='texto_home' rows='10' cols='60'>$campos[texto_home]</textarea></td>				
				</tr>
				</table>
				
				<center>
					<input type='hidden' name='codigo_site' value='".$campos[codigo_site]."'>
					<input type='hidden' name='arquivo' value='alterar_texto_site.php'>
					<br><br>
					<input type='submit' name='salvar' value='Alterar'>
					<a href='index.php?arquivo=adm_geral.php'><input type='button' value='Voltar'></a>
				</center>
				
			</form>";
			
			echo "<br><br>";
		mysql_close($conexao);
	}
?>
