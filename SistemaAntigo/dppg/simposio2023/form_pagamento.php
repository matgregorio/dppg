<?php

if (in_array("1", $_SESSION[codigo_grupo])) {
    include('includes/config.php');

    echo '<center><br><i><b>Pagamentos</b></i></center>';

    if ($_POST[pagamento] == 'S') {
        if ($_POST[cpf] == "") {
            echo '<br><center><b><font color="#FF0000">Digite o CPF!!!</font></b></center>';
            echo '<meta http-equiv="refresh" content="3; URL=simposio.php?arquivo2=form_pagamento.php" />';
        } else {
            $cpf = mysql_real_escape_string($_POST[cpf]);

            $sql_verificar = "select * from inscricao where cpf='$cpf' and pagamento ='S'";
            $resultado_verificar = mysql_query($sql_verificar);

            $sql_participante = "select nome from participantes where cpf='$cpf'";
            $resultado_participante = mysql_query($sql_participante);
            $campos_participante = mysql_fetch_array($resultado_participante);

            if (mysql_num_rows($resultado_verificar) == 1) {
                echo '<br><center><b><font color="#FF0000">Participante ' . $campos_participante[nome] . '<br> já foi
							cadastrado na lista de usuários que já pagaram!!!</font></b></center>';
                echo '<meta http-equiv="refresh" content="6; URL=simposio.php?arquivo2=form_pagamento.php" />';
            } else {
                $cpf = mysql_real_escape_string($_POST[cpf]);

                $sql5 = "update inscricao set pagamento='S' where cpf='$cpf'";
                $resultado5 = mysql_query($sql5);


                echo '<br><center><b><font color="#006400">Pagamento Efetuado Com Sucesso
							<br>ao Participante ' . $campos_participante[nome] . '!!!</font></b></center>';
                echo '<meta http-equiv="refresh" content="6; URL=simposio.php?arquivo2=form_pagamento.php" />';
            }
        }
    }

    echo '
		<center>
		<br>
		<form name="form_insc" method="post" action="simposio.php">
		<table border="0" width="50%">
		<tr>
  			<td><b>CPF:</b></td>
  			<td><input type="text" name="cpf" size="11" maxlength="11"> <font color="#FF0000">*</font> Somente números</td>
		</tr>
		<tr>
			<input type="hidden" name="arquivo2" value="form_pagamento.php">	
  			<input type="hidden" name="pagamento" value="S">
		</tr>
		</table>	
			
			<input type="submit" value="OK">&nbsp;<input type="reset" value="Limpar">
		</form>
		</center>
	<br><hr align="center" width="500" />';

    $sql = "select cpf from inscricao where pagamento='S'";
    $resultado = mysql_query($sql);
    $quantidade = mysql_num_rows($resultado);

    $sql2 = "select cpf from inscricao";
    $resultado2 = mysql_query($sql2);
    $quantidade2 = mysql_num_rows($resultado2);

    $sql1 = "select * from inscricao i, participantes p  where  p.cpf = i.cpf and i.pagamento='S' order by p.nome";
    $resultado1 = mysql_query($sql1);

    $sql6 = "select codigo_trab from trabalhos";
    $resultado6 = mysql_query($sql6);
    $quantidade_trabalhos = mysql_num_rows($resultado6);
    mysql_close($conexao);

    echo '<br><center><b>Relação de Pagamentos</b></center>';
    echo '<br><center><b>Total de pagantes: </b>' . $quantidade . '/' . $quantidade2 . '<br><br>
			 <center><b>Total de trabalhos submetidos:</b> ' . $quantidade_trabalhos . '<br><br>';
    echo '<b>Legenda: S - Sim</b><br></center><br>';
    echo '<center><table border="0"><tr bgcolor=#61C02D><td><b>Nº</b></td><td><b>Nome</b></td><td><b>Pagamento</b></td></tr>';
    $cor = "#95e197";
    while ($campos_pagamento = mysql_fetch_array($resultado1)) {
        echo '<tr bgcolor="' . $cor . '">
				<td>' . ++$contador . '</td><td>' . $campos_pagamento[nome] . '</td>
				<td>' . $campos_pagamento[pagamento] .
            '</td></tr>';

        if ($cor == "#78e07b")
            $cor = "#95e197";
        else
            $cor = "#78e07b";
    }
    echo '</table></center><br>';
}
