<?php

declare(strict_types=1);

require_once __DIR__ . '/../database/database_connection.php';



session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../authentication/login.php');
    die();
}

$entity_id = $_SESSION['user']['entity_id'];

$sql = "SELECT * FROM enrolls WHERE stu_num = :entity_id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'entity_id'     => $entity_id,
]);
$enrolls = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolls</title>
</head>
<body>
    <h1>Enrolls</h1>
    <table>
        <thead>
            <tr>
                <th>CLASS CODE</th>
                <th>STUDENT NUMBER</th>
                <th>ENROLL DATE</th>
                <th>ENROLL GRADE</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($enrolls as $enroll) : ?>
                <tr>
                    <td><?= $enroll['class_code'] ?></td>
                    <td><?= $enroll['stu_num'] ?></td>
                    <td><?= $enroll['enroll_date'] ?></td>
                    <td><?= $enroll['enroll_grade'] === '' ? 'Progressing' : $enroll['enroll_grade']  ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="../index.php">Home</a>
</body>
</html>