<?php
	session_start();

	if ($_SESSION['logado_site_dppg'])
	{
		if( ($pesquisa_adm) or ($pesquisa_subadm) ) 
		{	

			include("includes/config2.php");
			
			echo '
			<script src="subsistemas/usuario/valida_forms/valida_form_usuario.js" type="text/javascript"></script>
			
			<center><br><b>Cadastrar Usuario</b><br><br>
		
			<form name="form_cad_usuario" method="POST" onsubmit="javascript: return checkusuario()" action="index.php">
				<table border="0" width="500" class="esquerda">
					<tr>
				  			<td>CPF:</td>
				  			<td><input type="text" name="cpf" size="11" maxlength="11" ><font color="#FF0000"> *</font> Somente números</td>
					</tr>
					<tr>
				  			<td>Nome:</td>
				  			<td><input type="text" name="nome" size="40" maxlength="45" "><font color="#FF0000"> *</font></td>
					</tr>
				  			<td>Telefone:</td>
				  			<td><input type="text" name="telefone" size="10" maxlength="10" "><font color="#FF0000"> *</font> Somente números</td>
					</tr>
					<tr>
				  			<td>E-mail:</td>
				  			<td><input type="text" name="email" size="40" maxlength="45" "><font color="#FF0000"> *</font></td>
					</tr>
					<tr>
					 		<td>Senha:</td>
					   	<td><input type="password" name="senha" size="11" maxlength="50"><font color="#FF0000"> *</font></td>
					</tr>
					<tr>
					 		<td>Confirmar Senha</td>
					   	<td><input type="password" name="confirmar_senha" size="11" maxlength="50"><font color="#FF0000"> *</font></td>
					</tr>
				  			<input type="hidden" name="arquivo" value="subsistemas/usuario/cadastrar_usuario.php">
				</table>
			
							<br><input type="submit" value="Enviar" class="submitVerde"><input type="reset" value="Limpar" class="submitVerde"><a href="index.php?arquivo=subsistemas/usuario/listar_ger_usuario.php"><input type="button" value="Voltar"></a>
			</form>
			
			<br></center>';
		}
	mysql_close($conexao);
}
?>
