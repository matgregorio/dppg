<?php
if ($_SESSION[logado_simposio_2021]) {
    echo '<script src="js/valida_submissao.js">
				</script>';

    include('includes/configuracoes.php');

    if ($_POST[submissao] == 'S') {
        if (eregi('pdf', $_FILES[arq_trabalho][type])) {
            $dir = 'trabalhos/';
            $numero = mt_rand();

            $arquivo = $numero . '_' . $_FILES[arq_trabalho][name];

            if (move_uploaded_file($_FILES[arq_trabalho][tmp_name], $dir . $numero . '_' . $_FILES[arq_trabalho][name])) {
                $sql = "insert into trabalhos (cpf,arquivo,modalidade,titulo,area,autor1,autor2,autor3,autor4,autor5,
					autor6,autor7) values('$_POST[cpf]','$arquivo','$_POST[modalidade]',
					'$_POST[titulo]','$_POST[area]','$_POST[autor1]','$_POST[autor2]','$_POST[autor3]','$_POST[autor4]',
					'$_POST[autor5]','$_POST[autor6]','$_POST[autor7]')";
                $res = mysql_query($sql);

                $sql = "select * from linhas_pesquisa,usuarios where codigo='$_POST[area]' and codigo=linha_pesquisa";
                $result = mysql_query($sql);
                $campos = mysql_fetch_array($result);

                $to = $campos[email];
                $subject = 'Envio de trabalhos';
                $message = 'Prezado professor,
									houve um envio de trabalho para ser avaliado.
									Para acessar segue o link abaixo.
									http://www.riopomba.ifsudestemg.edu.br/simposio/restrito
									Usuário: ' . $campos[usuario] .
                    'Senha: ' . $campos[senha] .
                    'Setor CCPG';
                $headers = 'From: ccpg.riopomba@ifsudestemg.edu.br' . "\r\n";

                //echo 'Email -> ' .$to.' '.$subject.' '.$message.' '.$headers;
                mail($to, $subject, $message, $headers);

                //echo 'Aqui -> '.$to.$subject.$message.$headers.mail($to, $subject, $message, $headers);

                echo '<meta http-equiv="refresh" content="1;index.php?arquivo=trabalhos.php" />';
            }
        } else
            echo '<br><center><b><font size="2" color="#FF0000">Erro no envio do arquivo.<br>
						Tipo de arquivo não suportado.<br>
						Envie somente arquivos do tipo PDF						.</b></font></center>';
    }

    echo '<center><br>* * *</center>';
    echo '<br><center><b>Submissão de Trabalho</b></center>
		<br>
		<center>
			<form name="form_submissao" method="post" onsubmit="javascript: return checkcontatos()" action="index.php" enctype="multipart/form-data">
			<table border="0" width="500">
			<tr>
 				<td><input type="hidden" name="cpf" size="11" maxlength="11" value="' . $_SESSION[cpf] . '" readonly class="alinhadoAEsquerda"></td>
			</tr>
			<tr>
  				<td><b>Título</b></td>
  				<td><input type="text" name="titulo" size="50" maxlength="100" class="alinhadoAEsquerda"><font color="#FF0000"> *</font></td>
			</tr>
			<tr>
  				<td><b>Autor 1</b></td>
  				<td><input type="text" name="autor1" size="50" maxlength="100" class="alinhadoAEsquerda"><font color="#FF0000"> *</font></td>
			</tr>
			<tr>
  				<td><b>Autor 2</b></td>
  				<td><input type="text" name="autor2" size="50" maxlength="100" class="alinhadoAEsquerda"></td>
			</tr>
			<tr>
  				<td><b>Autor 3</b></td>
  				<td><input type="text" name="autor3" size="50" maxlength="100" class="alinhadoAEsquerda"></td>
			</tr>
			<tr>
  				<td><b>Autor 4</b></td>
  				<td><input type="text" name="autor4" size="50" maxlength="100" class="alinhadoAEsquerda"></td>
			</tr>
			<tr>
  				<td><b>Autor 5</b></td>
  				<td><input type="text" name="autor5" size="50" maxlength="100" class="alinhadoAEsquerda"></td>
			</tr>
			<tr>
  				<td><b>Autor 6</b></td>
  				<td><input type="text" name="autor6" size="50" maxlength="100" class="alinhadoAEsquerda"></td>
			</tr>
			<tr>
  				<td><b>Autor 7</b></td>
  				<td><input type="text" name="autor7" size="50" maxlength="100" class="alinhadoAEsquerda"></td>
			</tr>
			<tr>
				<td><b>Modalidade</b></td>
				<td>';
    include('modalidades.php');
    echo '</td>
			</tr>
			<tr>
				<td><b>Áreas de Atuação</b></td>
				<td>';
    include('linhas_pesquisa.php');
    echo '</td>
			</tr>
         <tr>
            <td><b>Arquivo:</b></td>
            <td><input name="arq_trabalho" type="file" class="submitverde"><font color="#FF0000"> *</font><b> Somente arquivo PDF</b></td>
         </tr>
         <tr>
            <td></td>
            <td><b>Leia com atenção as Normas para envio de trabalhos:</b>
            <textarea name="normas" rows="20" cols="60" readonly>';
    include('normas.php');
    echo '</textarea></td>
         </tr>
         <tr>
            <td></td>
            <td><b>Li e concordo com as normas:</b>
            <input type="checkbox" name="acordo"><font color="#FF0000"> *</font></td></tr>';

    echo '<tr>
  					<td colspan="2"><br><b><font size="3" color="#FF0000">* </font>Campo de preenchimento obrigatório</b></td>
					</tr>';

    echo '<tr>
  				<input type="hidden" name="arquivo" value="submissao_trabalhos.php">
			</tr>
			<tr>  
  				<input type="hidden" name="submissao" value="S">
			</tr>
			</table>
			<input type="submit" value="Enviar" class="submitverde">&nbsp;<input type="reset" value="Limpar" class="submitverde">
			</form>
		</center>
		';
}
?>