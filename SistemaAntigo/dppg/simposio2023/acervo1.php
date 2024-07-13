<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
<head>

    <script type="text/javascript">
        jQuery.fn.toggleText = function (a, b) {
            return this.html(this.html().replace(new RegExp("(" + a + "|" + b + ")"), function (x) {
                return (x == a) ? b : a;
            }));
        }

        $(document).ready(function () {
            $('.tgl').css('display', 'none')
            $('span', '#box-toggle').click(function () {
                $(this).next().slideToggle('slow')
                    .siblings('.tgl:visible').slideToggle('fast');

                $(this).toggleText('plus', 'minus')
                    .siblings('span').next('.tgl:visible').prev()
                    .toggleText('plus', 'minus')
            });
        })
    </script>
</head>
<body>
<div id="box-toggle">
    <?php
    include('includes/config.php');
    $ano = mysql_real_escape_string($_POST[ano]);
    if ($ano != "") {
        $sql1 = "select * from ano where codigo_ano='$ano'";
        $resultado1 = mysql_query($sql1);
        $campos1 = mysql_fetch_array($resultado1);
        if ($ano >= 6) {//permissão para os anos de 2013 para cima
            $palavra = mysql_real_escape_string($_POST[palavra]);
            $titulo = mysql_real_escape_string($_POST[titulo]);
            $autor1 = mysql_real_escape_string($_POST[autor]);
            $palavra_chave = mysql_real_escape_string($_POST[palavra_chave]);

            $sql_trab = "SELECT a.codigo_trab, a.codigo_ano, a.codigo_acervo, t.* FROM acervo AS a, trabalhos AS t WHERE a.codigo_ano='$ano' AND (t.titulo LIKE '%$titulo%' AND t.palavra_chave LIKE '%$palavra%' AND t.autor1 LIKE '%$autor1%' AND t.acervo='1') ORDER BY t.titulo";
            $query_trab = mysql_query($sql_trab);

            if (mysql_num_rows($query_trab) > 0) {
                ?>
                <center><br><b>Resultado Acervo de <?php echo "<b>$campos1[ano]</b>"; ?></b><br><br></center>
                <font><b><u>Título:</u></b></font>
                <?php
                $cor = "#95e197";
                while ($campos = mysql_fetch_array($query_trab)) {
                    $titulo = strtr(strtoupper($campos[titulo]), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
                    $resumo = str_replace("<p>", "", $campos[resumo]);
                    $resumo = str_replace("</p>", "", $resumo);
                    $resumo = "<p>$resumo</p>";
                    echo "<span><p><img src='images/plus.gif' /> <b>$titulo</b></p></span>";
                    $autor1 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor1]'"));
                    if ($campos[autor2]) {
                        $autor2 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor2]'"));
                    }
                    if ($campos[autor3]) {
                        $autor3 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor3]'"));
                    }
                    if ($campos[autor4]) {
                        $autor4 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor4]'"));
                    }
                    if ($campos[autor5]) {
                        $autor5 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor5]'"));
                    }
                    if ($campos[autor6]) {
                        $autor6 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor6]'"));
                    }
                    if ($campos[autor7]) {
                        $autor7 = mysql_fetch_array(mysql_query("SELECT nome FROM participantes WHERE cpf='$campos[autor7]'"));
                    }
                    $texto1 = $autor1[nome];
                    if ($autor2 != '') {
                        $texto1 = $texto1 . ', ' . $autor2[nome];
                    }
                    if ($autor3 != '') {
                        $texto1 = $texto1 . ', ' . $autor3[nome];
                    }
                    if ($autor4 != '') {
                        $texto1 = $texto1 . ', ' . $autor4[nome];
                    }
                    if ($autor5 != '') {
                        $texto1 = $texto1 . ', ' . $autor5[nome];
                    }
                    if ($autor6 != '') {
                        $texto1 = $texto1 . ', ' . $autor6[nome];
                    }
                    if ($autor7 != '') {
                        $texto1 = $texto1 . ', ' . $autor7[nome];
                    }
                    $result_apoios = mysql_query("SELECT apoio.nome FROM apoio, apoio_trabalho, trabalhos WHERE apoio.codigo_apoio=apoio_trabalho.codigo_apoio AND apoio_trabalho.codigo_trabalho='$campos[codigo_trab]'");
                    $cont = 0;
                    while ($campos_apoio = mysql_fetch_array($result_apoios)) {
                        if ($cont == 0) {
                            $apoios = $campos_apoio[nome];
                            $cont++;
                        } else {
                            $apoios = "$apoios - $campos_apoio[nome]";
                        }
                    }
                    ?>
                    <div class="tgl">
                        <br>
                        <b><u>Autor(es):</u></b><br><br><?php echo $texto1; ?><br><br>
                        <b><u>Resumo:</u></b><br>
                        <?php echo $resumo; ?><br>
                        <b><u>Palavra Chave:</u></b> <?php echo "$campos[palavra_chave]"; ?><br><br>
                        <b><u>Apoio(s):</u></b><br><br>
                        <?php echo "$apoios"; ?><br><br>
                        IF Sudeste MG – Campus Rio Pomba<br><br>
                        <?php echo "<a href='gerar_pdf_trabalhos.php?codigot=$campos[codigo_trab]' target='_blanck' align='rigth'><img src='images/pdf.png'> Gerar PDF</a>"; ?>
                    </div>
                    <hr>
                <?php
                }
                mysql_close($conexao);
            } else {
                echo '<br><center><i>Nenhum registro encontrado!!!</i></center><br>';
            }
        } else {
            include 'acervo.php';
        }
    } else {
        ?>
        <br><br>
        <center><b>Ano não informado!</b></center>
        <br><br>
        <meta http-equiv="refresh" content="3; URL=simposio.php?arquivo2=form_acervo.php"/>
    <?php
    }

    ?>
</div>
</body>
</html>
