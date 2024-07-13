<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Alterar Assinatura 2</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/JavaScript" src="js/valida_form_assinatura2.js"></script>

    </head>
    <body>
    <?php
    session_start();

    if ($_SESSION[logado_simposio_2021]) {

        include('includes/config.php');

        $sql = "select topo from conteudo where codigo_conteudo = '9'";
        $resultado = mysql_query($sql);

        $campos = mysql_fetch_array($resultado);

        echo "<div id='conteudo3'>
				<br>
				<center><b>Alterar Logo Direita Inferior Certificado</b><br><br></center>
				<center>
				<form name='form_assinatura' method='POST' action='update_certificado_logo.php'  onsubmit='javascript: return checkcontatos()' enctype='multipart/form-data'>
				<table border='0' class='esquerda'>
				<tr>			
					<td>Imagem logo Direita Inferior:</td>			
					<td><input type='file' name='arquivo'></td>				
				</tr>					
				<tr>	
					<td colspan='2' align='center'>
						<input type='submit' value='OK'>
					</td>			
				</tr>
				<tr>
					<td><br></td>
				</tr>
				</table>
				<font color='#FF0000'>OBS: A imagem deve ter dimensão 175(largura) X 102(Altura) pixels!!! <br> 
					Tamanho  da imagem tem que ser no máximo 200 kb</font><br><br>
					<a href='form_alterar_logo_assinatura.php'>Voltar</a><br><br>			
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