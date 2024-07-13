<?php
   echo "<select size='1' name='ativo'>";   
   if ($campos_curso[ativo] == 'S') {
      echo "<option value='$campos_curso[ativo]' selected>Sim</option>";
      echo "<option value='N'>Não</option>";
   }
   else {
      echo "<option value='$campos_curso[ativo]' selected>Não</option>";
      echo "<option value='S'>Sim</option>";
   } 
   echo "</select>";
?>