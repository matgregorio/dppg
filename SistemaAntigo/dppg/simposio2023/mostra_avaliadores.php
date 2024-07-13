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
        <title> Selecionar Avaliadores </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <style type="text/css">
            #scroll {
                width: 700px;
                height: 400px;
                overflow: auto;
            }
        </style>
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
                var nome = document.form_inscricao.nomebusca.value;
                var nao = "nao";
                var url = "seleciona_participante.php";
                url = url + "?f=aexmo&n=" + nome + "&t=a" + "&a=" + nao;
                xmlHttp.open("POST", url);
                xmlHttp.onreadystatechange = mostrar_participantes;
                xmlHttp.send(null);
            }

            function mostrar_participantes() {
                if (xmlHttp.readyState == 4) {
                    document.getElementById("scroll").innerHTML = xmlHttp.responseText;
                }
            }
        </script>
    </head>
    <body>
    <div id="conteudo3">
        <center>
            <form name="form_inscricao" method="POST" onsubmit="javascript: return dados();"
                  action="form_cad_avaliadores.php">'
                <br>
                <center><b>Mostrar Avaliadores Externos</b></center>
                <br>

                <div id="filtro">
                    Digite o nome da pessoa:
                    <input type="text" name="nomebusca" onfocus="script: listar_participantes();"
                           onkeyup="script: listar_participantes();">
                </div>
                <div id="mensagem"></div>
                <script type="text/javascript">document.form_inscricao.nomebusca.focus();</script>
                <center><font color="#FF0000">OBS: Marque o nome do avaliador externo.</font></center>
                <br>

                <div id="scroll"></div>
            </form>
        </center>
    </div>
    </body>
    </html>
<?php
}
mysql_close($conexao);
?>
