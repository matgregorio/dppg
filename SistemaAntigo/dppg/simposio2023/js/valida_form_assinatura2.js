function checkcontatos() {
    with (document.form_assinatura) {
        if (arquivo.value == "") {
            alert("Preencha o Campo Imagem!");
            arquivo.focus();
            return false;
        }

        submit();
    }
}