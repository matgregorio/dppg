function checkcontatos() {
    with (document.form_cadastro_subevento) {
        if (nome_se.value == "") {
            alert("Digite o nome!");
            nome_se.focus();
            return false;
        }

        if (data.value == "") {
            alert("Digite a data!");
            data.focus();
            return false;
        }

        if (hora.value == "") {
            alert("Digite a hora!");
            hora.focus();
            return false;
        }

        if (duracao.value == "") {
            alert("Digite a duracao!");
            duracao.focus();
            return false;
        }

        if (palestrante.value == "") {
            alert("Digite o nome do Palestrante!");
            palestrante.focus();
            return false;
        }

        if (vagas.value == "") {
            alert("Digite o numero de vagas!");
            vagas.focus();
            return false;
        }

        if (local.value == "") {
            alert("Digite o local!");
            local.focus();
            return false;
        }

        if (titulo.value == "") {
            alert("Digite o titulo!");
            titulo.focus();
            return false;
        }

        if (descricao.value == "") {
            alert("Digite a descrição!");
            descricao.focus();
            return false;
        }

        if (lattes.value == "") {
            alert("Digite o lattes!");
            lattes.focus();
            return false;
        }
        submit();
    }
}

function mascara_data(data) {
    var mydata = '';
    mydata = mydata + data;
    if (mydata.length == 2) {
        mydata = mydata + '/';
        document.forms[0].data.value = mydata;
    }
    if (mydata.length == 5) {
        mydata = mydata + '/';
        document.forms[0].data.value = mydata;
    }
    if (mydata.length == 10) {
        verifica_data();
    }
}

function verifica_data() {

    dia = (document.forms[0].data.value.substring(0, 2));
    mes = (document.forms[0].data.value.substring(3, 5));
    ano = (document.forms[0].data.value.substring(6, 10));

    situacao = "";
    // verifica o dia valido para cada mes
    if ((dia < 01) || (dia < 01 || dia > 30) && (  mes == 04 || mes == 06 || mes == 09 || mes == 11 ) || dia > 31) {
        situacao = "falsa";
    }

    // verifica se o mes e valido
    if (mes < 01 || mes > 12) {
        situacao = "falsa";
    }

    // verifica se e ano bissexto
    if (mes == 2 && ( dia < 01 || dia > 29 || ( dia > 28 && (parseInt(ano / 4) != ano / 4)))) {
        situacao = "falsa";
    }

    if (document.forms[0].data.value == "") {
        situacao = "falsa";
    }

    if (situacao == "falsa") {
        alert("Data inválida!");
        document.forms[0].data.focus();
    }
}

function mascara_hora(hora) {
    var myhora = '';
    myhora = myhora + hora;
    if (myhora.length == 2) {
        myhora = myhora + ':';
        document.forms[0].hora.value = myhora;
    }
    if (myhora.length == 5) {
        verifica_hora();
    }
}

function verifica_hora() {
    hrs = (document.forms[0].hora.value.substring(0, 2));
    min = (document.forms[0].hora.value.substring(3, 5));

    /*alert('hrs '+ hrs);
     alert('min '+ min); */

    situacao = "";
    // verifica data e hora
    if ((hrs < 00 ) || (hrs > 23) || ( min < 00) || ( min > 59)) {
        situacao = "falsa";
    }

    if (document.forms[0].hora.value == "") {
        situacao = "falsa";
    }

    if (situacao == "falsa") {
        alert("Hora inválida!");
        document.forms[0].hora.focus();
    }
}