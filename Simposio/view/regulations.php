<?php

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
    if(isset($regulations) && $regulations->rowCount()>0){
        while($row = $regulations->fetch(PDO::FETCH_ASSOC)){
            $file_path = "../uploads/" . htmlspecialchars($row['file_name']);
        ?>
        <div>
            <h3>Regulamento enviado em: <?php echo $row['updated_at'];?></h3>
            <!--EXIBIR O PDF-->
            <iframe src="<?php echo $file_path; ?>" width="100%" height="700px"></iframe>
        </div>
        <hr>
        <?php
        }
        echo "</ul>";
    }else{
        echo "<p>Não há regulamentos disponíveis.</p>";
    }
    ?>
</body>
</html>