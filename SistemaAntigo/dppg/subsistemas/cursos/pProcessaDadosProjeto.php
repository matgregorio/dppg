<?php 

    /*Este arquivo processa as altera��es dos dados recebidos (formEditaProjetoParticipante.php) e os guarda no banco de dados*/
    session_start();
    include_once("../../includes/config2.php");
    include_once 'pesquisa_vetor_cursos.php';
    include_once ('trataInjection.php');

    
    $resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('1'));
    $resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('2'));

    //Recebe os dados do formul�rio e faz a inser��o no banco de dados
    if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm)) 
    {
        //Recebendo os dados por POST
        $nome = strtoupper(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));//Participantes
        $cpfAluno = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);//Participantes, projetosparticipantes
        $cpfOriginalAluno = filter_input(INPUT_POST, 'cpfOriginalAluno');
        $cpfOrientador =  filter_input(INPUT_POST, 'cpfOrientador', FILTER_SANITIZE_SPECIAL_CHARS);//Variavel so usada para consulta
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);//Participantes
        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);//Participantes
        $departamento = strtoupper(filter_input(INPUT_POST, 'departamento', FILTER_SANITIZE_SPECIAL_CHARS));//Participantes
        $orientador = strtoupper(filter_input(INPUT_POST, 'orientador', FILTER_SANITIZE_SPECIAL_CHARS));//Participantes
        $tipoBolsa = strtoupper(filter_input(INPUT_POST, 'tipoBolsa', FILTER_SANITIZE_SPECIAL_CHARS));//projetosparticipantes
        $certificado= filter_input(INPUT_POST, 'certificado', FILTER_SANITIZE_SPECIAL_CHARS);//projetosparticipantes(coluna liberar)
        $nomeProjeto = strtoupper(filter_input(INPUT_POST, 'txtaNomeProjeto', FILTER_SANITIZE_SPECIAL_CHARS));//projetos
        $fomento = strtoupper(filter_input(INPUT_POST, 'txtaFomento', FILTER_SANITIZE_SPECIAL_CHARS));//projetos
        $vigencia = strtoupper(filter_input(INPUT_POST, 'txtaVigencia', FILTER_SANITIZE_SPECIAL_CHARS));//projetos
        $idProjetoParticipante = filter_input(INPUT_POST, 'idProjetoParticipante', FILTER_SANITIZE_SPECIAL_CHARS);//variavel so usada para consulta
        $idProjeto = filter_input(INPUT_POST, 'idProjeto', FILTER_SANITIZE_SPECIAL_CHARS);//variavel so usada para consulta
        
        //print_r($idProjetoParticipante);
        
        $temp = array($nome, $cpfAluno, $email, $telefone, $departamento, $orientador, $tipoBolsa, $certificado, $nomeProjeto, $fomento, $vigencia, $cpfOriginalAluno, $idProjetoParticipante, $idProjeto);
        ?>
        <!-- <pre> <?php //print_r($temp); ?> </pre> --><?php
        
        
