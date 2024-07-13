<?php
session_start();

if ($_SESSION[logado_simposio_2021]) {
    if (in_array("1", $_SESSION[codigo_grupo]) || in_array("4", $_SESSION[codigo_grupo])) {
        include('includes/config.php');

        echo '<br><center><b><i>Presença Participantes</i></b></center>';

        if ($_POST[confirma] == 'S') {
            $bloco = mysql_real_escape_string($_POST[bloco]);
            $cpf = mysql_real_escape_string($_POST[cpf]);

            $sql1 = "select itens_inscricao.codigo_sub_evento, sub_eventos.titulo from sub_eventos join itens_inscricao on
		sub_eventos.codigo_sub_evento = itens_inscricao.codigo_sub_evento where  sub_eventos.codigo_bloco = '$bloco' 
		and itens_inscricao.cpf='$cpf'";

            $resultado1 = mysql_query($sql1);

            if (mysql_num_rows($resultado1) == 0) {
                echo '<br>';
                echo '<center><font color="FF0000"><b>Participante não cadastrado em nenhum subevento!!!</b></font><br></center>';
                echo '<center><meta http-equiv="refresh" content="3; URL=simposio.php?arquivo2=presenca.php&bloco=' . $bloco . '" /></center>';
            } else {
                echo '<br>';
                while ($campos1 = mysql_fetch_array($resultado1)) {
                    $sql2 = "update itens_inscricao set presenca ='S' where cpf='$cpf' and
				codigo_sub_evento ='$campos1[codigo_sub_evento]'";
                    $resultado2 = mysql_query($sql2);

                    $sql3 = "select nome from participantes where cpf='$_POST[cpf]'";
                    $resultado3 = mysql_query($sql3);
                    $campos3 = mysql_fetch_array($resultado3);

                    echo '<center><font color="#006400"><b>Presença efetuada com Sucesso no sub Evento ' . $campos1[titulo] . '</b></font></center>';
                }

                header("Refresh:3; url=simposio.php?arquivo2=presenca.php");
                //echo '<center><meta http-equiv="refresh" content="3; URL=simposio.php?arquivo2=presenca.php&bloco=' . $bloco . '" /></center>';
            }
        }

        echo '<br>
			<form name="form_presenca" method="POST" action="simposio.php">
				<center>	
			<table border="0" width="50%">	
			<tr>
				<td align="center">Bloco:</td>			
				<td><select name="bloco" size="1">';


        $sql = "select * from bloco";
        $resultado = mysql_query($sql);


        while ($campos = mysql_fetch_array($resultado)) {
            if ($campos[codigo_bloco] == $_GET[bloco])
                echo "<option value='$campos[codigo_bloco]' selected>$campos[nome_bloco]</option>";
            else
                echo "<option value='$campos[codigo_bloco]'>$campos[nome_bloco]</option>";
        }

        echo '</select></td>
			</tr>		
			<tr>
				<td align="center">CPF:</td>
				<td><input type="text" name="cpf" size="20" maxlength="11"></td>	
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="OK"></td>				
				<input type="hidden" name="arquivo2" value="presenca.php">
				<input type="hidden" name="confirma" value="S">			
			</tr>
			</table>
			</center>
			</form>
			<br>
			<script language=\'JavaScript\' type=\'text/javascript\'>
  				document.form_presenca.cpf.focus()
			</script>
			
	';

        mysql_close($conexao);
    }
}
?>