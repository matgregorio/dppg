<?php
session_start();

if (!in_array("1", $_SESSION[codigo_grupo])) {
    echo "<br><br><br><br><br><br><br>";
    echo "<font size='30' color='red'> <center> Somente administradores logados podem ver este conteúdo</center></font>";
    exit();
}

include_once 'includes/config.php';

$arrayNotaFinalCodigoTrabalho = array();

//Dados do trabalho e total da soma das notas dada pelos seus avaliadores
$sql = "SELECT sum(at.nota) as total, t.*, s.* FROM avaliador_trab at, sub_area s, trabalhos t WHERE t.codigo_sa=s.codigo_sa AND t.codigo_trab=at.codigo_trab AND at.avaliado='1' GROUP BY t.codigo_trab ORDER BY total DESC";
$resultado = mysql_query($sql);

echo "<br><br><center><b>Listagem dos Trabalhos Avaliados Externamente<br>";
echo 'Total de trabalhos:' . mysql_num_rows($resultado);
echo '<br><br>';

if(mysql_num_rows($resultado) > 0)
{
    while ($camposTrabalho = mysql_fetch_array($resultado))
    {
        //Busca todos os avaliadores que avaliaram o trabalho, incluindo as notas e soma das notas que cada avaliador deu
        $sql_avaliador = "SELECT p.nome, at.item1, at.item2, at.item3, at.item4, at.item5, at.item6, at.nota, at.obs FROM participantes p, avaliador_trab at WHERE p.cpf=at.cpf AND at.codigo_trab='$camposTrabalho[codigo_trab]' AND at.avaliado='1'";
        $resultado_avaliador = mysql_query($sql_avaliador);

        $quantidadeAvaliadores = mysql_num_rows($resultado_avaliador);

        //Soma da nota dada por cada avaliador, dividido pela quantidade de avaliadores
        $mediaNota = $camposTrabalho[total] / $quantidadeAvaliadores;

        $eixo = mysql_fetch_array(mysql_query("select * from grande_area where codigo_ga = '$camposTrabalho[codigo_ga]'"));


        $orientador = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$camposTrabalho[cpf_prof_analisador]'"));
        $autor1 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$camposTrabalho[autor1]'"));

        if (isset($camposTrabalho[autor2]))
            $autor2 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$camposTrabalho[autor2]'"));

        if (isset($camposTrabalho[autor3]))
            $autor3 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$camposTrabalho[autor3]'"));

        if (isset($camposTrabalho[autor4]))
            $autor4 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$camposTrabalho[autor4]'"));

        if (isset($camposTrabalho[autor5]))
            $autor5 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$camposTrabalho[autor5]'"));

        if (isset($camposTrabalho[autor6]))
            $autor6 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$camposTrabalho[autor6]'"));

        if (isset($camposTrabalho[autor7]))
            $autor7 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$camposTrabalho[autor7]'"));

        if ($camposTrabalho[modalidade] == "N")
        {
            if ($camposTrabalho[tipo_iniciacao] == "G") $modalidade = "Pesquisa - Graduação";
            else if ($camposTrabalho[tipo_iniciacao] == "T") $modalidade = "Pesquisa - Técnico";
            else if ($camposTrabalho[tipo_iniciacao] == "L") $modalidade = "Pesquisa - Lato Sensu";
            else if ($camposTrabalho[tipo_iniciacao] == "S") $modalidade = "Pesquisa - Stricto Sensu";
        }
        else if ($camposTrabalho[modalidade] == "S")
        {
            if ($camposTrabalho[tipo_iniciacao] == "G") $modalidade = "Iniciação Científica - Graduação";
            else if ($camposTrabalho[tipo_iniciacao] == "T") $modalidade = "Iniciação Científica - Técnico";
        }
        else if ($camposTrabalho[modalidade] == "0")
        {
            if ($camposTrabalho[tipo_projeto] == "Ext") $modalidade = "Estudos Orientados - Extensão";
            else if ($camposTrabalho[tipo_projeto] == "Edu") $modalidade = "Estudos Orientados - Ensino";
        }

        //Aqui a mágica acontece
        array_push($arrayNotaFinalCodigoTrabalho, array($mediaNota, $camposTrabalho[codigo_trab], $camposTrabalho[titulo], $autor1, $camposTrabalho[nome_sa], $modalidade, $orientador));
    }

    rsort($arrayNotaFinalCodigoTrabalho);

    echo "<table border='1px solid black;' style='text-align: center;'>";
    echo "<tr bgcolor=#61C02D style='border 1px solid black;'>
        <td><font color='FFFFFF'><center><b><i>Nota</i></b></center></font></td>
        <td ><font color='FFFFFF'><center><b><i>Código</i></b></center></font></td>
        <td ><font color='FFFFFF'><center><b><i>Título</i></b></center></font></td>
        <td><font color='FFFFFF'><center><b><i>Autor1</i></b></center></font></td>
        <td><font color='FFFFFF'><center><b><i>Subarea</i></b></center></font></td>
        <td><font color='FFFFFF'><center><b><i>Modalidade</i></b></center></font></td>        
        <td><font color='FFFFFF'><center><b><i>Orientador</i></b></center></font></td>
    </tr>";



    for ($a = 0; $a < count($arrayNotaFinalCodigoTrabalho); $a++)
    {
        if ($cor == "#78E07B") $cor = "#95e197";  else $cor = "#78E07B";

        echo "<tr style='background: $cor; border: 1px solid black;'>";

        for ($b = 0; $b < 7; $b++)
        {
            switch ($b)
            {
                case 0: //Media das notas
                {
                    $c = $arrayNotaFinalCodigoTrabalho[$a][$b];
                    echo "<td> $c </td>";
                    break;

                }
                case 1: //Codigo do trabalho
                {
                    $c = $arrayNotaFinalCodigoTrabalho[$a][$b];
                    echo "<td> $c </td>";
                    break;
                }
                case 2: //Titulo
                {
                    $c = $arrayNotaFinalCodigoTrabalho[$a][$b];
                    echo "<td align='center' style='text-align: left;'>$c</td>";
                    break;
                }
                case 3: //Autor1
                {
                    $c = $arrayNotaFinalCodigoTrabalho[$a][$b][0];
                    echo "<td align='center'>$c</td>";
                    break;
                }
                case 4: //Nome Subarea
                {
                    $c = $arrayNotaFinalCodigoTrabalho[$a][$b];
                    echo "<td align='center'>$c</td>";
                    break;
                }
                case 5: //Eixo - modalidade
                {
                    $c = $arrayNotaFinalCodigoTrabalho[$a][$b];
                    echo "<td align='center'>$c</td>";
                    break;
                }
                case 6: //Orientador
                {
                    $c = $arrayNotaFinalCodigoTrabalho[$a][$b][0];
                    echo "<td align='center'>$c</td>";
                    break;
                }
            }
        }
        echo "</tr>";
    }
    echo "</table>";
}
