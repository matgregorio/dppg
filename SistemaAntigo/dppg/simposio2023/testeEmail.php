<?php
include('includes/config.php');
$sql = mysql_query("select * from email where tipo_destinatario = 'avaliador_externo_cadastro'");
$email=mysql_fetch_array($sql);

$remetente = "From: ". $email[remetente] . "\r\n";
//$remetente = "From: ". "exemplo@exemplo.com" . "\r\n";
$remetente .= "Reply-To: Diretoria de Pesquisa e Pós Graduação <dppg.riopomba@ifsudestemg.edu.br>\r\n";
$remetente .= "Return-Path: dppg.riopomba@ifsudestemg.edu.br\r\n";
$remetente .= "Organization: Diretoria de Pesquisa e Pós Graduação\r\n";
$remetente .= "X-Priority: 3\r\n";
$remetente .= "X-Mailer: PHP". phpversion() ."\r\n" ;
$remetente .= "MIME-Version: 1.0\r\n";
$remetente .= "Content-Type: text/html; charset=ISO-8859-1\r\n";





if(mail("gustavofbigogno@gmail.com", $email[assunto], $email[mensagem], $remetente))
    echo "<br>Sucesso: ".$email[remetente];
else
    echo "<br>Insucesso";







?>