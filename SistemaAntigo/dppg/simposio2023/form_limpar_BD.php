<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Limpar Base De Dados</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <?php
    session_start();

    if ($_SESSION[logado_simposio_2021]) {

    include('includes/config.php');
    ?>
    <div id='conteudo3'>
        <br>
        <center><b>Limpar Base de Dados</b><br><br></center>
        <center>Para Reiniciar a Base de Dados click no Link <b>
                <Reiniciar>:<a href='reiniciar.php'>Reiniciar<br><br></a>
            </b>
            <script>alert("Aviso! Tome cuidado ao Reiniciar a Base de Dados, pois alguns registros de algumas tabelas serão apagados. Caso reinicie a base de dados o login: admin e senha:s1mp0s10 serão criados para ter acesso ao sistema.");</script>
            <br><br><br>
        </center>
        <?php
        }
        mysql_close($conexao);
        ?>
    </body>
    </html>
<?php
}
?>