<?php

class ParticipanteDao {

  private $connection = NULL;

  function __construct($database) {
    include_once 'conf/ConnectionFactory.class.php';
    $this->connection = new ConnectionFactory($database);
  }


  public function getObjects() {
    include_once 'model/Participante.class.php';
    $querySelectParticipante = "SELECT p.cpf, p.nome, p.email, c.nome_curso, tp.tipo FROM participantes p, cursos c, tipo_participante tp WHERE tp.codigo_tipo_participante=p.codigo_tipo_participante AND c.codigo_curso = p.codigo_curso ORDER BY p.cpf";
    $ResultSet = $this->connection->query($querySelectParticipante);
    $listParticipante = array();
    while ($data = $ResultSet->fetch(PDO::FETCH_ASSOC)) {
      $participante = new Participante();
      $participante->setCpf($data[cpf]);
      $participante->setNome(utf8_encode($data[nome]));
      $participante->setEmail(utf8_encode($data[email]));
      $participante->setCurso(utf8_encode($data[nome_curso]));
      $participante->setTipoParticipante(utf8_encode($data[tipo]));
      $listParticipante[$participante->getCpf()] = $participante;
    }
    $this->connection = NULL;
    $stmt = NULL;
    return $listParticipante;
  }

}
