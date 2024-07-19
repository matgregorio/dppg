<?php
    function insert($textoRegulamento,$idUsuario,$created_at, $updated_at, $deleted_at){
        include 'conexaoConfig.php';
        $idUltimo = getDados();
        $sql = $pdo->prepare("INSERT INTO regulamento VALUES(NULL,?,?,?,?,?)");
        $sql->execute(array($textoRegulamento,$idUsuario,$created_at, $updated_at, $deleted_at));
        deletarUltimo($idUltimo[0][0]);
        return "executado com sucesso";
    }

    function getDados(){
        include 'conexaoConfig.php';
        $sql = $pdo->prepare("SELECT * FROM regulamento WHERE deleted_at = '0000-00-00 00:00:00' ORDER BY idRegulamento DESC LIMIT 1");
        $sql->execute();
        $info = $sql->fetchAll();
        return $info;
    }

    function deletarUltimo($idRegulamento){
        include 'conexaoConfig.php';
        date_default_timezone_set('America/Sao_Paulo');
        $dataHoraAtual = date('Y/m/d H:i:s', time());
        $sql = $pdo->prepare("UPDATE regulamento SET deleted_at '$dataHoraAtual' WHERE idRegulamento = '$idRegulamento'");
        $sql->execute();

    }
?>