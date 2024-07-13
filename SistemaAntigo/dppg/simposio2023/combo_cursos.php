<?php
include("includes/config.php");

$sql = "select * from cursos order by nome_curso";
$resultado = mysql_query($sql);
// nome_curso
// echo $campos[codigo_curso];
echo "<select size='1' name='curso'>";
while ($campos_cursos = mysql_fetch_array($resultado)) {
    if ($campos_cursos[codigo_curso] == $campos[codigo_curso])
        echo "<option value='$campos_cursos[codigo_curso]' selected >$campos_cursos[nome_curso]</option>";
    else
        echo "<option value='$campos_cursos[codigo_curso]'>$campos_cursos[nome_curso]</option>";
}
echo "</select><font color='#FF0000'> *</font>";
?>