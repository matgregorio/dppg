<?php
	session_start();

    include_once ('trataInjection.php');

    if (protectorString($_GET[codigo_link]))
      return;

	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$codigo = mysql_real_escape_string($_GET[codigo_link]);
			
			$sql = "select * from links_externos where codigo_link='$codigo'";
			$resultado = mysql_query($sql);
			$campos = mysql_fetch_array($resultado);
	
			echo "<br><center><h2>Alterar Links</h2></center><br>
				
				<script src='valida_forms/validar_alterar_link.js'></script>
				<form name='form_alterar_links' method='post' action='index.php' onsubmit='javascript: return checklinks()' enctype='multipart/form-data'>
					<table border=0 align=center>
					<tr>
						<td colspan=2 align=center>	
							<b>Link Atual</b><br>
							<img src='images/links/$campos[imagem_link]'><br><br>			
						</td>	
					</tr>
					<tr>
							<td><b>Tipo link</b></td>
							<td>
									<select name=tipo_link>";
										
										if( $campos[tipo_link] == 1 ){
											echo "<option selected value=1> Link Lateral </option>
													<option value=2> Link Rodape </option>	";
										}
										elseif( $campos[tipo_link] == 2){
												echo "<option selected value=2> Link Rodape </option>
														<option value=1> Link Lateral </option>";
											}		
									
							echo "</select>
							</td>
					</tr>
					<tr>
						<td>		
							<b>Nome</b>
						</td>
						<td>	
							<input type='text' name='nome_link' size='40' maxlength='100' value='".$campos[nome_link]."'>
						</td>
					</tr>
					<tr>
						<td>		
							<b>Endereço</b>
						</td>
						<td>	
							<input type='text' name='endereco_link' size='40' maxlength='100' value='".$campos[endereco_link]."'>
						</td>
					</tr>
					<tr>
						<td colspan=2 align=center>
							<br><br><b>Alterar imagem</b><br><br>
							( Resolução ideal 82  pixels  x  46  pixels )<br>
							<input type='file' name='imagem_link' value='".$campos[imagem_link]."'><br></b>
						</td>	
					</tr>	
					<tr>							
						<td colspan=2 align=center>	
							<br>
							<input type='hidden' name='codigo_link' value='".$campos[codigo_link]."'>
							<input type='hidden' name='arquivo' value='alterar_links.php'>
							
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