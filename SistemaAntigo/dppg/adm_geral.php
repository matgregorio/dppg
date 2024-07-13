<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{	
			$cor_tr = '#006400';
			$cor_td = '#9BCD9B';
				
			echo '<br><center><font size="4"><b>Admininstração Geral</b></font><br>';

			echo "<div id='link'>
						
						<b>";

			//tabela com 2 campos para tabelas de menus e para o aviso			
			echo "<table border='0' width='700'>
			<tr>
					<td valign='top'>
					";			
						
						///////  TABELA-1 administraÃ§Ã£o do site
						echo"
						<table width='150' border='0' align='center' id='tabela3'>
							<tr>
								<td colspan=2 align=center>Site</td>
							</tr>				
							<tr bgcolor='$cor_tr' align='center'>
								<td width='50%'><font color='$cor_td'>Controle Geral</font></td>
							</tr>
							<tr bgcolor='$cor_td' align=center>
								<td><a href='index.php?arquivo=form_config_site.php'><img src='images/cadastrar.png' border='0'> Configurar Site</a></td>
							</tr>
							<tr bgcolor='$cor_td' align=center>
								<td><a href='index.php?arquivo=alterar_logo_site.php'><img src='images/editar.png' border='0'> Alterar Logo</a></td>
							</tr>
							<tr bgcolor='$cor_td' align=center>
								<td><!-- <a href='index.php?arquivo=form_alterar_texto_site.php'><img src='images/editar.png' border='0'> Alterar Texto PÃ¡gina Inicial</a> --></td>
							</tr>
						</table>
						
						</td>						
						</tr><tr>
						<td>";
				
				/////////  TABELA-2 menu horizontal
				echo "
				<table width='500' border='0' align='center' id='tabela3'>	
					<tr><td colspan=3 align=center> Menu Horizontal </td></tr>		
					<tr bgcolor='$cor_tr' align='center' width='50%'>
						<td><font color='$cor_td'>Categoria</font></td>
						<td><font color='$cor_td'>Subcategoria</font></td>
						<td><font color='$cor_td'>Sub-Subcategoria</font></td>
					</tr>
					<tr bgcolor='$cor_td' width='50%'>
						<td><a href='index.php?arquivo=form_cadmenu_categoria.php'><img src='images/cadastrar.png' border='0'> Cadastrar Categoria</a></td>
						<td><a href='index.php?arquivo=form_cadmenu_subcategoria.php'><img src='images/cadastrar.png' border='0'> Cadastrar Subcategoria</a></td>
						<td><a href='index.php?arquivo=form_cadmenu_sub_subcategoria.php'><img src='images/cadastrar.png' border='0'> Cadastrar Sub-Subcategoria</a></td>
					</tr>
					<tr bgcolor='$cor_td' width='50%'>
						<td><a href='index.php?arquivo=listar_menu_categoria.php'><img src='images/editar.png' border='0'>Editar Categoria</a></td>
						<td><a href='index.php?arquivo=listar_menu_subcategoria.php'><img src='images/editar.png' border='0'>Editar Subcategoria</a></td>
						<td><a href='index.php?arquivo=listar_menu_sub_subcategoria.php'><img src='images/editar.png' border='0'>Editar Sub-Subcategoria</a></td>
					</tr>
					<tr bgcolor='$cor_td' width='50%'>
						<td><a href='index.php?arquivo=listar_excmenu_categoria.php'><img src='images/excluir.png' border='0'>Excluir Categoria</a></td>
						<td><a href='index.php?arquivo=listar_excmenu_subcategoria.php'><img src='images/excluir.png' border='0'>Excluir Subcategoria</a></td>
						<td><a href='index.php?arquivo=listar_excmenu_sub_subcategoria.php'><img src='images/excluir.png' border='0'>Excluir Sub-Subcategoria</a></td>
					</tr>
				</table>
				
				</td>						
				</tr>
				<tr>
				
				<td colspan=2>";
				
				
				/////////  TABELA-3 informaÃ§Ãµes
				echo "<br>
				<table width='700' border='0' align='center' id='tabela3'>
					<tr><td colspan=4 align=center>Informações</td></tr>			
					<tr bgcolor='$cor_tr' align='center'>
						<td><font color='$cor_td'>Notí­cias</font></td>
						<td><font color='$cor_td'>Documentos</font></td>
						<td><font color='$cor_td'>Links</font></td>
						<td><font color='$cor_td'>Banner</font></td>
					</tr>
					<tr bgcolor='$cor_td'>
						<td><a href='index.php?arquivo=form_cad_noticia.php'><img src='images/cadastrar.png' border='0'> Cadastrar Notícia</a></td>
						<td><a href='index.php?arquivo=form_cad_formulario.php'><img src='images/cadastrar.png' border='0'> Cadastrar Documento Subcategoria</a></td>
						<td><a href='index.php?arquivo=form_cad_links.php'><img src='images/cadastrar.png' border='0'> Cadastrar Links</a></td>					
						<td><a href='index.php?arquivo=form_cad_banner.php'><img src='images/cadastrar.png' border='0'> Cadastrar Banner</a></td>
					</tr>
					<tr bgcolor='$cor_td'>
						<td><a href='index.php?arquivo=listar_alterar_noticias.php'><img src='images/editar.png' border='0'>Editar Notí­cia</a></td>
						<td><a href='index.php?arquivo=form_cadsub_formulario.php'><img src='images/cadastrar.png' border='0'> Cadastrar Documento Sub Subcategoria</a></td>
						<td><a href='index.php?arquivo=listar_alterar_links.php'><img src='images/editar.png' border='0'> Alterar Links</a></td>
						<td><a href='index.php?arquivo=listar_alterar_banner.php'><img src='images/editar.png' border='0'> Alterar Banner</a></td>
					</tr>
					<tr bgcolor='$cor_td'>
						<td><a href='index.php?arquivo=listar_excluir_noticia.php'><img src='images/excluir.png' border='0'>Excluir Notí­cia</a></td>
						<td><a href='index.php?arquivo=listar_excluir_formulario.php'><img src='images/excluir.png' border='0'>Excluir Documento</a></td>
						<td><a href='index.php?arquivo=form_excluir_links.php'><img src='images/excluir.png' border='0'> Excluir Links</a></td>
						<td><a href='index.php?arquivo=form_excluir_banner.php'><img src='images/excluir.png' border='0'> Excluir Banner</a></td>
					</tr>
				</table>
				
				</td>
				</tr>
				";
				
				/////////  TABELA-4 subsistemas
				
				echo "
				<tr>				
				<td colspan=2>
				
				<table width='400' border='0' align='center' id='tabela3'>
					<tr><td colspan=2 align=center>Sistemas</td></tr>				
					<tr bgcolor='$cor_tr' align='center'>
						<td width='50%'><font color='$cor_td'>Categoria</font></td>
						<td width='50%'><font color='$cor_td'>Subcategoria</font></td>
					</tr>
					<tr bgcolor='$cor_td' width='50%'>
						<td><a href='index.php?arquivo=form_cadsistema_categoria.php'><img src='images/cadastrar.png' border='0'> Cadastrar Subsistema</a></td>
						<td><a href='index.php?arquivo=form_cadsistema_subcategoria.php'><img src='images/cadastrar.png' border='0'> Cadastrar Subcategoria</a></td>
					</tr>
					<tr bgcolor='$cor_td' width='50%'>
						<td><a href='index.php?arquivo=listar_sistema_categoria.php'><img src='images/editar.png' border='0'>Editar Subsistema</a></td>
						<td><a href='index.php?arquivo=listar_sistema_subcategoria.php'><img src='images/editar.png' border='0'>Editar Subcategoria</a></td>
					</tr>
					<tr bgcolor='$cor_td' width='50%'>
						<td><a href='index.php?arquivo=listar_excsistema_categoria.php'><img src='images/excluir.png' border='0'>Excluir Subsistema</a></td>
						<td><a href='index.php?arquivo=listar_excsistema_subcategoria.php'><img src='images/excluir.png' border='0'>Excluir Subcategoria</a></td>
					</tr>
				</table>
				
				</td></tr>
				";
				
				
				//informaÃ§Ã£o com o servidor
				echo '
				<tr>
					<td colspan=2>				
						<center><b>As mudanças só serão realizadas caso haja comunicação com servidor.</b></center>
					</td>
				</tr>
	 		</table>
	 		</b>	
	 		
	 		</div>';	
	 	}	
	}		
?>
