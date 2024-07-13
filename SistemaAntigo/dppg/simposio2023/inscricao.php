<?php

if (($_POST[cpf] != '00000000000') && ($_POST[cpf] != '11111111111') && ($_POST[cpf] != '22222222222') &&
    ($_POST[cpf] != '3333333333') && ($_POST[cpf] != '44444444444') && ($_POST[cpf] != '55555555555') &&
    ($_POST[cpf] != '66666666666') && ($_POST[cpf] != '77777777777') && ($_POST[cpf] != '88888888888') &&
    ($_POST[cpf] != '99999999999') && strlen($_POST[cpf]) == 11
) {
    include('validacpf.php');
    if ($cpfvalido) {
        include('includes/config.php');

        $data = date("y-m-d");
        $hora = date("i:h");
        $pagamento = "S";
        $nome = mysql_real_escape_string($_POST[nome]);

        $nome = strtr(strtoupper($nome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

        $senha1 = mysql_real_escape_string($_POST[senha]);
        $senha = md5($senha1);

        $cpf = mysql_real_escape_string($_POST[cpf]);
        $email = mysql_real_escape_string($_POST[email]);
        $telefone = mysql_real_escape_string($_POST[telefone]);
        $participante = mysql_real_escape_string($_POST[participante]);
        //$curso = mysql_real_escape_string($_POST[curso]);
        $subarea = mysql_real_escape_string($_POST[subarea]);
        $profdepto = mysql_real_escape_string($_POST[profdepto]);
        $pesquisa = mysql_real_escape_string($_POST[pesquisa]);
        $visitante = mysql_real_escape_string($_POST[visitante]);
        $campus = mysql_real_escape_string($_POST[campus]);

        $verificacao = mysql_query("SELECT cpf FROM participantes WHERE cpf='$cpf'");
        if (mysql_num_rows($verificacao) == 0)
        {
            $sql = "INSERT INTO participantes(cpf, senha, nome, email, telefone, codigo_tipo_participante, codigo_curso, campus, codigo_depto, codigo_sa, pesquisa, visitante)
             VALUES ('$cpf','$senha','$nome','$email','$telefone','$participante','0', '$campus','$profdepto', '$subarea', '$pesquisa', '$visitante')";
            $sql1 = "insert into inscricao(cpf, data_inscricao, hora_inscricao, pagamento) values ('$cpf','$data','$hora','$pagamento')";
        //    echo "$slq -------------------------------------------->2";
            if (($participante == 3) or ($participante == 5))
            {
                $sqlGrupo = "INSERT INTO grupo_pro (codigo_grupo, cpf) VALUES ('2', '$cpf')"; //torna o docente um avaliador
                $resultado2 = mysql_query($sqlGrupo);
            }

            $resultado = mysql_query($sql);
            $resultado1 = mysql_query($sql1);

            if (($resultado == 1) && ($resultado1 == 1)) {
                echo '<br><center><b>Cadastro realizado com sucesso. Acesse o sistema para inscrever-se nos eventos, submeter e avaliar trabalhos e gerar certificados.</b></center><br><br>';
//			$sql_aviso ="select * from conteudo where codigo_conteudo = '5'";
//			$resultado_aviso = mysql_query($sql_aviso);
//			$campos_aviso = mysql_fetch_array($resultado_aviso);
//			echo $campos_aviso[informacoes];
            } else {
                echo '<br><center><b>Erro na inscrição! <br>Falha na comunicação com o Banco de Dados.</b></center><br>';
            }
        } else {
            echo '<br><center><font color="#FF0000"><b>Erro no cadastro! CPF em uso!</b></font></center><br>';
        }
        mysql_close($conexao);
    } else
        echo '<br><center><b>CPF inválido!</b></center><br>';
} else
    echo '<br><center><b>CPF inválido!</b></center><br>';
?>
