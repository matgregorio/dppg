<?php
session_start();
//if (in_array("1", $_SESSION[codigo_grupo])) {
header('Content-Type: text/html; charset=utf-8');
?>
    <html>
    <head>
        <title> Verificar Certificados </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
<?php
include './includes/config.php';
if ($_POST[s] == 's') {
    $codigo = mysql_real_escape_string($_POST[codigo]);
    $sql = "SELECT * FROM `valida_certificado` WHERE codigo='$codigo'";
    $result = mysql_query($sql);
    $campos = mysql_fetch_array($result);
//        echo "<div id='conteudo3'><center>";
    echo "<h1>Validação de certificados</h1>";
    if (mysql_num_rows($result) > 0) {
        echo "<p><b>Código de Validação:</b> " . str_pad($campos[codigo], 11, "0", STR_PAD_LEFT) . "</p>";
        $nome = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf=$campos[cpf]"));
        echo "<p><b>Certificado liberado para:</b> " . strtr(strtoupper($nome[nome]), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß") . "</p>";
        if ($campos[tipo] == "submissao") {
            $trab = mysql_fetch_array(mysql_query("SELECT titulo FROM trabalhos WHERE codigo_trab=$campos[codigo_trab]"));
            echo "<p><b>Certificado de Submissão do trabalho:</b> " . strtr(strtoupper($trab[titulo]), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß") . "</p>";
        } else if ($campos[tipo] == "avaliador") {
            echo "<p><b>Certificado de Avaliação</b></p>";
        } else if ($campos[tipo] == "simposio") {
            echo "<p><b>Certificado de Participação do Simpósio</b></p>";
        }
    } else {
        echo "<h2><font color='#aa0000'>Código de Validação não encontrado</font></h2>";
    }
    echo '</br></br><a href="simposio.php?arquivo2=form_validar_certificado.php"><font size="4">Voltar</font></a></br></br></br>';
    echo "</center>";
//        echo"</div>";
} else {
    ?>
    <body>
    <center>
        <!--<div id='conteudo3'>-->
        <div id="scroll">
            <p style="text-align: center"><b>Verificar Certificados</b></p>
            <br>

            <form name="form_validar_certificado" method="post"
                  action="simposio.php?arquivo2=form_validar_certificado.php">
                <center>
                    Digite o código de validação:
                    <input type="text" maxlength="11" name="codigo">
                    <input type="submit" value="Verificar">
                    <input type="hidden" name='s' value="s">
                </center>
            </form>
            <br/>
            <br/>
        </div>
        <!--</div>-->
    </center>
    </body>
    </html>
<?php
//  }
    mysql_close($conexao);
}
?>