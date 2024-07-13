<?php

include('includes/config.php');

$sa = mysql_real_escape_string($_GET[sa]);
$area = mysql_real_escape_string($_GET[a]);

//$query_participante = mysql_query("SELECT t.codigo_trab, t.titulo FROM trabalhos t WHERE t.codigo_sa='$sa' AND t.tipo_projeto = '$area' AND aprovado='1' ORDER BY t.titulo");
$query_tt = mysql_query("SELECT t.codigo_trab, t.titulo, t.autor1, t.palavra_chave, t.codigo_sa FROM trabalhos t WHERE t.codigo_sa=$sa AND t.tipo_projeto = '$area' ORDER BY t.codigo_trab, t.titulo");
//echo "SELECT t.codigo_trab, t.titulo, t.autor1, t.palavra_chave, t.codigo_sa FROM trabalhos t WHERE t.codigo_sa=$sa AND t.tipo_projeto = '$area' ORDER BY t.codigo_trab, t.titulo";

if (mysql_num_rows($query_tt) > 0) {
    $controle = 0;
    echo '<center>';
    $cor = "#95e197";
    while ($campos_tt = mysql_fetch_array($query_tt)) {
        $query_pa = mysql_query("SELECT nome FROM participantes WHERE cpf=$campos_tt[autor1]");
        $campos_pa = mysql_fetch_array($query_pa);
        if ($controle == 0) {
            echo "<br><br><b>Total de Trabalhos: " . mysql_num_rows($query_tt) . "</b><br>";
            echo '<br>';
            echo '<br>';
            echo "<a href='todos_pdf.php?sa=$campos_tt[codigo_sa]&a=$area&s=0' target='_blanck'><img src='images/pdf.png'> Gerar PDF</a>";
            echo '<br>';
            echo '<br>';
            echo '<table>';
            echo '<tr bgcolor=#61C02D>';
            echo '<td ><font color="FFFFFF"><center><b><i>Código</i></b></center></font></td>';
            echo '<td><font color="FFFFFF"><center><b><i>EIXO</i></b></center></font></td>';
            echo '<td width="300px"><font color="FFFFFF"><center><b><i>Título</i></b></center></font></td>';
            echo '<td><font color="FFFFFF"><center><b><i>Autor 1</i></b></center></font></td>';
            echo '</tr>';
        }
        $controle = 1;
        if ($area == "Pes"){
            $tipo = "Pesquisa";
        }elseif ($area == "Ext"){
            $tipo = "Extensão";
        }elseif ($area == "Edu"){
            $tipo = "Ensino";
        }
        echo "<tr bgcolor='$cor'>";
        echo "<td align='center'>$campos_tt[codigo_trab]</td>";
        echo "<td align='center'>$tipo</td>";
        echo "<td width='10'>$campos_tt[titulo]</td>";
        echo "<td> $campos_pa[nome] </td>";
        echo "</tr>";
        if ($cor == "#78e07b") {
            $cor = "#95e197";
        } else {
            $cor = "#78e07b";
        }
    }
    echo '</table></center><br>';
} else {
    echo "<br><br><center><b>Não há de Trabalhos nessa Sub Área!<br>";
}

mysql_close($conexao);
?>
