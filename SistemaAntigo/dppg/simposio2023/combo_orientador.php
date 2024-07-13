<?php

session_start();
if ($_SESSION[logado_simposio_2021]) {
    include("includes/config.php");

    $codigo_sa = addslashes(trim($_GET["id"]));

    //Seleciona todos orientadores que pertencem a esta sub-área
    $orientadores = mysql_query("SELECT cpf, nome FROM participantes WHERE codigo_sa='$codigo_sa' ORDER BY nome");
    $total = mysql_num_rows($orientadores);
    $cont = 1;
    while ($row = mysql_fetch_array($orientadores)) {
        if (mysql_num_rows($orientadores) == 1) {
            echo $row["nome"] . "|" . $row["cpf"];
        } else if ($total == $cont) {
            echo $row["nome"] . "|" . $row["cpf"];
        } else {
            echo $row["nome"] . "|" . $row["cpf"] . ",";
            $cont++;
        }
    }
    if (mysql_num_rows($orientadores) == 0) {
        echo 'Não há Orientadores Cadastrados|0';
    }
}
?>