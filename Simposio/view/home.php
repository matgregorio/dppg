<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./assets/css/style_home.css">
</head>

<body>
    <div class="container">
        <nav class="sidebar">
        <?php include 'menu.php'; ?>
        </nav>
        <div class="content" id="content">
            <?php include 'home_page.php' ?>
        </div>
    </div>
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