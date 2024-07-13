<?php
include('includes/config.php');

$sql = "select * from acervo where palavra_chave like '%$_POST[palavra_chave]%' and
	    		 titulo like '%$_POST[titulo]%' and  autores like '%$_POST[autor]%' and
	    		 ano like '%$_POST[ano]%' order by titulo";

echo '<center><br><b>Resultado Acervo</b><br><br>
  	   <table border="0" width="90%">
	   <tr bgcolor=#61C02D>
	   	<td align="center">Título</td>
	   	<td align="center">Palavra Chave</td>
			<td align="center">Autores</td>
			<td align="center">Ano</td>
	   </tr>';

$resultado = mysql_query($sql);
$cor = "#95e197";
while ($campos = mysql_fetch_array($resultado)) {
    echo '<tr bgcolor="' . $cor . '"><td>' . $campos[titulo] . '</td><td>' . $campos[palavra_chave] . '</td><td>' .
        $campos[autores] . '</td><td>' . $campos[ano] . '</td><td><a href=acervo/' . $campos[ano] . '/' . $campos[arquivo] .
        '><img src="images/download.png" width="32" height="32" border="0" alt="" align="middle"></td></tr>';

    if ($cor == "#78e07b")
        $cor = "#95e197";
    else
        $cor = "#78e07b";
}
echo '</table>';






?>