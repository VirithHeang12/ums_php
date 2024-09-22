<?php

require_once __DIR__ . '/../database/database_connection.php';

$stu_num = $_GET['id'];

try {
    $statement = $pdo->prepare("SELECT * FROM students WHERE STU_NUM = :stu_num");
    $statement->bindParam(':stu_num', $stu_num);
    $statement->execute();
    $student = $statement->fetch();

    $statement = $pdo->prepare("SELECT dept_code, dept_name FROM departments");
    $statement->execute();
    $departments = $statement->fetchAll();
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
            <div class="col-6 offset-3 shadow-sm p-3">
                <form class="form" action="update.php" method="post">
                    <div class="mb-3">
                        <label for="stu_num" class="form-label">Student Number</label>
                        <input type="text" name="stu_num" class="form-control" id="stu_num" value="<?php echo $student['stu_num']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="dept_code" class="form-label">Department Code</label>
                        <!-- <input type="text" name="dept_code" class="form-control" id="dept_code" value="<?php echo $student['DEPT_CODE']; ?>"> -->
                        <select class="form-control mb-2" id="dept_code" name="dept_code" required>
                            <option value="">Select Department</option>
                            <?php foreach ($departments as $department): ?>
                                <option value="<?php echo htmlspecialchars($department['dept_code']); ?>"
                                    <?php echo $department['dept_code'] == $student['dept_code'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($department['dept_name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="stu_fname" class="form-label">First Name</label>
                        <input type="text" name="stu_fname" class="form-control" id="stu_fname" value="<?php echo $student['stu_fname']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="stu_lname" class="form-label">Last Name</label>
                        <input type="text" name="stu_lname" class="form-control" id="stu_lname" value="<?php echo $student['stu_lname']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="stu_initial" class="form-label">Initial</label>
                        <input type="text" name="stu_initial" class="form-control" id="stu_initial" value="<?php echo $student['stu_initial']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="stu_email" class="form-label">Email</label>
                        <input type="text" name="stu_email" class="form-control" id="stu_email" value="<?php echo $student['stu_email']; ?>">
                    </div>
                    <button class="btn btn-warning" type="submit">Update</button>
                    <a href="index.php" class="btn btn-secondary">Back</a>
                </form>

            </div>
        </div>
    </div>
    <script src="/ums_php/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>