<?php
		include("includes/config2.php");

		$sql = "select * from links_externos where tipo_link='2' order by nome_link desc";
		 
		$resultado = mysql_query($sql);		
		
		echo '<center><br><h2><img src="images/icone_seta.jpg" width="10">Simpósios</h2></center>';
		
		
		echo '<table align=center width=20%>
		
			';
				while ($campos = mysql_fetch_array($resultado)) 
				{
									echo '<tr>
													<td height=25><img src="images/go-next.png" width=25 heght=25></td>
													<td align=center height=25><a href="'.$campos[endereco_link].'" target="_blank">'.$campos[nome_link].'</a></td>
											</tr>';							
				}	
		echo '
		
		</table>';				
	
		mysql_close($conexao);
?>