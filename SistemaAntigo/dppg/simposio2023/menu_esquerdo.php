<?php

		include("includes/config2.php");
		
		$query = "select * from usuarios where cpf=$_SESSION[cpf]";
		$result = mysql_query($query);
		$reg = mysql_fetch_array($result);
		
		$sql = "select * from participa_grupos where cpf=$_SESSION[cpf]";
		$resultado = mysql_query($sql);
		$campos = mysql_fetch_array($resultado);
		
		$sql1 = "select * from grupo_usuario where codigo_grupo=$campos[codigo_grupo]";
		$resultado1 = mysql_query($sql1);
		$campos1 = mysql_fetch_array($resultado1);
		

echo '<div id="lista_vertical_esq" class="barra_rolagem_esq">';
		//menu esquerdo			 		 
		
		echo "<table align='center'>
		<tr><td>";
		if ($_SESSION['menu_sistema']) 
	  	{
	  		
					echo '<table border=0 align=center>
							<tr align=left>
									<td><b>'.$campos1[nome_grupo].'</b></td>
									<td><b><font color="#006400"> Logado !</b></font></td>
							</tr>	
							</table>';
		
						
				echo'<div id="titulo">';				
					echo '<center>Sistema '.$_SESSION['nome_menu'].'</center><br>';
				echo'</div>';			
	
				include($_SESSION['link_menu']);
				
				echo'<div id="titulo">';	
						echo '<center><div id="link2"><a href=index.php?arquivo=logout_subsistema.php>Sair Sub-Sistema</a></div></center><br>';
				echo'</div>';				
		}			
		else
			if ($_SESSION['logado_site_dppg'])
			{	
				echo '<div id="centralizar">';
					echo '<table border=0>
							<tr>
									<td colspan=2 height=25><b>Usuário Logado !</b></td>							
							</tr>
							<tr align=left>
									<td><b>Nome:</b></td>
									<td>'.$reg[nome].'</td>
							</tr>
							<tr align=left>
									<td><b>Nível:</b></td>
									<td>'.$campos1[nome_grupo].'</td>
							</tr>	
							</table>';
				echo '</div>';
			}
			else 
				{
					
				 		echo'<br><br><br><center><b> Nenhum usuario logado !</b><br><br><br>
				 		
						<a href="index.php?arquivo=sobre.php"> 
			 			<img src="images/site/sobre.png" width="100" height="80"></a></center>';
				 		
				 		//links externos laterais
				 		include('links_externos_laterais.php');
				 		
				
				}		
			
	echo "</td>
		</tr></table>";
echo '</div>';				
?>
