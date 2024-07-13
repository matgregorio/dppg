<?php
include 'includes/config.php';

$sql = "select * from tipo_participante order by codigo_tipo_participante asc";
$resultado = mysql_query($sql);
//tipo
// echo $campos[codigo_tipo_participante];
echo "<select size='1' name='participante' id='part' onchange='mostrar_combo()'>";
while ($campos_participante = mysql_fetch_array($resultado)) {
    if ($campos_participante[codigo_tipo_participante] == $campos[codigo_tipo_participante])
        echo "<option value='$campos_participante[codigo_tipo_participante]' selected>$campos_participante[tipo]</option>";
    else
        echo "<option value='$campos_participante[codigo_tipo_participante]'>$campos_participante[tipo]</option>";
}
echo "</select><font color='#FF0000'> *</font>";
?>