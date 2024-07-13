<?php
session_start();

if (!in_array("1", $_SESSION[codigo_grupo]))
{
    echo "<br><br><br><br><br><br><br>";
    echo "<font size='30' color='red'> <center>Somente administradores logados podem acessar esse conteúdo</center></font>";
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    return;
}

include('acentuacao.php');
include_once('includes/config.php');

$tipoDestinatario = filter_input(INPUT_GET, 'tipoDestinatario', FILTER_SANITIZE_SPECIAL_CHARS);
?>
    <html>
        <head>
            <link rel="icon" href="../images/icon.ico">
            <link rel='stylesheet' type='text/css' href='css/style.css'>
            <script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
            <script language="javascript" type="text/javascript" src="js/tinymce.js"></script>
            <script language="javascript" type="text/javascript">
                tinyMCE.init({
                    theme : "advanced",
                    mode: "exact",
                    elements : "elm1",
                    theme_advanced_toolbar_location : "top",
                    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,separator,"
                        + "justifyleft,justifycenter,justifyright,justifyfull,formatselect,"
                        + "bullist,numlist,outdent,indent",
                    theme_advanced_buttons2 : "link,unlink,anchor,image,separator,"
                        +"undo,redo,cleanup,code,separator,sub,sup,charmap",
                    theme_advanced_buttons3 : "",
                    height:"700px",
                    width:"1000px" 
                });

            </script>
        </head>
    <body style=" max-width: 800px; margin: 40px auto auto auto; padding: auto;" >

