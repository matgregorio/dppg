<?php

class Apoio {
  private $codigo;
  private $nome;
  function __construct($codigo, $nome) {
    $this->codigo = $codigo;
    $this->nome = $nome;
  }
  function getCodigo() {
    return $this->codigo;
  }

  function getNome() {
    return $this->nome;
  }

  function setCodigo($codigo) {
    $this->codigo = $codigo;
  }

  function setNome($nome) {
    $this->nome = $nome;
  }


}
?>