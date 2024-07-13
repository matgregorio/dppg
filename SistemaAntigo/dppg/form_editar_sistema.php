<?php
	session_start();

	include_once ('trataInjection.php');

	if (protectorString($_GET[codigo_menu]))
		return;

	if ($_SESSION[logado_site_dppg])
	{
		include('pesquisa_vetor_confsite.php');
		$pesquisa_admgeral = pesquisa_vetor_confsite($_SESSION['grupos_usuarios'],array('1'));
		
		if($pesquisa_admgeral) 
		{
			include("includes/config2.php");
			
			$codigo_menu = mysql_real_escape_string($_GET[codigo_menu]);
			
			$sql = "select * from menu_sistemas where codigo_menu='$codigo_menu'";
			$resultado = mysql_query($sql);
			$campos = mysql_fetch_array($resultado);
			
			echo " 
			<center><h2> Alterar Sub-Sistema</h2></center>
	
			<script src='valida_forms/validar_alterar_sistema.js'></script>
	
			<form name='form_editar_sistema' method='post' onsubmit='javascript: return checksistema()' action='index.php'>
				<table  align='center'>
				<tr>
				
					<td align='left'><b>Nome do Sistema </b></td>
					<td align='left'><input type='text' name='nome_menu' maxlength='60' size='45' value='".$campos[nome_menu]."'></td>
					
				</tr>
				<tr>
						<td colspan='2' align='left'><b><br>Nos campos abaixo deve ser informado o caminho onde está 
						armazenado o arquivo .php pedido do subsistema.</b><br></td>
				</tr>
				<tr>
						<td align='left'><b>Link do Menu</b></td>
						<td align='left'><input type='text' name='link_sistema' maxlength='100' size='45' value='".$campos[link_menu]."'><b><font color='#FF0000'> *</font> Ex: menu/link.php</b></td>
				</tr>
				<tr>
						<td align='left'><b>Link da Página Principal </b></td>
						<td align='left'><input type='text' name='link_index' maxlength='100' size='45' value='".$campos[link_index]."'><b> Ex: pagina/index.php</b></td>
				</tr>			
				<tr align='left' >
					<td valign='top' colspan='2'><br><b>Descrição( Informações ao Logar no Sub-Sistema) </b>
					<textarea name='descricao_sistema' rows='10' cols='70'>".$campos[descricao_sistema]."</textarea></td>
				</tr>		
				</table>";
				
				echo "<br>
				<center>
					<input type='hidden' name='codigo_menu' value='$codigo_menu'>		
					<input type='hidden' name='arquivo' value='alterar_menu_sistema.php'>
					<input type='submit' name='salvar' value='Salvar' class='submitCinza'>
					<a href='index.php?arquivo=adm_geral.php'><input type='button' value='Voltar'></a>
				</center>
					
			</form><br><br>"; 
		}		
		mysql_close($conexao);
	}	
?>
