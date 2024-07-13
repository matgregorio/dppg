<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo]))
{
    $validar=$_SESSION[cpf];
//    echo "CPF = $validar";
    include "acentuacao.php";
    include './controle_prazos.php';
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

            function listar_trabalhos() {
                xmlHttp = GetXmlHttpObject();
                if (xmlHttp == null) {
                    alert("Este Browser não suporta HTTP Request");
                    return;
                }
                var codigo = document.form_inscricao.subarea.value;
                //var area = document.getElementById("area").value;
                var radios = document.getElementsByName("area");
                for (var i = 0; i < radios.length; i++) {
                    if (radios[i].checked) {
                        console.log("Escolheu: " + radios[i].value);
                        var area = radios[i].value;
                    }
                }
                var url = "listar_trabalhos.php";
                url = url + "?s=" + codigo + "&a=" + area;
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
    if ($_POST[s] == 's')
    {
        include './includes/config.php';


        $cpfAvaliador = mysql_real_escape_string($_POST[participante]);
        $codTrabalhos = $_POST[trabalhos];

        $vcpf= mysql_real_escape_string($_POST[validar]);// cpf de quem está logado
        $validar = mysql_fetch_array(mysql_query("SELECT * FROM grupo_pro WHERE cpf='$vcpf' AND codigo_grupo='1'"));
        $validar2 = mysql_fetch_array(mysql_query("SELECT * FROM grupo_pro WHERE cpf='$cpfAvaliador' AND codigo_grupo='7'"));

        // echo "<p>SELECT * FROM grupo_pro WHERE cpf='$vcpf' AND codigo_grupo='1'<p>";
        // echo "SELECT * FROM grupo_pro WHERE cpf='$cpfAvaliador' AND codigo_grupo='7'</p>";

        foreach ($codTrabalhos as $cod)
        {
            $titulo = mysql_fetch_array(mysql_query("SELECT * FROM trabalhos WHERE codigo_trab='$cod'"));
            // echo "SELECT * FROM trabalhos WHERE codigo_trab='$cod'</p>";
            // echo "Logado/$validar[area] == projeto/$titulo[tipo_projeto] == avaliador/$validar2[area]<p>";
            if ((($validar[area] == $titulo[tipo_projeto]) or ($validar[area] == 'T')) and (($titulo[tipo_projeto] == $validar2[area]) or ($validar2[area] == 'T')))
            {
                $ok = 0;
                // echo "SELECT codigo_trab, cpf FROM avaliador_trab WHERE cpf='$cpfAvaliador' AND codigo_trab='$cod'";
                if (mysql_num_rows(mysql_query("SELECT codigo_trab, cpf FROM avaliador_trab WHERE cpf='$cpfAvaliador' AND codigo_trab='$cod'")) == 1)
                {
                    $ok = 0;
                }
                else
                {
                    $data = date('Y-m-d');
                    $sql_ap = "INSERT INTO avaliador_trab (codigo_trab, cpf, data) values ('$cod','$cpfAvaliador', '$data')";
                    $res_ap = mysql_query($sql_ap);
                    $ok = 1;
                }
                if ($ok == 0) {
                    echo "<br><br><center><font color='#640000'><u>Erro! </u><b>$titulo[titulo]</b> - Já está em posse do avaliador!</font></center><br>";
                } else {
                    echo "<br><br><center><font color='#006400'><b>$titulo[titulo]</b> - Enviado para o avaliador avaliador!</font></center><br>";
                }
            }
            else
            {
                if (($validar[area] != $titulo[tipo_projeto]) and ($validar[area] != 'T'))
                {
                    echo "<br><br><center><font color='#640000'>Você não pode fazer essa associação!<br />O trabalho <b>$titulo[titulo]</b> não é da sua área!</font></center><br>";
                }
                else if (($titulo[tipo_projeto] != $validar2[area]) and ($validar2[area] != 'T'))
                {
                    echo "<br><br><center><font color='#640000'>Você não pode fazer essa associação!<br />O trabalho <b>$titulo[titulo]</b> não é da mesma área do avaliador!</font></center><br>";
                }

                // echo "Logado/$validar[area] == projeto/$titulo[tipo_projeto] == avaliador/$validar2[area]<p>";
                //echo "<br><br><center><font color='#640000'><u>Erro! </u><b>$titulo[titulo]</b> - Você não pode fazer essa associação!</font></center><br>";
            }
        }
        if ($ok == 1)
        {
            /***********************************************Email que é enviado ao avaliador externo quando existe um trabalho para ele avaliar *******************************/

            $sql1 = "SELECT p.cpf , p.email FROM participantes p WHERE p.cpf = '$cpfAvaliador'";
            $resultado1 = mysql_query($sql1);
            $campos1 = mysql_fetch_array($resultado1);

            $sql2 = "SELECT caminho_formulario FROM formularios WHERE codigo_formulario='10'";
            $resultado2 = mysql_query($sql2);
            $campos2 = mysql_fetch_array($resultado2);
            $data = $campos2[caminho_formulario];
            $data_formatada = date( 'd/m/Y' , strtotime($data));

            $sqlEmailAvaliadorExternoTrabalhoVinculado = mysql_query("SELECT * FROM `email` WHERE tipo_destinatario = 'avaliador_externo_trabalho_vinculado'") or die("<h1>Houve um erro na conexão com o banco de dados.</h1>");
            $dadosEmailAvaliadorExternoTrabalhoVinculado = mysql_fetch_array($sqlEmailAvaliadorExternoTrabalhoVinculado);
            $assuntoEmailAvaliadorExterno = $dadosEmailAvaliadorExternoTrabalhoVinculado[assunto];
            $mensagemEmailAvaliadorExterno = $dadosEmailAvaliadorExternoTrabalhoVinculado[mensagem];
            $remetenteEmailAvaliadorExterno = $dadosEmailAvaliadorExternoTrabalhoVinculado[remetente];

            $to = $campos1[email];

            //$subject = 'Envio de trabalhos';
            $subject = $assuntoEmailAvaliadorExterno;

//            $message = 'Prezado(a) Senhor(a)
//            Vossa senhoria foi indicada para colaborar na avaliação e parecer de resumos simples submetidos para o XII SIMPÓSIO DE CIÊNCIA, INOVAÇÃO & TECNOLOGIA a ser realizado nos dias 21 e 22 de outubro de 2021 no Instituto Federal de Educação, Ciência e Tecnologia do Sudeste de Minas Gerais – Campus Rio Pomba. A avaliação é rápida, bastando emitir notas para cada quesito a ser avaliado e no final o trabalho será aprovado caso a nota seja maior ou igual a 60 pontos.
//
//            Para acessar segue o link abaixo.
//            https://sistemas.riopomba.ifsudestemg.edu.br/simposio2021/simposio.php
//
//            O prazo para a avaliação termina no dia '. $data_formatada .'.';

            $message = $mensagemEmailAvaliadorExterno;

            $cabecalhoEmailAvaliadorExterno =  "From: ". $remetenteEmailAvaliadorExterno . "\r\n";
            $cabecalhoEmailAvaliadorExterno .= "To: Avaliador Externo Simpósio <$to>" . "\r\n";
            $cabecalhoEmailAvaliadorExterno .= "Reply-To: Diretoria de Pesquisa e Pós Graduação <dppg.riopomba@ifsudestemg.edu.br>\r\n";
            $cabecalhoEmailAvaliadorExterno .= "Return-Path: dppg.riopomba@ifsudestemg.edu.br\r\n";
            $cabecalhoEmailAvaliadorExterno .= "Organization: Diretoria de Pesquisa e Pós Graduação\r\n";
            $cabecalhoEmailAvaliadorExterno .= "X-Priority: 3\r\n";
            $cabecalhoEmailAvaliadorExterno .= "X-Mailer: PHP". phpversion() ."\r\n" ;
            $cabecalhoEmailAvaliadorExterno .= "MIME-Version: 1.0\r\n";
            $cabecalhoEmailAvaliadorExterno .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            //$headers = 'From: dppg.riopomba@ifsudestemg.edu.br' . "\r\n";
            $headers = $cabecalhoEmailAvaliadorExterno;

            if(isset($to, $subject, $message, $headers))
            {
                if(mail($to, $subject, $message, $headers))
                {
//                echo "<br><br><br><br><br><br><br>";
//                echo "<font size='30' color='#228b22'> <center>Email enviado com sucesso</center></font><br>";
                }
                else
                {
                    echo "<br><br><br><br><br><br><br>";
                    echo "<font size='30' color='red'> <center>Falha no envio do email para o Orientador</center></font><br>";
                }
            }
            else
            {
                echo "<br><br><br><br><br><br><br>";
                echo "<font size='30' color='#228b22'> <center>Falha no carregamento de dados para envio do email para o orientador</center></font><br>";
            }


        }


//        } else {
//          echo '<BR><BR><center><font color="#FF0000"><b>Limite de 3 trabalhos por Avaliador!!!</b></font></center><br>';
//        }
        ?>
        <center><a href="simposio.php?arquivo2=listagem_trabalhos.php">Voltar</a></center>
        <?php
//        echo '<meta http-equiv="refresh" content="3; URL=simposio.php?arquivo2=listagem_trabalhos.php" />';
    } else {
        include './includes/config.php';
        ?>
        <form name="form_inscricao" method="POST" action="simposio.php?arquivo2=listagem_trabalhos.php">
            <br>
            <center><b>Enviar trabalhos para Avaliadores Externos</b></center>
            <br>
            <center>
                <a href="simposio.php?arquivo2=opcao_avaliador.php">Voltar</a>
                <br>
                </p>Selecione o Tipo:
                <input type="radio"   name="area" value="Pes" checked = checked>Pesquisa
                <!--                <input type="radio"   name="area" value="Ext" checked="checked" >Extensão-->
                <!--                <input type="radio"   name="area" value="Edu">Ensino-->
                </p>
                <br>Selecione a sub&aacute;rea:
                <select name="subarea" onfocus="script: listar_trabalhos();" onclick="script: listar_trabalhos();"
                        onchange="listar_trabalhos()">
                    <?php
                    include './includes/config.php';
                    echo "<option value='0'>Selecione</option>";
                    $resultado = mysql_query("SELECT codigo_sa, nome_sa FROM sub_area ORDER BY nome_sa");
                    while ($campos = mysql_fetch_array($resultado)) {
                        echo "<option value='$campos[codigo_sa]'>$campos[nome_sa]</option>";
                    }
                    ?>
                </select>
                <br><br>Selecione o(a) Avaliador(a):

                <table border="0">
                    <?php
                    include './includes/config.php';
                    $x = '<script>document.write("area")</script>';
                    //echo "valor = $x";
                    $resultado = mysql_query("SELECT nome, cpf FROM participantes WHERE cpf IN (SELECT cpf FROM grupo_pro WHERE codigo_grupo='7') ORDER BY nome");
                    //$resultado = mysql_query("SELECT p.nome, p.cpf, g.area FROM participantes p, grupo_pro g WHERE p.cpf IN (SELECT cpf FROM grupo_pro WHERE codigo_grupo='7') ORDER BY nome");
                    //echo "$resultado";
                    $cont = 1;
                    $a = 0;
                    while ($campos = mysql_fetch_array($resultado))
                    {
                        //$sas = "SELECT * FROM grupo_pro WHERE cpf = ".$campos[cpf]." and codigo_grupo='7'";
                        $sas = "select s.nome_sa from sub_area s INNER JOIN participantes p on p.codigo_sa = s.codigo_sa AND p.cpf = $campos[cpf]";
                        $sss = mysql_query($sas);
                        $area = mysql_fetch_array($sss);

//                        if ($area[area] == "Pes")
//                        {
//                            $areaA = " <b>Eixo: Pesquisa</b>";
//                        }
//                        elseif ($area[area] == "Ext")
//                        {
//                            $areaA = " <b>Eixo: Extensão</b>";
//                        }
//                        elseif ($area[area] == "Edu")
//                        {
//                            $areaA = " <b>Eixo: Ensino</b>";
//                        }
//                        elseif ($area[area] == "T")
//                        {
//                            $areaA = " <b>Eixo: Todas</b>";
//                        }
//                        else
//                        {
//                            $areaA = "";
//                        }
                        $areaA = "<br>" . "Sub-área:" ."<font color = '#00AE4F'>". "$area[nome_sa]" . "</font>". "<br> <br>";
                        //echo '<br>';
                        $quant = mysql_num_rows(mysql_query("SELECT cpf FROM avaliador_trab WHERE cpf=$campos[cpf]"));
                        if ($cont == 1)
                        {
                            echo "<tr bgcolor='#E0EEEE'>";
                        }
//              if (($a == 0 ) && ($quant < 3))
                        if ($a == 0)
                        {
                            echo "<td width='500' align='left'><input type='radio' name='participante' checked value='$campos[cpf]' >$campos[nome]$areaA</td>";
                            $a = 1;
//              } else if ($quant < 3) {
                        }
                        else if ($a == 1)
                        {
                            echo "<td width='500' align='left'><input type='radio' name='participante' value='$campos[cpf]' >$campos[nome]$areaA</td>";
//              } else {
//                echo "<td>$campos[nome]</td>";
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
                document.form_inscricao.subarea.focus();
            </script>
            <hr>
            <div id="trabalhos"></div>
            <hr>
            <input type="hidden" name="s" value="s">
            <input type="hidden" name="validar" value="<?php echo"$validar"; ?>">
            <center><input id="enviar" type="submit" style="display: none" name="Enviar" value="Enviar Trabalhos">
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
