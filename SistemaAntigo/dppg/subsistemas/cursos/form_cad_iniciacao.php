<?php
session_start();
$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('1'));
$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('2'));

if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm)) {
  ?>
  <head>
    <script src="subsistemas/cursos/valida_forms/valida_form_cad_iniciacao.js" type="text/javascript"></script>
    <script type="text/javascript">
      function cadastro(t){
        if (t == 'd'){
          document.getElementById('div1').style.display = 'table';
          document.getElementById('div2').style.display = 'none';
        }else if (t == 'f'){
          document.getElementById('div1').style.display = 'none';
          document.getElementById('div2').style.display = "";
        }
      }
    </script>
  </head>
  <br>
  <center><h2>Cadastro de Inciação</h2></center>
  <br>
  <center>
    <input type="radio" name="ops" value="d" onclick="javascript : cadastro(this.value);" checked="true">Cadastro Individual
      <input type="radio" name="ops" value="f" onclick="javascript : cadastro(this.value);">Cadastro por CSV <span style="color: #FF0000;"> (.csv separados por vírgulas)</span>
  </center>
  <br>
  <div id="div1" style="display: table; margin: 0 auto;">
    <form name="form_iniciacao" method="post" onsubmit="javascript: return checkiniciacao()" action="index.php?arquivo=subsistemas/cursos/cad_iniciacao.php" enctype="multipart/form-data">
      <table id="dados" align='center' border='0' style="margin: auto;">
        <tr>
          <td colspan="6" style="text-align: center;">
            <h2><b><u>Dados do Aluno</u></b></h2>
          </td>
        </tr>
        <tr>
          <td><b>Nome:</b></td>
          <td colspan="2"><input type="text" name="nomeAluno" size="40" maxlength="300"></td>
          <td colspan="3">
            &nbsp;<b>CPF:</b>
            <input type="text" name="cpfAluno" size="20" maxlength="11">
          </td>
        </tr>
        <tr>
          <td><b>E-mail:</b></td>
          <td><input type="text" name="emailAluno" size="20" maxlength="300"></td>
          <td>&nbsp;<b>Agência:</b></td>
          <td><input type="text" name="agenciaAluno" size="20" maxlength="20"></td>
          <td>&nbsp;<b>Conta:</b></td>
          <td><input type="text" name="contaAluno" size="20" maxlength="20"></td>
        </tr>
        <tr>
          <td><b>Tipo:</b></td>
          <td colspan="5">
            <select name="tipo">
              <option value="b">Bolsista</option>
              <option value="v">Voluntário</option>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="6"><hr></td>
        </tr>
        <tr>
          <td colspan="6" style="text-align: center;">
            <h2><b><u>Dados do Orientador</u></b></h2>
          </td>
        </tr>
        <tr>
          <td><b>Nome:</b></td>
          <td colspan="2"><input type="text" name="nomeOrientador" size="40" maxlength="300"></td>
          <td colspan="3">
            &nbsp;<b>CPF:</b>
            <input type="text" name="cpfOrientador" size="20" maxlength="11">
          </td>
        </tr>
        <tr>
          <td><b>Departamento:</b></td>
          <td><input type="text" name="departamentoOrientador" size="20" maxlength="300"></td>
        </tr>
        <tr>
          <td colspan="6"><hr></td>
        </tr>
        <tr>
          <td colspan="6" style="text-align: center;">
            <h2><b><u>Dados do Projeto</u></b></h2>
          </td>
        </tr>
        <tr>
          <td><b>Nome:</b></td>
          <td colspan="5"><input type="text" name="projeto" size="80" maxlength="500"></td>
        </tr>
        <tr>
          <td><b>Fomento:</b></td>
          <td colspan="5"><input type="text" name="fomento" size="80" maxlength="500"></td>
        </tr>
        <tr>
          <td><b>Vigência:</b></td>
          <td colspan="5"><input type="text" name="vigencia" size="80" maxlength="500"></td>
        </tr>
        <tr>
          <td colspan="6"><hr></td>
        </tr>
        <tr>
          <td colspan="6" style="text-align: center;">
            <br>
            <input type="hidden" name="tipoSubD" value="d">
            <input type="submit" name="salvar" value="Salvar">
            <input type="reset" name="limpar" value="Limpar Campos">
            <br>
          </td>
        </tr>
      </table>
    </form>
  </div>
  <div id="div2" style="display: none;">
    <form name="form_iniciacao_csv" method="post" onsubmit="javascript: return checkiniciacao()" action="index.php?arquivo=subsistemas/cursos/cad_iniciacao.php" enctype="multipart/form-data">
      <table id="dadosFile" align='center' border='0' style="margin: auto;">
        <tr>
          <td colspan="6" style="text-align: center;">
            <h2><b><u>Carregar Aquivo CSV</u></b></h2>
          </td>
        </tr>
        <tr>
          <td><b>Selecione o arquivo:</b></td>
          <td colspan="5"><input type="file" name="arquivoCSV"></td>
        </tr>
        <tr>
          <td colspan="6"><hr></td>
        </tr>
        </tr>
        <tr>
          <td colspan="6" style="text-align: center;">
            <br>
            <input type="hidden" name="tipoSubF" value="f">
            <input type="submit" name="salvar" value="Salvar">
            <input type="reset" name="limpar" value="Limpar Campos">
            <br>
          </td>
        </tr>
      </table>
    </form>
  </div>
<?php
}
?>