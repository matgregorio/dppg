<?php
	session_start();
	
	if ($_SESSION['logado_site_dppg'])
	{
		include('subsistemas/usuario/pesquisa_vetor3.php');
		
		$pesquisa_adm = pesquisa_vetor3($_SESSION['grupos_usuarios'],array('1'));
		$pesquisa_subadm = pesquisa_vetor3($_SESSION['grupos_usuarios'],array('2'));		
		
		if( ($pesquisa_adm) or ($pesquisa_subadm) ) 
		{
			echo '
		   <div id="menu">
				<ul>
					<!--
					<li><a href=index.php?arquivo=subsistemas/usuario/form_cad_usuario.php>Cadastrar Usuário</a></li>
		  			<li><a href=index.php?arquivo=subsistemas/usuario/listar_alt_usuario.php>Alterar Usuário</a></li>				
		  			<li><a href=index.php?arquivo=subsistemas/usuario/listar_exc_usuario.php>Excluir Usuário</a></li>
 					-->		  		
 					<li><a href=index.php?arquivo=subsistemas/usuario/listar_ger_usuario.php>Gerenciar Usuário</a></li>
 						
					<!--
	 		  		<li><a href=index.php?arquivo=subsistemas/usuario/form_cad_nivel.php>Cadastrar Nivel de Usuário</a></li>
		  			<li><a href=index.php?arquivo=subsistemas/usuario/listar_nivel.php>Alterar Nivel de Usuário</a></li>
		  			<li><a href=index.php?arquivo=subsistemas/usuario/form_excluir_nivel.php>Excluir Nivel de Usuário</a></li>
 					-->
 					';
 					if($pesquisa_adm)
 					{
	 					echo '<li><a href=index.php?arquivo=subsistemas/usuario/listar_ger_niveis.php>Gerenciar Níveis</a></li>';
	 				}	
					echo '
					
					<li><a href=index.php?arquivo=subsistemas/usuario/listar_ger_permissoes.php>Permissões Usuários</a></li> 							  			
					<!-- 
					<li><a href=index.php?arquivo=subsistemas/usuario/form_permissao.php>Cadastrar Permissão Usuário</a></li>
					<li><a href=index.php?arquivo=subsistemas/usuario/form_excluir_permissao.php>Excluir Permissão Usuário</a></li> 
					-->
					
				</ul>
		   </div>';
		}
		else {
					echo "<center><font color=#006400><b>Você não tem permissão para acesso !</b></font></center>";
			  }	  
	}	
?>
