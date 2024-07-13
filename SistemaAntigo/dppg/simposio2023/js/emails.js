
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

function carregar_tipo_destinatario(tipo_destinatario)
{
    if(tipo_destinatario != 'null' || tipo_destinatario != "")
    {
        switch (tipo_destinatario)
        {
            case "aluno_participante":
            {
                window.open("form_alterar_conteudo_email.php?tipoDestinatario=aluno_participante");
                location.reload();
                break;
            }
            case "avaliador_externo_cadastro":
            {
                window.open("form_alterar_conteudo_email.php?tipoDestinatario=avaliador_externo_cadastro");
                location.reload();
                break;
            }
            case "avaliador_externo_trabalho_vinculado":
            {
                window.open("form_alterar_conteudo_email.php?tipoDestinatario=avaliador_externo_trabalho_vinculado");
                location.reload();
                break;
            }
            case "orientador":
            {
                window.open("form_alterar_conteudo_email.php?tipoDestinatario=orientador");
                location.reload();
                break;
            }
        }
    }
}

function fecharJanela(milisegundos)
{
    setTimeout(window.close(), milisegundos);
    window.close();
}

