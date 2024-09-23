<?php
require_once __DIR__ . '/../database/database_connection.php';

try {
    $statement = $pdo->prepare("SELECT * FROM students");
    $statement->execute();
    $students = $statement->fetchAll();

    $statement = $pdo->prepare("
    SELECT p.prof_num, CONCAT(p.prof_fname, ' ', p.prof_lname) AS full_name, s.*, d.dept_name
    FROM professors p
    JOIN students s ON s.prof_num = p.prof_num
    JOIN departments d ON s.dept_code = d.dept_code
");


    $statement->execute();
    $students = $statement->fetchAll(PDO::FETCH_ASSOC);
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
    <!-- <link rel="stylesheet" href="/ums_php/bootstrap-5.3.3-dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <style>
        td,
        th {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">God Students</h1>
        <a href="create.php" class="btn btn-primary mb-5 mx-5">Create Student</a>
        <a href="../../index.php" class="btn btn-secondary mb-5 mx-5">Back</a>
        <table class="table">
            <tr>
                <th>STUDENT NUMBER</th>
                <th>DEPARTMENT NAME</th>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>INITIAL</th>
                <th>EMAIL</th>
                <th>PROFESSOR NAME</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($students as $row) : ?>
                <tr>
                    <td><?php echo $row['stu_num'] ?></td>
                    <td style="width: 250px;"><?php echo $row['dept_name']; ?></td>
                    <td><?php echo $row['stu_fname']; ?></td>
                    <td><?php echo $row['stu_lname']; ?></td>
                    <td><?php echo $row['stu_initial']; ?></td>
                    <td><?php echo $row['stu_email']; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td style="width: 300px;">
                        <a href="show.php?id=<?php echo $row['stu_num']; ?>" class="btn btn-warning">SHOW</a>
                        <a href="edit.php?id=<?php echo $row['stu_num']; ?>" class="btn btn-primary">EDIT</a>
                        <a href="delete.php?id=<?php echo $row['stu_num']; ?>" class="btn btn-danger">DELETE</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <script src="/ums_php/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>