<?php

declare(strict_types=1);

require_once __DIR__ . '/../database/database_connection.php';

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../authentication/login.php');
    die();
}

$sql = "SELECT * FROM students WHERE stu_num = :entity_id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'entity_id'     => $_SESSION['user']['entity_id'],
]);
$student = $stmt->fetch();

$sql = "SELECT * FROM departments WHERE dept_code = :dept_code";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'dept_code'     => $student['dept_code'],
]);
$department = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h1>Student Info</h1>
    <table>
        <tr>
            <td>Student Number</td>
            <td><?= $student['stu_num'] ?></td>
        </tr>
        <tr>
            <td>First Name</td>
            <td><?= $student['stu_fname'] ?></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><?= $student['stu_lname'] ?></td>
        </tr>
        <tr>
            <td>Department</td>
            <td><?= $department['dept_name'] ?></td>
        </tr>
    </table>

    <a href="../index.php">Home</a>
</body>
</html>