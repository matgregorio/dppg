<?php
class daoRegulamento{
    function save()
{
    include 'conexaoConfig.php';
    $sqlUltimo = $pdo->prepare("SELECT * FROM regulamento WHERE deleted_at = '0000-00-00 00:00:00' ORDER BY idRegulamento DESC LIMIT 1");
    $sqlUltimo->execute();
    $info = $sqlUltimo->fetchAll();
    $sql = $pdo->prepare("INSERT INTO regulamento VALUES(NULL,?,?,?,?,?,?)");
    $sql->execute(array($textoRegulamento,$arquivoRegulamento, $idUsuario, $created_at, $updated_at, $deleted_at));
    date_default_timezone_set('America/Sao_Paulo');
    $dataHoraAtual = date('Y/m/d H:i:s', time());
    $idRegulamento = $idUltimo[0][0];
    $sqlDel = $pdo->prepare("UPDATE regulamento SET deleted_at = '$dataHoraAtual' WHERE idRegulamento = '$idRegulamento'");
    $sqlDel = $pdo->execute();
}

function getDados(){
    include 'conexaoConfig.php';
    $info = $pdo->prepare("SELECT * FROM regulamento WHERE deleted_at = '0000-00-00 00:00:00' ORDER BY idRegulamento DESC LIMIT 1");
    $info->execute();
    $dados = $info->fetchAll();
    return $dados;
}
}

