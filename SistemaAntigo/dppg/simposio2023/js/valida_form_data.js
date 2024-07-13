function checkcontatos() {

    with (document.form_altera_data) {
        if (data_inicio.value == "") {
            alert("Preencha O Campo Data Início!");
            data_inicio.focus();
            return false;
        }

        if (data_fim.value == "") {
            alert("Preencha o Campo Data Fim!");
            data_fim.focus();
            return false;
        }

        var d1 = data_inicio.value;
        var d2 = data_fim.value;

        var compara1 = parseInt(d1.split("/")[2].toString() + d1.split("/")[1].toString() + d1.split("/")[0].toString());
        var compara2 = parseInt(d2.split("/")[2].toString() + d2.split("/")[1].toString() + d2.split("/")[0].toString());

        if (compara1 > compara2) {
            alert("Data Inicial é maior que a Data final! ");
            data_inicio.focus();
            return false;
        }
        else if (compara1 == compara2) {
            alert("Data Inicial é Igual a Data final! ");
            data_inicio.focus();
            return false;
        }

        submit();
    }
}

function mascara_data_inicio(data_inicio) {
    var mydata = '';
    mydata = mydata + data_inicio;
    if (mydata.length == 2) {
        mydata = mydata + '/';
        document.forms[0].data_inicio.value = mydata;
    }
    if (mydata.length == 5) {
        mydata = mydata + '/';
        document.forms[0].data_inicio.value = mydata;
    }
    if (mydata.length == 10) {
        verifica_data_inicio();
    }
}

function verifica_data_inicio() {

    dia = (document.forms[0].data_inicio.value.substring(0, 2));
    mes = (document.forms[0].data_inicio.value.substring(3, 5));
    ano = (document.forms[0].data_inicio.value.substring(6, 10));

    situacao = "";
    // verifica o dia valido para cada mes 
    if ((dia < 01) || (dia < 01 || dia > 30) && (mes == 04 || mes == 06 || mes == 09 || mes == 11) || dia > 31) {
        situacao = "falsa";
    }

    // verifica se o mes e valido 
    if (mes < 01 || mes > 12) {
        situacao = "falsa";
    }

    // verifica se e ano bissexto 
    if (mes == 2 && (dia < 01 || dia > 29 || (dia > 28 && (parseInt(ano / 4) != ano / 4)))) {
        situacao = "falsa";
    }

    if (document.forms[0].data_inicio.value == "") {
        situacao = "falsa";
    }

    if (situacao == "falsa") {
        alert("Data inválida!");
        document.forms[0].data_inicio.focus();
    }
}

function mascara_data_fim(data_fim) {
    var mydata = '';
    mydata = mydata + data_fim;
    if (mydata.length == 2) {
        mydata = mydata + '/';
        document.forms[0].data_fim.value = mydata;
    }
    if (mydata.length == 5) {
        mydata = mydata + '/';
        document.forms[0].data_fim.value = mydata;
    }
    if (mydata.length == 10) {
        verifica_data();
    }
}

function verifica_data_fim() {

    dia = (document.forms[0].data_fim.value.substring(0, 2));
    mes = (document.forms[0].data_fim.value.substring(3, 5));
    ano = (document.forms[0].data_fim.value.substring(6, 10));

    situacao = "";
    // verifica o dia valido para cada mes 
    if ((dia < 01) || (dia < 01 || dia > 30) && (mes == 04 || mes == 06 || mes == 09 || mes == 11) || dia > 31) {
        situacao = "falsa";
    }

    // verifica se o mes e valido 
    if (mes < 01 || mes > 12) {
        situacao = "falsa";
    }

    // verifica se e ano bissexto 
    if (mes == 2 && (dia < 01 || dia > 29 || (dia > 28 && (parseInt(ano / 4) != ano / 4)))) {
        situacao = "falsa";
    }

    if (document.forms[0].data_fim.value == "") {
        situacao = "falsa";
    }

    if (situacao == "falsa") {
        alert("Data inválida!");
        document.forms[0].data_fim.focus();
    }
}
          