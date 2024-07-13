<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
if (in_array("1", $_SESSION[codigo_grupo])) {
    ?>
  <title> Resumo </title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="js/valida_editar_arquivo.js"></script>
  <script type="text/javascript" src="js/prototype.js"></script>
  <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
  <script type="text/javascript" src="js/scriptaculous.js?load=effects"></script>
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
            req.addEventListener("load", function() {
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
    $(document).ready(
            function() {
              $('#pchave').ready(
                      function() {
                        var id = document.getElementById('sa').value;
                        list_orientador(id);
                        id = document.getElementById('m').value;
                        mostrarIC(id);
                      }
              );
            }
    );
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
      theme_advanced_buttons1: "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
      theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help",
      theme_advanced_buttons3: "insertdate,inserttime,preview,|,forecolor,backcolor,|,insertlayer,moveforward,movebackward,absolute,,cite,abbr,acronym,del,ins,|,visualchars",
      theme_advanced_buttons4: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,|,ltr,rtl,|,fullscreen",
      theme_advanced_toolbar_location: "top",
      theme_advanced_toolbar_align: "left",
      //theme_advanced_statusbar_location : "bottom",
      theme_advanced_resizing: true,
      // Example content CSS (should be your site CSS)
      content_css: "css/content.css",
      // Drop lists for link/image/media/template dialogs
      template_external_list_url: "lists/template_list.js",
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
    <?php
    include('includes/config.php');
    $codigopost = mysql_real_escape_string($_GET[c]);
    if ($_POST[submissao] == 'S') {
        ?>
        <div id="conteudo3" width="300">
            <?php
            $titulo = mysql_real_escape_string($_POST[titulo]);
            $autor2 = mysql_real_escape_string($_POST[autor2]);
            $autor3 = mysql_real_escape_string($_POST[autor3]);
            $autor4 = mysql_real_escape_string($_POST[autor4]);
            $autor5 = mysql_real_escape_string($_POST[autor5]);
            $autor6 = mysql_real_escape_string($_POST[autor6]);
            $autor7 = mysql_real_escape_string($_POST[autor7]);
            $resumo = mysql_real_escape_string($_POST[resumo]);
            $palavra_chave = mysql_real_escape_string($_POST[palavra_chave]);
            $tipo_iniciacao = mysql_real_escape_string($_POST[tipoIniciacao]);
            $modalidade = mysql_real_escape_string($_POST[modalidade]);
            $subarea = mysql_real_escape_string($_POST[subarea]);
            $orientador = mysql_real_escape_string($_POST[orientador]);
            $codigopost = mysql_real_escape_string($_POST[codigo]);
            $apresentador = mysql_real_escape_string($_POST[apresentador]);

            $query_update = mysql_query("UPDATE trabalhos SET autor2='$autor2', autor3='$autor3', autor4='$autor4', autor5='$autor5', autor6='$autor6', autor7='$autor7', titulo='$titulo', resumo='$resumo', palavra_chave='$palavra_chave', cpf_prof_analisador='$orientador', modalidade='$modalidade', codigo_sa='$subarea', tipo_iniciacao='$tipo_iniciacao', apresentador='$apresentador' WHERE codigo_trab='$codigopost'");

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

            echo "<meta http-equiv='refresh' content='2;URL=form_selecionar_acervo.php'/>";
            ?>
        </div>
    <?php
    } else {

        $query_par = mysql_query("SELECT cpf, nome FROM participantes WHERE cpf!='admin' ORDER BY nome");

        $sql = "select * from trabalhos where codigo_trab='$codigopost'";
        $resultado = mysql_query($sql);
        $campos = mysql_fetch_array($resultado);

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
        ?>
      <div id="conteudo3">
        <?php echo "<br><center><b>Editar Trabalho</b></center>"; ?>
        <br>
        <form name="form_editar_trabalho" method="post" onsubmit="javascript: return checkcontatos()" action="form_alterar_acervo_new.php">
          <?php echo "<input type='hidden' name='codigo' value='$codigopost'>"; ?>
          <table border="0"  width="100%">
            <tr>
              <td><b>Titulo:</b></td>
              <?php echo "<td><input type='text' name='titulo' size='60' value='$campos[titulo]' >"; ?>
              </td>
            </tr>
            <tr>
              <td><b>Autor 1:</b></td>
              <td>
              	<?php
        echo "<input type='text' name='autor1' size='40' value='$autor1[nome]' readonly='true'>";
        if ($campos[apresentador] == 1) {
            echo '<input type="radio" name="apresentador" value="1" checked="true"> Apresentador';
        } else {
            echo '<input type="radio" name="apresentador" value="1"> Apresentador';
        }
        ?>
              </td>              
            </tr>
            <tr>
              <td><b>Autor 2:</b></td>
              <td>
                <select name="autor2" style="width:280px">
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
                <?php
        if ($campos[apresentador] == 2) {
            echo '<input type="radio" name="apresentador" value="2" checked="true"> Apresentador';
        } else {
            echo '<input type="radio" name="apresentador" value="2"> Apresentador';
        }
        ?>
              </td>
            </tr>
            <tr>
              <td><b>Autor 3:</b></td>
              <td>
                <select name="autor3" style="width:280px">
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
                <?php
        if ($campos[apresentador] == 3) {
            echo '<input type="radio" name="apresentador" value="3" checked="true"> Apresentador';
        } else {
            echo '<input type="radio" name="apresentador" value="4"> Apresentador';
        }
        ?>
              </td>
            </tr>
            <tr>
              <td><b>Autor 4:</b></td>
              <td>
                <select name="autor4" style="width:280px">
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
                <?php
        if ($campos[apresentador] == 4) {
            echo '<input type="radio" name="apresentador" value="4" checked="true"> Apresentador';
        } else {
            echo '<input type="radio" name="apresentador" value="4"> Apresentador';
        }
        ?>
              </td>
            </tr>
            <tr>
              <td><b>Autor 5:</b></td>
              <td>
                <select name="autor5" style="width:280px">
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
                <?php
        if ($campos[apresentador] == 5) {
            echo '<input type="radio" name="apresentador" value="5" checked="true"> Apresentador';
        } else {
            echo '<input type="radio" name="apresentador" value="5"> Apresentador';
        }
        ?>
              </td>
            </tr>
            <tr>
              <td><b>Autor 6:</b></td> 
              <td>
                <select name="autor6" style="width:280px">
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
                <?php
        if ($campos[apresentador] == 6) {
            echo '<input type="radio" name="apresentador" value="6" checked="true"> Apresentador';
        } else {
            echo '<input type="radio" name="apresentador" value="6"> Apresentador';
        }
        ?>
              </td>
            </tr>
            <tr>
              <td><b>Autor 7:</b></td>
              <td>
                <select name="autor7" style="width:280px">
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
                <?php
        if ($campos[apresentador] == 7) {
            echo '<input type="radio" name="apresentador" value="7" checked="true"> Apresentador';
        } else {
            echo '<input type="radio" name="apresentador" value="7"> Apresentador';
        }
        ?>
              </td>
            </tr>
            <tr>
            <tr></tr>
            <tr>
              <td><b>Este resumo refere-se ao seu projeto de Iniciação Científica?</b></td>
              <td>
                <?php
        echo "<input type='hidden' id='m' value='$campos[modalidade]'>";
        if ($campos[modalidade] == "N") {
            echo '<input type="radio" onclick="script : mostrarIC(this.value)" onchange="script : mostrarIC(this.value)" name="modalidade" value="S">Sim';
            echo '<input type="radio" onclick="script : mostrarIC(this.value)" onchange="script : mostrarIC(this.value)" name="modalidade" value="N" checked="true">Não';
        } else {
            echo '<input type="radio" onclick="script : mostrarIC(this.value)" onchange="script : mostrarIC(this.value)" name="modalidade" value="S"checked="true" >Sim';
            echo '<input type="radio" onclick="script : mostrarIC(this.value)" onchange="script : mostrarIC(this.value)" name="modalidade" value="N" >Não';
        }
        ?>
              </td>
            </tr>
            <tr><br></tr>
            <tr id="tipoIC" style="display: none">
              <td><b>Qual Modalidade?</b></td>
              <td>
                <?php
        if ($campos[tipo_iniciacao] == "G") {
            echo '<input type="radio" name="tipoIniciacao" value="T" >Técnico';
            echo '<input type="radio" name="tipoIniciacao" value="G" checked="true">Graduação';
            echo '<input type="radio" name="tipoIniciacao" value="M">Mestrado';
        } else if ($campos[tipo_iniciacao] == "M") {
            echo '<input type="radio" name="tipoIniciacao" value="T">Técnico';
            echo '<input type="radio" name="tipoIniciacao" value="G">Graduação';
            echo '<input type="radio" name="tipoIniciacao" value="M" checked="true">Mestrado';
        }else {
            echo '<input type="radio" name="tipoIniciacao" value="T" checked="true">Técnico';
            echo '<input type="radio" name="tipoIniciacao" value="G">Graduação';
            echo '<input type="radio" name="tipoIniciacao" value="M">Mestrado';
        }
        ?>
              </td>
            </tr>
            <tr><br></tr>
            <tr>
              <td><b>Subárea</b></td>
              <td>
                <select id="sa" name="subarea" onchange="list_orientador(this.value)">
                  <?php
        $sql1 = "select * from sub_area order by nome_sa asc";
        $resultado1 = mysql_query($sql1);
        while ($campos1 = mysql_fetch_array($resultado1)) {
            if ($campos[codigo_sa] == $campos1[codigo_sa]) {
                echo "<option value='$campos1[codigo_sa]' selected>$campos1[nome_sa]</option>";
            } else {
                echo "<option value='$campos1[codigo_sa]'>$campos1[nome_sa]</option>";
            }
        }
        ?>
                </select><font color="#FF0000"> *</font></td>
            </tr>
            <tr>
              <td><b>Orientador:</b></td>
              <td><select name="orientador"></select><font color="#FF0000"> *</font></td>
            </tr>
            <tr>
              <td><b>Palavras Chave:</b></td>
              <?php echo "<td><input type='text' id='pchave' name='palavra_chave' size='60' value='$campos[palavra_chave]' ></td>"; ?>
            </tr>
            <tr>
              <td><b>Apoio</b></td>
              <td>
                <?php
        $cons = "select * from apoio";
        $res = mysql_query($cons);
        while ($camp = mysql_fetch_array($res)) {
            $query_apoio = mysql_query("SELECT * FROM apoio_trabalho WHERE codigo_apoio='$camp[codigo_apoio]' AND codigo_trabalho='$codigopost'");
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
            <input type="submit"  onclick="return confirmar()" value="Salvar">
          </center>
        </form>
        <br>
        <br>
        </center>		
      </div>
    </body>
    </html>
    <?php
    }
}
?>