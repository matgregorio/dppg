<?php
/** Recebe os dados da página definir_apresentacoes_orais.php e processa os dados para guardar no banco*/

session_start();
include_once('includes/config.php');
include_once('trataInjection.php');

/*Previne SQL injection*/
if (protectorString($_POST['checkBoxApresentacaoPoster']))
   // return;

if(!in_array("1", $_SESSION[codigo_grupo]))
{
    echo "</br> </br> </br> </br> </br> </br> </br>";
    echo "<center><h3>Somente administradores podem acessar o conteúdo</h3></center>";
    return;
}

foreach (($_POST['checkBoxApresentacaoOral']) as $a)
{
    $sqlOral = "UPDATE `trabalhos` SET `tipo_apresentacao` = '1' WHERE `trabalhos`.`codigo_trab` = $a";
    mysql_query($sqlOral) or die("Erro de conexão com o banco de dados");
}
foreach (($_POST['checkBoxApresentacaoPoster']) as $b)
{
   $sqlPoster = "UPDATE `trabalhos` SET `tipo_apresentacao` = '0' WHERE `trabalhos`.`codigo_trab` = $b";
   mysql_query($sqlPoster)  or die("Erro de conexão com o banco de dados");
}

mysql_close();

echo "<center> <h2> Atualizações efetuadas </h2> </center></br></br><center> <h3>Redirecionando ... </h3></center></center>";
echo '<meta http-equiv="refresh" content="3; URL=definir_tipo_apresentacao.php" />';
