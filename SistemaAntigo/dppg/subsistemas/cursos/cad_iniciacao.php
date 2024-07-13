<?php

session_start();
include_once ('trataInjection.php');

if(protectorString($_POST[tipoSubD]) || protectorString($_POST[tipoSubF])
    || protectorString($_POST[nomeAluno]) || protectorString($_POST[cpfAluno])
    || protectorString($_POST[emailAluno]) || protectorString($_POST[agenciaAluno])
    || protectorString($_POST[contaAluno]) || protectorString($_POST[tipo])
    || protectorString($_POST[nomeOrientador]) || protectorString($_POST[cpfOrientador])
    || protectorString($_POST[departamentoOrientador]) || protectorString($_POST[projeto])
    || protectorString($_POST[fomento]) || protectorString($_POST[vigencia]))
    return;

$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('1'));
$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('2'));

if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm))
{
    include('includes/config2.php');

    $tipoSubD = mysql_real_escape_string($_POST[tipoSubD]);//Cadastro um por vez
    $tipoSubF = mysql_real_escape_string($_POST[tipoSubF]);//Cadastro por csv

    $falhaAluno = false;
    $falhaOrientador = false;
    $falhaProjeto = false;

    //Cadastro de aluno feito um por vez
    if ($tipoSubD == "d")
    {
        $nomeAluno = mysql_real_escape_string(mb_strtoupper($_POST[nomeAluno], 'UTF-8'));
        $cpfAluno = mysql_real_escape_string($_POST[cpfAluno]);
        $emailAluno = mysql_real_escape_string($_POST[emailAluno]);
        $agenciaAluno = mysql_real_escape_string($_POST[agenciaAluno]);
        $contaAluno = mysql_real_escape_string($_POST[contaAluno]);
        $tipo = mysql_real_escape_string($_POST[tipo]);
        $nomeOrientador = mysql_real_escape_string(mb_strtoupper($_POST[nomeOrientador], 'UTF-8'));
        $cpfOrientador = mysql_real_escape_string($_POST[cpfOrientador]);
        $departamentoOrientador = mysql_real_escape_string(mb_strtoupper($_POST[departamentoOrientador], 'UTF-8'));
        $projeto = mysql_real_escape_string(mb_strtoupper($_POST[projeto], 'UTF-8'));
        $fomento = mysql_real_escape_string(mb_strtoupper($_POST[fomento], 'UTF-8'));
        $vigencia = mysql_real_escape_string(mb_strtoupper($_POST[vigencia], 'UTF-8'));


        $verificaAluno = mysql_query("SELECT cpf FROM participantes WHERE cpf='$cpfAluno'");
        //Se nao houver aluno cadastrado
        if (mysql_num_rows($verificaAluno) == 0)
        {
            $resultAluno = mysql_query("INSERT INTO participantes (cpf, nome, email, agencia, conta) VALUES ('$cpfAluno', '$nomeAluno', '$emailAluno', '$agenciaAluno', '$contaAluno')");
            if ($resultAluno)
            {
                echo '<br><center><b>Cadastro do aluno efetuado com sucesso !</b></center><br>';
            }
            else
            {
                echo '<br><center><b>Erro no cadastro do aluno !</b></center><br>';
                $falhaAluno = true;
            }
        }
        else
        {
            echo '<br><center><b>Aluno Existente !</b></center><br>';
        }
        //Verifica se o orientador existe
        $verificaOrientador = mysql_query("SELECT cpf FROM participantes WHERE cpf='$cpfOrientador'");
        if (mysql_num_rows($verificaOrientador) == 0)
        {
            $resultrienOrientador = mysql_query("INSERT INTO participantes (cpf, nome, departamento) VALUES ('$cpfOrientador', '$nomeOrientador', '$departamentoOrientador')");
            if ($resultrienOrientador)
            {
                echo '<br><center><b>Cadastro do orientador efetuado com sucesso !</b></center><br>';
            } else
            {
                echo '<br><center><b>Erro no cadastro do orientador !</b></center><br>';
                $falhaOrientador = true;
            }
        } else
        {
            echo '<br><center><b>Orientador Existente !</b></center><br>';
        }
        //Verifica se o projeto existe
        $verificaprojeto = mysql_query("SELECT idProjeto FROM projetos WHERE projeto='$projeto'");
        $idProjeto = 0;
        if (mysql_num_rows($verificaprojeto) > 0)
        {
            $dadoProjeto = mysql_fetch_array($verificaprojeto);
            $idProjeto = $dadoProjeto[idProjeto];
            echo '<br><center><b>Projeto Existente !</b></center><br>';
        }
        else
        {
            $verificaprojeto = mysql_query("INSERT INTO projetos (projeto, fomento, vigencia) VALUES ('$projeto', '$fomento', '$vigencia')");
            $idProjeto = mysql_insert_id();
            if ($verificaprojeto)
            {
                echo '<br><center><b>Cadastro do projeto efetuado com sucesso !</b></center><br>';
            }
            else
            {
                echo '<br><center><b>Erro no cadastro do projeto !</b></center><br>';
                $falhaProjeto = true;
            }
        }

        //faz o relacionamento entre aluno, orientador e projeto, com o tipo de aluno
        if ($falhaAluno == false && $falhaOrientador == false && $falhaProjeto == false)
        {
            //verifica se o aluno j� est� vinculado ao projeto
            $ok = mysql_num_rows(mysql_query("SELECT cpfAluno FROM projetosparticipantes WHERE cpfAluno='$cpfAluno' AND idProjeto='$idProjeto' AND tipoBolsa='$tipo'"));
            if ($ok == 0)
            {
                $resultProjAluno = mysql_query("INSERT INTO projetosparticipantes (cpfAluno, cpfOrientador, idProjeto, tipoBolsa) VALUES ('$cpfAluno', '$cpfOrientador', '$idProjeto', '$tipo')");
                if ($resultProjAluno)
                {
                    echo '<br><center><b>Vincula��o entre Aluno, Orientador e Projeto, efetuado com sucesso !</b></center><br>';
                } else
                {
                    echo '<br><center><b>Erro na vincula��o !</b></center><br>';
                }
            } else
            {
                echo '<br><center><b>Erro na vincula��o, aluno j� vinculado !</b></center><br>';
            }
        } else
        {
            echo '<br><center><b><u><font color="red">Cadastro Abortado !</font></u></b></center><br>';
        }exit();
    }
    //Cadastro de aluno feito por csv
    else if ($tipoSubF == "f")
    {
        $contz = 0;
        //verifica se o arquivo � csv
        $csv_mimetypes = array(
            'text/csv',
            'text/plain',
            'application/csv',
            'text/comma-separated-values',
            'application/excel',
            'application/vnd.ms-excel',
            'application/vnd.msexcel',
            'text/anytext',
            'application/octet-stream',
            'application/txt',
        );

        if (in_array($_FILES[arquivoCSV][type], $csv_mimetypes))
        {


            //verifica se o arquivo foi carregado para o servidor
            if (move_uploaded_file($_FILES[arquivoCSV][tmp_name], "subsistemas/cursos/tmp/file.csv"))
            {
                // Exemplo de scrip para exibir os nomes obtidos no arquivo CSV de exemplo
                $delimitador = ';';
                //$delimitador = ',';
                $cerca = '"';

                // Abrir arquivo para leitura
                //$f = fopen('C:\wamp\www\dppg\banco\teste.csv', 'r');
                $f = fopen('subsistemas/cursos/tmp/file.csv', 'r');

                if ($f)
                {
                    // Ler cabecalho do arquivo(o cabecalho contem todas as colunas lidas)
                    $cabecalho = fgetcsv($f, 0, $delimitador, $cerca);
                    //var_dump($cabecalho);
                    echo "<br>";

                    $dados = array();

                    $cont = 1;
                    // Enquanto nao terminar o arquivo
                    while (!feof($f))
                    {

                        // Ler uma linha do arquivo
                        $linha = fgetcsv($f, 0, $delimitador, $cerca);

//                        echo $cont . "<br>";
//                         var_dump($linha);
//                         echo "<br>";
//                         $contz++;

                        if (!$linha)
                        {
                            continue;
                        }

                        // Montar registro com valores indexados pelo cabecalho
                        $registro = array_combine($cabecalho, $linha);

                        //var_dump($registro);


                        $veri = "desisti";
                        //var_dump ($registro);
                        if (stripos($registro["VIGENCIA"], $veri) !== false || $registro["ALUNO"] == "")
                        {
                            $registro = "";
                        } else
                        {
                            foreach ($registro as $chv => $val)
                            {
                                //var_dump ($dados[$cont][$chv]);
                                $dados[$cont][$chv] = iconv("Windows-1252", "UTF-8", $val); //utf8_encode($val);
                                if ($chv == "CPF DO ALUNO")
                                {
                                    $dados[$cont][$chv] = str_replace(".", "", $dados[$cont]['CPF DO ALUNO']);
                                    $dados[$cont][$chv] = str_replace("-", "", $dados[$cont]['CPF DO ALUNO']);
                                } else if ($chv == "CPF DO ORIENTADOR")
                                {
                                    $dados[$cont][$chv] = str_replace(".", "", $dados[$cont]['CPF DO ORIENTADOR']);
                                    $dados[$cont][$chv] = str_replace("-", "", $dados[$cont]['CPF DO ORIENTADOR']);
                                }
                                
                                //echo $dados[$cont][$chv] . "<br>";
                            }
                            //echo "<br>";
                            
                            //$dados[$cont]= utf8_encode($registro);

                            $cont++;
                        }
                    }
                    
                    

                    //guardando dos dados no banco de dados
                    //---------------------------------------------------------------------------------------------------------

                    $encoding = mb_internal_encoding(); //Codificacao padrao do servidor

                    for ($i = 0; $i < count($dados); $i++)
                    {
                        $cpfAluno = $dados[$i]['CPF DO ALUNO'];
                        //Preenche com 0 a esquerda do cpf, caso o cpf tenha menos que 11 digitos
                        if($cpfAluno != "")
                        {
                            $cpfAluno = str_pad($cpfAluno, 11, "0", STR_PAD_LEFT); 
                        }

                        $emailAluno = $dados[$i]['EMAIL DO ALUNO'];
                        $agenciaAluno = $dados[$i]['AGENCIA'];
                        $contaAluno = $dados[$i]['CONTA'];

                        $tipo = $dados[$i]['TIPO'];
                        $tipo = substr($tipo, 0, 1);

                        $cpfOrientador = $dados[$i]['CPF DO ORIENTADOR'];

                        if($cpfOrientador != "" && strlen($cpfOrientador) < 11)
                        {
                            $cpfOrientador = str_pad($cpfOrientador, 11, "0", STR_PAD_LEFT); 
                        }
                        

                        $nomeAluno = (mb_strtoupper($dados[$i]['ALUNO'], $encoding)); //Converte para maiusculo de acordo a codificacao de acentuacao do servidor(ou iso, ou utf-8...)
                        $nomeOrientador = (mb_strtoupper($dados[$i]['ORIENTADOR'], $encoding));
                        $departamentoOrientador = (mb_strtoupper($dados[$i]['DEPARTAMENTO'], $encoding));
                        $projeto = (mb_strtoupper($dados[$i]['PROJETOS'], $encoding));
                        $fomento = (mb_strtoupper($dados[$i]['FOMENTO'], $encoding));
                        $vigencia = (mb_strtoupper($dados[$i]['VIGENCIA'], $encoding));



                        //$nomeAluno = strtr(strtoupper($nomeAluno), "������������������������������", "�??�����������??�????�������������");
                        //$nomeOrientador = strtr(strtoupper($nomeOrientador), "������������������������������", "�??�����������??�????�������������");
                        //$departamentoOrientador = strtr(strtoupper($departamentoOrientador), "������������������������������", "�??�����������??�????�������������");
                        //$projeto = strtr(strtoupper($projeto), "������������������������������", "�??�����������??�????�������������");
                        //$fomento = strtr(strtoupper($fomento), "������������������������������", "�??�����������??�????�������������");
                        //$vigencia = strtr(strtoupper($vigencia), "������������������������������", "�??�����������??�????�������������");
                        //verifica se o cpf do aluno existe
                        $verificaAluno = mysql_query("SELECT cpf FROM participantes WHERE cpf='$cpfAluno'");

                        if (mysql_num_rows($verificaAluno) == 0)
                        {
                            $resultAluno = mysql_query("INSERT INTO participantes (cpf, nome, email, agencia, conta) VALUES ('$cpfAluno', '$nomeAluno', '$emailAluno', '$agenciaAluno', '$contaAluno')");
                            if ($resultAluno)
                            {
                                echo "<br><center><b>Cadastro do aluno ($nomeAluno) efetuado com sucesso !</b></center>";
                            } else
                            {
                                echo "<br><center><font color='red'><b>Erro no cadastro do aluno ($nomeAluno) !</b></font></center>";
                                $falhaAluno = true;
                            }
                        } else
                        {
//              $resultAluno = mysql_query("UPDATE participantes SET nome='$nomeAluno', email='$emailAluno', agencia='$agenciaAluno', conta='$contaAluno' WHERE cpf='$cpfAluno'");
                            echo "<br><center><b>Aluno ($nomeAluno) Existente !</b></center>";
                        }
                        //verifica se o cpf do orientador existe
                        $verificaOrientador = mysql_query("SELECT cpf FROM participantes WHERE cpf='$cpfOrientador'");
                        if (mysql_num_rows($verificaOrientador) == 0)
                        {
                            $resultrienOrientador = mysql_query("INSERT INTO participantes (cpf, nome, departamento) VALUES ('$cpfOrientador', '$nomeOrientador', '$departamentoOrientador')");

                            if ($resultrienOrientador)
                            {
                                echo "<center><b>Cadastro do orientador ($nomeOrientador) efetuado com sucesso !</b></center>";
                            }
                            else
                            {
                                echo "INSERT INTO participantes (cpf, nome, departamento) VALUES ('$cpfOrientador', '$nomeOrientador', '$departamentoOrientador')";
                                echo "<br><center><font color='red'><b>Erro no cadastro do orientador ($nomeOrientador) !</b></font></center>";
                                $falhaOrientador = true;
                            }
                        } else
                        {
//              $resultAluno = mysql_query("UPDATE participantes SET nome='$nomeOrientador', departamento='$departamentoOrientador' WHERE cpf='$cpfOrientador'");
                            echo "<br><center><b>Orientador ($nomeOrientador) Existente !</b></center>";
                        }

                        //verifica se o projeto existe
                        $verificaprojeto = mysql_query("SELECT idProjeto FROM projetos WHERE projeto='$projeto'");
                        $idProjeto = 0;
                        if (mysql_num_rows($verificaprojeto) > 0)
                        {
                            $dadoProjeto = mysql_fetch_array($verificaprojeto);
                            $idProjeto = $dadoProjeto[idProjeto];
                            echo "<br><center><b>Projeto ($projeto) Existente !</b></center>";
                        } else
                        {
                            $verificaprojeto = mysql_query("INSERT INTO projetos (projeto, fomento, vigencia) VALUES ('$projeto', '$fomento', '$vigencia')");
                            $idProjeto = mysql_insert_id();
                            if ($verificaprojeto)
                            {
                                echo "<br><center><b>Cadastro do projeto ($projeto) efetuado com sucesso !</b></center>";
                            } else
                            {
                                echo "<br><center><font color='red'><b>Erro no cadastro do projeto ($projeto) !</b></font></center>";
                                $falhaProjeto = true;
                            }
                        }

                        //faz o relacionamento entre aluno, orientador e projeto, com o tipo de aluno
                        if ($falhaAluno == false && $falhaOrientador == false && $falhaProjeto == false)
                        {
                            //verifica se o aluno j� est� vinculado ao projeto
                            $ok = mysql_num_rows(mysql_query("SELECT cpfAluno FROM projetosparticipantes WHERE cpfAluno='$cpfAluno' AND idProjeto='$idProjeto' AND tipoBolsa='$tipo'"));
                            if ($ok == 0)
                            {
                                $resultProjAluno = mysql_query("INSERT INTO projetosparticipantes (cpfAluno, cpfOrientador, idProjeto, tipoBolsa) VALUES ('$cpfAluno', '$cpfOrientador', '$idProjeto', '$tipo')");
                                if ($resultProjAluno)
                                {
                                    echo "<br><center><b>$i - Vincula��o entre Aluno, Orientador e Projeto, efetuado com sucesso !</b></center><hr>";
                                } else
                                {
                                    echo "<br><center><font color='red'><b>$i - Erro na vincula��o !</b></font></center><hr>";
                                }
                            } else
                            {
                                echo "<br><center><font color='red'><b>$i - Erro na vincula��o, aluno j� vinculado !</b></font></center><hr>";
                            }
                        } else
                        {
                            echo "<br><center><b><u><font color='red'>$i - Cadastro Abortado !</font></u></b></center><hr>";
                        }
                        $falhaAluno = $falhaOrientador = $falhaProjeto = false;
                    }

                    //---------------------------------------------------------------------------------------------------------
                    fclose($f);
                    unlink('subsistemas/cursos/tmp/file.csv');
                }
            }
        } else
        {
            echo '<br><center><b><u><font color="red">Cadastro Abortado formato do arquivo inv�lido !</font></u></b></center><br>';
        }
        mysql_close($conexao);
    }
    echo '<br><br><center><b><u><a href="index.php?arquivo=subsistemas/cursos/form_cad_iniciacao.php">Voltar</a></u></b></center><br>';
}
?>