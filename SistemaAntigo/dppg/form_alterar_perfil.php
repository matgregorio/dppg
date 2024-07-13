<?php


if ($_SESSION[logado_site_dppg])
{
	include("includes/config2.php");
	$sql = "select * from usuarios where cpf='$_SESSION[cpf]'";
	$resultado = mysql_query($sql);

	if(mysql_num_rows($resultado)) 
	{
		$campos = mysql_fetch_array($resultado);
		echo '
			<script src="valida_forms/validar_alt_perfil.js" type="text/javascript"></script>
			
			<center><br><b>Alterar Dados Usuario</b><br><br>

			<form name="form_perfil" method="POST" onsubmit="javascript: return checkcontatos()" action="index.php">
				<table border="0" width="530" class="esquerda">
				<tr>
					<td>Nivel Usuario</td>
					<td>
						';
							
							$sql0 = "select * from participa_grupos where cpf=$_SESSION[cpf]";
							$resultado0 = mysql_query($sql0);
							$campos0 = mysql_fetch_array($resultado0);
							
							$sql1 = "select * from grupo_usuario where codigo_grupo=$campos0[codigo_grupo]";
							$resultado1 = mysql_query($sql1);
							$campos1 = mysql_fetch_array($resultado1);
							
							echo '<input type="text" name="grupo" size="15" maxlength="40" value="'.$campos1[nome_grupo].'" readonly>';
												
					echo'	
					</td>
				</tr>
				<tr>
	  				<td>CPF:</td>
	  				<td><input type="text" name="cpf" size="15" maxlength="11" readonly value="'.$campos[cpf].'"></td>
				</tr>
				<tr>
	  				<td>Nome:</td>
	  				<td><input type="text" name="nome" size="40" maxlength="100" value="'.$campos[nome].'"><font color="#FF0000"> *</font></td>
				</tr>
	  				<td>Telefone:</td>
	  				<td><input type="text" name="telefone" size="10" maxlength="10" value="'.$campos[telefone].'"><font color="#FF0000"> *</font> Somente números</td>
				</tr>
				<tr>
	  				<td>E-mail:</td>
	  				<td><input type="text" name="email" size="40" maxlength="100" value="'.$campos[email].'"><font color="#FF0000"> *</font></td>
				</tr>
				<tr>
				 	<td>Senha</td>
				   <td><input type="password" name="senha" size="11" maxlength="15" ></td>
				</tr>
				<tr>
				 	<td>Confirmar Senha</td>
				   <td><input type="password" name="confirma_senha" size="11" maxlength="15" ></td>
				</tr>
				<tr>  
	  				<input type="hidden" name="arquivo" value="alterar_perfil.php">
				</tr>
				</table>
				<br>
					<input type="submit" value="Alterar" class="submitVerde">
					<a href="index.php"><input type="button" value="Voltar"></a>
 
			</form><br></center>';
	}
	else
		echo "<center><br><br><b>Dados inválidos!!!</b></center>";
	mysql_close($conexao);
}
?>