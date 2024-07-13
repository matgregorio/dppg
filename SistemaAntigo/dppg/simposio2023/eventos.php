<?php

if (protectorString($_GET[codigo]) === false)
{

    include('includes/config.php');

    //$sql = "select eventos.nome_evento, sub_eventos.palestrante, sub_eventos.nome_sub_evento,
    //	        sub_eventos.data, sub_eventos.vagas, sub_eventos.horario, sub_eventos.codigo_sub_evento,
    //	        sub_eventos.local, sub_eventos.titulo, sub_eventos.dados_palestrante,
    //	        sub_eventos.lattes_participante
    //			  from eventos join sub_eventos on eventos.codigo_evento = sub_eventos.codigo_evento
    //			  where eventos.codigo_evento = $_GET[codigo] order by data, horario";

    //faltou o atributo local e título tabela sub eventos


        /*Os eventos eram divulgados por meio deste código, que buscava no banco os dados e os exibia na tela.
          Em 2018, por pedido da DPPG, os eventos passaram a serem divulgados por meio de pdf*/

    http://www.agricultura.gov.br/assuntos/riscos-seguro/imagens/em_construao.png/image_view_fullscreen
//    $resultado = mysql_query($sql);

    /*Descomentar para voltar o evento*/
//    echo '<div style="margin-left:0px; margin-top:80px;">
//    <embed src="documentos/programacao2019_3.pdf#zoom=75" width="800" height="800" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html" padding:"0px;>
//      <!-- <img src="/simposio2021/images/emConstrucao.png" width="600" height="400" border="1" alt="" margin-left:"300px;"><br><br><br>-->
//    </div>';


    /*Descomentar para voltar o evento*/
//    echo '<div style="margin-left:0px; margin-top:80px;">
//    <embed src="documentos/programacaoMinicurso2019.pdf#zoom=100" width="800" height="800" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html" padding:"0px;>
//      <!-- <img src="/simposio2021/images/emConstrucao.png" width="600" height="400" border="1" alt="" margin-left:"300px;"><br><br><br>-->
//    </div>';

//    if ($_GET[codigo] == 2)
//        echo '<img src="images/nittec.png" width="150" height="72" border="0" alt="" align="right"><br><br><br>';

    $sqlProgramacao = "SELECT * FROM arquivo WHERE codigo_arquivo = 9";
    $queryProgramacao = mysql_query($sqlProgramacao) or die("Não foi possível exibir a progamação");
    $programacao = mysql_fetch_array($queryProgramacao);
    ?>

    <div id="posterProgramacao" >
        <embed src="documentos/<?php echo "$programacao[caminho_arquivo]";?>#zoom=FitH" width="800" height="1500" alt="<?php echo "$programacao[nome_arquivo]";?>">
    </div>

<?php
    //$controle = 0;
    //
    //echo '<center>';
    //
    //$cor = "#95e197";
    //
    //while ($campos = mysql_fetch_array($resultado)) {
    //    if ($controle == 0)
    //        echo '<br><br><center><b>Programação do ' . $campos[nome_evento] . '</b></center><br>
    //
    //			<table align="center" cellpadding="0" cellspacing="2">
    //			<tr bgcolor=#61C02D>
    //				<td ><font color="FFFFFF"><center><b><i>Programação</i></b></center></font></td>
    //				<td><font color="FFFFFF"><center><b><i>Título</i></b></center></font></td>
    //				<td><font color="FFFFFF"><center><b><i>Palestrante</i></b></center></font></td>
    //				<td><font color="FFFFFF"><center><b><i>Local</i></b></center></font></td>
    //				<td><font color="FFFFFF"><center><b><i>Data</i></b></center></font></td>
    //				<td><font color="FFFFFF"><center><b><i>Hora</i></b></center></font></td>
    //			</tr>';
    //
    //    $controle = 1;
    //    echo '<tr bgcolor="' . $cor . '">
    //			<td>' . $campos[nome_sub_evento] . '</td>
    //			<td>';
    //    echo "<a  class=\"link\" href=\"javascript:void(0)\" onClick=\"MM_openBrWindow('resumo_palestra.php?codigo=" . $campos[codigo_sub_evento] . "','',
    //			'scrollbars=no, width=500, height=270, left=0, top=0')\">&nbsp;&nbsp;" . $campos[titulo] . "</a>&nbsp;&nbsp;</td>";
    //    echo '<td><a class="link" href="' . $campos[lattes_participante] . '" target="_blank" class="evento">&nbsp;&nbsp;<img src="images/logo_lattes.png" border="0">&nbsp;&nbsp;' . $campos[palestrante] . '&nbsp;&nbsp;</a></td>
    //			<td>&nbsp;&nbsp;' . $campos[local] . '&nbsp;&nbsp;</td>
    //			<td>' . date("d/m/Y", strtotime($campos[data])) . '</td>
    //			<td>' . $campos[horario] . '</td></tr>';
    //
    //    if ($cor == "#78e07b")
    //        $cor = "#95e197";
    //    else
    //        $cor = "#78e07b";
    //}

    echo '</table><br>';
    mysql_close($conexao);

}
else
{
	echo "Erro de parâmetro!";
}

?>
