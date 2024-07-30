<?php
    session_start();
    if(!isset($_SESSION['user_type']) || ($_SESSION['user_type'] != 1 && $_SESSION['user_type'] != 2)){
        header("Location: login.php");
        exit();
    }

    include_once '../config/database.php';
    include_once '../model/user.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve'])){
        $user->id = $_POST['user_id'];
        if($user->approveTeacher()){
            $_SESSION['message'] = "Professor aprovado com sucesso.";
        }else{
            $_SESSION['error_message'] = "Erro ao aprovar professor";
        }
    }

    $teachers = $user->getPendingTeachers();
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
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($teachers as $teacher): ?>
            <tr>
                <td><?php echo htmlspecialchars($teacher['name'])?></td>
                <td><?php echo htmlspecialchars($teacher['email'])?></td>
                <td><?php echo htmlspecialchars($teacher['cpf'])?></td>
                <td>
                    <form method="post" action="approve_teachers.php">
                        <input type="hidden" name="user_id" value="<?php echo $teacher['id'];?>">
                        <button type="submit" name="approve">Aprovar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>