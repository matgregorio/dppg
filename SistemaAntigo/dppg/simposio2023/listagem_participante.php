<?php

session_start();

if (in_array("1", $_SESSION[codigo_grupo])) {
    include('includes/config.php');


    echo '<br><br><center><b>Listagem dos Participantes</b><br><br>';
    echo '
		<form name="form_participante" method="POST" action="simposio.php">
		<table border="0">
		<tr>
		<td>Selecione o tipo de Participante:</td>
		<td>';

    include('combo_participante.php');

    echo '</td></tr>
		</table>
		<input type="hidden" name="arquivo2" value="listagem_participante.php">
		<input type="hidden" name="confirma" value="S">		
		<input type="submit" value="OK"></form></center>
		<hr align="center" width="500px" />		
		
		';

    if ($_POST[confirma] == 'S') {
        $participante = mysql_real_escape_string($_POST[participante]);

        $sql = "select * from participantes where codigo_tipo_participante='$participante'";
        $resultado = mysql_query($sql);


        $controle = 0;
        $quantidade = 1;
        echo '<center>';
        $cor = "#95e197";

        while ($campos = mysql_fetch_array($resultado)) {

            if ($controle == 0)
                echo '<br>
			<table>
			<tr bgcolor=#61C02D>
				<td><font color="FFFFFF"><center><b><i>N°</i></b></center></td>
				<td ><font color="FFFFFF"><center><b><i>Nome</i></b></center></font></td>
				<td ><font color="FFFFFF"><center><b><i>CPF</i></b></center></font></td>
				<td><font color="FFFFFF"><center><b><i>Email</i></b></center></font></td>
			</tr>';

            $controle = 1;
            echo '<tr bgcolor="' . $cor . '">
					<td>' . $quantidade . '</td>
					<td width="100">' . $campos[nome] . '</td>';
            echo '	<td>' . $campos[cpf] . '</td>';
            echo '	<td>' . $campos[email] . '</td></tr>';

            $quantidade++;
            if ($cor == "#78e07b")
                $cor = "#95e197";
            else
                $cor = "#78e07b";


        }

        echo '</table>';
        echo '</center><br>';
    }

    mysql_close($conexao);
}
?>