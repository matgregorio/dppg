<?php
/*
 * Utiliza um arquivo java script na pasta js e outro que seleciona os trabalhos de acordo
 * com a opção selecionada chamado seleciona_trabalhos.php
 */
if (in_array("1", $_SESSION[codigo_grupo])) {
  ?>
  <html>
    <head>
      <script type="text/javascript" src="js/apresentacoes.js"></script>
    </head>
    <body>
    <center>
      <br><br>
      <center><b>Selecione o Tipo de Submissões</b></center>
      <br>
      <table>
        <tr>
          <td>
            <select id="t" name="estado" onchange="script : listar_apresentacoes(this.value)">
              <option value="A">---------------</option>
              <option value="Edu">Ensino - Estudos Orientados</option>
              <option value="Ext">Extensão - Estudos Orientados</option>
              <option value="T">Pesquisa - Técnico</option>
              <option value="G">Pesquisa - Graduação</option>
              <option value="L">Pesquisa - Lato Sensu</option>
              <option value="S">Pesquisa - Stricto Sensu</option>
            </select>
          </td>
        </tr>
      </table>
      <hr>
    </center>
    <center>
      <div id="lista_apresentacoes"></div>
    </center>
    <script type="text/javascript">
      document.getElementById('t').focus();
    </script>
  </body>
  </html>
  <body>
    <?php
  }
  ?>
