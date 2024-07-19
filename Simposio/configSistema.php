<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php 
    include './controller/controllerRegulamento.php';
    date_default_timezone_set('America/Sao_Paulo');
    $dataHoraAtual = date('Y/m/d H:i:s', time());
    $teste = insert('novo teste <h1>isso tambem</h1>',1,$dataHoraAtual,
        '0000-00-00 00:00:00','0000-00-00 00:00:00');
    echo $teste;
    ?>
</body>
</html>