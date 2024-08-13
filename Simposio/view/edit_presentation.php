<?php
session_start();
if(!isset($_SESSION['user_type']) || ($_SESSION['user_type'] != 1 && $_SESSION['user_type'] != 2)){
    header("Location: presentation.php");
    exit();
}

if (!isset($presentation)) {
    $presentation = ['content' => '']; // Evita erro caso $presentation esteja indefinido
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Apresentação</title>
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
</head>
<body>
    <h2>Editar Apresentação</h2>
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
    <form method="post" action="../controller/presentationController.php?action=edit">
        <textarea name="content" rows="15" cols="80"><?php echo htmlspecialchars($presentation['content']);?></textarea>
        <br>
        <input type="submit" value="Salvar">
    </form>
    <a href="../view/presentation.php">Cancelar</a>
    <script>
        CKEDITOR.replace('content');
    </script>
</body>
</html>