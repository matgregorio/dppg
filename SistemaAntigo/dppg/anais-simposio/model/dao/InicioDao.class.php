<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of inicio
 *
 * @author linux
 */
class InicioDao {

  private $connection = null;

  function __construct($database) {
    include "conf/ConnectionFactory.class.php";
    $this->connection = new ConnectionFactory($database);
  }

  //Method Insert
  function Insert(Inicio $inicio) {
    //Create de query of INSERT
    $queryInsertInicio = "INSERT INTO inicio (codigo, texto) VALUES ('?', '?')";
    //Prepare the query
    $stmt = $this->connection->prepare($queryInsertInicio);
    //Connect the params
    $stmt->bindParam(1, $inicio->getCodigo(), PDO::PARAM_INT);
    $stmt->bindParam(1, $inicio->getTexto(), PDO::PARAM_STR, 12);
    $stmt->execulte();
    $stmt = NULL;
    $this->connection = NULL;
  }

  //Method Delete
  function Delete(Inicio $inicio) {
    include_once "conf/mysql.connection.php";
    //Create de query of INSERT
    $queryInsertInicio = "DELETE FROM inicio WHERE codigo='?'";
    //Prepare the query
    $stmt = $this->connection->prepare($queryInsertInicio);
    //Connect the params
    $stmt->bind_param(1, $inicio->getCodigo(), PDO::PARAM_INT);
    $stmt->execulte();
    $stmt = NULL;
    $this->connection = NULL;
  }

  //Method Update
  function Update($codigo, $texto) {
    //Create de query of UPDATE
    $queryInsertInicio = "UPDATE inicio SET texto=? WHERE codigo=?";
    //Create de Statement
    $stmt = $this->connection->prepare($queryInsertInicio);
    //Connect the params
    $stmt->bindParam(1, $texto, PDO::PARAM_STR, 12);
    $stmt->bindParam(2, $codigo, PDO::PARAM_INT);
    //Exexulta a query
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

  //Method GetObjects
  function getObjects() {
    include_once "model/Inicio.class.php";
    $queryInsertInicio = "SELECT codigo, texto FROM inicio ORDER BY codigo";
    //Execulta a query
    $ResultSet = $this->connection->query($queryInsertInicio);
    while ($data = $ResultSet->fetch(PDO::FETCH_ASSOC)) {
      $oInicio = new Inicio($data[codigo], $data[texto]);
    }
    return $oInicio;
//    return $texto;
    $ResultSet = null;
    $this->connection = null;
  }

}

?>