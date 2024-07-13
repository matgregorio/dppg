<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Alterar Área de Atuação</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <?php
    echo '<div id="conteudo3"><br>';
    echo '<center><b>Alterar Área de Atuação</b></center><br>';

    include('includes/config.php');

    $alterar = mysql_real_escape_string($_POST[alterar]);
    $depto = mysql_real_escape_string($_POST[depto]);

    if ($alterar == "S") {
        $sql1 = "select * from departamento where codigo_depto='$depto'";
        $resultado1 = mysql_query($sql1);
        $campos = mysql_fetch_array($resultado1);

        echo '<form name="form_alterar" method="post" action="alterar_depto2.php">
		 			<center>
		 					<input type="text" name="nome_alt" size="30" value="' . $campos[nome_depto] . '">
							<input type="hidden" name="codigo" value="' . $depto . '">
							<input type="hidden" name="alt" value="S">		 					
		 					<br>
		 					<br>
							<input type="submit" value="OK">		 			
		 			</center>
		 	<br>';


    }
    ?>

    </body>
    </html>
    <?php
    mysql_close($conexao);
}
?>