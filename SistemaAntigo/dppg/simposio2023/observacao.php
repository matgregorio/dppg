<?php
header('Content-Type: text/html; charset=utf-8');
?>
<head>
    <title> Observação </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/valida_editar_arquivo.js"></script>
    <script src="js/valida_submissao1.js"></script>
    <!-- ---------------------- Tinymce Editor de textos-------------------------- -->
    <script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>

    <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            theme: "modern",
            plugins: [
                "advlist autolink lists charmap hr",
                "searchreplace wordcount fullscreen",
                "save table contextmenu directionality paste textcolor"
            ],
            toolbar1: "undo redo | bold italic underline strikethrough superscript subscript | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
            toolbar2: "forecolor backcolor | fontselect fontsizeselect",
            image_advtab: true,
            templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
            ]
        });
    </script>
    <!-- ----------------------Fim Tinymce Editor de textos-------------------------- -->
</head>
<body>
<div id="conteudo3"><br>
    <?php
    include('includes/config.php');
    session_start();

    if (($_SESSION[logado_simposio_2021])) {
    if ($_POST[submissao] == 'S') {
        $titulo = mysql_real_escape_string($_POST[titulo]);
        $autor2 = mysql_real_escape_string($_POST[autor2]);
        $autor3 = mysql_real_escape_string($_POST[autor3]);
        $autor4 = mysql_real_escape_string($_POST[autor4]);
        $autor5 = mysql_real_escape_string($_POST[autor5]);
        $autor6 = mysql_real_escape_string($_POST[autor6]);
        $autor7 = mysql_real_escape_string($_POST[autor7]);
        $resumo = mysql_real_escape_string($_POST[resumo]);
        $palavra_chave = mysql_real_escape_string($_POST[palavra_chave]);
        $codigopost = mysql_real_escape_string($_POST[codigo]);
        $situacao = "Alteração feita pelo autor";


        $query_update = mysql_query("UPDATE trabalhos SET autor2='$autor2', autor3='$autor3', autor4='$autor4', autor5='$autor5', autor6='$autor6', autor7='$autor7', titulo='$titulo', resumo='$resumo', palavra_chave='$palavra_chave', situacao = '$situacao' WHERE codigo_trab='$codigopost'");

        $item = $_POST[item];
        if (count($item) > 0) {
            $query_delete = mysql_query("DELETE FROM apoio_trabalho WHERE codigo_trabalho='$codigopost'");
            foreach ($item as $cod) {
                $sql_ap = "insert into apoio_trabalho (codigo_apoio, codigo_trabalho) values ('$cod','$codigopost')";
                $res_ap = mysql_query($sql_ap);
            }
        }

        if ($query_update) {
            echo '<br><center><b><font size="2" color="#0000FF">Atualização Realizada com Sucesso.</b></font></center><br>';
        } else {
            echo '<br><center><b><font size="2" color="#FF0000">Erro na Atualização dos dados.</b></font></center><br>';
        }

        echo "<meta http-equiv='refresh' content='2;URL=observacao.php?codigo=$codigopost'/>";
    } else {
    //histórico
    $codigoh = mysql_real_escape_string($_GET[codigo]);

    $sql3 = "select codigo_historico, observacao from historico where codigo_trab = '$codigoh'";
    $resultado3 = mysql_query($sql3);
    ?>
    <table border="0" class="esquerda" width="100%">
        <tr>
            <td align="center"><b><i>Histórico</i></b></td>
        </tr>
        <tr>
            <td align="center"><i>Observação feita pelo Professor Analisador</i></td>
        </tr>
        <?php
        while ($campos3 = mysql_fetch_array($resultado3)) {
            echo '<tr><td align="center"><img src="images/go-next.png" border="0" width="3%"> ' . $campos3[observacao] . '</td></tr>';
        }
        ?>
    </table>
    <hr align="center" width="90%"/>
    <?php
    $sql = "select * from trabalhos where codigo_trab='$codigoh'";
    $resultado = mysql_query($sql);
    $campos = mysql_fetch_array($resultado);

    $query_par = mysql_query("SELECT cpf, nome FROM participantes WHERE cpf!='admin' ORDER BY nome");
    $autor1 = mysql_fetch_array(mysql_query("SELECT cpf, nome FROM participantes WHERE cpf='$campos[autor1]'"));
    if ($campos[autor2]) {
        $autor2 = mysql_fetch_array(mysql_query("SELECT cpf, nome FROM participantes WHERE cpf='$campos[autor2]'"));
    }
    if ($campos[autor3]) {
        $autor3 = mysql_fetch_array(mysql_query("SELECT cpf, nome FROM participantes WHERE cpf='$campos[autor3]'"));
    }
    if ($campos[autor4]) {
        $autor4 = mysql_fetch_array(mysql_query("SELECT cpf, nome FROM participantes WHERE cpf='$campos[autor4]'"));
    }
    if ($campos[autor5]) {
        $autor5 = mysql_fetch_array(mysql_query("SELECT cpf, nome FROM participantes WHERE cpf='$campos[autor5]'"));
    }
    if ($campos[autor6]) {
        $autor6 = mysql_fetch_array(mysql_query("SELECT cpf, nome FROM participantes WHERE cpf='$campos[autor6]'"));
    }
    if ($campos[autor7]) {
        $autor7 = mysql_fetch_array(mysql_query("SELECT cpf, nome FROM participantes WHERE cpf='$campos[autor7]'"));
    }
    ?>
    <br>
    <center><b>Editar Trabalho</b></center>
    <br>

    <form name="form_editar_trabalho" method="post" onsubmit="javascript: return checkcontatos()"
          action="observacao.php">
        <?php
        echo '<input type="hidden" name="codigo" value="' . $codigoh . '">';
        echo '<input type="hidden" name="cpf" value="' . $campos[cpf] . '">';
        ?>
        <table border="0" width="100%">
            <tr>
                <td><b>Titulo:</b></td>
                <?php echo "<td><input type='text' name='titulo' size='60' value='$campos[titulo]' ></td>"; ?>
            </tr>
            <tr>
                <td><b>Autor 1:</b></td>
                <?php echo "<td><input type='text' name='autor1' size='60' value='$autor1[nome]' readonly='true'></td>"; ?>
            </tr>
            <tr>
                <td><b>Autor 2:</b></td>
                <td>
                    <select name="autor2">
                        <option></option>
                        <?php
                        mysql_data_seek($query_par, 0);
                        while ($campos_par = mysql_fetch_array($query_par)) {
                            if ($campos[autor2] == $campos_par[cpf]) {
                                echo "<option value='$campos_par[cpf]' selected>$campos_par[nome]</option>";
                            } else {
                                echo "<option value='$campos_par[cpf]'>$campos_par[nome]</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><b>Autor 3:</b></td>
                <td>
                    <select name="autor3">
                        <option></option>
                        <?php
                        mysql_data_seek($query_par, 0);
                        while ($campos_par = mysql_fetch_array($query_par)) {
                            if ($campos[autor3] == $campos_par[cpf]) {
                                echo "<option value='$campos_par[cpf]' selected>$campos_par[nome]</option>";
                            } else {
                                echo "<option value='$campos_par[cpf]'>$campos_par[nome]</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><b>Autor 4:</b></td>
                <td>
                    <select name="autor4">
                        <option></option>
                        <?php
                        mysql_data_seek($query_par, 0);
                        while ($campos_par = mysql_fetch_array($query_par)) {
                            if ($campos[autor4] == $campos_par[cpf]) {
                                echo "<option value='$campos_par[cpf]' selected>$campos_par[nome]</option>";
                            } else {
                                echo "<option value='$campos_par[cpf]'>$campos_par[nome]</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><b>Autor 5:</b></td>
                <td>
                    <select name="autor6">
                        <option></option>
                        <?php
                        mysql_data_seek($query_par, 0);
                        while ($campos_par = mysql_fetch_array($query_par)) {
                            if ($campos[autor5] == $campos_par[cpf]) {
                                echo "<option value='$campos_par[cpf]' selected>$campos_par[nome]</option>";
                            } else {
                                echo "<option value='$campos_par[cpf]'>$campos_par[nome]</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><b>Autor 6:</b></td>
                <td>
                    <select name="autor7">
                        <option></option>
                        <?php
                        mysql_data_seek($query_par, 0);
                        while ($campos_par = mysql_fetch_array($query_par)) {
                            if ($campos[autor6] == $campos_par[cpf]) {
                                echo "<option value='$campos_par[cpf]' selected>$campos_par[nome]</option>";
                            } else {
                                echo "<option value='$campos_par[cpf]'>$campos_par[nome]</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><b>Autor 7:</b></td>
                <td>
                    <select name="autor7">
                        <option></option>
                        <?php
                        mysql_data_seek($query_par, 0);
                        while ($campos_par = mysql_fetch_array($query_par)) {
                            if ($campos[autor7] == $campos_par[cpf]) {
                                echo "<option value='$campos_par[cpf]' selected>$campos_par[nome]</option>";
                            } else {
                                echo "<option value='$campos_par[cpf]'>$campos_par[nome]</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><b>Palavras Chave:</b></td>
                <?php echo "<td><input type='text' name='palavra_chave' size='60' value='$campos[palavra_chave]' ></td>"; ?>
            </tr>
            <tr>
                <td><b>Apoio</b></td>
                <td>
                    <?php
                    $cons = "select * from apoio";
                    $res = mysql_query($cons);
                    while ($camp = mysql_fetch_array($res)) {
                        $query_apoio = mysql_query("SELECT * FROM apoio_trabalho WHERE codigo_apoio='$camp[codigo_apoio]' AND codigo_trabalho='$codigoh'");
                        if (mysql_num_rows($query_apoio) == 1) {
                            echo '<input type="checkbox" name="item[]" size="1" value="' . $camp[codigo_apoio] . '" checked="true"> ' . $camp[nome] . '<br>';
                        } else {
                            echo '<input type="checkbox" name="item[]" size="1" value="' . $camp[codigo_apoio] . '"> ' . $camp[nome] . '<br>';
                        }
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td><b>Resumo:</b></td>
            </tr>
        </table>
        <center>
            <?php echo "<td><textarea cols='60' name='resumo' rows='20' >$campos[resumo]</textarea></td>"; ?>
        </center>
        <br>
        <center>
            <input type="hidden" name="submissao" value="S">
            <input type="submit" onclick="return confirmar()" value="Salvar">
        </center>
    </form>
    <br>
    <br>
    </center>
</div>
<?php
}
?>
</div>
<?php
}
?>
</body>
</html>