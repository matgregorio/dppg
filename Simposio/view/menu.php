<?php
session_start();
?>
<head>
    <link rel="stylesheet" type="text/css" href="../assets/css/style_menu.css">
</head>
<body>
<ul>
    <li><a href="#" onclick="carregarConteudo('home_page.php')">Home</a></li>
    <li><a href="#" onclick="carregarConteudo('presentation.php')">Apresentação</a></li>
    <li><a href="#" onclick="carregarConteudo('regulations.php')">Regulamento</a></li>
    <li><a href="#" onclick="carregarConteudo('')">Corpo Editorial</a></li>
    <li><a href="#" onclick="carregarConteudo('')">Expediente</a></li>
    <li><a href="#" onclick="carregarConteudo('')">Normas para Publicação</a></li>
    <li><a href="#" onclick="carregarConteudo('')">Programação</a></li>
    <li><a href="#" onclick="carregarConteudo('')">Modelo de Pôster</a></li>
    <li><a href="#" onclick="carregarConteudo('')">Validar Certificado</a></li>
    <li><a href="#" onclick="carregarConteudo('')">Anais</a></li>
    <li><a href="/index.php">DPPG</a></li>
    <?php if(!isset($_SESSION['user_type'])) {?>
    <li><a href="#" onclick="carregarConteudo('registrer.php')">Cadastrar</a></li>
    <li><?php include './login.php';?></li>
    <?php } else {?>
        <li><a href="#" onclick="carregarConteudo('logout.php')">Logout</a></li>
    <?php } ?>
    <?php if(isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2)){ ?> <!-- se for adminsitrador ou subadministrador, abre a página de administração -->
        <li><a href="#" onclick="carregarConteudo('administrator.php')">Administração</a></li>
    <?php } ?>
</ul>
</body>