<?php
/*
 * Esse arquivo permite que o orientador visualize o conteúdo do trabalho junto
 * à ficha de avaliação.
 */
session_start();

include_once ('trataInjection.php');
if (protectorString($_GET[a]) || protectorString($_POST[s]) || protectorString($_POST[item1]) || protectorString($_POST[item2]) ||
    protectorString($_POST[item3]) || protectorString($_POST[item4]) || protectorString($_POST[item5]) || protectorString($_POST[item6]) ||
    protectorString($_POST[total]) || protectorString($_POST[obs]) || protectorString($_POST[c]) || protectorString($_POST[av]))

if (in_array("7", $_SESSION[codigo_grupo])) {
    echo "o";
    header('Content-Type: text/html; charset=utf-8');
    ?>
  <title> Avaliar Trabalho </title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="js/valida_editar_arquivo.js"></script>
  <script type="text/javascript" src="js/prototype.js"></script>
  <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
  <script type="text/javascript" src="js/scriptaculous.js?load=effects"></script>
  <style type="text/css">
    #cont {
      /*float: left;*/
      background: #FFFFFF;
      border: 2px solid #A2CD5A;
      width: 1200px;
      position: absolute;
      margin: auto;
      left:5%;
      right: 10%;
    }
  </style>
  <script type="text/javascript">
    function mostrarIC(val) {
      if (val == "S") {
        document.getElementById("tipoIC").style.display = '';
      } else {
        document.getElementById("tipoIC").style.display = 'none';
      }
    }

    function media() {
      var nota1, nota2, nota3, nota4, nota5, nota6;
      if (document.getElementById("item1").value < 0 || document.getElementById("item1").value > 20) {
        alert("A nota deve estar entre 0 e 20!");
        document.getElementById("item1").value = "0";
        nota1 = 0;
      } else {
        if (document.getElementById("item1").value == "") {
          nota1 = 0;
        }
        else {
          nota1 = document.getElementById("item1").value;
        }
      }

      if (document.getElementById("item2").value < 0 || document.getElementById("item2").value > 10) {
        alert("A nota deve estar entre 0 e 10!");
        document.getElementById("item2").value = "";
        nota2 = 0;
      } else {
        if (document.getElementById("item2").value == "") {
          nota2 = 0;
        }
        else {
          nota2 = document.getElementById("item2").value;
        }
      }

      if (document.getElementById("item3").value < 0 || document.getElementById("item3").value > 20) {
        alert("A nota deve estar entre 0 e 20!");
        document.getElementById("item3").value = "";
        nota3 = 0;
      } else {
        if (document.getElementById("item3").value == "") {
          nota3 = 0;
        }
        else {
          nota3 = document.getElementById("item3").value;
        }
      }

      if (document.getElementById("item4").value < 0 || document.getElementById("item4").value > 20) {
        alert("A nota deve estar entre 0 e 20!");
        document.getElementById("item4").value = "";
        nota4 = 0;
      } else {
        if (document.getElementById("item4").value == "") {
          nota4 = 0;
        }
        else {
          nota4 = document.getElementById("item4").value;
        }
      }

      if (document.getElementById("item5").value < 0 || document.getElementById("item5").value > 20) {
        alert("A nota deve estar entre 0 e 20!");
        document.getElementById("item5").value = "";
        nota5 = 0;
      } else {
        if (document.getElementById("item5").value == "") {
          nota5 = 0;
        }
        else {
          nota5 = document.getElementById("item5").value;
        }
      }

      if (document.getElementById("item6").value < 0 || document.getElementById("item6").value > 10) {
        alert("A nota deve estar entre 0 e 10!");
        document.getElementById("item6").value = "";
        nota6 = 0;
      } else {
        if (document.getElementById("item6").value == "") {
          nota6 = 0;
        }
        else {
          nota6 = document.getElementById("item6").value;
        }
      }
      nota1 = parseFloat(nota1);
      nota2 = parseFloat(nota2);
      nota3 = parseFloat(nota3);
      nota4 = parseFloat(nota4);
      nota5 = parseFloat(nota5);
      nota6 = parseFloat(nota6);
      var media = (nota1 + nota2 + nota3 + nota4 + nota5 + nota6);
      document.getElementById("total").value = media;
      if (media < 60) {
        document.getElementById("reprovado").style.display = "block";
        document.getElementById("aprovado").style.display = "none";
      } else if (media >= 60) {
        document.getElementById("reprovado").style.display = "none";
        document.getElementById("aprovado").style.display = "block";
      } else {
        document.getElementById("reprovado").style.display = "block";
        document.getElementById("aprovado").style.display = "none";
      }
    }
  </script>
  <script language='JavaScript'>
    function SomenteNumero(e) {
      var tecla = (window.event) ? event.keyCode : e.which;
      if ((tecla > 47 && tecla < 58))
        return true;
      else {
        if (tecla == 8 || tecla == 0)
          return true;
        else
          return false;
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
  <body onunload="opener.location.reload();">
    <div id="cont">
      <?php
    include('includes/config.php');
    ?>
    <?php
    if ($_POST[s] == 's') {
      include('includes/config.php');
        $item1 = mysql_real_escape_string($_POST[item1]);
        $item2 = mysql_real_escape_string($_POST[item2]);
        $item3 = mysql_real_escape_string($_POST[item3]);
        $item4 = mysql_real_escape_string($_POST[item4]);
        $item5 = mysql_real_escape_string($_POST[item5]);
        $item6 = mysql_real_escape_string($_POST[item6]);
        $total = mysql_real_escape_string($_POST[total]);
        $obs = mysql_real_escape_string($_POST[obs]);
        $codigoTrab = mysql_real_escape_string($_POST[c]);
        $cpf = mysql_real_escape_string($_POST[av]);
        $sql = "UPDATE avaliador_trab SET item1='$item1', item2='$item2', item3='$item3', item4='$item4', item5='$item5', item6='$item6', nota='$total', obs='$obs', avaliado='1' WHERE cpf='$cpf' AND codigo_trab='$codigoTrab'";
        if (mysql_query($sql)) {
            echo '<br><br><center><font color="#00FF00"><b>Avaliação salva com sucesso!!!</b></font></center><br>';
            echo "<script type='text/javascript'>window.setTimeout('window.close()', 3000);</script>";
        } else {
            echo '<meta http-equiv="refresh" content="3; URL=form_avaliar.php?a=' . $codigoTrab . '" />';
            echo '<br><br><center><font color="#FF0000"><b>Erro ao salvar a avaliação!!!</b></font></center><br>';
        }
    } else {
        $codigopost = mysql_real_escape_string($_GET[a]);
        $sql = "select * from trabalhos where codigo_trab='$codigopost'";
        $resultado = mysql_query($sql);
        $campos = mysql_fetch_array($resultado);
        ?>
        <?php echo "<br><center><b>Avaliar Trabalho</b></center>"; ?>
        <br>
        <table border="0"  width="100%">
          <tr>
            <td valign='top' width="50%">
              <table border="0"  width="100%">
                <tr>
                  <td align="center" colspan="2"><b>Conteúdo Trabalho</b></td>
                </tr>
                <tr><td colspan="2"><hr></td></tr>
                <tr>
                  <td><b>Titulo:</b></td>
                  <?php echo "<td>$campos[titulo]</td>"; ?>
                </tr>
                <tr><td colspan="2"><hr></td></tr>
                <tr>
                  <td><b>Iniciação Científica?</b></td>
                  <td>
                    <?php
        echo "<input type='hidden' id='m' value='$campos[modalidade]'>";
        if ($campos[modalidade] == "N") {
            echo 'Não';
        } else {
            echo 'Sim';
        }
        ?>
                  </td>
                </tr>
                <tr><br></tr>
                <tr id="tipoIC" style="display: none">
                  <td><b>Modalidade:</b></td>
                  <td>
                    <?php
        if ($campos[tipo_iniciacao] == "G") {
            echo 'Graduação';
        } else if ($campos[tipo_iniciacao] == "M") { 
            echo 'Mestrado';
        }else {
            echo 'Técnico';
        }
        ?>
                  </td>
                </tr>
                <tr><td colspan="2"><hr></td></tr>
                <tr>
                  <td><b>Subárea:</b></td>
                  <td>
                    <?php
        $sql1 = "select * from sub_area order by nome_sa asc";
        $resultado1 = mysql_query($sql1);
        while ($campos1 = mysql_fetch_array($resultado1)) {
            if ($campos[codigo_sa] == $campos1[codigo_sa]) {
                echo "$campos1[nome_sa]";
            }
        }
        ?>
                </tr>
                <tr><td colspan="2"><hr></td></tr>
                <tr>
                  <td><b>Palavras Chave:</b></td>
                  <?php echo "<td>$campos[palavra_chave]</td>"; ?>
                </tr>
                <tr><td colspan="2"><hr></td></tr>
                <tr>
                  <td><b>Apoio</b></td>
                  <td>
                    <?php
        $cons = "select * from apoio";
        $res = mysql_query($cons);
        while ($camp = mysql_fetch_array($res)) {
            $query_apoio = mysql_query("SELECT * FROM apoio_trabalho WHERE codigo_apoio='$camp[codigo_apoio]' AND codigo_trabalho='$codigopost'");
            if (mysql_num_rows($query_apoio) == 1) {
                echo "$camp[nome]<br>";
            }
        }
        ?>
                  </td>
                </tr>
                <tr><td colspan="2"><hr></td></tr>
                <tr>
                  <td><b>Resumo:</b></td>				
                </tr>
                <tr>
                  <td colspan="2" align="justify">
                    <?php
        $resumo = htmlspecialchars_decode($campos[resumo], ENT_QUOTES); //decodifica o texto
        echo "$resumo";
        ?>
                  </td>
                </tr>
              </table>
            </td>
            <td width="1" bgcolor="black"></td>
            <td valign='top' width="50%">
              <form name="form_avaliar" action="form_avaliar.php" method="post">
                <table border="0"  width="100%" onmousemove="media()">
                  <tr>
                    <td align="center" colspan="2" ><b>Formulário de Avaliação</b></td>
                  </tr>
                  <tr><td colspan="2"><hr></td></tr>
                  <tr>
                    <td colspan="2"><b>Itens Avaliados:</b></td>
                  </tr>
                  <tr><td colspan="2"><hr size='2' color='#000000'></td></tr>
                  <tr>
                    <td colspan="2"><b>1-</b> Estrutura do resumo de acordo com as normas do Simpósio (Contém introdução, objetivos, material e métodos ou metodologia, resultados e conclusões, mínimo de 250 e máximo de 400 palavras?)</td>
                  </tr>
                  <tr>
                    <td width="120px">Pontuação (20pts):</td>
                    <td align="left"><input type="text" maxlength="2" id="item1" name="item1" size="5" onkeypress='return SomenteNumero(event)' onkeyup="media()" onchange="media()"></td>
                  </tr>
                  <tr><td colspan="2"><hr></td></tr>
                  <tr>
                    <td colspan="2"><b>2-</b> Título: (Descreve a essência do resumo?)</td>
                  </tr>
                  <tr>
                    <td width="120px">Pontuação (10pts):</td>
                    <td align="left"><input type="text" maxlength="2" id="item2" name="item2" size="5" onkeypress='return SomenteNumero(event)' onkeyup="media()" onchange="media()"></td>
                  </tr>
                  <tr><td colspan="2"><hr></td></tr>
                  <tr>
                    <td colspan="2"><b>3-</b> Qualidade da redação científica</td>
                  </tr>
                  <tr>
                    <td width="120px">Pontuação (20pts):</td>
                    <td align="left"><input type="text" maxlength="2" id="item3" name="item3" size="5" onkeypress='return SomenteNumero(event)' onkeyup="media()" onchange="media()"></td>
                  </tr>
                  <tr><td colspan="2"><hr></td></tr>
                  <tr>
                    <td colspan="2"><b>4-</b> Relevância científica (O tema é atual e relevante?)</td>
                  </tr>
                  <tr>
                    <td width="120px">Pontuação (20pts):</td>
                    <td align="left"><input type="text" maxlength="2" id="item4" name="item4" size="5" onkeypress='return SomenteNumero(event)' onkeyup="media()" onchange="media()"></td>
                  </tr>
                  <tr><td colspan="2"><hr></td></tr>
                  <tr>
                    <td colspan="2"><b>5-</b> Originalidade do trabalho</td>
                  </tr>
                  <tr>
                    <td width="120px">Pontuação (20pts):</td>
                    <td align="left"><input type="text" maxlength="2" id="item5" name="item5" size="5" onkeypress='return SomenteNumero(event)' onkeyup="media()" onchange="media()"></td>
                  </tr>
                  <tr><td colspan="2"><hr></td></tr>
                  <tr>
                    <td colspan="2"><b>6-</b> Conclusões (As conclusões são claras? Os objetivos foram alcançados?</td>
                  </tr>
                  <tr>
                    <td width="120px">Pontuação (10pts):</td>
                    <td align="left"><input type="text" maxlength="2" id="item6" name="item6" size="5" onkeypress='return SomenteNumero(event)' onkeyup="media()" onchange="media()"></td>
                  </tr>
                  <tr><td colspan="2"><hr></td></tr>
                  <tr>
                    <td colspan="2">
                      <b>Total de pontos obtidos neste processo</b>
                      <input type="text" maxlength="2" id="total" name="total" size="5" readonly="true" value="0">
                    </td>
                  </tr>
                  <tr><td colspan="2"><hr></td></tr>
                  <tr>
                    <td colspan="2">
                      <b>Parecer do avaliador:</b><br><br>
                      Os trabalhos com pontuação menor que 60 pontos serão reprovados.
                    </td>
                  </tr>
                  <tr><td></td></tr>
                  <tr>
                    <td>
                      <div id="reprovado" style="display: block">
                        <font size="3" color="#FF0000">REPROVADO.</font> O resumo deve ser rejeitado para publicação, pois não atingiu o objetivo proposto.
                      </div>
                      <div id="aprovado" style="display: none">
                        <font size="3" color="#00FF00">APROVADO.</font> O resumo pode ser aceito para publicação sem restrições.
                      </div>
                    </td>
                  </tr>
                  <tr><td colspan="2"><hr></td></tr>
                  <tr>
                    <td colspan="2">
                      <b>Observações:</b>
                      <textarea cols='60' name='obs' rows='10'></textarea>
                    </td>
                  </tr>
                </table>
                <center>
                  <input type="hidden" name="s" value="s">
                  <?php echo "<input type='hidden' name='c' value='$codigopost'>"; ?>
        <?php echo "<input type='hidden' name='av' value='$_SESSION[cpf]'>"; ?>
                  <input type="submit" value="Salvar Avaliação">
                </center>
              </form>
            </td>
          </tr>
        </table>
      </center>
    </div>
    </body>
    <?php
    }
}
?>
