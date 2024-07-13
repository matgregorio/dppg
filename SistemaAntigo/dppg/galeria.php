<?php
	/*echo '<br>Simpósio 2011<div id="galeria"><ul>';
	
	echo '<a href="images/fotos/foz.jpg" rel="lightbox[roadtrip]">
			<img src="images/fotos/foz.jpg" class="thumb"></a>
			<a href="images/fotos/foz1.jpg" rel="lightbox[roadtrip]">
			<img src="images/fotos/foz1.jpg" class="thumb"></a>
			
			';
			
	echo '</ul></div>';*/
	
	include('includes/config2.php');
	
	echo '<br><center><i><font size="4">Galeria de fotos Simpósio</font></i></center><br>';
	

   echo '<center><table border="0" width="80%">';  
      
   $cont = 0;
   	
   $sql = "select  distinct a.ano, alb.pasta  from album alb, ano a where alb.pasta = codigo_ano";
   $resultado = mysql_query($sql);
   
   while($campos = mysql_fetch_array($resultado))
   {   		 	
   			
   	if($cont % 2 == 0)
  		{
  			echo '<tr bgcolor="#E0EEEE">';
  			echo '<td><center><a href="simposio.php?arquivo2=fotos.php&codigo='.$campos[pasta].'" ><img src="images/paste.png" border="0" width="20%"><br>&nbsp;<b>'.$campos[ano].'</b></a></center></td>';			
		}	
		else 
			{
     			echo '<td><center><a href="simposio.php?arquivo2=fotos.php&codigo='.$campos[pasta].'" ><img src="images/paste.png" border="0" width="20%"><br>&nbsp;<b>'.$campos[ano].'</b></a></center></td>';
     			echo '</tr>';
			}			
											
		$cont++; 
   }
   
  echo  '</table></center><br>';
?>