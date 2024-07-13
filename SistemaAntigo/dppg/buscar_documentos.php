<?php

	include ('includes/config2.php');
	include_once ('trataInjection.php');

	if (protectorString($_POST['busca']))
		return;
	
	if (isset($_POST['busca']))
	{
		$queryString = $_POST['busca'];
			
		$queryF = "select * from formularios where titulo_formulario like '$queryString%'";
		$resul = mysql_query($queryF);
		
		echo '<table border=0>';
		while(  $camp = mysql_fetch_array($resul) ) {
			
				//verifica a extansão do arquivo para escolher a imagem
				$extensao = pathinfo($camp[arquivo_formulario], PATHINFO_EXTENSION);

				if($extensao=='pdf')
				{
					echo '<tr height=35><td><img src="images/arquivo_pdf.png" right=23 width=23></td>';		
				}
				elseif(($extensao=='doc') or ($extensao=='docx'))
					  { 
					  		echo '<tr height=35><td><img src="images/arquivo_doc.png" right=23 width=23></td>';
					  }
					  elseif($extensao=='txt')
					  {
							echo '<tr height=35><td><img src="images/arquivo_txt.png" right=23 width=23></td>';		
					  }
					  elseif(($extensao=='xls') or ($extensao=='xlsx'))
							  { 
							  		echo '<tr height=35><td><img src="images/arquivo_xls.png" right=23 width=23></td>';
							  }
							  elseif(($extensao=='ppt') or ($extensao=='pot'))
							  { 
							  		echo '<tr height=35><td><img src="images/arquivo_ppt.png" right=23 width=23></td>';
							  }
							  else 
							  		{ 
							  		echo '<tr height=35><td><img src="images/arquivo_xxx.png" right=23 width=23></td>';
							  		}
			echo "<td><a href=\"index.php?arquivo=excluir_formulario.php&codigo_formulario=$camp[codigo_formulario]\"  onClick=\"return confirm('Confirma exclusão de $camp[titulo_formulario]?')\">  $camp[titulo_formulario] <img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a></td></tr>";	
		
		}		
			echo '</table><hr>';		
	}

		
?>
