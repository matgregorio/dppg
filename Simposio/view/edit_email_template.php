<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 1) {
    header("Location: login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emailTemplate->id = $_POST['id'];
    $emailTemplate->subject = $_POST['subject'];
    $emailTemplate->body = $_POST['body'];

    if ($emailTemplate->update()) {
        $_SESSION['message'] = "Template de email atualizado com sucesso.";
    } else {
        $_SESSION['error_message'] = "Erro ao atualizar o template de email.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Template de Email</title>
</head>
<body>
    <h2>Editar Template de Email</h2>
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
    <form method="post" action="edit_email_template.php?id=<?php echo $templateId; ?>">
        <input type="hidden" name="id" value="<?php echo $templateId; ?>">
        <div>
            <label for="subject">Assunto:</label>
            <input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($template['subject']); ?>" required>
        </div>
        <div>
            <label for="body">Corpo do Email:</label>
            <textarea id="body" name="body" required><?php echo htmlspecialchars($template['body']); ?></textarea>
        </div>
        <div>
            <button type="submit">Salvar</button>
        </div>
    </form>
</body>
</html>
