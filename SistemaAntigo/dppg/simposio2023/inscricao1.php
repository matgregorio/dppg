<?php
header("Content-Type: text/html; charset=UTF-8", true);
include('acentucao.php');

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
        $iniciacao = mysql_real_escape_string($_POST[iniciacao]);
        $curso = mysql_real_escape_string($_POST[curso]);
        $subarea = mysql_real_escape_string($_POST[subarea]);
        $profdepto = mysql_real_escape_string($_POST[profdepto]);
        $pesquisa = mysql_real_escape_string($_POST[pesquisa]);
        $visitante = mysql_real_escape_string($_POST[visitante]);

//		$ic = mysql_real_escape_string($_POST[ic]);
//		$sql = "INSERT INTO participantes(cpf, senha, nome, email, telefone, codigo_tipo_participante, codigo_tipo_iniciacao, codigo_curso, codigo_depto, codigo_sa, pesquisa, visitante, iniciacao) VALUES ('$cpf','$senha','$nome','$email','$telefone','$participante', '$iniciacao', '$curso', '$profdepto', '$subarea', '$pesquisa', '$visitante','$ic')";

        $sql = "INSERT INTO participantes(cpf, senha, nome, email, telefone, codigo_tipo_participante, codigo_tipo_iniciacao, codigo_curso, codigo_depto, codigo_sa, pesquisa, visitante) VALUES ('$cpf','$senha','$nome','$email','$telefone','$participante', '$iniciacao', '$curso', '$profdepto', '$subarea', '$pesquisa', '$visitante')";
        $sql1 = "INSERT INTO inscricao(cpf, data_inscricao, hora_inscricao, pagamento) VALUE ('$cpf','$data','$hora','$pagamento')";

        if ($participante == 3) {
            $sqlGrupo = "INSERT INTO grupo_pro (codigo_grupo, cpf) VALUES ('2', '$cpf')";//torna o docente um avaliador
            $resultado2 = mysql_query($sqlGrupo);
        }

        $resultado = mysql_query($sql);
        $resultado1 = mysql_query($sql1);

        if (($resultado == 1) && ($resultado1 == 1)) {
            echo '<br><center><font color="#006400"><b>Cadastro realizado com sucesso. Acesse o sistema para inscrever-se nos eventos, submeter e avaliar trabalhos e gerar certificados.</b></font></center><br><br>';
            echo '<meta http-equiv="refresh" content="3; URL=form_cadastro_profsa.php" />';
        } else {
            echo '<br><center><font color="#FF0000"><b>Erro na inscrição!</b></font></center><br>';
            echo '<meta http-equiv="refresh" content="3; URL=form_cadastro_profsa.php" />';
        }
        mysql_close($conexao);
    } else {
        echo '<br><center><font color="#FF0000"><b>CPF inválido!</b></font></center><br>';
        echo '<meta http-equiv="refresh" content="3; URL=form_cadastro_profsa.php" />';
    }
} else {
    echo '<br><center><font color="#FF0000"><b>CPF inválido!</b></font></center><br>';
    echo '<meta http-equiv="refresh" content="3; URL=form_cadastro_profsa.php" />';
}
?>