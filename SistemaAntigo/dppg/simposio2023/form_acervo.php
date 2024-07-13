<html>
<head>
    <script type="text/javascript">
        function Acionar(ano) {
            if (ano > 0) {
                document.form_acervo.submit();
            }
        }
    </script>
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

        function listarCampos(cSA) {
            xmlHttp = GetXmlHttpObject();
            if (xmlHttp == null) {
                alert("Este Browser não suporta HTTP Request");
                return;
            }
            if (cSA != 0) {
                var ano = document.getElementById('ano').value;
                if (ano == 6) {
                    var url = "../simposio2013/selecionar_titulo.php";
                } else if (ano > 6) {
                    var url = "selecionar_titulo.php";
                }
                url = url + "?sa=" + cSA;
                xmlHttp.open("GET", url);
                xmlHttp.onreadystatechange = mostrarCampos;
                xmlHttp.send(null);
            } else {
                document.getElementById("titulo").innerHTML = "";
            }
        }

        function mostrarCampos() {
            if (xmlHttp.readyState == 4) {
                document.getElementById("titulo").innerHTML = xmlHttp.responseText;
            }
        }
    </script>
</head>
<body>
<?php
include('includes/config.php');
$sql = "SELECT * FROM ano WHERE codigo_ano=8";//codigo da edição de 2015
$resultado = mysql_query($sql);
$campo_ano = mysql_fetch_array($resultado);

    $query_sa = mysql_query("SELECT codigo_sa, nome_sa FROM sub_area ORDER BY nome_sa ASC");
    echo "<center><br><b>Consultar Sumário de $campo_ano[ano]</b><br><br></center>";
    ?>
    <center>
        <form name="form_acervo_new" method="post" action="simposio.php">
            <?php echo "<input id='ano' type='hidden' name='ano' value='$campo_ano[codigo_ano]'"; ?>
            <table border="0" class="esquerda">
                <tr>
                    <td>Subárea:</td>
                    <td>
                        <select id="sa" name="sa" style='width: 450px' onchange="script : listarCampos(this.value)"
                                onclick="script : listarCampos(this.value)">
                            <option value="0"></option>
                            <option value="t">Todas</option>
                            <?php
                            while ($campos_sa = mysql_fetch_array($query_sa)) {
                                echo "<option value='$campos_sa[codigo_sa]'>$campos_sa[nome_sa]</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
            <div id="titulo"></div>
        </form>
        <br>
        <a href="simposio.php?arquivo2=form_acervo.php">Voltar</a>
        <br><br>
    </center>
</body>
</html>