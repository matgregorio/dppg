<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <center><b>Cadastro Acervo</b></center><br>
    <center>
        <table border="0" class="esquerda">
            <tr>
                <td>Título:</td>
                <td><input type="text" name="titulo_old" size="50" maxlength="300"></td>
            </tr>
            <tr>
                <td>Autores:&nbsp;</td>
                <td><input type="text" name="autores" size="50" maxlength="200"></td>
            </tr>
            <tr>
                <td>Arquivo:</td>
                <td><input name="arq" type="file"></td>
            </tr>
            <tr>
                <td>Palavra-Chave:</td>
                <td><input type="text" name="palavra" size="50" maxlength="100">
                    <input type="hidden" name="envio" value="S"></td>
            </tr>
        </table>
        <input type="submit" value="OK">
    </center>
<?php
}
?>