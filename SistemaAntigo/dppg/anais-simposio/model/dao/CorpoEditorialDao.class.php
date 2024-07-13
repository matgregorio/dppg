<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of corpoEditorial
 *
 * @author linux
 */
class CorpoEditorialDao {

  private $connection = null;
          
  function __construct($database) {
    include_once 'conf/ConnectionFactory.class.php';
    $this->connection = new ConnectionFactory($database);
  }

  
  //Method Insert
  public function Insert(CorpoEditorial $corpoEditorial) {
    //Create de query of INSERT
    $queryInsertCEditorial = "INSERT INTO corpoEditorial (codigo, texto) VALUES ('?', '?')";
    //Prepare the query
    $stmt = $this->connection->prepare($queryInsertCEditorial);
    //Connect the params
    $stmt->bindParam(1, $corpoEditorial->getCodigo(), PDO::PARAM_INT);
    $stmt->bindParam(2, $corpoEditorial->getTexto(), PDO::PARAM_STR, 12);
    $stmt->execute();
    $stmt = NULL;
    $this->connection = NULL;
  }

  //Method Delete
  public function Delete(CorpoEditorial $corpoEditorial) {
    //Create de query of DELETE
    $queryInsertCEditorial = "DELETE FROM corpoEditorial WHERE codigo='?'";
    //Prepare the query
    $stmt = $this->connection->prepare($queryInsertCEditorial);
    //Connect the params
    $stmt->bindParam(1, $corpoEditorial->getCodigo(), PDO::PARAM_INT);
    $stmt->execute();
    $stmt = NULL;
    $this->connection = NULL;
  }

  //Method Update
  public function Update($codigo, $texto) {
    //Create de query of UPDATE
    $queryInsertCEditorial = "UPDATE corpoEditorial SET texto=? WHERE codigo=?";
    //Prepare the query
    $stmt = $this->connection->prepare($queryInsertCEditorial);
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
  public function getObject(CorpoEditorial $corpoEditorial) {
    
  }

  //Method GetObjects
  public function getObjects() {
    include_once 'model/CorpoEditorial.class.php';
    //Create de query of SELECT
    $queryInsertCEditorial = "SELECT codigo, texto FROM corpoEditorial ORDER BY codigo";
    //Prepare the query
    $ResultSet = $this->connection->query($queryInsertCEditorial);
    while ($data = $ResultSet->fetch(PDO::FETCH_ASSOC)){
      $oCorpEditorial = new CorpoEditorial($data[codigo], $data[texto]);
    }
    return $oCorpEditorial;
    $ResultSet = NULL;
    $this->connection = NULL;
  }

}
?>