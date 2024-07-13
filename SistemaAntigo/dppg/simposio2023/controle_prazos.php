<?php

/*
 * Esse arquivo, irá verificar quanto tempo o trabalho foi submetido
 * o prazo de avaliação que cada arquivo possui seguindo a data estipula pela DPPG, o arquivo controlarar também
 * o prazo de avaliação dos avaliadores externos
 * 1º Ele irá buscar a data de prazo que foi cadastrado pelo dppg
 * 2º Ele irá buscar a data de envio de cada trabalho em avaliação (aprovado=2) e o valor de dias_restantes.
 * 3º Irá verificar quantos dias se passaram e subtrairá dos dias_restantes.
 * 4º Se o valor for igual ou inferior a zero, o trabalho será reprovado (aprovado=0) e o dias_restantes, atualizado.
 * 5º Se o valor for superior a zero, o campo dias_restantes será atualizado
 */
include 'includes/config.php';


//verificação do prazo que o orientador possui
$prazo = mysql_fetch_array(mysql_query("SELECT caminho_formulario FROM formularios WHERE nome_formulario='prazo'"));
$queryTrabalho = mysql_query("SELECT codigo_trab, data_envio, dias_restantes FROM trabalhos WHERE aprovado='2' ORDER BY codigo_trab");
$data_atual = date("Y-m-d");

while ($trabalho = mysql_fetch_array($queryTrabalho)) {
// Define os valores a serem usados
    $data_inicial = $prazo[caminho_formulario];
    $data_final = $data_atual;
// Usa a função strtotime() e pega o timestamp das duas datas:
    $time_inicial = strtotime($data_inicial);
    $time_final = strtotime($data_final);
// Calcula a diferença de segundos entre as duas datas:
    $diferenca = $time_inicial - $time_final; // 19522800 segundos
// Calcula a diferença de dias
    $resultado = (int)floor($diferenca / (60 * 60 * 24)); // 225 dias

    $dias = $resultado + 1;
//echo $dias;
    if ($dias <= 0) {
        mysql_query("UPDATE trabalhos SET dias_restantes='$dias', aprovado='0', situacao='Reprovado' WHERE codigo_trab='$trabalho[codigo_trab]'");
    } else if ($dias > 0) {
        mysql_query("UPDATE trabalhos SET dias_restantes='$dias' WHERE codigo_trab='$trabalho[codigo_trab]'");
    }
}
//echo "------";
//verificação do prazo que o avaliador possui
$prazo1 = mysql_fetch_array(mysql_query("SELECT caminho_formulario FROM formularios WHERE nome_formulario='prazoexterno'"));
$queryTrabalho1 = mysql_query("SELECT codigo_trab, cpf, data, dias FROM avaliador_trab WHERE avaliado='0' ORDER BY codigo_trab");
$data_atual1 = date("Y-m-d");
while ($trabalho1 = mysql_fetch_array($queryTrabalho1)) {
// Define os valores a serem usados
    $data_inicial1 = $prazo1[caminho_formulario];
    $data_final1 = $data_atual1;
// Usa a função strtotime() e pega o timestamp das duas datas:
    $time_inicial1 = strtotime($data_inicial1);
    $time_final1 = strtotime($data_final1);
// Calcula a diferença de segundos entre as duas datas:
    $diferenca1 = $time_inicial1 - $time_final1; // 19522800 segundos
// Calcula a diferença de dias
    $resultado1 = (int)floor($diferenca1 / (60 * 60 * 24)); // 225 dias

    $dias1 = $resultado1 + 1;
//echo "$dias1 - ddajkfhakka";
    if ($dias1 <= 0) {
        mysql_query("DELETE FROM avaliador_trab WHERE cpf='$trabalho1[cpf]' AND codigo_trab='$trabalho1[codigo_trab]'");
    } else if ($dias1 > 0) {
        mysql_query("UPDATE avaliador_trab SET dias='$dias1' WHERE codigo_trab='$trabalho1[codigo_trab]' AND cpf='$trabalho1[cpf]'");
    }
}
//mysql_close($conexao);
?>
