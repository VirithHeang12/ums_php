<?php

require_once __DIR__ . '/../database/database_connection.php';

try {

    $statement = $pdo->prepare("SELECT dept_code, dept_name FROM departments");
    $statement->execute();
    $departments = $statement->fetchAll();

    $statement = $pdo->prepare("SELECT prof_num, CONCAT(prof_fname, ' ', prof_lname) AS full_name FROM professors");
    $statement->execute();
    $professors = $statement->fetchAll();
} catch (PDOException $e) {
    echo "Error while retrieving departments: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/styles.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center">Create Student</h1>
        <a href="index.php" class="btn btn-secondary">Back</a>
        <div class="col-6 mx-auto shadow-sm p-3">
        <form action="save.php" method="post" class="form">
    <label for="dept_code" class="form-label">Department Name</label>
    <select class="form-control mb-2" id="dept_code" name="dept_code" required>
        <option value="">Select Department</option>
        <?php foreach ($departments as $department): ?>
            <option value="<?php echo htmlspecialchars($department['dept_code']); ?>">
                <?php echo htmlspecialchars($department['dept_name']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="stu_fname" class="form-label">First Name</label>
    <input type="text" name="stu_fname" id="stu_fname" class="form-control mb-2">

    <label for="stu_lname" class="form-label">Last Name</label>
    <input type="text" name="stu_lname" id="stu_lname" class="form-control mb-2">

    <label for="stu_initial" class="form-label">Initial</label>
    <input type="text" name="stu_initial" id="stu_initial" class="form-control mb-2">

    <label for="stu_email" class="form-label">Email</label>
    <input type="email" name="stu_email" id="stu_email" class="form-control mb-2">

    <label for="prof_num" class="form-label">Professor</label>
    <select class="form-control mb-2" id="prof_num" name="prof_num" required>
        <option value="">Select Professor</option>
        <?php foreach ($professors as $professor): ?>
            <option value="<?php echo htmlspecialchars($professor['prof_num']); ?>">
                <?php echo htmlspecialchars($professor['full_name']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit" class="btn btn-primary mt-2">Create</button>
</form>

        </div>
    </div>
</body>


</html>