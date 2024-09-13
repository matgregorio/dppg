<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./assets/css/style_home.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <nav class="sidebar">
            <?php include 'menu.php'; ?>
        </nav>
        <div class="content">
            <h2>Regulamento</h2>
            <?php
            if (isset($content)) {
                $file_path = "./uploads/" . htmlspecialchars($content);
            ?>
                <div>
                    <iframe src="<?php echo $file_path; ?>" width="100%" height="700px"></iframe>
                </div>
                <hr>
            <?php
                echo "</ul>";
            } else {
                echo "<p>Não há regulamentos disponíveis.</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>