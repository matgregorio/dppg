<?php

	$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('1'));
	$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'],array('2'));

	if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm) ){
		echo '
			<script src="validar1.js" type="text/javascript"></script>
			<center>
			<br>
			<b>Cadastro Participante</b>
			<br><br>

			<form name="form_inscricao" method="POST" onsubmit="javascript: return checkcontatos()" action="index.php">
			<table border="0" width="500" class="esquerda">
			<tr>
  				<td>CPF:</td>
  				<td><input type="text" name="cpf" size="11" maxlength="11"><font color="#FF0000"> *</font> Somente números</td>
			</tr>
			<tr>
  				<td>Nome:</td>
  				<td><input type="text" name="nome" size="40" maxlength="45"><font color="#FF0000"> *</font></td>
			</tr>
  				<td>Telefone:</td>
  				<td><input type="text" name="telefone" size="10" maxlength="10"><font color="#FF0000"> *</font> Somente números</td>
			</tr>
			<tr>
  				<td>E-mail:</td>
  				<td><input type="text" name="email" size="40" maxlength="45"><font color="#FF0000"> *</font></td>
			</tr>
			<tr>  
  				<input type="hidden" name="arquivo" value="subsistemas/cursos/cad_participante_interno.php">
			</tr>
			</table>
			<br>
			<input type="submit" value="Cadastrar" class="submitVerde">&nbsp;<input type="reset" value="Limpar" class="submitVerde">
			</form>
			<br>
			</center>';
	}
