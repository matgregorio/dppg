<?php
header('Content-Type: text/html; charset=utf-8');
?>
<html>
<head>
    <title> Participantes </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php

if ($_POST[tipo] == 0)
    include("representante.php");
else
    include("aluno_ic.php");
?>
</body>
</html>