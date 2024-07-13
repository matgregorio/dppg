<?php
	session_start();
	header( 'Content-Type: text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
    <head>
        <title>Exemplo Menu</title>
			
			<meta name="content-type" content="text/html; charset=UTF-8"/>
						
			   <!-- Script login no menu horizontal -->  
			   <script type="text/javascript">
			        jQuery(document).ready(function() {
			
			            jQuery(".signin").click(function(e) {
			                e.preventDefault();
			                jQuery("fieldset#signin_menu").toggle();
			                jQuery(".signin").toggleClass("menu-open");
			            });
			
			            jQuery("fieldset#signin_menu").mouseup(function() {
			                return false
			            });
			            jQuery(document).mouseup(function(e) {
			                if(jQuery(e.target).parent("a.signin").length==0) {
			                    jQuery(".signin").removeClass("menu-open");
			                    jQuery("fieldset#signin_menu").hide();
			                }
			            });            
			
			        });
			  </script>
			
	
		
		    <script>
            jQuery(function(){
                jQuery("a:first", ".menuv li.submenu", ".menuh li.submenu").addClass("seta");
                
                jQuery(".menuv li.submenu, .menuh li.subv").each(function(){
                    var el = jQuery('#' + jQuery(this).attr('id') + ' ul:eq(0)');
                    
                    jQuery(this).hover(function(){
                        el.show();
                    }, function(){
                        el.hide();
                    });
                });
            });
        </script>
        <!-- FIM Script menu horizontal -->  
       
        <style>
        /* menu horizontal */
				/* posição espaço do menu horizontal */
				ul.menuh {
      			list-style: none;
					margin-top: -18px;
					color: #008B00;
			z-index: 1; 
	         }  
	         
	         /* posição do conteudo menu horizontal */         
            ul.menuh li.subv {
	            /*largura item do menu*/
	            width: auto; 
					font-weight: bold;
			z-index: 1;
				
            } 
            /*posicao do subitem*/           
            ul.menuh ul.menuv {
                display: none; 
                position: absolute; 
                margin-left: -1px;
			z-index: 1;
            }         
            /*posicao do subitem do subitem*/   
            ul.menuh ul.menuv ul {
                left: 150px;
            } 
            /*config item menu*/            
            ul.menuh a {
                padding: 4px; 
                display: block;
                text-decoration: none; 
                color:  #006400; 
            }   
            /*config menu marcado*/         
            ul.menuh li a:hover {
					/*            	
            	border-left: 1px solid #ccc;
					border-right: 1px solid #ccc;*/
					background: url(images/menu_horizontal2.png);
					color:#000; 
            }    
            
            /*config do submenu*/          
            ul.menuv, ul.menuv ul {
                padding: 0; 
                width: 150px;
                /*background-color: #fff;
                z-index: 10000;*/ 
                border-top: 1px solid #ccc;
                background: url(images/menu_horizontal.png);
            }  
            /*config item submenu*/          
            ul.menuv li {
                list-style: none; 
                font-weight: normal;
                border: 0px;
                position: relative;
            }
              
            /*config item submenu*/          
            ul.menuv li a {
                display: block; 
                text-decoration: none; 
                border: 1px solid #ccc; 
                border-top: none;
                color:  #006400; 
                padding: 5px 10px 5px 5px;
            }
            
            /* Fix IE. Hide from IE Mac \*/
            * html ul.menuv li {
                float: left; 
                height: 1%;
            }            
            * ul.menuv li a {
                height: 1%;
            }
            /* End */
            
            ul.menuv ul {
                position: relative;
                display: none; 
                left: 148px; 
                top: -1px;
            }            
            ul.menuv li.submenu ul {
                display: none;
                font-weight: normal;
            }   
             
            /*config subitem marcado do submenu*/            
            ul.menuv li a:hover {
					 font-weight: bold;	                
                color: #000;
            }
            /**/
            ul.menuv a.seta2{            	
						background: transparent url(images/menu/tipsy-east.gif) right center no-repeat;            	
            	}
           
		</style>

    </head>
    <body>
	 
	 	<?php		    
	 			//conexão com banco de dados
    			include('includes/config2.php');
    			
    			//selecionar todos itens do menu horizontal
    			$sql = "select * from menu_categoria order by posicao_menu asc";
				$resultado = mysql_query($sql);
				
				
    	?>	
		<br />
      
         
         <ul class="menuh">
         <table border="0" align="center" id="tabela_menu_horizontal" class="tabela_menu">
			<tr>
				<td align="center">
	         		<li id="submenu-0" class="subv">
										<a href="index.php?arquivo=listar_noticias.php" class="seta">Home</a>
						</li>		
				</td>
				
				<?php
						
						$contUM=1;
						
				      while($campos = mysql_fetch_array($resultado))
					   { 	
	         				echo '
	         				<td>								
								<li id="submenu-'.$contUM.'" class="subv">';
										
										echo '<a href="#">'.$campos[nome_categoria].'</a>';
										
										$sql1 = "select * from menu_subcategoria where categoria='$campos[codigo_categoria]' order by posicao asc";
										$resultado1 = mysql_query($sql1);
										$linha1 = mysql_num_rows($resultado1);		  				
					  					
					  					if($linha1>0) {													
										
											echo'
											<ul class="menuv">';
												
							  					$contDOIS=$contUM+1;
							  					while($campos1 = mysql_fetch_array($resultado1))
							  					{
													echo '<li> 
																	
																	<li id="submenu-'.$contDOIS.'" class="submenu">';
	
																			$sql2 = "select * from menu_sub_subcategoria where menu_subcategoria='$campos1[codigo_subcategoria]' order by posicao asc";
																			$resultado2 = mysql_query($sql2);		  				
																			$linha2 = mysql_num_rows($resultado2);
																																						
																			if($linha2==0){																			
																			echo '<a href="index.php?arquivo=conteudo_menu_categoria.php&codigo_subcategoria='.$campos1[codigo_subcategoria].'">'.$campos1[nome_subcategoria].'</a>';
																			}
																	  		if($linha2>0) {
																				
																				echo '<a href="index.php?arquivo=conteudo_menu_categoria.php&codigo_subcategoria='.$campos1[codigo_subcategoria].'" class="seta2">'.$campos1[nome_subcategoria].'</a>';

																		  		echo '			
																				<ul class="menuv">';
																				
																  					$contTRES=$contDOIS+1;
																  					while($campos2 = mysql_fetch_array($resultado2))
																  					{										
																							echo'	<li id="submenu-'.$contTRES.'">
																											<a href="index.php?arquivo=conteudo_menu_subcategoria.php&codigo_subcategoria='.$campos1[codigo_subcategoria].'&codigo_sub_subcategoria='.$campos2[codigo_sub_subcategoria].'">'.$campos2[nome_sub_subcategoria].'</a>
																									</li>';
																					}
																					$contTRES++;
																					$contDOIS=$contTRES;
																				
																				echo '				
																				</ul>';
																			}
																	echo '		
																	</li>
															</li>				
															';
													$contDOIS++;
													$contUM=$contDOIS;			
												}
											echo '														
											</ul>';
									}
								echo'	
	                     </li>	
		                 </td>';
		            		$contUM++;     
		            }
		      echo '      
		      </td>
		      <td> ';     
						//menu fora do banco de dados	            
		            echo '<li id="submenu-'.$contUM.'" class="subv">
										<a href="index.php?arquivo=form_contato.php">Contato</a>
							   </li>';
							   $contUM++;
				echo '			   
				</td>
				<td>
				';			   
						echo'	<li id="submenu-'.$contUM.'" class="subv">';
										
									//formulario de login
									if ($_SESSION[logado_site_dppg]){
									echo' 
										<a href="index.php?arquivo=logout.php"><span>Sair</span></a>';				
				 					}
				 					else {
				 					echo "<script src='valida_forms/validar_logon.js'></script>";	
									echo' <a href="" class="signin"><span>Login</span></a>
				   				
				   				<fieldset id="signin_menu">
				   						<form name="form_login" method="post" action="index.php" onsubmit="javascript: return checklogin()" enctype="multipart/form-data" id="signin">
				    							<p>
					      						<label for="username">Login</label>
					      						<input id="username" name="cpf" value="" title="Informe o CPF" tabindex="4" type="text" size="21">
										      </p>
					      					<p>
					        						<label for="password">Senha</label>
					        						<input id="password" name="senha" value="" title="Informe a senha" tabindex="5" type="password" size="21">
					      					</p>
					      					<p>
					      						<table border=0>
					      						<tr>
					      							<td>
								        						<label for="valor" align="left">Valor</label>
								        						<input id="valor" name="valor" value="" title="Valor da imagem " tabindex="5" type="text" size="4">
								        				</td>
								        				<td>		
								      						<div id="borda">
								     									<img src="captcha.php" id="captcha_img"> 
						     									</div>
						     							</td>
						     							<td>';
						     							?>
					     									<a onClick="javascript: document.getElementById('captcha_img').src='captcha.php?'+Math.random()">
																<img src="images/atualizar.png" id="captcha" width="15" height="15">
															</a>
						     							<?php
								     					echo '		
						     							</td>
						     						</tr>
						     						</table>			
			     								</p>	
					      					<p class="remember">
					        						<input id="signin_submit" value="Entrar" tabindex="6" type="submit">
					        						<input id="remember" name="remember_me" value="1" tabindex="7" type="checkbox">
					        						<label for="remember">Lembrar-me</label>
					      					</p>
					      					<input type="hidden" name="arquivo" value="logon.php">
				    						</form>
				  					</fieldset>';
				
				 					}													
										
										
						echo'	</li>';	    	
				?>
				</td>
        	</tr>
			</table>
         </ul>

		
    </body>
</html>
