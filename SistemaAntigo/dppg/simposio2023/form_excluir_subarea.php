<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Excluir Subárea </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <div id="conteudo3"><br>
        <center><b><i>Excluir Subárea</i></b></center>
        <br>
        <center>
            <form name="form_excluir_subarea" method="post" action="excluir_subarea.php">
                <table border="0" width="100%" class="esquerda">
                    <tr>
                        <td align="center">Selecione a subárea:&nbsp;
                            <?php
                            include('includes/config.php');
                            $sql = "select * from sub_area";
                            $resultado = mysql_query($sql);
                            echo '<select size="1" name="subarea">';
                            while ($campos = mysql_fetch_array($resultado)) {
                                echo "<option value='$campos[codigo_sa]'>$campos[nome_sa]</option>";
                            }
                            ?>
                            <select>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"><input type="submit" value="OK"></td>
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