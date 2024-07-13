<!-- Bloco Histórico -->
<?php

include('includes/config.php');
/*$sql = "select codigo_historico, observacao from historico where codigo_trab = '$_GET[codigo]'";
$resultado = mysql_query($sql);

echo '<div id="conteudo3"><br>';

echo '<table border = "0" class = "esquerda" width = "100%">
            <tr>
                <td align="center"><b><i>Histórico</i></b></td>
            </tr>
            <tr>
                <td align="center"><i>Observação feita pelo Professor Analisador</i></td>
            </tr>';

            while($campos = mysql_fetch_array($resultado))
                echo '<tr><td align="center"><img src="images/go-next.png" border="0" width="3%"> '.$campos[observacao].'</td></tr>';

echo '</table>';

echo '<hr align="center" width="90%" />';
*/
?>


<!-- Submissão de trabalhos -->
<?php

if ($_SESSION[logado2]) {
    if ($_POST[submissao] == 'S') {

        /*include('includes/config.php');

        $sql = "select * from trabalhos where codigo_trab='$_POST[codigot]'";
        $resultado = mysql_query($sql);
        $campos = mysql_fetch_array($resultado);

        mysql_data_seek($resultado, 0);

        $dir1 = 'trabalhos/';
        $arquivo1 = $campos[arquivo];
        //Fução para deletar o arquivo de uma pasta, se não deletar dar permissão 777 na pasta trabalhos
        unlink($dir1.$arquivo1);
        */

        echo 'teste';

        //$arq = $_POST[arq_trabalho];

        //echo 	$arq;

        if (eregi('pdf', $_FILES[arq_trabalho][type])) {
            echo 'teste2';
            //$dir = 'trabalhos/';
            //$numero = mt_rand();

            //$arquivo = $numero.'_'.$_FILES[$arq_trabalho][name];
            //echo $arquivo;
            //if (move_uploaded_file($_FILES[arq_trabalho][tmp_name], $dir.$numero.'_'.$_FILES[arq_trabalho][name]))
            //{
            //echo "funcionou";
            /*$situacao = "Alteração feita pelo autor";

            $sql1 = "update trabalhos set situacao = '$situacao', arquivo = '$arquivo' where codigo_trab='$_POST[codigot]'";
            $resultado1 = mysql_fetch_array($sql1);*/
            //echo '<center><b><i>Upload feito com sucesso!!!!</i></b></center>';
            //echo '<meta http-equiv="refresh" content="1; URL=observacao.php?codigo='.$_POST[codigot].'" />';
            //}
        } else {
            echo '<script>alert("Erro!!!"); </script>';
            //echo '<br><center><b>
            //	<font size="2" color="#FF0000">Erro no envio do arquivo.
            //	<br>Tipo de arquivo não suportado.
            //	<br>Envie somente arquivos do tipo PDF.</b></font></center>';
            //	echo 'erro';
            //		echo '<meta http-equiv="refresh" content="1; URL=observacao.php?codigo='.$_POST[codigot].'" />';
        }
    }
}
?>


<?php

$sql1 = "select * from trabalhos where codigo_trab='$_GET[codigo]'";
$resultado1 = mysql_query($sql1);

$cont = 0;

while ($campos1 = mysql_fetch_array($resultado1)) {
    echo '
				<form name="observacao' . $cont . '" method="post" action="observacao.php">
				<table class="esquerda" border="0" width="100%">
				<tr>
					<td align="center">Arquivo</td>
				</tr>			
				<tr>
            	<td align="center">
            		<input name="arq_trabalho" type="file">
            		<font color="#FF0000"><br>*</font> Somente arquivo PDF
            	</td>		
				</tr>
				<tr>
					<input type="hidden" name="submissao" value="S">				
					<input type="hidden" name="codigot" value="' . $_GET[codigo] . '">
					<td align="center"><input type="submit" value="Enviar"></td>
				</tr> 			
				<tr>
					<td align="center"><font color="#FF0000"><i>Faça o Upload do arquivo para que o professor analisador faça a análise novamente.</i></fonte></td>
				</tr>
				</table>
				</form>';

    $cont++;
}

echo '</div>';
?>
