<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$sql = "select * from menu_categoria order by posicao_menu asc";
		   $resultado = mysql_query($sql);
		   $resultado1 = mysql_query($sql);	
		   $linhas = mysql_num_rows($resultado);
		   
				$cor_tr = '#9BCD9B';
		
			
			echo "<script src='valida_forms/validar_cad_menu.js'></script>";
		
			echo "
				<br>
				<center>
						
				<table border=0 id='borda2'>
					<tr><td align=center colspan=5><b>Posição do Menu Horizontal Atual</b></td></tr>
					<tr bgcolor=$cor_tr>
						<td align=center width='90px'><b>Posição</b></td>";
								//listar posições dos menus horizontais
								while($campos = mysql_fetch_array($resultado)) 
								{
									echo "<td align=center bgcolor=$cor_td> $campos[posicao_menu] </td>";
								}	
				echo "
					</tr>
					<tr bgcolor=$cor_tr>
						<td align=center width='90px'><b>Nome </b></td>";
								//listar nome dos menus horizontais
								while($campos1 = mysql_fetch_array($resultado1)) 
								{
									echo "<td align=center bgcolor=#F0FFF0> $campos1[nome_categoria]</td>";
								}				
				echo "
					</tr>
				</table>		
		
				<center><h2> Cadastro da Categoria do Menu Horizontal</h2></center>";		
				
				if($linhas < 5) 
				{	
						$op ="select * from menu_categoria order by posicao_menu asc";
						$opcao = mysql_query($op);
						$cont = mysql_num_rows($opcao);
						
						echo "
						<form name='form_cad_menu' method='post' onsubmit='javascript: return checkmenu()' action='index.php' enctype='multipart/form-data'>
						<table border=0>
						<tr>
							<td>	
									<b>Posição do Menu</b>:<br> 
									<select name='posicao_menu'>		
										<option selected>Selecione uma posição</option>";
											$i=1;
											while($i <= $cont+1) 
											{
													echo "<option value=$i>$i</option>";
													$i=$i+1;
											}
							echo"	</select>
							</td>
						</tr>
						<tr>
							<td>	
									<b>Nome do Menu</b>:<br> 
									<input type='text' name='nome_categoria' size='45' maxlength='60'><font color='#FF0000'>*</font>
							</td>		
						</tr>
						</table>			
						<br>
						
						";
					echo "	
							
						<input type='hidden' name='arquivo' value='cad_menu_categoria.php'>
						<input type='submit' name='salvar' value='Salvar' class='submitCinza'>
						<a href='index.php?arquivo=adm_geral.php'><input type='button' value='Voltar'></a>
						</form>
						</center>";
				}else {
							echo "<font color='#B22222'><b>Limite de cadastro atigido</b></font>
							<br><br><a href='index.php?arquivo=adm_geral.php'><input type='button' value='Voltar'></a>";
						}	
		}								
	}
?>