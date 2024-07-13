<?php
session_start();

if (!in_array("1", $_SESSION[codigo_grupo]))
{
    echo "<br><br><br><br><br><br><br>";
    echo "<font size='30' color='red'> <center>Somente administradores logados podem acessar esse conteúdo</center></font>";
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    return;

}
include_once('includes/config.php');


$geradorExcel = "";
$itens_inscricao = '';
$codSubEvento = filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_NUMBER_INT);
$relacaoInscritosSubEventos = mysql_query("SELECT p.nome, p.email, ii.cpf, se.nome_sub_evento, ii.codigo_sub_evento, ii.presenca  FROM itens_inscricao ii, participantes p, sub_eventos se WHERE p.cpf = ii.cpf AND ii.codigo_sub_evento = se.codigo_sub_evento and ii.codigo_sub_evento = $codSubEvento");
$nomeArquivo = mysql_query("SELECT se.nome_sub_evento FROM itens_inscricao ii, participantes p, sub_eventos se WHERE p.cpf = ii.cpf AND ii.codigo_sub_evento = se.codigo_sub_evento and ii.codigo_sub_evento = '$codSubEvento' LIMIT 1");
$nomeArquivo = mysql_fetch_row($nomeArquivo);
$nomeArquivo = $nomeArquivo[0];

if(mysql_num_rows($relacaoInscritosSubEventos)==0)
{
    echo "Não há cadastrados nesse evento";
}
else
{
    echo "<h2>Total de inscritos nesse evento: " . mysql_num_rows($relacaoInscritosSubEventos) . "</h2>";
    echo "<br>";

    //Cabeçalho tabela
    echo "
        <style type='text/css'>
            .tg  {border-collapse:collapse;border-color:#bbb;border-spacing:0;}
            .tg td{background-color:#E0FFEB;border-color:#bbb;border-style:solid;border-width:1px;color:#594F4F; font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;word-break:normal;}
            .tg th{background-color:#9DE0AD;border-color:#bbb;border-style:solid;border-width:1px;color:#493F3F; font-family:Arial, sans-serif;font-size:14px;font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
            .tg .tg-0lax{text-align:center; vertical-align:top}
        </style>
        <table class='tg'>
            <thead>
                <tr>
                    <th class='tg-0lax'>Nome</th>
                    <th class='tg-0lax'>CPF</th>
                    <th class='tg-0lax'>Email</th>
                    <th class='tg-0lax'>Subevento</th>
                    <th class='tg-0lax'>Código Subevento</th>
                    <th class='tg-0lax'>Presença</th>
                </tr>
            </thead>
        ";

    //Mostra os dados
    while($itens_inscricao = mysql_fetch_array($relacaoInscritosSubEventos))
    {
        echo "   <tbody>       
                  <tr>
                    <td class=\"tg-0lax\"> $itens_inscricao[nome] </td>
                    <td class=\"tg-0lax\"> $itens_inscricao[cpf] </td>
                    <td class=\"tg - 0lax\"> $itens_inscricao[email] </td>
                    <td class=\"tg-0lax\"> $itens_inscricao[nome_sub_evento] </td>
                    <td class=\"tg-0lax\"> $itens_inscricao[codigo_sub_evento] </td>
                    <td class=\"tg-0lax\"> $itens_inscricao[presenca] </td>
                  </tr>
                </tbody>
           ";
    }
    //Finaliza a tabela
    echo "</table>";
}
?>

        <style type='text/css'>
            .botaoGerarDocumento
            {
                box-shadow:inset 0px 1px 0px 0px #16732b;
                background:linear-gradient(to bottom, #16732b 95%, #9DE0AD 100%);
                background-color:#9DE0AD;
                border:1px solid #314179;
                display:inline-block;
                cursor:pointer;
                color:#ffffff;
                font-family:Arial;
                font-size:13px;
                font-weight:bold;
                padding:6px 12px;
                text-decoration:none;
            }
            .botaoGerarDocumento:hover {
                background:linear-gradient(to bottom, #1d632d 5%, #16732b 100%);
                background-color:#16732b;
            }
            .botaoGerarDocumento:active {
                position:relative;
                top:1px;
            }



        </style>

<table>
    <tr>
        <td>
            <!--Chama a página que gera a planilha XLS-->
            <form action="gerar_documento_participantes_sub_evento.php" method="post">
                <?php echo "<input type='hidden' value='$codSubEvento' name='codigoSubEvento'>"; ?>
                <?php echo "<input type='hidden' value='xls' name='tipoArquivo'>"; ?>
                <br>
                <input class="botaoGerarDocumento" type="submit" value="Gerar XLS (Excel)">
            </form>
        </td>

        <td>
            <!--Chama a página que gera a planilha ODS-->
            <form action="gerar_documento_participantes_sub_evento.php" method="post">
                <?php echo "<input type='hidden' value='$codSubEvento' name='codigoSubEvento'>"; ?>
                <?php echo "<input type='hidden' value='ods' name='tipoArquivo'>"; ?>
                <br>
                <input  class="botaoGerarDocumento" type="submit" value="Gerar ODS (BR Office)">
            </form>
        </td>

        <td>
            <!--Chama a página que gera a planilha PDF-->
            <form action="gerar_documento_participantes_sub_evento.php" method="post">
                <?php echo "<input type='hidden' value='$codSubEvento' name='codigoSubEvento'>"; ?>
                <?php echo "<input type='hidden' value='pdf' name='tipoArquivo'>"; ?>
                <br>
                <input class="botaoGerarDocumento" type="submit" value="Gerar PDF">
            </form>
        </td>
    </tr>
</table>

<?php
mysql_close();
?>