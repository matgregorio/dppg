<?php

class ApoioDao {

  private $connection = null;

  function __construct($database) {
    include_once 'conf/ConnectionFactory.class.php';
    $this->connection = new ConnectionFactory($database);
  }

  public function getListObjects($codigo) {
    include_once 'model/Apoio.class.php';

    $querySelectParticipante = "SELECT a.* FROM apoio a, apoio_trabalho at WHERE a.codigo_apoio=at.codigo_apoio AND at.codigo_trabalho=? ORDER BY a.nome";
    $stmt = $this->connection->prepare($querySelectParticipante);
    $stmt->bindParam(1, $codigo);

    $stmt->execute();
    $listApoios = array();
    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $apoio = new Apoio($data[codigo_apoio], utf8_encode($data[nome]));
      $listApoios[] = $apoio;
    }
    $this->connection = NULL;
    $stmt = NULL;
    return $listApoios;
  }

}
?>