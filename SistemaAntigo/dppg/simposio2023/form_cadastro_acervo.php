<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Cadastro Acervo </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/valida_cadastro_acervo.js" type="text/javascript"></script>
        <script type="text/javascript" src="/js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript">
            function mostrarIC(val) {
                if (val == "S") {
                    document.getElementById("tipoIC").style.display = '';
                } else {
                    document.getElementById("tipoIC").style.display = 'none';
                }
            }
        </script>
        <script type="text/javascript">
            function alterar_tipo(tipo) {
                if (tipo == 'i') {
                    document.getElementById('todos').style.display = 'none';
                    document.getElementById('individual').style.display = '';
                } else {
                    document.getElementById('todos').style.display = '';
                    document.getElementById('individual').style.display = 'none';
                }
            }
        </script>
        <script type="text/javascript">
            function cadastrar_acervo(ano) {
                if (ano < 6) {
                    document.getElementById("escondido2").style.display = "";
                    document.getElementById("escondido1").style.display = "none";
                    document.getElementById("escondido").style.display = "none";
                } else if (ano == 6) {
                    document.getElementById("escondido2").style.display = "none";
                    document.getElementById("escondido1").style.display = "none";
                    document.getElementById("escondido").style.display = "";
                } else if (ano > 6) {
                    document.getElementById("escondido2").style.display = "none";
                    document.getElementById("escondido").style.display = "none";
                    document.getElementById("escondido1").style.display = "";
                }
            }
        </script>
        <script language="javascript">
            function list_orientador(valor) {
                http.open("GET", "combo_orientador.php?id=" + valor, true);
                http.onreadystatechange = handleHttpResponse;
                http.send(null);
            }
            function handleHttpResponse() {
                campo_select = document.forms[0].orientador;
                if (http.readyState == 4) {
                    campo_select.options.length = 0;
                    results = http.responseText.split(",");
                    for (i = 0; i < results.length; i++) {
                        string = results[i].split("|");
                        campo_select.options[i] = new Option(string[0], string[1]);
                    }
                }
            }
            function getHTTPObject() {
                var req;
                try {
                    if (window.XMLHttpRequest) {
                        req = new XMLHttpRequest();
                        if (req.readyState == null) {
                            req.readyState = 1;
                            req.addEventListener("load", function () {
                                req.readyState = 4;
                                if (typeof req.onReadyStateChange == "function")
                                    req.onReadyStateChange();
                            }, false);
                        }
                        return req;
                    }

                    if (window.ActiveXObject) {
                        var prefixes = ["MSXML2", "Microsoft", "MSXML", "MSXML3"];
                        for (var i = 0; i < prefixes.length; i++) {
                            try {
                                req = new ActiveXObject(prefixes[i] + ".XmlHttp");
                                return req;
                            } catch (ex) {
                            }
                            ;
                        }
                    }
                } catch (ex) {
                }
                alert("XmlHttp Objects not supported by client browser");
            }
            var http = getHTTPObject();
        </script>
        <!-- ---------------------- Tinymce Editor de textos-------------------------- -->
        <script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
        <script language="javascript" type="text/javascript">
            tinyMCE.init({
                // General options
                mode: "textareas",
                theme: "advanced",
                plugins: "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
                // Theme options
                theme_advanced_buttons1: "bold,italic,underline,strikethrough,|,styleselect,formatselect,fontselect,fontsizeselect",
                theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,forecolor,backcolor,|,absolute,cite,abbr,acronym,del,ins",
                theme_advanced_buttons3: "tablecontrols,|,hr,|,sub,sup,|,charmap,|,fullscreen",
                theme_advanced_toolbar_location: "top",
                theme_advanced_toolbar_align: "left",
                //theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing: true,
                // Example content CSS (should be your site CSS)
                content_css: "css/content.css",
                // Drop lists for link/image/media/template dialogs           template_external_list_url: "lists/template_list.js",
                external_link_list_url: "lists/link_list.js",
                external_image_list_url: "lists/image_list.js",
                media_external_list_url: "lists/media_list.js",
                // Style formats
                style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ],
                // Replace values for the template plugin
                template_replace_values: {
                    username: "Some User",
                    staffid: "991234"
                }
            });
        </script>
    </head>
    <body>
    <div id="conteudo2"><br>
        <center><b>Cadastro Acervo</b></center>
        <br>
        <?php
        if ($_POST[envio] == "S") { //quando o botão de cadastro é acionado
            include("includes/config.php");
            $condicao = mysql_real_escape_string($_POST[tipo]); //determina se é para mandar os arquivos individualmente ou todos
            $ano = mysql_real_escape_string($_POST[ano]);
            mysql_close($conexao);
            if ($ano <= 6) {
                include("../simposio2013/includes/config.php");
            } else {
                include('./includes/config.php');
            }
            if ($ano < 6) {//cadastro de trabalhos do ano de 2008 até 2012
                //se o ano for superior ao ano de 2013 a submição individual deve ser diferente
                $sql1 = "select * from ano where codigo_ano = '$ano'";
                $resultado1 = mysql_query($sql1);
                $campos1 = mysql_fetch_array($resultado1);
                $path = "acervo/";
                $diretorio = dir($path);
                chmod('acervo/', 0777);
                $pasta = $campos1[ano];
                mkdir("acervo/$pasta");
                while ($arquivo = $diretorio->read()) {
                    //mkdir("acervo/$pasta");
                    chmod("acervo/$pasta", 0777);
                    if ($arquivo != "." && $arquivo != "..") {
                        if ($arquivo == "$campos1[ano]") {
                            $extensao = "pdf";
                            $file = $_FILES['arq']['type'];
                            if (eregi($extensao, $file)) {
                                //recebendo o ano
                                $dir = $arquivo;
                                $numero = mt_rand();
                                $file = "Artigo.pdf";
                                //$arquivo1 = $path.$dir.'/'.$numero.'_'.$_FILES[arq][name];
                                //$arquivo2 = $numero.'_'.$_FILES[arq][name];
                                $arquivo1 = $path . $dir . '/' . $numero . '_' . $file;
                                $arquivo2 = $numero . '_' . $file;
                                if (move_uploaded_file($_FILES[arq][tmp_name], $arquivo1)) {
                                    $palavra = mysql_real_escape_string($_POST[palavra]);
                                    $titulo = mysql_real_escape_string($_POST[titulo]);
                                    $autores = mysql_real_escape_string($_POST[autores]);
                                    $ano = mysql_real_escape_string($_POST[ano]);
                                    $sql2 = "insert into acervo (codigo_acervo, arquivo, palavra_chave, titulo, autores, codigo_ano) values ('','$arquivo2', '$palavra', '$titulo', '$autores', '$ano')";
                                    $resultado2 = mysql_query($sql2);
                                    echo '<center><font color="#006400"><b>Cadastro feito com sucesso!!!</b></font></center>';
                                    echo '<meta http-equiv="refresh" content="3; URL=form_cadastro_acervo.php" />';
                                }
                            } else
                                echo '<br><center><b>
                    <font color="#FF0000"><b>Erro no envio do arquivo.
                    <br>Tipo de arquivo não suportado.<br>Envie somente arquivos do tipo PDF.</b>
                    </font></b></center>';
                        }
                    }
                }
                $diretorio->close();
            } else {
                if ($condicao == "i") {
                    $situacao = "ca";
                    $aprovado = "1";

                    $titulo = mysql_real_escape_string($_POST[titulo]);
                    $cpf_autor1 = mysql_real_escape_string($_POST[autor1]);
                    $cpf_autor2 = mysql_real_escape_string($_POST[autor2]);
                    $cpf_autor3 = mysql_real_escape_string($_POST[autor3]);
                    $cpf_autor4 = mysql_real_escape_string($_POST[autor4]);
                    $cpf_autor5 = mysql_real_escape_string($_POST[autor5]);
                    $cpf_autor6 = mysql_real_escape_string($_POST[autor6]);
                    $cpf_autor7 = mysql_real_escape_string($_POST[autor7]);
                    $tipo_submissao = mysql_real_escape_string($_POST[tipo_submissao]);

                    $modalidade = mysql_real_escape_string($_POST[modalidade]); //informa se é iniciação ou não
                    $tipoIniciacao = mysql_real_escape_string($_POST[tipoIniciacao]);

                    $subarea = mysql_real_escape_string($_POST[subarea]);
                    $cpfanalisador = mysql_real_escape_string($_POST[orientador]);
                    $resumo = mysql_real_escape_string($_POST[resumo]);
                    $palavra_chave = mysql_real_escape_string($_POST[palavrachave]);

                    $sql = "INSERT INTO trabalhos (codigo_trab, situacao, autor1, autor2, autor3, autor4, autor5, autor6, autor7, tipo_iniciacao, cpf_prof_analisador, titulo, resumo, palavra_chave, modalidade, codigo_sa, cpf, aprovado, acervo) VALUES ('', '$situacao', '$cpf_autor1', '$cpf_autor2', '$cpf_autor3', '$cpf_autor4', '$cpf_autor5', '$cpf_autor6','$cpf_autor7', '$tipoIniciacao', '$cpfanalisador', '$titulo', '$resumo', '$palavra_chave', '$modalidade', '$subarea' , '$cpf_autor1', '$aprovado', '1')";
                    $res = mysql_query($sql);

                    if ($res) {
                        $sql_trab = "select MAX(codigo_trab) as codigo_trab from trabalhos";
                        $res_trab = mysql_query($sql_trab);
                        $camp_trab = mysql_fetch_array($res_trab);
                        $item = $_POST[item];
                        foreach ($item as $cod) {
                            $sql_ap = "insert into apoio_trabalho (codigo_apoio, codigo_trabalho) values ('$cod','$camp_trab[codigo_trab]')";
                            $res_ap = mysql_query($sql_ap);
                        }
                    }
                    // falta colocar o trabalho na tabela acervo junto ao codigo do ano e do trabalho
                    $codigo_trabalho_i = mysql_fetch_array(mysql_query("SELECT codigo_trab FROM trabalhos WHERE situacao='ca'"));
                    if ($query_acervo_i = mysql_query("INSERT INTO acervo (codigo_ano, codigo_trab) VALUES ('$ano', '$codigo_trabalho_i[codigo_trab]')")) {
                        $query_trabalhos = mysql_query("UPDATE trabalhos SET acervo='1', situacao='Aprovado' WHERE codigo_trab='$codigo_trabalho_i[codigo_trab]'");
                        echo "<center><font color='#006400'><b>Trabalho inserido no acervo com sucesso!!!</b></font></center>";
                    }
                    //
                } else if ($condicao == "t") {
                    $sql_ano = "select * from ano where codigo_ano = '$ano'"; //pega o ano referente ao código escolhido
                    $resultado_ano = mysql_query($sql_ano);
                    $campos_ano = mysql_fetch_array($resultado_ano);

                    $query_trabalhos = "SELECT trabalhos.codigo_trab, sub_area.nome_sa FROM sub_area ,trabalhos WHERE trabalhos.codigo_sa=sub_area.codigo_sa AND trabalhos.aprovado='1' AND trabalhos.aprovado_ext='1' AND trabalhos.acervo='0'";
                    $resultado_trabalhos = mysql_query($query_trabalhos);
                    $cont = 0; //conta quantos trabalhos foram copiados
                    while ($campos_trabalhos = mysql_fetch_array($resultado_trabalhos)) {
                        if ($query_acervo = mysql_query("INSERT INTO acervo (codigo_ano, codigo_trab) VALUES ('$ano', '$campos_trabalhos[codigo_trab]')")) {
                            $query_trabalhos = mysql_query("UPDATE trabalhos SET acervo='1' WHERE codigo_trab='$campos_trabalhos[codigo_trab]'");
                            $cont++;
                        }
                    }
                    echo "<center><font color='#006400'><b>$cont trabalhos copiados para o acervo de $campos_ano[ano]!!!</b></font></center>";
                }
            }
            echo '<meta http-equiv="refresh" content="3; URL=form_cadastro_acervo.php">';
            mysql_close($conexao);
        }
        include("includes/config.php");
        //query para montar a combo de anos
        $sql_ano = "SELECT * FROM ano ORDER BY ano ASC";
        $resultado_ano = mysql_query($sql_ano);

        //        $sql = "select trabalhos.*, sub_area.nome_sa, modalidade.nome_modalidade from sub_area, trabalhos, modalidade where trabalhos.cod_modalidade=modalidade.cod_modalidade and trabalhos.codigo_sa=sub_area.codigo_sa and trabalhos.aprovado='1' and trabalhos.acervo='0' order by sub_area.nome_sa, trabalhos.titulo";
        //        $resultado = mysql_query($sql);
        //        $result_autores = mysql_query("SELECT cpf, nome FROM participantes WHERE cpf!='admin' ORDER BY nome");
        ?>
        <form name="form_cadastro_acervo" method="post" onsubmit="javascript: return checkcontatos()"
              action="form_cadastro_acervo.php" enctype="multipart/form-data">
            <center>
                Ano:
                <select id="ano" name="ano" size="1" onchange="script : cadastrar_acervo(this.value)">
                    <?php
                    while ($campos_ano = mysql_fetch_array($resultado_ano)) {
                        echo "<option value='$campos_ano[codigo_ano]'>$campos_ano[ano]</option>";
                    }
                    ?>
                </select><font color="#FF0000"> *</font>
                <br>
                <hr>
                <div id="escondido1" style="display: none;"><?php include('form_cadastro_acervo2015.php') ?></div>
                <div id="escondido"
                     style="display: none;"><?php include('../simposio2013/form_cadastro_acervo2013.php') ?></div>
                <div id="escondido2" style="display: none;"><?php include('form_cadastro_acervo_old.php') ?></div>
        </form>
        <script type="text/javascript">
            var a = document.getElementById('ano').value;
            cadastrar_acervo(a);
        </script>
        </center>
    </div>
    </body>
    </html>
    <?php
    mysql_close($conexao);
}
?>