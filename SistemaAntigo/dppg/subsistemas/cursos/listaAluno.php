<?php
session_start();
$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('1'));
$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('2'));

if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm)) {    //echo'<script type="text/javascript" src="js/trabalhos.js"></script>';
    include'includes/config2.php';
    $resultAluno = mysql_query("SELECT cpf, nome FROM participantes WHERE cpf IN (SELECT cpfAluno FROM projetosparticipantes) ORDER BY nome");
    mysql_close($conexao);
    ?>
    <html>
    <head>
        <title> Editar Dados </title>
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
            //---------------------------------------------------------------------------------------------------------

            function listar_dados(cpf) {
                xmlHttp = GetXmlHttpObject();
                if (xmlHttp == null) {
                    alert("Este Browser não suporta HTTP Request");
                    return;
                }
                var url = "subsistemas/cursos/listarDadosProjeto.php";
                url = url + "?f=" + cpf;
                xmlHttp.open("GET", url);
                xmlHttp.onreadystatechange = mostrar_participantes;
                xmlHttp.send(null);
            }


            function mostrar_participantes() {
                if (xmlHttp.readyState == 4) {
                    document.getElementById("lista_projetos").innerHTML = xmlHttp.responseText;
                }
            }
            
            function newPopup(cpf)
            {
                
                varWindow = window.open ('subsistemas/cursos/formListaProjetosParticipantes.php?cpf='+cpf, 'Listagem de dados');
            }
            
        </script>
    </head>
    <body>
    <form name="" action="">
        <center>
            <br>
            <center><b>Selecione o Nome do Aluno</b></center>
            <br>
            <div id="filtro" style="overflow: auto; height: 600px;">
              <table>
                    <?php
                    $cont = 0;
                    while($campoAluno = mysql_fetch_array($resultAluno)){
                        if ($cont == 0){
                            echo "<tr>";
                            echo "<td style='border: 1px dotted;'>"
                                    . "<input id='$campoAluno[cpf]' type='radio' name='a' value='$campoAluno[cpf]' onclick='javascript : newPopup($campoAluno[cpf]);' onchange='javascript : newPopup($campoAluno[cpf]);'>$campoAluno[nome] $campoAluno[cpf]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                               . "</td>";
                            $cont = 1;
                        }
                        else
                        {
                            echo "<td style='border: 1px dotted;'>"
                            .       "<input id='$campoAluno[cpf]' type='radio' name='a' value='$campoAluno[cpf]' onclick='javascript : newPopup($campoAluno[cpf]);' onchange='javascript : newPopup($campoAluno[cpf]);'>"
                                    . "$campoAluno[nome] . '$campoAluno[cpf]";' .  </td>';
                            echo"</tr>";
                            $cont = 0;
                        }
                    }
                    ?>
                </table>
            </div>
            <hr>
            <div id="mensagem"></div>
            <br>
            <div id="lista_projetos"></div>
        </center>
    </form>
    </body>
    </html>
    <?php
}
?>