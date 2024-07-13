<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<head>
    <title>Descrição Título</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
include('includes/config.php');

$sql = "select titulo, descricao from sub_eventos where codigo_sub_evento= $_GET[codigo]";

$resultado = mysql_query($sql);

while ($campos = mysql_fetch_array($resultado)) {
    echo '<div id="conteudo3"><br><center><b><i>' . $campos[titulo] . '</b></i></center>
					<br>
					' . $campos[descricao] . '
					<br>
					<br>		
					</div>
				';

}
?>

</body>
</html>

