<?php

require_once __DIR__ . '/../database/database_connection.php';


try {
    $statement = $pdo->prepare("SELECT * FROM professors");
    $statement->execute();
    $professors = $statement->fetchAll();

    $statement = $pdo->prepare("SELECT * FROM students");
    $statement->execute();
    $students = $statement->fetchAll();
} catch (PDOException $e) {
    echo "Error while retrieving professors: " . $e->getMessage();
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
        td,
        th {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>

<body>
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
                <td><?php echo $row['stu_num'] ?></td>
                <td><?php echo $row['dept_code']; ?></td>
                <td><?php echo $row['stu_fname']; ?></td>
                <td><?php echo $row['stu_lname']; ?></td>
                <td><?php echo $row['stu_initial']; ?></td>
                <td><?php echo $row['stu_email']; ?></td>
                <td><?php echo $row['prof_num']; ?></td>
                <td>
                    <a href="register.php?<?php echo http_build_query(['id' => $row['stu_num'], 'type' => 'Student']); ?>">Select</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <table>
        <tr>
            <th>PROFESSOR NUMBER</th>
            <th>DEPARTMENT CODE</th>
            <th>PROFESSOR SPECIALTY</th>
            <th>PROFESSOR NAME</th>
            <th>EMAIL</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($professors as $row) : ?>
            <tr>
                <td><?php echo $row['prof_num'] ?></td>
                <td><?php echo $row['dept_code']; ?></td>
                <td><?php echo $row['prof_specialty']; ?></td>
                <td><?php echo $row['prof_fname'] . ' ' . $row['prof_initial'] . ' ' . $row['prof_lname']; ?></td>
                <td><?php echo $row['prof_email']; ?></td>
                <td>
                    <a href="register.php?<?php echo http_build_query(['id' => $row['prof_num'], 'type' => 'Professor']); ?>">Select</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <script src="/ums_php/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>