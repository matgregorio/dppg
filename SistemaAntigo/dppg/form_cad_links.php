<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			echo "<script src='valida_forms/validar_cad_link.js'></script>";
		
			echo "
				<center><h2> Cadastro de Links</h2></center>
				<br>
				
				<form name='form_cad_links' method='post' onsubmit='javascript: return checklinks()' action='index.php' enctype='multipart/form-data'>
					<table align=center>
						<tr>
							<td><b>Tipo link</b></td>
							<td>
									<select name=tipo_link>
										<option selected value=0> Selecione uma opção </option>
										<option value=1> Link Lateral </option>
										<option value=2> Link Rodape </option>										
									</select>
							</td>
						</tr>
						<tr>
							<td><b>Nome do Link</b></td>
							<td><input type='text' name='nome_link' size='45' maxlength='100'><br></td>
						</tr>
						<tr>
							<td><b>Endereço do Link</b></td>
							<td><input type='text' name='endereco_link' size='45' maxlength='100'><br></td>
						</tr>
						<tr>
							<td>Link Rodape</td>
							<td align=center><br>( Resolução ideal 82  pixels  x  46  pixels )</td>
						</tr>
						<tr>
							<td>Link Lateral</td>	
							<td align=center>( Resolução ideal 115  pixels  x  80  pixels )</td>
						</tr>
						<tr>
							<td><br><b>Imagem do link</b></td> 
							<td><br><input type='file' name='imagem_link'></td>
						</tr>
					</table>
				<br>
				
				<center>
					<input type='hidden' name='arquivo' value='cadastra_links.php'>
					<input type='submit' name='salvar' value='Salvar' class='submitCinza'>
					<a href='index.php?arquivo=adm_geral.php'><input type='button' value='Voltar'></a>
				</center>
			</form>";
		}	
	}
?>