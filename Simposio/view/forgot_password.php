<!DOCTYPE html>
<html>
<head>
    <title>Recuperar Senha</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
</head>
<body>
    <h2>Recuperar Senha</h2>
    <?php
    session_start();
    if (isset($_SESSION['message'])) {
        echo "<div class='message'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    ?>
    <form method="post" action="../controller/authController.php">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <button type="submit" name="forgot_password">Enviar Link de Recuperação</button>
        </div>
    </form>
    <p>Já tem uma conta? <a href="login.php">Faça login aqui</a>.</p>
</body>
</html>
