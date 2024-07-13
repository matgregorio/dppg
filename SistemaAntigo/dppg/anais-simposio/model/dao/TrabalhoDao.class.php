<?php

class TrabalhoDao {

  private $connection = null;

  function __construct($database) {
    include_once 'conf/ConnectionFactory.class.php';
    $this->connection = new ConnectionFactory($database);
  }

  public function getSingletObjects($codigo) {
    include_once 'model/Trabalho.class.php';

    $querySelectParticipante = "SELECT codigo_trab, titulo, resumo, palavra_chave FROM trabalhos WHERE codigo_trab=?";
    $stmt = $this->connection->prepare($querySelectParticipante);
    $stmt->bindParam(1, $codigo, PDO::PARAM_INT);

    $stmt->execute();
    $listTrabalhos = array();
    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $trabalhos = new Trabalho();
      $trabalhos->setCodigo($data[codigo_trab]);
      $trabalhos->setTitulo(utf8_encode($data[titulo]));
      $trabalhos->setResumo(utf8_encode($data[resumo]));
      $trabalhos->setPalavra_chave(utf8_encode($data[palavra_chave]));
      $listTrabalhos[$trabalhos->getCodigo()] = $trabalhos;
    }
    $this->connection = NULL;
    $stmt = NULL;
    return $listTrabalhos;
  }

  public function getListObjects($condition, $ano) {
    include_once 'model/Trabalho.class.php';

    if ($condition == "t") {
      $querySelectParticipante = "SELECT t.codigo_trab, t.titulo, t.palavra_chave FROM trabalhos t, acervo ac WHERE ac.codigo_trab=t.codigo_trab AND ac.codigo_ano=? ORDER BY t.titulo";
      $stmt = $this->connection->prepare($querySelectParticipante);
      $stmt->bindParam(1, $ano);
    } else {
      $querySelectParticipante = "SELECT t.codigo_trab, t.titulo, t.palavra_chave FROM trabalhos t, acervo ac WHERE ac.codigo_trab=t.codigo_trab AND t.codigo_sa=? AND ac.codigo_ano=? ORDER BY t.titulo";
      $stmt = $this->connection->prepare($querySelectParticipante);
      $stmt->bindParam(1, $condition);
      $stmt->bindParam(2, $ano);
    }
    $stmt->execute();
    $listTrabalhos = array();
    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $trabalhos = new Trabalho();
      $trabalhos->setCodigo($data[codigo_trab]);
      $trabalhos->setTitulo(utf8_encode($data[titulo]));
      $trabalhos->setPalavra_chave(utf8_encode($data[palavra_chave]));
      $listTrabalhos[$trabalhos->getCodigo()] = $trabalhos;
    }
    $this->connection = NULL;
    $stmt = NULL;
    return $listTrabalhos;
  }

  public function getListObjectsFull($condition, $ano, $titulo, $autor, $palavraChave) {
    include_once 'model/Trabalho.class.php';
    if ($titulo == "%%" && $palavraChave != "%%") {
      $titulo = $palavraChave;
    }
    if ($condition == "t") {
      $querySelectParticipante = "SELECT t.* FROM trabalhos t, acervo ac WHERE ac.codigo_trab=t.codigo_trab AND ac.codigo_ano=? AND (t.codigo_trab LIKE ? AND t.autor1 LIKE ?) ORDER BY t.titulo";
      $stmt = $this->connection->prepare($querySelectParticipante);
      $stmt->bindParam(1, $ano, PDO::PARAM_INT);
      $stmt->bindParam(2, $titulo, PDO::PARAM_INT);
      $stmt->bindParam(3, $autor, PDO::PARAM_STR);
    } else {
      $querySelectParticipante = "SELECT t.* FROM trabalhos t, acervo ac WHERE ac.codigo_trab=t.codigo_trab AND t.codigo_sa=? AND ac.codigo_ano=? AND (t.codigo_trab LIKE ? AND t.autor1 LIKE ?) ORDER BY t.titulo";
      $stmt = $this->connection->prepare($querySelectParticipante);
      $stmt->bindParam(1, $condition, PDO::PARAM_STR);
      $stmt->bindParam(2, $ano, PDO::PARAM_INT);
      $stmt->bindParam(3, $titulo, PDO::PARAM_INT);
      $stmt->bindParam(4, $autor, PDO::PARAM_STR);
    }
    $stmt->execute();
    $listTrabalhos = array();
    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $trabalhosFull = new Trabalho();
      $trabalhosFull->setCodigo($data[codigo_trab]);
      $trabalhosFull->setAutor1($data[autor1]);
      $trabalhosFull->setAutor2($data[autor2]);
      $trabalhosFull->setAutor3($data[autor3]);
      $trabalhosFull->setAutor4($data[autor4]);
      $trabalhosFull->setAutor5($data[autor5]);
      $trabalhosFull->setAutor6($data[autor6]);
      $trabalhosFull->setAutor7($data[autor7]);
      $trabalhosFull->setProf_analisador($data[cpf_prof_analisador]);
      $trabalhosFull->setTitulo(utf8_encode($data[titulo]));
      $trabalhosFull->setResumo(utf8_encode($data[resumo]));
      $trabalhosFull->setPalavra_chave(utf8_encode($data[palavra_chave]));

      $listTrabalhos[$trabalhosFull->getCodigo()] = $trabalhosFull;
    }
    $this->connection = NULL;
    $stmt = NULL;
    return $listTrabalhos;
  }

}

?>