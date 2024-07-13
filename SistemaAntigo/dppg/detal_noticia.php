<html>
<head>
	  <!-- O arquivo lightbox.css faz parte da biblioteca e � necess�ria sua inclus�o-->
	  <link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
	  <!-- <link rel="stylesheet" href="css/galeria.css" type="text/css" media="screen" /> -->
	  
	  <!-- incluindo os arquivos da biblioteca LightBox-->
	  <script type="text/javascript" src="js/prototype.js"></script>
	  <script type="text/javascript" src="js/scriptaculous.js?load=effects"></script>
	  <script type="text/javascript" src="js/lightbox.js"></script>

</head>
	
<?php	
	include("includes/config2.php");
    include_once ('trataInjection.php');

    if (protectorString($_GET[codigo_noticia]))
        return;

    $codigo_noticia = mysql_real_escape_string($_GET[codigo_noticia]);
	$sql= "select * from noticias where codigo_noticia=$codigo_noticia";	
	$resultado = mysql_query($sql);
	$campos = mysql_fetch_array($resultado);
	
	echo '<br><br><center><b> Notícia </b></center>

	<table id="tabela2" border=0" align="center">
		  	<tr bgcolor="#E8E8E8">
		   	 <td height="35"><strong>&nbsp;&nbsp;Título</strong>:</td>
		    	 <td> &nbsp;&nbsp;'.$campos[titulo_noticia].'</td>
		   </tr>
		   <tr bgcolor="#E8E8E8">
		    	<td height="25"><strong>&nbsp;&nbsp;Data</strong>:</td>
		      <td>&nbsp;&nbsp;';
						echo date("d/m/Y", strtotime($campos[data_noticia]));
		echo '</td>
		  	</tr>
		   <tr bgcolor="#E8E8E8">
		   	 <td height="25"><strong>&nbsp;&nbsp;Hora</strong>:</td>
		   	 <td>&nbsp;&nbsp;';
						echo date("H:m:s", strtotime($campos[hora_noticia]));
		echo ' </td>
		  </tr>
		  <tr bgcolor="#E8E8E8">
		   	 <td colspan=2 height="25"><strong>&nbsp;&nbsp;Conteudo</strong>:</td>
		  </tr>
		  <tr>
		  		<td colspan=2> '.$campos[conteudo_noticia].'</td>
		  </tr>';
		  
		  //testarse existe algum arquivo dentro da pasta
		  $teste_pasta = scandir('galeria/noticias/'.$campos[arquivo_noticia].'/');
		  $cont=0;
		  if( ($campos[arquivo_noticia] != "") & ( $teste_pasta[2]!=null) )
		  {
		  		//listar arquivos anexos .doc .xls .pdf ...
		  		echo '
		  		<tr bgcolor="#E8E8E8">
		  				<td height="25"><strong>&nbsp;&nbsp;Arquivo(s) Anexo(s)</strong>: </td>
		  				<td>';
		  				
		  				//buscar arquivos na pasta	
						$diretorio = scandir('galeria/noticias/'.$campos[arquivo_noticia]);
						if ( count($diretorio) > 2){		  					
							for ($i=2;$i < count($diretorio); $i++) {
									//verificar tipo arquivo									
									$extensao = pathinfo($diretorio[$i], PATHINFO_EXTENSION);
									if( ($extensao!='png') & ($extensao!='jpg') )
									{
										echo '<br><a href="galeria/noticias/'.$campos[arquivo_noticia].'/'.$diretorio[$i].'"/> '.$diretorio[$i].' </a><br><br>';
										$cont = 1;
									}
							}
							
						}
						if($cont==0)
							echo '&nbsp;&nbsp;Sem anexos';
							
						echo ' 
						</td>
				</tr>';
				//listar imagens jpg png gif
				echo '				
				<div id="galeria">
				
 				<ul>
	 				<tr bgcolor="#E8E8E8">
			  				<td height="25" colspan="2"><strong>&nbsp;&nbsp;Galeria</strong>: </td>
			  		</tr>
			  		<tr>		
			  				<td colspan=2>';
			  				
			  					//buscar arquivos na pasta	
								$diretorio = scandir('galeria/noticias/'.$campos[arquivo_noticia]);
								if ( count($diretorio) > 2){		  					
									for ($i=2;$i < count($diretorio); $i++) {
											//verificar tipo arquivo 									
											$extensao = pathinfo($diretorio[$i], PATHINFO_EXTENSION);
											if( ($extensao=='png') | ($extensao=='jpg') | ($extensao=='gif') )
											{
												echo '
															<a href="galeria/noticias/'.$campos[arquivo_noticia].'/'.$diretorio[$i].'" alt="" rel="lightbox[roadtrip]"/>											
												     		<img src="galeria/noticias/'.$campos[arquivo_noticia].'/'.$diretorio[$i].'" alt="" class="thumb"/></a>
												     ';   
												$cont=2;       
											}
										}
								}
								if( ($cont==0)|($cont==1) )
									echo '&nbsp;&nbsp;Sem imagens';
							
								echo ' 
							</td>
			  		</tr>
			  	</ul>
			  	
			  	</div>';
		  }
		  $cont=0;
  echo '</table>
  
  <center><a href="index.php"><input type="button" value="Voltar"></a></center>
  <br><br>
  ';
 
	mysql_close($conexao);
?>

</html>
