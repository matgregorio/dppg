<?php
header('Content-Type: text/html; charset=utf-8');
?>
<html>
<head>
    <title> Participantes </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php

include('includes/config.php');

echo '<div id="conteudo3"><br>';

echo '<center><b><i>Participantes</i></b></center><br>';

/* Participantes
    0 - Aluno Iniciação ciêntifica
    1 - Representante
*/

echo '<center>
				<form name="form_tipo" method="post" action="enviar_participante.php">  				
				<table border="0" width="100%" class="esquerda">				
				<tr>
					<td align="center">Selecione:
					<select name="tipo" size="1">
						<option value="0">Representantes de sub áreas</option>
						<option value="1">Alunos de Iniciação Científica e Tecnológica</option>				
					</select>											
					 </td>
				</tr>
				</table>
				<input type="submit" value="OK">
				</form>';

?>


</body>
</html>