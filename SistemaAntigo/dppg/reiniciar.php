<?php

session_start();

if (($_SESSION[logado_simposio_2014]) && (in_array("1", $_SESSION[codigo_grupo]))) {
  include('includes/config.php');

  $vetor = array("grupo_pro", "historico", "inscricao", "itens_inscricao", "participantes", "sub_eventos", "trabalhos");

  foreach ($vetor as $elemento) {
    $sql = "truncate table $elemento";
    $resultado = mysql_query($sql);
  }

  $senha = md5('s1mp0s10');

  $sql_insere = "insert into participantes(cpf, senha, nome) values ('admin', '$senha', 'Admin') ";
  $resultado_insere = mysql_query($sql_insere);

  $sql_grupo = "insert into grupo_pro (codigo_grupo, cpf) values ('1', 'admin')";
  $resultado_grupo = mysql_query($sql_grupo);
  
  system("rm -rf trabalhos/*");

  echo '<center><font color="#006400"><b>Registros apagados com Sucesso!</b></font></center>';
  echo '<meta http-equiv="refresh" content="3; URL=form_limpar_BD.php">';

  mysql_close($conexao);
}
?>