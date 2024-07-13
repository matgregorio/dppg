<?php

class ApresentacaoDao {

  private $connection = null;

  function __construct($database) {
    include_once "conf/ConnectionFactory.class.php";
    $this->connection = new ConnectionFactory($database);
  }

  //Method Insert
  public function Insert(Apresentacao $apresentacao) {
    //Create de query of INSERT
    $queryInsertApresentacao = "INSERT INTO apresentacao (codigo, texto) VALUES ('?', '?')";
    //Prepare the query
    $stmt = $this->connection->prepare($queryInsertApresentacao);
    //Connect the params
    $stmt->bindParam(1, $apresentacao->getCodigo(), PDO::PARAM_INT);
    $stmt->bindParam(2, $apresentacao->getTexto(), PDO::PARAM_STR, 12);
    $stmt->execulte();
    $stmt = NULL;
    $this->connection = null;
  }

  //Method Delete
  public function Delete(Apresentacao $apresentacao) {
    //Create de query of DELETE
    $queryInsertApresentacao = "DELETE FROM apresentacao WHERE codigo='?'";
    //Prepare the query
    $stmt = $this->connection->prepare($queryInsertApresentacao);
    //Connect the params
    $stmt->bindParam(1, $apresentacao->getCodigo(), PDO::PARAM_INT);
    $stmt->execulte();
    $stmt = NULL;
    $this->connection = NULL;
  }

  //Method Update
  public function Update($codigo, $texto) {
    //Create de query of UPDATE
    $queryInsertApresentacao = "UPDATE apresentacao SET texto=? WHERE codigo=?";
    //Prepare the query
    $stmt = $this->connection->prepare($queryInsertApresentacao);
    //Connect the params
    $stmt->bindParam(1, $texto, PDO::PARAM_STR, 12);
    $stmt->bindParam(2, $codigo, PDO::PARAM_INT);
    $resp = $stmt->execute();
    $stmt = null;
    $this->connection = null;
    if ($resp) {
      include "../conf/ConnectionFactory.class.php";
      $this->connection = new ConnectionFactory("dppg_simposio");
      return $this->getObjects();
    }
    return NULL;
  }

  //Method GetObject
  public function getObject(Apresentacao $apresentacao) {
    
  }

  //Method GetObjects
  public function getObjects() {
    include_once 'model/Apresentacao.class.php';
    //Create de query of SELECT
    $queryInsertApresentacao = "SELECT codigo, texto FROM apresentacao ORDER BY codigo";
    //Prepare the query
    $ResultSet = $this->connection->query($queryInsertApresentacao);
    while ($data = $ResultSet->fetch(PDO::FETCH_ASSOC)) {
      $oApresentacao = new Apresentacao($data[codigo], $data[texto]);
    }
    return $oApresentacao;
    $ResultSet = null;
    $this->connection = null;
  }

}

?>