<?php

class SubArea {

  private $codigo;
  private $nome;
  private $codigoGA;

  function __construct() {
    
  }

  function getCodigo() {
    return $this->codigo;
  }

  function getNome() {
    return $this->nome;
  }

  function getCodigoGA() {
    return $this->codigoGA;
  }

  function setCodigo($codigo) {
    $this->codigo = $codigo;
  }

  function setNome($nome) {
    $this->nome = $nome;
  }

  function setCodigoGA($codigoGA) {
    $this->codigoGA = $codigoGA;
  }

}

?>