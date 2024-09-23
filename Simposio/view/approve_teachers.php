<?php
    session_start();
    if(!isset($_SESSION['user_type']) || ($_SESSION['user_type'] != 1 && $_SESSION['user_type'] != 2)){
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprovar professor</title>
</head>
<body>
    <h2>Aprovar Professores</h2>
    <?php
        if(isset($_SESSION['error_message'])){
            echo "<div class='error_message'>" . $_SESSION['error_message'] . "</div";
            unset($_SESSION['error_message']);
        }
        if(isset($_SESSION['message'])){
            echo "<div class='message'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
        }
    ?>
     <!-- Verifica se há professores pendentes -->
     <?php if (!empty($teachers)): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>Aprovar</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop através dos professores pendentes e exibe cada um -->
                <?php foreach ($teachers as $teacher): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($teacher['id']); ?></td>
                        <td><?php echo htmlspecialchars($teacher['name']); ?></td>
                        <td><?php echo htmlspecialchars($teacher['email']); ?></td>
                        <td><?php echo htmlspecialchars($teacher['cpf']); ?></td>
                        <td>
                    <form method="post" action="../controller/authController.php?action=approveTeachers">
                        <input type="hidden" name="user_id" value="<?php echo $teacher['id'];?>">
                        <button type="submit" name="approve">Aprovar</button>
                    </form>
                </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum professor pendente de aprovação.</p>
    <?php endif; ?>
</body>
</html>