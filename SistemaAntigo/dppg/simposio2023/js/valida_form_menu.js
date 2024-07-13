function checkcontatos() {
    with (document.form_update_menu) {
        /*
         if(arquivo.value == "")
         {
         alert("Preencha o Campo ícone!");
         arquivo.focus();
         return false;
         }*/

        if (nome.value == "") {
            alert("Preencha o Campo Nome Link!");
            nome.focus();
            return false;
        }

        submit();
    }
}