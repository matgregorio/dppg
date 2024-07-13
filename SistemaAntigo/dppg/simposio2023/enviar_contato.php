<?php 


$recebenome = $_POST["nome"];

$recebemail = $_POST["email"];

$recebeassunto = $_POST["assunto"];

$recebemsg  = $_POST["mensagem"];



// Definindo os cabeçalhos do e-mail

$headers = "Content-type:text/html; charset=iso-8859-1";



// Vamos definir agora o destinatário do email, ou seja, VOCÊ ou SEU CLIENTE



//$para = "estagio.riopomba@ifsudestemg.edu.br";
$para = "dppg.riopomba@ifsudestemg.edu.br";


// Definindo o aspecto da mensagem



$mensagem   = "<b>De:</b> ";

$mensagem  .= $recebenome." - ".$recebemail;

$mensagem  .= "<h4>Assunto:</h4>";

$mensagem  .= $recebeassunto;

$mensagem  .= "<h4>Mensagem</h4>";

$mensagem  .= "<p>";

$mensagem  .= $recebemsg;

$mensagem  .= "</p>";



// Enviando a mensagem para o destinatário



$envia =  mail($para,"Contato através do Site da DPPG",$mensagem,$headers);

  

// Envia um e-mail para o remetente, agradecendo a visita no site, e dizendo que em breve o e-mail será respondido.



$mensagem2  = "<p>Olá <strong>" . $recebenome . "</strong>. Agradeçemos sua visita e a oportunidade de recebermos o seu contato. Em breve você receberá no e-mail fornecendo a resposta para sua questão.</p>";

$mensagem2 .= "<p>Observação - Não é necessário responder esta mensagem.</p>";



$envia2 =  mail($recebemail,"Sua mensagem foi recebida!",$mensagem2,$headers);





// Exibe na tela a mensagem de sucesso, e depois redireciona devolta para a página de contato.

						
echo "<center><font color=#006400><b><br><br><br>Mensagem recebida com sucesso!!</b></font></center>";

echo "<meta http-equiv='refresh' content='2;URL=index.php?arquivo=form_contato.php'>"; 





?>