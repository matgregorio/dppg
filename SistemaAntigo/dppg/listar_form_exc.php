<?php
	session_start();

    include_once ('trataInjection.php');

    if (protectorString($_POST[categoria]) || protectorString($_POST[subcategoria]) || protectorString($_POST[sub_subcategoria]))
        return;

	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
					include ('includes/config2.php');
					
					echo '<br><br><center><b>&nbsp&nbspExcluir Documentos</b></center><br><hr>
					<table border=0 align=center>
					';	

					$codigo_menu = mysql_real_escape_string($_POST[categoria]);
					$codigo_submenu = mysql_real_escape_string($_POST[subcategoria]);
					$codigo_sub_submenu = mysql_real_escape_string($_POST[sub_subcategoria]);				
					
					//selecionar formularios/documentos de acordo com os combobox selecionados
					if( ($codigo_menu==0)&($codigo_submenu==0)&($codigo_sub_submenu==0) ){
										
								//buscar e listar todos formularios					
								$busca_forms = mysql_query("select * from formularios");
								
					}
					elseif( ($codigo_menu != 0)&($codigo_submenu==0)&($codigo_sub_submenu==0) ) {
						
								//buscar e listar todos formularios referente a um menu					
								$busca_forms = mysql_query("select * from formularios where codigo_menu='$codigo_menu'");
							
						 }					
						 elseif( ($codigo_menu != 0)&($codigo_submenu != 0)&($codigo_sub_submenu==0)  ) {
								
								//buscar e listar todos formularios referente a um submenu					
								$busca_forms = mysql_query("select * from formularios where codigo_menu='$codigo_menu' and codigo_submenu='$codigo_submenu'");
							
							  }
							  elseif( ($codigo_menu != 0)&($codigo_submenu != 0)&($codigo_sub_submenu!=0)  ) {
							  		
							  			//buscar e listar todos formularios referente a um sub submenu					
										$busca_forms = mysql_query("select * from formularios where codigo_menu='$codigo_menu' and codigo_submenu='$codigo_submenu' and codigo_sub_subcategoria='$codigo_sub_submenu'");
									}
									else {
												echo '<br><center><font color=#006400><b>Nenhum documento encontrado !</b></font><center><br>';
										  }	
							  
						 	
					while( $campo = mysql_fetch_array($busca_forms) ) {
							
						//verifica a extansão do arquivo para escolher a imagem
						$extensao = pathinfo($campo[arquivo_formulario], PATHINFO_EXTENSION);
			
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
					
						echo "<td><a href=\"index.php?arquivo=excluir_formulario.php&codigo_formulario=$campo[codigo_formulario]\"  onClick=\"return confirm('Confirma exclusão de $campo[titulo_formulario]?')\">  $campo[titulo_formulario] <img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a></td></tr>";
						
					}	
						
				}
				echo "
				</tr>
				</table><hr>";	
		mysql_close($conexao);
		echo '<center><br><a href="index.php?arquivo=listar_excluir_formulario.php"><input type="button" value="Voltar"></a><br><br></center>'; 		
		}
		
	