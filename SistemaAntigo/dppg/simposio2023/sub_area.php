<?php
include("includes/config.php");
$sql = "select * from sub_area order by nome_sa";
$resultado = mysql_query($sql);
echo "<select size='1' name='sub_area'>";
while ($campos_sub_area = mysql_fetch_array($resultado)) {
    echo "<option value='$campos_sub_area[codigo_sa]'>$campos_sub_area[nome_sa]</option>";
}
echo "</select>";
//foreach
?>