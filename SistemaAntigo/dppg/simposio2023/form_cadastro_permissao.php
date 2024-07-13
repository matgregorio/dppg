<?php
/*
 * Utiliza um arquivo java script na pasta js e outro que seleciona os trabalhos de acordo
 * com a opção selecionada chamado seleciona_trabalhos.php
 */
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    include "acentuacao.php";
    //echo'<script type="text/javascript" src="js/trabalhos.js"></script>';
    ?>
    <html>
    <head>
        <title> Adicionar Permições </title>
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

            function alterar_permissao(cpf) {
                if (document.form_permissao.tipo.checked) {
                    var codigo = '1';
                }
//          else if (document.form_permissao.tipo[1].checked) {
//            var codigo = '4';
//          }
                xmlHttp = GetXmlHttpObject();

                var radios = document.getElementsByName("area");
                for (var i = 0; i < radios.length; i++) {
                    if (radios[i].checked) {
                        console.log("Escolheu: " + radios[i].value);
                        var area = radios[i].value;
                    }
                }
                //alert(area);
                var cpf = cpf;
                var url = "alterar_permissao.php";
                url = url + "?f=ca&c=" + codigo + "&cc=" + cpf + "&a=" + area;
                xmlHttp.open("POST", url);
                xmlHttp.onreadystatechange = mostrar_mensagem;
                xmlHttp.send(null);
            }
            function mostrar_mensagem() {
                if (xmlHttp.readyState == 4) {
                    document.getElementById("mensagem").innerHTML = xmlHttp.responseText;
                    document.getElementById("lista_participantes").innerHTML = '';
                    setTimeout("clearDiv()", 3000);
                }
            }

            function clearDiv() {
                document.getElementById("mensagem").innerHTML = "";
                document.form_permissao.nome.value = '';
                document.form_permissao.nome.focus();
                listar_participantes();
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
                url = url + "?f=ca&n=" + nome + "&t=" + tipo;
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
                <center><b>Selecione o tipo de permissão a ser concedida:</b></center>
                <br>
                <table>
                    <tr>
                        <td>
                            <input type="radio" name="tipo" onclick="script: listar_participantes()" checked="true">Administrador
                        </td>
                        <!--                <td>
                                          <input type="radio" name="tipo" onclick="script: listar_participantes()" checked="true">Comissionistas
                                        </td>-->
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
                <center><font color="#FF0000">OBS: Marque o nome para alterar a permissão do participante.</font>
                </center>
                <br>

                <div id="mensagem"></div>
                <div id="lista_participantes"></div>
            </center>
        </form>
    </div>
    </body>
    </html>
<?php
}
?>
