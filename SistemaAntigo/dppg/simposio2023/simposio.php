<?php
error_reporting(E_ALL);
ini_set('display_errors', 'OFF');
session_start();
header('Content-Type: text/html; charset=utf-8');
include('./controle_prazos.php');
include_once('trataInjection.php');
include_once ('definir_trabalhos_aprovados_externo.php');

?>
<!DOCTYPE html>
<head>
    <title>DPPG</title>
    <!--meta http-equiv="Content-Type" content="text/html; charset=utf8"/>-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Galeria de fotos -->
    <!--Bibliotecas LightBox-->
    <link rel="stylesheet" type="text/css" href="css/galeria.css"/>
    <link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen"/>
    <link rel="shortcut icon" href="images/icon.ico" type="image/x-icon"/>
    <script type="text/javascript" src="js/prototype.js"></script>
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="js/scriptaculous.js?load=effects"></script>
    <script type="text/javascript" src="js/lightbox.js"></script>
    <!--Fim-->

    <!--<script src="menu.js" type="text/javascript"></script>-->
    <script src="js/pop.js" type="text/javascript"></script>
    <script src="js/select.js" type="text/javascript"></script>
    <!-- ---------------------- Tinymce Editor de textos-------------------------- -->
    <script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>

    <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            theme: "modern",
            plugins: [
                "advlist autolink lists charmap hr",
                "searchreplace wordcount fullscreen",
                "save table contextmenu directionality paste textcolor"
            ],
            toolbar1: "undo redo | bold italic underline strikethrough superscript subscript | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
            toolbar2: "forecolor backcolor | fontselect fontsizeselect",
            image_advtab: true,
            templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
            ]
        });
    </script>
</head>

<body onload="horizontal();">
<div id="fundo">

    <div id="topo">
        <?php include 'topo.php';?>
    </div>
    <!--
    <div id="menu_principal">
      <?php


    if ((!$_SESSION[logado_simposio_2021]) && (!$_SESSION[logado1]) && (!$_SESSION[logado2]) && (!$_SESSION[logado3]) && (!$_SESSION[logado4]))
        include_once 'menu_principal.php';
    ?>
    </div>-->

    <div id="menu_vertical2">
        <?php include 'menu_vertical2.php'; ?>
        
    </div>

    <div id="conteudo2">
        <?php include 'conteudo2_div.php'; ?>


    </div>
    

    

    <?php include 'rodape.php'; ?>


</div>
</body>
</html>
