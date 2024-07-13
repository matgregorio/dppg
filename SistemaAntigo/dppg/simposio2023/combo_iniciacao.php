<?php
include 'includes/config.php';

$sql = "select * from tipo_iniciacao order by codigo_tipo_iniciacao asc";
$resultado = mysql_query($sql);
//tipo
// echo $campos[codigo_tipo_participante];
echo "<select size='1' name='iniciacao' >";
while ($campos_iniciacao = mysql_fetch_array($resultado)) {
    if ($campos_iniciacao[codigo_tipo_iniciacao] == $campos[codigo_tipo_iniciacao])
        echo "<option value='$campos_iniciacao[codigo_tipo_iniciacao]' selected>$campos_iniciacao[tipo]</option>";
    else
        echo "<option value='$campos_iniciacao[codigo_tipo_iniciacao]'>$campos_iniciacao[tipo]</option>";
}
echo "</select>";
?>