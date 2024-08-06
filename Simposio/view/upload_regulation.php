<?php
session_start();
if(!isset($_SESSION['user_type']) || $_SESSION['user_type'] !=1){
    header("Location: home.php");
    exit();
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
    <h2>Upload de Regulamento</h2>
    <?php
    if(isset($_SESSION['error_message'])){
        echo "<div class='error_message'>" . $_SESSION['error_message'] . "</div>";
        unset($_SESSION['error_message']);
    }
    if(isset($_SESSION['message'])){
        echo "<div class='message'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    ?>

    <form method="post" action="../controller/regulationController.php?action=upload" enctype="multipart/form-data">
        <div>
            <label for="regulation">Selecione o arquivo PDF</label>
            <input type="file" id="regulation" name="regulation" accept="application/pdf" required>
        </div>
        <div>
            <button type="submit">Upload</button>
        </div>
    </form>
</body>
</html>