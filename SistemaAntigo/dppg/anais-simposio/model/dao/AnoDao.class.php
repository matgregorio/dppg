<?php

class AnoDao {

  private $connection = null;

  function __construct($database) {
    include_once 'conf/ConnectionFactory.class.php';
    $this->connection = new ConnectionFactory($database);
  }

  public function getObjects() {
    include_once 'model/Ano.class.php';
    $querySelectAno = "SELECT * FROM ano ORDER BY codigo";
    $ResulSet = $this->connection->query($querySelectAno);
    $listAno = array();
    while ($data = $ResulSet->fetch(PDO::FETCH_ASSOC)) {
      $oAno = new Ano($data[codigo], $data[ano]);
      $listAno[$data[ano]] = $oAno;
    }
    $ResulSet = null;
    $this->connection = null;
    return $listAno;
  }

}

?>