<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regulamento</title>
</head>
<body>
    <?php 
        include './controller/controllerRegulamento.php';
        $dados = getDados();
        echo $dados[0][1];/* id, texto*/
    ?>
</body>
</html>