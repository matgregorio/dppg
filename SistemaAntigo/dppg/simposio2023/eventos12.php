<?php

/*include('includes/config.php');

$sql = "select eventos.nome_evento, sub_eventos.palestrante, sub_eventos.nome_sub_evento,
        sub_eventos.data, sub_eventos.vagas, sub_eventos.horario, sub_eventos.codigo_sub_evento,
        sub_eventos.local, sub_eventos.titulo, sub_eventos.dados_palestrante,
        sub_eventos.lattes_participante
          from eventos join sub_eventos on eventos.codigo_evento = sub_eventos.codigo_evento
          where eventos.codigo_evento = $_GET[codigo] order by data, horario";

//faltou o atributo local e título tabela sub eventos

$resultado = mysql_query($sql);

if ($_GET[codigo]== 2)
    echo '<img src="images/nittec.png" width="150" height="72" border="0" alt="" align="right"><br><br><br>';

$controle = 0;

echo '<center>';

$cor = "#95e197";

while ($campos = mysql_fetch_array($resultado))
{
    /*if ($controle == 0)
        echo '<br><br><center><b>Programação do '.$campos[nome_evento].'</b></center><br>

        <table align="center" cellpadding="0" cellspacing="2">
        <tr bgcolor=#61C02D>
            <td ><font color="FFFFFF"><center><b><i>Programação</i></b></center></font></td>
            <td><font color="FFFFFF"><center><b><i>Título</i></b></center></font></td>
            <td><font color="FFFFFF"><center><b><i>Palestrante</i></b></center></font></td>
            <td><font color="FFFFFF"><center><b><i>Local</i></b></center></font></td>
            <td><font color="FFFFFF"><center><b><i>Data</i></b></center></font></td>
            <td><font color="FFFFFF"><center><b><i>Hora</i></b></center></font></td>
        </tr>';

    $controle = 1;
    echo '<tr bgcolor="'.$cor.'">
        <td>'.$campos[nome_sub_evento].'</td>
        <td>';
        echo "<a  class=\"link\" href=\"javascript:void(0)\" onClick=\"MM_openBrWindow('resumo_palestra.php?codigo=".$campos[codigo_sub_evento]."','',
        'scrollbars=no, width=500, height=270, left=0, top=0')\">&nbsp;&nbsp;".$campos[titulo]."</a>&nbsp;&nbsp;</td>";
        echo'<td><a class="link" href="'.$campos[lattes_participante].'" target="_blank" class="evento">&nbsp;&nbsp;<img src="images/logo_lattes.png" border="0">&nbsp;&nbsp;'.$campos[palestrante].'&nbsp;&nbsp;</a></td>
        <td>&nbsp;&nbsp;'.$campos[local].'&nbsp;&nbsp;</td>
        <td>'.date("d/m/Y", strtotime($campos[data])).'</td>
        <td>'.$campos[horario].'</td></tr>';

        if ($cor == "#78e07b")
          $cor = "#95e197";
       else
          $cor = "#78e07b";*/
/*} */
//echo 'fdfghjsfdjshghsdjghdghdgkdgdlkgjdlgjdslgjlgjsljgsljglskjflkjgkjgkdjgksjgkfsjslfjgdlkjgdskgjsldgjslgjsdgslgjjsl';
//echo '<br>';

//include('principal2.php');
//	mysql_close($conexao);

echo '<br>fdfghjsfdjshghsdjghdghdgkdgdlkgjdlgjdslgjlgjsljgsljglskjflkjgkjgkdjgksjgkfsjslfjgdlkjgdskgjsldgjslgjsdgsl</p>
	';

?>
