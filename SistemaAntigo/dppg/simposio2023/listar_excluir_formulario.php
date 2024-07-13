<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			$sql = "select * from formularios order by codigo_formulario desc"; 
			$resultado = mysql_query($sql);
			$linha = mysql_num_rows($resultado);
?>			
			<script>
				<!-- Script busca de arquivos por nome --> 
				jQuery('document').ready(function(){
					jQuery('#loading').hide();
					jQuery('#buscarn').click(function(){
						jQuery('#buscarn').val('');
					});
					jQuery('#buscarn').keyup(function(){
						jQuery('#loading').ajaxStart(function(){
							jQuery('#alvo').hide();
							jQuery('#loading').show();	
						});
						jQuery('#loading').ajaxStop(function(){
							jQuery('#loading').hide();	
						});
						jQuery.post('buscar_documentos.php',
						{busca: jQuery('#buscarn').val()},
						function(data){
							if (jQuery('#buscarn').val()!=''){
								jQuery('#alvo').show();
								jQuery('#alvo').empty().html(data);
							}
							else{
								jQuery('#alvo').empty();
							}
						}
						);
					});
				});
				
				<!-- Script combobox listar aquivos menu subcategoria --> 
				jQuery(document).ready(function(){
            jQuery('#categoria').change(function(){
                jQuery('#subcategoria').load('subcategoria_um.php?codigo_subcategoria='+jQuery('#categoria').val() );

            });
        		});
        		
        		<!-- Script combobox listar aquivos menu sub subcategoria --> 
				jQuery(document).ready(function(){
            jQuery('#subcategoria').change(function(){
                jQuery('#sub_subcategoria').load('sub_subcategoria_um.php?codigo_sub_subcategoria='+jQuery('#subcategoria').val() );

            });
        		});
        		
			</script>
<?php			
			echo '<br><br><center><b>&nbsp&nbspExcluir Documentos</b></center><br>
					
					<div id="buscan">
					
	               <form name="form_list_form" method="post" action="index.php" onsubmit="javascript: return checklistform()" enctype="multipart/form-data">
																
								<b>Listar documentos selecionando menus OU pelo nome do arquivo:<br></b><br><hr><br>
								
								Arquivos menu: <br>
								<select name="categoria" id="categoria" style="min-width:200px">
									<option selected value=0> Todos arquivos </option>';
										//listar todos os menus
										include("includes/config2.php"); 
								       $result = mysql_query("select * from menu_categoria");
										 
								       while($row = mysql_fetch_array($result) ){
								             echo "<option value='".$row['codigo_categoria']."'>".$row['nome_categoria']."</option>";
								
								       }
								       
								       echo '
								</select>															               		
	              			<br>
	              			<br>Arquivos Sub menus:<br> 
								
								<select name="subcategoria" id="subcategoria" style="min-width:200px">
		    							<option selected value=0> Todos arquivos </option>
								</select>
								
								<br>
								<br>Arquivos Sub Submenus:<br> 
								
								<select name="sub_subcategoria" id="sub_subcategoria" style="min-width:200px">
		    							<option selected value=0> Todos arquivos </option>
								</select>															               		
	               		
	               		<input type="submit" value="Listar Arquivos"><br><br>
	               		<input type="hidden" name="arquivo" value="listar_form_exc.php">
	               		
	               </form>
	               <br><hr><br>
	               Buscar arquivo:<br>
	                <input type="text" id="buscarn" placeholder="Informe o nome do arquivo" size="37" name="buscan">
          		</div>
          		<br><hr>
          		<div id="alvo"></div>		
			
			<table border=0>
			';	
			if($linha==0) {
				echo '<tr><td><a href="#">Nenhum documento cadastrado !</b></td></tr>';
			}
			/*
			while ($campos = mysql_fetch_array($resultado)) {
				
				//verifica a extansão do arquivo para escolher a imagem
				$extensao = pathinfo($campos[arquivo_formulario], PATHINFO_EXTENSION);

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
				echo "<td><a href=\"index.php?arquivo=excluir_formulario.php&codigo_formulario=$campos[codigo_formulario]\"  onClick=\"return confirm('Confirma exclusão de $campos[titulo_formulario]?')\">  $campos[titulo_formulario] <img src=images/excluir.png width=16 height=16 border=0 alt=Excluir> </a></td></tr>";	  
		
			}
			*/
			echo '
			</table>
			
			</center>';	
		}	
		echo '<center><br><a href="index.php?arquivo=adm_geral.php"><input type="button" value="Voltar"></a><br><br></center>';	
		mysql_close($conexao);
	}
?>
