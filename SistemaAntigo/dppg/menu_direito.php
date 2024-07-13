<?php	

	include('includes/config2.php');
		 
	echo '<div id="lista_vertical_dir" class="barra_rolagem_direita">';	
	
	echo '<table align=center>
			<tr>
				<td>';
								
						if ($_SESSION['logado_site_dppg'])
						{				
								include('sistema_logado.php');
											
						} else
								{
									include('sistema_naologado.php');	
								}		
								
						/*carregar links direito
						echo'<div id="titulo">';	
							echo '<center>Links</center><br>';
						echo'</div>';
						include("links_externos.php");
						*/
			
			echo '</td>
			</tr>
	</table>';
	
	echo '</div>';
	
?>
