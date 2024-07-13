<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <html>
    <head>
        <title> Cadastro Professores Área de Atuação </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/validaprofdepto.js" type="text/javascript"></script>
    </head>
    <body>
    <?php
    include('includes/config.php');

    echo '<div id="conteudo3"><br>';

    echo '<center><b>Cadastro Professores Área de Atuação</b></center><br>';

    echo '<center>
	<form name="form_cadastro_profdepto" method="post" onsubmit="javascript: return checkcontatos()"  action="cadastro_profdepto.php">  				
          <table border="0" width="100%" class="esquerda">				
            <tr>
              <td align="center">CPF Professor (a):</td>
              <td><input type="text" name="cpf" size="11" maxlength="11"><font color="#FF0000">*</font> Somente Números</td>
            </tr>
            <tr>
              <td align="center">Área de Atuação:</td>
              <td>
        ';

    $sql = "select * from departamento";
    $resultado = mysql_query($sql);

    echo '<select size="1" name="profdepto">';

    while ($campos = mysql_fetch_array($resultado)) {
        echo "<option value=$campos[codigo_depto]> $campos[nome_depto]</option>";
    }

    echo '</td>
    </tr>	
    <tr>
      <td align="center">Linha de Pesquisa: </td>	
      <td><input type="text" name="pesquisa" size="40" maxlength="100"></td>
    </tr>
    <tr>
      <td align="center">Visitante: </td>
      <td>
        <input type="radio" name="visitante" value="1">Sim
        <input type="radio" name="visitante" value="0">Não
      </td>
    </tr>
</table>
<input type="submit" value="OK">
</form>
</center>';
    echo '<center><font color="#FF0000">OBS: O professor precisa estar cadastrado.</font></center><br>';
    echo '</div>';
    ?>

    </body>
    </html>
    <?php
    mysql_close($conexao);
}
?>