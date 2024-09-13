<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apresentação</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style_home.css">
</head>

<body>
    <div class="container">
        <nav class="sidebar">
            <?php include 'menu.php'; ?>
        </nav>
        <div class="content">
            <h2>Apresentação</h2>
            <?php echo nl2br(htmlspecialchars($content)); ?>
        </div>
    </div>
</body>

</html>