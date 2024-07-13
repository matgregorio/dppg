<?php
//session_start();
//$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('1'));
//$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('2'));
//
//if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm)) {



    include("includes/config2.php");
    include_once ('trataInjection.php');

    if(protectorString($_POST[cpf]))
        return;

    $cpf = mysql_real_escape_string($_POST[cpf]);
    $projetosAluno = mysql_query("SELECT p.idProjeto, p.projeto, pp.*, pa.nome FROM participantes pa, projetos p, projetosparticipantes pp WHERE pp.idProjeto=p.idProjeto AND pp.cpfAluno='$cpf' AND pa.cpf=pp.cpfAluno AND pp.liberar='1'");
    $projetosOrientador = mysql_query("SELECT DISTINCT p.idProjeto, p.projeto, pp.*, pa.nome FROM participantes pa, projetos p, projetosparticipantes pp WHERE pp.idProjeto=p.idProjeto AND pp.cpfOrientador='$cpf' AND pa.cpf=pp.cpfAluno AND pp.liberar='1'");

    ?>
    <center><br><b>Lista dos Certificados disponíveis</b><br><br>
        <script src="validar1.js" type="text/javascript"></script>
        <center>
            <br>
            <b>Certificados como Aluno</b><br><br>
            <?php
                while($camposProjetoAluno = mysql_fetch_array($projetosAluno)) {
                    ?>
                    <form name="form_inscricao" method="POST" onsubmit="javascript: return checkcontatos()" action="subsistemas/cursos/certificado_iniciacao_aluno.php" target="_blank">
                        <table border="0" width="100%" class="esquerda">
                            <tr>
                                <td><b>Nome do Projeto:</b></td>
                                <td><b>Aluno:</b></td>
                            </tr>
                            <tr>
                                <td><?php echo $camposProjetoAluno[projeto]; ?></td>
                                <td><?php echo $camposProjetoAluno[nome]; ?></td>
                                <td><input type="submit" value="Gerar Certificado" class="submitVerde"></td>
                            </tr>
                        </table>
                        <input type="hidden" name="id" value="<?php echo $camposProjetoAluno[idProjetoParticipante] ?>">
                        <input type="hidden" name="cpf" value="<?php echo $cpf; ?>">
                    </form>
                <?php
                }
            ?>
            <br>
        </center>
        <center>
            <br>
            <b>Certificados como Orientador</b><br><br>
            <?php
                while($camposProjetoOrientador = mysql_fetch_array($projetosOrientador)) {
                    ?>
                    <form name="form_inscricao" method="POST" onsubmit="javascript: return checkcontatos()" action="subsistemas/cursos/certificado_iniciacao_orientador.php" target="_blank">
                        <table border="0" width="100%" class="esquerda">
                            <tr>
                                <td><b>Nome do Projeto:</b></td>
                                <td><b>Aluno:</b></td>
                            </tr>
                            <tr>
                                <td><?php echo $camposProjetoOrientador[projeto]; ?></td>
                                <td><?php echo $camposProjetoOrientador[nome]; ?></td>
                                <td><input type="submit" value="Gerar Certificado" class="submitVerde"></td>
                            </tr>
                        </table>
                        <input type="hidden" name="id" value="<?php echo $camposProjetoOrientador[idProjetoParticipante] ?>">
                        <input type="hidden" name="cpf" value="<?php echo $cpf; ?>">
                    </form>
                <?php
                }
            ?>
            <br>
        </center>
<?php
mysql_close($conexao);
//}
?>