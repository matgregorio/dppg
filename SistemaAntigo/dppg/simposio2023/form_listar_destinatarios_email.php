<?php
session_start();
if (!in_array("1", $_SESSION[codigo_grupo]))
{
    echo "<br><br><br><br><br><br><br>";
    echo "<font size='30' color='red'> <center>Somente administradores logados podem acessar esse conteúdo</center></font>";
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    return;
}

include_once ('includes/config.php');

$tabelaSubEventos = mysql_query("SELECT * FROM `sub_eventos`");
?>

<html>
<head>
    <script type="text/javascript" src="js/emails.js"></script>
    <link rel='stylesheet' type='text/css' href='css/style.css'>
    <link rel="icon" href="../images/icon.ico">
</head>
<body>
<center>
    <br><br>
    <h2><b style="text-align: center;">Selecione o tipo de destinatário</b></h2>
    <br>
    <table>
        <tr>
            <td>
                <select id="selectDestinatariosEmail" name="destinatariosEmail" onchange="carregar_tipo_destinatario(this.value)">
                    <option value="null" id="option_null">Selecione a quem se destina o email</option>
                    <option value="aluno_participante">Aluno/Participante</option>
                    <option value="avaliador_externo_cadastro">Avaliador Externo (Mensagem de cadastro)</option>
                    <option value="avaliador_externo_trabalho_vinculado">Avaliador Externo (Trabalho vinculado)</option>
                    <option value="orientador">Orientador</option>
                </select>
            </td>
        </tr>
    </table>
    <br><hr><br>
</center>
<center>
    <div id="lista_subeventos">
    </div>
</center>
<script type="text/javascript">
    document.getElementById('selectDestinatariosEmail').focus();
</script>
</body>
</html>
<body>
<?php

?>
