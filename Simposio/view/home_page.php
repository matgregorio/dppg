
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/rr4lcfw2c3ig3vuqllm9z9eoiuvxmxxhxpjf7upq6e3v7x5j/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
      tinymce.init({
        selector: 'textarea#content', // Seleciona a textarea a ser transformada
        menubar: false
      });
    </script>
</head>
<body>
 <!-- Formulário de Edição -->
 <form method="post" action="../controller/EmailTemplateController.php?action=edit&id=<?php echo $_GET['id']; ?>">
        <label for="template_title">Título do Template:</label>
        <input type="text" name="template_title" id="template_title" value="<?php echo htmlspecialchars($emailTemplate['title']); ?>" required>
        <br><br>
        
        <label for="content">Conteúdo do E-mail:</label>
        <textarea name="content" id="content" rows="15" cols="80"><?php echo htmlspecialchars($emailTemplate['content']); ?></textarea>
        <br><br>
        
        <input type="submit" value="Salvar">
    </form>

</body>
</html>



