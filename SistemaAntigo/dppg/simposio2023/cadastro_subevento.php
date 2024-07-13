<?php

include('includes/config.php');
include('acentuacao.php');

$entrada = trim($_POST["data"]);
if (strstr($entrada, "/")) {
    $aux2 = explode("/", $entrada);
    $datai2 = $aux2[2] . "-" . $aux2[1] . "-" . $aux2[0];
}

//echo $datai2;
$nome_se = mysql_real_escape_string($_POST[nome_se]);
$duracao = mysql_real_escape_string($_POST[duracao]);
$palestrante = mysql_real_escape_string($_POST[palestrante]);
$vagas = mysql_real_escape_string($_POST[vagas]);
$evento = mysql_real_escape_string($_POST[evento]);
$local = mysql_real_escape_string($_POST[local]);
$titulo = mysql_real_escape_string($_POST[titulo]);
$descricao = mysql_real_escape_string($_POST[descricao]);
$lattes = mysql_real_escape_string($_POST[lattes]);
$bloco = mysql_real_escape_string($_POST[bloco]);

$sql = "insert into sub_eventos (codigo_sub_evento, nome_sub_evento, data, horario , duracao, palestrante, vagas, codigo_evento,
	local, titulo, descricao, lattes_participante, codigo_bloco) values ('','$nome_se','$datai2', '$_POST[hora]','$duracao',
	'$palestrante', '$vagas', '$evento', '$local', '$titulo', '$descricao', '$lattes', '$bloco')";

$resultado = mysql_query($sql);

echo '<center><font color="#006400"><b>Cadastro feito com sucesso!!!</b></font></center><br>';
echo '<meta http-equiv="refresh" content="3; URL=form_cadastro_subevento.php" />';
?>