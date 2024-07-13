<?php

include('includes/config.php');

$sql = "select informacoes from  conteudo where codigo_conteudo='2'";
$resultado = mysql_query($sql);
$campos = mysql_fetch_array($resultado);

echo "<br><br>";
echo $campos[informacoes];
echo "<br><br><hr>";
/*echo "<object	data='documentos/apresentacaoOralPoster.pdf#toolbar=0&amp;navpanes=0&amp;scrollbar=0&amp;page=1&amp;view=FitH'
            type='application/pdf' 
            width='100%' 
            height='950px'>
    </object>";*/


$sqlEdicaoEvento = mysql_query("SELECT informacoes FROM conteudo WHERE codigo_conteudo = '10'");
$edicaoEvento = mysql_fetch_array($sqlEdicaoEvento);

$sqlRegulamento = mysql_query("SELECT * FROM arquivo WHERE codigo_arquivo = '8'");
$regulamento = mysql_fetch_array($sqlRegulamento);

echo"<br><br>";
echo '<center>';

//$sql_arquivo = "select * from formularios f, arquivo a where f.codigo_formulario = a.codigo_formulario and
//		a.codigo_formulario = '4'";
//$resultado_arquivo = mysql_query($sql_arquivo);

echo '<center>';

$cont = 0;
while ($campos1 = mysql_fetch_array($resultado1)) {
  //Programação e modelo de poster->  //echo '<img src=images/' . $campos1[icone] . ' width="20" heigth="20" border="0"><a href=documentos/' . $campos1[caminho_arquivo] . '>&nbsp;' . $campos1[nome_arquivo] . '</a><br><br>';
    if ($cont < 2) {
        //echo '<img src=images/' . $campos1[icone] . ' border="0"><a href=documentos/' . $campos1[caminho_arquivo] . '  target="_blank">&nbsp;' . $campos1[nome_arquivo] . '</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
        $cont++;
    } else {
        //echo '<img src=images/' . $campos1[icone] . ' border="0"><a href=documentos/' . $campos1[caminho_arquivo] . '  target="_blank">&nbsp;' . $campos1[nome_arquivo] . '</a><br><br>';
        $cont = 0;
    }
}
 //echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href=documentos/normas_conf_poster.pdf target="_blank">&nbsp;Normas para Confecção dos Pôsteres</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';

if ($cont == 2) {
    echo "<br><br>";
}


echo '</center>';

mysql_close($conexao);
?>


