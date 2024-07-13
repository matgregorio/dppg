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
                    var url = "selecionar_trabalhos_iniciacao.php";
                    url = url + "?t=" + cSA;
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
        <center>
            <center><br><b>Trabalhos Aprovados<br><br>Modalidade: "Iniciação Científica" de 2016</b><br><br></center>
            <?php echo "<input type='hidden' name='ano' value='$ano'"; ?>
            <table border="0" class="esquerda">
                <tr>
                    <td>Tipo Iniciação:</td>
                    <td>
                        <select id="sa" name="sa" style='width: 250px' onchange="script : listarCampos(this.value)"
                                onclick="script : listarCampos(this.value)">
                            <option value="0">Selecione o Tipo</option>
                            <option value="Edu">Ensino - Estudos Orientados</option>
                              <option value="Ext">Extensão - Estudos Orientados</option>
                              <option value="T">Pesquisa/Iniciação - Técnico</option>
                              <option value="G">Pesquisa/Iniciação - Graduação</option>
                              <option value="L">Pesquisa - Lato Sensu</option>
                              <option value="S">Pesquisa - Stricto Sensu</option>
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
