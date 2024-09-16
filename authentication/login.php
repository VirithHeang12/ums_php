<?php
$message = null;
$username = '';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../database/database_connection.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'username' => $username,
        'password' => $password
    ]);
    $user = $stmt->fetch();
    if ($user) {
        session_start();

        $_SESSION['user'] = [
            'id'        => $user['USER_ID'],
            'username'  => $user['USERNAME'],
            'role'      => $user['ROLE_ID']
        ];

        header('Location: ../index.php');
        die();
    } else {
        $message = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body class="bg-body-tertiary">
    <?php if ($message): ?>
        <p><?php echo $message ?></p>
    <?php endif; ?>
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="card p-4" style="width: 60%">
            <form action="login.php" method="POST" class="vstack gap-3">
                <div>
                    <label for="username" class="form-label">Username</label>
                    <input class="form-control" type="text" name="username" id="username" value="<?php echo $username ?>">
                </div>
                <div>
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-dark mt-3">Login</button>
            </form>
        </div>
    </div>
</body>
</html>