<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/style_administrator.css">
    <script src="../vendor/tinymce/tinymce/tinymce.min.js"></script>
</head>

<body>
    <h2>Área administrativa</h2>
    <ul>
        <?php if (!isset($_SESSION['user_type']) || ($_SESSION['user_type'] == 1)) { ?>
            <li><a href="#" onclick="carregarConteudo('approve_teachers.php')">Aprovar Professores</a></li>
            <li><a href="../controller/emailTemplateController.php?action=index" onclick="carregarConteudo('edit_email_templates.php')">Editar email automático</a></li>
            <li><a href="#" onclick="carregarConteudo('edit_presentation.php')">Editar apresentação</a></li>
        <?php } ?>
    </ul>
    <script>
        function carregarConteudo(pagina){
            var xhr = new XMLHttpRequest();
            xhr.open('GET', pagina, true);
            xhr.onreadystatechange = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    document.getElementById('content').innerHTML = xhr.responseText;
                }   
            };
            xhr.send();
        }
    </script>
    <script src="../assets/js/script_home.js"></script>
</body>

</html>