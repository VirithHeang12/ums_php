<?php
require_once __DIR__ . '/../database/database_connection.php';

try {
    $statement = $pdo->prepare("SELECT prof_num, prof_fname || ' ' || prof_lname AS full_name FROM professors");
    $statement->execute();
    $professors = $statement->fetchAll();
} catch (PDOException $e) {
    echo "Error while retrieving professors: " . $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Semester</title>
    <link rel="stylesheet" href="./../bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container py-5">
        <h1 class="text-center fw-bold text-uppercase">Create School</h1>
        <form action="save.php" method="POST" class="form col-6 mx-auto mt-4" enctype="multipart/form-data">
            <label for="school_name" class="form-label fw-medium">School Name</label>
            <input type="text" name="school_name" id="school_name" class="form-control mb-3" placeholder="Enter school name here">

            <label for="prof_num" class="form-label fw-medium">Professor Code (dean of school)</label>
            <select name="prof_num" id="prof_num" class="form-select">
                <option>Select professor here</option>
                <?php foreach ($professors as $row): ?>
                        <option value="<?= $row['PROF_NUM'] ?>"><?= $row['FULL_NAME'] ?></option>
                <?php endforeach; ?>
            </select>

            <label class="form-label fw-medium mt-3">School Logo</label>
            <input type="file" name="file" id="file" class="form-control mb-3">
            
            <div class="hstack justify-content-between my-4">
                <a href="index.php" class="btn btn-outline-dark px-4 fw-semibold">Back</a>
                <button type="submit" class="btn btn-dark px-4 fw-semibold">Create</button>
            </div>
        </form>
    </div>
</body>
</html>