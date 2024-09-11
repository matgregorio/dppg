<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apresentação</title>
</head>
<body>
    <h2>Apresentação</h2>
    <?php
    if(isset($_SESSION['message'])){
        echo "<div class='message'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    if(isset($_SESSION['error_message'])){
        echo "<div class='error_message'>" . $_SESSION['error_message'] . "</div>";
        unset($_SESSION['error_message']);
    }
    ?>
    <div>
        <?php echo nl2br(htmlspecialchars($content)); ?>
    </div>
</body>
</html>