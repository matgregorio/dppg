<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of expediente
 *
 * @author linux
 */
class ExpedienteDao {

  private $connection = null;

  function __construct() {
    include_once 'conf/ConnectionFactory.class.php';
    $this->connection = new ConnectionFactory("dppg_simposio");
  }

  //Method Insert
  public function Insert(Expediente $expediente) {
    //Create de query of INSERT
    $queryInsertExpediente = "INSERT INTO expediente (codigo, texto) VALUES ('?', '?')";
    //Prepare the query
    $stmt = $this->connection->prepare($queryInsertExpediente);
    //Connect the params
    $stmt->bindParam(1, $expediente->getCodigo(), PDO::PARAM_INT);
    $stmt->bindParam(2, $expediente->getTexto(), PDO::PARAM_STR, 12);
    $stmt->execute();
    $stmt = NULL;
    $this->connection = NULL;
  }

  //Method Delete
  public function Delete(Expediente $expediente) {
    //Create de query of DELETE
    $queryInsertExpediente = "DELETE FROM expediente WHERE codigo='?'";
    //Prepare the query
    $stmt = $this->connection->prepare($queryInsertExpediente);
    //Connect the params
    $stmt->bindParam(1, $expediente->getCodigo(), PDO::PARAM_INT);

    $stmt->execute();
    $stmt = NULL;
    $stmt->connection = NULL;
  }

  //Method Update
  public function Update($codigo, $texto) {
    //Create de query of INSERT
    $queryInsertExpediente = "UPDATE expediente SET texto=? WHERE codigo=?";
    //Prepare the query
    $stmt = $this->connection->prepare($queryInsertExpediente);
    //Connect the params
    $stmt->bindParam(1, $texto, PDO::PARAM_STR, 12);
    $stmt->bindParam(2, $codigo, PDO::PARAM_INT);
    $resp = $stmt->execute();
    $this->connection = null;
    if ($resp) {
      include "../conf/ConnectionFactory.class.php";
      $this->connection = new ConnectionFactory("dppg_simposio");
      return $this->getObjects();
    }
    return NULL;
  }

  //Method GetObject
  public function getObject(Expediente $expediente) {
    
  }

  //Method GetObjects
  public function getObjects() {
    include_once 'model/Expediente.class.php';
    //Create de query of SELECT
    $queryInsertExpediente = "SELECT codigo, texto FROM expediente ORDER BY codigo";
    $ResultSet = $this->connection->query($queryInsertExpediente);
    while ($data = $ResultSet->fetch(PDO::FETCH_ASSOC)) {
      $oExpediente = new Expediente($data[codigo], $data[texto]);
    }
    return $oExpediente;
    $ResultSet = NULL;
    $this->connection = NULL;
  }

}

?>