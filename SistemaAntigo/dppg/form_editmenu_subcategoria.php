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
			
			$codigo_subcategoria = mysql_real_escape_string($_GET[codigo_subcategoria]);
			
			$sql = "select * from menu_subcategoria where codigo_subcategoria='$codigo_subcategoria'";
			$resultado = mysql_query($sql);
			$campos = mysql_fetch_array($resultado);
			
			echo " 
			<center><h2> Editar Subcategoria do Menu Horizontal</h2></center>
			
			<script src='valida_forms/validar_alterarsub_menu.js'></script>
			
			<form name='form_alterarmenu_subcategoria' method='post' onsubmit='javascript: return checkmenu()' action='index.php'>
					<table  align='center'>
					<tr>
						<td align='left'><b> Categoria: </b></td> 
						<td align='left'>";
						
						$sql1 = "select * from menu_categoria where codigo_categoria=$campos[categoria]";
						$resultado1 = mysql_query($sql1);			
						$campos1 = mysql_fetch_array($resultado1);
						
						echo "<select name='combo_categoria' size='1'>";
							
								echo"<option selected value=$campos1[codigo_categoria]> $campos1[nome_categoria] </option> ";
							
								//criando a query
								$sql2 = "select * from menu_categoria where codigo_categoria!=$campos[categoria]";
								$resultado2 = mysql_query($sql2);
								
								while($dados = mysql_fetch_array($resultado2))
								{
										echo '<option value='.$dados[codigo_categoria].'>'.$dados[nome_categoria].'</option>';
								}
			  				
			 			echo "</select>
			 			</td>
				   </tr>
			    	<tr>
						<td align='left'><b>Nome da Subcategoria </b></td>
						<td align='left'><input type='text' name='nome_subcategoria' maxlength='60' size='50' value='".$campos[nome_subcategoria]."'></td>
					</tr>
					<tr align='left' >
						<td valign='top' colspan='2'><b>Conteudo </b>
						<textarea name='conteudo_subcategoria' rows='10' cols='70'>$campos[conteudo_subcategoria]</textarea></td>
					</tr>
					</table>";
			
			echo "
			<center>
				<input type='hidden' name='codigo_subcategoria' value='$codigo_subcategoria'>		
				<input type='hidden' name='arquivo' value='alterar_menu_subcategoria.php'>
				<input type='submit' name='salvar' value='Salvar' class='submitCinza'>
				<a href='index.php?arquivo=adm_geral.php'><input type='button' value='Voltar'></a>
			</center>
			</form><br><br>"; 
		}		
		mysql_close($conexao);
	}	
?>
