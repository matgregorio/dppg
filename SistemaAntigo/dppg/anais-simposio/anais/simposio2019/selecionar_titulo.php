<?php
//Este arquivo monta os campos titulo, autor e palavra chave do sistema de consulta de trabalhos do simposio (anais)


include('/var/www/html/simposio2019/includes/config.php');
include_once ('../../../trataInjection.php');

if(protectorString($_GET[sa]))
    return;

$sa = mysql_real_escape_string($_GET[sa]);

if ($sa != "t")  /*Escolha por departamento. Cada departamento é um número. Ex.: Computação = 9*/
{
    /*Seleciona o os dados do trabalho*/
    $query_tt = mysql_query("SELECT t.codigo_trab, t.titulo, t.palavra_chave FROM trabalhos t, acervo ac WHERE ac.codigo_trab=t.codigo_trab AND t.codigo_sa=$sa AND ac.codigo_ano='13' ORDER BY t.titulo");

    /*Seleciona o primeiro autor de cada trabalho*/
    $query_ap = mysql_query("SELECT DISTINCT p.nome, p.cpf FROM participantes p, trabalhos t, acervo ac WHERE p.cpf=t.autor1 AND t.codigo_trab=ac.codigo_trab AND t.codigo_sa=$sa AND ac.codigo_ano='13' ORDER BY p.nome");
}
else /*t = Departamento: Todos */
{
    /*Seleciona o os dados do trabalho*/
    $query_tt = mysql_query("SELECT t.codigo_trab, t.titulo, t.palavra_chave FROM trabalhos t, acervo ac WHERE ac.codigo_trab=t.codigo_trab AND ac.codigo_ano='13' ORDER BY t.titulo");

    /*Seleciona o primeiro autor de cada trabalho*/
    $query_ap = mysql_query("SELECT DISTINCT p.nome, p.cpf FROM participantes p, trabalhos t, acervo ac WHERE p.cpf=t.autor1 AND t.codigo_trab=ac.codigo_trab AND ac.codigo_ano='13' ORDER BY p.nome");
}

if (mysql_num_rows($query_tt) > 0)
{
    echo "<table border='0'>";
    echo "<tr>";
    echo "<td align='center'>";
    echo "<h6>Título:&nbsp;<br>";
//  echo "</td>";
//  echo "<td>";
    echo "<select name='titulo' style='width: 450px'>";
    echo "<option value=''>Todos</option>";
    while ($campos_tt = mysql_fetch_array($query_tt))
    {
        echo "<option value='$campos_tt[titulo]'>$campos_tt[titulo]</option>";
    }
    echo "</select></h6>";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td align='center'>";
    echo "<h6>Autor1:&nbsp;<br>";
//  echo "</td>";
//  echo "<td>";
    echo "<select name='autor1' style='width: 450px'>";
    echo "<option value=''>Todos</option>";
    while ($campos_ap = mysql_fetch_array($query_ap))
    {
        echo "<option value='$campos_ap[cpf]'>$campos_ap[nome]</option>";
    }
    echo "</select></h6>";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td align='center'>";
    echo "<h6>Palavra Chave:&nbsp;<br>";
//  echo "</td>";
//  echo "<td>";
    echo "<select name='palavrachave' style='width: 450px'>";
    echo "<option value=''>Todos</option>";
    mysql_data_seek($query_tt, 0);
    while ($campos_tt = mysql_fetch_array($query_tt))
    {
        echo "<option value='$campos_tt[codigo_trab]'>$campos_tt[palavra_chave]</option>";
    }
    echo "</select></h6>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    echo "<br>";
    echo "<input type='hidden' name='data' value='anais/simposio2019/acervo_new'>";
    echo "<input type='submit' name='consultar' value='consultar'>";
}
else
{
    echo "<br><br><center><b> Não há Trabalhos nessa Sub área!<br>";
}

mysql_close($conexao);
?>
