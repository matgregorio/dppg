<?php
	session_start();
	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
		  	include("includes/config2.php");
			
			$sql = "select * from grupo_usuario";
		   $resultado = mysql_query($sql);
			
			echo "  
				<br>	
				<center><b><font size=5> Cadastro do Subsistema</font></b></center>
		
				<script src='valida_forms/validar_cad_sistema.js'></script>	
				
				<form name='form_cadsistema_categoria' method='post' onsubmit='javascript: return checksistema()' action='index.php'>
					<table border=0 align='center'>
					<tr>
						<td colspan=2 height=25><b><font size=4> Cadastrar Subsistema </font></b></td>
					</tr>
					<tr>
						<td align='left'><b>Nome do Subsistema </b></td>
						<td align='left'><input type='text' name='nome_sistema' maxlength='60' size='45'><font color='#FF0000'> *</font></td>
					</tr>
					<tr>
						<td colspan='2' align='left'><b><br>Nos campos abaixo deve ser informado o caminho onde está 
						armazenado o arquivo .php pedido do subsistema.</b><br></td>
					</tr>
					<tr>
						<td align='left'><b>Link do Menu </b></td>
						<td align='left'><input type='text' name='link_sistema' maxlength='100' size='45'><b><font color='#FF0000'> *</font> Ex: /link.php</b></td>
					</tr>
					<tr>
						<td align='left'><b>Link da Página Inicial</b></td>
						<td align='left'><input type='text' name='link_index' maxlength='100' size='45'><b>Ex: /index.php</b></td>
					</tr>
					<tr align='left' >
						<td valign='top' colspan='2'><br><b>Descrição( Informações ao Logar no Subsistema) </b>
						<textarea name='descricao_sistema' rows='10' cols='70'></textarea></td>
					</tr>		
			
			
					<tr>
						<td colspan=2 height=25><b><font size=4> Cadastrar Usuário Sub Administrador </font></b></td>
					</tr>
					<tr>
						<td colspan=2 height=20><b>Obs: Deixando os campos de usuario abaixo em branco o subsistema cadastrado poderá ser acessado pelo administrador<br> do sistema e por todos sub administradores cadastrados. As restrições de acesso poderão ser feitas no subsistema. </b></td>
					</tr>
			
					<tr>
			  				<td colspan=2><b>CPF:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  				<input type='text' name='cpf_usuario' size='11' maxlength='11' >Somente números</td>
						</tr>
						<tr>
			  				<td colspan=2><b>Nome:</b>&nbsp;&nbsp;&nbsp;&nbsp;
			  				<input type='text' name='nome' size='60' maxlength='45'></td>
						</tr>
						<tr>
						 	<td><b>Senha:</b>&nbsp;&nbsp;&nbsp;
						   <input type='password' name='senha' size='11' maxlength='15'></td>
						
						 	<td>&nbsp;&nbsp;&nbsp;<b>Confirmar Senha:</b>
						   <input type='password' name='confirmar_senha' size='11' maxlength='15'></td>
						</tr>
					</table>
					
				<center><br>
					<input type='hidden' name='arquivo' value='cad_menu_sistema.php'>
					<input type='submit' name='salvar' value='Salvar' class='submitCinza'>
					<a href='index.php?arquivo=adm_geral.php'><input type='button' value='Voltar'></a>
				</center>
					
				</form><br>"; 
		}		
		mysql_close($conexao);
	}	
?>