function checkcontatos() {
    with (document.form_envio) {

        if (senha.value == "") {
            alert("Preencha o Campo Senha!");
            senha.focus();
            return false;
        }

        if (confirma_senha.value == "") {
            alert("Preencha o Campo Confirma  Senha!");
            confirma_senha.focus();
            return false;
        }

        if (senha.value != confirma_senha.value) {
            alert("Senhas diferentes! Digite novamente!");
            senha.value = "";
            confirma_senha.value = "";
            senha.focus();
            return false;
        }

        submit();
    }
}