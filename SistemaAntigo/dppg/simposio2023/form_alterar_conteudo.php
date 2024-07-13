<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Alterar Conteúdo Pagina Principal Site</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <!--<script type="text/JavaScript" src="js/valida_form_conteudo.js"></script>-->
        <script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
        <script language="javascript" type="text/javascript" src="js/tinymce.js"></script>

    </head>
    <body>
    <?php
    session_start();

    include('includes/config.php');

    $sql = "select informacoes from conteudo where codigo_conteudo = '2'";
    $resultado = mysql_query($sql);

    $campos = mysql_fetch_array($resultado);

    if ($_SESSION[logado_simposio_2021]) {

        echo "<div id='conteudo3'>
			<br>
			<center><b>Alterar Conteúdo da Página Principal<b><br><br></center>
			
			<center>
			<form name='form_altera_conteudo' method='POST' onsubmit='javascript: return checkcontatos()' action='update_conteudo.php'>
			<table border='0' class='esquerda'>
			<tr>			
				<td align='center'>Conteúdo</td>			
			</tr>		
			<tr>
				<td><textarea name='conteudo' rows='20' cols='80'>" . $campos[informacoes] . "</textarea></td>
			</tr>
			<tr>
				<td><br></td>
			<tr>	
			<tr>	
				<td colspan='2' align='center'>
					<input type='submit' name='salvar' value='Salvar'>
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