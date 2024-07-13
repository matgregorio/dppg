<?php

include('includes/config2.php');

		//mostrar menu de sistemas
		echo'<div id="titulo">';	
				echo '<center>Sistemas</center><br>';
		echo'</div>';					
		
		$sql = " select * from menu_sistemas where codigo_menu=$_SESSION['codigo_menu']";					  		
		$resultado = mysql_query($sql);
		
		echo ' 
			<div id="menu">
			  <ul>';
			while($campos = mysql_fetch_array($resultado))
			{
				echo '<li><a href="index.php?arquivo=principal_subsistemas.php"><img src="images/seta_menu.gif"> '.$campos[nome_menu].'</a></li>';				
		  				
		  		$sql1 = "select * from menu_sistemas_subcategoria where codigo_menu='$campos[codigo_menu]' order by codigo_subcategoria asc";
				$resultado1 = mysql_query($sql1);		  				
		  		echo '<div class="menu-sub">';
		  			while($campos1 = mysql_fetch_array($resultado1))
		  			{
		  					
						echo '<li><a href="index.php?arquivo='.$campos1[link_subcategoria].'">&nbsp;&nbsp;&nbsp;&nbsp;
									'.$campos1[nome_subcategoria].'</a></li>';
											  			
		  			}	
		  		echo '</div>';
   		}
   		echo '</ul>
   		</div>';
   		
mysql_close($conexao);	
?>