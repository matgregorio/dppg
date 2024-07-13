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

$sqlTrabalhos = "SELECT codigo_trab, titulo, aprovado FROM trabalhos ORDER BY codigo_trab";
$tabelaTrabalhos = mysql_query($sqlTrabalhos);

if(mysql_num_rows($tabelaTrabalhos) > 0)
{ ?>
<html>
<head>
    <link rel="icon" href="../images/icon.ico">
    <link rel='stylesheet' type='text/css' href='css/style.css'>
    <script type="text/javascript" src="js/trabalhos.js"></script>
    <style type="text/css">
        .tg  {border-collapse:collapse;border-color:#bbb;border-spacing:0; width:1000px; alignment: center; margin-left: 12%;}
        .tg td{background-color:#E0FFEB;border-color:#bbb;border-style:solid;border-width:1px;color:#594F4F;
            font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg th{background-color:#9DE0AD;border-color:#bbb;border-style:solid;border-width:1px;color:#493F3F;
            font-family:Arial, sans-serif;font-size:14px;font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg .tg-0lax{text-align:left;vertical-align:top;}
        .tg .tg-0lax1{text-align:center;vertical-align:top; font-weight: bold;}
    </style>
</head>
<body>
<center><h2 style='margin-top: 40px'>Escolha o trabalho para alterar o status de submissão</h2></center>
<form action="#" method="post">
    <table class="tg">
        <thead>
        <tr>
            <th class="tg-0lax1"></th>
            <th class="tg-0lax1">Código</th>
            <th class="tg-0lax1">Título</th>
            <th class="tg-0lax1">Situação</th>
        </tr>
        </thead>
        <?php
        while($trabalho = mysql_fetch_array($tabelaTrabalhos))
        { ?>
            <thead>
            <tr>
                <th class="tg-0lax"><input type="radio" name="idTrabaho" value="<?php echo $trabalho[codigo_trab]?>" onclick="alterar_status_submissao(this.value);"></th>
                <th class="tg-0lax1"><?php echo $trabalho[codigo_trab]?></th>
                <th class="tg-0lax"><?php echo $trabalho[titulo]?></th>
                <th class="tg-0lax">
                    <?php if($trabalho[aprovado] == 0){echo "<b style='color:red'>Reprovado";}
                    elseif($trabalho[aprovado] == 1){echo "<b style='color:green'> Aprovado";}
                    elseif($trabalho[aprovado] == 2){echo "<b style='color:#1874CD'> Em análise";}
                    else {echo "Erro ao buscar código de trabalho";}
                    ?>
                </th>
            </tr>
            </thead>
        <?php }
        echo "
        </table>
        </form>
        </body>";
        }
        else
        {
            echo "<br><br><br><br><br><br><br>";
            echo "<font size='18' color='black'> <center>Não há trabalho cadastrado</center></font>";
            echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
            return;
        }?>
