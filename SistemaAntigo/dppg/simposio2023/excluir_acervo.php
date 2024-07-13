<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    include('includes/config.php');
    $ano = mysql_real_escape_string($_POST[ano]);
    $query_ano = mysql_query("SELECT ano FROM ano WHERE codigo_ano='$ano'");
    $campos_ano = mysql_fetch_array($query_ano);
    if ($ano < 6) {
        $sql = "select * from acervo where codigo_ano = '$ano'";
    } else {
        $sql = "SELECT a.codigo_ano, a.codigo_trab, t.titulo FROM acervo a, trabalhos t WHERE a.codigo_ano='6' AND t.codigo_trab=a.codigo_trab";
    }

    $resultado = mysql_query($sql);
    ?>
    <html>
    <head>
        <title> Excluir Artigo </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <div id="conteudo3"><br>
        <?php if (mysql_num_rows($resultado) > 0) { ?>
            <center><b>Excluir Artigo do Acervo</b></center>
            <?php echo "<br><center><b>Total de Artigos do Acervo de $campos_ano[ano]: " . mysql_num_rows($resultado) . "</b></center><br>"; ?>
            <center>
                <form name="form_excluir_artigo" method="post" action="excluir_acervo2.php">
                    <table id="individual" border="0" class="esquerda" style="display: block">
                        <tr bgcolor="#61C02D">
                            <td align="center"><font color="#ffffff"><b>Título</b></font></td>
                            <td align="center"><font color="#ffffff"><b>Alterar</b></font></td>
                        </tr>
                        <?php
                        while ($campos = mysql_fetch_array($resultado)) {
                            echo '<tr class="linha">';
                            echo '<td>' . $campos[titulo] . '</td>';
                            echo '<td align="center"><a href="excluir_acervo2.php?c=' . $campos[codigo_acervo] . '&a=' . $ano . '"><img src="images/delete.png" border="0"></a></td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                </form>
            </center>
        <?php
        } else {
            echo "<br><center><b>Não há Acervo</b></center><br>
    <center><b><a href='form_excluir_acervo.php'>Voltar</a></b></center><br>";
        }
        ?>
    </div>
    </body>
    </html>
    <?php
    mysql_close($conexao);
}
?>