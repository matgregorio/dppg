<?php
/**Define quais apresentações serão orais, e quais serão pôster*/
session_start();
include_once('includes/config.php');

if(!in_array("1", $_SESSION[codigo_grupo]))
{
    echo "<center><h3>Somente administradores podem acessar o conteúdo</h3></center>";
    return;
}
?>
<script type="text/javascript">

    /*Ao selecionar o checkBox oral, o checkBox de poster é desativado*/
    function limpaCheckBoxPoster(codigoTrabalho)
    {
        const idCheckBoxPoster = 'checkBoxApresentacaoPoster' + codigoTrabalho;
        document.getElementById(idCheckBoxPoster).checked = false; //Desativa checkBox poster

        const checkBoxOral = 'checkBoxApresentacaoOral' + codigoTrabalho;
        document.getElementById(checkBoxOral).checked = true; //Ativa checkBox oral
    }

    /*Ao selecionar o checkBox de Poster, o checkBox oral é desativado*/
    function limpaCheckBoxOral(codigoTrabalho)
    {
        const idCheckBox = 'checkBoxApresentacaoOral' + codigoTrabalho;
        document.getElementById(idCheckBox).checked = false; //Destiva checkBox oral

        const checkBoxPoster = 'checkBoxApresentacaoPoster' + codigoTrabalho;
        document.getElementById(checkBoxPoster).checked = true; //Ativa checkBoxPoster
    }

</script>
    <br>
    <head>
        <title> Defninir apresentações orais/poster </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <center>
        <div id='conteudo3'>
            <div id="scroll">
                <p style="text-align: center"><b>Defina o tipo de apresentação</b></p>
                <br>
                <table border="0" class="esquerda">
                    <?php
                    $query_trabalhos_aprovados = mysql_query("SELECT sum(at.nota) as total, t.*, s.* FROM avaliador_trab at, sub_area s, trabalhos t WHERE t.codigo_sa=s.codigo_sa AND t.codigo_trab=at.codigo_trab AND at.avaliado='1' AND aprovado_ext='1' GROUP BY t.codigo_trab ORDER BY t.codigo_trab ASC");

                    if (mysql_num_rows($query_trabalhos_aprovados) > 0)
                    {
                        echo '<p style="text-align: center"><b>Total de trabalhos: ' . mysql_num_rows($query_trabalhos_aprovados) . '</b></p>';
                        echo "<tr bgcolor=#61C02D>
                        <td><center><b><font color='#FFFFFF'>&nbsp;Código&nbsp;</font></b></center></td>
                            <td><center><b><font color='#FFFFFF'>&nbsp;Título &nbsp;</font></b></center></td>
                            <td><center><b><font color='#FFFFFF'>&nbsp;Oral &nbsp;</font></b></center></td>
                            <td><center><b><font color='#FFFFFF'>&nbsp;Poster &nbsp;</font></b></center></td>                             
                         </tr>";

                        while ($campo_trabalhos = mysql_fetch_array($query_trabalhos_aprovados))
                        {
                            echo '<form name="form_definir_apresentacoes_orais" class="esquerda" method="post" action="processa_definir_tipo_apresentacao.php">';

                            echo "<tr bgcolor='#E0EEEE'>
                                <td style='text-align: center' width='50' align='left'>$campo_trabalhos[codigo_trab]</td>
                                <td width='800' align='left'>$campo_trabalhos[titulo]</td>";

                            if($campo_trabalhos[tipo_apresentacao] == '1') //1 -> apresentação oral
                            {
                                echo "<td align='center'><input type='checkbox' name='checkBoxApresentacaoOral[]'   id='checkBoxApresentacaoOral$campo_trabalhos[codigo_trab]'   value='$campo_trabalhos[codigo_trab]' size='5' onclick = 'limpaCheckBoxPoster($campo_trabalhos[codigo_trab])' checked></td>";
                                echo "<td align='center'><input type='checkbox' name='checkBoxApresentacaoPoster[]' id='checkBoxApresentacaoPoster$campo_trabalhos[codigo_trab]' value='$campo_trabalhos[codigo_trab]' size='5' onclick = 'limpaCheckBoxOral($campo_trabalhos[codigo_trab])' ></td>";
                            }
                            else if($campo_trabalhos[tipo_apresentacao] == '0') //0 -> apresentação poster
                             {
                                 echo "<td align='center'><input type='checkbox' name='checkBoxApresentacaoOral[]'   id='checkBoxApresentacaoOral$campo_trabalhos[codigo_trab]'   value='$campo_trabalhos[codigo_trab]' size='5' onclick = 'limpaCheckBoxPoster($campo_trabalhos[codigo_trab])'></td>";
                                 echo "<td align='center'><input type='checkbox' name='checkBoxApresentacaoPoster[]' id='checkBoxApresentacaoPoster$campo_trabalhos[codigo_trab]' value='$campo_trabalhos[codigo_trab]' size='5' onclick = 'limpaCheckBoxOral($campo_trabalhos[codigo_trab])' checked></td>";
                             }
                             else if($campo_trabalhos[tipo_apresentacao] == '') // null-> Tipo de apresentação ainda não definida
                             {
                                 echo "<td align='center'><input type='checkbox' name='checkBoxApresentacaoOral[]'   id='checkBoxApresentacaoOral$campo_trabalhos[codigo_trab]'   value='$campo_trabalhos[codigo_trab]' size='5' onclick = 'limpaCheckBoxPoster($campo_trabalhos[codigo_trab])' ></td>";
                                 echo "<td align='center'><input type='checkbox' name='checkBoxApresentacaoPoster[]' id='checkBoxApresentacaoPoster$campo_trabalhos[codigo_trab]' value='$campo_trabalhos[codigo_trab]' size='5' onclick = 'limpaCheckBoxOral($campo_trabalhos[codigo_trab])' checked></td>";
                             }
                        }
                    }
                    else
                        echo "<td>Nenhum trabalho encontrado!!!</td>";
                    ?>
                    <tr>
                        <td></td>
                        <td><center><input type='submit' name='submitDefinineApresentacaoOral' value='confirmar'></center></td>
                    </tr>
                    </form>
                </table>
                </br>
            </div>
        </div>
    </center>
    </body>
    </html>

<?php mysql_close($conexao); ?>







