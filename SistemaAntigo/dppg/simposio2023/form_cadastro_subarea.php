<?php
header('Content-Type: text/html; charset=utf-8');
?>
<html>
<head>
    <title> Cadastro Subárea </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/validasubarea.js" type="text/javascript"></script>
</head>
<body>
<?php include('includes/config.php'); ?>
<div id="conteudo3"><br>
    <center><b>Cadastro Subárea</b></center>
    <br>
    <center>
        <form name="form_cadastro_subarea" method="post" onsubmit="javascript: return checkcontatos()"
              action="cadastro_subarea.php">
            <table border="0" width="100%" class="esquerda">
                <tr>
                    <td align="center">Nome subárea:</td>
                    <td><input type="text" name="nome_sa" size="50"></td>
                </tr>
                <tr>
                    <td align="center">Grande Área:</td>
                    <td>
                        <?php
                        $sql = "select * from grande_area where nome_ga <> '-----'";
                        $resultado = mysql_query($sql);
                        echo '<select size="1" name="grandearea">';
                        while ($campos = mysql_fetch_array($resultado)) {
                            echo "<option value=$campos[codigo_ga]> $campos[nome_ga]</option>";
                        }
                        ?>
                    </td>
                </tr>
            </table>
            <input type="submit" value="OK">
        </form>
    </center>
</div>
</body>
</html>
