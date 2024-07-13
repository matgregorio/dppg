
<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
  			include("includes/config2.php");
  			
  			$codigo_sub_subcategoria = mysql_real_escape_string($_GET[codigo_sub_subcategoria]);
			
			$sql_dados = "select * from menu_sub_subcategoria where codigo_sub_subcategoria=$codigo_sub_subcategoria";  			
  			$result_dados = mysql_query($sql_dados);
  			$dadoss=mysql_fetch_array($result_dados);
			
			//subcategoria
			$sql = "select * from menu_subcategoria where codigo_subcategoria=$dadoss[menu_subcategoria]";
		   $resultado = mysql_query($sql);
		   $resultx = mysql_query($sql);
		   $camposx = mysql_fetch_array($resultx);
		   
		   //categoria
			$sql0 = "select * from menu_categoria where codigo_categoria=$camposx[categoria]";
		   $resultado0 = mysql_query($sql0);
		   
			
			echo "  
				<center><h2> Cadastro da Sub-Subcategoria Menu Horizontal</h2></center>
		
				<script src='valida_forms/validar_cadsub_menu.js'></script>
				<form name='form_cadmenu_sub_subcategoria' method='post' onsubmit='javascript: return checkmenu()' action='index.php'>
					<table align='center'>
						<tr align=center>
		 						<td colspan=2><b> Categoria: </b>&nbsp;&nbsp; 
				 						<select name='combo_categoria' id='combo_categoria'>";
				    							while($campos0 = mysql_fetch_array($resultado0)) 
				  								{
									  				echo"<option value=$campos0[codigo_categoria]> $campos0[nome_categoria] </option> ";
									 			}
										echo "										
										</select>
		 						</td>			
						</tr>						
						<tr align=center>
							<td colspan=2><b> Subategoria: </b>&nbsp;&nbsp; 
							
							<select id='combo_subcategoria' name='combo_subcategoria' size='1'>";
							
				  			while($campos = mysql_fetch_array($resultado)) 
				  			{
				  				echo"<option value=$campos[codigo_subcategoria]> $campos[nome_subcategoria] </option> ";
				 			}
				 			echo "</select>
				 			</td>
					   </tr>
					   <tr>
					   	<td colspan=2>
					   		<div id=posicao>
					   		
					   		</div>
					   	</td>
					   </tr>
				    	<tr>
						
							<td align='left'><b>Nome da Sub-Subcategoria </b></td>
							<td align='left'><input type='text' name='nome_sub_subcategoria' maxlength='60' size='50' value='".$dadoss[nome_sub_subcategoria]."'></td>
							
						</tr>
						<tr align='left' >
							<td valign='top' colspan='2'><b>Conteudo </b>
							<textarea name='conteudo_sub_subcategoria' rows='10' cols='70'>$dadoss[conteudo_sub_subcategoria]</textarea></td>
						</tr>
					</table>
				
					
					<center>
						<input type='hidden' name='codigo_sub_subcategoria' value='$codigo_sub_subcategoria'>		
						<input type='hidden' name='arquivo' value='alterar_menu_sub_subcategoria.php'>
						<input type='submit' name='salvar' value='Salvar' class='submitCinza'>
						<a href='index.php?arquivo=adm_geral.php'><input type='button' value='Voltar'></a>
					</center>
					</form><br><br>";  
			}		
			mysql_close($conexao);
	}		
?>

