<?php
$message = null;
$username = '';
$password = '';

session_start();

$isLoggedIn = false;

if (isset($_SESSION['user'])) {
    $isLoggedIn = true;
    header('Location: ../index.php');
    die();
}

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
            'id'            => $user['user_id'],
            'username'      => $user['username'],
            'role'          => $user['role_id'],
            'entity_id'     => $user['entity_id'],
            'entity_type'   => $user['entity_type']
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

</html>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Welcome Page</title>
    <!-- <link rel="stylesheet" href="/ums_php/public/styles.css"> -->
    <link rel="stylesheet" href="../public/styles.css">
</head>

<body>
    <header>
        <div class="container">
            <h1>នាគខៀវ</h1>
            <nav>
                <ul>
                    <?php if (!$isLoggedIn) : ?>
                        <li><a href="./">ទំព័រដើម</a></li>
                        <li><a href="authentication/login">ចូល</a></li>
                        <li><a href="authentication/register">ចុះឈ្មោះ</a></li>
                    <?php else : ?>
                        <li><a href="professors">គ្រូ</a></li>
                        <li><a href="students">និស្សិត</a></li>
                        <li><a href="rooms">បន្ទប់</a></li>
                        <li><a href="courses">វគ្គសិក្សា</a></li>
                        <li><a href="schools">សាលា</a></li>
                        <li><a href="classes">ថ្នាក់រៀន</a></li>
                        <li><a href="semesters">ឆមាស</a></li>
                        <li><a href="departments">Department</a></li>          
                        <li><a href="authentication/logout">ចេញ</a></li>
                    <?php endif; ?>              
                </ul>
            </nav>
        </div>
    </header>
    
    <div class="bg-body-tertiary vh-100 d-flex align-items-center justify-content-center">
        <?php if ($message): ?>
            <p><?php echo $message ?></p>
        <?php endif; ?>
        <div class="container d-flex align-items-center justify-content-center">
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
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 University Name. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
