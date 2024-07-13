<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    include('includes/config.php');
    include('acentuacao.php');

    $codigo_acervo = mysql_real_escape_string($_GET[c]);

    $sql = "SELECT * FROM acervo WHERE codigo_acervo='$codigo_acervo' ORDER BY titulo";
    $resultado = mysql_query($sql);
    $campos_acervo = mysql_fetch_array($resultado);

    ?>
    <html>
    <head>
        <title> Alterar Artigo Acervo </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/valida_alterar_acervo.js"></script>
    </head>
<body>
<div id="conteudo3"><br>
    <br>
    <center><b>Alterar Acervo<br>

            <form name="form_alterar_acervo" onsubmit="return checkalter(this)" method="post"
                  action="alterar_acervo.php">
                <center>
                    <?php echo "<input type='hidden' name='codigo' value='$codigo_acervo'>";?>
                    <table id="individual" border="0" class="esquerda" style="display: block">
                        <tr>
                            <td>Título:</td>
                            <td><?php echo "<input type='text' name='titulo' value='$campos_acervo[titulo]' size='50' maxlength='300'>";?></td>
                        </tr>
                        <tr>
                            <td>Autores:&nbsp;</td>
                            <td><?php echo "<input type='text' name='autores' value='$campos_acervo[autores]' size='50' maxlength='200'>"; ?></td>
                        </tr>
                        <tr>
                            <td>Palavra-Chave:</td>
                            <td><?php echo "<input type='text' name='palavra' value='$campos_acervo[palavra_chave]' size='50' maxlength='100'>";?></td>
                        </tr>
                    </table>
                    <input type="submit" value="OK">
                </center>
            </form>
</div>
<?php
}
?>