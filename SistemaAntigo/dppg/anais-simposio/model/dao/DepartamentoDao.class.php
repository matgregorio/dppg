<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DepartamentoDAO
 *
 * @author linux
 */
class DepartamentoDao {
  private $connection = null;
  
  function __construct($database) {
    include_once 'conf/ConnectionFactory.class.php';
    $this->connection = new ConnectionFactory($database);
  }

  public function getObjects(){
    include_once 'model/Departamento.class.php';
    $querySelectDepartamento = "SELECT * FROM sub_area ORDER by nome_sa";
    $ResultSet = $this->connection->query($querySelectDepartamento);
    $dep = array();
    while ($data = $ResultSet->fetch(PDO::FETCH_ASSOC)){
      $departamento = new Departamento($data[codigo_sa], utf8_encode($data[nome_sa]), $data[codigo_ga]);
      $dep[] = $departamento;
    }
    $ResultSet = NULL;
    $this->connection = NULL;
    return $dep;
  }
  public function __destruct() {
    $this->connection = null;
  }
}
