<?php
include 'includes/config.php';

//$sqlOrientador = mysql_query("SELECT * FROM `email` WHERE tipo_destinatario = 'orientador'") or die("<h1>Houve um erro na conexão com o banco de dados.</h1>");
//$dadosEmailOrientador = mysql_fetch_array($sqlOrientador);
//$assuntoOrientador = $dadosEmailOrientador[assunto];
//$mensagemOrientador = $dadosEmailOrientador[mensagem];
//$remetenteOrientador = $dadosEmailOrientador[remetente];
///************************************************Email de confirmação para o orientador************************************************************/
//$to = "test-ljsu5busq@srv1.mail-tester.com";
//        $subject = 'Envio de trabalhos';
//        $subject = $assuntoOrientador;
////        $message = 'Prezado Orientador,
////                    houve uma submissão de trabalho que deve ser aprovada/reprovada pelo senhor (a).
////                    Lembramos que, de acordo com o item 3.2 da Chamada de Trabalhos, somente os resumos que apresentarem resultados, mesmo que parciais
////                    mas que possam gerar uma conclusão, serão submetidos a avaliação externa.
////					Para acessar, segue o link abaixo.
////					https://sistemas.riopomba.ifsudestemg.edu.br/simposio2021/simposio.php
////					Acesso Simpósio
////					Login: ' . $campos1[cpf] . '
////					A senha é a mesma que você cadastrou no sistema.
////					Caso não lembre acesse o link abaixo para mudar a senha
////					https://sistemas.riopomba.ifsudestemg.edu.br/simposio2021/simposio.php?arquivo2=form_envia_senha.php
////					DPPG/Commisão de Trabalhos Técnicos-Científicos';
//
//
//$message = $mensagemOrientador . "\r\n";
//
//
//$cabecalhoEmailOrientador = "From: ". $remetenteOrientador . "\r\n";
//$cabecalhoEmailOrientador .= 'To: Orientador <mary@example.com>' . "\r\n";
//$cabecalhoEmailOrientador .= "Reply-To: Diretoria de Pesquisa e Pós Graduação <dppg.riopomba@ifsudestemg.edu.br>\r\n";
//$cabecalhoEmailOrientador .= "Return-Path: dppg.riopomba@ifsudestemg.edu.br\r\n";
//$cabecalhoEmailOrientador .= "Organization: Diretoria de Pesquisa e Pós Graduação\r\n";
//$cabecalhoEmailOrientador .= "X-Priority: 3\r\n";
//$cabecalhoEmailOrientador .= "X-Mailer: PHP". phpversion() ."\r\n" ;
//$cabecalhoEmailOrientador .= "MIME-Version: 1.0\r\n";
//$cabecalhoEmailOrientador .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//
//if(isset($to))
//{
//    echo $to;
//    if(isset($assuntoOrientador))
//        echo $assuntoOrientador . '<br>'. '<br>';
//    if(isset ($message))
//        echo $message . '<br>'. '<br>';
//    if (isset($cabecalhoEmailOrientador))
//        echo $cabecalhoEmailOrientador . '<br>'. '<br>';
//}
//
//
//if(isset($to, $assuntoOrientador, $message, $cabecalhoEmailOrientador))
//{
//    if(mail($to, $assuntoOrientador, $mensagemOrientador, $cabecalhoEmailOrientador))
//    {
//        echo "<br><br><br><br><br><br><br>";
//        echo "<font size='30' color='#228b22'> <center>Email enviado com sucesso</center></font><br>";
//    }
//    else
//    {
//        echo "<br><br><br><br><br><br><br>";
//        echo "<font size='30' color='red'> <center>Falha no envio do email para o Orientador</center></font><br>";
//    }
//}
//else
//{
//    echo "<br><br><br><br><br><br><br>";
//    echo "<font size='30' color='#228b22'> <center>Falha no carregamento de dados para envio do email para o orientador</center></font><br>";
//}

/*******************************************email de confirmação para o participante*************************************************/

