<?php

require_once __DIR__ . '/../database/database_connection.php';


$id = $_GET['id'] ?? null;
$type = $_GET['type'] ?? null;

// get all roles

try {
    $statement = $pdo->prepare("SELECT * FROM roles");
    $statement->execute();
    $roles = $statement->fetchAll();
} catch (PDOException $e) {
    echo "Error while retrieving roles: " . $e->getMessage();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="/ums_php/bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body>
    <main class="container">
        <a href="search.php" class="btn btn-success">Choose</a>

        <form action="signup.php" method="post">
        
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
            <br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <br>
            <label for="entity_type">Type</label>
            <select name="entity_type" id="entity_type">
                <option value="student" <?php echo $type === "Student" ? "selected" : "" ?>>Student</option>
                <option value="professor" <?php echo $type === "Professor" ? "selected" : "" ?>>Professor</option>
            </select>
            <br>
            <label for="entity_id">ID</label>
            <input type="number" name="entity_id" id="entity_id" value="<?php echo $id ?>">
            <br>
            <label for="role_id">Role</label>
            <select name="role_id" id="role_id">
                <?php foreach ($roles as $role) : ?>
                    <option value="<?php echo $role['ROLE_ID'] ?>"><?php echo $role['ROLE_NAME'] ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Sign Up</button>
        </form>
    </main>
    <script src="/ums_php/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>