<?php
include("../../includes/config2.php");
include_once ('trataInjection.php');

if(protectorString($_GET[f]))
    return;

$id = mysql_real_escape_string($_GET[f]);
$result = mysql_query("UPDATE projetosparticipantes SET liberar='1' WHERE idProjetoParticipante='$id'");

if ($result)
{
    echo"<center><h2><font color='#7cfc00'>Certificado liberado com sucesso !</font></h2></center>";
}
else
{
    echo"<center><h2><font color='red'>Erro na liberação do certificado ! Falha na Comunicação com o Banco de Dados.</font></h2></center>";
}
mysql_close($conexao);
?>