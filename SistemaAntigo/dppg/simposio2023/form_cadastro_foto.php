<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Cadastro Galeria de Fotos </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>

    <?php
    include("includes/config.php");

    echo '<div id="conteudo3"><br>';

    echo '<center><b>Cadastro Galeria de Fotos</b></center><br>';


    if ($_POST[envio] == "S") {

        $ano = mysql_real_escape_string($_POST[ano]);

        $sql1 = "select * from ano where codigo_ano = '$ano'";
        $resultado1 = mysql_query($sql1);
        $campos1 = mysql_fetch_array($resultado1);

        $path = "images/fotos/";
        $diretorio = dir($path);

        chmod('images/fotos/', 0777);

        $pasta = $campos1[ano];

        mkdir("images/fotos/$pasta");

        while ($arquivo = $diretorio->read()) {

            mkdir("acervo/$pasta");
            chmod("images/fotos/$pasta", 0777);

            if ($arquivo != "." && $arquivo != "..") {
                if ($arquivo == "$campos1[ano]") {
                    $extensao = "jpeg|jpg";
                    $file = $_FILES['arq']['type'];

                    if (eregi($extensao, $file)) {
                        //recebendo o ano
                        $dir = $arquivo;
                        $numero = mt_rand();
                        $file = "Foto.jpg";

                        //$arquivo1 = $path.$dir.'/'.$numero.'_'.$_FILES[arq][name];
                        //$arquivo2 = $numero.'_'.$_FILES[arq][name];
                        $arquivo1 = $path . $dir . '/' . $numero . '_' . $file;
                        $arquivo2 = $numero . '_' . $file;

                        if (move_uploaded_file($_FILES[arq][tmp_name], $arquivo1)) {
                            $sql2 = "insert into album (codigo_foto, pasta, nome_foto)
										values ('','$ano', '$arquivo2')";
                            $resultado2 = mysql_query($sql2);
                            echo '<center><font color="#006400"><b>Cadastro feito com sucesso!!!</b></font></center>';
                            echo '<meta http-equiv="refresh" content="3; URL=form_cadastro_foto.php" />';
                        }
                    } else
                        echo '<br><center><b>
											 <font color="#FF0000">Erro no envio do arquivo.
											 <br>Tipo de arquivo não suportado.<br>Envie somente arquivos do tipo JPG ou JPEG.<br>
											 Selecione uma foto</b>
											 </font></center>';
                }
            }
        }

        $diretorio->close();
    }

    $sql = "select * from ano order by ano asc";
    $resultado = mysql_query($sql);

    echo '<center>
				<form name="form_cadastro_fot" method="post" onsubmit="javascript: return checkcontatos()" action="form_cadastro_foto.php" enctype="multipart/form-data"> 				
				<table border="0" class="esquerda">				
				<tr>
					<td>Foto:</td>
					<td><input name="arq" type="file"></td>
				</tr>
				<tr>
					<td>Pasta: </td>
					<td>
					
					<select name="ano" size="1">';

    while ($campos = mysql_fetch_array($resultado)) {
        echo "<option value='$campos[codigo_ano]'>$campos[ano]</option>";
    }

    echo '</select>
					</td>
				</tr>
				</table>
				<input  type="hidden" name="envio" value="S">
				<input type="submit" value="OK">
				</form>
				
				<font color="#FF0000">OBS: A imagem deve ter dimensão no máximo 200(largura) X 200(Altura) pixels!!! <br> 
					Tamanho  da imagem tem que ser no máximo 1 Mb</font><br><br>
				</center>';

    echo '</div>';
    ?>
    </body>
    </html>
    <?php
    mysql_close($conexao);
}
?>