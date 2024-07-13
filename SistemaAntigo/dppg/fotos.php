<?php

	include('includes/config2.php');
    include_once ('trataInjection.php');

    if (protectorString($_GET[codigo]))
        return;

	$sql = "select * from album alb, ano a where  a.codigo_ano = alb.pasta and alb.pasta = '$_GET[codigo]'";
	$resultado = mysql_query($sql);
	$campos = mysql_fetch_array($resultado);
	
	echo '<br><center><i><font size="4">Álbum '.$campos[ano].'</font></i></center><br>';
	
	mysql_data_seek($resultado, 0);
	
	//echo '<center><table border="0" width="80%">';
	
	echo '<center><table border="0" width="80%">';  
	$cont = 0;
	while($campos = mysql_fetch_array($resultado))
	{
		 
		 
		if($cont % 2 == 0)
  		{
  			echo '<tr bgcolor="#E0EEEE">';
  			echo '<td><ul>';
  			echo '<center><a href="images/fotos/'.$campos[ano].'/'.$campos[nome_foto].'" rel="lightbox[roadtrip]">
					<img src="images/fotos/'.$campos[ano].'/'.$campos[nome_foto].'" class="thumb">'.$campos[nome_foto].'</center></a>';
			echo '</ul></td>';
			
		}	
		else 
			{
				echo '<td><ul>';
  				echo '<center><a href="images/fotos/'.$campos[ano].'/'.$campos[nome_foto].'" rel="lightbox[roadtrip]">
						<img src="images/fotos/'.$campos[ano].'/'.$campos[nome_foto].'" class="thumb">'.$campos[nome_foto].'</center></a>';
				echo '</ul></td>';	     			
     			echo '</tr>';
			}			
											
		$cont++; 
	}
	
 echo  '</table></center><br>';


















?>