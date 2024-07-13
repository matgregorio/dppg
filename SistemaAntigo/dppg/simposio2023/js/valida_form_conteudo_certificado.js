function checkcontatos() {
    with (document.form_certificado) {
        if (periodo.value == "") {
            alert("Preencha o Campo Período!");
            periodo.focus();
            return false;
        }

        if (edicao.value == "") {
            alert("Preencha o Campo Edição!");
            edicao.focus();
            return false;
        }
        submit();
    }
}