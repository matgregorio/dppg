<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Editar Templates de email</h2>
    <?php
    if(isset($_SESSION['error_message'])){
        echo "<div class= 'error_message'>" . $_SESSION['error_message'] . "</div>";
        unset($_SESSION['error_message']);
    }
    if(isset($_SESSION['message'])){
        echo "<div class= 'message'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    ?>
</body>
</html>