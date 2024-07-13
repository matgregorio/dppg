<?php

		echo '
			<script src="validar1.js" type="text/javascript"></script>
			<center>
			<br>
			<b>Alterar dados do Participante</b>
			<br><br>

			<form name="form_inscricao" method="POST" onsubmit="javascript: return checkcontatos()" action="index.php">
			<table border="0" width="500" class="esquerda">
			<tr>
  				<td>CPF:</td>
  				<td><input type="text" name="cpf" size="11" maxlength="11"><font color="#FF0000"> *</font> Somente números</td>
			</tr>
			<tr>
  				<td>E-mail:</td>
  				<td><input type="text" name="email" size="40" maxlength="45"><font color="#FF0000"> *</font></td>
			</tr>
			<tr>  
  				<input type="hidden" name="arquivo" value="subsistemas/cursos/form_altera_dados_participante.php">
			</tr>
			</table>
			<br>
			<input type="submit" value="Próximo" class="submitVerde">&nbsp;<input type="reset" value="Limpar" class="submitVerde">
			</form>
			<br>
			</center>';
