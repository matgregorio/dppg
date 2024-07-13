<?php
header('Content-Type: text/html; charset=utf-8');
?>
<title> Observação </title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php

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

    /*echo 'teste';

    $arq = $_POST[arq_trabalho];

    echo 	$arq;

    if(eregi('.pdf', $_FILES[arquivo][type]))
    {
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
    /*}
    else
    {*/
    //echo '<br><center><b>
    //	<font size="2" color="#FF0000">Erro no envio do arquivo.
    //	<br>Tipo de arquivo não suportado.
    //	<br>Envie somente arquivos do tipo PDF.</b></font></center>';
    //		echo 'erro';
    //		echo '<meta http-equiv="refresh" content="1; URL=observacao.php?codigo='.$_POST[codigot].'" />';
    //}
}
?>

</body>
</html>