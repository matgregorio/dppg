<?php
		include_once ('trataInjection.php');

		if(protectorString($_GET[codigo_curso]) || protectorString($_POST[cpf]))
			return;

		include("includes/config2.php");
		$sql = "select * from cursos where codigo_curso='$_GET[codigo_curso]'";
		$resultado = mysql_query($sql);
		$campos = mysql_fetch_array($resultado);
		
		echo '<center><br><b>Emissão de certificado do curso '.$campos[nome_curso].'</b><br><br>';

			echo '
				<script src="validar1.js" type="text/javascript"></script>
				<center>
				<br>

				<form name="form_inscricao" method="POST" onsubmit="javascript: return checkcontatos()" action="subsistemas/cursos/certificado.php" target="_blank">
				<table border="0" width="500" class="esquerda">
				<tr>
  					<td>CPF:</td>
  					<td><input type="text" name="cpf" size="11" maxlength="11" value="'.$_POST[cpf].'"><font color="#FF0000"> *</font> Somente números</td>
				</tr>
				<tr>  
  					<td><input type="hidden" name="codigo_curso" value="'.$_GET[codigo_curso].'">
  					<input type="hidden" name="codificacao_iso" value="1"></td>
				</tr>
				</table>
				<br>
				<input type="submit" value="Gerar Certificado" class="submitVerde">&nbsp;<input type="reset" value="Limpar" class="submitVerde">
				</form>
				<br>
				</center>';
		mysql_close($conexao);
?>
