<?php
	session_start();
	include_once ('trataInjection.php');

	if(protectorString($_GET[cpf]))
		return;
	
	if ($_SESSION['logado_site_dppg'])
	{
		if( ($pesquisa_adm) or ($pesquisa_subadm) ) 
		{	
			include("includes/config2.php");
			
			$cpf = mysql_real_escape_string($_GET[cpf]);			
			
			$sql = "select * from usuarios where cpf=$cpf";
			$resultado = mysql_query($sql);
		
			if(mysql_num_rows($resultado)) 
			{
				$campos = mysql_fetch_array($resultado);
				echo '
					<script src="subsistemas/usuario/valida_forms/valida_form_alt_usuario.js" type="text/javascript"></script>
					
					<center><br><b>Alterar Dados Usuario</b><br><br>
		
					<form name="form_alterar_usuario" method="POST" onsubmit="javascript: return checkaltnoticia()" action="index.php">
		
						<table border="0" width="500" class="esquerda">
							<tr>
				  				<td>CPF:</td>
				  				<td><input type="text" name="cpf" size="11" maxlength="11" readonly value="'.$campos[cpf].'"><font color="#FF0000"> *</font> Somente números</td>
							</tr>
							<tr>
				  				<td>Nome:</td>
				  				<td><input type="text" name="nome" size="40" maxlength="45" value="'.$campos[nome].'"><font color="#FF0000"> *</font></td>
							</tr>
				  				<td>Telefone:</td>
				  				<td><input type="text" name="telefone" size="10" maxlength="10" value="'.$campos[telefone].'"><font color="#FF0000"> *</font> Somente números</td>
							</tr>
							<tr>
				  				<td>E-mail:</td>
				  				<td><input type="text" name="email" size="40" maxlength="45" value="'.$campos[email].'"><font color="#FF0000"> *</font></td>
							</tr>
							<tr>
								<td colspan=2 height=40 ><b>Para trocar a senha do usuario favor preencher os campos abaixo, para mater a senha ja cadastrada mantenha os campos em brano. </b></td>
							</tr>	
							<tr>
							 	<td>Senha</td>
							        <td><input type="password" name="senha" size="11" maxlength="50"></td>
							</tr>
							<tr>
							 	<td>Confirmar Senha</td>
							        <td><input type="password" name="confirmar_senha" size="11" maxlength="50"></td>
							</tr>	
							<tr>  
				  				<input type="hidden" name="arquivo" value="subsistemas/usuario/alterar_usuario.php">
							</tr>
						</table>
						
						<br>
							<input type="hidden" name="cpf" value="'.$campos[cpf].'">
							<input type="submit" value="Alterar" class="submitVerde">
							<a href="index.php?arquivo=subsistemas/usuario/listar_ger_usuario.php"><input type="button" value="Voltar"></a>
					</form>
					
					<br></center>';
			}
			else
				echo "<center><br><br><b>Dados inválidos!!!</b></center>";
		}
	mysql_close($conexao);
	}
?>
