<html>
<head>
    <script type="text/javascript">
        function Acionar(ano) {
            if (ano > 0) {
                document.form_acervo1.submit();
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
                } else if (ano == 7) {
                    var url = "../simposio2014/selecionar_titulo.php";
                }else{
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
$ano = mysql_real_escape_string($_POST[ano]);
include('includes/config.php');
$sql = "SELECT * FROM ano WHERE codigo_ano=$ano";
$resultado = mysql_query($sql);
$campo_ano = mysql_fetch_array($resultado);
if ($ano <= 5 && $ano >= 1) {
    echo"<center><br><b>Consultar Sumário de $campo_ano[ano]</b><br><br></center>";
    ?>
    <center>
        <form name="form_acervo1_old" method="POST" action="simposio.php">
            <table border="0" class="esquerda" width="40%">
                <tr>
                    <td>Título:</td>
                    <td><input type="text" name="titulo" size="30"></td>
                </tr>
                <tr>
                    <td>Autor:</td>
                    <td><input type="text" name="autor" size="30"></td>
                </tr>
                <tr>
                    <td>Palavra Chave:</td>
                    <td><input type="text" name="palavra_chave" size="30"></td>
                </tr>
            </table>
            <br>
            <?php echo"<input type='hidden' name='ano' value='$campo_ano[codigo_ano]'>"; ?>
            <input type="hidden" name="arquivo2" value="acervo.php">
            <input type="submit" value="Consultar">
        </form>
        <br>
        <a href="simposio.php?arquivo2=form_acervo1.php">Voltar</a>
        <br><br>
    </center>
<?php
} else if ($ano > 5) {
    $query_sa = mysql_query("SELECT codigo_sa, nome_sa FROM sub_area ORDER BY nome_sa ASC");
    echo"<center><br><b>Consultar Sumário de $campo_ano[ano]</b><br><br></center>";
    ?>
    <center>
        <form name="form_acervo1_new" method="post" action="simposio.php">
            <?php echo"<input id='ano' type='hidden' name='ano' value='$campo_ano[codigo_ano]'"; ?>
            <table border="0" class="esquerda">
                <tr>
                    <td>Subárea:</td>
                    <td>
                        <select id="sa" name="sa" style='width: 450px' onchange="script : listarCampos(this.value)" onclick="script : listarCampos(this.value)">
                            <option value="0"></option>
                            <option value="t">Todas</option>
                            <?php
                            while ($campos_sa = mysql_fetch_array($query_sa)) {
                                echo"<option value='$campos_sa[codigo_sa]'>$campos_sa[nome_sa]</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
            <div id="titulo"></div>
        </form>
        <br>
        <a href="simposio.php?arquivo2=form_acervo1.php">Voltar</a>
        <br><br>
    </center>
<?php
} else {
    $sql = "SELECT * FROM ano WHERE codigo_ano>5 AND codigo_ano<8 ORDER BY ano ASC";//trava a busca para o ano de anterior ao ano atual
    $resultado = mysql_query($sql);
    $result_participantes = mysql_query("SELECT cpf, nome FROM participantes WHERE cpf!='admin' ORDER BY nome");
    ?>
    <center>
        <br>
        <b>Consultar Sumário</b>
        <br><br>
        <form name="form_acervo1" method="POST" action="simposio.php?arquivo2=form_acervo1.php">
            <table border="0" class="esquerda" width="40%">
                <tr>
                    <td>Primeiro selecione o ano.</td>
                    <td align="left">
                        <select name="ano" size="1" onclick="script : Acionar(this.value)">
                            <option value="0"></option>';
                            <?php
                            while ($campos = mysql_fetch_array($resultado)) {
                                echo "<option value='$campos[codigo_ano]'>$campos[ano]</option>";
                            }
                            ?>
                        </select><font color="#FF0000"> *</font>
                    </td>
                </tr>
            </table>
            <br>
            <font size="3" color="#FF0000">* </font>Campo de preenchimento obrigatório</b>
            <!--<input type="hidden" name="arquivo2" value="form_acervo1.php">-->
        </form>
    </center>
<?php
}
?>
</body>
</html>