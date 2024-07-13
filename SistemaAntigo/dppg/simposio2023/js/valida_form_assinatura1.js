function checkcontatos() {
    with (document.form_assinatura) {
        if (arquivo.value == "") {
            alert("Preencha o Campo Imagem!");
            arquivo.focus();
            return false;
        }

        if (nome.value == "") {
            alert("Preencha o Campo Nome!");
            nome.focus();
            return false;
        }

        if (cargo.value == "") {
            alert("Preencha o Campo Cargo!");
            cargo.focus();
            return false;
        }

        submit();
    }
}