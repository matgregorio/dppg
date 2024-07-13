<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Alterar Primeiro autor</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <?php
    session_start();

    //Precisa estar logado no sistema
    if ($_SESSION[logado_simposio_2021]) {

        include('includes/config.php');

        /**
         * O usuário acessa a página e digita o código do trabalho. Então é redirecionado para essa mesma página e a partir daqui
         * começa-se a trabalhar com o código do trabalho digitado
         */
        $codigoTrabalhoDefinido = filter_input(INPUT_POST, 'codigoTrabalhoDefinido'); //Verificando se o usuário já digitou o código do trabalho
        $codigoTrabalho = filter_input(INPUT_POST, 'codigoTrabalho');//O código do trabalho
        $idAutorParaMudanca = filter_input(INPUT_POST, 'idAutor'); //Qual o autor vai ser o apresentador

        /**
         * Esse trecho se refere á escolha do apresentador do trabalho. Vêm após o usuário escolher o código do trabalho
         */
        if(isset($idAutorParaMudanca))//Se já se sabe qual autor será o apresentador
        {
            $codigoTrabalho2 = filter_input(INPUT_POST, 'codigoTrabalho2');//Pego novamente o código do trabalho
            if(isset($codigoTrabalho2))
            {
                switch ($idAutorParaMudanca)
                {
                    case 1:
                        {
                            try
                            {
                                $sqlUpdate = "UPDATE `dppg_simposio2021`.`trabalhos` SET `apresentador` = '$idAutorParaMudanca' WHERE `trabalhos`.`codigo_trab` = '$codigoTrabalho2'";
                                mysql_query($sqlUpdate);
                            }
                            catch (Exception $e)
                            {
                                echo 'Erro! ' . $e;
                            }
                            finally
                            {
                                header("refresh:3;url=https://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2021/alterarPrimeiroAutor.php");
                                echo "<center><font color='#32cd32'><h2 style='margin: 10% auto auto 1%'>Sucesso na alteração<h2></font></center>";
                            }

                            break;
                        }

                    case 2:
                        {
                            try
                            {
                                $sqlUpdate = "UPDATE `dppg_simposio2021`.`trabalhos` SET `apresentador` = '$idAutorParaMudanca' WHERE `trabalhos`.`codigo_trab` = '$codigoTrabalho2'";
                                mysql_query($sqlUpdate);
                            }
                            catch (Exception $e)
                            {
                                echo 'Erro! ' . $e;
                            }
                            finally
                            {
                                header("refresh:3;url=https://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2021/alterarPrimeiroAutor.php");
                                echo "<center><font color='#32cd32'><h2 style='margin: 10% auto auto 1%'>Sucesso na alteração<h2></font></center>";
                            }
                            break;
                        }
                    case 3:
                        {
                            try
                            {
                                $sqlUpdate = "UPDATE `dppg_simposio2021`.`trabalhos` SET `apresentador` = '$idAutorParaMudanca' WHERE `trabalhos`.`codigo_trab` = '$codigoTrabalho2'";
                                mysql_query($sqlUpdate);
                            }
                            catch (Exception $e)
                            {
                                echo 'Erro! ' . $e;
                            }
                            finally
                            {
                                header("refresh:3;url=https://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2021/alterarPrimeiroAutor.php");
                                echo "<center><font color='#32cd32'><h2 style='margin: 10% auto auto 1%'>Sucesso na alteração<h2></font></center>";
                            }
                            break;
                        }
                    case 4:
                        {
                            try
                            {
                                $sqlUpdate = "UPDATE `dppg_simposio2021`.`trabalhos` SET `apresentador` = '$idAutorParaMudanca' WHERE `trabalhos`.`codigo_trab` = '$codigoTrabalho2'";
                                mysql_query($sqlUpdate);
                            }
                            catch (Exception $e)
                            {
                                echo 'Erro! ' . $e;
                            }
                            finally
                            {
                                header("refresh:3;url=https://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2021/alterarPrimeiroAutor.php");
                                echo "<center><font color='#32cd32'><h2 style='margin: 10% auto auto 1%'>Sucesso na alteração<h2></font></center>";
                            }
                            break;

                        }
                    case 5:
                        {
                            try
                            {
                                $sqlUpdate = "UPDATE `dppg_simposio2021`.`trabalhos` SET `apresentador` = '$idAutorParaMudanca' WHERE `trabalhos`.`codigo_trab` = '$codigoTrabalho2'";
                                mysql_query($sqlUpdate);
                            }
                            catch (Exception $e)
                            {
                                echo 'Erro! ' . $e;
                            }
                            finally
                            {
                                header("refresh:3;url=https://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2021/alterarPrimeiroAutor.php");
                                echo "<center><font color='#32cd32'><h2 style='margin: 10% auto auto 1%'>Sucesso na alteração<h2></font></center>";
                            }
                            break;
                        }
                    case 6:
                        {
                            try
                            {
                                $sqlUpdate = "UPDATE `dppg_simposio2021`.`trabalhos` SET `apresentador` = '$idAutorParaMudanca' WHERE `trabalhos`.`codigo_trab` = '$codigoTrabalho2'";
                                mysql_query($sqlUpdate);
                            }
                            catch (Exception $e)
                            {
                                echo 'Erro! ' . $e;
                            }
                            finally
                            {
                                header("refresh:3;url=https://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2021/alterarPrimeiroAutor.php");
                                echo "<center><font color='#32cd32'><h2 style='margin: 10% auto auto 1%'>Sucesso na alteração<h2></font></center>";
                            }
                            break;

                        }
                    case 7:
                        {
                            try
                            {
                                $sqlUpdate = "UPDATE `dppg_simposio2021`.`trabalhos` SET `apresentador` = '$idAutorParaMudanca' WHERE `trabalhos`.`codigo_trab` = '$codigoTrabalho2'";
                                mysql_query($sqlUpdate);
                            }
                            catch (Exception $e)
                            {
                                echo 'Erro! ' . $e;
                            }
                            finally
                            {
                                header("refresh:3;url=https://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2021/alterarPrimeiroAutor.php");
                                echo "<center><font color='#32cd32'><h2 style='margin: 10% auto auto 1%'>Sucesso na alteração<h2></font></center>";
                            }
                            break;
                        }
                    case 0:
                        {
                            try
                            {
                                $sqlUpdate = "UPDATE `dppg_simposio2021`.`trabalhos` SET `apresentador` = '$idAutorParaMudanca' WHERE `trabalhos`.`codigo_trab` = '$codigoTrabalho2'";
                                mysql_query($sqlUpdate);
                            }
                            catch (Exception $e)
                            {
                                echo "Erro! " . $e;
                            }
                            finally
                            {
                                header("refresh:3;url=https://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2021/alterarPrimeiroAutor.php");
                                echo "<center><font color='#32cd32'><h2 style='margin: 10% auto auto 1%'>Sucesso na alteração<h2></font></center>";
                            }
                            break;
                        }
                }
            }
            else
            {
                echo 'Código do trabalho não definido';
            }
        }
        else
        {

        }

        /**
         * Esse trecho se refere á escolha do código do trabalho. Primeiro se escolhe o código do trabalho, e depois se escolhe quem será o autor
         */
        if (isset($codigoTrabalhoDefinido))//Verifica se o codigo do trabalho já foi escolhido
        {
            $sql = "SELECT * FROM trabalhos WHERE codigo_trab = '$codigoTrabalho'";
            $sqlResult = mysql_query($sql);
            $dadosTrabalho = mysql_fetch_array($sqlResult);

            $sqlAutor1 = "SELECT nome FROM participantes WHERE cpf = '$dadosTrabalho[autor1]'";
            $autor1Result = mysql_query($sqlAutor1);
            $nomeAutor1 = MySQL_fetch_row($autor1Result);

            $sqlOrientador = "SELECT nome FROM `participantes` where cpf ='$dadosTrabalho[cpf_prof_analisador]'";
            $orientador1Result = mysql_query($sqlOrientador);
            $nomeOrientador = MySQL_fetch_row($orientador1Result);

            $sqlAutor2 = "SELECT nome FROM participantes WHERE cpf = '$dadosTrabalho[autor2]'";
            $autor2Result = mysql_query($sqlAutor2);
            $nomeAutor2 = MySQL_fetch_row($autor2Result);


            $sqlAutor3 = "SELECT nome FROM participantes WHERE cpf = '$dadosTrabalho[autor3]'";
            $autor3Result = mysql_query($sqlAutor3);
            $nomeAutor3 = MySQL_fetch_row($autor3Result);

            $sqlAutor4 = "SELECT nome FROM participantes WHERE cpf = '$dadosTrabalho[autor4]'";
            $autor4Result = mysql_query($sqlAutor4);
            $nomeAutor4 = MySQL_fetch_row($autor4Result);

            $sqlAutor5 = "SELECT nome FROM participantes WHERE cpf = '$dadosTrabalho[autor5]'";
            $autor5Result = mysql_query($sqlAutor5);
            $nomeAutor5 = MySQL_fetch_row($autor5Result);

            $sqlAutor6 = "SELECT nome FROM participantes WHERE cpf = '$dadosTrabalho[autor6]'";
            $autor6Result = mysql_query($sqlAutor6);
            $nomeAutor6 = MySQL_fetch_row($autor6Result);

            $sqlAutor7 = "SELECT nome FROM participantes WHERE cpf = '$dadosTrabalho[autor7]'";
            $autor7Result = mysql_query($sqlAutor7);
            $nomeAutor7 = MySQL_fetch_row($autor7Result);

            switch ($dadosTrabalho[apresentador])
            {
                case 0:
                    {
                        $nomeApresentador = $nomeOrientador;
                        break;
                    }
                case 1:
                    {
                        $nomeApresentador = $nomeAutor1;
                        break;
                    }
                case 2:
                    {
                        $nomeApresentador = $nomeAutor2;
                        break;
                    }
                case 3:
                    {
                        $nomeApresentador = $nomeAutor3;
                        break;
                    }
                case 4:
                    {
                        $nomeApresentador = $nomeAutor4;
                        break;
                    }
                case 5:
                    {
                        $nomeApresentador = $nomeAutor5;
                        break;
                    }
                case 6:
                    {
                        $nomeApresentador = $nomeAutor6;
                        break;
                    }
                case 7:
                    {
                        $nomeApresentador = $nomeAutor7; 
                        break;
                    }

            }


            //Se não houver autorX, coloque o nome como '---'
            $nomeAutor1[0] == "" ? $nomeAutor1[0] = " --- " : null;
            $nomeAutor2[0] == "" ? $nomeAutor2[0] = " --- " : null;
            $nomeAutor3[0] == "" ? $nomeAutor3[0] = " --- " : null;
            $nomeAutor4[0] == "" ? $nomeAutor4[0] = " --- " : null;
            $nomeAutor5[0] == "" ? $nomeAutor5[0] = " --- " : null;
            $nomeAutor6[0] == "" ? $nomeAutor6[0] = " --- " : null;
            $nomeAutor7[0] == "" ? $nomeAutor7[0] = " --- " : null;
            $nomeOrientador[0] == "" ? $nomeOrientador = " --- " : null;



            /**
             * Formulário para escolher o primeiro autor
             */
            echo "

        <!DOCTYPE>
        <html lang=\"pt-br\">
            <head>
                <title>Listagem de projetos</title>
                <style type=\"text/css\">
                    .container{ margin: 0 20% 0 20%; background-color: #AADE64;}
                    .tg  { margin:0 5% 0% 15%; border-collapse:collapse;border-spacing:0;border-color:#bbb; }
                    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:14px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
                    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:14px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
                    .tg .tg-lkh3{ background-color:#9aff99}
                    .tg .tg-rmb8{background-color:#C2FFD6;vertical-align:top; margin: auto auto auto 20%;}
                    .tg .tg-a080{background-color:#66CDAA;vertical-align:top}
                    .botao { background-color:#44c767; -moz-border-radius:15px; -webkit-border-radius:  15px; border-radius:15px; border:1px solid #18ab29; display:inline-block; cursor:pointer; color:#ffffff; font-family:Arial; font-size:13px; padding:14px 29px; text-decoration:none; text-shadow:0px 1px 0px #0e3608;}
                    .botao:hover { background-color:#5cbf2a; }
                    .botao:active { position:relative; top:1px;}
                </style>
            </head>
            
            <body style=\"background-color: #AADE64;\">

                
                <div class=\"container\">
                
                            
                <div id='conteudo3' style='margin: auto auto auto 15%; width: 600px; text-align: justify;'>

                    <font color='#44c767'>Código do Trabalho:</font> $dadosTrabalho[codigo_trab]
                    <br>
                    <br>
                    <font color='#44c767'>Título:</font> $dadosTrabalho[titulo]
                    <br>
                    <br>
                    <font color='#44c767'>Primeiro Autor:</font> $nomeAutor1[0]
                    <br>
                    <br>
                    <font color='#44c767'>Professor orientador:</font> $nomeOrientador[0]
                    <br>
                    <br>
                    <font color='#44c767'>Apresentador:</font> $nomeApresentador[0]
                </div>
           
                    <table class=\"tg\">
                        <tr>
                            <th class=\"tg-lkh3\">Autores</th>
                            <th class=\"tg-lkh3\">Nome</th>
                            <th class=\"tg-lkh3\">Tornar apresentador</th>
                      
                        </tr>
                        
                        <br>
                        <hr>
                        
                            <tr>
                                <td class=\"tg-rmb8\"><?php echo\" < font color = '#FF002A' > 1° Autor </font ></td >
                                <td class=\"tg-rmb8\"><?php echo \"<font color='#FF002A'> $nomeAutor1[0] </font></td>                               
                                <form name=\"frmListaAutores\" action=\"alterarPrimeiroAutor.php\" method=\"POST\" >
                                    <td class=\"tg-rmb8\"><input class =\"botao\" type=\"submit\" value=\"Apresentador\"></td>
                                    <input type=hidden name=idAutor value=\"1\">
                                    <input type=hidden name=codigoTrabalho2 value=\"$codigoTrabalho\">
                                </form>

                            </tr>
                            <tr>
                                <td class=\"tg-rmb8\"><?php echo\" < font color = '#FF002A' > 2° Autor </font ></td >
                                <td class=\"tg-rmb8\" ><?php echo\"<font color='#FF002A'> $nomeAutor2[0] </font></td>
                                <form name=\"frmListaAutores\" action=\"alterarPrimeiroAutor.php\" method=\"POST\" >
                                    <td class=\"tg-rmb8\"><input class =\"botao\" type=\"submit\" value=\"Apresentador\"></td>
                                    <input type=hidden name=idAutor value=\"2\">
                                    <input type=hidden name=codigoTrabalho2 value=\"$codigoTrabalho\">
                                </form>
                            </tr>
                            <tr>
                                <td class=\"tg-rmb8\"><?php echo\" < font color = '#FF002A' > 3° Autor </font ></td >
                                <td class=\"tg-rmb8\" ><?php echo\"<font color='#FF002A'> $nomeAutor3[0] </font></td>
                                <form name=\"frmListaAutores\" action=\"alterarPrimeiroAutor.php\" method=\"POST\" >
                                    <td class=\"tg-rmb8\"><input class =\"botao\" type=\"submit\" value=\"Apresentador\"></td>
                                    <input type=hidden name=idAutor value=\"3\">
                                    <input type=hidden name=codigoTrabalho2 value=\"$codigoTrabalho\">
                                </form>
                            </tr>
                            <tr>
                                <td class=\"tg-rmb8\"><?php echo\" < font color = '#FF002A' > 4° Autor </font ></td >
                                <td class=\"tg-rmb8\" ><?php echo\"<font color='#FF002A'> $nomeAutor4[0] </font></td>
                                <form name=\"frmListaAutores\" action=\"alterarPrimeiroAutor.php\" method=\"POST\" >
                                    <td class=\"tg-rmb8\"><input class =\"botao\" type=\"submit\" value=\"Apresentador\"></td>
                                    <input type=hidden name=idAutor value=\"4\">
                                    <input type=hidden name=codigoTrabalho2 value=\"$codigoTrabalho\">
                                </form>
                            </tr>
                            <tr>
                                <td class=\"tg-rmb8\"><?php echo\" < font color = '#FF002A' > 5° Autor </font ></td >
                                <td class=\"tg-rmb8\" ><?php echo \"<font color='#FF002A'> $nomeAutor5[0] </font></td>
                                <form name=\"frmListaAutores\" action=\"alterarPrimeiroAutor.php\" method=\"POST\" >
                                    <td class=\"tg-rmb8\"><input class =\"botao\" type=\"submit\" value=\"Apresentador\"></td>
                                    <input type=hidden name=idAutor value=\"5\">
                                    <input type=hidden name=codigoTrabalho2 value=\"$codigoTrabalho\">
                                </form>
                            </tr>
                            <tr>
                                <td class=\"tg-rmb8\"><?php echo\" < font color = '#FF002A' > 6° Autor </font ></td >
                                <td class=\"tg-rmb8\" ><?php echo\"<font color='#FF002A'> $nomeAutor6[0] </font></td>
                                <form name=\"frmListaAutores\" action=\"alterarPrimeiroAutor.php\" method=\"POST\" >
                                    <td class=\"tg-rmb8\"><input class =\"botao\" type=\"submit\" value=\"Apresentador\"></td>
                                    <input type=hidden name=idAutor value=\"6\">
                                    <input type=hidden name=codigoTrabalho2 value=\"$codigoTrabalho\">
                                </form>
                            </tr>
                            <tr>
                                <td class=\"tg-rmb8\"><?php echo\" < font color = '#FF002A' > 7° Autor </font ></td >
                                <td class=\"tg-rmb8\" ><?php echo\"<font color='#FF002A'> $nomeAutor7[0] </font></td>
                                <form name=\"frmListaAutores\" action=\"alterarPrimeiroAutor.php\" method=\"POST\" >
                                    <td class=\"tg-rmb8\"><input class =\"botao\" type=\"submit\" value=\"Apresentador\"></td>
                                    <input type=hidden name=idAutor value=\"7\">
                                    <input type=hidden name=codigoTrabalho2 value=\"$codigoTrabalho\">
                                </form>
                            </tr>
                            <tr>
                                <td class=\"tg-rmb8\"><?php echo\" < font color = '#FF002A' > Orientador </font ></td >
                                <td class=\"tg-rmb8\" ><?php echo \"<font color='#FF002A'> $nomeOrientador[0] </font></td>
                                <form name=\"frmListaAutores\" action=\"alterarPrimeiroAutor.php\" method=\"POST\" >
                                    <td class=\"tg-rmb8\"><input class =\"botao\" type=\"submit\" value=\"Apresentador\"></td>
                                    <input type=hidden name=idAutor value=\"0\">
                                    <input type=hidden name=codigoTrabalho2 value=\"$codigoTrabalho\">                                   
                                </form>
                            </tr>
                             <tr>
                                <td class=\"tg-a080\"><?php echo\" < font-color = '#8B0000' > Apresentador atual </font ></td >
                                <td class=\"tg-a080\" ><?php echo\"<font color='#CD5C5C'> $nomeApresentador[0] </font></td>

                            </tr>

                            
                        </form>                        
                        <br>   
                                             
                    </table>   
                    
                                   
                    
                        <br>
                        <br>
                        <center>
                            <a href = 'https://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2021/certificado_submissao.php?codigo=$codigoTrabalho' target=\"_blank\">
                                <button class='botao'>Testar certificado</button>
                        </center>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>

                </div>
            </body>                       
        </html>
                   
";

            
        /*
         * Formulário para digitar o código do trabalho
         * */
        } else {
            echo "<div id='conteudo3' style='margin: 4% auto auto 22%'>
				<br>
				<center><b>Digite o código do trabalho</b><br><br></center>
				<center>
     
                    </header>
                     
                    <section class=\"body\">
                     
                    <form method=\"post\" action='https://sistemas.riopomba.ifsudestemg.edu.br/dppg/simposio2021/alterarPrimeiroAutor.php' >
                     
                    <input type=\"text\" name=\"codigoTrabalho\"/>
                    
                    <br>    
                    <br>
                    
                    <input type='submit' value=\"Consultar\">
                    <input type='hidden' name=\"codigoTrabalhoDefinido\" value='1'>                                    
                                     
                    </form>
                     
                    </section>

                     
                    <footer class=\"body\">
                        
                    
                    </footer>
				</center>
				</div>";
        }
    }

    ?>
    </body>
    </html>
    <?php
}
?>