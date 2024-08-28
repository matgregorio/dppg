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
    <link rel="stylesheet" type="text/css" href="../assets/css/style_home.css">
    <!--INSERINDO SUMMERNOTE -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <meta charset="UTF-8">
    <title>Editar Apresentação</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        $(document).ready(function() {
            $('#meuEditor').summernote({
                height: 300, // Altura do editor
                iframe:true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <nav class="sidebar">
            <?php include 'menu.php'; ?>
        </nav>
        <div class="content" id="content">
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
            <form method="post" action="../controller/presentationController.php?action=edit">
                <textarea id="meuEditor" name="content" rows="15" cols="80"><?php echo htmlspecialchars($presentation['content']); ?></textarea>
                <br>
                <button type="submit">Salvar</button>
            </form>
            <a href="../view/presentation.php">Cancelar</a>
        </div>
    </div>
    <?php if (!isset($_SESSION['user_type'])) { ?>
        <h2>Você não está logado</h2>
        <?php include './login.php'; ?>
    <?php } ?>
</body>

</html>