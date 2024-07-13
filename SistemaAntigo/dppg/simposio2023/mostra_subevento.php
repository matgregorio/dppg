<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Subeventos</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <?php
    include('includes/config.php');

    $sql = "SELECT * FROM sub_eventos se, eventos e WHERE se.codigo_evento = e.codigo_evento ORDER BY se.data, se.horario, se.nome_sub_evento";
    $resultado = mysql_query($sql);

    echo '<div id="conteudo3">';
    echo '<br><center><b>Mostrar Subeventos</b></center><br>';

    echo '<center><table border="0" width="100%" class="esquerda">
			<tr bgcolor="#61C02D">
				<td><center><font color="#FFFFFF"><b><i>&nbsp;&nbsp;Código&nbsp;&nbsp;</i></b></font><center></td>			
				<td><center><font color="#FFFFFF"><b><i>&nbsp;&nbsp;Tipo&nbsp;&nbsp;</i></b></font><center></td>			
				<td><center><font color="#FFFFFF"><b><i>&nbsp;&nbsp;Data&nbsp;&nbsp;</i></b></font><center></td>
				<!--<td><center><font color="#FFFFFF"><b><i>&nbsp;&nbsp;Hora&nbsp;&nbsp;</i></b></font><center></td>-->
				<td><center><font color="#FFFFFF"><b><i>&nbsp;&nbsp;Duração&nbsp;&nbsp;</i></b></font><center></td>
				<td><center><font color="#FFFFFF"><b><i>&nbsp;&nbsp;Palestrante&nbsp;&nbsp;</i></b></font><center></td>				
				<!--<td><center><font color="#FFFFFF"><b><i>&nbsp;&nbsp;Evento&nbsp;&nbsp;</i></b></font><center></td>-->
				<td><center><font color="#FFFFFF"><b><i>&nbsp;&nbsp;Local&nbsp;&nbsp;</i></b></font><center></td>
				<td><center><font color="#FFFFFF"><b><i>&nbsp;&nbsp;Título&nbsp;&nbsp;</i></b></font><center></td>
			</tr>';


    while ($campos = mysql_fetch_array($resultado)) {

        $string = $campos[data];
        $entrada = trim("$string");
        if (strstr($entrada, "-")) {
            $aux2 = explode("-", $entrada);
            $datai2 = $aux2[2] . "/" . $aux2[1] . "/" . $aux2[0];
        }

        echo '<tr class="linha">
					<td>' . $campos[codigo_sub_evento] . '</td>
					<td>' . $campos[nome_sub_evento] . '</td>
					<td>' . $datai2 . '</td>	
				<!--	<td>' . $campos[horario] . '</td>	-->
					<td>' . $campos[duracao] . '</td>	
					<td>' . $campos[palestrante] . '</td>					
				<!--<td>' . $campos[nome_evento] . '</td> --> 
					<td>' . $campos[local] . '</td>
					<td>' . $campos[titulo] . '</td>			
				</tr>';
    }
    echo '</table></center><br></div>';
    ?>

    </body>
    </html>
    <?php
    mysql_close($conexao);
}
?>