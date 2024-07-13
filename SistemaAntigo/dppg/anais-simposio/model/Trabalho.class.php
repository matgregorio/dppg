<?php

class Trabalho {

  private $codigo;
  private $autor1;
  private $autor2;
  private $autor3;
  private $autor4;
  private $autor5;
  private $autor6;
  private $autor7;
  private $prof_analisador;
  private $titulo;
  private $resumo;
  private $palavra_chave;
  private $modalidade;
  private $tipo_iniciacao;
  private $subarea;

  function __construct() {
    
  }

  function getCodigo() {
    return $this->codigo;
  }

  function getAutor1() {
    return $this->autor1;
  }

  function getAutor2() {
    return $this->autor2;
  }

  function getAutor3() {
    return $this->autor3;
  }

  function getAutor4() {
    return $this->autor4;
  }

  function getAutor5() {
    return $this->autor5;
  }

  function getAutor6() {
    return $this->autor6;
  }

  function getAutor7() {
    return $this->autor7;
  }

  function getProf_analisador() {
    return $this->prof_analisador;
  }

  function getTitulo() {
    return $this->titulo;
  }

  function getResumo() {
    return $this->resumo;
  }

  function getPalavra_chave() {
    return $this->palavra_chave;
  }

  function getModalidade() {
    return $this->modalidade;
  }

  function getTipo_iniciacao() {
    return $this->tipo_iniciacao;
  }

  function getSubarea() {
    return $this->subarea;
  }

  function setCodigo($codigo) {
    $this->codigo = $codigo;
  }

  function setAutor1($autor1) {
    if ($autor1 == '' || $autor1 == 0) {
      $this->autor1 = null;
    } else {
      $this->autor1 = $autor1;
    }
  }

  function setAutor2($autor2) {
    if ($autor2 == '' || $autor2 == 0) {
      $this->autor2 = null;
    } else {
      $this->autor2 = $autor2;
    }
  }

  function setAutor3($autor3) {
    if ($autor3 == '' || $autor3 == 0) {
      $this->autor3 = null;
    } else {
      $this->autor3 = $autor3;
    }
  }

  function setAutor4($autor4) {
    if ($autor4 == '' || $autor4 == 0) {
      $this->autor4 = null;
    } else {
      $this->autor4 = $autor4;
    }
  }

  function setAutor5($autor5) {
    if ($autor5 == '' || $autor5 == 0) {
      $this->autor5 = null;
    } else {
      $this->autor5 = $autor5;
    }
  }

  function setAutor6($autor6) {
    if ($autor6 == '' || $autor6 == 0) {
      $this->autor6 = null;
    } else {
      $this->autor6 = $autor6;
    }
  }

  function setAutor7($autor7) {
    if ($autor7 == '' || $autor7 == 0) {
      $this->autor7 = null;
    } else {
      $this->autor7 = $autor7;
    }
  }

  function setProf_analisador($prof_analisador) {
    $this->prof_analisador = $prof_analisador;
  }

  function setTitulo($titulo) {
    $this->titulo = $titulo;
  }

  function setResumo($resumo) {
    $this->resumo = $resumo;
  }

  function setPalavra_chave($palavra_chave) {
    $this->palavra_chave = $palavra_chave;
  }

  function setModalidade($modalidade) {
    $this->modalidade = $modalidade;
  }

  function setTipo_iniciacao($tipo_iniciacao) {
    $this->tipo_iniciacao = $tipo_iniciacao;
  }

  function setSubarea($subarea) {
    $this->subarea = $subarea;
  }

}

?>