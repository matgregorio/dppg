<?php
    /*Este arquivo monta um formulário de confirmação para exclusão de um projeto*/

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

        $cpfAluno = $_POST['cpfAluno'];
        $idProjeto = $_POST['idProjeto'];

        ?>
        <!DOCTYPE HTML>
        <html lang=”pt-br”>
        <head>
            <meta charset=”UTF-8”>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.11/dist/sweetalert2.all.min.js"></script>
            <link rel="stylesheet" type="text/css" href="../../css/style.css">
            <script>

            </script>

        </head>
        <body>
            <script>
                function enviarDadosExclusao()
                {
                    url = 'processa_excluir_projeto.php';
                    cpfAluno = <?php echo json_encode($_POST[cpfAluno]) ?>;
                    idProjeto = <?php echo json_encode($_POST[idProjeto]); ?>;
                    urlListarProjetos = <?php echo json_encode($_POST[urlListarProjetos]); ?>;
                    var form =
                        $('<form action="' + url + '" method="post">'  +
                            '<input type=hidden name=idProjeto value="' + idProjeto +'">' +
                            '<input type=hidden name=urlListarProjetos value="'+ urlListarProjetos +'">' +
                            '<input type=hidden name=cpfAluno value="'+ cpfAluno +'">' +
                            '</form>');
                    $('body').append(form);
                    form.submit();
                }

                 Swal.fire({
                     title: 'Confirma exclusão do projeto ' + <?php echo json_encode($_POST[idProjeto]); ?> + '?',
                     text: "A ação não poderá ser desfeita",
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#d33',
                     cancelButtonColor: '#3085d6',
                     confirmButtonText: 'Deletar'
                  }).then((result) =>
                  {
                     if (result.value)
                     { enviarDadosExclusao();}
                     else if(result.dismiss === Swal.DismissReason.cancel)
                     {
                         Swal.fire({
                             title: '<strong>Operação cancelada</strong>',
                             icon: 'info',
                             html: 'Retornando a página anterior... ',
                             showConfirmButton: false,
                             showCloseButton: false, //Edite, se quiser
                             showCancelButton: false, //Edite, se quiser
                             focusConfirm: false//,
                            })
                            return setTimeout(function () { window.location.href = <?php echo json_encode($_POST[urlListarProjetos]); ?>; },1800);
                        }
                    })

            </script>
        </body>
    </html>

    <?php
    }
    else
        return;

