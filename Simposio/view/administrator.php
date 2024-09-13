<?php
session_start();
if(!isset($_SESSION) || ($_SESSION['user_type'] != 1) || ($_SESSION['user_type'] !=2)){
   include 'error404.php';
   exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./assets/css/style_home.css">
</head>

<body>
    <div class="container">
        <nav class="sidebar">
            <?php include 'menu.php'; ?>
        </nav>
        <div class="content">
            <h2>Área administrativa</h2>
            <ul>
                <?php if (!isset($_SESSION['user_type']) || ($_SESSION['user_type'] == 1)) { ?>
                    <li><a href="#" onclick="carregarConteudo('approve_teachers.php')">Aprovar Professores</a></li>
                    <li><a href="../controller/emailTemplateController.php?action=index" onclick="carregarConteudo('edit_email_templates.php')">Editar email automático</a></li>
                    <li><a href="./editPresentation">Editar apresentação</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>

</body>

</html>