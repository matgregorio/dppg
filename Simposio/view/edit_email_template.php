<!DOCTYPE html>
<html>
<head>
    <title>Editar Template de Email</title>
    <style>
        .error_message { color: red; }
        .message { color: green; }
    </style>
</head>
<body>
    <h2>Editar Template de Email</h2>
    <?php
    if(!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 1){
        header("Location: ../view/login.php");
        exit();
    }
    if (isset($_SESSION['error_message'])) {
        echo "<div class='error_message'>" . $_SESSION['error_message'] . "</div>";
        unset($_SESSION['error_message']);
    }
    if (isset($_SESSION['message'])) {
        echo "<div class='message'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    ?>
    <form method="post" action="../controllers/EmailTemplateController.php?action=update">
        <input type="hidden" name="id" value="<?php echo $template['id']; ?>">
        <div>
            <label for="subject_<?php echo $template['id']; ?>">Assunto:</label>
            <input type="text" id="subject_<?php echo $template['id']; ?>" name="subject" value="<?php echo htmlspecialchars($template['subject']); ?>" required>
        </div>
        <div>
            <label for="body_<?php echo $template['id']; ?>">Corpo:</label>
            <textarea id="body_<?php echo $template['id']; ?>" name="body" required><?php echo htmlspecialchars($template['body']); ?></textarea>
        </div>
        <div>
            <button type="submit">Salvar</button>
        </div>
    </form>
</body>
</html>
