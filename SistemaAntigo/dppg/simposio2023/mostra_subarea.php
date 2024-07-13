<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title>Mostrar Subárea</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <?php
    include('includes/config.php');
    $sql = "SELECT * FROM sub_area sa, grande_area ga WHERE	sa.codigo_ga = ga.codigo_ga ORDER BY sa.nome_sa ";
    $resultado = mysql_query($sql);
    ?>
    <div id="conteudo3">
        <br>
        <center><b>Mostrar Subárea</b></center>
        <br>
        <center>
            <table border="0" width="60%" class="esquerda">
                <tr bgcolor="#61C02D">
                    <td>
                        <center><font color="#FFFFFF"><b><i>&nbsp;&nbsp;Subáreas Cadastradas&nbsp;&nbsp;</i></b></font>
                            <center>
                    </td>
                    <td>
                        <center><font color="#FFFFFF"><b><i>&nbsp;&nbsp;Grande Área&nbsp;&nbsp;</i></b></font>
                            <center>
                    </td>
                </tr>
                <?php
                while ($campos = mysql_fetch_array($resultado)) {
                    echo '<tr class="linha">
					<td>' . $campos[nome_sa] . '</td>
					<td>' . $campos[nome_ga] . '</td>
				</tr>';
                }
                ?>
            </table>
        </center>
        <br>
    </div>
    </body>
    </html>
    <?php
    mysql_close($conexao);
}
?>