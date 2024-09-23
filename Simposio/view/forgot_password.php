
<?php
if(session_status() ==  PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci a Senha</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style_home.css">
</head>

<body>
    <div class="container">
        <nav class="sidebar">
            <?php include 'menu.php'; ?>
        </nav>
        <div class="content">
            <h2>Esqueci minha senha</h2>
            <?php
            if (isset($_SESSION['error_message'])) {
                echo "<div class='error_message'>" . $_SESSION['error_message'] . "</div>";
                unset($_SESSION['error_message']);
            }
            if (isset($_SESSION['message'])) {
                echo "<div class='message'>" . $_SESSION['message'] . "</div>";
                unset($_SESSION['message']);
            }
            ?>
            <form method="post" action="../controller/authController.php?action=forgotPassword">
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <button type="submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>