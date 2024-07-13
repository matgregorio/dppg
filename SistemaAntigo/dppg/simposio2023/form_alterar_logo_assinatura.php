<?php

session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Alterar Logo ou Assinatura 2</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/JavaScript" src="js/valida_form_conteudo_certificado.js"></script>

    </head>
    <body>
    <?php
    session_start();

    if ($_SESSION[logado_simposio_2021]) {

        include('includes/config.php');

        $sql = "select  assinatura_certificado from conteudo where codigo_conteudo = '9'";
        $resultado = mysql_query($sql);
        $campos = mysql_fetch_array($resultado);


        echo "<div id='conteudo3'>
				<br>
				<center><b>Alterar Assinatura 2 ou Logo</b><br><br></center>
				<center>
				<br>
				<font color='#FF0000'>Selecione o link Alterar <b>Assinatura 2</b> ou <b>Logo</b> para escolher<br> 
				se na parte direita inferior do certificado constará
				da assinatura <br> do segundo representante do evento ou a logo do Departamento.</font> 
				<br><br>
				Neste momento está sendo utilizado ";

        if ($campos[assinatura_certificado] == 1)
            echo "Assinatura 2";
        else if ($campos[assinatura_certificado] == 2)
            echo "Logo";

        echo " na parte direita inferior do certificado.
				<br><br>
				<a href='form_alterar_assinatura2.php'>Assinatura 2</a><br>
				<a href='form_alterar_certificado_logo.php'>Logo</a>
				<br><br><br>
				</center>
				</div>";

    }

    ?>
    </body>
    </html>
<?php
}
?>