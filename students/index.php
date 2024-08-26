<?php
require_once __DIR__ . '/../config/database_connection.php';

try {
    $statement = $pdo->prepare("SELECT * FROM students");
    $statement->execute();
    $students = $statement->fetchAll();
} catch (PDOException $e) {
    echo "Error while retrieving students: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="/ums_php/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <style>
        td, th {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1 class="text-center">God Students</h1>
    <a href="create.php" class="btn btn-primary mb-5 mx-5">Create Student</a>
    <table class="table">
        <tr>
            <th>STUDENT NUMBER</th>
            <th>DEPARTMENT CODE</th>
            <th>FIRST NAME</th>
            <th>LAST NAME</th>
            <th>INITIAL</th>
            <th>EMAIL</th>
            <th>PROFESSOR NUMBER</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($students as $row) : ?>
            <tr>
                <td><?php echo $row['STU_NUM'] ?></td>
                <td><?php echo $row['DEPT_CODE']; ?></td>
                <td><?php echo $row['STU_FNAME']; ?></td>
                <td><?php echo $row['STU_LNAME']; ?></td>
                <td><?php echo $row['STU_INITIAL']; ?></td>
                <td><?php echo $row['STU_EMAIL']; ?></td>
                <td><?php echo $row['PROF_NUM']; ?></td>
                <td>
                    <a href="show.php?id=<?php echo $row['STU_NUM']; ?>">SHOW</a>
                    <a href="edit.php?id=<?php echo $row['STU_NUM']; ?>">EDIT</a>
                    <a href="delete.php?id=<?php echo $row['STU_NUM']; ?>">DELETE</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <script src="/ums_php/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
