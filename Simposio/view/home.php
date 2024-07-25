<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['user_name']; ?></h2>
    <p>Your user type is: <?php echo $_SESSION['user_type']; ?></p>
    <a href="../controller/authController.php?logout=true">Logout</a>
</body>
</html>
