<?php
 	include('includes/config2.php');
	include_once ('trataInjection.php');

		if (protectorString($_GET[codigo_subcategoria]))
			return;

 		$codigo = mysql_real_escape_string($_GET[codigo_subcategoria]);
 		 
		$sql = "select * from menu_subcategoria where codigo_subcategoria='$codigo'";
  		$resultado = mysql_query($sql);
  		$campos = mysql_fetch_array($resultado);
		
		echo '<center><br><h2><img src="images/icone_seta.jpg" width="10">' .$campos[nome_subcategoria].'</h2></center>';
		
		echo '<center>';
		
		//conteudo do site
		if ($campos[conteudo_subcategoria] != '')
		{
			echo '' .$campos[conteudo_subcategoria].'<br>';       	
      }
      	      
		echo '</center>';      
      
      
      //listagem dos formularios
      $sql1= "select * from formularios where codigo_submenu='$codigo' and codigo_sub_subcategoria='0'";
      $resultado1 = mysql_query($sql1);            
   	
			//verifica se a consulta no banco obteve resultados validos
	      $num_linhas = mysql_num_rows($resultado1);
	      if($num_linhas != 0 )
	      {
				echo '<br><br><br><b>&nbsp&nbspDocumentos</b><br>
						<hr>
							<table border=0>';
	      	
	      //ler todas as linhas do banco de dados
	     
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
			<hr><br><br>';
       }	
      /*
      if ($campos[link_arquivo] != ''){
      	include ("$campos[link_arquivo]");
      } 
      */
  mysql_close($conexao);
 ?>