//        echo "UPDATE `dppg_site`.`participantes` SET `nome` = '$nome' WHERE `participantes`.`cpf` = '$cpfOriginalAluno' -> OK" . "<br>";
//        echo "UPDATE `dppg_site`.`participantes` SET `cpf` = '$cpfAluno' WHERE `participantes`.`cpf` = '$cpfOriginalAluno' ->OK" . "<br>";
//        echo "UPDATE `dppg_site`.`projetosparticipantes` SET `cpfAluno` = '$cpfAluno' WHERE `projetosparticipantes`.`cpfAluno` = '$cpfOriginalAluno'" . "<br>";
//        echo "UPDATE `dppg_site`.`participantes` SET `email` = '$email' WHERE `participantes`.`cpf` = '$cpfOriginalAluno'" . "<br>";
//        echo "UPDATE `dppg_site`.`participantes` SET `telefone` = '$telefone' WHERE `participantes`.`cpf` = '$cpfOriginalAluno'" . "<br>";
//        echo "UPDATE `dppg_site`.`participantes` SET `departamento` = '$departamento' WHERE `participantes`.`cpf` = '$cpfOriginalAluno'" . "<br>";
//        echo "UPDATE `dppg_site`.`participantes` SET `nome` = '$orientador' WHERE `participantes`.`cpf` = '$cpfOrientador'" . "<br>";
//        echo "UPDATE `dppg_site`.`projetosparticipantes` SET `tipoBolsa` = '$tipoBolsa' WHERE `projetosparticipantes`.`idProjetoParticipante` = $idProjetoParticipante" . "<br>";
//        echo "UPDATE `dppg_site`.`projetosparticipantes` SET `liberar` = '$certificado' WHERE `projetosparticipantes`.`idProjetoParticipante` = '$idProjetoParticipante'" . "<br>";
//        echo "UPDATE `dppg_site`.`projetos` SET `projeto` = '$nomeProjeto' WHERE `projetos`.`idProjeto` = '$idProjeto'" . "<br>";
//        echo "UPDATE `dppg_site`.`projetos` SET `fomento` = '$fomento' WHERE `projetos`.`idProjeto` = '$idProjeto'" . "<br>";
//        echo "UPDATE `dppg_site`.`projetos` SET `vigencia` = '$vigencia' WHERE `projetos`.`idProjeto` = '$idProjeto'";
         
        //Altera cada dado por sql (decidido fazer desta forma para ficar mais facil identificar erros)
        
        //Altera o nome na tabela participantes 
        if(mysql_query("UPDATE `dppg_site`.`participantes` SET `nome` = '$nome' WHERE `participantes`.`cpf` = '$cpfOriginalAluno'"))
        {
            echo "<center><h2><font color='#006400'> Nome atualizado </font></h2></center><br><br>";
        }
        else
        {
            echo "<center><h2><font color='#FF0000'> Erro ao atualizar nome </font></h2></center><br><br>";
        }
        
         //Altera o cpf do aluno na tabela participantes
        if(mysql_query("UPDATE `dppg_site`.`participantes` SET `cpf` = '$cpfAluno' WHERE `participantes`.`cpf` = '$cpfOriginalAluno'"))
        {
            echo "<center><h2><font color='#006400'> Nome atualizado na tabela participantes</font></h2></center><br><br>";
        }
        else
        {
            echo "<center><h2><font color='#FF0000'> Erro ao atualizar nome na tabela participantes</font></h2></center><br><br>";
        }
        
        //Altera o cpf do aluno na tabela projetosparticipantes
        if(mysql_query("UPDATE `dppg_site`.`projetosparticipantes` SET `cpfAluno` = '$cpfAluno' WHERE `projetosparticipantes`.`cpfAluno` = '$cpfOriginalAluno'"))
        {
            echo "<center><h2><font color='#006400'> Nome atualizado na tabela projetosparticipantes </font></h2></center><br><br>";
        }
        else
        {
            echo "<center><h2><font color='#FF0000'> Erro ao atualizar nome na tabela projetosparticipantes </font></h2></center><br><br>";
        }
        
        //Altera o email tabela participantes
        if(mysql_query("UPDATE `dppg_site`.`participantes` SET `email` = '$email' WHERE `participantes`.`cpf` = '$cpfOriginalAluno'"))
        {
            echo "<center><h2><font color='#006400'> Email atualizado </font></h2></center><br><br>";
        }
        else
        {
            echo "<center><h2><font color='#FF0000'> Erro ao atualizar email </font></h2></center><br><br>";
        }
        
        //Altera o telefone tabela participantes
        if(mysql_query("UPDATE `dppg_site`.`participantes` SET `telefone` = '$telefone' WHERE `participantes`.`cpf` = '$cpfOriginalAluno'"))
        {
            echo "<center><h2><font color='#006400'> Telefone atualizado </font></h2></center><br><br>";
        }
        else
        {
            echo "<center><h2><font color='#FF0000'> Erro ao atualizar Telefone </font></h2></center><br><br>";
        }
        
        //Altera o departamento tabela participantes
        if(mysql_query("UPDATE `dppg_site`.`participantes` SET `departamento` = '$departamento' WHERE `participantes`.`cpf` = '$cpfOriginalAluno'"))
        {
            echo "<center><h2><font color='#006400'> Departamento atualizado </font></h2></center><br><br>";
        }
        else
        {
            echo "<center><h2><font color='#FF0000'> Erro ao atualizar Departamento </font></h2></center><br><br>";
        }
        
        //Altera o nome do orientador tabela participantes
        if(mysql_query("UPDATE `dppg_site`.`participantes` SET `nome` = '$orientador' WHERE `participantes`.`cpf` = '$cpfOrientador'"))
        {
            echo "<center><h2><font color='#006400'> Nome do orientador atualizado </font></h2></center><br><br>";
        }
        else
        {
            echo "<center><h2><font color='#FF0000'> Erro ao atualizar nome do orientador </font></h2></center><br><br>";
        }
        
        //Altera a bolsa entre Bolsista e Voluntario tabela projetosparticipantes
        if(mysql_query("UPDATE `dppg_site`.`projetosparticipantes` SET `tipoBolsa` = '$tipoBolsa' WHERE `projetosparticipantes`.`idProjetoParticipante` = $idProjetoParticipante"))
        {
            echo "<center><h2><font color='#006400'> Tipo de bolsa atualizado </font></h2></center><br><br>";
        }
        else
        {
            echo "<center><h2><font color='#FF0000'> Erro ao atualizar o tipo de bolsa </font></h2></center><br><br>";
        }
        
        //Altera o status do certificado tabela projetosparticipantes
        if(mysql_query("UPDATE `dppg_site`.`projetosparticipantes` SET `liberar` = '$certificado' WHERE `projetosparticipantes`.`idProjetoParticipante` = '$idProjetoParticipante'"))
        {
            echo "<center><h2><font color='#006400'> Certificado atualizado com sucesso </font></h2></center><br><br>";
        }
        else
        {
            echo "<center><h2><font color='#FF0000'> Erro ao atualizar o certificado </font></h2></center><br><br>";
        }
        
        //Altera o nome do projeto na tabela projetos
        if(mysql_query("UPDATE `dppg_site`.`projetos` SET `projeto` = '$nomeProjeto' WHERE `projetos`.`idProjeto` = '$idProjeto'"))
        {
            echo "<center><h2><font color='#006400'> Nome do projeto atualizado com sucesso </font></h2></center><br><br>";
        }
        else
        {
            echo "<center><h2><font color='#FF0000'> Erro ao atualizar o nome do projeto </font></h2></center><br><br>";
        }
        
        //Altera o fomento do projeto na tabela projetos
        if(mysql_query("UPDATE `dppg_site`.`projetos` SET `fomento` = '$fomento' WHERE `projetos`.`idProjeto` = '$idProjeto'"))
        {
            echo "<center><h2><font color='#006400'> Fomento atualizado com sucesso </font></h2></center><br><br>";
        }
        else
        {
            echo "<center><h2><font color='#FF0000'> Erro ao atualizar o fomento </font></h2></center><br><br>";
        }
        
        //Altera a vigencia do projeto na tabela projetos
        if(mysql_query("UPDATE `dppg_site`.`projetos` SET `vigencia` = '$vigencia' WHERE `projetos`.`idProjeto` = '$idProjeto'"))
        {
            echo "<center><h2><font color='#006400'> Vig&ecirc;ncia atualizada com sucesso </font></h2></center><br><br>";
        }
        else
        {
            echo "<center><h2><font color='#FF0000'> Erro ao atualizar vig&ecirc;ncia </font></h2></center><br><br>";
        }
     
        //Redireciona a pagina apos a alteracao dos dados
        echo "<meta http-equiv='refresh' content=5;url='https://sistemas.riopomba.ifsudestemg.edu.br/dppg/index.php?arquivo=subsistemas/cursos/listaAluno.php'>";
    }
    else//Se nao estiver logado, redirecione
    {
        echo "<center> <h2> Voc&ecirc; n&atilde;o est&aacute; autorizado a ver este conte&uacute;do </h2> </center>";
        echo "<meta http-equiv='refresh' content=3;url='https://sistemas.riopomba.ifsudestemg.edu.br/dppg'>";
    }
    
?>