<?php

include('includes/config.php');

//Sql para achar o codigo do departamento
$sql2 = "select codigo_depto from participantes where cpf='$_SESSION[cpf]'";
$resultado2 = mysql_query($sql2);
$campos2 = mysql_fetch_array($resultado2);

//$codigo =  $campos2[codigo_depto];

//Professores do Departamento
$sql3 = "select cpf, nome, email, pesquisa from participantes p, departamento d where
	d.codigo_depto = p.codigo_depto and p.codigo_depto='$campos2[codigo_depto]'";
$resultado3 = mysql_query($sql3);

echo "<select size='1' name='professores' style='width:100px'>";
echo '<option value="1">Selecione</option>';
while ($campos3 = mysql_fetch_array($resultado3))
    echo "<option value='$campos3[cpf]'> $campos3[nome] - $campos3[pesquisa]</option>";

echo "</select>";
?>