<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
<title> Alterar Departamento </title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
    echo '<div id="conteudo3"><br>';
    echo '<center><b>Alterar Grande Área</b></center><br>';

    include('includes/config.php');

    $alterar = mysql_real_escape_string($_POST[alterar]);
    $grandearea = mysql_real_escape_string($_POST[grandearea]);

    if ($alterar == "S") {
        $sql1 = "select * from grande_area where codigo_ga='$grandearea'";
        $resultado1 = mysql_query($sql1);
        $campos = mysql_fetch_array($resultado1);

        echo '<form name="form_alterar" method="post" action="alterar_grandearea2.php">
		 			<center>
		 					<input type="text" name="nome_alt" size="30" value="' . $campos[nome_ga] . '">
							<input type="hidden" name="codigo" value="' . $grandearea . '">
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