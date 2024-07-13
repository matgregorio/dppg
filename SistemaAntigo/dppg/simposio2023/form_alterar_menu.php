<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Alterar Menu Site</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <?php
    session_start();

    if ($_SESSION[logado_simposio_2021]) {

        include('includes/config.php');

        $sql_link = "select * from link_menu order by nome_link";
        $resultado_link = mysql_query($sql_link);


        echo "<div id='conteudo3'>
				<br>
				<center><b>Alterar Links Menu</b><br><br></center>
				<center>
				Clique no lápis do Link que deseja alterar:<br><br>
				<table border='1' class='esquerda' width='50%' cellspacing='0' cellpadding='4' bordercolor='#fff'> 
				<tr align='center' bgcolor='#61C02D'>
					<td>Ícone</td>
					<td>Link</td>
					<td>Alterar</td>
				";

        while ($campos_link = mysql_fetch_array($resultado_link)) {
            echo '<tr align="center" bgcolor=" #E0EEEE">
								<td><img src="images/' . $campos_link[icone] . '" border="0"></td>
								<td>' . $campos_link[nome_link] . '</td>
								<td><a href="update_menu.php?codigo=' . $campos_link[codigo_link] . '"><img src="images/alterar.gif" border="0"></a></td>
							</tr>
							';
        }

        echo "
				</table>
				</center><br><br>
				</div>";

    }

    ?>
    </body>
    </html>
<?php
}
?>