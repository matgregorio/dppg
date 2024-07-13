<?php
    /*Este arquivo exclui um projeto*/

    session_start();
    include_once("../../includes/config2.php");
    include_once 'pesquisa_vetor_cursos.php';
    include_once('trataInjection.php');

    $resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('1'));
    $resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('2'));

    if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm))
    {
        if(!$_SESSION[projeto_excluido])
        {
            echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../../css/style.css\">";
            echo "<h2 style='margin-top:50px;'><center>Você não pode acessar esta página diretamente</center></h2>";
            return;
        }

        try
        {
            mysql_query("DELETE FROM projetos WHERE idProjeto = '$_POST[idProjeto]'") or die("Erro na conexão com o banco de dados na operação #1");
            mysql_query("DELETE FROM projetosparticipantes WHERE idProjeto = '$_POST[idProjeto]' AND cpfAluno = '$_POST[cpfAluno]'") or die ("Ero na conexão com o banco de dados na operação #2");
            ?>
            <!DOCTYPE HTML>
            <html lang=”pt-br”>
            <head>
                <meta charset=”UTF-8”>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.11/dist/sweetalert2.all.min.js"></script>
                <link rel="stylesheet" type="text/css" href="../../css/style.css">
            </head>
            <body>
            <script>
                Swal.fire
                ({
                    icon: 'success',
                    title: 'O trablaho foi excluído',
                    showConfirmButton: false,
                })
                setTimeout(function () { window.location.href = <?php echo json_encode($_POST[urlListarProjetos]); ?>; },1800);
            </script>
            </body>
            </html>
    <?php
        $_SESSION[projeto_excluido] = false;
        }
        catch(\mysql_xdevapi\Exception $exception)
            {echo "Não foi possível realizar esta operação";}
    }?>








