<?php

include_once ('trataInjection.php');

if(protectorString($_POST[cpf]) || protectorString($_POST[email]))
    return;


include("includes/config2.php");
	$cpf = mysql_real_escape_string($_POST[cpf]);
	$email = mysql_real_escape_string($_POST[email]);
	$sql = "select * from participantes where cpf='$cpf' and email='$email'";
	$resultado = mysql_query($sql);
	if(mysql_num_rows($resultado)) {
		$campos = mysql_fetch_array($resultado);
		echo '
			<script src="validar1.js" type="text/javascript"></script>
			<center>
			<br>
			<b>Alterar Dados Participante</b>
			<br><br>

			<form name="form_inscricao" method="POST" onsubmit="javascript: return checkcontatos()" action="index.php">
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
  				<input type="hidden" name="arquivo" value="subsistemas/cursos/alterar_dados_participante.php">
			</tr>
			</table>
			<br>
			<input type="submit" value="Alterar" class="submitVerde">&nbsp;<input type="reset" value="Limpar" class="submitVerde">
			</form>
			<br>
			</center>';
	}
	else
		echo "<center><br><br><b>Dados inválidos!!!</b></center>";
	mysql_close($conexao);
?>