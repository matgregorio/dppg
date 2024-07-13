<?php

$servidor = '';
$usuario = '';
$senha = '';
$banco = '';

$conexao = mysql_connect($servidor, $usuario, $senha);

if ($_GET[codificacao_iso] != 1) {
  mysql_query("SET NAMES 'utf8'");
  mysql_query('SET character_set_connection=utf8');
  mysql_query('SET character_set_client=utf8');
  mysql_query('SET character_set_results=utf8');
}
mysql_select_db($banco, $conexao);
?>
