<?php date_default_timezone_set("America/Sao_Paulo"); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <title>Galeria Poster</title>
</head>

<body>

    <div class="container">
        <?php require_once 'partes/topo.php' ?>

        <div class="conteudo-principal">

            <?php
            if(isset($_GET['area']))
                require_once './areas/' . $_GET['area'];
            else
                require_once './areas/agron_agric_amb.php';
            ?>
        </div>

        <?php require_once 'partes/rodape.php' ?>

    </div>

</body>

</html>