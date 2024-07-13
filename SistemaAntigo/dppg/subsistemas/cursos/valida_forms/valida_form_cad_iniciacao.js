function checkiniciacao()
{
    with(document.form_iniciacao)
    {
        if (ops[0].checket == true) {
            //VERIFICAÇÃO DOS DADOS DO ALUNO
            if (cpfAluno.value == "") {
                alert("Por favor informe o CPF do Aluno !");
                cpfAluno.focus();
                return false;
            }

            if ((cpfAluno.value != "") && (cpfAluno.value != "00000000000") && (cpfAluno.value != "11111111111")
                && (cpfAluno.value != "22222222222") && (cpfAluno.value != "33333333333") && (cpfAluno.value != "44444444444")
                && (cpfAluno.value != "55555555555") && (cpfAluno.value != "66666666666") && (cpfAluno.value != "77777777777")
                && (cpfAluno.value != "88888888888") && (cpfAluno.value != "99999999999")) {
                var CPF = cpfAluno.value; // Recebe o valor digitado no campo
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
                    cpfAluno.value = '';
                    cpfAluno.focus();
                    return false;
                }
            }
            else {
                alert('CPF inválido. Por favor informe novamente !');
                cpfAluno.value = '';
                cpfAluno.focus();
                return false;
            }

            if (nomeAluno.value == "") {
                alert("Por favor informe o nome do aluno !");
                nomeAluno.focus();
                return false;
            }

            if (emailAluno.value == "") {
                alert("Por favor informe o email do aluno !");
                emailAluno.focus();
                return false;
            }
            if (emailAluno.value == "" || emailAluno.value.indexOf('@', 0) == -1 || emailAluno.value.indexOf('.', 0) == -1) {
                emailAluno.focus();
                emailAluno.value = "";
                alert("Email inválido. Por favor informe novamente !");
                return false;
            }
            /*
             if (agenciaAluno.value == "")
             {
             alert("Por favor informe a agência do aluno !");
             agenciaAluno.focus();
             return false;
             }
             if (contaAluno.value == "")
             {
             alert("Por favor informe a conta do aluno !");
             contaAluno.focus();
             return false;
             }
             */
            //------------------------------------------------------------------------
            //VERIFICAÇÃO DOS DADOS DO ORIENTADOR
            if (cpfOrientador.value == "") {
                alert("Por favor informe o CPF do Orientador !");
                cpfOrientador.focus();
                return false;
            }

            if ((cpfOrientador.value != "") && (cpfOrientador.value != "00000000000") && (cpfOrientador.value != "11111111111")
                && (cpfOrientador.value != "22222222222") && (cpfOrientador.value != "33333333333") && (cpfOrientador.value != "44444444444")
                && (cpfOrientador.value != "55555555555") && (cpfOrientador.value != "66666666666") && (cpfOrientador.value != "77777777777")
                && (cpfOrientador.value != "88888888888") && (cpfOrientador.value != "99999999999")) {
                var CPF = cpfOrientador.value; // Recebe o valor digitado no campo
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
                    cpfOrientador.value = '';
                    cpfOrientador.focus();
                    return false;
                }
            }
            else {
                alert('CPF inválido. Por favor informe novamente !');
                cpfOrientador.value = '';
                cpfOrientador.focus();
                return false;
            }
            if (nomeOrientador.value == "") {
                alert("Por favor informe o nome do Orientador !");
                nomeOrientador.focus();
                return false;
            }
            if (departamentoOrientador.value == "") {
                alert("Por favor informe o departamento do Orientador !");
                departamentoOrientador.focus();
                return false;
            }
            //------------------------------------------------------------------------
            //VERIFICAÇÃO DOS DADOS DO PROJETO
            if (projeto.value == "") {
                alert("Por favor informe o nome do Projeto !");
                projeto.focus();
                return false;
            }
            if (fomento.value == "") {
                alert("Por favor informe o fomento do Projeto !");
                fomento.focus();
                return false;
            }
            if (vigencia.value == "") {
                alert("Por favor informe a vigência do Projeto !");
                vigencia.focus();
                return false;
            }
        }else{
            if (arquivoCSV.value == ""){
                alert("Por favor selecione o arquivo CSV");
                arquivoCSV.focus();
                return false;
            }
        }
    }
}