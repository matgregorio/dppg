<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
</head>
<body>
    <h2>Registro</h2>
    <?php 
    session_start();
    if(isset($_SESSION['error_message'])){
        echo "<div class'error-message'>" . $_SESSION['error_message'] . "</div>";
        unset($_SESSION['error_message']);
    }
    if(isset($_SESSION['message'])){
        echo "<div class 'message'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    $form_data = $_SESSION['form_data'] ??[];
    ?>
    <form method="post" action="../controller/authController.php?action=register">
        <div>
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($form_data['name'] ?? '', ENT_QUOTES); ?>" required>
        </div>
        <div>
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($form_data['cpf'] ?? '', ENT_QUOTES); ?>" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($form_data['email'] ?? '', ENT_QUOTES); ?>" required>
        </div>
        <div>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="confirm_password">Confirmar Senha:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <div>
            <label for="user_type">Tipo de Usuário:</label>
            <select id="user_type" name="user_type" required>
                <option value="4">Estudante</option>
                <option value="3">Professor</option>
                <option value="4">Ex-aluno</option>
                <option value="4">Técnico Administrativo</option>
                <option value="4">Outros</option>
                <option value="4">Tipo não declarado</option>
            </select>
        </div>
        <div>
            <button type="submit" name="register">Registrar</button>
        </div>
    </form>
    <p>Já tem uma conta? <a href="login.php">Faça login aqui</a>.</p>
</body>
</html>
