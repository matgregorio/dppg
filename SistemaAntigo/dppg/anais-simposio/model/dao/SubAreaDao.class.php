<?php

class SubAreaDao {
  private $connection = NULL;
  
  function __construct($database) {
    include_once 'conf/ConnectionFactory.class.php';
    $this->connection = new ConnectionFactory($database);
  }
  
  public function getObject($id){
    include_once 'model/SubArea.class.php';
    $querySelectSubArea = "SELECT codigo_sa, nome_sa, nome_ga FROM sub_area WHERE codigo_sa=?";
    $stmt = $this->connection->prepare($querySelectSubArea);
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $subArea = new SubArea();
    $subArea->setCodigo($data[codigo_sa]);
    $subArea->setNome($data[nome_sa]);
    $subArea->setCodigoGA($data[codigo_ga]);
    return $subArea;
  }
}
?>
