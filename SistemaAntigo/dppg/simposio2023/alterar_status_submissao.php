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
include_once ('trataInjection.php');

if(protectorString(filter_input(INPUT_GET, 'id',FILTER_SANITIZE_SPECIAL_CHARS)))
    return;

$idTrabalho = filter_input(INPUT_GET, 'id',FILTER_SANITIZE_SPECIAL_CHARS);
$sqlTrabalho = "select * from trabalhos where codigo_trab = '$idTrabalho'";
$trabalho = mysql_fetch_array(mysql_query($sqlTrabalho));

?>
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
<center><h2 style='margin-top: 40px'>Escolha a situação de submissão, e em seguida, clique no botão confirmar</h2></center>
<br><br>
<form action="alterar_status_submissao_final.php" method="post">
    <table class="tg">
        <thead>
        <tr>

            <th class="tg-0lax1">Código</th>
            <th class="tg-0lax1">Título</th>
            <th class="tg-0lax1">Situação</th>
        </tr>
        </thead>
        <thead>
        <tr>

            <th class="tg-0lax1"><?php echo $trabalho[codigo_trab]?></th>
            <th class="tg-0lax"><?php echo $trabalho[titulo]?></th>
            <th class="tg-0lax">
                    <select name="statusTrabalho" style="align-items: center">
                    <?php
                    if($trabalho[aprovado] == 0)
                    {
                        echo "
                            <option value='0' name='statusTrabalho'><font style='color:red' selected>Reprovado</font></option>
                            <option value='1' name='statusTrabalho'>Aprovado</option>
                            <option value='2' name='statusTrabalho'>Em análise</option>";
                    }
                    elseif ($trabalho[aprovado] == 1)
                    {
                        echo "
                            <option value='1' name='statusTrabalho'><b style='color:green'>Aprovado</b></option>
                            <option value='0' name='statusTrabalho'>Reprovado</option>
                            <option value='2' name='statusTrabalho'>Em análise</option>";
                    }
                    elseif ($trabalho[aprovado] == 2)
                    {
                        echo "
                            <option value='2' name='statusTrabalho'><b style='color:#1874CD'>Em análise</b></option>
                            <option value='0' name='statusTrabalho'>Reprovado</option>
                            <option value='1' name='statusTrabalho'>Aprovado</option>";
                    }
                    else
                        {echo "Erro ao buscar código de trabalho";} ?>
            </th>
        </tr>
        </thead>
    <input type="hidden" id="custId" name="idTrabalho" value="<?php echo $idTrabalho?>">
    </table>
    <br><br>
    <center><input style=" font-size: 13px; color:black; border: 1px solid black" type="submit" value="Confirmar"></center>
    </form>
    </body>
    </html>
