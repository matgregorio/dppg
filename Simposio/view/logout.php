<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./assets/css/style_home.css">
    <title>Logout</title>
</head>

<body>
    <div class="container">
        <nav class="sidebar">
            <?php include 'menu.php'; ?>
        </nav>
        <div class="content">
            <?php
            session_unset();
            session_destroy();
            ?>
            Você saiu do sistema!
            <?php echo '<META HTTP-EQUIV="Refresh" Content="1; URL=/dppg/Simposio/">'; ?>
        </div>
    </div>
</body>

</html>