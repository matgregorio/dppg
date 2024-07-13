<?php
/*Este arquivo lista os dados do aluno, orientador e projeto e exibe na tela para que seja feita alguma altera��o caso necess�rio. As altera��es s�o gravadas por um form e enviadas ao banco*/

session_start();
include_once("../../includes/config2.php");
include_once 'pesquisa_vetor_cursos.php';


$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('1'));
$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('2'));

$manutencao = false;

//busca os dados do banco e os guarda em vetores
if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm) && !$manutencao) 
{
    $idProjetoParticipante = filter_input(INPUT_POST, 'idProjetoParticipante', FILTER_SANITIZE_SPECIAL_CHARS);
    $cpfAluno = filter_input(INPUT_POST, 'cpfAluno', FILTER_SANITIZE_SPECIAL_CHARS);
    $cpfOrientador = filter_input(INPUT_POST, 'cpfOrientador', FILTER_SANITIZE_SPECIAL_CHARS);
    $nomeOrientador = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $projeto = filter_input(INPUT_POST, 'projeto', FILTER_SANITIZE_SPECIAL_CHARS);
    $fomento = filter_input(INPUT_POST, 'fomento', FILTER_SANITIZE_SPECIAL_CHARS);
    $vigencia = filter_input(INPUT_POST, 'vigencia', FILTER_SANITIZE_SPECIAL_CHARS);
    $tipoBolsa = filter_input(INPUT_POST, 'tipoBolsa', FILTER_SANITIZE_SPECIAL_CHARS);
    $liberar = filter_input(INPUT_POST, 'liberar', FILTER_SANITIZE_SPECIAL_CHARS);
    $idProjeto = filter_input(INPUT_POST, 'idProjeto', FILTER_SANITIZE_SPECIAL_CHARS);
        
    $sqlDadosAluno = "SELECT * FROM participantes WHERE cpf = '$cpfAluno'";
    $resultDadosAluno = mysql_query($sqlDadosAluno) or die("Erro ao carregar os dados do aluno");
    $dadosAluno = array();
    $dadosAluno = mysql_fetch_assoc($resultDadosAluno);   
?>

<html><!-- Montando o html com o formul�rio-->
    
    <head>
        <title>
            Edi&ccedil;&atilde;o de dados
        </title>
        
        <style type="text/css"> /*Me desculpe por fazer o estilo aqui mesmo*/
            .body
            {
                /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#a5c956+0,a5c956+0,cdeb8e+100 */
                background: #a5c956; /* Old browsers */
                background: -moz-linear-gradient(top, #a5c956 0%, #a5c956 0%, #cdeb8e 100%); /* FF3.6-15 */
                background: -webkit-linear-gradient(top, #a5c956 0%,#a5c956 0%,#cdeb8e 100%); /* Chrome10-25,Safari5.1-6 */
                background: linear-gradient(to bottom, #a5c956 0%,#a5c956 0%,#cdeb8e 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a5c956', endColorstr='#cdeb8e',GradientType=0 ); /* IE6-9 */
                height: 1500px;
            }
            
            .divFormEditaDadosProjeto
            {
                padding: 5px;
                text-transform: uppercase;
                width: 660px;
                height: 1100px;
                border: 1px solid #006400;
                margin: 10px auto auto auto;
                display: block;
            }
            
            .frmEdicao
            {
                width: 500px;
                height: 800px;
                margin:auto auto auto 30%;

            } 
            .txtNome
            {
                width: 270px;
                height: 25px;
                -webkit-transition: focus width 700ms, height 1000ms ease-in-out;/*Proporciona a anima��o da div*/
                transition: width 700ms , height 1400ms ease-in-out;/*Proporciona a anima��o da div*/
                resize: none;
            }

            .txtNome:focus /*Como a div vai ficar depois que for acionado o evento focus*/
            {
                box-shadow: 0 0 5px #6db5f1;
                width: 325px;
                height:25px;
            }
            
            .txtCpf
            {
                width: 270px;
                height: 25px;
                -webkit-transition: focus width 700ms, height 1000ms ease-in-out;/*Proporciona a anima��o da div*/
                transition: width 700ms , height 1400ms ease-in-out;/*Proporciona a anima��o da div*/
                resize: none;
            }

            .txtCpf:focus /*Como a div vai ficar depois que for acionado o evento focus*/
            {
                box-shadow: 0 0 5px #6db5f1;
                width: 273px;
                height:25px;
            }
            
            .txtEmail
            {
                width: 270px;
                height: 25px;
                -webkit-transition: focus width 700ms, height 1000ms ease-in-out;/*Proporciona a anima��o da div*/
                transition: width 700ms , height 1400ms ease-in-out;/*Proporciona a anima��o da div*/
                resize: none;
            }

            .txtEmail:focus /*Como a div vai ficar depois que for acionado o evento focus*/
            {
                box-shadow: 0 0 5px #6db5f1;
                width: 290px;
                height:25px;
            }
            
            .txtTelefone
            {
                width: 270px;
                height: 25px;
                -webkit-transition: focus width 700ms, height 1000ms ease-in-out;/*Proporciona a anima��o da div*/
                transition: width 700ms , height 1400ms ease-in-out;/*Proporciona a anima��o da div*/
                resize: none;
            }

            .txtTelefone:focus /*Como a div vai ficar depois que for acionado o evento focus*/
            {
                box-shadow: 0 0 5px #6db5f1;
                width: 280px;
                height:25px;
            } 
            
            .txtDepartamento
            {
                width: 270px;
                height: 25px;
                -webkit-transition: focus width 700ms, height 1000ms ease-in-out;/*Proporciona a anima��o da div*/
                transition: width 700ms , height 1400ms ease-in-out;/*Proporciona a anima��o da div*/
                resize: none;
            }

            .txtDepartamento:focus /*Como a div vai ficar depois que for acionado o evento focus*/
            {
                box-shadow: 0 0 5px #6db5f1;
                width: 280px;
                height:25px;
            }
            
            .txtOrientador
            {
                width: 270px;
                height: 25px;
                -webkit-transition: focus width 700ms, height 1000ms ease-in-out;/*Proporciona a anima��o da div*/
                transition: width 700ms , height 1400ms ease-in-out;/*Proporciona a anima��o da div*/
                resize: none;
            }

            .txtOrientador:focus /*Como a div vai ficar depois que for acionado o evento focus*/
            {
                box-shadow: 0 0 5px #6db5f1;
                width: 280px;
                height:25px;
            }
            
            .txtCpfOrientador
            {
                width: 270px;
                height: 25px;
                -webkit-transition: focus width 700ms, height 1000ms ease-in-out;/*Proporciona a anima��o da div*/
                transition: width 700ms , height 1400ms ease-in-out;/*Proporciona a anima��o da div*/
                resize: none;
            }

            .txtCpfOrientador:focus /*Como a div vai ficar depois que for acionado o evento focus*/
            {
                box-shadow: 0 0 5px #6db5f1;
                width: 280px;
                height:25px;
            }
                    
            .txtaNomeProjeto
            {
                width: 290px;
                height: 30px;
                -webkit-transition: focus width 700ms, height 1000ms ease-in-out;/*Proporciona a anima��o da div*/
                transition: width 700ms , height 1400ms ease-in-out;/*Proporciona a anima��o da div*/
                resize: none;
            }

            .txtaNomeProjeto:focus /*Como a div vai ficar depois que for acionado o evento focus*/
            {
                box-shadow: 0 0 5px #6db5f1;
                width: 400px;
                height:80px;
            }
            
            .txtaFomento
            {
                width: 290px;
                height: 30px;
                -webkit-transition: focus width 700ms, height 1000ms ease-in-out;/*Proporciona a anima��o da div*/
                transition: width 700ms , height 1400ms ease-in-out;/*Proporciona a anima��o da div*/
                resize: none;
            }

            .txtaFomento:focus /*Como a div vai ficar depois que for acionado o evento focus*/
            {
                box-shadow: 0 0 5px #6db5f1;
                width: 400px;
                height:80px;
            }
            
                        
            .txtaVigencia
            {
                width: 290px;
                height: 30px;
                -webkit-transition: focus width 700ms, height 1000ms ease-in-out;/*Proporciona a anima��o da div*/
                transition: width 700ms , height 1400ms ease-in-out;/*Proporciona a anima��o da div*/
                resize: none;
            }

            .txtaVigencia:focus /*Como a div vai ficar depois que for acionado o evento focus*/
            {
                box-shadow: 0 0 5px #6db5f1;
                width: 400px;
                height:80px;
            }
            
            .submit
            {
                width: 95px;
                height: 30px;
                font-size:12px;
                font-family:Arial;
                font-weight:normal;
                -moz-border-radius:42px;
                -webkit-border-radius:42px;
                border-radius:50px;
                border:1px solid #84bbf3;
                padding:9px 18px;
                margin-left: 90px;
                background:-moz-linear-gradient( center top, #79bbff 5%, #378de5 100% );
                background:-ms-linear-gradient( top, #79bbff 5%, #378de5 100% );
                filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#378de5');
                background:-webkit-gradient( linear, left top, left bottom, color-stop(5%, #79bbff), color-stop(100%, #378de5) );
                background-color:#79bbff;
                color:#ffffff;
                display:inline-block;
                text-shadow:0px 0px 50px #528ecc;
                -webkit-box-shadow:inset 0px 0px 0px 0px #bbdaf7;
                -moz-box-shadow:inset 0px 0px 0px 0px #bbdaf7;
                box-shadow:inset 0px 0px 0px 0px #bbdaf7;
            }

            .submit:hover
            {
                background:-moz-linear-gradient( center top, #378de5 5%, #79bbff 100% );
                background:-ms-linear-gradient( top, #378de5 5%, #79bbff 100% );
                filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#378de5', endColorstr='#79bbff');
                background:-webkit-gradient( linear, left top, left bottom, color-stop(5%, #378de5), color-stop(100%, #79bbff) );
                background-color:#378de5;
                cursor : pointer;
                color: #fff;
            }

            
            
            
        </style>
        
    </head>
    <body class="body">     
        <div class="divFormEditaDadosProjeto"><!--Formul�rio-->
            
            <br>
            <center><h2>Edi&ccedil;&atilde;o dos dados de incia&ccedil;&atilde;o cient&iacute;fica</h2></center>
            <hr>
            
            <form class="frmEdicao" name="frmEdicao" action="pProcessaDadosProjeto.php" method="POST" >

                <br>
                Nome
                <br>
                <input class="txtNome" type="text"  name="nome" value="<?php echo $dadosAluno[nome];?>" required >
                <br>
                <br>
                <br>

                CPF:
                <br>
                <input class="txtCpf" type="text" name="cpf" value="<?php echo $dadosAluno[cpf];?>" maxlength="11" required>
                <br>
                <br>

                Email:
                <br>
                <input class="txtEmail" type="text" name="email" value="<?php echo $dadosAluno[email];?>" required>
                <br>
                <br> 
                <br>

                Telefone:
                <br>
                <input class="txtTelefone" type="text" name="telefone" value="<?php echo $dadosAluno[telefone];?>" >
                <br>
                <br>
                <br>
                
                Departamento:
                <br>
                <input class="txtDepartamento" type="text" name="departamento" value="<?php echo $dadosAluno[departamento];?>" >
                <br>
                <br>
                <br>

                <?php /* Se for bolsista, monta o radio com essa op��o ativada, e vice-versa*/
                
                switch($tipoBolsa)
                {
                    case "B":
                    {?>
                        Tipo de bolsa:
                        <input type="radio" name="tipoBolsa" value="B" checked> Bolsista
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="tipoBolsa" value="V"> Volunt&aacute;rio
                        <br>
                        <br>
              <?php     break;
                    }
                    case "V": 
                    {?>
                        Tipo de bolsa:
                        <input type="radio" name="tipoBolsa" value="B"> Bolsista
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="tipoBolsa" value="V" checked> Volunt&aacute;rio
                        <br>
                        <br>
              <?php     break;
                    }
                    default:
                    {
                        echo"<center> <h2>Erro ao carregar o tipo de bolsa</h2> </center>";
                    }
                }?> 
                
                <br>
                        
                <!-- Se o certificado estiver liberado, monta o radio com essa op��o ativada, e vice-versa-->
                <?php switch($liberar)
                {
                    case "0":
                    {?>
                        Certificado:
                        <input type="radio" name="certificado" value="0" checked> N&atilde;o liberar
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="certificado" value="1"> Liberar
                        <br>
                        <br>
              <?php     break;
                    }
                    case "1":
                    {?>
                        Certificado
                        <input type="radio" name="certificado" value="0"> N&atilde;o liberar
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="certificado" value="1" checked> Liberar
                        <br>
                        <br>
              <?php     break;
                    }
                    default:
                    {
                        echo"<center> <h2>Erro ao carregar dados do certificado</h2> </center>";
                    }
                }?> 
                        
                <br>
                Orientador:
                <br>
                <input type="text" class="txtOrientador" name="orientador" value="<?php echo "$nomeOrientador";?>" required>
                <br>
                <br>
                <br>
                
                CPF Orientador:
                <br>
                <input type ="text" class="txtCpfOrientador" value="<?php echo "$cpfOrientador";?>" maxlength="11" disabled="" required>
                <br>
                <br>
                <br>
                
                Nome do projeto:
                <br>
                <textarea class="txtaNomeProjeto" name="txtaNomeProjeto" required><?php echo $projeto;?></textarea>
                <br>
                <br>
                <br>
                
                Fomento:
                <br>
                <textarea class="txtaFomento" name="txtaFomento" required><?php echo $fomento;?></textarea>
                <br>
                <br>
                <br>

                Vig&ecirc;ncia:
                <br> 
                <textarea class="txtaVigencia" name="txtaVigencia" required ><?php echo $vigencia;?></textarea>
                <br>
                <br>
                
                <input type="hidden" value="<?php echo $cpfAluno ?>" name="cpfOriginalAluno" />
                
                <input type="hidden" value="<?php echo $idProjetoParticipante ?>" name="idProjetoParticipante" />
                
                <input type="hidden" value="<?php echo $idProjeto ?>" name="idProjeto" />
                
                <input type="hidden" value="<?php echo $cpfOrientador; ?>" name="cpfOrientador" />
                
                <input class="submit" type="submit" value="Finalizar">
                
            </form>     
            
        </div>

    </body>

</html>




<?php mysql_close($conexao); }

else
{
    echo "<center><h1>Esta p&aacute;gina est&aacute; em manuten&ccedil;&atilde;o</h1></center>";
}



?>
 