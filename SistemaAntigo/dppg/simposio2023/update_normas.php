<?php


include('includes/config.php');
include('acentuacao.php');

$conteudo = mysql_real_escape_string($_POST[conteudo]);

$sql = "update conteudo set informacoes = '$conteudo' where codigo_conteudo ='6'";
$resultado = mysql_query($sql);

if ($resultado == 1) {
    echo '<center><font color="#006400"><b>Conteúdo Normas Alterado Com Sucesso!!!</b></font></center>
				<meta http-equiv="refresh" content="3; URL=form_alterar_normas.php">';
} else {
    echo '<center><font color="#FF0000"><b>Conteúdo Normas não Alterado!!!</b></font></center>
			<meta http-equiv="refresh" content="3; URL=form_alterar_normas.php">';

}
?>