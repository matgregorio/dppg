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

function listar_trabalhos(situacao) {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Este Browser não suporta HTTP Request");
        return;
    }
    if (situacao == 'e') {
        document.getElementById('externo').style.display = 'block';
        document.getElementById('nexterno').style.display = 'none';
        situacao = 4;
    } else if (situacao == 'ne') {
        document.getElementById('externo').style.display = 'none';
        document.getElementById('nexterno').style.display = 'block';
        situacao = 4;
    } else {
        document.getElementById('externo').style.display = 'none';
        document.getElementById('nexterno').style.display = 'none';
    }

    var radios = document.getElementsByName("area");
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            console.log("Escolheu: " + radios[i].value);
            var area = radios[i].value;
        }
    }
//    alert(area);
    var url = "seleciona_trabalhos.php";
    url = url + "?a=" + situacao + "&ar=" + area;;
    xmlHttp.open("GET", url);
    xmlHttp.onreadystatechange = listar;
    xmlHttp.send(null);
}


function listar() {
    if (xmlHttp.readyState == 4) {
        document.getElementById("lista_trabalhos").innerHTML = xmlHttp.responseText;
    }
}

function listar_participantes(tipo) {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Este Browser não suporta HTTP Request");
        return;
    }
    var url = "seleciona_participante.php";
    url = url + "?p=" + tipo;
    xmlHttp.open("POST", url);
    xmlHttp.onreadystatechange = mostrar_participantes;
    xmlHttp.send(null);
}


function mostrar_participantes() {
    if (xmlHttp.readyState == 4) {
        document.getElementById("lista_participantes").innerHTML = xmlHttp.responseText;
    }
}

function alterar_status_submissao(id_trabalho)
{
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Este Browser não suporta HTTP Request");
        return;
    }

    var url = 'alterar_status_submissao.php?id='+id_trabalho;
    window.open(url);
    window.close();
}
