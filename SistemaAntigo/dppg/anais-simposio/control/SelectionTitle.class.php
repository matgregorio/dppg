<?php

$year = date("Y");
include '../conf/ConnectionFactory.class.php';
include_once ('../../trataInjection.php');

if(protectorString($_GET[sa]) || protectorString($_GET[a]))
    return;

$connection = new ConnectionFactory("dppg_simposio$year");
$condition = mysql_real_escape_string($_GET[sa]);
$ano = mysql_real_escape_string($_GET[a]);
//seleção dos trabalhos e participantes
if ($condition == "t") {
  $querySelectTrabalho = "SELECT t.codigo_trab, t.titulo, t.palavra_chave FROM trabalhos t, acervo ac WHERE ac.codigo_trab=t.codigo_trab AND ac.codigo_ano=? ORDER BY t.titulo";
  $stmtTrabalho = $connection->prepare($querySelectTrabalho);
  $stmtTrabalho->bindParam(1, $ano);
  //------------------------------
  $querySelectParticipante = "SELECT t.codigo_trab, p.nome, p.cpf FROM participantes p, trabalhos t, acervo ac WHERE p.cpf=t.autor1 AND t.codigo_trab=ac.codigo_trab AND ac.codigo_ano=? ORDER BY p.nome";
  $stmtParticipante = $connection->prepare($querySelectParticipante);
  $stmtParticipante->bindParam(1, $ano);
} else {
  $querySelectTrabalho = "SELECT t.codigo_trab, t.titulo, t.palavra_chave FROM trabalhos t, acervo ac WHERE ac.codigo_trab=t.codigo_trab AND t.codigo_sa=? AND ac.codigo_ano=? ORDER BY t.titulo";
  $stmtTrabalho = $connection->prepare($querySelectTrabalho);
  $stmtTrabalho->bindParam(1, $condition);
  $stmtTrabalho->bindParam(2, $ano);
  //------------------------------
  $querySelectParticipante = "SELECT p.nome, p.cpf FROM participantes p, trabalhos t, acervo ac WHERE p.cpf=t.autor1 AND t.codigo_trab=ac.codigo_trab AND t.codigo_sa=? AND ac.codigo_ano=? ORDER BY p.nome";
  $stmtParticipante = $connection->prepare($querySelectParticipante);
  $stmtParticipante->bindParam(1, $condition);
  $stmtParticipante->bindParam(2, $ano);
}
$stmtTrabalho->execute();
$stmtParticipante->execute();

if ($stmtTrabalho->columnCount() > 0) {
  echo "<table border='0'>";
  echo "<tr>";
  echo "<td align='center'>";
  echo "<h6>Título:&nbsp;<br>";
//  echo "</td>";
//  echo "<td>";
  echo "<select name='titulo' style='width: 450px'>";
  echo "<option value=''>Todos</option>";
  while ($dataTrabalho = $stmtTrabalho->fetch(PDO::FETCH_ASSOC)) {
    echo "<option value='$dataTrabalho[codigo_trab]'>" . utf8_encode($dataTrabalho[titulo]) . "</option>";
  }
  echo "</select></h6>";
  echo "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td align='center'>";
  echo "<h6>Autor1:&nbsp;<br>";
//  echo "</td>";
//  echo "<td>";
  echo "<select name='autor1' style='width: 450px'>";
  echo "<option value=''>Todos</option>";
  while ($dataParticipante = $stmtParticipante->fetch(PDO::FETCH_ASSOC)) {
    echo "<option value='$dataParticipante[cpf]'>" . utf8_encode($dataParticipante[nome]) . "</option>";
  }
  echo "</select></h6>";
  echo "</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td align='center'>";
  echo "<h6>Palavra Chave:&nbsp;<br>";
//  echo "</td>";
//  echo "<td>";
  echo "<select name='palavrachave' style='width: 450px'>";
  echo "<option value=''>Todos</option>";
  $stmtTrabalho->closeCursor();
  $stmtTrabalho->execute();
  while ($dataTrabalho = $stmtTrabalho->fetch(PDO::FETCH_ASSOC)) {
    echo "<option value='$dataTrabalho[codigo_trab]'>" . utf8_encode($dataTrabalho[palavra_chave]) . "</option>";
  }
  echo "</select></h6>";
  echo "</td>";
  echo "</tr>";
  echo "<table>";
  echo "<br>";
  echo "<input type='hidden' name='ano' value='$ano'>";
  echo "<input type='submit' name='consultar' value='Consultar'>";
} else {
  echo "<br><br><center><b>Não há de Trabalhos dessa Sub Área!<br>";
}

$connection = null;
$stmtParticipante = null;
$stmtTrabalho = null;
?>