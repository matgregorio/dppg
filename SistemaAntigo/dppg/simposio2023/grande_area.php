<select name="grande_area" onchange="list_dados( this.value )">
    <!--<option>Selecione</option>-->
    <?php

    include("includes/config.php");
    $consulta = mysql_query("select * from grande_area order by nome_ga");
    while ($row = mysql_fetch_assoc($consulta)) {
        echo "<option value=\"{$row['codigo_ga']}\">{$row['nome_ga']}</option>";
    }
    ?>
</select>
   