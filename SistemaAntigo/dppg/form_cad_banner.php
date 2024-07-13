<?php
	session_start();


	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			echo "<script src='valida_forms/validar_cad_banner.js'></script>";
		
			echo "
				<center><h2> Cadastro de Banners</h2></center>
				<br>
				
				<form name='form_cad_banner' method='post' onsubmit='javascript: return checkbanner()' action='index.php' enctype='multipart/form-data'>
					<table align=center>
						<tr>
							<td><b>Nome do banner</b></td>
							<td><input type='text' name='nome_banner' size='45' maxlength='200'><br></td>
						</tr>
						<tr>
							<td align=center colspan=2><br><b>( Resolução ideal para imagem 600  pixels  x  115  pixels ) </b></td>
						</tr>
						<tr>
							<td><br><b>Imagem do banner</b></td> 
							<td><br><input type='file' name='imagem_banner'></td>
						</tr>
						<tr>
							<td><b>Link do banner</b></td>
							<td><input type='text' name='link_banner' size='45' maxlength='200'><br></td>
						</tr>
					</table>
				<br>
				
				<center>
					<input type='hidden' name='arquivo' value='cadastrar_banner.php'>
					<input type='submit' name='salvar' value='Salvar' class='submitCinza'>
					<a href='index.php?arquivo=adm_geral.php'><input type='button' value='Voltar'></a>
				</center>
			</form>";
		}	
	}
?>