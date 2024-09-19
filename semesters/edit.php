<?php
require_once __DIR__ . '/../database/database_connection.php';

$semester_code = $_GET['id'];
$entity_type = 'semester';

try {
    $statement = $pdo->prepare("SELECT * FROM semesters WHERE semester_code = :semester_code");
    $statement->bindParam(':semester_code', $semester_code);
    $statement->execute();
    $semester = $statement->fetch();

    $attachment = $pdo->prepare("SELECT * FROM medias WHERE entity_id = :entity_id AND entity_type = :entity_type");
    $attachment->bindParam(':entity_id', $semester_code);
    $attachment->bindParam(':entity_type', $entity_type);
    $attachment->execute();
    $attachment = $attachment->fetch();

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
            <input type="hidden" name="semester_code" id="semester_code" class="form-control mb-3" value="<?= $semester['semester_code']?>">

            <label for="semester_year" class="form-label fw-medium">Semester Year</label>
            <input type="text" name="semester_year" id="semester_year" class="form-control mb-3" value="<?= $semester['semester_year']?>">

            <label for="semester_term" class="form-label fw-medium">Semester Term</label>
            <div class="d-flex mb-3">
                <div class="form-check col-5">
                    <input class="form-check-input" type="radio" name="semester_term" id="semester_term1" value="1" <?= $semester['semester_term'] == 1 ? 'checked' : '' ?>>
                    <label class="form-check-label" for="semester_term1">
                        Semester 1
                    </label>
                </div>
                <div class="form-check col-7">
                    <input class="form-check-input" type="radio" name="semester_term" id="semester_term2" value="2" <?= $semester['semester_term'] == 2 ? 'checked' : '' ?>>
                    <label class="form-check-label" for="semester_term2">
                        Semester 2
                    </label>
                </div>
            </div>
            
            <label for="semester_start_date" class="form-label fw-medium">Start Date</label>
            <?php $startDate = new DateTime($semester['semester_start_date'])?>
            <?php $startDate = $startDate->format('Y-m-d')?>
            <input type="date" name="semester_start_date" id="semester_start_date" class="form-control mb-3" value="<?= $startDate ?>">
            
            <?php $endDate = new DateTime($semester['semester_end_date'])?>
            <?php $endDate = $endDate->format('Y-m-d')?>
            <label for="semester_end_date" class="form-label fw-medium">End Date</label>
            <input type="date" name="semester_end_date" id="semester_end_date" class="form-control mb-3" value="<?= $endDate ?>">

            <input type="file" name="file" id="file" class="form-control mb-3">

            <?php if ($attachment) : ?>
                <?php if ($attachment['media_type'] === 'image') : ?>
                    <img src="./../images/<?php echo $attachment['media_url']; ?>" alt="Image" class="img-fluid">
                <?php elseif ($attachment['media_type'] === 'attachment') : ?>
                    <a href="./../images/<?php echo $attachment['media_url']; ?>" target="_blank">មើល</a>
                 <?php endif; ?>

                <?php else : ?>
                    No attachment
            <?php endif; ?>

            <div class="hstack justify-content-between my-4">
                <a href="index.php" class="btn btn-outline-dark px-4 fw-semibold">Back</a>
                <button type="submit" class="btn btn-dark px-4 fw-semibold">Update</button>
            </div>
        </form>
    </div>
</body>

</html>