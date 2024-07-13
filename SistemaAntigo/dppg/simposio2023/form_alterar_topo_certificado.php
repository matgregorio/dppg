<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Alterar Topo Certificado</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/JavaScript" src="js/valida_form_topo.js"></script>

    </head>
    <body>
    <?php
    session_start();

    if ($_SESSION[logado_simposio_2021]) {

        include('includes/config.php');

        $sql = "select topo from conteudo where codigo_conteudo = '7'";
        $resultado = mysql_query($sql);

        $campos = mysql_fetch_array($resultado);

        echo "<div id='conteudo3'>
				<br>
				<center><b>Alterar Topo certificado<b><br><br></center>
				<center>
				<form name='form_altera_topo' method='POST' action='update_topo_certificado.php'  onsubmit='javascript: return checkcontatos()' enctype='multipart/form-data'>
				<table border='0' class='esquerda'>
				<tr>			
					<td align='center'>Imagem Topo Certificado</td>			
				</tr>		
				<tr>
					<td align='center'><input type='file' name='arquivo'></td>
				</tr>
				<tr>
					<td><br></td>
				<tr>	
				<tr>
					<td align='center'><font color='#FF0000'>OBS: A imagem deve ter dimensão 600(largura) X 113(Altura) pixels!!! <br> 
					Tamanho  da imagem tem que ser no máximo 1 Mb<br>
					Imagem deve ser do formato jpg ou jpeg.</font></td>
				</tr>
				<tr>	
					<td colspan='2' align='center'>
						<input type='submit' name='OK' value='OK'>
					</td>			
				</tr>
				</table>
							
				</form> 
				</center>
				</div>";

    }

    ?>
    </body>
    </html>
<?php
}
?>