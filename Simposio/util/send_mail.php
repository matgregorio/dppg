<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function sendEmail($to, $subject, $body){
    $mail = new PHPMailer(true);

    try{
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mateusgregorio178@gmail.com';
        $mail->Password ='';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('mateusgregorio178@gmail.com', 'DPPG - Teste');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();

        return true;
    }catch (Exception $e){
        return "Mensagem não pode ser enviada. Erro do Mailer:{$mail->ErrorInfo}";
    }
}
?>