<?php

session_start();


if ($_SESSION[logado_simposio_2021]) {
    $codigo = $_GET[codigo];

    include('acentuacao.php');
    include('includes/config.php');
    echo '<link rel="stylesheet" type="text/css" href="css/style.css">
				<script type="text/JavaScript" src="js/valida_form_arquivo.js"></script>';

    echo "<div id='conteudo3'>
				<br>
				<center><b>Alterar Arquivos Formulários</b><br><br></center>";

    if ($_POST[confirma] == 'S') {

        if ($_FILES[arquivo][name] != "") {

            $dir = "documentos/";

            $arquivo = $_FILES[arquivo][name];

            if (eregi('(pdf|msword|powerpoint)', $_FILES[arquivo]["type"])) {

                $codigopost = mysql_real_escape_string($_POST[codigo]);
                $sql = "select * from arquivo where codigo_arquivo ='$codigopost'";
                $resultado = mysql_query($sql);
                $campos = mysql_fetch_array($resultado);

                chmod($dir, 777);

                unlink($dir . $campos[caminho_arquivo]);

                if (move_uploaded_file($_FILES[arquivo][tmp_name], $dir . $arquivo))
                {

                    $nome = mysql_real_escape_string($_POST[nome]);

                    $sql1 = "update arquivo set nome_arquivo='$nome', caminho_arquivo='$arquivo' where
      				codigo_arquivo='$codigopost'";
                    $resultado1 = mysql_query($sql1);

                    $hora_modificacao = date('H:i');
                    $data_modificacao = date('Y-m-d');

                    $sql_formulario = "update formularios set cpf_participante ='$_SESSION[cpf]',
						data_modificacao = '$data_modificacao', hora_modificacao ='$hora_modificacao' 
						where codigo_formulario = '$_SESSION[formulario]'";
                    $resultado_formulario = mysql_query($sql_formulario);

                    echo '<center><font color="#006400"><b>Arquivo e Nome do Arquivo alterado com sucesso</b></font></center><br>';
                    echo '<meta http-equiv="refresh" content="3; URL=form_alterar_arquivo.php">';
                }
            } else {
                echo '<center><font color="#FF0000"><b>Arquivo em formato inválido! O Arquivo deve  ser .doc, .ppt, .pdf</b></font></center><br><br>';
                echo '<meta http-equiv="refresh" content="3; URL=form_alterar_arquivo.php">';
            }
        } else {
            $nome = mysql_real_escape_string($_POST[nome]);
            $codigopost = mysql_real_escape_string($_POST[codigo]);

            $sql1 = "update arquivo set nome_arquivo=	'$nome' where
      				codigo_arquivo='$codigopost'";
            $resultado1 = mysql_query($sql1);

            $hora_modificacao = date('H:i');
            $data_modificacao = date('Y-m-d');

            $sql_formulario = "update formularios set cpf_participante ='$_SESSION[cpf]',
						data_modificacao = '$data_modificacao', hora_modificacao ='$hora_modificacao' 
						where codigo_formulario = '$_SESSION[formulario]'";
            $resultado_formulario = mysql_query($sql_formulario);

            echo '<center><font color="#006400"><b>Arquivo e Nome do Arquivo alterado com sucesso!!!</b></font></center><br>';
            echo '<meta http-equiv="refresh" content="3; URL=form_alterar_arquivo.php">';
        }
    }

    $sql_arquivo = "select * from arquivo where codigo_arquivo ='$codigo'";
    $resultado_arquivo = mysql_query($sql_arquivo);
    $campos_arquivo = mysql_fetch_array($resultado_arquivo);

    echo "<center>
				<form name='form_altera_arquivo' method='POST' onsubmit='javascript: return checkcontatos(this)' action='update_arquivo2.php'  enctype='multipart/form-data'>
				<table border='0' class='esquerda'>				
				<tr>
					<td>Arquivo: </td>
					<td><input type='file' name='arquivo'></td>	
				</tr>
				<tr>
					<td>Nome do Arquivo:</td>
					<td><input type='text' name='nome' value='" . $campos_arquivo[nome_arquivo] . "' size='50' maxlength='50'></td>
				</tr>
				<tr>
					<td colspan='2' align='center'><input type='submit' value='OK'></td>
					<input type='hidden' name='codigo' value='" . $codigo . "'>
					<input type='hidden' name='confirma' value='S'>				
				</tr>
				</table>
				</form>
				<!--<font color='#FF0000'>OBS: Para encontar ícones acesse: <a href='http://www.iconfinder.com' target=_blank>Icon Finder</a> <br>
				 Ícone deve ter dimensão no máximo 50(largura) X 50(Altura) pixels <br> 
				 Tamanho  do ícone tem que ser no máximo 500kb </font>-->
				 </center><br>
				
				<br>
				</div>
				";
}

?>

