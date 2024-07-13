<?php
$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('1'));
$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('2'));

if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm)) {
  ?>
  <br>
  <center><h2>Cadastro de Curso</h2></center>
  <table align=center border=0>
    <tr>
      <td colspan=4>
        <form name="tinymce" method="post" action="index.php">
          <b>Nome</b>
          <input type="text" name="nome" size="40" maxlength="100">
          </td>
          </tr>
          <tr>	
            <td colspan=4>	
              <b>Descrição do Curso</b>
              <textarea name="descricao" rows="15" cols="60"></textarea>
            </td>
          </tr>
          <tr>
            <td colspan=2>
              <b>Palestrante:</b> <input type="text" name="palestrante" size="40" maxlength="100">
            </td>
            <td>		
              <b>Vagas:</b>
            </td>
            <td>	 
              <input type="text" name="vagas" size="10" maxlength="10">
            </td>
          </tr>
          <tr>
            <td >	
              <b>Data Realização:</b>
            </td>
            <td colspan="3">	 
              1ª<input type="text" name="data_realizacao" size="10" maxlength="10">  
              2ª<input type="text" name="data_realizacao2" size="10" maxlength="10">  
              3ª<input type="text" name="data_realizacao3" size="10" maxlength="10">  dd/mm/aaaa
            </td>
          </tr>
          <tr>	
            <td>		
              <b>Horário Realização:</b>
            </td>
            <td>	
              <input type="text" name="horario_realizacao" size="5" maxlength="5">hh:mm
            </td>
            <td>			
              <b>Carga Horária:</b>
            </td>
            <td>	 
              <input type="text" name="carga_horaria" size="2" maxlength="2">hs
            </td>	
          </tr>
          <tr>
            <td>	
              <b>Data Início Inscrição:</b>
            </td>
            <td>	 
              <input type="text" name="data_inicio" size="10" maxlength="10">dd/mm/aaaa
            </td>
            <td>	
              <b>Data Final Inscrição:</b>
            </td>
            <td>	 
              <input type="text" name="data_final" size="10" maxlength="10">dd/mm/aaaa
            </td>
          </tr>
          <tr>
            <td colspan=4>		
              <b>Ativo: </b><select size="1" name="ativo">
                <option value="S" selected>Sim</option>
                <option value="N">Não</option>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan=4 align=center>
              <input type="hidden" name="arquivo" value="subsistemas/cursos/cadastra_curso.php">
              <input type="submit" name="salvar" value="Salvar" class="submitVerde">
            </td>
          </tr>		
        </form>
      </td>
    </tr>		
  </table>
  <?php
}
?>