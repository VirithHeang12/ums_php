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

    $statement = $pdo->prepare("SELECT dept_code, dept_name FROM departments");
    $statement->execute();
    $departments = $statement->fetch(); 

    $statement = $pdo->prepare("SELECT prof_num, CONCAT(prof_fname, ' ', prof_lname) AS full_name FROM professors");
    $statement->execute();
    $professors = $statement->fetch();
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
    <!-- <link rel="stylesheet" href="/ums_php/bootstrap-5.3.3-dist/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/styles.css">
</head>

<body>
    <h1 class="text-center">Show Student</h1>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <table class="table">
                    <tr>
                        <th>STUDENT NUMBER</th>
                        <td><?php echo $student['stu_num']; ?></td>
                    </tr>
                    <tr>
                        <th>DEPARTMENT CODE</th>
                        <td><?php echo $departments['dept_name']; ?></td>
                    </tr>
                    <tr>
                        <th>FIRST NAME</th>
                        <td><?php echo $student['stu_fname']; ?></td>
                    </tr>
                    <tr>
                        <th>LAST NAME</th>
                        <td><?php echo $student['stu_lname']; ?></td>
                    </tr>
                    <tr>
                        <th>INITIAL</th>
                        <td><?php echo $student['stu_initial']; ?></td>
                    </tr>
                    <tr>
                        <th>EMAIL</th>
                        <td><?php echo $student['stu_email']; ?></td>
                    </tr>
                    <tr>
                        <th>PROFESSOR NAME</th>
                        <td><?php echo $professors['full_name']; ?></td>
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
                            <td><?php echo $enroll['class_code']; ?></td>
                            <td><?php echo $enroll['enroll_date']; ?></td>
                            <td><?php echo $enroll['enroll_grade']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <a href="index.php" class="btn btn-secondary mb-3">Back</a>
            </div>
        </div>
    </div>
    <script src="/ums_php/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>