<?php
	
		include('includes/config2.php');
				
		$subcategoria = mysql_real_escape_string($_POST[subcategoria]);
		$categoria = mysql_real_escape_string($_POST[categoria]);
		
		if($categoria == 0) 
		{
			$sql = "select * from formularios";	
			$resultado = mysql_query($sql);
			echo '<br><br><b>&nbsp&nbspTodos Documentos</b>';
		}
		elseif($subcategoria == 0) 
			{
				$sql = "select * from formularios where codigo_menu=$categoria";	
				$resultado = mysql_query($sql);
				echo '<br><br><b>&nbsp&nbspDocumentos da Categoria</b>';
			}	
			else {
					   $sql = "select * from formularios where codigo_submenu=$subcategoria";	
				   	$resultado = mysql_query($sql);
				   	echo '<br><br><b>&nbsp&nbspDocumentos da Subcategoria</b>';
			     }
			  	
		echo '
		<br>
		<hr>
		<table>';
		
		$linha = mysql_num_rows($resultado);
		if($linha == 0) echo "<tr><td><font color=#006400><b> >> Nenhum documento encontrado !</b></font></td></tr>"; 
			  	
		while($campos = mysql_fetch_array($resultado)) 
		{
			//verifica a extansão do arquivo para escolher a imagem
			$extensao = pathinfo($campos[arquivo_formulario], PATHINFO_EXTENSION);
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
							  		
			echo '<td><a href="galeria/formularios/'.$campos[arquivo_formulario].'" target="_blank">  '.$campos[titulo_formulario].' </td></tr> ';
		}			
		
		echo '
		</table>
		<hr>
		
		<center><a href="index.php"><input type="button" value="Voltar"></a></center>';
		
		mysql_close($conexao);
?>
