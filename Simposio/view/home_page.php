<!-- app/views/home.php -->
 <?php
    session_start();
 ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="/assets/css/style.css"> <!-- Inclua seu CSS -->
</head>
<body>
    <header>
        <h1>Bem-vindo à Home Page</h1>
        <nav>
            <ul>
                <li><a href="./">Home</a></li>
                <li><a href="./login">Login</a></li>
                <li><a href="/contato">Contato</a></li>
            </ul>
        </nav>
        <?php
            if(isset($_SESSION['user_type'])){
                $name = $_SESSION['user_name'];
                echo("Seja bem-vindo,$name");
            }
        ?>
    </header>
    <main>
        <p>Este é o conteúdo da página inicial.</p>
    </main>
    <footer>
        <p>Copyright &copy; 2024</p>
    </footer>
</body>
</html>
