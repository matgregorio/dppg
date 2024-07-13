<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    if ($_SESSION[logado_simposio_2021]) {
        ?>
        <html>
        <head>
            <title> Alterar Corpo Editorial </title>
            <link rel="stylesheet" type="text/css" href="css/style.css">

            <!--<script type="text/JavaScript" src="js/valida_form_conteudo.js"></script>-->
            <script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
            <script language="javascript" type="text/javascript" src="js/tinymce.js"></script>

        </head>
        <body>
        <div id='conteudo3'>
            <?php
            include('includes/config.php');
            if ($_POST[s] == "s") {
                $informacoes = mysql_real_escape_string($_POST[conteudo]);
                $result = mysql_query("UPDATE conteudo SET informacoes='$informacoes' WHERE topo='corpoeditorial'");
                if ($result) {
                    echo '<br><center><font color="#006400"><b>Corpo Editorial <Atualizado></Atualizado> com Sucesso!!!</b></font></center><br><br>';
                } else {
                    echo '<br><center><font color="#640000"><b>Falha na atualização do Corpo Editorial</b></font></center><br><br>';
                }
                echo '<meta http-equiv="refresh" content="3; URL=form_corpoEditorial.php">';
            } else {
            $sql = "SELECT informacoes FROM conteudo WHERE topo = 'corpoeditorial'";
            $resultado = mysql_query($sql);

            $campos = mysql_fetch_array($resultado);
            ?>
            <br>
            <center><b>Alterar Corpo Editorial <b><br><br></center>
            <center>
                <form name='form_corpoEditorial' method='POST' action='form_corpoEditorial.php'>
                    <table border='0' class='esquerda'>
                        <tr>
                            <td align='center'>Conteúdo</td>
                        </tr>
                        <tr>
                            <?php echo "<td><textarea name='conteudo' rows='20' cols='80'>" . $campos[informacoes] . "</textarea></td>"; ?>
                        </tr>
                        <tr>
                            <td><br></td>
                        <tr>
                        <tr>
                            <td colspan='2' align='center'>
                                <input type='submit' name='salvar' value='Salvar'>
                                <input type='hidden' name='s' value='s'>
                            </td>
                        </tr>
                    </table>
                </form>
            </center>
        </div>
        <?php
        }
        mysql_close($conexao);
        ?>
        </body>
        </html>
    <?php
    }
}
?>