<?php
//session_start();
//$resultado_adm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('1'));
//$resultado_subadm = pesquisa_vetor_cursos($_SESSION['grupos_usuarios'], array('2'));

//if (($_SESSION[logado_site_dppg]) && ($resultado_adm) && ($resultado_subadm)) {
?>
    <center><br><b>Emissão de certificado de Iniciação Científica</b><br><br>

    <script src="validar1.js" type="text/javascript"></script>
    <center>
        <br>
        <form name="form_inscricao" method="POST" onsubmit="javascript: return checkcontatos()" action="index.php?arquivo=subsistemas/cursos/listar_certificados.php">
            <table border="0" width="500" class="esquerda">
                <tr>
                    <td>CPF:</td>
                    <td><input type="text" name="cpf" size="11" maxlength="11" required="true"><font color="#FF0000"> *</font> Somente números</td>
                </tr>
            </table>
            <br>
            <input type="submit" value="Gerar Certificado" class="submitVerde">&nbsp;<input type="reset" value="Limpar" class="submitVerde">
        </form>
        <br>
    </center>
<?php // } ?>