<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
</head>
<body>
    <h2>Acesso ao Simposio</h2>
    <?php
        if(isset($_SESSION['error_message'])){
            echo "<div class= 'error_message'>" .$_SESSION['error_message'] . "</div>";
            unset($_SESSION['error_message']);
        }
        if(isset($_SESSION['message'])){
            echo "<div class='message'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
        }
    ?>
    <form method="post" action="../controller/authController.php?action=login">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit" name="login">Login</button>
        </div>
    </form>
        <a href="forgot_password.php">Esqueceu sua senha?</a>
</body>
</html>
