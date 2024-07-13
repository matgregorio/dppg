<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    include('includes/config.php');

    $sql = "select * from ano order by ano asc";
    $resultado = mysql_query($sql);
    ?>
    <html>
    <head>
        <title> Excluir Artigo Acervo </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <div id="conteudo3"><br>
        <center><b>Excluir Acervo</b></center>
        <br>
        <center>
            <form name="form_excluir_acervo" method="post" action="excluir_acervo.php">
                <table border="0" width="100%" class="esquerda">
                    <tr>
                        <td align="center">Selecione o ano:
                            <select name="ano" size="1">
                                <?php
                                while ($campos = mysql_fetch_array($resultado)) {
                                    echo "<option value='$campos[codigo_ano]'>$campos[ano]</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <input type="submit" value="OK">
            </form>
        </center>
    </div>
    </body>
    </html>
    <?php
    mysql_close($conexao);
}
?>