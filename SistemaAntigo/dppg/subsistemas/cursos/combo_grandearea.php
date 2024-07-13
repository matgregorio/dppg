<?php
   include ("includes/config2.php");
  
   $sql = "select * from area_atuacao order by id_grande_area";
   $resultado = mysql_query($sql);
   echo "<select size='1' name='id_grande_area'>";   
   while ($campos_grandearea = mysql_fetch_array($resultado)) 
  	{
      if ($campos_grandearea[id_grande_area] == $campos[id_grande_area])
         echo "<option value='$campos_grandearea[id_grande_area]' selected >$campos_grandearea[nome_area]</option>";
      else
         echo "<option value='$campos_grandearea[id_grande_area]'>$campos_grandearea[nome_area]</option>"; 
   }
   echo "</select>";
?>