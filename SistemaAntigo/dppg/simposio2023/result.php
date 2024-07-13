<?php
include('includes/config.php');

// Guardando o id passado pelo form select
// Trim remove os espaços no inicio e final
// addslashes Retorna uma string com barras invertidas antes de caracteres
// que precisam ser escapados para serem escapados em query a banco de dados
$grande_area = addslashes(trim($_GET["id"]));
// Fazendo nosso selec para todas subcategorias que pertencem à categoria presente
// na variavel $categoria acima
$consulta = mysql_query("select * from sub_area where codigo_ga = '$grande_area' order by nome_sa");


while ($row = mysql_fetch_array($consulta)) {
    // subcategoria será apresentada da forma "NOME|CODIGO,..."
    // Maneira a ser tratada no JavaScript
    // Vale lembrar que estamos contatenando o "nome" com a "|" com o "codigo" e com a ","
    //echo $row["nome_sa"]."|". $row["codigo_sa"].",";
    echo $row["nome_sa"] . "|" . $row["codigo_sa"] . ",";
    //echo '<option value=$row[codigo_sa]>$row[nome_sa]</option>';
}
?>