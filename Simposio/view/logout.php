
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
<?php 
session_start();
session_unset();
session_destroy();
?>
Você saiu do sistema!

<?php echo '<META HTTP-EQUIV="Refresh" Content="1; URL=home.php">';?>

</body>
</html>