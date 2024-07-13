<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Alterar Artigo Acervo </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript">
            function GetXmlHttpObject() {
                var xmlHttp = null;
                try {
                    xmlHttp = new XMLHttpRequest();
                } catch (e) {
                    try {
                        xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                }
                return xmlHttp;
            }
            function mostrar_acervo(situacao) {
                xmlHttp = GetXmlHttpObject();
                if (xmlHttp == null) {
                    alert("Este Browser não suporta HTTP Request");
                    return;
                }
                if (situacao <= 6) {
                    var url = "../simposio2013/selecionar_acervo.php";
                } else {
                    var url = "selecionar_acervo.php";
                }
                url = url + "?ano=" + situacao;
                xmlHttp.open("GET", url);
                xmlHttp.onreadystatechange = listar;
                xmlHttp.send(null);
            }

            function listar() {
                if (xmlHttp.readyState == 4) {
                    document.getElementById("mostrar").innerHTML = xmlHttp.responseText;
                }
            }
        </script>
    </head>
    <body>
    <?php
    include('includes/config.php');

    $sql = "select * from ano order by ano asc";
    $resultado = mysql_query($sql);
    ?>
    <div id="conteudo3"><br>
        <center><b>Selecionar Acervo 2014</b></center>
        <br>
        <center>
            <form name="form_selecionar_acervo" method="post" action="selecionar_acervo.php">
                <table border="0" width="100%" class="esquerda">
                    <tr>
                        <td align="center">Selecione o ano:
                            <select name="ano" size="1" onclick="mostrar_acervo(this.value)">
                                <option value="0">---------</option>
                                <?php
                                while ($campos = mysql_fetch_array($resultado)) {
                                    echo "<option value='$campos[codigo_ano]'>$campos[ano]</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <hr>
                <dir id="mostrar">
                    <div id="acervo">
                        <br>
                        <center><b>Selecione um Ano!</b></center>
                        <br>
                    </div>
                </dir>
            </form>
        </center>
    </div>
    </body>
    </html>
    <?php
    mysql_close($conexao);
}
?>