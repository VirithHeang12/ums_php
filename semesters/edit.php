<?php
require_once __DIR__ . '/../database/database_connection.php';

$semester_code = $_GET['id'];

try {
    $statement = $pdo->prepare("SELECT * FROM semesters WHERE semester_code = :semester_code");
    $statement->bindParam(':semester_code', $semester_code);
    $statement->execute();
    $semester = $statement->fetch();
} catch (PDOException $e) {
    echo "Error while retrieving semester:" . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Semester</title>
    <link rel="stylesheet" href="./../bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container py-5">
        <h1 class="text-center fw-bold text-uppercase">Edit Semester</h1>
        <form action="update.php" method="POST" class="form col-6 mx-auto mt-4" enctype="multipart/form-data">
            <input type="hidden" name="semester_code" id="semester_code" class="form-control mb-3" value="<?= $semester['SEMESTER_CODE']?>">

            <label for="semester_year" class="form-label fw-medium">Semester Year</label>
            <input type="text" name="semester_year" id="semester_year" class="form-control mb-3" value="<?= $semester['SEMESTER_YEAR']?>">

            <label for="semester_term" class="form-label fw-medium">Semester Term</label>
            <div class="d-flex mb-3">
                <div class="form-check col-5">
                    <input class="form-check-input" type="radio" name="semester_term" id="semester_term1" value="1" <?= $semester['SEMESTER_TERM'] == 1 ? 'checked' : '' ?>>
                    <label class="form-check-label" for="semester_term1">
                        Semester 1
                    </label>
                </div>
                <div class="form-check col-7">
                    <input class="form-check-input" type="radio" name="semester_term" id="semester_term2" value="2" <?= $semester['SEMESTER_TERM'] == 2 ? 'checked' : '' ?>>
                    <label class="form-check-label" for="semester_term2">
                        Semester 2
                    </label>
                </div>
            </div>
            
            <label for="semester_start_date" class="form-label fw-medium">Start Date</label>
            <?php $startDate = DateTime::createFromFormat('d-M-y', $semester['SEMESTER_START_DATE'])->format('Y-m-d') ?>
            <input type="date" name="semester_start_date" id="semester_start_date" class="form-control mb-3" value="<?= $startDate ?>">
            
            <?php $endDate = DateTime::createFromFormat('d-M-y', $semester['SEMESTER_END_DATE'])->format('Y-m-d') ?>
            <label for="semester_end_date" class="form-label fw-medium">End Date</label>
            <input type="date" name="semester_end_date" id="semester_end_date" class="form-control mb-3" value="<?= $endDate ?>">

             <input type="file" name="file" id="file" class="form-control mb-3">

            <div class="hstack justify-content-between my-4">
                <a href="index.php" class="btn btn-outline-dark px-4 fw-semibold">Back</a>
                <button type="submit" class="btn btn-dark px-4 fw-semibold">Update</button>
            </div>
        </form>
    </div>
</body>

</html>