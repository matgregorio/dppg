<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    ?>
    <br>
    <center>
        <b>Trabalhos para os Avaliadores Externos</b>
        <br><br>
        Escolha uma das opçoes abaixo
    </center>
    <br>
    <ul>
        <li><a href="simposio.php?arquivo2=listagem_trabalhos.php">Enviar trabalhos para avaliadores.</a></li>
    </ul>
    <ul>
        <li><a href="simposio.php?arquivo2=remover_trab_avaliador.php">Remover trabalhos não avaliados.</a></li>
    </ul>
<?php
}
?>

