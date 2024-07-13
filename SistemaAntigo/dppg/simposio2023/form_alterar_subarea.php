<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Alterar Subárea </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <div id="conteudo3"><br>
        <center><b>Alterar Subárea</b></center>
        <br>
        <center>
            <form name="form_alterar_subarea" method="post" action="alterar_subarea.php">
                <table border="0" width="100%" class="esquerda">
                    <tr>
                        <td align="center">Selecione a subárea:&nbsp;
                            <select size="1" name="subarea">
                                <?php
                                include('includes/config.php');
                                $sql = "select * from sub_area order by nome_sa";
                                $resultado = mysql_query($sql);
                                while ($campos = mysql_fetch_array($resultado)) {
                                    echo "<option value='$campos[codigo_sa]'>$campos[nome_sa]</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"><input type="submit" value="OK"></td>
                    </tr>
                    <tr>
                        <td><input type="hidden" name="alterar" value="S"></td>
                    </tr>
                </table>
            </form>
        </center>
    </div>
    </body>
    </html>
    <?php
    mysql_close($conexao);
}
?>