<?php
switch ($tipoDestinatario)
{
    case "aluno_participante":
    {
        $sqlAlunoParticipante = mysql_query("SELECT * FROM `email` WHERE tipo_destinatario = 'aluno_participante'") or die("<h1>Houve um erro na conexão com o banco de dados.</h1>");
        $dadosEmailAlunoParticipante = mysql_fetch_array($sqlAlunoParticipante);
        $assunto = $dadosEmailAlunoParticipante[assunto];
        $mensagem = $dadosEmailAlunoParticipante[mensagem];
        $remetente = $dadosEmailAlunoParticipante[remetente];

        ?>
        <h2 style="text-align: center;">Alterar conteúdo do email enviado para o <strong style='color:#006400'><u>ALUNO/PARTICIPANTE</u></strong><br><br></h2>
        <form name='form_apresentacao' method='POST' action='alterar_conteudo_email.php'>
            <table border='0' class='esquerda' style="margin: auto;">
                <tr>
                    <td align='left'>
                        <label for="assunto" style="font-size: 16px; "><u>Assunto:</u></label>&nbsp;
                        <input type="text" id="assunto" name="assunto" style="width: 627px;" value="<?php echo $assunto?>" ><br><br>
                    </td>
                </tr>
                <tr>
                    <td><textarea name='mensagem' rows='20' cols='80'><?php echo $mensagem?></textarea><br></td>
                </tr>
                <tr>
                    <td align='left'>
                        <label for="remetente" style="font-size: 16px; "><u>Remetente:</u></label>&nbsp;
                        <input type="text" id="remetente" name="remetente" style="width: 608px;" value="<?php echo $remetente;?>"<br><br>
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                <tr>
                <tr>
                    <td colspan='2' align='center'>
                        <input type='submit' name='salvar' value='Salvar'>
                        <input type='hidden' name='tipo_destinatario' value='aluno_participante'>
                    </td>
                </tr>
            </table>
        </form>
        <?php break;
    }
    case "avaliador_externo_cadastro":
    {
        $sqlAvaliadorExterno = mysql_query("SELECT * FROM `email` WHERE tipo_destinatario = 'avaliador_externo_cadastro'") or die("<h1>Houve um erro na conexão com o banco de dados.</h1>");
        $dadosEmailAvaliadorExterno = mysql_fetch_array($sqlAvaliadorExterno);
        $assunto = $dadosEmailAvaliadorExterno[assunto];
        $mensagem = $dadosEmailAvaliadorExterno[mensagem];
        $remetente = $dadosEmailAvaliadorExterno[remetente];

        ?>
        <h2 style="text-align: center;">Alterar conteúdo do email enviado para o <strong style='color:#006400'><u>AVALIADOR EXTERNO (CADASTRO)</u></strong><br><br></h2>
        <form name='form_apresentacao' method='POST' action='alterar_conteudo_email.php'>
            <table border='0' class='esquerda' style="margin: auto;">
                <tr>
                    <td align='left'>
                        <label for="assunto" style="font-size: 16px; "><u>Assunto:</u></label>&nbsp;
                        <input type="text" id="assunto" name="assunto" style="width: 627px;" value="<?php echo $assunto?>" ><br><br>
                    </td>
                </tr>
                <tr>
                    <td><textarea name='mensagem' rows='20' cols='80'><?php echo $mensagem?></textarea><br></td>
                </tr>
                <tr>
                    <td align='left'>
                        <label for="remetente" style="font-size: 16px; "><u>Remetente:</u></label>&nbsp;
                        <input type="text" id="remetente" name="remetente" style="width: 608px;" value="<?php echo $remetente;?>"<br><br>
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                <tr>
                <tr>
                    <td colspan='2' align='center'>
                        <input type='submit' name='salvar' value='Salvar'>
                        <input type='hidden' name='tipo_destinatario' value='avaliador_externo_cadastro'>
                    </td>
                </tr>
            </table>
        </form>
        <?php break;
    }
    case "avaliador_externo_trabalho_vinculado":
    {
        $sqlAvaliadorExternoTrabalhoVinculado = mysql_query("SELECT * FROM `email` WHERE tipo_destinatario = 'avaliador_externo_trabalho_vinculado'") or die("<h1>Houve um erro na conexão com o banco de dados.</h1>");
        $dadosEmailAvaliadorExternoTrabalhoVinculado = mysql_fetch_array($sqlAvaliadorExternoTrabalhoVinculado);
        $assunto = $dadosEmailAvaliadorExternoTrabalhoVinculado[assunto];
        $mensagem = $dadosEmailAvaliadorExternoTrabalhoVinculado[mensagem];
        $remetente = $dadosEmailAvaliadorExternoTrabalhoVinculado[remetente];

        ?>
        <h2 style="text-align: center;">Alterar conteúdo do email enviado para o <strong style='color:#006400'><u>AVALIADOR EXTERNO (Trabalho vinculado)</u></strong><br><br></h2>
        <form name='form_apresentacao' method='POST' action='alterar_conteudo_email.php'>
            <table border='0' class='esquerda' style="margin: auto;">
                <tr>
                    <td align='left'>
                        <label for="assunto" style="font-size: 16px; "><u>Assunto:</u></label>&nbsp;
                        <input type="text" id="assunto" name="assunto" style="width: 627px;" value="<?php echo $assunto?>" ><br><br>
                    </td>
                </tr>
                <tr>
                    <td><textarea name='mensagem' rows='20' cols='80'><?php echo $mensagem?></textarea><br></td>
                </tr>
                <tr>
                    <td align='left'>
                        <label for="remetente" style="font-size: 16px; "><u>Remetente:</u></label>&nbsp;
                        <input type="text" id="remetente" name="remetente" style="width: 608px;" value="<?php echo $remetente;?>"<br><br>
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                <tr>
                <tr>
                    <td colspan='2' align='center'>
                        <input type='submit' name='salvar' value='Salvar'>
                        <input type='hidden' name='tipo_destinatario' value='avaliador_externo_trabalho_vinculado'>
                    </td>
                </tr>
            </table>
        </form>
        <?php break;
    }
    case "orientador":
    {
        $sqlOrientador = mysql_query("SELECT * FROM `email` WHERE tipo_destinatario = 'orientador'") or die("<h1>Houve um erro na conexão com o banco de dados.</h1>");
        $dadosEmailOrientador = mysql_fetch_array($sqlOrientador);
        $assunto = $dadosEmailOrientador[assunto];
        $mensagem = $dadosEmailOrientador[mensagem];
        $remetente = $dadosEmailOrientador[remetente];

        ?>
        <h2 style="text-align: center;">Alterar conteúdo do email enviado para o <strong style='color:#006400'><u>ORIENTADOR</u></strong><br><br></h2>
        <form name='form_apresentacao' method='POST' action='alterar_conteudo_email.php'>
            <table border='0' class='esquerda' style="margin: auto;">
                <tr>
                    <td align='left'>
                        <label for="assunto" style="font-size: 16px; "><u>Assunto:</u></label>&nbsp;
                        <input type="text" id="assunto" name="assunto" style="width: 627px;" value="<?php echo $assunto?>" ><br><br>
                    </td>
                </tr>
                <tr>
                    <td><textarea name='mensagem' rows='20' cols='80'><?php echo $mensagem?></textarea><br></td>
                </tr>
                <tr>
                    <td align='left'>
                        <label for="remetente" style="font-size: 16px; "><u>Remetente:</u></label>&nbsp;
                        <input type="text" id="remetente" name="remetente" style="width: 608px;" value="<?php echo $remetente;?>"<br><br>
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                <tr>
                <tr>
                    <td colspan='2' align='center'>
                        <input type='submit' name='salvar' value='Salvar'>
                        <input type='hidden' name='tipo_destinatario' value='orientador'>
                    </td>
                </tr>
            </table>
        </form>
        <?php break;
    }
}

?>
    </body>
    </html>