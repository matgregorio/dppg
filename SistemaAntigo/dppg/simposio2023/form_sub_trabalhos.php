<?php
if ($_SESSION[logado_simposio_2021]) {
?>
<head>
    <script type="text/javascript">
        function mostrar(a, c)
        {
            //Foi pedido para o botão 'mais' estar sempre ativo, caso isso não seja mais necessário, retirar a atribuição "Mais" da variável 'a'
            // a = 'Mais';
            if (a == 'Mais')
            {
                document.getElementById('avaliadores' + c).style.display = 'table';
                document.getElementById('legenda' + c).style.display = 'table';
                document.getElementById('botao' + c).value = 'Menos';
            } else {
                document.getElementById('avaliadores' + c).style.display = 'none';
                document.getElementById('legenda' + c).style.display = 'none';
                document.getElementById('botao' + c).value = 'Mais';
            }
        }

        //Mostrar esse item assim que carregar a pagina
        $(function()
        {
            document.getElementById("tipo").style.display = '';
        });

    </script>
</head>
<?php
echo '<script src="js/valida_submissao.js"></script>';
include('includes/config.php');
if ($_POST[submissao] == 'S')
{

    $situacao = "Em Análise";

    $aprovado = "2";

    $titulo = mysql_real_escape_string($_POST[titulo]);
    $cpf_autor1 = mysql_real_escape_string($_POST[cpf1]);
    $cpf_autor2 = mysql_real_escape_string($_POST[autor2]);
    $cpf_autor3 = mysql_real_escape_string($_POST[autor3]);
    $cpf_autor4 = mysql_real_escape_string($_POST[autor4]);
    $cpf_autor5 = mysql_real_escape_string($_POST[autor5]);

    /*Em 2020 foram reduzidos de 6 coautores para 4 coautores*/
    
    //$cpf_autor6 = mysql_real_escape_string($_POST[autor6]);
    $cpf_autor6 = "";

    //$cpf_autor7 = mysql_real_escape_string($_POST[autor7]);
    $cpf_autor7 = "";

    $apresentador = mysql_real_escape_string($_POST[apresentador]);

    $tipoProjeto = mysql_real_escape_string($_POST[tipoProjeto]);/*Pesquisa, Extensão, Educação*/
    $modalidade = mysql_real_escape_string($_POST[modalidade]); /* informa se é iniciação ou não */
    $tipoIniciacao = mysql_real_escape_string($_POST[tipoIniciacao]);

    $subarea = mysql_real_escape_string($_POST[subarea]);
    $cpfanalisador = mysql_real_escape_string($_POST[orientador]);
    $palavra_chave01 = mysql_real_escape_string($_POST[palavrachave01]);
    $palavra_chave02 = mysql_real_escape_string($_POST[palavrachave02]);
    $palavra_chave03 = mysql_real_escape_string($_POST[palavrachave03]);
    $palavra_chave = $palavra_chave01;

    $resumo = $_POST[resumo];
    $resumo = htmlspecialchars($resumo, ENT_QUOTES); //codifica o html para o banco ler (PRECISO DECODIFICAR USANDO htmlspecialchars_decode NO ARQUIVO QUE EU FOR USAR)
//  echo htmlspecialchars_decode($resumo, ENT_QUOTES); //decodifica o texto


    if ($palavra_chave02 != "" && $palavra_chave03 == "")
    {
        $palavra_chave = "$palavra_chave, $palavra_chave02.";
    }
    else
    {
        $palavra_chave = "$palavra_chave, $palavra_chave02";
    }
    if ($palavra_chave03 != "")
    {
        $palavra_chave = "$palavra_chave, $palavra_chave03.";
    }
    $prazo = mysql_fetch_array(mysql_query("SELECT caminho_formulario FROM formularios WHERE nome_formulario='prazo'"));
    $data_atual = date("Y-m-d");
    // Define os valores a serem usados
    $data_inicial = $prazo[caminho_formulario];
    $data_final = $data_atual;
// Usa a função strtotime() e pega o timestamp das duas datas:
    $time_inicial = strtotime($data_inicial);
    $time_final = strtotime($data_final);
// Calcula a diferença de segundos entre as duas datas:
    $diferenca = $time_inicial - $time_final; // 19522800 segundos
// Calcula a diferença de dias
    $resultado = (int) floor($diferenca / (60 * 60 * 24)); // 225 dias

    $dias = $resultado;

    if ($tipoProjeto == "Pes")
    {
        $sql = "INSERT INTO trabalhos (data_envio, dias_restantes, situacao, autor1, autor2, autor3, autor4, autor5, autor6, autor7, cpf_prof_analisador, titulo, resumo, palavra_chave,tipo_projeto, modalidade, tipo_iniciacao, codigo_sa, cpf, aprovado, apresentador) VALUES ('$data_atual', '$dias', '$situacao', '$cpf_autor1', '$cpf_autor2', '$cpf_autor3', '$cpf_autor4', '$cpf_autor5', '$cpf_autor6','$cpf_autor7', '$cpfanalisador', '$titulo', '$resumo', '$palavra_chave','$tipoProjeto', '$modalidade','$tipoIniciacao', '$subarea' , '$cpf_autor1', '$aprovado', '$apresentador')";
    }
    else
    {
        $sql = "INSERT INTO trabalhos (data_envio, dias_restantes, situacao, autor1, autor2, autor3, autor4, autor5, autor6, autor7, cpf_prof_analisador, titulo, resumo, palavra_chave,tipo_projeto, modalidade, tipo_iniciacao, codigo_sa, cpf, aprovado, apresentador) VALUES ('$data_atual', '$dias', '$situacao', '$cpf_autor1', '$cpf_autor2', '$cpf_autor3', '$cpf_autor4', '$cpf_autor5', '$cpf_autor6','$cpf_autor7', '$cpfanalisador', '$titulo', '$resumo', '$palavra_chave','$tipoProjeto', '0','0', '$subarea' , '$cpf_autor1', '$aprovado', '$apresentador')";
    }


    // if ($modalidade == "N")
    // {
    //   $sql = "INSERT INTO trabalhos (data_envio, dias_restantes, situacao, autor1, autor2, autor3, autor4, autor5, autor6, autor7, cpf_prof_analisador, titulo, resumo, palavra_chave, modalidade, codigo_sa, cpf, aprovado, apresentador)
    //   VALUES ('$data_atual', '$dias', '$situacao', '$cpf_autor1', '$cpf_autor2', '$cpf_autor3', '$cpf_autor4', '$cpf_autor5', '$cpf_autor6','$cpf_autor7', '$cpfanalisador', '$titulo', '$resumo', '$palavra_chave', '$modalidade', '$subarea' , '$cpf_autor1', '$aprovado', '$apresentador')";
    // }
    // else
    // {
    //   $sql = "INSERT INTO trabalhos (data_envio, dias_restantes, situacao, autor1, autor2, autor3, autor4, autor5, autor6, autor7, cpf_prof_analisador, titulo, resumo, palavra_chave, modalidade, tipo_iniciacao, codigo_sa, cpf, aprovado, apresentador) VALUES ('$data_atual', '$dias', '$situacao', '$cpf_autor1', '$cpf_autor2', '$cpf_autor3', '$cpf_autor4', '$cpf_autor5', '$cpf_autor6','$cpf_autor7', '$cpfanalisador', '$titulo', '$resumo', '$palavra_chave', '$modalidade', '$tipoIniciacao', '$subarea' , '$cpf_autor1', '$aprovado', '$apresentador')";
    // }
//    echo $sql;
    $res = mysql_query($sql);
    if ($res == 1) {
        $sql1 = "select p.cpf , p.email from participantes p where p.cpf = '$cpfanalisador' and p.codigo_sa = '$subarea'";
        $sql2 = "select p.cpf, p.nome, p.email from participantes p where p.cpf='$cpf_autor1'";
        $resultado1 = mysql_query($sql1);
        $resultado2 = mysql_query($sql2);
        $campos1 = mysql_fetch_array($resultado1);
        $campos2 = mysql_fetch_array($resultado2);

        $sqlOrientador = mysql_query("SELECT * FROM `email` WHERE tipo_destinatario = 'orientador'") or die("<h1>Houve um erro na conexão com o banco de dados.</h1>");
        $dadosEmailOrientador = mysql_fetch_array($sqlOrientador);
        $assuntoOrientador = $dadosEmailOrientador[assunto];
        $mensagemOrientador = $dadosEmailOrientador[mensagem];
        $remetenteOrientador = $dadosEmailOrientador[remetente];

        /************************************************Email de confirmação para o orientador************************************************************/
        $to = $campos1[email];
//        $subject = 'Envio de trabalhos';
//        $subject = $assuntoOrientador;
//        $message = 'Prezado Orientador,
//                    houve uma submissão de trabalho que deve ser aprovada/reprovada pelo senhor (a).
//                    Lembramos que, de acordo com o item 3.2 da Chamada de Trabalhos, somente os resumos que apresentarem resultados, mesmo que parciais
//                    mas que possam gerar uma conclusão, serão submetidos a avaliação externa.
//					Para acessar, segue o link abaixo.
//					https://sistemas.riopomba.ifsudestemg.edu.br/simposio2021/simposio.php
//					Acesso Simpósio
//					Login: ' . $campos1[cpf] . '
//					A senha é a mesma que você cadastrou no sistema.
//					Caso não lembre acesse o link abaixo para mudar a senha
//					https://sistemas.riopomba.ifsudestemg.edu.br/simposio2021/simposio.php?arquivo2=form_envia_senha.php
//					DPPG/Commisão de Trabalhos Técnicos-Científicos';
//      $message = $mensagemOrientador;
        $cabecalhoEmailOrientador = "From: ". $remetenteOrientador . "\r\n";
        $cabecalhoEmailOrientador .= "To: Orientador trabalho Simpósio <$to>" . "\r\n";
        $cabecalhoEmailOrientador .= "Reply-To: Diretoria de Pesquisa e Pós Graduação <dppg.riopomba@ifsudestemg.edu.br>\r\n";
        $cabecalhoEmailOrientador .= "Return-Path: dppg.riopomba@ifsudestemg.edu.br\r\n";
        $cabecalhoEmailOrientador .= "Organization: Diretoria de Pesquisa e Pós Graduação\r\n";
        $cabecalhoEmailOrientador .= "X-Priority: 3\r\n";
        $cabecalhoEmailOrientador .= "X-Mailer: PHP". phpversion() ."\r\n" ;
        $cabecalhoEmailOrientador .= "MIME-Version: 1.0\r\n";
        $cabecalhoEmailOrientador .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        if(isset($to, $assuntoOrientador, $mensagemOrientador, $cabecalhoEmailOrientador))
        {
            if(mail($to, $assuntoOrientador, $mensagemOrientador, $cabecalhoEmailOrientador))
            {
//                echo "<br><br><br><br><br><br><br>";
//                echo "<font size='30' color='#228b22'> <center>Email enviado com sucesso</center></font><br>";
            }
            else
            {
//                echo "<br><br><br><br><br><br><br>";
//                echo "<font size='30' color='red'> <center>Falha no envio do email para o Orientador</center></font><br>";
            }
        }
        else
        {
//            echo "<br><br><br><br><br><br><br>";
//            echo "<font size='30' color='#228b22'> <center>Falha no carregamento de dados para envio do email para o orientador</center></font><br>";
        }

        /*******************************************email de confirmação para o participante*************************************************/

        $to = $campos2[email];
        $sqlAlunoParticipante = mysql_query("SELECT * FROM `email` WHERE tipo_destinatario = 'aluno_participante'") or die("<h1>Houve um erro na conexão com o banco de dados.</h1>");
        $dadosEmailAlunoParticipante = mysql_fetch_array($sqlAlunoParticipante);
        $assuntoAlunoParticipante = $dadosEmailAlunoParticipante[assunto];
        $mensagemAlunoParticipante = $dadosEmailAlunoParticipante[mensagem];
        $remetenteAlunoParticipante = $dadosEmailAlunoParticipante[remetente];
        $cabecalhoEmailAlunoParticipante = "From: ". $remetenteAlunoParticipante . "\r\n";
        $cabecalhoEmailAlunoParticipante .= "To: Aluno/Participante Simpósio <$to>" . "\r\n";
        $cabecalhoEmailAlunoParticipante .= "Reply-To: Diretoria de Pesquisa e Pós Graduação <dppg.riopomba@ifsudestemg.edu.br>\r\n";
        $cabecalhoEmailAlunoParticipante .= "Return-Path: dppg.riopomba@ifsudestemg.edu.br\r\n";
        $cabecalhoEmailAlunoParticipante .= "Organization: Diretoria de Pesquisa e Pós Graduação\r\n";
        $cabecalhoEmailAlunoParticipante .= "X-Priority: 3\r\n";
        $cabecalhoEmailAlunoParticipante .= "X-Mailer: PHP". phpversion() ."\r\n" ;
        $cabecalhoEmailAlunoParticipante .= "MIME-Version: 1.0\r\n";
        $cabecalhoEmailAlunoParticipante .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


//      $subject = 'Envio de trabalhos';
        $subject = $assuntoAlunoParticipante;

//      $message = 'Prezado ,' . $campos2[nome] . '
//                  informamos que a submissão do trabalho:
//                  Titulo:' . $titulo . '
//                  foi efetuada com sucesso.';
         $message = $mensagemAlunoParticipante;

         if(isset($to, $assuntoAlunoParticipante, $mensagemAlunoParticipante, $cabecalhoEmailAlunoParticipante))
         {
             if(mail($to, $assuntoAlunoParticipante, $mensagemAlunoParticipante, $cabecalhoEmailAlunoParticipante))
             {
                 //echo "<br><br><br><br><br><br><br>";
                 //echo "<font size='30' color='#228b22'><center>Email enviado com sucesso</center></font><br>";
             }
             else
             {
                 //echo "<br><br><br><br><br><br><br>";
                 //echo "<font size='30' color='red'> <center>Falha no envio do email para o Aluno</center></font><br>";
             }
         }
         else
         {
//             echo "<br><br><br><br><br><br><br>";
//             echo "<font size='30' color='#228b22'> <center>Falha no carregamento de dados para envio do email para o aluno</center></font><br>";
         }


        if ($res)
        {
            $sql_trab = "select MAX(codigo_trab) as codigo_trab from trabalhos";
            $res_trab = mysql_query($sql_trab);
            $camp_trab = mysql_fetch_array($res_trab);

            $item = $_POST[item];

            foreach ($item as $cod) {
                $sql_ap = "insert into apoio_trabalho (codigo_apoio, codigo_trabalho) values ('$cod','$camp_trab[codigo_trab]')";
                $res_ap = mysql_query($sql_ap);
            }
        }
        $data = date("y-m-d");
        $hora = date("i:h");
        $pagamento = "S";
        //Fazer com que pessoa realize o pagamento assim que fizer a inscrição
        $sqlInscricao = "INSERT INTO inscricao(cpf, data_inscricao, hora_inscricao, pagamento) values ('$_SESSION[cpf]','$data','$hora','$pagamento')";
        mysql_query($sqlInscricao);
        
    } else {
        echo '<br><br><center><font color=#640000><b>Falha na submissão!</b></font></center><br>';
    }
    echo '<meta http-equiv="refresh" content="3; URL=simposio.php?arquivo2=form_sub_trabalhos.php" />';
}

//$sql1 = "select t.codigo_trab, t.situacao, t.cpf_prof_analisador, t.autor1 , t.titulo, t.aprovado, t.presenca, s.nome_sa from trabalhos t, sub_area s where s.codigo_sa = t.codigo_sa and t.cpf = $_SESSION[cpf]";
$sql1 = "select t.*, s.nome_sa from trabalhos t, sub_area s where s.codigo_sa = t.codigo_sa and ('$_SESSION[cpf]' = autor1 or '$_SESSION[cpf]' = autor2 or '$_SESSION[cpf]' = autor3 or '$_SESSION[cpf]' = autor4 or $_SESSION[cpf] = autor5 or '$_SESSION[cpf]' = autor6 or '$_SESSION[cpf]' = autor7 or cpf_prof_analisador='$_SESSION[cpf]')";
$resultado1 = mysql_query($sql1);

if (mysql_num_rows($resultado1) != 0) {
?>
<br>
<center><b>Relação do(s) trabalho(s)</b></center><br>
<!--center-->
<table border="0" class="esquerda">
    <tr bgcolor=#61C02D>
        <td style="width: 300px">
            <center><b><font color="#FFFFFF">&nbsp;Código &nbsp;</font></b></center>
        </td>
        <td style="width: 300px">
            <center><b><font color="#FFFFFF">&nbsp;Título &nbsp;</font></b></center>
        </td>
        <td>
            <center><b><font color="#FFFFFF">&nbsp;Subárea&nbsp;</font></b></center>
        </td>
        <td>
            <center><b><font color="#FFFFFF">&nbsp;Situação&nbsp;</font></b></center>
        </td>
        <td>
            <center><b><font color="#FFFFFF">&nbsp;Aprovado&nbsp;</font></b></center>
        </td>
        <td>
            <center><b><font color="#FFFFFF">&nbsp;Certificado&nbsp;</font></b></center>
        </td>
        <td>
            <center><b><font color="#FFFFFF">&nbsp;Observação&nbsp;</font></b></center>
        </td>
        <td>
            <center><b><font color="#FFFFFF">&nbsp;Nota Apresentação (pts)&nbsp;</font></b></center>
        </td>
        <td>
            <center><b><font color="#FFFFFF">&nbsp;Visualizar PDF&nbsp;</font></b></center>
        </td>
        <td>
            <center><b><font color="#FFFFFF">&nbsp;Detalhes&nbsp;</font></b></center>
        </td>
    </tr>
    <?php
    $cor = "#95e197";

    while ($campos1 = mysql_fetch_array($resultado1)) {
        $sql4 = "select codigo_trab from historico where codigo_trab = '$campos1[codigo_trab]'";
        $result = mysql_query($sql4);
//var_dump($campos1);
        echo '<tr bgcolor="' . $cor . '">';
        echo '<td align="center">' . $campos1[codigo_trab] . '</td>';
        echo '<td>' . $campos1[titulo] . '</td>';
        echo '<td>' . $campos1[nome_sa] . '</td>';
        echo '<td>' . $campos1[situacao] . '</td>';

        echo '<td>';
        /* 0- Não aprovado; 1- Aprovado; 2- Em Branco */

        if ($campos1[aprovado] == 0) {
            echo '<font color="#FF0000"><center>Trabalho não Aprovado pelo Orientador</center></font>';
        } else if ($campos1[aprovado] == 1) {
            echo '<font color="#FF0000"><center>Trabalho Aprovado pelo Orientador</center></font>';
        } else {
            echo '<font color="#FF0000"><center>*****</center></font>';
        }
        echo '</td>'; 

        if ($campos1[aprovado] == 1 && $campos1[presenca] == "S" && $campos1[aprovado_ext] == 1)
        {
            echo "<td><a target='_blank' href='certificado_submissao.php?codigo=$campos1[codigo_trab]'><center>Gerar Certificado</center></a></td>";
//            echo "<td><a target='_blank' href='certificado_submissao.php?codigo=$campos1[codigo_trab]'><center>Gerar Certificado</center></a></td>";
        }
        else
        {
            echo '<td><font color="#FF0000"><center>*****</center></font></td>';
        }
        echo '<td><center>';

        if ((mysql_num_rows($result) > 0) && ($campos1[aprovado] == 2) && ($campos1[autor1] == $_SESSION[cpf])) {
            echo "<a  href=\"javascript:void(0)\" onClick=\"MM_openBrWindow('observacao.php?codigo=" . $campos1[codigo_trab] . "','',
						'scrollbars=yes, width=850, height=600, left=0, top=0')\")\"><img src=\"images/find.png\" border= \"0\" width=\"30%\"></a>";
        }
        echo '</center></td>';

        //********************** Coluna  "Nota Apresentação (pts)" ************************//

        /*Só exibir as notas a partir da data de exibição*/
        $sql_data_exibicao_nota = "SELECT caminho_formulario from formularios where codigo_formulario = '11'";
        $res_data_exibicao_nota = mysql_query($sql_data_exibicao_nota);
        $dataExibicaNota = mysql_fetch_array($res_data_exibicao_nota);


        //Se a data de hoje for menor que a data permitida para exibir a nota
        if(strtotime(date('Y-m-d')) < strtotime($dataExibicaNota[caminho_formulario]))
        {
            $dataExibicaNota = date('d/m/Y', strtotime($dataExibicaNota[caminho_formulario]));
            if ($campos1[nota1] != '' && $campos1[nota2] != '')
            {}
            elseif ($campos1[nota1] != '' && $campos1[nota2] == '')
            {}
            elseif ($campos1[nota1] == '' && $campos1[nota2] != '')
            {}
            else
            { echo "<td align='center'><font color='#FF0000'>*****</font></td>"; }
        }
        else
        {
            if ($campos1[nota1] != '' && $campos1[nota2] != '')
            {
                echo "<td align='center'>" . (($campos1[nota1] + $campos1[nota2]) / 2) . " </td>";
            }
            elseif ($campos1[nota1] != '' && $campos1[nota2] == '')
            {
                echo "<td align='center'>$campos1[nota1] </td>";
            }
            elseif ($campos1[nota1] == '' && $campos1[nota2] != '')
            {
                echo "<td align='center'>$campos1[nota2] </td>";
            }
            else
            {
                echo "<td align='center'><font color='#FF0000'>*****</font></td>";
            }
        }

        //********************** Fim da coluna  "Nota Apresentação (pts)" ************************//

        echo "<td align='center'><a href='gerar_pdf_trabalhos.php?codigot=$campos1[codigo_trab]' target='_blanck'><img src='images/pdf.png'></a></td>";
        echo '<td align="center"><input type="button" id="botao' . $campos1[codigo_trab] . '" value="Mais" onclick="javascript:mostrar(this.value, ' . $campos1[codigo_trab] . ');"></td>';
//        echo '<td align="center"><input type="button" id="botao' . $campos1[codigo_trab] . '" value="Mais" onclick="javascript:mostrar(this.value, ' . $campos1[codigo_trab] . ');"></td>';


        echo '</tr>';
        $sql_avaliador = "SELECT p.nome, at.item1, at.item2, at.item3, at.item4, at.item5, at.item6, at.nota, at.obs FROM participantes p, avaliador_trab at WHERE p.cpf=at.cpf AND at.codigo_trab='$campos1[codigo_trab]' AND at.avaliado='1'";
        $resultado_avaliador = mysql_query($sql_avaliador);
        $sql_avaliador1 = "SELECT p.nome FROM participantes p, avaliador_trab a WHERE p.cpf=a.cpf AND a.codigo_trab='$campos1[codigo_trab]'";
        $resultado_avaliador1 = mysql_query($sql_avaliador1);

        echo '<tr><td colspan="10">';
        echo "<table border='0' id='avaliadores$campos1[codigo_trab]' width='90%' style='display: table'>";
        $cont = 0;
        $total = 0;
        $controle = 0;
        $media = 0;
        if (mysql_num_rows($resultado_avaliador) > 0)
        {
            //Não exiba as notas
            if(strtotime(date('Y-m-d')) < strtotime($dataExibicaNota[caminho_formulario]))
            {
                $dt = date('d/m/Y',  strtotime($dataExibicaNota[caminho_formulario]));
                echo "<br>";
                echo "<br>";
                echo "<font color='#FF0000' style='font-size: 20px'> <center> As notas serão exibidas em $dt </center></font>" ;
            }
            else //Exibe as notas
            {
                while ($campos_avaliador = mysql_fetch_array($resultado_avaliador))
                {
                    $total += $campos_avaliador[nota];
                    $cont++;

                    //*** Observação do avaliador ***
                    if (htmlspecialchars_decode($campos_avaliador[obs], ENT_QUOTES) != '')
                    {
                        $sql_data_exibicao_nota = "SELECT caminho_formulario from formularios where codigo_formulario = '11'";
                        $res_data_exibicao_nota = mysql_query($sql_data_exibicao_nota);
                        $dataExibicaNota = mysql_fetch_array($res_data_exibicao_nota);
                        $dt = date('d/m/Y',  strtotime($dataExibicaNota[caminho_formulario]));

                        if ($controle == 0)
                        {
                            echo "<tr>";
                            echo "<td colspan='7'><b>Observação do Avaliador:</b></td>";
                            echo "</tr>";
                            $controle = 1;
                        }

                        //Não exiba a observação antes da data
                        if(strtotime(date('Y-m-d')) < strtotime($dataExibicaNota[caminho_formulario]))
                        {
                            echo '<br><br><br><br><br><br>';
                            echo "<font color='#FF0000' style='font-size: 20px'> <center> A observação do avaliador será exibida em $dt </center></font>" ;
                        }
                        else //Exiba as noats
                        {
                            echo "<tr>";
                            echo "<td colspan='7'>" . htmlspecialchars_decode($campos_avaliador[obs], ENT_QUOTES) . "</td>";
                            echo "</tr>";
                        }

                    }
                    echo"<br>";
                    //echo "<tr align='center'><td align='left' colspan='7'>Notas da Avaliação $cont</td></tr>";
                    echo "<tr align='center'>";

                    /*Só exibir as notas a partir da data de exibição*/
                    $sql_data_exibicao_nota = "SELECT caminho_formulario from formularios where codigo_formulario = '11'";
                    $res_data_exibicao_nota = mysql_query($sql_data_exibicao_nota);
                    $dataExibicaNota = mysql_fetch_array($res_data_exibicao_nota);

                    if(strtotime(date('Y-m-d')) < strtotime($dataExibicaNota[caminho_formulario]))
                    {
                        $dataExibicaNota = date('d/m/Y', strtotime($dataExibicaNota[caminho_formulario]));
                        echo "<td align='center'><font color='#FF0000'>As notas serão exibidas em $dataExibicaNota</font></td>";
                    }
                    else
                    {
                        // echo "<td><b>Item1:</b><font color='#000'>&nbsp&nbsp&nbsp$campos_avaliador[item1]</font></td>";
                        //echo "<td><b>Item2:</b><font color='#000'>&nbsp&nbsp&nbsp$campos_avaliador[item2]</font></td>";
                        //echo "<td><b>Item3:</b><font color='#000'>&nbsp&nbsp&nbsp$campos_avaliador[item3]</font></td>";
                        //echo "<td><b>Item4:</b><font color='#000'>&nbsp&nbsp&nbsp$campos_avaliador[item4]</font></td>";
                        //echo "<td><b>Item5:</b><font color='#000'>&nbsp&nbsp&nbsp$campos_avaliador[item5]</font></td>";
                        //echo "<td><b>Item6:</b><font color='#000'>&nbsp&nbsp&nbsp$campos_avaliador[item6]</font></td>";
                    }

                    /*Só exibir as notas a partir da data de exibição*/
                    $sql_data_exibicao_nota = "SELECT caminho_formulario from formularios where codigo_formulario = '11'";
                    $res_data_exibicao_nota = mysql_query($sql_data_exibicao_nota);
                    $dataExibicaNota = mysql_fetch_array($res_data_exibicao_nota);

                    if(strtotime(date('Y-m-d')) < strtotime($dataExibicaNota[caminho_formulario]))
                    {
                        $dataExibicaNota = date('d/m/Y', strtotime($dataExibicaNota[caminho_formulario]));
                        echo "<td align='center'><font color='#FF0000'>As notas serão exibidas em $dataExibicaNota</font></td>";
                    }
                    else
                    {
                        //A partir de 2019, a nota total por item não foi exibida mais. Foi exibido somente a média final
                        if (($total) < 60)
                        {
                            //echo "<td><b>Total:</b><font color='#ff0000'>" . ($total) . "</font></td>";
                        }
                        else
                        {
                            //echo "<td><b>Total:</b>&nbsp&nbsp&nbsp" . ($total) . "&nbsp&nbsp&nbsp</td>";
                        }
                    }



                    $media += $total;
                    $total = 0;
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td colspan='7'><hr></td>";
                    echo "</tr>";
                }
                echo "<tr>";

                /*Só exibir as notas a partir da data de exibição*/
                $sql_data_exibicao_nota = "SELECT caminho_formulario from formularios where codigo_formulario = '11'";
                $res_data_exibicao_nota = mysql_query($sql_data_exibicao_nota);
                $dataExibicaNota = mysql_fetch_array($res_data_exibicao_nota);

                if (($media / $cont) < 60)
                {
                    if(strtotime(date('Y-m-d')) < strtotime($dataExibicaNota[caminho_formulario]))
                    {
                        $dataExibicaNota = date('d/m/Y', strtotime($dataExibicaNota[caminho_formulario]));
                        echo "<td align='center'><font color='#FF0000'>As notas serão exibidas em $dataExibicaNota</font></td>";
                    }
                    else
                    {
                        echo "<td colspan='7' align='center'><b>Nota final:</b>&nbsp&nbsp&nbsp<font color='#ff0000'>" . ($media / $cont) . "</font></td>";
                    }
                }
                else
                {
                    /*Só exibir as notas a partir da data de exibição*/
                    $sql_data_exibicao_nota = "SELECT caminho_formulario from formularios where codigo_formulario = '11'";
                    $res_data_exibicao_nota = mysql_query($sql_data_exibicao_nota);
                    $dataExibicaNota = mysql_fetch_array($res_data_exibicao_nota);

                    if(strtotime(date('Y-m-d')) < strtotime($dataExibicaNota[caminho_formulario]))
                    {
                        $dataExibicaNota = date('d/m/Y', strtotime($dataExibicaNota[caminho_formulario]));
                        echo "<td align='center'><font color='#FF0000'>As notas serão exibidas em $dataExibicaNota</font></td>";
                    }
                    else
                    {
                        echo "<td colspan='7' align='right'><b>Nota Final:</b>&nbsp&nbsp&nbsp<font color='#009f00'>" . ($media / $cont) . "</font></td>";
                    }
                }
                echo "</tr>";
                if (($media / $cont) < 60)
                {
                    /*Só exibir as notas a partir da data de exibição*/
                    $sql_data_exibicao_nota = "SELECT caminho_formulario from formularios where codigo_formulario = '11'";
                    $res_data_exibicao_nota = mysql_query($sql_data_exibicao_nota);
                    $dataExibicaNota = mysql_fetch_array($res_data_exibicao_nota);

                    if(strtotime(date('Y-m-d')) < strtotime($dataExibicaNota[caminho_formulario]))
                    {
                        $dataExibicaNota = date('d/m/Y', strtotime($dataExibicaNota[caminho_formulario]));
                        echo "<td align='center'><font color='#FF0000'>As notas serão exibidas em $dataExibicaNota</font></td>";
                    }
                    else
                    {
                        echo "<tr align='center'>";
                        echo "<td colspan=2><b><font color='#ff0000'>Trabalho Reprovado pelo Avaliador Externo</font>.<br>Portanto não será publicado nos anais e não deverá ser apresentado.</b></td>";
                        echo "</tr>";
                    }

                }
            }
        }
        else
        {
            //echo $resultado_avaliador1;
            if (mysql_num_rows($resultado_avaliador1) > 0)
            {
                echo "<tr align='center'>";
                echo "<td colspan=2><br><font color='#006400'>Aguardando a avaliação do Avaliador Externo.</font></td>";
                echo "</tr>";
                $flag = 1;
            }
            else
            {
                echo "<tr align='center'>";
                echo "<td colspan=2><br><font color='#006400'>Trabalho não enviado para um Avaliador Externo.</font></td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        echo"<br>";
        echo"<br>";

        echo"<br>";

        /*A partir de 2010 as Legendas não foram mais exibidas, pois as notas por item não estão mass sendo mostradas*/

/*        echo "<table id='legenda$campos1[codigo_trab]' style='display: table; border : 1px solid'>";
        echo "<tr align='center'><td align='left' colspan='7'><b><u>Legenda</u></b></td></tr>";
        echo "<tr align='justify'>";
        echo "<td>&nbsp<b>Item1:</b>&nbsp</td><td><font color='#000'>Estrutura do resumo de acordo com as normas do Simpósio (Contém introdução, objetivos, material e métodos ou metodologia, resultados e conclusões, mínimo de 250 e máximo de 400 palavras?)</font></td>";
        echo "</tr>";
        echo "<tr align='justify'>";
        echo "<td>&nbsp<b>Item2:</b>&nbsp</td><td><font color='#000'>Título: (Descreve a essência do resumo?)</font></td>";
        echo "</tr>";
        echo "<tr align='justify'>";
        echo "<td>&nbsp<b>Item3:</b>&nbsp</td><td><font color='#000'>Qualidade da redação científica</font></td>";
        echo "</tr>";
        echo "<tr align='justify'>";
        echo "<td>&nbsp<b>Item4:</b>&nbsp</td><td><font color='#000'>Relevância científica (O tema é atual e relevante?)</font></td>";
        echo "</tr>";
        echo "<tr align='justify'>";
        echo "<td>&nbsp<b>Item5:</b>&nbsp</td><td><font color='#000'>Originalidade do trabalho</font></td>";
        echo "</tr>";
        echo "<tr align='justify'>";
        echo "<td>&nbsp<b>Item6:</b>&nbsp</td><td><font color='#000'>Conclusões (As conclusões são claras? Os objetivos foram alcançados?</font></td>";
        echo "</tr>";
        echo "</table>";
        echo "<hr></td></tr>";*/

        if ($cor == "#78e07b")
            $cor = "#95e197";
        else
            $cor = "#78e07b";
    }
    echo '</table>';
    echo '<br>
        <center>
		<font color="#FF0000">OBS: Acompanhe a situação da submissão acessando o sistema diariamente. </font>
		</center>';
    }
    echo "<hr>";
    include('includes/config.php');

    $sql_arquivo = "select * from formularios f, arquivo a where f.codigo_formulario = a.codigo_formulario and
		a.codigo_formulario = '4'";
    $resultado_arquivo = mysql_query($sql_arquivo);

    echo '<center>';
    while ($campos_arquivo = mysql_fetch_array($resultado_arquivo)) {
        echo '&nbsp;<a href="documentos/' . $campos_arquivo[caminho_arquivo] . '" target="_blank"><img src="images/' . $campos_arquivo[icone] . '" border="0">&nbsp;' . $campos_arquivo[nome_arquivo] . '</a>';
    }
    echo '</center>';

    if (mysql_num_rows(mysql_query("SELECT cpf FROM trabalhos WHERE cpf=$_SESSION[cpf]")) < 2) {

        include('funcao.php');

        $sql_data = "select * from formularios where codigo_formulario ='4'";
        $resultado_data = mysql_query($sql_data);
        $campos_data = mysql_fetch_array($resultado_data);

        $cpf = mysql_real_escape_string($_SESSION[cpf]);

        $query_autor = mysql_query("SELECT nome FROM participantes WHERE cpf='$cpf'");
        $campo_autor = mysql_fetch_array($query_autor);

        $result_autores = mysql_query("SELECT cpf, nome FROM participantes WHERE cpf!='admin' ORDER BY nome");

        $datai = datadobanco($campos_data[data_inicio]);
        $dataf = datadobanco($campos_data[data_fim]);

        $data = $datai;

        $data_inicio = datasemcaracter($datai);
        $data_fim = datasemcaracter($dataf);


        if ((date("Ymd") < $data_inicio))
        {
            echo '<center><font color="#FF0000"><br>A Submissão de Trabalhos começará na data ' . $data . '.</font><br><br><center>';
        }
        else if ((date("Ymd") >= $data_inicio) && (date("Ymd") <= $data_fim))
        {
            ?>
            <center><br>
                <hr align="center" width="540px"/>
            </center>
            <head>

                <script language="javascript">
                    function list_orientador(valor) {
                        http.open("GET", "combo_orientador.php?id=" + valor, true);
                        http.onreadystatechange = handleHttpResponse;
                        http.send(null);
                    }

                    function handleHttpResponse() {
                        campo_select = document.forms[0].orientador;
                        if (http.readyState == 4) {
                            campo_select.options.length = 0;
                            results = http.responseText.split(",");
                            for (i = 0; i < results.length; i++) {
                                string = results[i].split("|");
                                campo_select.options[i] = new Option(string[0], string[1]);
                            }
                        }
                    }

                    function getHTTPObject() {
                        var req;
                        try {
                            if (window.XMLHttpRequest) {
                                req = new XMLHttpRequest();
                                if (req.readyState == null) {
                                    req.readyState = 1;
                                    req.addEventListener("load", function () {
                                        req.readyState = 4;
                                        if (typeof req.onReadyStateChange == "function")
                                            req.onReadyStateChange();
                                    }, false);
                                }
                                return req;
                            }

                            if (window.ActiveXObject) {
                                var prefixes = ["MSXML2", "Microsoft", "MSXML", "MSXML3"];
                                for (var i = 0; i < prefixes.length; i++) {
                                    try {
                                        req = new ActiveXObject(prefixes[i] + ".XmlHttp");
                                        return req;
                                    } catch (ex) {
                                    }
                                    ;
                                }
                            }
                        } catch (ex) {
                        }
                        alert("XmlHttp Objects not supported by client browser");
                    }
                    var http = getHTTPObject();
                </script>
                <script type="text/javascript">
                    //   function mostrarIC(val)
                    //   {
                    //     if (val == "S") {
                    //       document.getElementById("tipoIC").style.display = '';
                    //     } else {
                    //       document.getElementById("tipoIC").style.display = 'none';
                    //     }
                    //      if (val == "N") {
                    //        document.getElementById("tipoIC").style.display = '';
                    //      } else {
                    //        document.getElementById("tipoIC").style.display = 'none';
                    //     // }
                    //   }

                    function mostrarICtipo(val)
                    {
                        if (val == "Pes") {
                            document.getElementById("tipo").style.display = '';
                            //   document.getElementById("tipoIC").style.display = '';
                        } else {
                            document.getElementById("tipo").style.display = 'none';
                            document.getElementById("tipoICA").style.display = 'none';
                            document.getElementById("tipoICB").style.display = 'none';
                        }
                    }

                    function mostrarTipo(val)
                    {
                        if (val == "S") {
                            document.getElementById("tipoICA").style.display = '';
                            document.getElementById("tipoICB").style.display = 'none';

                        }else {
                            document.getElementById("tipoICA").style.display = 'none';
                            document.getElementById("tipoICB").style.display = '';
                        }
                    }

                </script>
                <script type="text/javascript">
                    $(document).ready(
                        function () {
                            $('#orientador').ready(
                                function () {
                                    var id = document.getElementById('sa').value;
                                    list_orientador(id);
                                }
                            );
                        }
                    );
                </script>
            </head>
            <br>
            <center><b>Submissão de Trabalho </b></center>
            <br>
            <center>
                <form name="form_submissao" method="post" onsubmit="javascript: return checkcontatos()" action="simposio.php" enctype="multipart/form-data">
                    <table border="0" width="100%" class="esquerda">
                        <tr>
                            <td><?php echo '<input type="hidden" name="cpf1" size="11" maxlength="11" value="' . $_SESSION[cpf] . '">'; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Informe a qual subárea seu trabalho pertence.</td>
                        </tr>
                        <tr>
                            <td>Subárea</td>
                            <td>
                                <select id="sa" name="subarea" onchange="list_orientador(this.value)">
                                    <?php
                                    $sql1 = "select * from sub_area order by nome_sa asc";
                                    $resultado1 = mysql_query($sql1);
                                    while ($campos1 = mysql_fetch_array($resultado1)) {
                                        echo "<option value='$campos1[codigo_sa]'>$campos1[nome_sa]</option>";
                                    }
                                    ?>
                                </select><font color="#FF0000"> *</font></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td>Título</td>
                            <td><input type="text" name="titulo" size="40"><font color="#FF0000"> *</font></td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <font color="#FF0000">OBS:</font> <br>É necessário que todos os autores estejam
                                cadastrados no sistema. Além disso, o orientador não deve ser incluído como autor,
                                pois será automaticamente adicionado ao trabalho após sua escolha no campo
                                orientador abaixo.
                                Informe qual dos autores irá apresentar o trabalho.
                            </td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td><font color="#FF0000">Autor principal</font></td>
                            <td>
                                <?php echo "<input type='text' name='autor1' size='40' maxlength='80' value='$campo_autor[nome]' readonly>"; ?>
                                <input type="radio" name="apresentador" value="1" checked="true"> Apresentador
                            </td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td>Orientador do Trabalho(Autor2)</td>
                            <td><select id="orientador" name="orientador"></select><font color="#FF0000"> *</font>
                            </td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td>Coautor</td>
                            <td>
                                <select name="autor2" style="width:280px">
                                    <option value="0">Não Há Autor</option>
                                    <?php
                                    while ($campo_autores = mysql_fetch_array($result_autores)) {
                                        echo "<option value='$campo_autores[cpf]'>$campo_autores[nome]</option>";
                                    }
                                    ?>
                                </select>
                                <input type="radio" name="apresentador" value="2"> Apresentador
                            </td>
                        </tr>
                        <tr>
                            <td>Coautor</td>
                            <td>
                                <select name="autor3" style="width:280px">
                                    <option value="0">Não Há Autor</option>
                                    <?php
                                    mysql_data_seek($result_autores, 0);
                                    while ($campo_autores = mysql_fetch_array($result_autores)) {
                                        echo "<option value='$campo_autores[cpf]'>$campo_autores[nome]</option>";
                                    }
                                    ?>
                                </select>
                                <input type="radio" name="apresentador" value="3"> Apresentador
                            </td>
                        </tr>
                        <tr>
                            <td>Coautor</td>
                            <td>
                                <select name="autor4" style="width:280px">
                                    <option value="0">Não Há Autor</option>
                                    <?php
                                    mysql_data_seek($result_autores, 0);
                                    while ($campo_autores = mysql_fetch_array($result_autores)) {
                                        echo "<option value='$campo_autores[cpf]'>$campo_autores[nome]</option>";
                                    }
                                    ?>
                                </select>
                                <input type="radio" name="apresentador" value="4"> Apresentador
                            </td>
                        </tr>
                        <tr>
                            <td>Coautor</td>
                            <td>
                                <select name="autor5" style="width:280px">
                                    <option value="0">Não Há Autor</option>
                                    <?php
                                    mysql_data_seek($result_autores, 0);
                                    while ($campo_autores = mysql_fetch_array($result_autores)) {
                                        echo "<option value='$campo_autores[cpf]'>$campo_autores[nome]</option>";
                                    }
                                    ?>
                                </select>
                                <input type="radio" name="apresentador" value="5"> Apresentador
                            </td>
                        </tr>
<!--                        <tr>-->
<!--                            <td>Coautor</td>-->
<!--                            <td>-->
<!--                                <select name="autor6" style="width:280px">-->
<!--                                    <option value="0">Não Há Autor</option>-->
<!--                                    --><?php
//                                    mysql_data_seek($result_autores, 0);
//                                    while ($campo_autores = mysql_fetch_array($result_autores)) {
//                                        echo "<option value='$campo_autores[cpf]'>$campo_autores[nome]</option>";
//                                    }
//                                    ?>
<!--                                </select>-->
<!--                                <input type="radio" name="apresentador" value="6"> Apresentador-->
<!--                            </td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>Coautor</td>-->
<!--                            <td>-->
<!--                                <select name="autor7" style="width:280px">-->
<!--                                    <option value="0">Não Há Autor</option>-->
<!--                                    --><?php
//                                    mysql_data_seek($result_autores, 0);
//                                    while ($campo_autores = mysql_fetch_array($result_autores)) {
//                                        echo "<option value='$campo_autores[cpf]'>$campo_autores[nome]</option>";
//                                    }
//                                    ?>
<!--                                </select>-->
<!--                                <input type="radio" name="apresentador" value="7"> Apresentador-->
<!--                            </td>-->
<!--                        </tr>-->
                        <tr>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td>Qual o tipo do seu projeto?</td>
                            <td>
                                <input type="radio" onclick="script : mostrarICtipo(this.value)"
                                       onload"script : mostrarICtipo(this.value)" name="tipoProjeto" value="Pes" checked="checked">Pesquisa
                                <!--                     <input type="radio" onclick="script : mostrarICtipo(this.value)"-->
                                <!--                       onchange="script : mostrarICtipo(this.value)" name="tipoProjeto" value="Ext" checked="checked" >Extensão-->
                                <!---<input type="radio" onclick="script : mostrarICtipo(this.value)"
                                  onchange="script : mostrarICtipo(this.value)" name="tipoProjeto" value="Edu">Ensino-->
                            </td>
                        </tr>
                        <tr  id="tipo" style="display: none">
                            <td>Este resumo refere-se ao seu<br>projeto de Iniciação Científica?</td>
                            <td>
                                <input type="radio" onclick="script : mostrarTipo(this.value)"
                                       onchange="script : mostrarTipo(this.value)" name="modalidade" value="S">Sim
                                <input type="radio" onclick="script : mostrarTipo(this.value)"
                                       onchange="script : mostrarTipo(this.value)" name="modalidade" value="N">Não
                            </td>
                        </tr>
                        <tr><br></tr>
                        <tr id="tipoICA" style="display: none">
                            <td>Qual Modalidade?</td>
                            <td>
                                <input type="radio" name="tipoIniciacao" value="T">Técnico
                                <input type="radio" name="tipoIniciacao" value="G">Graduação
                                <!-- <input type="radio" name="tipoIniciacao" value="L">Lato Sensu
                                <input type="radio" name="tipoIniciacao" value="S">Stricto Sensu -->
                            </td>
                        </tr>
                        <tr><br></tr>
                        <tr id="tipoICB" style="display: none">
                            <td>Qual Modalidade?</td>
                            <td>
                                <input type="radio" name="tipoIniciacao" value="T">Técnico
                                <input type="radio" name="tipoIniciacao" value="G">Graduação
                                <input type="radio" name="tipoIniciacao" value="L">Lato Sensu
                                <input type="radio" name="tipoIniciacao" value="S">Stricto Sensu
                            </td>
                        </tr>
                        <tr><br></tr>
                        <tr>
                            <td>Palavras-Chave:(Em ordem alfabética e<br> em letras minúsculas)</td>
                            <td>
                                <input type="text" name="palavrachave01" size="13">,
                                <input type="text" name="palavrachave02" size="13">,
                                <input type="text" name="palavrachave03" size="13">
                                <font color="#FF0000"> *</font>
                            </td>
                        </tr>
                        <tr>
                            <td>Apoio</td>
                            <td>
                                <?php
                                $cons = "select * from apoio";
                                $res = mysql_query($cons);
                                while ($camp = mysql_fetch_array($res)) {
                                    echo '<input type="checkbox" name="item[]" size="1" value="' . $camp[codigo_apoio] . '"> ' . $camp[nome] . '<br>';
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                    <table border="0" width="100%" class="esquerda">
                        <tr>
                            <td><font color="#FF0000"><p align="justfy">- O autor deve criar o seu resumo no campo
                                        de texto abaixo. O texto deve ser justificado e digitado em parágrafo único
                                        e em espaçamento simples, em fonte Times New Roman 12. Não podem ser
                                        incluídos gráficos, tabelas, figuras, referências bibliográficas e
                                        subtítulos.<br> - O resumo deve conter no mínimo 250 e no máximo 400
                                        palavras excluindo título.<br><br>- Caso o texto seja criado em um editor de
                                        texto externo, os caracteres especiais como: <b><u>aspas, hífen, subescrito,
                                                sobrescrito, graus, raiz quadrada, itátlico, negrito e sublinhado,
                                                deverão ser inseridos através da caixa de texto abaixo</u></b>. Para
                                        inserir caracteres especiais, vá em "Insert"->"Special Character". Para
                                        formatar fontes, vá em "Font Family" e em "Font Size".<br><br> - Os
                                        trabalhos que não seguirem a formatação não serão avaliados.</p></font></td>
                        </tr>
                        </u>
                        <tr>
                            <td>
                                Resumo:<font color="#FF0000">
                                    *<br><b>Inserir no campo de texto abaixo somente o resumo. As palavras chaves, autores e título já
                                        está informado nos campos acima.</b></font></td>
                        </tr>
                        <tr align="center">
                            <td><textarea name="resumo" id="content" rows="20" cols="30"></textarea></td>
                        </tr>
                    </table>
                    <br>
                    <table border="0" width="100%" class="esquerda">
                        <tr align="center">
                            <td>
                                Leia com atenção as Normas para envio de trabalhos:
                                <?php include('normas.php'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Li e concordo com as normas:
                                <input type="checkbox" name="acordo"><font color="#FF0000"> *</font></td>
                        </tr>
                        <tr>
                            <td colspan="2"><br>
                                <font size="3" color="#FF0000">* </font>Campo de preenchimento obrigatório
                            </td>
                        </tr>
                        <tr>
                            <input type="hidden" name="arquivo2" value="form_sub_trabalhos.php">
                        </tr>
                        <tr>
                            <input type="hidden" name="submissao" value="S">
                        </tr>
                    </table>
                    <input type="submit" onclick="return confirmar()" value="Enviar">&nbsp;<input type="reset"
                                                                                                  value="Limpar">
                </form>
            </center>
            <br><br>
            <?php
        }

        if (date("Ymd") > $data_fim) {
            echo '<center><br><font color="#FF0000">Expirou o prazo para submissão de trabalhos</font><br><br>
				<hr width="80%">	<br></center><br>';
        }
    } else if (mysql_num_rows($resultado1) == 0)
        echo '<center><font color="#FF0000">Nenhum Trabalho submetido!!!</font></center>';
    else
        echo '<br>';

    mysql_close($conexao);
    }
    ?>
