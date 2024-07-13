<?php

session_start();

if ($_SESSION[logado_simposio_2021]) {
    $codigo = $_GET[codigo];

    include('acentuacao.php');
    include('includes/config.php');
    echo '<link rel="stylesheet" type="text/css" href="css/style.css">
				<script type="text/JavaScript" src="js/valida_form_menu.js"></script>';

    echo "<div id='conteudo3'>
				<br>
				<center><b>Alterar Links Menu</b><br><br></center>";

    if ($_POST[confirma] == 'S') {

        if ($_FILES[arquivo][name] != "") {
            $dir = "images/";

            $arquivo = $_FILES[arquivo][name];

            $tamanho = getimagesize($_FILES[arquivo][tmp_name]);


            /*if($_FILES[arquivo][name] != "" && $_POST[nome] !="")
            {*/
            if (eregi("^image\/(pjpeg|jpeg|png|gif|bmp)", $_FILES[arquivo]["type"])) {
                if ($_FILES[arquivo][size] < 512000) /*500KB*/ {

                    /*Verificar a largura e altura da imagem*/
                    if (($tamanho[0] <= 50) && ($tamanho[1] <= 50)) {
                        $sql = "select * from link_menu where codigo_link='$_POST[codigo]'";
                        $resultado = mysql_query($sql);
                        $campos = mysql_fetch_array($resultado);

                        chmod($dir, 777);

                        unlink($dir . $campos[icone]);

                        if (move_uploaded_file($_FILES[arquivo][tmp_name], $dir . $arquivo)) {
                            $hora_modificacao = date('H:i');
                            $data_modificacao = date('Y-m-d');
                            $nome_link = mysql_real_escape_string($_POST[nome]);
                            $codigopost = mysql_real_escape_string($_POST[codigo]);

                            $sql1 = "update link_menu set nome_link='$nome_link', data_modificacao='$data_modificacao',
      						hora_modificacao='$hora_modificacao', icone='$arquivo' where 
      						codigo_link='$codigopost'";
                            $resultado1 = mysql_query($sql1);

                            echo '<center><font color="#006400"><b>Ícone e Nome do Link alterado com sucesso!!!</b></font></center><br><br>';
                            echo '<meta http-equiv="refresh" content="3; URL=form_alterar_menu.php">';
                        }
                    } else {
                        echo '<center><font color="#FF0000"><b>Ícone deve ter dimensão no máximo 50(largura) X 50(Altura) pixels!!!</b></font></center><br><br>';
                        echo '<meta http-equiv="refresh" content="3; URL=form_alterar_menu.php">';
                    }
                } else {
                    echo '<center><font color="#FF0000"><b>Tamanho  do ícone tem que ser no máximo 500kb</b></font></center><br><br>';
                    echo '<meta http-equiv="refresh" content="3; URL=form_alterar_menu.php">';
                }
            } else {
                echo '<center><font color="#FF0000"><b>Arquivo em formato inválido! A imagem deve ser jpg, jpeg, bmp, gif ou png.</b></font></center><br><br>';
                echo '<meta http-equiv="refresh" content="3; URL=form_alterar_menu.php">';
            }
        } else {
            $hora_modificacao = date('H:i');
            $data_modificacao = date('Y-m-d');
            $nome_link = mysql_real_escape_string($_POST[nome]);
            $codigopost = mysql_real_escape_string($_POST[codigo]);

            $sql_update = "update link_menu set nome_link='$nome_link', cpf_participante='$_SESSION[cpf]',
					data_modificacao='$data_modificacao', hora_modificacao='$hora_modificacao' where codigo_link='$codigopost'";
            $resultado_update = mysql_query($sql_update);

            if ($resultado_update == 1) {
                echo '<center><font color="#006400"><b>Ícone e Nome do Link alterado com sucesso!!!</b></font></center><br><br>';
                echo '<meta http-equiv="refresh" content="3; URL=form_alterar_menu.php">';
            }
        }
    }

    $sql_link = "select * from link_menu where codigo_link ='$codigo'";
    $resultado_link = mysql_query($sql_link);
    $campos_link = mysql_fetch_array($resultado_link);

    echo "<center>
				<form name='form_update_menu' method='POST' action='update_menu.php' onsubmit='javascript: return checkcontatos()' enctype='multipart/form-data'>
				<table border='0' class='esquerda'>		
				<tr>
					<td>Ícone: </td>
					<td><input type='file' name='arquivo'></td>	
				</tr>
				<tr>
					<td>Nome Link: </td>
					<td><input type='text' name='nome' value='" . $campos_link[nome_link] . "' size='50'></td>
				</tr>
				<tr>
					<td colspan='2' align='center'><input type='submit' value='OK'></td>
					<input type='hidden' name='codigo' value='" . $codigo . "'>
					<input type='hidden' name='confirma' value='S'>				
				</tr>
				</table>
				</form>
				<font color='#FF0000'>OBS: Para encontar ícones acesse: <a href='http://www.iconfinder.com' target=_blank>Icon Finder</a> <br>
				 Ícone deve ter dimensão no máximo 50(largura) X 50(Altura) pixels!!! <br> 
				 Tamanho  do ícone tem que ser no máximo 500kb </font>
				 </center><br>
				
				<br>
				</div>
				";
}

?>

