<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/style_home.css">
</head>

<body>
    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="#" data-content="home">Home</a></li>
                <li><a href="#" data-content="presentation">Apresentação</a></li>
                <?php if (!isset($_SESSION['user_type'])) {?>
                <li> <?php include './login.php';?></li>
                <?php } else { ?>
                    <h2>Welcome, <?php echo $_SESSION['user_name']; ?></h2>
                    <p>Your user type is: <?php echo $_SESSION['user_type']; ?></p>
                    <a href="../controller/authController.php?action=logout">Logout</a>
                    <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 1) : ?>
                        <a href="../controller/emailTemplateController.php?action=index">Editar Templates de email</a>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2)) : ?>
                        <a href="../view/approve_teachers.php">Aprovar Professores</a>
                    <?php endif; ?>
                <?php } ?>
            </ul>
        </nav>
        <div class="content" id="content">
            <h1>Welcome</h1>
            <p>Select an option from the menu</p>
        </div>
    </div>
    <?php if (!isset($_SESSION['user_type'])) { ?>
        <h2>Você não está logado</h2>
        <?php include './login.php'; ?>
    <?php } else { ?>

    <?php } ?>
    <script src="../assets/js/script_home.js"></script>
</body>

</html>