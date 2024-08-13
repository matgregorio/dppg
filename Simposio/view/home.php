<!DOCTYPE html>
<html>
<?php

session_start();
?>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/style_home.css">
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
</head>

<body>
    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="#" data-content="home_page">Home</a></li>
                <li><a href="#" data-content="presentation">Apresentação</a></li>
                <li><a href="../controller/regulationController.php?action=viewAll" data-content="regulations">Regulamento</a></li>
                <?php if (!isset($_SESSION['user_type'])) {?>
                <li><a href="#" data-content="registrer">Cadastrar</a></li>
                <li> <?php include './login.php';?></li>
                <?php } else { ?>
                    <h2>Welcome, <?php echo $_SESSION['user_name']; ?></h2>
                    <p>Your user type is: <?php echo $_SESSION['user_type']; ?></p>
                    <li><a href="#" data-content="logout">Logout</a></li>
                    <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 1) : ?>
                        <a href="../controller/emailTemplateController.php?action=index">Editar Templates de email</a>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2)) : ?>
                        <a href="../view/approve_teachers.php">Aprovar Professores</a>
                        <a href="#" data-content="upload_regulation">Mudar o regulamento</a>
                        <a href="#" data-content="edit_presentation">Editar apresentação</a>
                    <?php endif; ?>
                <?php } ?>
            </ul>
        </nav>
        <div class="content" id="content">
            <?php include './home_page.php' ?>
        </div>
    </div>
    <?php if (!isset($_SESSION['user_type'])) { ?>
        <h2>Você não está logado</h2>
        <?php include './login.php'; ?>
    <?php } else { ?>

    <?php } ?>
    <script src="../assets/js/script_home.js"></script>
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
</body>

</html>