<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Alterar Data Cadastro</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <!--<script type="text/JavaScript" src="js/compara_data.js"></script>-->
        <script type="text/JavaScript" src="js/valida_form_data.js"></script>

    </head>
    <body>
    <?php
    session_start();


    if ($_SESSION[logado_simposio_2021]) {
        include('includes/config.php');

        echo '<div id="conteudo3">
				<br>
				<center><b>Alterar Data Cadastro no Simpósio</b><br><br></center>';

        include('funcao.php');

        if ($_POST[confirma] == "S") {

            $data_inicio = datapassada($_POST[data_inicio]);
            $data_fim = datapassada($_POST[data_fim]);

            $hora_modificacao = date('H:i');
            $data_modificacao = date('Y-m-d');

            $sql_data = "update formularios set data_inicio = '$data_inicio', data_fim = '$data_fim' , cpf_participante = '$_SESSION[cpf]',
			data_modificacao = '$data_modificacao', hora_modificacao = '$hora_modificacao' where codigo_formulario = '5'";
            $resultado_data = mysql_query($sql_data);

            echo '<center><font color="#006400"><b>Data Cadastro Alterada com sucesso !!!</b></font><br><br></center>
					<meta http-equiv="refresh" content="3; URL=form_alterar_data_cadastro.php" />';
        }

        $sql = "select data_inicio, data_fim from formularios where codigo_formulario = '5'";
        $resultado = mysql_query($sql);

        $campos = mysql_fetch_array($resultado);

        $data_inicio = datadobanco($campos[data_inicio]);
        $data_fim = datadobanco($campos[data_fim]);

        echo "<center>
				<form name='form_altera_data' method='POST' onsubmit='return  checkcontatos();' action='form_alterar_data_cadastro.php'   enctype='multipart/form-data'>
				<table border='0' class='esquerda'>
				<tr>			
					<td align='center'>Data Inicial:</td>			
					<td align='center'><input type='text' name='data_inicio' OnKeyUp='mascara_data_inicio(this.value)' value='" . $data_inicio . "' size='10' maxlength='10'></td>
				</tr>
				<tr>			
					<td align='center'>Data Final:</td>			
					<td align='center'><input type='text' name='data_fim' OnKeyUp='mascara_data_fim(this.value)'  value='" . $data_fim . "' size='10' maxlength='10'></td>
				</tr>
				<tr>
					<td colspan='2' align='center'>
					<input type='hidden' name='confirma' value='S'>
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
    mysql_close($conexao);
}
?>