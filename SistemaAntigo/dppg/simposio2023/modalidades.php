<?php
session_start();

include("includes/config.php");
$sql = "select * from modalidade";
$resultado = mysql_query($sql);
echo "<select size='1' name='modalidade'>";
echo "<option value=''></option>";
while ($campos_modalidades = mysql_fetch_array($resultado))
    if (($campos_modalidades[cod_modalidade] == 1) && ($_SESSION[trabalhos] == 'S'))
        echo "<option value='$campos_modalidades[cod_modalidade]'>$campos_modalidades[nome_modalidade]</option>";
    else if ($campos_modalidades[cod_modalidade] != 1)
        echo "<option value='$campos_modalidades[cod_modalidade]'>$campos_modalidades[nome_modalidade]</option>";
echo "</select>";
?>