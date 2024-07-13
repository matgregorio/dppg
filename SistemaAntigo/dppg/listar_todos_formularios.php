<?php

	include("includes/config2.php");

	
	
	//listar todos formularios
	$sql1= "select * from formularios order by codigo_formulario desc";
	
	$resultado1 = mysql_query($sql1);
	
	echo '<br><br><br><b>&nbsp&nbspDocumentos</b><br>
	<hr>
	<table border=0>
	';	
	
				
		while ($campos1 = mysql_fetch_array($resultado1)) 
		{
			//verifica a extansão do arquivo para escolher a imagem
			$extensao = pathinfo($campos1[arquivo_formulario], PATHINFO_EXTENSION);
			if($extensao=='pdf')
				{
					echo '<tr height=35><td><img src="images/arquivo_pdf.png" right=23 width=23></td>';		
				}
				elseif($extensao=='doc') 
					  { 
					  		echo '<tr height=35><td><img src="images/arquivo_doc.png" right=23 width=23></td>';
					  }
					  elseif($extensao=='txt')
					  {
							echo '<tr height=35><td><img src="images/arquivo_txt.png" right=23 width=23></td>';		
					  }
					  elseif($extensao=='xls')
							  { 
							  		echo '<tr height=35><td><img src="images/arquivo_xls.png" right=23 width=23></td>';
							  }
							  elseif($extensao=='ppt')
							  { 
							  		echo '<tr height=35><td><img src="images/arquivo_ppt.png" right=23 width=23></td>';
							  }
							  elseif($extensao=='docx')
							  		{
							  			echo '<tr height=35><td><img src="images/arquivo_docx.png" right=23 width=23></td>';
							  		}
							  		elseif($extensao=='xlsx')
							  			{
							  				echo '<tr height=35><td><img src="images/arquivo_xlsx.png" right=23 width=23></td>';
							  			}
							  			else 
							  			{	 
							  				echo '<tr height=35><td><img src="images/arquivo_xxx.png" right=23 width=23></td>';
							  			}
						
			
			echo '<td><a href="galeria/formularios/'.$campos1[arquivo_formulario].'" target="_blank">  '.$campos1[titulo_formulario].' </td></tr> ';

		}
		echo '
		
		</table>
		
		<hr>
		<center><a href="index.php"><input type="button" value="Voltar"></a></center>';
	
			  
	mysql_close($conexao);	
?>

	
