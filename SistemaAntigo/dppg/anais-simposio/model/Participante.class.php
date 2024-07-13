<?php

class Participante {

  private $cpf;
  private $nome;
  private $email;
  private $curso;
  private $tipoParticipante;

  function __construct() {
    
  }

  function getCpf() {
    return $this->cpf;
  }

  function getNome() {
    return $this->nome;
  }

  function getEmail() {
    return $this->email;
  }

  function getCurso() {
    return $this->curso;
  }

  function getTipoParticipante() {
    return $this->tipoParticipante;
  }

  function setCpf($cpf) {
    $this->cpf = $cpf;
  }

  function setNome($nome) {
    $this->nome = $nome;
  }

  function setEmail($email) {
    $this->email = $email;
  }

  function setCurso($curso) {
    $this->curso = $curso;
  }

  function setTipoParticipante($tipoParticipante) {
    $this->tipoParticipante = $tipoParticipante;
  }


}

?>