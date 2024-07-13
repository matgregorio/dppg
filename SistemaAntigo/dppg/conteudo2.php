<?php

include_once('includes/config.php');

$sql = "select informacoes from  conteudo where codigo_conteudo='2'";
$resultado = mysql_query($sql);
$campos = mysql_fetch_array($resultado);

echo "<br><br>";
echo $campos[informacoes];
echo "<br><br><hr>";
echo "<object	data='documentos/apresentacaoOralPoster.pdf#toolbar=0&amp;navpanes=0&amp;scrollbar=0&amp;page=1&amp;view=FitH'
            type='application/pdf' 
            width='100%' 
            height='950px'>
    </object>";


$sql1 = "select * from arquivo a, formularios f where a.codigo_formulario = f.codigo_formulario and a.codigo_formulario ='1'";
$resultado1 = mysql_query($sql1);

echo"<br><br>";
echo '<center>';
$sql_arquivo = "select * from formularios f, arquivo a where f.codigo_formulario = a.codigo_formulario and
		a.codigo_formulario = '4'";
$resultado_arquivo = mysql_query($sql_arquivo);



echo '<center>';
while ($campos_arquivo = mysql_fetch_array($resultado_arquivo)) {
    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href=documentos/RegulamentoIXSIMPOSIO.pdf   target="_blank">&nbsp;  REGULAMENTO DO XI SIMPÓSIO</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
    echo '<br> <br>';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href=documentos/retificação_regulamento2019.pdf   target="_blank">&nbsp;  RETIFICAÇÃO DO REGULAMENTO DO XI SIMPÓSIO</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
    echo '<br> <br>';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href=documentos/EditalEFormulárioMinicurso2019.rar   target="_blank">&nbsp; EDITAL E FORMULÁRIO DE INSCRIÇÃO DE PROPOSTAS PARA MINICURSOS </a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
    echo '<br> <br>';
    echo '&nbsp;<a href="documentos/' . $campos_arquivo[caminho_arquivo] . '" target="_blank"><img src="images/' . $campos_arquivo[icone] . '" border="0">&nbsp;' . $campos_arquivo[nome_arquivo] . '</a><br><br>';
}





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


