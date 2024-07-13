<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo]))
{
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Alterar Arquivos Formulários</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    <?php
    session_start();

    if ($_SESSION[logado_simposio_2021]) {

        include('includes/config.php');

        $codform = mysql_real_escape_string($_POST[codform]);

        $sql_arquivo = "select * from arquivo a, formularios f where a.codigo_formulario = f.codigo_formulario
		and a.codigo_formulario = '$codform' order by nome_arquivo";
        $resultado_arquivo = mysql_query($sql_arquivo);

        $_SESSION[formulario] = $codform;

        echo "<div id='conteudo3'>
				<br>
				<center><b>Alterar Arquivos Formulários</b><br><br></center>
				<center>
				
				Clique no lápis do Arquivo que deseja alterar:<br><br>
				<table border='1' class='esquerda' width='50%' cellspacing='0' cellpadding='4' bordercolor='#fff'> 
				<tr align='center' bgcolor='#61C02D'>
					<td>Ícone</td>
					<td>Arquivo</td>
					<td>Alterar</td>
				";


        while ($campos_arquivo = mysql_fetch_array($resultado_arquivo))
        {
            echo '<tr align="center" bgcolor="#E0EEEE">
								<td><img src="images/' . $campos_arquivo[icone] . '" border="0"></td>
								<td><a href="documentos/' . $campos_arquivo[caminho_arquivo] . '" target="_blank">' . $campos_arquivo[nome_arquivo] . '</a></td>
								<td><a href="update_arquivo2.php?codigo=' . $campos_arquivo[codigo_arquivo] . '"><img src="images/alterar.gif" border="0"></a></td>
							</tr>
							';
        }

        echo "
				</table>
				<br>
				<a href='form_alterar_arquivo.php'>Voltar</a>
				</center><br><br>
				</div>";

    }

    ?>
    </body>
    </html>
<?php
}
?>