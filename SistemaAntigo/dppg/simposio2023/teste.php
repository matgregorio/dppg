<html>
<head>
    <title>Criar uma DIV igual a uma janela Popup</title>
    <style>
        #pop {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -150px;
            margin-top: -100px;
            padding: 10px;
            width: 300px;
            height: 200px;
            border: 1px solid #d0d0d0
        }
    </style>
</head>
<body>
<div id="pop">
    <a href="#" onclick="document.getElementById('pop').style.display='none';">[Fechar]</a>
    <br/>
    Agora coloque o estilo dessa div.

</div>

<a href="#" onclick="document.getElementById('pop').style.display='block';">Mostra1</a>
</body>