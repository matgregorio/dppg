/*
 * Permite a seleção de trabalhos de acordo com o filtro que o usuário escolher
 */
function GetXmlHttpObject() {
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

function listar_apresentacoes(situacao) {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Este Browser não suporta HTTP Request");
        return;
    }
    var url = "seleciona_apresentacoes.php";
    //alert(situacao);
    url = url + "?a=" + situacao;
    xmlHttp.open("GET", url);
    xmlHttp.onreadystatechange = listar;
    xmlHttp.send(null);
}


function listar() {
    if (xmlHttp.readyState == 4) {
        document.getElementById("lista_apresentacoes").innerHTML = xmlHttp.responseText;
    }
}
