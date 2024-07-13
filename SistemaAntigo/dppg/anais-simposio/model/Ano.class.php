<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ano
 *
 * @author linux
 */
class Ano {

  private $codigo;
  private $ano;

  function __construct($codigo, $ano) {
    $this->codigo = $codigo;
    $this->ano = $ano;
  }

  function getCodigo() {
    return $this->codigo;
  }

  function getAno() {
    return $this->ano;
  }

  function setCodigo($codigo) {
    $this->codigo = $codigo;
  }

  function setAno($ano) {
    $this->ano = $ano;
  }

}

?>