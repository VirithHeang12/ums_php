<?php

require_once __DIR__ . '/../database/database_connection.php';

$student_number = $_GET['id'];

try {
    $statement = $pdo->prepare("SELECT * FROM students WHERE STU_NUM = :student_number");
    $statement->bindParam(':student_number', $student_number);
    $statement->execute();
    $student = $statement->fetch();

    $statement = $pdo->prepare("SELECT * FROM enrolls WHERE STU_NUM = :student_number");
    $statement->bindParam(':student_number', $student_number);
    $statement->execute();
    $enrolls = $statement->fetchAll();
} catch (PDOException $e) {
    echo "Error while retrieving student: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Student</title>
    <link rel="stylesheet" href="/ums_php/bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>

<body>
    <h1 class="text-center">Show Student</h1>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <table class="table">
                    <tr>
                        <th>STUDENT NUMBER</th>
                        <td><?php echo $student['STU_NUM']; ?></td>
                    </tr>
                    <tr>
                        <th>DEPARTMENT CODE</th>
                        <td><?php echo $student['DEPT_CODE']; ?></td>
                    </tr>
                    <tr>
                        <th>FIRST NAME</th>
                        <td><?php echo $student['STU_FNAME']; ?></td>
                    </tr>
                    <tr>
                        <th>LAST NAME</th>
                        <td><?php echo $student['STU_LNAME']; ?></td>
                    </tr>
                    <tr>
                        <th>INITIAL</th>
                        <td><?php echo $student['STU_INITIAL']; ?></td>
                    </tr>
                    <tr>
                        <th>EMAIL</th>
                        <td><?php echo $student['STU_EMAIL']; ?></td>
                    </tr>
                    <tr>
                        <th>PROFESSOR NUMBER</th>
                        <td><?php echo $student['PROF_NUM']; ?></td>
                    </tr>
                </table>
                <h2 class="text-center">Enrolls</h2>
                <table class="table">
                    <tr>
                        <th>CLASS CODE</th>
                        <th>ENROLL DATE</th>
                        <th>ENROLL GRADE</th>
                    </tr>
                    <?php foreach ($enrolls as $enroll) : ?>
                        <tr>
                            <td><?php echo $enroll['CLASS_CODE']; ?></td>
                            <td><?php echo $enroll['ENROLL_DATE']; ?></td>
                            <td><?php echo $enroll['ENROLL_GRADE']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <a href="index.php" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <script src="/ums_php/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>