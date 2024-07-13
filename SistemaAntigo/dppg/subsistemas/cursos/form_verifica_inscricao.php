<?php

		include("includes/config2.php");
        include_once ('trataInjection.php');

        if(protectorString($_GET[codigo_curso]) || protectorString($_GET[cpf]))
            return;


		$codigo_curso = mysql_real_escape_string($_GET[codigo_curso]);
		$cpf = mysql_real_escape_string($_GET[cpf]);
		$sql = "select * from cursos where codigo_curso='$codigo_curso'";
		$resultado = mysql_query($sql);
		$campos = mysql_fetch_array($resultado);
		
		echo '<center><br><b>Cadastro no curso '.$campos[nome_curso].'</b><br><br>';

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
  					<td><input type="text" name="cpf" size="11" maxlength="11" value="'.$cpf.'"><font color="#FF0000"> *</font> Somente números</td>
				</tr>
				<tr>  
  					<td><input type="hidden" name="codigo_curso" value="'.$codigo_curso.'">
  					<input type="hidden" name="arquivo" value="subsistemas/cursos/form_inscricao.php"></td>
				</tr>
				</table>
				<br>
				<input type="submit" value="Próximo" class="submitVerde">&nbsp;<input type="reset" value="Limpar" class="submitVerde">
				</form>
				<br>
				</center>';
		mysql_close($conexao);
?>