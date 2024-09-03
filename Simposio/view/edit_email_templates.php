<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error_message{ color:red;}
        .message{ color: grenn;}
    </style>
</head>
<body>
    <h2>Editar Templates de email</h2>
    <?php
    if(!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 1){
        header("Location: ../view/login.php");
        exit();
    }
    if(isset($_SESSION['error_message'])){
        echo "<div class= 'error_message'>" . $_SESSION['error_message'] . "</div>";
        unset($_SESSION['error_message']);
    }
    if(isset($_SESSION['message'])){
        echo "<div class= 'message'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    ?>
    <?php foreach($templates as $template):?>
        <form method="post" action="../controller/emailTemplateController.php?action=update">
            <input type="hidden" name="id" value="<?php echo $template['id']; ?>">
            <div>
                <label for="subject_<?php echo $template['id']; ?>">Assunto:</label>
                <input type="text" id="subject_<?php echo $template['id'];?>" name="subject" value="<?php echo htmlspecialchars($template['subject']);?>" required>
            </div>
            <div>
                <label for="body_<?php echo $template['id'];?>">Corpo:</label>
                <textarea id="body_<?php echo $template['id'];?>" name="body" required><?php echo htmlspecialchars($template['body']); ?></textarea>
            </div>
            <div>
                <button type="submit">Salvar</button>
            </div>
        </form>
        <hr>
    <?php endforeach;?>


</body>
</html>