<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
  			include("includes/config2.php");
			
			$sql = "select * from menu_sistemas";
		   $resultado = mysql_query($sql);
			
			echo "  
			
				<center><h2> Cadastro da Subcategoria Menu Sistemas</h2></center>
		
				<script src='valida_forms/validar_cad_subcategoria_sistema.js'></script>
				
				<form name='form_cadsistema_subcategoria' method='post' onsubmit='javascript: return checksistema()' action='index.php'>
				<table  align='center'>
					<tr>
						<td align='left'><b> Categoria: </b></td> 
						<td align='left'>
						<select name='combo_categoria' size='1'>";
			  			while($campos = mysql_fetch_array($resultado)) 
			  			{
			  				echo"<option value=$campos[codigo_menu]> $campos[nome_menu] </option> ";
			 			}
			 			echo "</select>
			 			</td>
				   </tr>
			    	<tr>
						<td align='left'><b>Nome da Subcategoria </b></td>
						<td align='left'><input type='text' name='nome_subcategoria' maxlength='60' size='50'></td>
					</tr>
					<tr>
						<td align='left'><b>Link arquivo php da Subcategoria </b></td>
						<td align='left'><input type='text' name='link_subcategoria' maxlength='100' size='50'><b>Ex: link.php</b></td>			
					</tr>
				</table>";
				
				echo "
				<center>
					<input type='hidden' name='arquivo' value='cad_sistema_subcategoria.php'>
					<input type='submit' name='salvar' value='Salvar' class='submitCinza'>
					<a href='index.php?arquivo=adm_geral.php'><input type='button' value='Voltar'></a>
				</center>
					
				</form><br>"; 
		}		
		mysql_close($conexao);
	}	
?>
