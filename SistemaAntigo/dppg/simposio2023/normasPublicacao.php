<?php
include('includes/config.php');

$sql1 = "select * from arquivo a, formularios f where a.codigo_formulario = f.codigo_formulario and a.codigo_formulario ='1'";
$resultado1 = mysql_query($sql1);
echo "<h3><center>Normas para publicação</center></h3>";
echo'<div style=" margin-top 350px; width: 95%; height: 100%; font-family: Times, serif; font-size: 20px;">';
echo '<center><br>    ';
$sql = "select informacoes from conteudo where codigo_conteudo = '6'";
$resultado = mysql_query($sql);

$campos = mysql_fetch_array($resultado);
$campos1 = mysql_fetch_array($resultado1);
//echo "<object type='application/pdf'  data='documentos/$campos1[caminho_arquivo]' style='height: 885px; width: 95%'>";
//echo '<img src=images/' . $campos1[icone] . ' border="0"><a href=documentos/' . $campos1[caminho_arquivo] . '>&nbsp;' . $campos1[nome_arquivo] . '</a><br><br>';
//echo "</object>";
echo " 
    <p style = 'font-size:20px;'> $campos[informacoes] </p>
<!--
     <p>
        Os resumos deverão ser enviados utilizando a página disponível no site institucional no período de submissão de 
        trabalhos, de 22/06/2018 (sexta-feira) a 20/08/2018 (segunda-feira).
     </p>
     <p>
        O parecer do orientador ocorrerá até 27/08/2018
        (segunda-feira). A avaliação realizada pelo avaliador externo ocorrerá até  10/09/2018 (segunda-feira).
     </p> 
    
     <p>
        O resultado da avaliação dos trabalhos para apresentação no 
        X Simpósio de Ciência, Inovação & Tecnologia será disponibilizado no sistema do Simpósio até 24/09/2018 (segunda-feira). 
        Os horários e datas das apresentações serão divulgados no site do evento até 28/09/2018 (sexta-feira).
    </p>
    
    <p>
        Para alunos bolsistas e voluntários das Iniciações Científicas 2017/2018 é obrigatória a participação no Simpósio, publicando os resultados obtidos sob a forma de resumo. Cada bolsista e voluntário apresentará seu próprio resumo como primeiro autor de acordo com o plano de trabalho proposto no projeto de pesquisa.
        Os trabalhos submetidos para publicação deverão ser inéditos.
    </p>
    
    <p>
        Todos os trabalhos serão, OBRIGATORIAMENTE, submetidos na forma de RESUMO simples que deverá possuir no mínimo 250 e no máximo 400 palavras, excluindo título.
    </p>

    
    <p> 
        O autor deve criar o resumo diretamente na caixa de texto disponível no sistema de submissão on line. O texto deve ser justificado e digitado em parágrafo único e em espaçamento simples, em fonte Times New Roman 12.
    </p>
           
    <p>
        Caso o texto seja criado num editor de texto \"Microsoft Word ou LibreOffice Writer\", os caracteres especiais como aspas, sobrescrito, itálico, hífen devem ser criados diretamente na caixa de texto do sistema de submissão.
    </p>      -->
    ";
echo '</center>';
echo"</div>";
mysql_close($conexao);
?>

<br>
<br>

<p>
<!--<h5><center><a style="font-size: 16px;" href='https://sistemas.riopomba.ifsudestemg.edu.br/simposio2021/documentos/RegulamentoIXSIMPOSIO.pdf' target='blank'>Clique aqui para acessar o regulamento do SIMPÓSIO 2019</a></center></h5>-->
</p>



