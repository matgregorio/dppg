<?php
	session_start();

    include_once ('trataInjection.php');

    if (protectorString($_GET[codigo_subcategoria]))
        return;

	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$codigo = mysql_real_escape_string($_GET[codigo_banner]);
			
			$sql = "select * from banner where codigo_banner='$codigo'";
			$resultado = mysql_query($sql);
			$campos = mysql_fetch_array($resultado);
	
			echo "<br><center><h2>Alterar Banner</h2></center><br>
				
				
				<form name='form_alterar_banner' method='post' action='index.php' onsubmit='javascript: return checkbanner()' enctype='multipart/form-data'>
					<table border=0 align=center>
					<tr>
						<td colspan=2 align=center>	
							<b>Banner Atual</b><br>
							<img src='images/banner/$campos[arquivo_banner]' width='300'><br><br>			
						</td>	
					</tr>
					<tr>
						<td>		
							<b>Nome do banner</b>
						</td>
						<td>	
							<input type='text' name='nome_banner' size='45' maxlength='200' value='".$campos[nome_banner]."'>
						</td>
					</tr>
					<tr>
							<td align=center colspan=2><br><b>( Resolução ideal para imagem 600  pixels  x  115  pixels ) </b></td>
						</tr>
						<tr>
							<td><br><b>Imagem do banner</b></td> 
							<td><br><input type='file' name='arquivo_banner'></td>
						</tr>
					<tr>
						<td>		
							<b>Link banner</b>
						</td>
						<td>	
							<input type='text' name='link_banner' size='45' maxlength='200' value='".$campos[link_banner]."'>
						</td>
					</tr>
					<tr>							
						<td colspan=2 align=center>	
							<br>
							<input type='hidden' name='codigo_banner' value='".$campos[codigo_banner]."'>
							<input type='hidden' name='arquivo' value='alterar_banner.php'>
							
							<input type='submit' name='salvar' value='Salvar' class='submitCinza'>
							<a href='index.php?arquivo=adm_geral.php'><input type='button' value='Voltar'></a>
						</td>
					</tr>		
					</table>		
				</form>";
		}
		mysql_close($conexao);
	}
?>