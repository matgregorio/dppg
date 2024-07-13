<?php

include_once ('includes/config.php');
include_once ('trataInjection.php');

$sql = mysql_query("select * from arquivo where codigo_arquivo ='5'");
$arquivo = mysql_fetch_array($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $arquivo[nome_arquivo];?></title>
</head>
<body>
<h2 style="text-align: center;"><?php echo $arquivo[nome_arquivo];?></h2>
<iframe src="documentos/<?php echo $arquivo[caminho_arquivo];?>#zoom=87" width="100%" height="1500px">
</iframe>
</body>
</html>













































