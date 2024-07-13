<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    include "acentuacao.php";
    ?>
    <html>
    <head>
        <title> Lista de Permissões </title>
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

            function listar_participantes() {
                xmlHttp = GetXmlHttpObject();
                if (xmlHttp == null) {
                    alert("Este Browser não suporta HTTP Request");
                    return;
                }
                if (document.form_permissao.tipo.checked) {
                    var tipo = 'a';
                }
//          else if (document.form_permissao.tipo[1].checked) {
//            var tipo = 'c';
//          }
                var nome = document.form_permissao.nome.value;
                var url = "seleciona_participante.php";
                url = url + "?f=mo&n=" + nome + "&t=" + tipo;
                xmlHttp.open("POST", url);
                xmlHttp.onreadystatechange = mostrar_participantes;
                xmlHttp.send(null);
            }

            function mostrar_participantes() {
                if (xmlHttp.readyState == 4) {
                    document.getElementById("lista_participantes").innerHTML = xmlHttp.responseText;
                }
            }
        </script>
    </head>
    <body>
    <div id="conteudo3">
        <form name="form_permissao" action="">
            <center>
                <br>
                <center><b>Participantes com permissões</b></center>
                <br>
                <hr>
                <table>
                    <tr>
                        <td>
                            <input type="radio" name="tipo" onclick="script: listar_participantes()" checked="true">Administrador
                        </td>
                        <!--<td><input type="radio" name="tipo" onclick="script: listar_participantes()" checked="true">Comissionistas</td>-->
                    </tr>
                </table>
                <div id="filtro">
                    Digite o nome da pessoa:
                    <input type="text" name="nome" onfocus="script: listar_participantes()"
                           onkeyup="script: listar_participantes()">
                </div>
                <script type="text/javascript">
                    document.form_permissao.nome.focus()
                </script>
                <hr>
                <div id="mensagem"></div>
                <div id="lista_participantes"></div>
            </center>
        </form>
    </div>
    </body>
    </html>
    <?php
    mysql_close($conexao);
}
?>