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
echo '<center><b><i>Representes Sub Áreas</i></b></center><br>';

if ($_POST[envio] == "S") {
    if ($_POST[item] == "") {
        echo '<center><i> É necessário selecionar um representante </i></center>';
        echo '<meta http-equiv="refresh" content="3; URL="enviar_participante.php" />';
    } else {
        $item = $_POST[item];

        foreach ($item as $cpf) {
            $sql3 = "select * from participantes where cpf = '$cpf'";
            $resultado3 = mysql_query($sql3);

            $campos3 = mysql_fetch_array($resultado3);

            $to = $campos3[email];
            $subject = 'Acesso Simpósio';
            $message = 'Prezado Representante da Sub Área,
						Você foi cadastrado no site do simpósio. 						
						Para acessar segue o link abaixo.
						http://www.riopomba.ifsudestemg.edu.br/simposio/
						Acesso Simpósio
						Login: ' . $campos3[cpf] . '
						Senha: ' . $campos3[senha] . '
						Setor DPPG';
            $headers = 'From: dppg.riopomba@ifsudestemg.edu.br' . "\r\n";

            //echo 'Email -> ' .$to.' '.$subject.' '.$message.' '.$headers;
            mail($to, $subject, $message, $headers);

            $sql2 = "update participantes set enviou_email = '1' where cpf = '$campos3[cpf]'";
            $resultado2 = mysql_query($sql2);

            echo '<meta http-equiv="refresh" content="3; URL="representante.php" />';
        }
        echo '<center><i>Email(s) enviado(s) com sucesso</i></center>';
    }
}

$sql = "select s.nome_sa, s.cpf_representante, p.nome, p.enviou_email from sub_area as s join participantes as p on s.cpf = p.cpf
			order by p.nome";
$resultado = mysql_query($sql);

$cor = "#95e197";

echo '<center><form name="form_representante" method="POST" action="representante.php">';
echo '<table border ="0" class="esquerda">
					<tr bgcolor=#61C02D >
						<td><font color="FFFFFF"><center><b><i>&nbsp;Sub Área&nbsp;</i></b></center></font></td>
						<td><font color="FFFFFF"><center><b><i>&nbsp;Nome&nbsp;</i></b></center></font></td>
						<td><font color="FFFFFF"><center><b><i>&nbsp;Enviou&nbsp;</i></b></center></font></td>						
					</tr>';


while ($campos = mysql_fetch_array($resultado)) {

    echo '<tr bgcolor="' . $cor . '">
							<td>' . $campos[nome_sa] . '</td>
							<td>' . $campos[nome] . '</td>';

    $email = $campos[enviou_email];

    if ($email == 1)
        echo '<td>Sim</td>';
    else
        echo '<td>Não</td>';

    if ($email != 1) {
        echo '<td><input type="checkbox" name="item[]" size="1" value="' . $campos[cpf_representante] . '"></td>';
    }

    echo '</tr>';

    if ($cor == "#78e07b")
        $cor = "#95e197";
    else
        $cor = "#78e07b";

}

echo '</table>
					<input type="hidden" name="envio" value="S">					
					<input type="submit" value="Enviar">
					</form><br></center>';
?>
</body>
</html>