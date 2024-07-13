function list_dados(valor) {
    http.open("GET", "result.php?id=" + valor, true);
    http.onreadystatechange = handleHttpResponse;
    http.send(null);
}

/*Chamamos a função handleHttpResponse. Que é a responsavel por monstar nosso listmenu de
 resposta. Essa função tem como objetivo monstrar nosso listmenu, textarea e outro caso
 seja de sua vontade com o resultado da página processada.
 */

function handleHttpResponse() {
    campo_select = document.forms[0].subarea;
    if (http.readyState == 4) {
        campo_select.options.length = 0;
        results = http.responseText.split(",");

        for (i = 0; i < results.length; i++) {
            string = results[i].split("|");
            campo_select.options[i] = new Option(string[0], string[1]);
        }
    }
}

/*Essa função é somente para identificar o Navegador e suporte ao XMLHttpRequest.*/

function getHTTPObject() {
    var req;

    try {
        if (window.XMLHttpRequest) {
            req = new XMLHttpRequest();

            if (req.readyState == null) {
                req.readyState = 1;
                req.addEventListener("load", function () {
                    req.readyState = 4;

                    if (typeof req.onReadyStateChange == "function")
                        req.onReadyStateChange();
                }, false);
            }

            return req;
        }

        if (window.ActiveXObject) {
            var prefixes = ["MSXML2", "Microsoft", "MSXML", "MSXML3"];

            for (var i = 0; i < prefixes.length; i++) {
                try {
                    req = new ActiveXObject(prefixes[i] + ".XmlHttp");
                    return req;
                } catch (ex) {
                }
                ;

            }
        }
    } catch (ex) {
    }

    alert("XmlHttp Objects not supported by client browser");
}
var http = getHTTPObject();
// Logo após fazer a verificação, é chamada a função e passada
// o valor à variável global http.
 