<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Alterar Período / Edição</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/JavaScript" src="js/valida_form_conteudo_certificado.js"></script>

    </head>
    <body>
    <?php
    session_start();

    if ($_SESSION[logado_simposio_2021]) {

        include('includes/config.php');

        $sql = "select informacoes from conteudo where codigo_conteudo = '11'";
        $resultado = mysql_query($sql);
        $campos = mysql_fetch_array($resultado);


        $sql1 = "select informacoes from conteudo where codigo_conteudo = '10'";
        $resultado1 = mysql_query($sql1);
        $campos1 = mysql_fetch_array($resultado1);


        echo "<div id='conteudo3'>
				<br>
				<center><b>Alterar Período / Edição</b><br><br></center>
				<center>
				<form name='form_certificado' method='POST' action='update_certificado.php'  onsubmit='javascript: return checkcontatos()'>
				<table border='0' class='esquerda'>
				<tr>			
					<td>Período do evento:</td>			
					<td><input type='text' name='periodo' value='" . $campos[informacoes] . "' size='50' maxlenght='50'></td>
				</tr>		
				<tr>
					<td>Edição do Evento:</td>
					<td><input type='text' name='edicao' value='" . $campos1[informacoes] . "' size='4' maxlength='4'></td>
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
				<!--<font color='#FF0000'>OBS: A imagem deve ter dimensão 175(largura) X 102(Altura) pixels!!! <br> 
					Tamanho  da imagem tem que ser no máximo 200 kb</font>--><br><br>			
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