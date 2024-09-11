<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="../vendor/tinymce/tinymce/tinymce.min.js"></script>
    <meta charset="UTF-8">
    <title>Editar Apresentação</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h2>Editar Apresentação</h2>
    <?php
    if (isset($_SESSION['message'])) {
        echo "<div class='message'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['error_message'])) {
        echo "<div class='error_message'>" . $_SESSION['error_message'] . "</div>";
        unset($_SESSION['error_message']);
    }
    ?>
    <form method="post" action="/saveEditPresentation">
        <textarea id="meuEditor" name="content" rows="15" cols="80"><?php echo htmlspecialchars($presentation['content']); ?></textarea>
        <br>
        <button type="submit">Salvar</button>
    </form>
    <a href="../view/presentation.php">Cancelar</a>
    <?php if (!isset($_SESSION['user_type'])) { ?>
        <h2>Você não está logado</h2>
        <?php include './login.php'; ?>
    <?php } ?>
</body>

</html>