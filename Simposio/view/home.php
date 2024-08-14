<!DOCTYPE html>
<html>
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
        <?php include 'menu.php'; ?>
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
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
</body>

</html>