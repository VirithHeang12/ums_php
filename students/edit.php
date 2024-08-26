<?php

require_once __DIR__ . '/../config/database_connection.php';

$stu_num = $_GET['id'];

try {
    $statement = $pdo->prepare("SELECT * FROM students WHERE STU_NUM = :stu_num");
    $statement->bindParam(':stu_num', $stu_num);
    $statement->execute();
    $student = $statement->fetch();
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
                <form class="form" action="update.php" method="post">
                    <div class="mb-3">
                        <label for="stu_num" class="form-label">Student Number</label>
                        <input type="text" name="stu_num" class="form-control" id="stu_num" value="<?php echo $student['STU_NUM']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="dept_code" class="form-label">Department Code</label>
                        <input type="text" name="dept_code" class="form-control" id="dept_code" value="<?php echo $student['DEPT_CODE']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="stu_fname" class="form-label">First Name</label>
                        <input type="text" name="stu_fname" class="form-control" id="stu_fname" value="<?php echo $student['STU_FNAME']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="stu_lname" class="form-label">Last Name</label>
                        <input type="text" name="stu_lname" class="form-control" id="stu_lname" value="<?php echo $student['STU_LNAME']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="stu_initial" class="form-label">Initial</label>
                        <input type="text" name="stu_initial" class="form-control" id="stu_initial" value="<?php echo $student['STU_INITIAL']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="stu_email" class="form-label">Email</label>
                        <input type="text" name="stu_email" class="form-control" id="stu_email" value="<?php echo $student['STU_EMAIL']; ?>">
                    </div>
                    <button class="btn btn-warning" type="submit">Update</button>
                </form>
                <a href="index.php" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <script src="/ums_php/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>