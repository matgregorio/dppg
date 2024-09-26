<?php
if (session_status() ==  PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../assets/css/style_home.css">
    <meta charset="UTF-8">
    <title>Editar Apresentação</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tiny.cloud/1/rr4lcfw2c3ig3vuqllm9z9eoiuvxmxxhxpjf7upq6e3v7x5j/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> 
</head>

<body>
    <div class="container">
        <nav class="sidebar">
            <?php include 'menu.php'; ?>
        </nav>
        <div class="content">
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
                <textarea id="default">
                    Welcome to tinymce
                </textarea>
                <br>
                <button type="submit">Salvar</button>
            </form>

            <script>
                tinymce.init({
                    selector: '#default',
                     toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent'
                })
            </script>




            <a href="../view/presentation.php">Cancelar</a>
            <?php if (!isset($_SESSION['user_type'])) { ?>
                <h2>Você não está logado</h2>
                <?php include './login.php'; ?>
            <?php } ?>
        </div>
    </div>

</body>

</html>