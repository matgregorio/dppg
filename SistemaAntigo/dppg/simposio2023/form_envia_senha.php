<?php

echo '
			<script src="js/valida_logon.js"  type="text/javascript"></script>		
		<br><br>
		<center>
			<b>Trocar senha</b><br><br>
			<form name="form_envio" method="post" onsubmit="javascript: return checkcontatos()" action="simposio.php">
			<table  border="0" class="esquerda">			
			<tr>
				<td>CPF: </td>
				<td><input type="text" name="cpf" size="11" maxlength="11"></td>
			</tr>
			<tr>
				<td>E-mail:</td>
				<td><input type="text" name="email" size="30" maxlength="50">
				<input type="hidden" name="arquivo2" value="envia_senha.php"></td>
			</tr>
			</table>
			<input type="submit" value="OK">			
			</form>
			<br><br>
		</center>';
?>
