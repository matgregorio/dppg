<?php session_start();?>
<?php $_SESSION[projeto_excluido] = false; ?>

    <!DOCTYPE html>
    <html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
            function confirmarExclusao(idProjeto, cpfAluno)
            {
                var url = 'excluir_projeto.php';
                var form =
                    $('<form action="' + url + '" method="post">'  +
                        '<input type=hidden name=idProjeto value="' + idProjeto +'">' +
                        '<input type=hidden name=urlListarProjetos value="'+ window.location.href +'">' +
                        '<input type=hidden name=cpfAluno value="'+ cpfAluno +'">' +
                        '</form>');
                $('body').append(form);
                form.submit();
            }
 
        </script>
    </head>
    <body>

    </body>
    </html>

<?php
/*Este arquivo lista os projetos do aluno e seus respectivos orientadores*/

session_start();
include_once("../../includes/config2.php");
include_once 'pesquisa_vetor_cursos.php';
include_once('trataInjection.php');

if(protectorString($_GET[cpf]))
    return;

$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('1'));
$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('2'));

if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm))
{
    $cpfAluno = (filter_input(INPUT_GET, 'cpf', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    // O DAVID GARCIA FERREIRA estava recebendo esse cpf (696976789), e o M�RIO C�SAR LOURDES SALVADOR recebendo esse 938487173 quando eram listados em seus projetos (So Deus sabe o porque)) Essa gambiarra eu assumo :)
    if($cpfAluno == "696976789")
        $cpfAluno = "05142602625";
    elseif ($cpfAluno == "938487173")
        $cpfAluno = "06774026605";

    if(strlen($cpfAluno) < 10 || $cpfAluno == "" || $cpfAluno == NULL)
        die("O CPF do participante está em formato inválido");
    else if(strlen($cpfAluno) == 10)
        $cpfAluno = "0" . "$cpfAluno";//Insere um 0 a esquerda do cpf, caso esteja com 10 digitos

    $sqlAluno =  mysql_query("SELECT * FROM participantes WHERE cpf = '$cpfAluno'") or die("Erro ao buscar nome do aluno");
    $dadosAluno = mysql_fetch_assoc($sqlAluno);

    $sqlProjetos = mysql_query("SELECT pp.idProjetoParticipante,proj.idProjeto, proj.projeto, proj.fomento, proj.vigencia, p.nome, pp.cpfAluno, pp.cpfOrientador, pp.tipoBolsa, pp.liberar FROM projetos proj, participantes p, projetosparticipantes pp WHERE proj.idProjeto=pp.idProjeto AND p.cpf=pp.cpfOrientador AND pp.cpfAluno='$cpfAluno'") or die("Erro ao selecionar projetos deste aluno");

    echo "<br> <h2> Listagem de Projetos de <font color='#006400'>$dadosAluno[nome]</font></h2>";

    while($dados = mysql_fetch_assoc($sqlProjetos))
    {
        $dados[liberar]==1? $certificado = 'Liberado' : $certificado = 'Não Liberado';?>

        <!DOCTYPE>
        <html lang="pt-br">
        <head>
            <title>Listagem de projetos</title>
            <style type="text/css">
                .container{ margin: 0 0 0 3%; background-color: #AADE64;}
                .tg  { margin:0 5% 0% 7%; border-collapse:collapse;border-spacing:0;border-color:#bbb;}
                .tg td{font-family:Arial, sans-serif;font-size:14px;padding:14px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
                .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:14px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
                .tg .tg-lkh1{ background-color:#9aff99;}
                .tg .tg-lkh3{ background-color:#9aff99}
                .tg .tg-lkh4{ background-color:#C63535;color: aliceblue}
                .tg .tg-rmb8{background-color:#C2FFD6;vertical-align:top}
                .tg .tg-rmb9{background-color:#F98484;vertical-align:top}
                .tg .tg-a080{background-color:#9aff99;vertical-align:top}
                .botao { background-color:#44c767; -moz-border-radius:15px; -webkit-border-radius:  15px; border-radius:15px; border:1px solid #18ab29; display:inline-block; cursor:pointer; color:#ffffff; font-family:Arial; font-size:13px; padding:14px 29px; margin-top: 30%; text-decoration:none; text-shadow:0px 1px 0px #0e3608;}
                .botaoExcluir { background-color:#D13434; -moz-border-radius:15px; -webkit-border-radius:  15px; border-radius:15px; border:1px solid #C42D2D; display:inline-block; cursor:pointer; color:#ffffff; font-family:Arial; font-size:13px; padding:14px 29px; margin-top: 30%; text-decoration:none; text-shadow:0px 1px 0px #0e3608;}
                .botao:hover { background-color:#5cbf2a; }
                .botao:active { position:relative; top:1px;}
            </style>
        </head>

        <body style="background-color: #AADE64;">
        <div class="container">
            <table class="tg">
                <tr>
                    <th class="tg-lkh3">Editar</th>
                    <th class="tg-lkh1">Certificado</th>
                    <th class="tg-lkh3">ID</th>
                    <th class="tg-a080">Orientador</th>
                    <th class="tg-a080">Projeto</th>
                    <th class="tg-a080">Fomento</th>
                    <th class="tg-a080">Vig&ecirc;ncia</th>
                    <th class="tg-a080">Tipo</th>
                    <th class="tg-lkh4" >EXCLUSÃO</th>
                </tr>
                <br>
                <hr>
                <tr>
                    <td class="tg-rmb8">
                        <form name="frmListaProjetosParticipantes" action="formEditaProjetoParticipante.php" method="POST" >
                            <input type=hidden name=cpfAluno value="<?php echo $dados[cpfAluno];?>">
                            <input type=hidden name=cpfOrientador value="<?php echo $dados[cpfOrientador];?>">
                            <input type=hidden name=idProjetoParticipante value="<?php echo $dados[idProjetoParticipante];?>">
                            <input type=hidden name=nome value="<?php echo $dados[nome];?>">
                            <input type=hidden name=projeto value="<?php echo $dados[projeto];?>">
                            <input type=hidden name=fomento value="<?php echo $dados[fomento];?>">
                            <input type=hidden name=vigencia value="<?php echo $dados[vigencia];?>">
                            <input type=hidden name=tipoBolsa value="<?php echo strtoupper($dados[tipoBolsa]);?>">
                            <input type=hidden name=liberar value="<?php echo $dados[liberar];?>">
                            <input type=hidden name=idProjeto value="<?php echo $dados[idProjeto];?>">
                            <input class ="botao" type="submit" value="Editar">
                        </form>
                    </td>
                    <td class="tg-rmb8"><?php echo '<br>' . '<br>'; if($certificado == "Liberado") {echo "<font color='#2E644D'> Liberado </font>";} else{echo "<font color='#FF002A'>N&atilde;o Liberado </font>";}?></td>
                    <td class="tg-rmb8"><?php echo '<br>' . '<br>' . '<strong>' .$dados[idProjeto] .'</strong>';?></td>
                    <td class="tg-rmb8"><?php echo $dados[nome];?></td>
                    <td class="tg-rmb8"><?php echo $dados[projeto];?></td>
                    <td class="tg-rmb8"><?php echo $dados[fomento];?></td>
                    <td class="tg-rmb8"><?php echo $dados[vigencia];?></td>
                    <td class="tg-rmb8"><?php if(strtoupper($dados[tipoBolsa])==='B'){echo "Bosista";} else if(strtoupper($dados[tipoBolsa])==='V'){echo'Volunt&aacute;rio';} else{echo'Erro';};?></td>
                    <td class="tg-rmb9"><button class="botaoExcluir" onclick="confirmarExclusao('<?php echo $dados[idProjeto];?>', '<?php echo $dados[cpfAluno];?>'); <?php echo $_SESSION[projeto_excluido] = true;?> ">EXCLUIR</button> </td>
                </tr>
                </form>
                <br>
            </table>
        </div>
        </body>
        </html>
        <?php
    }
}
?>