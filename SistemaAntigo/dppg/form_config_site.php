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
	
			echo "<script src='valida_forms/validar_adm.js'></script>";
			
			echo "	
				<form name='form_config_site' method='post' onsubmit='javascript: return checkcontatos()' action='index.php' enctype='multipart/form-data'>
				   <font size=5><br><b><center> Configuração Global - Site </center></b></font>
		
					<table border=0 align=center>
					<tr>									
							<td><b> Titulo da Janela Site: </b></td>
							<td><input type='text' name='titulo_janela' size='45' maxlength='100' value='$campos[titulo_janela]'></td>
					</tr>
					<tr>									
							<td><b> Nome do Site: </b></td>
							<td><input type='text' name='nome_site' size='70' maxlength='100' value='$campos[nome_site]'></td>
					</tr>			
					<tr>							
							<td><b>Titulo do Rodapé: </b></td>
							<td><input type='text' name='titulo_rodape' size='70' maxlength='100' value='$campos[titulo_rodape]'></td>
					</tr>			
					<tr>	
							<td><b>Instituição: </b></td>
							<td><input type='text' name='instituicao_rodape' size='70' maxlength='150' value='$campos[instituicao_rodape]'></td>
					</tr>			
					<tr>		
							<td><b>Endereço do setor: </b></td>
							<td><input type='text' name='endereco_rodape' size='70' maxlength='150' value='$campos[endereco_rodape]'></td>
					</tr>
					<tr>		
							<td><b>Telefone: </b></td>
							<td><input type='text' name='telefone_rodape' size='25' maxlength='15' value='$campos[telefone_rodape]'></td>
					</tr>			
					<tr>		
							<td><b>Email: </b></td>
							<td><input type='text' name='email_rodape' size='45' maxlength='100' value='$campos[email_rodape]'></td>
					</tr>			
					<tr>		
							<td><b> Webmasters reponsavéis:</b></td>
							<td><input type='text' name='desenvolvido' size='45' maxlength='100' value='$campos[desenvolvido]'></td>
					</tr>
					";
					
					echo "
					<input type='hidden' name='codigo_site' value='".$campos[codigo_site]."'>
					<input type='hidden' name='arquivo' value='alterar_site.php'>
					
					<tr>
						<td colspan=2 align=center>
								<input type='submit' name='salvar' value='Alterar'>
								<a href='index.php?arquivo=adm_geral.php'><input type='button' value='Voltar'></a>
						</td>
					</tr>				
					</table>
				
				</form>";
				
				echo "<br><br>";
		}	
		mysql_close($conexao);
	}
?>
