<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$codigo_categoria = mysql_real_escape_string($_GET[codigo_categoria]);
			
			//listar apenas o menu a ser alterado
			$sql1 = "select * from menu_categoria where codigo_categoria='$codigo_categoria'";
			$registro =  mysql_query($sql1); 
			$campos = mysql_fetch_array($registro);	
			$posicao_atual = $campos[posicao_menu];	
				
			//listar todos os menus horizontais
			$sql = "select * from menu_categoria order by posicao_menu asc";
			$resultado = mysql_query($sql);
			$resultado1 = mysql_query($sql);		
			
			$cor_tr = '#9BCD9B';
	
			
			echo "<script src='valida_forms/validar_alterar_menu.js'></script>";
	
			echo "
			<br>
			<center>
					
			<table border=0 id='borda2'>
				<tr>
						<td align=center colspan=5><b>Posição do Menu Horizontal Atual</b></td>
				</tr>
				<tr bgcolor=$cor_tr>
						<td align=center width='90px'><b>Posição</b></td>";
	
							//listar posições dos menus horizontais
							while($campos1 = mysql_fetch_array($resultado)) 
							{
								echo "<td align=center bgcolor=$cor_td> $campos1[posicao_menu] </td>";
							}	
			echo "
				</tr>
				<tr bgcolor=$cor_tr>
						<td align=center width='90px'><b>Nome </b></td>";
						
							//listar nome dos menus horizontais
							while($campos2 = mysql_fetch_array($resultado1)) 
							{
								echo "<td align=center bgcolor=#F0FFF0> $campos2[nome_categoria]</td>";
							}				
			echo "
				</tr>
			</table>		
			
			
			<center><h2> Alterar Categoria do Menu Horizontal</h2></center>";		
			
							
					
					echo "
					<form name='form_cad_menu' method='post' onsubmit='javascript: return checkmenu()' action='index.php' enctype='multipart/form-data'>
					<table border=0>
					<tr>
						<td height=50>	
								<b>Posição Atual do Menu</b>: 
								<select name='posicao_menu'>		
									<option selected> $campos[posicao_menu]</option>";
									$op ="select * from menu_categoria where posicao_menu!=$campos[posicao_menu] order by posicao_menu asc";
									$opcao = mysql_query($op);
									
									while($campo = mysql_fetch_array($opcao)) 
									{
											echo "<option value=$campo[posicao_menu]>$campo[posicao_menu]</option>";
									}
						echo"	</select>
						</td>
					</tr>
					<tr>
						<td>	
								<b>Nome do Menu</b>:<br> 
								<input type='text' name='nome_categoria' size='45' maxlength='60' value='".$campos[nome_categoria]."'><font color='#FF0000'>*</font>
						</td>		
					</tr>
					</table>			
					<br>
					
					";
			echo "
			<input type='hidden' name='codigo_categoria' value='$codigo_categoria'>
			<input type='hidden' name='posicao_atual' value='$posicao_atual'>		
			<input type='hidden' name='arquivo' value='alterar_menu_categoria.php'>
			<input type='submit' name='salvar' value='Salvar' class='submitCinza'>
			<a href='index.php?arquivo=adm_geral.php'><input type='button' value='Voltar'></a>
			
			</form>";
		}
		mysql_close($conexao);
	}
?>
