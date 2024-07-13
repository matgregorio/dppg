<head>
    <script type="text/javascript">
        function Acionar(ano) {
            if (ano > 0) {
                document.form_acervo.submit();
            }
        }
    </script>
    <script type="text/javascript">
        function GetXmlHttpObject()
        {
            var xmlHttp = null;
            try {
                xmlHttp = new XMLHttpRequest();
            } catch (e) {
                try {
                    xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
            }
            return xmlHttp;
        }

        function listarCampos(cSA)
        {
            xmlHttp = GetXmlHttpObject();
            if (xmlHttp == null)
            {
                alert("Este Browser não suporta HTTP Request");
                return;
            }
            if (cSA != 0)
            {
                var ano = document.getElementById('ano').value;
                var url = "anais/simposio2023/selecionar_titulo.php";
                url = url + "?sa=" + cSA; //anais/simposio201X/selecionar_titulo.php?sa=t
                url = url + "&ano=" + ano; //anais/simposio201X/selecionar_titulo.php?sa=t&ano=X
                xmlHttp.open("GET", url);
                xmlHttp.onreadystatechange = mostrarCampos;
                xmlHttp.send(null);
            }
            else
            {
                document.getElementById("titulo").innerHTML = "";
            }
        }

        function mostrarCampos() {
            if (xmlHttp.readyState == 4) {
                document.getElementById("titulo").innerHTML = xmlHttp.responseText;
            }
        }
    </script>
</head>
<?php
include('/var/www/html/simposio2023/includes/config.php');
$ano = mysql_real_escape_string($_POST[ano]);
$sql = "SELECT * FROM ano WHERE ano='" . date("Y") . "'";
$resultado = mysql_query($sql);
$campo_ano = mysql_fetch_array($resultado);
$query_sa = mysql_query("SELECT codigo_sa, nome_sa FROM sub_area ORDER BY nome_sa ASC");

?>
<center>
    <form name="form_acervo1_new" method="post" action="index.php">
        <?php echo"<input id = 'ano' type = 'hidden' name= 'ano' value = '$campo_ano[codigo_ano]'>"; ?>
        <h6>Departamento:
            <br>
            <select id="sa" name="sa" style='width: 450px' onchange="script : listarCampos(this.value)" onclick="script : listarCampos(this.value)">
                <option value="0"></option>
                <option value="t">Todos</option>
                <?php
                while ($campos_sa = mysql_fetch_array($query_sa))
                    echo"<option value = '$campos_sa[codigo_sa]'>$campos_sa[nome_sa]</option>";
                ?>
            </select>
        </h6>
        <br>
        <div id="titulo"></div>
    </form>
    <br>
    <a href="?data/anais/form_acervo">Voltar</a>
    <br><br>
</center>
