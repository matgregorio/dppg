<?php

session_start();
if ($_SESSION[logado_simposio_2021]) {
include("includes/config.php");

$codigo_sa = mysql_real_escape_string($_GET["id"]);
$codigo_trab = mysql_real_escape_string($_GET["c"]);

//Seleciona todos orientadores que pertencem a esta sub-área
$orientadores = mysql_query("SELECT cpf, nome FROM participantes WHERE codigo_sa='$codigo_sa'");
$orientadores_prof = mysql_query("SELECT cpf_prof_analisador FROM trabalhos WHERE codigo_trab='$codigo_trab'");
$avaliador = mysql_fetch_array($orientadores_prof);
?>
<select name="orientador">
    <?php
    while ($row = mysql_fetch_array($orientadores)) {
        if ($avaliador[cpf_prof_analisador] == $row[cpf]) {
            echo "<option value='$row[cpf]' selected='true'>$row[nome]</option>";
        } else {
            echo "<option value='$row[cpf]'>$row[nome]</option>";
        }
    }
    if (mysql_num_rows($orientadores) == 0) {
        echo 'Não há Orientadores Cadastrados|0';
    }
    }
    ?>
</select><font color="#FF0000"> *</font>
