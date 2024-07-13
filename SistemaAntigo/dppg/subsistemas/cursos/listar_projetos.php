<?php
include("../../includes/config2.php");
include_once ('trataInjection.php');

if(protectorString($_GET[f]))
    return;
?>
    <p><center><b>Lista de Projetos Vinculados</b></font></center></p>
    <p>OBS.: Selecione o projeto a ser liberado o certificado</p>
    <table border="0" style="width: 100%;">
    <tr>
        <td></td>
        <td>Status</td>
        <td>Orientador</td>
        <td>Projeto</td>
        <td>Fomento</td>
        <td>Vigencia</td>
        <td>Tipo</td>
    </tr>
    <tr><td colspan="7"><hr></td></tr>
    <?php
$cpf = mysql_real_escape_string($_GET[f]);

$projetos = mysql_query("SELECT pp.idProjetoParticipante, proj.projeto, proj.fomento, proj.vigencia, p.nome, pp.tipoBolsa, pp.liberar FROM projetos proj, participantes p, projetosparticipantes pp WHERE proj.idProjeto=pp.idProjeto AND p.cpf=pp.cpfOrientador AND pp.cpfAluno='$cpf'");

if (mysql_num_rows($projetos) > 0) {
    $cont = 1;
    while ($campoProjeto = mysql_fetch_array($projetos)) 
    {
        echo "<tr>";
        if ($campoProjeto[liberar] == 0)
        {
            
            echo "<td><input type='checkbox' name='$campoProjeto[idProjetoParticipante]' value='$campoProjeto[idProjetoParticipante]' onclick='javascript: alterar_permissao(this.value, $cpf);'></td>";
            echo "<td><font color='red'>Não Liberado</font></td>";
        }
        else
        {
            echo "<td><font color='#7cec00'><b>&nbsp;OK&nbsp;</b></font></td>";
            echo "<td><font color='#006400'>Liberado</font></td>";
        }
        echo "<td>$campoProjeto[nome]</td>";
        echo "<td>$campoProjeto[projeto]</td>";
        echo "<td>$campoProjeto[fomento]</td>";
        echo "<td>$campoProjeto[vigencia]</td>";
        if (strtoupper($campoProjeto[tipoBolsa]) == "B"){
            echo "<td>Bolsista</td>";
        }else{
            echo "<td>Voluntário</td>";
        }
        echo"</tr>";
        echo"<tr><td colspan='7'><hr></td></tr>";
    }
} else {
    echo "<td>Nenhum participante encontrado!!!</td>";
}
?>
  </table>
  <br>
  <?php
mysql_close($conexao);
?>