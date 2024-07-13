<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Alterar Assinatura 2</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/JavaScript" src="js/valida_form_assinatura1.js"></script>

    </head>
    <body>
    <?php
    session_start();

    if ($_SESSION[logado_simposio_2021]) {

        include('includes/config.php');

        $sql = "select assinatura, cargo from conteudo where codigo_conteudo = '9'";
        $resultado = mysql_query($sql);

        $campos = mysql_fetch_array($resultado);

        echo "<div id='conteudo3'>
				<br>
				<center><b>Alterar Conteudo Assinatura 2</b><br><br></center>
				<center>
				<form name='form_assinatura' method='POST' action='update_assinatura2.php'  onsubmit='javascript: return checkcontatos()' enctype='multipart/form-data'>
				<table border='0' class='esquerda'>
				<tr>			
					<td>Imagem Assinatura:</td>			
					<td><input type='file' name='arquivo'></td>				
				</tr>		
				<tr>
					<td>Nome:</td>
					<td><input type='text' name='nome' value='" . $campos[assinatura] . "' size='60' maxlength='60'></td>
				</tr>
				<tr>
					<td>Cargo:</td>
					<td><input type='text' name='cargo' value='" . $campos[cargo] . "' size='60' maxlength='60'></td>
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
					Tamanho  da imagem tem que ser no máximo 200 kb</font>-->
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