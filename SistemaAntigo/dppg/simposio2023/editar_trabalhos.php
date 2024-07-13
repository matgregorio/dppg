<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo]) || in_array("2", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
  <title> Resumo </title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="js/valida_editar_arquivo.js"></script>
  <script type="text/javascript" src="js/prototype.js"></script>
  <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
  <script type="text/javascript" src="js/scriptaculous.js?load=effects"></script>
  <script type="text/javascript">
    // function mostrarIC(val) {
    //   if (val == "S") {
    //     document.getElementById("tipoIC").style.display = '';
    //   } else {
    //     document.getElementById("tipoIC").style.display = 'none';
    //   }
    // }

    function mostrarICtipo(val)
    {
      if (val == "Pes") {
        document.getElementById("tipo").style.display = '';
      //   document.getElementById("tipoIC").style.display = '';
      } else {
        document.getElementById("tipo").style.display = 'none';
        document.getElementById("tipoICA").style.display = 'none';
        document.getElementById("tipoICB").style.display = 'none';
      }
    }

    function mostrarTipo(val)
    {
        if (val == "S") {
          document.getElementById("tipoICA").style.display = '';
          document.getElementById("tipoICB").style.display = 'none';

      }else {
          document.getElementById("tipoICA").style.display = 'none';
          document.getElementById("tipoICB").style.display = '';
          }
    }
  </script>
  <script language="javascript">
    function GetXmlHttpObject() {
      var xmlHttp = null;
      try {
        xmlHttp = new XMLHttpRequest();
      } catch (e) {
        try {
          xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
          xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
      }
      return xmlHttp;
    }

    function list_orientador(valor) {
      xmlHttp = GetXmlHttpObject();
      if (xmlHttp == null) {
        alert("Este Browser não suporta HTTP Request");
        return;
      }
      var codigo = document.getElementById("codigo").value;
      var url = "combo_editar_orientador.php?id=" + valor + "&c=" + codigo;
      xmlHttp.open("POST", url);
      xmlHttp.onreadystatechange = mostrar_autor;
      xmlHttp.send(null);
    }

    function mostrar_autor() {
      if (xmlHttp.readyState == 4) {
        document.getElementById("mOrientador").innerHTML = xmlHttp.responseText;
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
  </head>
  <body>
    <?php
    include('includes/config.php');
    $codigopost = mysql_real_escape_string($_GET[codigo]);
    if ($_POST[submissao] == 'S')
    {
        ?>
        <div id="conteudo3" width="300">
            <?php
            //strip_tags($campos[resumo]) remove todas as tags html

            $titulo = mysql_real_escape_string($_POST[titulo]);
            $autor2 = mysql_real_escape_string($_POST[autor2]);
            $autor3 = mysql_real_escape_string($_POST[autor3]);
            $autor4 = mysql_real_escape_string($_POST[autor4]);
            $autor5 = mysql_real_escape_string($_POST[autor5]);


            /*Em 2020 foram reduzidos de 6 coautores para 4 coautores*/
            // $autor6 = mysql_real_escape_string($_POST[autor6]);
            $autor6 = "";

            //$autor7 = mysql_real_escape_string($_POST[autor7]);
            $autor7 = "";

            $resumo = mysql_real_escape_string($_POST[resumo]);
            $apresentador = mysql_real_escape_string($_POST[apresentador]);

            //        $resumo = strip_tags($resumo);
            $resumo = htmlspecialchars($resumo, ENT_QUOTES);//codifica o html para o banco ler

            $palavra_chave = mysql_real_escape_string($_POST[palavra_chave]);

            $tipoProjeto = mysql_real_escape_string($_POST[tipoProjeto]);/*Pesquisa, Extensão, Educação*/
            $modalidade = mysql_real_escape_string($_POST[modalidade]); //informa se é iniciação ou não
            $tipoIniciacao = mysql_real_escape_string($_POST[tipoIniciacao]);

            $subarea = mysql_real_escape_string($_POST[subarea]);
            $orientador = mysql_real_escape_string($_POST[orientador]);
            $codigopost = mysql_real_escape_string($_POST[codigo]);

            if ($tipoProjeto == "Pes") {
                $query_update = mysql_query("UPDATE trabalhos SET autor2='$autor2', autor3='$autor3', autor4='$autor4', autor5='$autor5', autor6='$autor6', autor7='$autor7', titulo='$titulo', resumo='$resumo', palavra_chave='$palavra_chave', cpf_prof_analisador='$orientador',tipo_projeto ='$tipoProjeto' , modalidade='$modalidade', tipo_iniciacao='$tipoIniciacao', codigo_sa='$subarea', apresentador='$apresentador' WHERE codigo_trab='$codigopost'");
            } else {
                $query_update = mysql_query("UPDATE trabalhos SET autor2='$autor2', autor3='$autor3', autor4='$autor4', autor5='$autor5', autor6='$autor6', autor7='$autor7', titulo='$titulo', resumo='$resumo', palavra_chave='$palavra_chave', cpf_prof_analisador='$orientador',tipo_projeto ='$tipoProjeto' , modalidade='0', tipo_iniciacao='0', codigo_sa='$subarea', apresentador='$apresentador' WHERE codigo_trab='$codigopost'");
            }

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

            echo "<meta http-equiv='refresh' content='2;URL=editar_trabalhos.php?codigo=$codigopost'/>";
            ?>
        </div>
    <?php
    } else {

        $sql = "select * from trabalhos where codigo_trab='$codigopost'";
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
      <div id="conteudo3">
        <?php echo "<br><center><b>Editar Trabalho</b></center>"; ?>
        <br>
        <form name="form_editar_trabalho" method="post" onsubmit="javascript: return checkcontatos();" action="editar_trabalhos.php">
          <?php echo "<input id='codigo' type='hidden' name='codigo' value='$codigopost'>"; ?>
          <table border="0"  width="100%">
            <tr>
              <td><b>Titulo:</b></td>
              <?php echo "<td><input type='text' name='titulo' size='50' value='$campos[titulo]'></td>"; ?>
            </tr>
            <tr>
              <td><b>Autor 1:</b></td>
              <td>
                <?php
        echo "<input type='text' size=40 name='autor1' value='$autor1[nome]' readonly>";
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
            echo '<input type="radio" name="apresentador" value="3"> Apresentador';
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
            <br>
            <br>


<!--              Em 2020, foram reduzidos de 6 coautores, para 4 coautores-->

<!--              <tr>-->
<!--              <td><b>Autor 6:</b></td>-->
<!--              <td>-->
<!--                <select name="autor6" style="width:280px">-->
<!--                  <option></option>-->
                  <?php
//        mysql_data_seek($query_par, 0);
//        while ($campos_par = mysql_fetch_array($query_par)) {
//            if ($campos[autor6] == $campos_par[cpf]) {
//                echo "<option value='$campos_par[cpf]' selected>$campos_par[nome]</option>";
//            } else {
//                echo "<option value='$campos_par[cpf]'>$campos_par[nome]</option>";
//            }
//        }
//        ?>
<!--                </select>-->
                <?php
        if ($campos[apresentador] == 6) {
            //echo '<input type="radio" name="apresentador" value="6" checked="true"> Apresentador';
        } else {
           // echo '<input type="radio" name="apresentador" value="6"> Apresentador';
        }
        ?>
<!--              </td>-->
<!--            </tr>-->

<!--            <tr>-->
<!--              <td><b>Autor 7:</b></td>-->
<!--              <td>-->
<!--                <select name="autor7" style="width:280px">-->
<!--                  <option></option>-->
                  <?php
        mysql_data_seek($query_par, 0);
        while ($campos_par = mysql_fetch_array($query_par)) {
            if ($campos[autor7] == $campos_par[cpf]) {
               // echo "<option value='$campos_par[cpf]' selected>$campos_par[nome]</option>";
            } else {
               // echo "<option value='$campos_par[cpf]'>$campos_par[nome]</option>";
            }
        }
        ?>
                </select>
                <?php
        if ($campos[apresentador] == 7) {
           // echo '<input type="radio" name="apresentador" value="7" checked="true"> Apresentador';
        } else {
           // echo '<input type="radio" name="apresentador" value="7"> Apresentador';
        }
        ?>
<!--              </td>-->
<!--            </tr>-->
            <tr></tr>
            <tr>
                <td><b>Qual o tipo do seu projeto?</b></td>
                <td>
                    <input type="radio" onclick="script : mostrarICtipo(this.value)"
                       onchange="script : mostrarICtipo(this.value)" name="tipoProjeto" value="Pes" <?php if ($campos[tipo_projeto] == 'Pes') {echo'checked'; } ?>>Pesquisa
                    <input type="radio" onclick="script : mostrarICtipo(this.value)"
                       onchange="script : mostrarICtipo(this.value)" name="tipoProjeto" value="Ext" <?php if ($campos[tipo_projeto] == 'Ext') {echo'checked'; } ?>>Extensão
                    <input type="radio" onclick="script : mostrarICtipo(this.value)"
                      onchange="script : mostrarICtipo(this.value)" name="tipoProjeto" value="Edu" <?php if ($campos[tipo_projeto] == 'Edu') {echo'checked'; } ?>>Ensino
                </td>
            </tr>
            <tr id="tipo">
              <td><b>Este resumo refere-se ao seu projeto de Iniciação Científica?</b></td>
              <td>
                <?php
        echo "<input type='hidden' id='tipo' value='$campos[modalidade]'>";
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
            <tr id="tipoICA">
              <td><b>Qual Modalidade?</b></td>
              <td>
                <?php
        if ($campos[tipo_iniciacao] == "G") {
            echo '<input type="radio" name="tipoIniciacao" value="T" >Técnico';
            echo '<input type="radio" name="tipoIniciacao" value="G" checked="true">Graduação';
            echo '<input type="radio" name="tipoIniciacao" value="L">Lato Sensu';
            echo '<input type="radio" name="tipoIniciacao" value="S">Stricto Sensu';
        } else if ($campos[tipo_iniciacao] == "L") {
            echo '<input type="radio" name="tipoIniciacao" value="T">Técnico';
            echo '<input type="radio" name="tipoIniciacao" value="G">Graduação';
            echo '<input type="radio" name="tipoIniciacao" value="L" checked="true">Lato Sensu';
            echo '<input type="radio" name="tipoIniciacao" value="S">Stricto Sensu';
        }else if ($campos[tipo_iniciacao] == "S") {
            echo '<input type="radio" name="tipoIniciacao" value="T">Técnico';
            echo '<input type="radio" name="tipoIniciacao" value="G">Graduação';
            echo '<input type="radio" name="tipoIniciacao" value="L">Lato Sensu';
            echo '<input type="radio" name="tipoIniciacao" value="S" checked="true">Stricto Sensu';
        }else {
            echo '<input type="radio" name="tipoIniciacao" value="T" checked="true">Técnico';
            echo '<input type="radio" name="tipoIniciacao" value="G">Graduação';
            echo '<input type="radio" name="tipoIniciacao" value="L">Lato Sensu';
            echo '<input type="radio" name="tipoIniciacao" value="S">Stricto Sensu';
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
              <td><div id="mOrientador"></div></td>
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
            <?php
        $resumo = htmlspecialchars_decode($campos[resumo], ENT_QUOTES); //decodifica o texto
        echo "<td><textarea cols='60' name='resumo' rows='20' >$resumo</textarea></td>";
        ?>
          </center>
          <br>
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
else
{
	echo "Você não está autorizado a fazer esta operação. Contacte o administrador do sistema.";
}
?>
