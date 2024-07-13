<?php

include('includes/config.php');

if ($_POST[professores] != 1) {
    $professores = mysql_real_escape_string($_POST[professores]);
    $codigopost = mysql_real_escape_string($_POST[codigo]);

    $sql = "select * from participantes where cpf='$professores'";
    $resultado = mysql_query($sql);
    $campos = mysql_fetch_array($resultado);

    $sql1 = "update trabalhos set cpf_prof_analisador='$campos[cpf]' where codigo_trab='$codigopost'";
    $resultado1 = mysql_query($sql1);

    $to = $campos[email];
    $subject = 'Envio de trabalhos';
    $message = 'Prezado Avaliador,
					houve um envio de trabalho para ser avaliado.
					Para acessar segue o link abaixo.
					http://www.riopomba.ifsudestemg.edu.br/dcc/dppg/simposio2015
					A senha é a mesma que você cadastrou no sistema. 
					Caso não lembre acesse o link abaixo para mudar a senha
               http://www.riopomba.ifsudestemg.edu.br/dppg/simposio2015/simposio.php?arquivo2=form_envia_senha.php					
					Acesso Simpósio
					Login: ' . $campos[cpf] . '
					Trabalho:' . $_POST[titulo] . '
					Autor1:' . $_POST[autor1] . '
					Setor DPPG';
    $headers = 'From: dppg.riopomba@ifsudestemg.edu.br' . "\r\n";

    mail($to, $subject, $message, $headers);

    echo '<center><br><font color="#006400"><b>Trabalho enviado com sucesso!!!</b></font></center><br>';
    echo '<meta http-equiv="refresh" content="3; URL=simposio.php?arquivo2=trabalhos.php" />';
} else {
    echo '<script>
						alert("Selecione um Avaliador!!!");
					</script>';
    //echo '<center><font color="FF0000"><b><i>Erro !!! Selecione um avaliador para o trabalho submetido !!!</i></b></font></center>';
    echo '<meta http-equiv="refresh" content="3; URL=simposio.php?arquivo2=trabalhos.php" />';
}
?>