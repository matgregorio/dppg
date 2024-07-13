<head xmlns="http://www.w3.org/1999/html">
    <script src="js/validar1.js" type="text/javascript"></script>
    <script type="text/javascript">//Script que mostará a combo ou não
        function mostrar_combo() {

            if (document.getElementById('part').value == "3")
            {
                document.getElementById('docente').style.display = '';
                document.getElementById('docente01').style.display = '';
                document.getElementById('docente02').style.display = '';
                document.getElementById('docente03').style.display = '';
            }
            else if (document.getElementById('part').value == "5")
            {
                document.getElementById('docente').style.display = '';
                document.getElementById('docente01').style.display = '';
                document.getElementById('docente02').style.display = '';
                document.getElementById('docente03').style.display = '';
            }
            else
            {
                document.getElementById('docente').style.display = 'none';
                document.getElementById('docente01').style.display = 'none';
                document.getElementById('docente02').style.display = 'none';
                document.getElementById('docente03').style.display = 'none';
            }

        }
    </script>
</head>
<body>
<center>
    <br>
    <b>Cadastro</b>
    <br><br>

    <form name="form_inscricao" method="POST" onsubmit="javascript: return checkcontatos()" action="simposio.php">
        <table border="0" width="500" class="esquerda">
            <tr>
                <td>CPF:</td>
                <td><input type="text" name="cpf" size="11" maxlength="11"><font color="#FF0000"> *</font> Somente
                    números
                </td>
            </tr>
            <tr>
                <td>Nome:</td>
                <td><input type="text" name="nome" size="40" maxlength="45"><font color="#FF0000"> *</font></td>
            </tr>
            <td>Telefone:</td>
            <td><input type="text" name="telefone" size="10" maxlength="10"><font color="#FF0000"> *</font> Somente
                números
            </td>
            </tr>
            <tr>
                <td>E-mail:</td>
                <td><input type="text" name="email" size="40" maxlength="45"><font color="#FF0000"> *</font></td>
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
                        <option value='Cataguases'>Campus Av Cataguases</option>
                        <option value='Ubá'>Campus Av Ubá</option>
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
                        while ($campos = mysql_fetch_array($resultado)) {
                            echo "<option value='$campos[codigo_depto]'> $campos[nome_depto]</option>";
                        }
                        ?>
                    </select><font color="#FF0000"> *</font>
                </td>
            </tr>
            <tr id="docente02" style="display: none;">
                <td>Linha de Pesquisa:</td>
                <td><input type="text" name="pesquisa" size="40" maxlength="100"></td>
            </tr>
            <tr id="docente03" style="display: none;">
                <td>Visitante:</td>
                <td>
                    <input type="radio" name="visitante" value="1">Sim
                    <input type="radio" name="visitante" value="0">Não<font color="#FF0000"> *</font>
                </td>
            </tr>
            <tr>
                <td>Senha:</td>
                <td><input type="password" name="senha" size="10" maxlength="10"><font color="#FF0000"> *</font> No
                    máximo 10 caracteres
                </td>
            </tr>
            <tr>
                <td>Confirma Senha:</td>
                <td><input type="password" name="confirma_senha" size="10" maxlength="10"><font color="#FF0000">
                        *</font> No máximo 10 caracteres
                </td>
            </tr>
            <tr>
                <td colspan="2"><br><b><font size="3" color="#FF0000">* </font>Campo de preenchimento obrigatório</b>
                </td>
            </tr>
            <tr>
                <td colspan="2"><br><b>
                        <center><font size="3" color="#FF0000">ATENÇÃO</font></center>
                    </b>
                    <br>Após fazer o cadastro, efetue o <b>LOGIN</b> para poder fazer
                    a inscrição na Programação do Evento.<br>
                </td>
            </tr>
            <tr>
                <input type="hidden" name="arquivo2" value="inscricao.php">
            </tr>
        </table>
        <br>
        <input type="submit" value="Ok">&nbsp;<input type="reset" value="Limpar">
    </form>
    <br>
</center>
</body>
<?php
mysql_close($conexao);
?>
