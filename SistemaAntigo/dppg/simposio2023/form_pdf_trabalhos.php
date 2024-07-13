<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    include "acentuacao.php";
    ?>
    <html>
    <head>
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

            function listarCampos(cSA) {
                xmlHttp = GetXmlHttpObject();
                if (xmlHttp == null) {
                    alert("Este Browser não suporta HTTP Request");
                    return;
                }
                if (cSA != 0) {
                    var radios = document.getElementsByName("area");
                   for (var i = 0; i < radios.length; i++) {
                       if (radios[i].checked) {
                           console.log("Escolheu: " + radios[i].value);
                           var area = radios[i].value;
                       }
                   }
                  // alert(area);
                    var url = "selecionar_trabalhos.php";
                    url = url + "?sa=" + cSA + "&a=" + area;
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
    <div id="conteudo3">
        <?php
        include('includes/config.php');
        $ano = 6;

        $query_sa = mysql_query("SELECT codigo_sa, nome_sa FROM sub_area ORDER BY nome_sa ASC");
        ?>
        <center>
            <center><br><b>Trabalhos Aprovados de 2019</b><br><br></center>
            <?php echo "<input type='hidden' name='ano' value='$ano'"; ?>
            <table border="0" class="esquerda">
                <tr>
                    <td>Selecione o Tipo:</td>
                    <td>
                        <input type="radio"   name="area" value="Pes" checked="true">Pesquisa
                        <input type="radio"   name="area" value="Ext">Extensão
                        <input type="radio"   name="area" value="Edu">Ensino
                    </p>
                    </td>
                </tr>
                <tr>
                    <td>Sub Área:</td>
                    <td>
                        <select id="sa" name="sa" style='width: 450px' onchange="script : listarCampos(this.value)"
                                onclick="script : listarCampos(this.value)">
                            <option value="0"></option>
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
            <br><br>
        </center>
    </div>
    </body>
    </html>
<?php
}
?>
