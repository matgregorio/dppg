<?php
session_start();
if (in_array("1", $_SESSION[codigo_grupo])) {
    include('includes/config.php');
    include('acentuacao.php');

    $codigoget = mysql_real_escape_string($_GET[c]);
    $ano = mysql_real_escape_string($_GET[a]);
    if ($ano < 6) {

        $sql1 = "select * from acervo ace, ano a  where ace.codigo_ano = a.codigo_ano and ace.codigo_acervo = '$codigoget'";
        $resultado1 = mysql_query($sql1);
        $campos1 = mysql_fetch_array($resultado1);

        chmod('acervo/', 777);
        $pasta = $campos1[ano];
        $dir = "acervo/" . $pasta . "/";
        $arquivo1 = $campos1[arquivo];
        chmod($dir, 0777);

        //Fução para deletar o arquivo de uma pasta, se não deletar dar permissão 777 na pasta trabalhos
        unlink($dir . '/' . $arquivo1);
        $codigo = $campos1[codigo_acervo];

        $sql2 = "delete from acervo where codigo_acervo = '$codigo'";
        $resultado2 = mysql_query($sql2);

        echo '<center><font color="#006400"><b>Exclusão feita com sucesso !!!</b></font></center><br>';

    } else {
        $c = mysql_fetch_array(mysql_query("SELECT codigo_trab FROM acervo WHERE codigo_acervo=$codigoget"));

        $sql1 = "DELETE FROM acervo WHERE codigo_acervo=$codigoget";
        $result = mysql_query($sql1);
        if ($result == 1) {
            $query_trabalho = mysql_query("UPDATE trabalhos SET aprovado='0' WHERE codigo_trab=$c[codigo_trab]");
            echo '<center><font color="#006400"><b>Exclusão feita com sucesso !!!</b></font></center><br>';
        }
    }
    echo '<meta http-equiv="refresh" content="3; URL=form_excluir_acervo.php" />';
}
?>