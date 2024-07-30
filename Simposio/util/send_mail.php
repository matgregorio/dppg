<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';
function sendEmail($to, $subject, $body){
    $mail = new PHPMailer(true);


    try{
        $mail->SMTPDebug = 2; // Define o nível de debug (2 para mais detalhes)
        $mail->Debugoutput = 'html'; // Define o formato da saída de debug

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mateusgregorio178@gmail.com';
        $mail->Password ='owvx gjoc qnbx vmuc';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('mateusgregorio178@gmail.com', 'DPPG - Teste');
        $mail->addAddress($to, 'Mateus');

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        echo "Mensagem enviada com sucesso";
        return true;
    }catch (Exception $e){
        return "Mensagem não pode ser enviada. Erro do Mailer:{$mail->ErrorInfo}";
    }
}



?>