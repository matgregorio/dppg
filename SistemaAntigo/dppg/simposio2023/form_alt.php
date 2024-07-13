<?php

if ($_SESSION[logado_simposio_2021]) {
    include('includes/config.php');
    $sql = "select * from participantes where cpf='$_SESSION[cpf]'";
    $resultado = mysql_query($sql);
    $campos = mysql_fetch_array($resultado);
    mysql_close($conexao);
    ?>
    <head>
        <script type="text/javascript" src="js/validar1.js"></script>
        <script type="text/javascript">//Script que mostará a combo ou não
            function mostrar_combo() {
                if (document.getElementById('part').value == "3") {
                    document.getElementById('docente').style.display = '';
                    document.getElementById('docente01').style.display = '';
                    document.getElementById('docente02').style.display = '';
                    document.getElementById('docente03').style.display = '';
                }
                else if (document.getElementById('part').value == "5"){
                    document.getElementById('docente').style.display = '';
                    document.getElementById('docente01').style.display = '';
                    document.getElementById('docente02').style.display = '';
                    document.getElementById('docente03').style.display = '';
                }
                else {
                    document.getElementById('docente').style.display = 'none';
                    document.getElementById('docente01').style.display = 'none';
                    document.getElementById('docente02').style.display = 'none';
                    document.getElementById('docente03').style.display = 'none';
                }
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#curso').ready(function () {
                    mostrar_combo();
                });
            });
        </script>
    </head>
    <body>
    <center><br><b>Dados Pessoais</b><br><br>

        <form name="form_inscricao" method="POST" onsubmit="javascript: return checkcontatos()" action="simposio.php">
            <table border="0" class="esquerda">
                <tr>
                    <td>CPF:</td>
                    <td><?php echo '<input type="text" name="cpf" size="11" maxlength="11" readonly value="' . $campos[cpf] . '"> Somente números'; ?>
                        <font color="#FF0000"> *</font></td>
                </tr>
                <tr>
                    <td>Nome:</td>
                    <td><?php echo '<input type="text" name="nome" size="45" maxlength="50" value="' . $campos[nome] . '">';?>
                        <font color="#FF0000"> *</font></td>
                </tr>
                <tr>
                    <td>Telefone:</td>
                    <td><?php echo '<input type="text" name="telefone" size="10" maxlength="11" value="' . $campos[telefone] . '"> Somente números';?>
                        <font color="#FF0000"> *</font></td>
                </tr>
                <tr>
                    <td>E-mail:</td>
                    <td><?php echo '<input type="text" name="email" size="45" maxlength="50" value="' . $campos[email] . '">';?>
                        <font color="#FF0000"> *</font></td>
                </tr>
                <tr>
                    <td>Tipo de Participante:</td>
                    <td><?php include('combo_participante.php'); ?></td>
                </tr>
                <tr id="docente" style="display: none;">
                    <td>Sub Área</td>
                    <td>
                        <?php include('combo_subarea.php') ?><!--Mosta a combo de subáre semppre a que a opção docente é escolhida-->
                    </td>
                </tr>
                <!-- <tr>
                    <td>Curso:</td>
                    <td><?php //include('combo_cursos.php'); ?></td>
                </tr> -->
                <tr>
                    <td>Instituição:</td>
                    <td>
                        <select size="1" name="campus">
                            <option value='0'>-----</option>
                            <option value='Barbacena'>Campus Barbacena</option>
                            <option value='Juiz de Fora'>Campus Juiz de Fora</option>
                            <option value='Manhuaçu'>Campus Manhuaçu</option>
                            <option value='Muriaé'>Campus Muriaé</option>
                            <option value='Rio Pomba'>Campus Rio Pomba</option>
                            <option value='Santos Dumont'>Campus Santos Dumont</option>
                            <option value='São João del-Rei'>São João del-Rei</option>
                            <option value='Bom Sucesso'>Campus Av Bom Sucesso</option>
                            <option value='Cataguases'>Campus Cataguases</option>
                            <option value='Ubá'>Campus Ubá</option>
                            <option value='outros'>Outra</option>
                        </select><font color="#FF0000"> *</font>
                    </td>
                </tr>
                <tr id="docente01" style="display: none;">
                    <td>Área de Atuação:</td>
                    <td>
                        <select size="1" name="profdepto">
                            <option value='0'>-----</option>
                            <?php
                            $sql = "select * from departamento";
                            $resultado = mysql_query($sql);
                            while ($campos_departamento = mysql_fetch_array($resultado)) {
                                if ($campos_departamento[codigo_depto] == $campos[codigo_depto]) {
                                    echo "<option value='$campos_departamento[codigo_depto]' selected> $campos_departamento[nome_depto]</option>";
                                } else {
                                    echo "<option value='$campos_departamento[codigo_depto]'> $campos_departamento[nome_depto]</option>";
                                }
                            }
                            ?>
                        </select><font color="#FF0000"> *</font>
                    </td>
                </tr>
                <tr id="docente02" style="display: none;">
                    <td>Linha de Pesquisa:</td>
                    <td><?php echo '<input type="text" name="pesquisa" size="40" maxlength="100" value="' . $campos[pesquisa] . '">';?></td>
                </tr>
                <tr id="docente03" style="display: none;">
                    <td>Visitante:</td>
                    <td>
                        <?php
                        if ($campos[visitante] == 0) {
                            echo '
							<input type="radio" name="visitante" value="1">Sim
							<input type="radio" name="visitante" value="0" checked>Não<font color="#FF0000"> *</font>
						';
                        } else {
                            echo '
							<input type="radio" name="visitante" value="1" checked>Sim
							<input type="radio" name="visitante" value="0">Não<font color="#FF0000"> *</font>
						';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Senha:</td>
                    <td><input type="password" name="senha" size="20" maxlength="10"><font color="#FF0000">*</font> No
                        máximo 10 caracteres
                    </td>
                </tr>
                <tr>
                    <td>Confirma Senha:</td>
                    <td><input type="password" name="confirma_senha" size="20" maxlength="10"><font
                            color="#FF0000">*</font> No máximo 10 caracteres
                    </td>
                </tr>
                <tr>
                    <input type="hidden" name="arquivo2" value="altera_dados_pessoais.php">
                </tr>
            </table>
            <input type="submit" value="Alterar">&nbsp;<input type="reset" value="Limpar" class="submitverde"><br><br>
            <center><font color="#FF0000">OBS: Se o Tipo de Participante for alterado, é necessário que realize<br>o
                    login novamente.</font></center>
            <br>
        </form>
    </center>
    </body>
<?php
}
?>
