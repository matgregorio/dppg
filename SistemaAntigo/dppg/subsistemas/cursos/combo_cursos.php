<?php
   include ("includes/config2.php");
  
   $sql = "select * from cursos order by codigo_curso";
   $resultado = mysql_query($sql);
   echo "<select size='1' name='codigo_curso'>";   
   while ($campos_cursos = mysql_fetch_array($resultado)) 
  	{
      if ($campos_cursos[codigo_curso] == $campos[codigo_curso])
         echo "<option value='$campos_cursos[codigo_curso]' selected >$campos_cursos[nome_curso]</option>";
      else
         echo "<option value='$campos_cursos[codigo_curso]'>$campos_cursos[nome_curso]</option>"; 
   }
   echo "</select>";
?>