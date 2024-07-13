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
class Inicio {
  private $codigo;
  private $texto;
  
  /*
   * Construct method,
   * create an instance of class and define theis attributes
   */
  function __construct($codigo, $texto) {
    $this->codigo = $codigo;
    $this->texto = $texto;
  }
  
  /*
   * Get and Seter, method
   */
  function getCodigo() {
    return $this->codigo;
  }

  function getTexto() {
    return $this->texto;
  }

  function setCodigo($codigo) {
    $this->codigo = $codigo;
  }

  function setTexto($texto) {
    $this->texto = $texto;
  }


}
?>