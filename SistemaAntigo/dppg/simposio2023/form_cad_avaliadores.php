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
                height: 170px;
                overflow: auto;
            }
        </style>
        <script type="text/javascript">
            function dados() {
                with (document.form_inscricao) {
                    if (cpf.value == "") {
                        alert("Por favor digite seu CPF!");
                        cpf.focus();
                        return false;
                    }

                    if ((cpf.value != "") && (cpf.value != "00000000000") && (cpf.value != "11111111111")
                        && (cpf.value != "22222222222") && (cpf.value != "33333333333") && (cpf.value != "44444444444")
                        && (cpf.value != "55555555555") && (cpf.value != "66666666666") && (cpf.value != "77777777777")
                        && (cpf.value != "88888888888") && (cpf.value != "99999999999")) {
                        var CPF = cpf.value; // Recebe o valor digitado no campo
                        // Aqui começa a checagem do CPF
                        //var POSICAO, I, SOMA, DV, DV_INFORMADO;
                        var DIGITO = new Array(10);
                        DV_INFORMADO = CPF.substr(9, 2); // Retira os dois últimos dígitos do número informado
                        // Desemembra o número do CPF na array DIGITO
                        for (I = 0; I <= 8; I++) {
                            DIGITO[I] = CPF.substr(I, 1);
                        }

                        // Calcula o valor do 10º dígito da verificação
                        POSICAO = 10;
                        SOMA = 0;
                        for (I = 0; I <= 8; I++) {
                            SOMA = SOMA + DIGITO[I] * POSICAO;
                            POSICAO = POSICAO - 1;
                        }
                        DIGITO[9] = SOMA % 11;
                        if (DIGITO[9] < 2) {
                            DIGITO[9] = 0;
                        }
                        else {
                            DIGITO[9] = 11 - DIGITO[9];
                        }

                        // Calcula o valor do 11º dígito da verificação
                        POSICAO = 11;
                        SOMA = 0;
                        for (I = 0; I <= 9; I++) {
                            SOMA = SOMA + DIGITO[I] * POSICAO;
                            POSICAO = POSICAO - 1;
                        }
                        DIGITO[10] = SOMA % 11;
                        if (DIGITO[10] < 2) {
                            DIGITO[10] = 0;
                        }
                        else {
                            DIGITO[10] = 11 - DIGITO[10];
                        }

                        // Verifica se os valores dos dígitos verificadores conferem
                        DV = DIGITO[9] * 10 + DIGITO[10];

                        if (DV != DV_INFORMADO) {
                            alert('CPF inválido');
                            cpf.value = '';
                            cpf.focus();
                            return false;
                        }
                    }
                    else {
                        alert('CPF inválido');
                        cpf.value = '';
                        cpf.focus();
                        return false;
                    }

                    if (nome.value == "") {
                        alert("Por favor digite seu nome!");
                        nome.focus();
                        return false;
                    }
                    var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
                    if (email.value == "") {
                        alert("Por favor digite seu email!");
                        email.focus();
                        return false;
                    }
                    else {
                        if (filter.test(email.value) == false) {
                            alert("Email inválido!");
                            email.value = "";
                            email.focus();
                            return false;
                        }
                    }
                    if (subarea.value == 0) {
                        alert("Informe a Sub-Área.");
                        subarea.focus();
                        return false;
                    }
                    submit();
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

            function alterar_permissao(cpf) {
                xmlHttp = GetXmlHttpObject();
                //var area = document.getElementById("area").value;
                var radios = document.getElementsByName("area");
                for (var i = 0; i < radios.length; i++) {
                    if (radios[i].checked) {
                        console.log("Escolheu: " + radios[i].value);
                        var area = radios[i].value;
                    }
                }
                //alert(area);
                var cpf = cpf;
                var url = "cadastrar_avaliadorEX.php";
                url = url + "?f=ca&cc=" + cpf + "&a=" + area;
                xmlHttp.open("POST", url);
                xmlHttp.onreadystatechange = mostrar_mensagem;
                xmlHttp.send(null);
            }
            function mostrar_mensagem() {
                if (xmlHttp.readyState == 4) {
                    document.getElementById("mensagem").innerHTML = xmlHttp.responseText;
                    document.getElementById("scroll").innerHTML = '';
                    setTimeout("clearDiv()", 3000);
                }
            }

            function clearDiv() {
                document.getElementById("mensagem").innerHTML = "";
                document.form_inscricao.nomebusca.value = '';
                document.form_inscricao.nomebusca.focus();
                listar_participantes();
            }

            function listar_participantes() {
                xmlHttp = GetXmlHttpObject();
                if (xmlHttp == null) {
                    alert("Este Browser não suporta HTTP Request");
                    return;
                }
                var nome = document.form_inscricao.nomebusca.value;
                var url = "seleciona_participante.php";
                url = url + "?f=aex&n=" + nome + "&t=a";
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
    <?php

    if ($_POST[s])
    {
        include './includes/config.php';
        $nome = mysql_real_escape_string($_POST[nome]);
        $nome = strtr(strtoupper($nome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
        $cpf = mysql_real_escape_string($_POST[cpf]);
        $email = mysql_real_escape_string($_POST[email]);
        $subarea = mysql_real_escape_string($_POST[subarea]);
        $area = mysql_real_escape_string($_POST[area2]);
        $senha = mt_rand(000000000, 999999999);

        $sql = "INSERT INTO participantes(cpf, senha, nome, email, codigo_sa) VALUES ('$cpf','$senha','$nome','$email', '$subarea')";
        $sqlGrupo = "INSERT INTO grupo_pro (codigo_grupo, cpf, area) VALUES ('7', '$cpf','$area')"; //torna avaliador externo


        if (mysql_query($sql) && mysql_query($sqlGrupo))
        {
            echo '<center><font color="#006400"><br><br><b>Cadastro do avaliador feito com sucesso!!!</b></font></center><br>';

            $to = $email;
            $sqlEmailParaAvaliadorExterno = mysql_query("SELECT * FROM `email` WHERE tipo_destinatario = 'avaliador_externo_cadastro'") or die("<h1>Houve um erro na conexão com o banco de dados.</h1>");
            $dadosEmailAvaliadorExterno = mysql_fetch_array($sqlEmailParaAvaliadorExterno);
            $assuntoEmailParaAvaliadorExterno = $dadosEmailAvaliadorExterno[assunto];
            $mensagensEmailParaAvaliadorExterno = $dadosEmailAvaliadorExterno[mensagem];
            $remetenteEmailParaAvaliadorExterno = $dadosEmailAvaliadorExterno[remetente];

            $cabecalhoEmailAvaliadorExterno = "From: ". $remetenteEmailParaAvaliadorExterno . "\r\n";
            $cabecalhoEmailAvaliadorExterno .= "To: Avaliador Externo Simpósio <$to>" . "\r\n";
            $cabecalhoEmailAvaliadorExterno .= "Reply-To: Diretoria de Pesquisa e Pós Graduação <dppg.riopomba@ifsudestemg.edu.br>\r\n";
            $cabecalhoEmailAvaliadorExterno .= "Return-Path: dppg.riopomba@ifsudestemg.edu.br\r\n";
            $cabecalhoEmailAvaliadorExterno .= "Organization: Diretoria de Pesquisa e Pós Graduação\r\n";
            $cabecalhoEmailAvaliadorExterno .= "X-Priority: 3\r\n";
            $cabecalhoEmailAvaliadorExterno .= "X-Mailer: PHP". phpversion() ."\r\n" ;
            $cabecalhoEmailAvaliadorExterno .= "MIME-Version: 1.0\r\n";
            $cabecalhoEmailAvaliadorExterno .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            //$subject = 'Cadastro como Avaliador Externo';
            $subject = $assuntoEmailParaAvaliadorExterno;

//            $message = 'Prezado,
//                    o senhor(a) foi selecionado para avaliar os trabalhos submetidos no Simpósio.
//					Para acessar segue o link abaixo.
//					http://sistemas.riopomba.ifsudestemg.edu.br/simposio2021
//					Acesso Simpósio
//					Login: ' . $cpf . '
//					Senha: ' . $senha . '
//					Setor DPPG';
            $message = $mensagensEmailParaAvaliadorExterno;

            //$headers = 'From: dppg.riopomba@ifsudestemg.edu.br' . "\r\n";
            $headers = $cabecalhoEmailAvaliadorExterno;

            if(isset($to, $subject, $message, $headers))
            {
                if(mail($to, $subject, $message, $headers))
                {
//                    echo "<br><br><br><br><br><br><br>";
//                    echo "<font size='30' color='#228b22'><center>Email enviado com sucesso</center></font><br>";
                }
                else
                {
                    echo "<br><br><br><br><br><br><br>";
                    echo "<font size='30' color='red'> <center>Falha no envio do email para o Avaliador Externo</center></font><br>";
                    return;
                }
            }
            else
            {
                echo "<br><br><br><br><br><br><br>";
                echo "<font size='30' color='#228b22'> <center>Falha no carregamento de dados para envio do email para o Avaliador Externo</center></font><br>";
                return;
            }

        } else {
            echo '<center><font color="#FF0000"><br><br><b>Erro no cadastro do avaliador!!!</b></font></center><br>';
        }
        echo '<meta http-equiv="refresh" content="3; URL=form_cad_avaliadores.php" />';
    } else {
        ?>
        <center>
            <form name="form_inscricao" method="POST" onsubmit="javascript: return dados();"
                  action="form_cad_avaliadores.php">'

                <br>
                <center><b>Cadastrar Avaliadores Externos</b></center>
                <br>

                <div id="filtro">
                    Digite o nome da pessoa:
                    <input type="text" name="nomebusca" onfocus="script: listar_participantes();"
                           onkeyup="script: listar_participantes();">
                </div>
                <div id="mensagem"></div>
                <script type="text/javascript">document.form_inscricao.nomebusca.focus();</script>
                <center><font color="#FF0000">OBS: Marque o nome do participante para torna-lo um avaliador
                        externo.</font></center>
                <br>

                <div id="scroll"></div>

                <hr>

                <br>
                <center><b>Cadastrar Avaliador</b></center>
                <br>

                <font color='#FF0000'>Se o nome do participante não estiver na lista acima, insira os dados do mesmo nos
                    campos abaixo.<br>A senha de login, será enviada automaticamente para o participante.</font><br><br>
                <table border="0" width="500" class="esquerda">
                    <tr>
                        <td>CPF:</td>
                        <td><input type="text" name="cpf" size="11" maxlength="11"><font color="#FF0000"> *</font>
                            Somente números
                        </td>
                    </tr>
                    <tr>
                        <td>Nome:</td>
                        <td><input type="text" name="nome" size="40" maxlength="45"><font color="#FF0000"> *</font></td>
                    </tr>
                    <tr>
                        <td>E-mail:</td>
                        <td><input type="text" name="email" size="40" maxlength="45"><font color="#FF0000"> *</font>
                        </td>
                    </tr>
                    <tr>
                        <td>Sub Área</td>
                        <td>
                            <?php include('combo_subarea.php') ?><!--Mosta a combo de subáre semppre a que a opção docente é escolhida-->
                        </td>
                    </tr>
                    <tr>
                        <td>Área de avaliação</td>
                        <td>
                            <input type="radio" name="area2" value="Pes">Pesquisa
                            <input type="radio" name="area2" value="Ext">Extensão
                            <input type="radio" name="area2" value="Edu">Ensino
                            <input type="radio" name="area2" value="T" checked>Todos
                        </td></tr>
                </table>
                <input type="hidden" name="s" value="s">
                <br>
                <input type="submit" name="cadastrar" value="Cadastrar">
                <input type="reset" name="limpar" value="Limpar ">
            </form>
        </center>
        </div>
        </body>
        </html>
    <?php
    }
}
mysql_close($conexao);
?>
