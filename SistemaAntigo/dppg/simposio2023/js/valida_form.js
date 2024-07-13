function checkcontatos(form) {

    if (form.campo.value == "") {
        alert("Por Favor, Preencha o Campo!");
        form.arquivo.focus();
        return false;
    }

    if (form.nome.value == "") {
        alert("Por Favor, Preencha o Campo!");
        form.nome.focus();
        return false;
    }


    submit();

}	