//$sqlAlunoParticipante = mysql_query("SELECT * FROM `email` WHERE tipo_destinatario = 'aluno_participante'") or die("<h1>Houve um erro na conexão com o banco de dados.</h1>");
//$dadosEmailAlunoParticipante = mysql_fetch_array($sqlAlunoParticipante);
//$assuntoAlunoParticipante = $dadosEmailAlunoParticipante[assunto];
//$mensagemAlunoParticipante = "<html>". "\r\n";
//$mensagemAlunoParticipante .= $dadosEmailAlunoParticipante[mensagem] . "\r\n";
//$mensagemAlunoParticipante .="</html>";
//$remetenteAlunoParticipante = $dadosEmailAlunoParticipante[remetente];
//$cabecalhoEmailAlunoParticipante = "From: ". $remetenteAlunoParticipante . "\r\n";
//$cabecalhoEmailAlunoParticipante .= "Reply-To: Diretoria de Pesquisa e Pós Graduação <dppg.riopomba@ifsudestemg.edu.br>\r\n";
//$cabecalhoEmailAlunoParticipante .= "Return-Path: dppg.riopomba@ifsudestemg.edu.br\r\n";
//$cabecalhoEmailAlunoParticipante .= "Organization: Diretoria de Pesquisa e Pós Graduação\r\n";
//$cabecalhoEmailAlunoParticipante .= "X-Priority: 3\r\n";
//$cabecalhoEmailAlunoParticipante .= "X-Mailer: PHP". phpversion() ."\r\n" ;
//$cabecalhoEmailAlunoParticipante .= "MIME-Version: 1.0\r\n";
//$cabecalhoEmailAlunoParticipante .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

//      $subject = 'Envio de trabalhos';
//$subject = $assuntoAlunoParticipante;

//      $message = 'Prezado ,' . $campos2[nome] . '
//                  informamos que a submissão do trabalho:
//                  Titulo:' . $titulo . '
//                  foi efetuada com sucesso.';
//$message = $mensagemAlunoParticipante;
//
//if(isset($to, $assuntoAlunoParticipante, $mensagemAlunoParticipante, $cabecalhoEmailAlunoParticipante))
//{
//    if(mail($to, $assuntoAlunoParticipante, $mensagemAlunoParticipante, $cabecalhoEmailAlunoParticipante))
//    {
//        echo "<br><br><br><br><br><br><br>";
//        echo "<font size='30' color='#228b22'><center>Email enviado com sucesso</center></font><br>";
//    }
//    else
//    {
//        echo "<br><br><br><br><br><br><br>";
//        echo "<font size='30' color='red'> <center>Falha no envio do email para o Aluno</center></font><br>";
//    }
//}
//else
//{
//    echo "<br><br><br><br><br><br><br>";
//    echo "<font size='30' color='#228b22'> <center>Falha no carregamento de dados para envio do email para o aluno</center></font><br>";
//}

/*******************************************email de confirmação para o av externo*************************************************/

$to = 'afscadspam@gmail.com';
$sqlEmailParaAvaliadorExterno = mysql_query("SELECT * FROM `email` WHERE tipo_destinatario = 'avaliador_externo'") or die("<h1>Houve um erro na conexão com o banco de dados.</h1>");
$dadosEmailAvaliadorExterno = mysql_fetch_array($sqlEmailParaAvaliadorExterno);
$assuntoEmailParaAvaliadorExterno = $dadosEmailAvaliadorExterno[assunto];
$mensagensEmailParaAvaliadorExterno = $dadosEmailAvaliadorExterno[mensagem];
$remetenteEmailParaAvaliadorExterno = $dadosEmailAvaliadorExterno[remetente];

$cabecalhoEmailAvaliadorExterno = "From: ". $remetenteEmailParaAvaliadorExterno . "\r\n";
$cabecalhoEmailAvaliadorExterno .= "To: Avaliador Externo <$to>" . "\r\n";
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
        echo "<br><br><br><br><br><br><br>";
        echo "<font size='30' color='#228b22'><center>Email enviado com sucesso</center></font><br>";
    }
    else
    {
        echo "<br><br><br><br><br><br><br>";
        echo "<font size='30' color='red'> <center>Falha no envio do email para o Avaliador Externo</center></font><br>";
    }
}
else
{
    echo "<br><br><br><br><br><br><br>";
    echo "<font size='30' color='#228b22'> <center>Falha no carregamento de dados para envio do email para o Avaliador Externo</center></font><br>";
}