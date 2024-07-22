<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Simposio</title>
</head>

<body>
    <div class="container" style="max-width: 768px;">
        <div class="left-menu" style="max-width: 215px;">
            <!-- Conteúdo do menu esquerdo -->
            <div class="menu-vertical">
                <h4>SIMPÓSIO</h4>
                <a href="#home" class="active">Home</a>
                <a onclick="atualizarDiv('regulamento.php')">Regulamento</a>
                <a onclick="atualizarDiv('apresentacao.php')">Apresentação</a>
                <a onclick="atualizarDiv('corpoEditorial.php')">Corpo Editorial</a>
                <a onclick="atualizarDiv('expediente.php')">Expediente</a>
                <a onclick="atualizarDiv('normasPublicacao.php')">Normas para Publicação</a>
                <a onclick="atualizarDiv('programacao.php')">Programação</a>
                <a onclick="atualizarDiv('modeloPoster.php')">Modelo de Pôster</a>
                <a href="https://dppg.riopomba.ifsudestemg.edu.br/">DPPG</a>
                <a onclick="atualizarDiv('anais.php')">Anais</a>
                <a onclick="atualizarDiv('validarCertificado.php')">Validar Certificado</a>
                <a onclick="atualizarDiv('')">Cadastro Simpósio</a>
                <h4>ADMINISTRATIVO</h4>
                <a onclick="atualizarDiv('configRegulamento.php')">Configurar Regulamento</a>
                <a onclick="atualizarDiv('configSistema.php')">Configurações do Sistema</a>
            </div>
        </div>

        <div class="center-menu" class="tab-content" id="menuCentral" style="max-width: 576px;">
            <script>
                function atualizarDiv($nomePagina) {
                    fetch($nomePagina)
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('menuCentral').innerHTML = data;
                        })
                        .catch(error => {
                            console.error('Erro ao atualizar a div:', error);
                        });
                }
            </script>
            <!-- Conteúdo do menu central -->
            <h2>Menu Central</h2>
            <p>Este é o conteúdo do menu central.</p>
        </div>
    </div>
</body>

</html>