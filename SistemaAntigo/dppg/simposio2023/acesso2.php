<?php

session_start();

//$_SESSION["autenticagd"] = rand(10000000,99999999);

echo '<div id="box">
			<form name="form_logon" method="POST" action="simposio.php">
			<br>
			<table border="0" align="center" width="60%">
			<tr>
				<td><font color="#000"><b><center>CPF:</center></b></font></td>
				<td><input type="text" name="cpf" placeholder="" size="12" maxlength="11"></td>
			</tr>
			<tr>
				<td><font color="#000"><b><center>Senha:</center></b></font></td>
				<td><input  type="password" name="senha" size="12" placeholder= "***********" maxlength="30"></td>
			</tr>
			<tr>
				<!--<td colspan="2" align="center"><font color="#000"><br><b>Digite o valor:</b></font></td>-->
			</tr>
			<tr>
  				<!--<td><input type="text" name="valor" placeholder= "12345678" size="6" maxlength="8"></td>
  				<td><img src="gd.php"></td>	-->
				<input type="hidden" name="arquivo2" value="logon.php">
  			</tr>
			<tr>
				<td colspan="2"><center><br>&nbsp;&nbsp;<button type="submit" name="logar" value="OK">Login</button></center><br></td>
			</tr>
			</table>
			</form>
			<!--Instalar a biblioteca gd(converter numero para imagem) comando apt-get install gd-->
			</div>
			<br>
			&nbsp;&nbsp;<img src="images/senha.png" border="0"><a href=simposio.php?arquivo2=form_envia_senha.php> Esqueceu sua senha?</a>
		<br><br><br>';
?>
