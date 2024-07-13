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
echo '<center><b><i>Alunos de Iniciação Científica e Tecnológica</i></b></center><br>';

if ($_POST[envio_aluno] == "S") {
    if ($_POST[item] == "") {
        echo '<center><i> É necessário selecionar um aluno </i></center>';
        echo '<meta http-equiv="refresh" content="3; URL="aluno_ic.php" />';
    } else {
        $item = $_POST[item];

        foreach ($item as $cpf) {
            $sql5 = "select * from participantes where cpf = '$cpf'";
            $resultado5 = mysql_query($sql5);

            $campos5 = mysql_fetch_array($resultado5);

            $to = $campos5[email];
            $subject = 'Acesso Simpósio';
            $message = 'Prezado  Aluno de Iniciação Científica e Tecnológica,
						Você foi cadastrado no site do simpósio. 						
						Para acessar segue o link abaixo.
						http://www.riopomba.ifsudestemg.edu.br/simposio/
						Acesso Simpósio
						Login: ' . $campos5[cpf] . '
						Senha: ' . $campos5[senha] . '
						Setor DPPG';
            $headers = 'From: dppg.riopomba@ifsudestemg.edu.br' . "\r\n";

            //echo 'Email -> ' .$to.' '.$subject.' '.$message.' '.$headers;
            mail($to, $subject, $message, $headers);

            $sql6 = "update participantes set enviou_email = '1' where cpf = '$campos5[cpf]'";
            $resultado6 = mysql_query($sql6);

            echo '<meta http-equiv="refresh" content="3; URL="aluno_ic.php" />';
        }
        echo '<center><i>Email(s) enviado(s) com sucesso</i></center>';
    }
}


$sql4 = "select * from participantes where iniciacao = 'S'";
$resultado4 = mysql_query($sql4);

$cor = "#95e197";

echo '<center><form name="form_aluno_ic" method="POST" action="aluno_ic.php">';
echo '<table border ="0" class="esquerda">
						<tr bgcolor=#61C02D >
							<td><font color="FFFFFF"><center><b><i>&nbsp;Nome&nbsp;</i></b></center></font></td>
							<td><font color="FFFFFF"><center><b><i>&nbsp;Enviou&nbsp;</i></b></center></font></td>						
						</tr>';

while ($campos4 = mysql_fetch_array($resultado4)) {

    echo '<tr bgcolor="' . $cor . '">
							<td>' . $campos4[nome] . '</td>';

    $email = $campos4[enviou_email];

    if ($email == 1)
        echo '<td>Sim</td>';
    else
        echo '<td>Não</td>';

    if ($email != 1) {
        echo '<td><input type="checkbox" name="item[]" size="1" value="' . $campos4[cpf] . '"></td>';
    }

    echo '</tr>';

    if ($cor == "#78e07b")
        $cor = "#95e197";
    else
        $cor = "#78e07b";
}

echo '</table>
					<input type="hidden" name="envio_aluno" value="S">					
					<input type="submit" value="Enviar">
					</form><br></center>';

?>
</body>
</html>