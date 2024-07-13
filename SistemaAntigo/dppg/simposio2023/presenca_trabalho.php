<?php
session_start();

if ($_SESSION[logado_simposio_2021]) {
    if (in_array("1", $_SESSION[codigo_grupo]) || in_array("4", $_SESSION[codigo_grupo])) {
        include('includes/config.php');

        echo '<br><center><b><i>Presença Trabalho</i></b></center>';

        if ($_POST[confirma] == 'S') {
            $codigot = mysql_real_escape_string($_POST[codigot]);

            $sql1 = "select * from trabalhos where codigo_trab = '$codigot'";
            $resultado1 = mysql_query($sql1);
            $campos1 = mysql_fetch_array($resultado1);

            if (mysql_num_rows($resultado1) == 0) {
                echo '<br>';
                echo '<center><font color="FF0000"><b>Não existe nenhum trabalho Cadastrado com esse código!!!</b></font><br></center>';
                echo '<center><meta http-equiv="refresh" content="3; URL=simposio.php?arquivo2=presenca_trabalho.php" /></center>';
            } else {
                echo '<br>';

                $sql2 = "update trabalhos set presenca = 'S' where codigo_trab ='$codigot'";
                $resultado2 = mysql_query($sql2);

                echo '<center><font color="006400"><b>Presença Trabalho ' . $campos1[titulo] . ' efetuada com Sucesso!!!</b></font> </center>';

                //echo '<center>Presença efetuada com Sucesso!!!<br>';
                echo '<center><meta http-equiv="refresh" content="6;URL=simposio.php?arquivo2=presenca_trabalho.php" /></center>';
            }
        }

        echo '<br>
			<form name="form_presenca" method="POST" action="simposio.php">
				<center>	
			<table border="0" width="50%">			
			<tr>
				<td align="center">Código Trabalho:</td>
				<td><input type="text" name="codigot" size="20" maxlength="11"></td>	
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="OK"></td>				
				<input type="hidden" name="arquivo2" value="presenca_trabalho.php">
				<input type="hidden" name="confirma" value="S">			
			</tr>
			</table>
			</center>
			</form>
			<br>
			<script language=\'JavaScript\' type=\'text/javascript\'>
  				document.form_presenca.codigot.focus()
			</script>
			
	';

        mysql_close($conexao);
    }
}
?>