<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    include "acentuacao.php";
    ?>
    <html>
    <head>
        <style type="text/css">
            #scroll {
                width: 750px;
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

            function listar_trabalhos(s) {
                xmlHttp = GetXmlHttpObject();
                if (xmlHttp == null) {
                    alert("Este Browser não suporta HTTP Request");
                    return;
                }
                document.getElementById("enviar").style.display = 'none';
                var url = "listar_trabalhos_avaliadores.php";
                url = url + "?s=" + s;
                xmlHttp.open("POST", url);
                xmlHttp.onreadystatechange = mostrar_participantes;
                xmlHttp.send(null);
            }

            function mostrar_participantes() {
                if (xmlHttp.readyState == 4) {
                    document.getElementById("trabalhos").innerHTML = xmlHttp.responseText;
                }
            }

            function liberar() {
                var chk = document.getElementsByName("trabalhos[]");
                var quant = 0;
                for (var i = 0; i < chk.length; i++) {
                    if (chk[i].checked == true) {
                        quant++;
                    }
                }
                if (quant == 0) {
                    document.getElementById("enviar").style.display = 'none';
                } else if (quant > 0) {
                    document.getElementById("enviar").style.display = '';
                }
            }
        </script>
    </head>
<body>
    <?php
    if ($_POST[s] == 's') {
        include './includes/config.php';

        $cpfAvaliador = mysql_real_escape_string($_POST[participante]);
        $codTrabalhos = $_POST[trabalhos];
        foreach ($codTrabalhos as $cod) {
            $sql_ap = "DELETE FROM avaliador_trab WHERE codigo_trab='$cod' AND cpf='$cpfAvaliador' AND avaliado='0'";
            $res_ap = mysql_query($sql_ap);
            if ($res_ap) {
                echo "<br><br><center><font color='#006400'>Trabalho retirado com sucesso!</font></center><br>";
            } else {
                echo "<br><br><center><font color='#640000'><u>Erro ao retirar o trabalho do avaliador!</font></center><br>";
            }
        }
        ?>
        <center><a href="simposio.php?arquivo2=remover_trab_avaliador.php">Voltar</a></center>
<?php
//        echo '<meta http-equiv="refresh" content="3; URL=simposio.php?arquivo2=listagem_trabalhos.php" />';
    } else {
        ?>
        <form name="form_inscricao" method="POST" action="simposio.php?arquivo2=remover_trab_avaliador.php">
            <br>
            <center><b>Remover Trabalhos Não Avaliados</b></center>
            <br>
            <center>
                <a href="simposio.php?arquivo2=opcao_avaliador.php">Voltar</a>
                <br>
                <br><br>Selecione o(a) Avaliador(a):
                <table border="0">
                    <?php
                    include './includes/config.php';
                    $resultado = mysql_query("SELECT nome, cpf FROM participantes WHERE cpf IN (SELECT cpf FROM grupo_pro WHERE codigo_grupo='7') ORDER BY nome");
                    $cont = 1;
                    $a = 0;
                    while ($campos = mysql_fetch_array($resultado)) {
                        //$sas = "SELECT * FROM grupo_pro WHERE cpf = ".$campos[cpf]." and codigo_grupo='7'";
                        $sas = "select s.nome_sa from sub_area s INNER JOIN participantes p on p.codigo_sa = s.codigo_sa AND p.cpf = $campos[cpf]";
                        $sss = mysql_query($sas);
                        $area = mysql_fetch_array($sss);
//                        if ($area[area] == "Pes")
//                        {
//                            $areaA = " <b>Área: Pesquisa</b>";
//                        }
//                        elseif ($area[area] == "Ext")
//                        {
//                            $areaA = " <b>Área: Extensão</b>";
//                        }
//                        elseif ($area[area] == "Edu")
//                        {
//                            $areaA = " <b>Área: Ensino</b>";
//                        }
//                        elseif ($area[area] == "T")
//                        {
//                            $areaA = " <b>Área: Todas</b>";
//                        }
//                        else
//                        {
//                            $areaA = "";
//                        }

                        $areaA = "<br>" . "Sub-área:" ."<font color = '#00AE4F'>". "$area[nome_sa]" . "</font>". "<br> <br>";

                        $quant = mysql_num_rows(mysql_query("SELECT cpf FROM avaliador_trab WHERE cpf=$campos[cpf] AND avaliado='0'"));
                        if ($cont == 1) {
                            echo "<tr bgcolor='#E0EEEE'>";
                        }
                        if ($a == 0) {
//                echo"<td width='300' align='left'><input type='radio' name='participante' onfocus='script: listar_trabalhos(this.value);' onclick='script: listar_trabalhos(this.value);' onchange='listar_trabalhos(this.value)' checked value='$campos[cpf]' >$campos[nome]</td>";
                            echo "<td width='500' align='left'><input type='radio' name='participante' onfocus='script: listar_trabalhos(this.value);' onclick='script: listar_trabalhos(this.value);' onchange='listar_trabalhos(this.value)' value='$campos[cpf]' >$campos[nome]$areaA</td>";
                            $a = 1;
                        } else {
                            echo "<td width='500' align='left'><input type='radio' name='participante' onfocus='script: listar_trabalhos(this.value);' onclick='script: listar_trabalhos(this.value);' onchange='listar_trabalhos(this.value)' value='$campos[cpf]' >$campos[nome]$areaA</td>";
                        }
                        echo "<td>$quant</td>";
                        if ($cont == 2) {
                            echo "</tr>";
                            $cont = 0;
                        }
                        $cont++;
                    }
                    ?>
                </table>
            </center>
            <script type="text/javascript">
                //          document.form_inscricao.participante[0].focus();
            </script>
            <hr>
            <div id="trabalhos"></div>
            <hr>
            <input type="hidden" name="s" value="s">
            <center><input id="enviar" type="submit" style="display: none" name="Enviar" value="Remover Trabalhos">
            </center>
            <br><br>
        </form>
        </body>
        </html>
    <?php
    }
}
mysql_close($conexao);
?>
