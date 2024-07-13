<?php
session_start();

if (!in_array("1", $_SESSION[codigo_grupo]))
{
    echo "<br><br><br><br><br><br><br>";
    echo "<font size='30' color='red'> <center>Somente administradores logados podem acessar esse conteúdo</center></font>";
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    return;
}
include_once ('includes/config.php');
include_once ('trataInjection.php');

if(protectorString(filter_input(INPUT_POST, 'statusTrabalho',FILTER_SANITIZE_SPECIAL_CHARS)))
    return;
?>

<head>
    <link rel="icon" href="../images/icon.ico">
    <link rel='stylesheet' type='text/css' href='css/style.css'>
</head>

<?php
$statusTrabalho = filter_input(INPUT_POST, 'statusTrabalho',FILTER_SANITIZE_SPECIAL_CHARS);
$idTrabalho = filter_input(INPUT_POST, 'idTrabalho',FILTER_SANITIZE_SPECIAL_CHARS);

if($statusTrabalho == 0)
    $sql = "UPDATE trabalhos SET aprovado = '$statusTrabalho', situacao = 'Reprovado' WHERE trabalhos.codigo_trab = '$idTrabalho'";
elseif ($statusTrabalho == 1)
    $sql = "UPDATE trabalhos SET aprovado = '$statusTrabalho', situacao = 'Avaliado' WHERE trabalhos.codigo_trab = '$idTrabalho'";
elseif ($statusTrabalho == 2)
    $sql = "UPDATE trabalhos SET aprovado = '$statusTrabalho', situacao = 'Em análise' WHERE trabalhos.codigo_trab = '$idTrabalho'";

if(mysql_query($sql))
{
    echo "<br><br><br><br><br><br><br>";
    echo "<font size='30' color='green'> <center>Alteração efetuada com sucesso</center></font>";
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    echo "<meta http-equiv=\"refresh\" content=\"2; URL='https://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2022/form_alterar_status_submissao.php'\"/>";
}
else
{
    echo "<br><br><br><br><br><br><br>";
    echo "<font size='30' color='red'> <center>Erro ao alterar status do trabalho</center></font>";
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    echo "<meta http-equiv=\"refresh\" content=\"5; URL='https://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2022/form_alterar_status_submissao.php'\"/>";
}
