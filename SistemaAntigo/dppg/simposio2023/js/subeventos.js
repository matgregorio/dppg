
function GetXmlHttpObject()
{
    var xmlHttp = null;
    try
        {xmlHttp = new XMLHttpRequest();}
    catch (e)
    {
        try
            {xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");}
        catch (e)
            {xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");}
    }
    return xmlHttp;
}

function listar_subeventos(codigoSubEvento)
{
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Este Browser não suporta HTTP Request");
        return;
    }
    var url = "listar_participantes_sub_evento.php";
    url = url + "?cod=" + codigoSubEvento;
    xmlHttp.open("GET", url);
    xmlHttp.onreadystatechange = listar;
    xmlHttp.send(null);
}


function listar()
{
    if (xmlHttp.readyState == 4)
        {document.getElementById("lista_subeventos").innerHTML = xmlHttp.responseText;}
}
