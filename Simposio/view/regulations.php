<?php
session_start();

include_once '../controller/regulationController.php';

$controller = new RegulationController();
$regulations = $controller->viewAll();
if ($regulations === false) {
    die("Erro ao acessar regulamentos.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Regulamento</h2>
    <?php
    if($regulations->rowCount()>0){
        echo "<ul>";
        while($row = $regulations->fetch(PDO::FETCH_ASSOC)){
            echo "<li><a href='../uploads/" . htmlspecialchars($row['file_name']) . "' target='_blank'>Ver Regulamento (PDF)</a> - Enviado em: " . $row['updated_at'] . "</li>";
        }
        echo "</ul>";
    }else{
        echo "<p>Não há regulamentos disponíveis.</p>";
    }
    ?>
</body>
</html>