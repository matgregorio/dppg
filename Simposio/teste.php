<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Div com PHP</title>
    <style>
        #content {
            width: 300px;
            height: 100px;
            border: 1px solid #000;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <button onclick="updateDiv()">Clique para atualizar</button>
    <div id="content">Conteúdo inicial da div</div>

    <script>
        function updateDiv() {
            fetch('update.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('content').innerHTML = data;
                })
                .catch(error => {
                    console.error('Erro ao atualizar a div:', error);
                });
        }
    </script>
</body>
</html>

