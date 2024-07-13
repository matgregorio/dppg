<?php
include('includes/config.php');
$query_subarea = mysql_query("SELECT codigo_sa, nome_sa FROM sub_area ORDER BY nome_sa");
echo "<select size='1' name='subarea' >
			<option value='0'>-----</option>";
while ($campos_subarea = mysql_fetch_array($query_subarea)) {
    if ($campos_subarea[codigo_sa] == $campos[codigo_sa]) {
        echo "<option value='$campos_subarea[codigo_sa]' selected>$campos_subarea[nome_sa]</option>";
    } else {
        echo "<option value='$campos_subarea[codigo_sa]'>$campos_subarea[nome_sa]</option>";
    }
}
echo "</select><font color='#FF0000'> *</font>";
?>