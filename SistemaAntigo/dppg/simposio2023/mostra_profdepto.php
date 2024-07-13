<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title>Mostrar Professores Área de Atuação </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <?php

    include('includes/config.php');

    /*$sql = "SELECT * FROM sub_area sa, grande_area ga, participantes p where
    sa.codigo_ga = ga.codigo_ga and sa.cpf = p.cpf order by sa.nome_sa ";
    $resultado = mysql_query($sql);
    */

    $sql = "SELECT *, nome_depto FROM departamento d, participantes p, grupo_pro gp where
 	p.codigo_depto = d.codigo_depto and gp.cpf = p.cpf and gp.codigo_grupo='2'";
    $resultado = mysql_query($sql);

    echo '<div id="conteudo3">';
    echo '<br><center><b>Mostrar A.A.P.</b></center><br>';

    echo '<center><table border="0" width="60%" class="esquerda">
			<tr bgcolor="#61C02D">
				<td><center><font color="#FFFFFF"><b><i>&nbsp;&nbsp;Área de Atuação&nbsp;&nbsp;</i></b></font><center></td>			
				<td><center><font color="#FFFFFF"><b><i>&nbsp;&nbsp;CPF Professor(a)&nbsp;&nbsp;</i></b></font><center></td>
				<td><center><font color="#FFFFFF"><b><i>&nbsp;&nbsp;Nome Professor(a)&nbsp;&nbsp;</i></b></font><center></td>
				<td><center><font color="#FFFFFF"><b><i>&nbsp;&nbsp;Visitante&nbsp;&nbsp;</i></b></font><center></td>
			</tr>';

    while ($campos = mysql_fetch_array($resultado)) {

        echo '<tr class="linha">
					<td>' . $campos[nome_depto] . '</td>
					<td>' . $campos[cpf] . '</td>
					<td>' . $campos[nome] . '</td>
					<td align="center">';

        if ($campos[visitante] == 1)
            echo "Sim";
        else
            echo "Não";

        echo '</td>
				</tr>';
    }
    echo '</table></center><br></div>';
    ?>

    </body>
    </html>
    <?php
    mysql_close($conexao);
}
?>