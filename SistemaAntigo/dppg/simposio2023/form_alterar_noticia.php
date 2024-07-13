<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<!-- Carregar arquivos na mesma pagina-->	
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    
  	<!-- Carregar quantidade de arquivos informada -->   
   <script type="text/javascript">
    $(function arquivo(){
        $("#link_arq").click(function(){
            var num = $('#num_arq').val();
            $("#conteudo_arquivo").load("arquivo.php?num="+num+"");
        });
    })
    </script>
    
</head>    
</html>
<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$codigo_noticia = mysql_real_escape_string($_GET[codigo_noticia]);		

			$sql = "select * from noticias where codigo_noticia='$codigo_noticia'";
			$resultado = mysql_query($sql);
			$campos = mysql_fetch_array($resultado);
	
			$caminho = 'galeria/noticias/'.$campos[arquivo_noticia];
		
			echo " 
			<center><h2> Alterar Noticias</h2></center>
	
			<script src='valida_forms/validar_cad_noticia.js'></script>
			
			<form name='form_alterar_noticia' method='post' onsubmit='javascript: return checknoticia()' action='index.php' enctype='multipart/form-data'>
				<table id='tabela2' align='center' border=0>
					";
					
					//testarse existe algum arquivo dentro da pasta
					  $teste_pasta = scandir('galeria/noticias/'.$campos[arquivo_noticia].'/');
					  $cont=0;
					  if( ($campos[arquivo_noticia] != "") & ( $teste_pasta[2]!=null) )
					  {		
					  			echo '
					  			<tr>
										<td colspan=2><b><br>Se necessário, favor excluir um arquivo ou imagem antes de realizar as demais alterações ! <br><br></td>
								</tr>';
					  			//buscar arquivos .doc .pdf ...	
								$diretorio = scandir('galeria/noticias/'.$campos[arquivo_noticia]);
								if ( count($diretorio) > 2)
								{
									  echo '<tr bgcolor="#E8E8E8">
									  				<td height="25"><strong>&nbsp;&nbsp;Arquivo(s) Anexo(s)</strong>: </td>
				  						     		<td>
													';										
													echo '<table border=0>';
													$i=2;
													while ($i < count($diretorio)) {
														//verificar tipo arquivo									
														$extensao = pathinfo($diretorio[$i], PATHINFO_EXTENSION);
														if( ($extensao!='png') & ($extensao!='jpg') )
														{	
														echo "<tr>
														
																	 <td><a href='galeria/noticias/".$campos[arquivo_noticia]."/".$diretorio[$i]."'/> ".$diretorio[$i]." </a></td>
																	 <input type='hidden' name='id' id='id' value='".$i."'>
																	 <td><a href=\"index.php?arquivo=excluir_documento_noticia.php&codigo_noticia=$campos[codigo_noticia]&nome_arquivo=$diretorio[$i]\"  onClick=\"return confirm('Confirma exclusÃ£o de $diretorio[$i]?')\"> <img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a></td>
															   </tr>";
															   $cont=1;
														}	   
														$i++;
													}
													if($cont==0)
														echo '&nbsp;&nbsp;Sem anexos';
													echo '</table>';
									}
									echo ' 
													</td>
				  								</tr>';
					  		
					  		//listar imagens jpg png gif
							echo '				
								<tr bgcolor="#E8E8E8">
						  				<td height="25" colspan="2"><strong>&nbsp;&nbsp;Galeria</strong>: </td>
						  		</tr>
						  		<tr>		
						  				<td colspan=2>';
						  				
						  				echo ' <table border=0><tr>';
						  					//buscar arquivos na pasta	.jpg .png .gif
											$diretorio = scandir('galeria/noticias/'.$campos[arquivo_noticia]);
											if ( count($diretorio) > 2)
											{		  					
												for ($i=2;$i < count($diretorio); $i++) 
												{
														//verificar tipo arquivo 									
														$extensao = pathinfo($diretorio[$i], PATHINFO_EXTENSION);
														if( ($extensao=='png') | ($extensao=='jpg') | ($extensao=='gif') )
														{
															echo " <td>&nbsp;&nbsp;&nbsp;											
															     		<img src='galeria/noticias/".$campos[arquivo_noticia]."/".$diretorio[$i]."' width='75' height='75'/>
															     		<a href=\"index.php?arquivo=excluir_documento_noticia.php&codigo_noticia=$campos[codigo_noticia]&nome_arquivo=$diretorio[$i]\"  onClick=\"return confirm('Confirma exclusão de $diretorio[$i] ?')\"><img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a>
															       &nbsp;&nbsp;&nbsp;</td>"; 
															$cont=2;          
														}
												}
											}
											if( ($cont==0)|($cont==1) )
													echo '&nbsp;&nbsp;Sem imagens';
											echo '</tr></table>
											 
										<br><br><br></td>
						  		</tr>';
					 }		
					$cont==0;
					echo "
			    	<tr align='left'>
						<td><b>Titulo da Notícia </b></td>
						<td><input type='text' name='titulo_noticia' maxlength='100' size='60' value='$campos[titulo_noticia]'></td>
					</tr>
					<tr align='left' >
						<td valign='top' colspan='2'><b>Conteudo </b>
						<textarea name='conteudo_noticia' rows='10' cols='70'>$campos[conteudo_noticia]</textarea></td>
					</tr>
					<tr>
						<td colspan=2><b><br>O envio de arquivo ou imagens não é obrigatório<br><br>
						<font color=#B22222>Obs: Ao cadastrar imagens utilize uma resolução até 800 pixels x 600 pixels</font></b><br><br></td>
					</tr>
					<tr>
	         		<td colspan='2'><b>Quantidade de arquivos e imagens:</b></td>
	         	</tr>
		         <tr>
			            <td colspan=2>
			            	<div id='conteudo_arquivo'>
			            	
				            <table border='0'> 	
				                <tr>
				                    <td> <input type='text' id='num_arq' name='num_arq' size='2'/> </td>
				                    
				                    <td> <a href='javascript: arquivo();' id='link_arq'><input type='button' value='Ok'></a> </td>
				                </tr>
				            </table>
				            
				            </div>    
							</td>
					</tr>
				</table>
			
				<input type='hidden' name='codigo_noticia' id='codigo_noticia' value='".$campos[codigo_noticia]."'>
				<center><br>
						<input type='hidden' name='arquivo' value='alterar_noticia.php'>
						<input type='submit' name='salvar' value='Salvar' class='submitCinza'>
						<a href='index.php?arquivo=adm_geral.php'><input type='button' value='Voltar'></a>
				</center>		
			</form><br>"; 
		}		
		mysql_close($conexao);
	}	
?>
