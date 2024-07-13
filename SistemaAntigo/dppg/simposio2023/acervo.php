<?php

include('../simposio2013/includes/config.php');

$ano = mysql_real_escape_string($_POST[ano]);

$sql1 = "select * from ano where codigo_ano='$ano'";
$resultado1 = mysql_query($sql1);
$campos1 = mysql_fetch_array($resultado1);

$palavra = mysql_real_escape_string($_POST[palavra]);
$titulo = mysql_real_escape_string($_POST[titulo]);
$autor = mysql_real_escape_string($_POST[autor]);
$palavra_chave = mysql_real_escape_string($_POST[palavra_chave]);

$sql = "select * from acervo ace, ano a where  ace.codigo_ano = a.codigo_ano and
	palavra_chave like '%" . $palavra_chave . "%' and titulo like '%" . $titulo . "%' and  
	autores like '%" . $autor . "%' and ano like '%" . $campos1[ano] . "%' order by titulo";
$resultado = mysql_query($sql);

if (mysql_num_rows($resultado) > 0) {
    echo '<center><br><b>Resultado Acervo de ' . $campos_ano[ano] . '</b><br><br>
        <center><a href="simposio.php?arquivo2=form_acervo.php">Voltar</a></center>
        <br><br>
  	   <table border="0" width="100%">
	   <tr bgcolor=#61C02D>
	   	<td align="center"><font color="#FFFFFF"><b><i>Título</i></b></font></td>
	   	<td align="center"><font color="#FFFFFF"><b><i>Palavra Chave</i></b></font></td>
			<td align="center"><font color="#FFFFFF"><b><i>Autores</i></b></font></td>
			<td align="center"><font color="#FFFFFF"><b><i>Ano</i></b></font></td>
	   </tr>';


    $cor = "#95e197";
    while ($campos = mysql_fetch_array($resultado)) {
        echo '<tr bgcolor="' . $cor . '">
	      			<td>' . $campos[titulo] . '</td>
	      			<td>' . $campos[palavra_chave] . '</td>
	      			<td>' . $campos[autores] . '</td>
	      			<td>' . $campos[ano] . '</td>
	      			<td>
	      				<a href=../simposio2013/acervo/' . $campos[ano] . '/' . $campos[arquivo] . ' target="_blank">
	      				<img src="images/download.png" width="32" height="32" border="0" alt="" align="center">
	      			</td>
	      		</tr>';

        if ($cor == "#78e07b")
            $cor = "#95e197";
        else
            $cor = "#78e07b";
    }
    echo '</table><br>';
} else
    echo '<br><center><i>Nenhum registro encontrado!!!</i></center><br>';
?>