<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of normasPublicacao
 *
 * @author linux
 */
class NormasPublicacaoDao {
  private $connection = null;
  
  function __construct($database) {
    include 'conf/ConnectionFactory.class.php';
    $this->connection = new ConnectionFactory($database);
  }

  //Method Update
  public function Update($codigo, $texto) {
    //Create de query of INSERT
    $queryInsertNormas = "UPDATE normas SET texto=? WHERE codigo=?";
    //Create de Statement
    $stmt = $this->connection->prepare($queryInsertNormas);
    //Connect the params
    $stmt->bindParam(1, $texto, PDO::PARAM_STR, 12);
    $stmt->bindParam(2, $codigo, PDO::PARAM_INT);
    $stmt = null;
    $this->connection = null;
    if ($resp) {
      include "../conf/ConnectionFactory.class.php";
      $this->connection = new ConnectionFactory("dppg_simposio");
      return $this->getObjects();
    }
    return NULL;
  }

  //Method GetObjects
  public function getObjects() {
   include_once 'model/NormasPublicacao.class.php';
    //Create de query of SELECT
    $queryInsertApresentacao = "SELECT codigo, texto FROM normas ORDER BY codigo";
    //Prepare the query
    $ResultSet = $this->connection->query($queryInsertApresentacao);
    while ($data = $ResultSet->fetch(PDO::FETCH_ASSOC)) {
      $oNormas = new NormasPublicacao($data[codigo], $data[texto]);
    }
    return $oNormas;
    $ResultSet = null;
    $this->connection = null;
  }
  
}
?>