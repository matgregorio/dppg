<?php
/***
 * Esse arquivo faz o update no banco de dados dos trabalhos aprovados externamente
 * Esse arquivo só é executado após o prazo da avaliação externa terminar
 * Esse arquivo só é executado por no máximo 5 dias após o prazo da avaliação externa terminar (Não há necessidade de executá-lo durante o resto do ano)
 */

include_once ('./includes/config.php');

$dataHoje = date('Y-m-d');
$sqlPrazo = "SELECT caminho_formulario FROM formularios WHERE nome_formulario='prazoExibirNotaExterna'";
$resulPrazo = mysql_query($sqlPrazo);
$campoPrazo = mysql_fetch_array($resulPrazo);

//Esse script é válido por até 5 dias após o prazo da avaliação externa terminar
$dataMaximaScript = date_create($campoPrazo[0]);
date_add($dataMaximaScript, date_interval_create_from_date_string('5 days'));

if($dataHoje > $campoPrazo[0] && $dataHoje < $dataMaximaScript)
{
    $trab = mysql_query("SELECT codigo_trab FROM trabalhos WHERE codigo_trab IN (SELECT codigo_trab FROM avaliador_trab)");

    while ($campoTrab = mysql_fetch_array($trab))
    {
        $sql_avaliador = "SELECT at.nota FROM avaliador_trab at WHERE at.avaliado='1' AND at.codigo_trab=$campoTrab[codigo_trab]";
        $resultado_avaliador = mysql_query($sql_avaliador);
 
        $cont = 0;
        $total = 0;

        while ($campos_avaliador = mysql_fetch_array($resultado_avaliador))
        {
            $total += $campos_avaliador[nota];
            $cont++;
        }

        // Coloca '1' para os trabalhos aprovados externamente
        if (($total / $cont) >= 60)
            mysql_query("UPDATE trabalhos SET aprovado_ext=1 WHERE codigo_trab=$campoTrab[codigo_trab]");
    }
}

mysql_close($conexao);
