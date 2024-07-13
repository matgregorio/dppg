<?php

session_start();

if ((protectorString($_POST[cpf]) === false) && (protectorString($_POST[email]) === false)) {

include('includes/config.php');

$_SESSION[troca_senha] = $_POST[cpf];

$sql = "select * from participantes where cpf='$_POST[cpf]' and email='$_POST[email]'";
$resultado = mysql_query($sql);
$campos = mysql_fetch_array($resultado);

if (mysql_num_rows($resultado) == 1) {
  if ($campos[codigo_tipo_participante] == 2 || $campos[codigo_tipo_participante] == 4 || $campos[codigo_tipo_participante] == 6) {

    echo '<script src="js/valida_senha.js"  type="text/javascript"></script>
			<br><br>
			<center>
			<b>Trocar senha</b><br><br>
			<form name="form_envio" method="post" onsubmit="javascript: return checkcontatos()" action="simposio.php">			
			<table  border="0" class="esquerda">			
			<tr>
				<td>Senha: </td>
				<td><input type="password" name="senha" size="10" maxlength="10"></td>
			</tr>
			<tr>
				<td>Confirma Senha: </td>
				<td><input type="password" name="confirma_senha" size="10" maxlength="10">
				<input type="hidden" name="arquivo2" value="envia_senha2.php"></td>
			</tr>
			</table>
			<input type="submit" value="OK">			
			</form>
			</center>
			<br><br>';
  } else if ($campos[codigo_tipo_participante] == 3 || $campos[codigo_tipo_participante] == 5) {
    $senha = rand(1, 999999);
    $to = $campos[email];
    $subject = 'Envio de senha';
    $message = 'Prezado ' . $campos[nome] . ',
      segue o envio de sua senha.
      Usuário: ' . $campos[cpf] . '
      Senha: ' . $senha . '
      Setor DPPG';
    $headers = 'From: dppg.riopomba@ifsudestemg.edu.br' . "\r\n";
    if (mail($to, $subject, $message, $headers)) {
      $senha = md5 ($senha);
      $result = mysql_query("UPDATE participantes SET senha='$senha' WHERE cpf='$campos[cpf]'");
      if ($result) {
	echo '<br><br><center><b>Prezado uma nova senha foi enviada para seu email com sucesso!</b></center><br><br>';
      }
    } else {
      echo '<br><br><center><b>Erro no envio da senha!</b></center><br><br>';
    }
  }
} else {
  echo '<br><br><center><font color="#FF0000"><b>CPF ou E-mail não existente!</b></font></center><br><br>';
}
} else {
	echo "Erro no parâmetro!";
}
?>
