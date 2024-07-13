function checkcontatos() {
    with (document.form_inscricao) {
        if (cpf.value == "") {
            alert("Por favor digite seu CPF!");
            cpf.focus();
            return false;
        }

        if ((cpf.value != "") && (cpf.value != "00000000000") && (cpf.value != "11111111111")
            && (cpf.value != "22222222222") && (cpf.value != "33333333333") && (cpf.value != "44444444444")
            && (cpf.value != "55555555555") && (cpf.value != "66666666666") && (cpf.value != "77777777777")
            && (cpf.value != "88888888888") && (cpf.value != "99999999999")) {
            var CPF = cpf.value; // Recebe o valor digitado no campo
            // Aqui começa a checagem do CPF
            //var POSICAO, I, SOMA, DV, DV_INFORMADO;
            var DIGITO = new Array(10);
            DV_INFORMADO = CPF.substr(9, 2); // Retira os dois últimos dígitos do número informado
            // Desemembra o número do CPF na array DIGITO
            for (I = 0; I <= 8; I++) {
                DIGITO[I] = CPF.substr(I, 1);
            }

            // Calcula o valor do 10º dígito da verificação
            POSICAO = 10;
            SOMA = 0;
            for (I = 0; I <= 8; I++) {
                SOMA = SOMA + DIGITO[I] * POSICAO;
                POSICAO = POSICAO - 1;
            }
            DIGITO[9] = SOMA % 11;
            if (DIGITO[9] < 2) {
                DIGITO[9] = 0;
            }
            else {
                DIGITO[9] = 11 - DIGITO[9];
            }

            // Calcula o valor do 11º dígito da verificação
            POSICAO = 11;
            SOMA = 0;
            for (I = 0; I <= 9; I++) {
                SOMA = SOMA + DIGITO[I] * POSICAO;
                POSICAO = POSICAO - 1;
            }
            DIGITO[10] = SOMA % 11;
            if (DIGITO[10] < 2) {
                DIGITO[10] = 0;
            }
            else {
                DIGITO[10] = 11 - DIGITO[10];
            }

            // Verifica se os valores dos dígitos verificadores conferem
            DV = DIGITO[9] * 10 + DIGITO[10];

            if (DV != DV_INFORMADO) {
                alert('CPF inválido');
                cpf.value = '';
                cpf.focus();
                return false;
            }
        }
        else {
            alert('CPF inválido');
            cpf.value = '';
            cpf.focus();
            return false;
        }

        if (nome.value == "") {
            alert("Por favor digite seu nome!");
            nome.focus();
            return false;
        }

        if (telefone.value == "") {
            alert("Por favor digite seu telefone!");
            telefone.focus();
            return false;
        }

        var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        if (email.value == "") {
            alert("Por favor digite seu email!");
            email.focus();
            return false;
        }
        else {
            if (filter.test(email.value) == false) {
                alert("Email inválido!");
                email.value = "";
                email.focus();
                return false;
            }
        }

        if (participante.value == 3) {
            if (subarea.value == 0) {
                alert("Informe a Sub-Área.");
                subarea.focus();
                return false;
            }
            if (profdepto.value == 0) {
                alert("Informe o departamento.");
                profdepto.focus();
                return false;
            }
            if (visitante[0].checked == false && visitante[1].checked == false) {
                alert("Informe se é visitante.");
                visitante[1].focus();
                return false;
            }
        } else if (participante.value == 1) {
            alert("Informe o tipo de participante.");
            participante.focus();
            return false;
        }
        if (campus.value == 0) {
            alert("Informe o campus.");
            campus.focus();
            return false;
        }
        if (curso.value == 1) {
            alert("Informe o curso.");
            curso.focus();
            return false;
        }

        if (senha.value == "") {
            alert("Por favor digite uma senha!");
            senha.focus();
            return false;
        }

        if (confirma_senha.value == "") {
            alert("Por favor confirme a senha!");
            confirma_senha.focus();
            return false;
        }

        if (confirma_senha.value != senha.value) {
            alert("Senhas diferentes! Digite novamente!");
            senha.value = "";
            confirma_senha.value = "";
            senha.focus();
            return false;
        }

        if (acordo.checked == false) {
            alert("É necessário concordar com as normas de submissão!");
            return false;
        }

        submit();
    }
}
