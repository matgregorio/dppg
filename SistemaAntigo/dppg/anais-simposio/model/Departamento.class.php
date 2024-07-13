<?php
class Departamento {
  private $codigo;
  private $nome;
  private $codigo_ga;
  
  function __construct($codigo, $nome, $codigo_ga) {
    $this->codigo = $codigo;
    $this->nome = $nome;
    $this->codigo_ga = $codigo_ga;
  }

  function getCodigo() {
    return $this->codigo;
  }

  function getNome() {
    return $this->nome;
  }

  function getCodigo_ga() {
    return $this->codigo_ga;
  }

  function setCodigo($codigo) {
    $this->codigo = $codigo;
  }

  function setNome($nome) {
    $this->nome = $nome;
  }

  function setCodigo_ga($codigo_ga) {
    $this->codigo_ga = $codigo_ga;
  }


}
?>