<?php

		include("includes/config2.php");
        include_once ('trataInjection.php');

        if(protectorString($_POST[cpf]) || protectorString($_POST[codigo_curso]))
            return;
        
		$cpf = mysql_real_escape_string($_POST[cpf]);
		$codigo_curso = mysql_real_escape_string($_POST[codigo_curso]);
		$sql1 = "select * from participantes where cpf='$cpf'";
		$resultado1 = mysql_query($sql1);

		$sql2 = "select * from inscricao where cpf='$cpf' and codigo_curso='$codigo_curso'";
		$resultado2 = mysql_query($sql2);
		
		$sql3 = "select * from cursos where codigo_curso='$codigo_curso'";
		$resultado3 = mysql_query($sql3);
		$campos3 = mysql_fetch_array($resultado3);

		/*Se não estiver cadastrado no sistema DPPG*/
		if (mysql_num_rows($resultado1) == 0)
		{
            echo "<center><br><b>Você não está cadastrado no sistema DPPG. <br><br> Para participar do curso <font style='color: #006400'>$campos3[nome_curso]</font>, por favor, realize o cadastro. </br><br><br>";
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
  					<td><input type="text" name="cpf" size="11" maxlength="11" value="' . $cpf . '"><font color="#FF0000"> *</font> Somente números</td>
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
  					<input type="hidden" name="codigo_curso" value="' . $codigo_curso . '">
  					<input type="hidden" name="arquivo" value="subsistemas/cursos/inscricao.php">
				</tr>
				</table>
				<br>
				<input type="submit" name="btCadastrar" value="Cadastrar" class="submitVerde">&nbsp;<input type="reset" value="Limpar" class="submitVerde">
				</form>
				<br>
				</center>';
        }
		/*Se não estiver inscrito no curso*/
		elseif(mysql_num_rows($resultado2) == 0)
        {
            include("inscricao.php");
        }
		else
        {
            echo '<center><br><b>Participante já inscrito!!!</b><br><br>';
        }
				
		mysql_close($conexao);
?>