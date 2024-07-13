<?php
session_start();

if (!in_array("1", $_SESSION[codigo_grupo]))
{
    echo "<br><br><br><br><br><br><br>";
    echo "<font size='30' color='red'> <center>Somente administradores logados podem acessar esse conteúdo</center></font>";
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    return;
}

include_once('includes/config.php');
include_once ('../js/emails.js');

$tipoDestinatario = filter_input(INPUT_POST, 'tipo_destinatario', FILTER_SANITIZE_SPECIAL_CHARS);
$assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_SPECIAL_CHARS);
$mensagem = "<html>";
$mensagem .= addslashes(filter_input(INPUT_POST, 'mensagem'));
$mensagem .= "</html>";
$remetente = filter_input(INPUT_POST, 'remetente');

if(isset($tipoDestinatario, $assunto, $mensagem, $remetente))
{
    switch ($tipoDestinatario)
    {
        case 'aluno_participante':
        {
            $sql_update_email_aluno_participante = "UPDATE email SET assunto=\"$assunto\", mensagem=\"$mensagem\", remetente=\"$remetente\" WHERE tipo_destinatario='aluno_participante'";
            if(mysql_query($sql_update_email_aluno_participante))
            {
                echo "<br><br><br><br><br><br><br>";
                echo "<font size='30' color='#228b22'> <center>Dados atualizados com sucesso</center></font><br>";
                echo "<font size='24' color='#228b22'> <center>Redirecionando...</center></font>";
                echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                echo "<script>setTimeout(function(){ window.close() }, 3000);;</script>";
            }
            else
            {
                die("<h1>Erro ao salvar dados</h1>");
            }
            break;
        }
        case 'avaliador_externo_cadastro':
        {
            $sql_update_email_avaliador_externo = "UPDATE email SET assunto=\"$assunto\", mensagem=\"$mensagem\", remetente=\"$remetente\" WHERE tipo_destinatario='avaliador_externo_cadastro'";
            if(mysql_query($sql_update_email_avaliador_externo))
            {
                echo "<br><br><br><br><br><br><br>";
                echo "<font size='30' color='#228b22'> <center>Dados atualizados com sucesso</center></font><br>";
                echo "<font size='24' color='#228b22'> <center>Redirecionando...</center></font>";
                echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                echo "<script>setTimeout(function(){ window.close() }, 3000);;</script>";
            }
            else
            {
                die("<h1>Erro ao salvar dados</h1>");
            }
            break;
        }
        case 'avaliador_externo_trabalho_vinculado':
        {
            $sql_update_email_avaliador_externo_trabalho_vinculado = "UPDATE email SET assunto=\"$assunto\", mensagem=\"$mensagem\", remetente=\"$remetente\" WHERE tipo_destinatario='avaliador_externo_trabalho_vinculado'";
            if(mysql_query($sql_update_email_avaliador_externo_trabalho_vinculado))
            {
                echo "<br><br><br><br><br><br><br>";
                echo "<font size='30' color='#228b22'> <center>Dados atualizados com sucesso</center></font><br>";
                echo "<font size='24' color='#228b22'> <center>Redirecionando...</center></font>";
                echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                echo "<script>setTimeout(function(){ window.close() }, 3000);;</script>";
            }
            else
            {
                die("<h1>Erro ao salvar dados</h1>");
            }
            break;
        }
    case 'orientador':
        {
            $sql_update_email_orientador = "UPDATE email SET assunto=\"$assunto\", mensagem=\"$mensagem\", remetente=\"$remetente\" WHERE tipo_destinatario='orientador'";
            if(mysql_query($sql_update_email_orientador))
            {
                echo "<br><br><br><br><br><br><br>";
                echo "<font size='30' color='#228b22'> <center>Dados atualizados com sucesso</center></font><br>";
                echo "<font size='24' color='#228b22'> <center>Redirecionando...</center></font>";
                echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                echo "<script>setTimeout(function(){ window.close() }, 3000);;</script>";
            }
            else
            {
                die("<h1>Erro ao salvar dados</h1>");
            }
            break;
        }
    }
}
else
{
    echo "<br><br><br><br><br><br><br>";
    echo "<font size='30' color='red'> <center>Erro ao recuperar dados</center></font>";
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    return;
}

?>
<html>
<head>
    <link rel="icon" href="../images/icon.ico">
    <link rel='stylesheet' type='text/css' href='css/style.css'>

</head>
<body></body>
</html>