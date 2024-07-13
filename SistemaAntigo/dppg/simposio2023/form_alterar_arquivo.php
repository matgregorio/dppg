<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Alterar Arquivos Formulários</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/JavaScript" src="valida_form.js"></script>

    </head>
    <body>
    <?php
    session_start();

    if ($_SESSION[logado_simposio_2021])
    {
        include('includes/config.php');

        $sql = "select DISTINCT(f.codigo_formulario), f.nome_formulario from formularios f , arquivo a where f.codigo_formulario =
		a.codigo_formulario order by f.nome_formulario";
        $resultado = mysql_query($sql);

        echo "<div id='conteudo3'>
				<br>
				<center><b>Alterar Arquivos Formulários</b><br><br></center>
				<center>
				<form name='' method='POST' action='update_arquivo.php' >
				<table class='esquerda' border='0'>
				<tr>				
					<td>Selecione o Formulário que deseja alterar o(s) Arquivo(s):</td>				
				</tr>				
				<tr>
					<td align='center'><select name='codform' size='1'> ";

        while ($campos = mysql_fetch_array($resultado)) {
            echo '<option value=' . $campos[codigo_formulario] . '>' . $campos[nome_formulario] . '</option>';
        }


        echo "</select></td>
				</tr>
				<tr>
					<td align='center'><input type='submit' value='OK'></td>
				</tr>
				</table>
				</form>		
				<br><br>
				</center>
				</div>";
    }

    ?>
    </body>
    </html>
<?php
}
?>