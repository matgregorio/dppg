<?php
session_start();
if (!isset($_SESSION['user_type']) || ($_SESSION['user_type'] != 1 && $_SESSION['user_type'] != 2)) {
    header("Location: ./home.php");
    exit();
}

if (!isset($presentation)) {
    $presentation = ['content' => '']; // Evita erro caso $presentation esteja indefinido
}
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
        <script>
        function carregarConteudo(pagina) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', pagina, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('content').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>
    <form method="post" action="../controller/presentationController.php?action=edit">
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